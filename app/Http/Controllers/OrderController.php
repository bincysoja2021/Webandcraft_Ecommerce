<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProducts;
use PDF;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Kolkata');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = Order::orderBy('id','desc')->paginate(5);
        return view('Order.index',compact('order'));
    }

    public function add_order()
    {
        $products=Product::get();
        return view('Order.add',compact('products'));
    }

    public function store(Request $request)
    {
          
        $request->validate([
                'name' => 'required',
                'phone'=>'required|digits:10|numeric|unique:order'
        ]);
                
        $order=new Order();
        $order->cust_name=$request->name;
        $order->phone=$request->phone;
        $order->order_id=random_int(10000, 99999);
        $order->order_date=date('Y-m-d');
        $order->save();

        $datacount=$request->addMoreInputFields;
        for($i=0; $i<count($datacount); $i++)

        {
            $order_product=new OrderProducts();
            $order_product->product=$datacount[$i]['product'];
            $order_product->qty=$datacount[$i]['quantity'];
            $order_product->order_id=$order->id;
            $total_amount_for_product=Product::where('id',$datacount[$i]['product'])->first();
            $order_product->total_amount=($datacount[$i]['quantity'])*($total_amount_for_product->price);
            $order_product->save();
        }
        $amount=DB::table('orderproducts')->where('order_id',$order->id)->sum('total_amount');
        Order::where('id',$order->id)->update(['total_amount'=>$amount]);
        return redirect()->route('list_order')->with('success','Order has been created successfully.');
    }

    public function edit(Request $req)
    {
        $products=Product::get();
        $order=Order::where('id',$req->id)->first();
        $order_product=OrderProducts::where('order_id',$req->id)->get();
        return view('Order.edit',compact('order','products','order_product'));
    }

     public function invoice(Request $req)
    {
        $data=Order::where('id',$req->id)->first();
        $order_product=OrderProducts::with('products')->where('order_id',$req->id)->get();

        $pdf = PDF::loadView('Order.invoice_pdf',array('data' => $data,'order_product'=>$order_product));

        return $pdf->download('Invoice.pdf');
    }   

    public function update(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'phone'=>'required|digits:10|numeric'
        ]);
        
                
        $category=Order::where('id',$request->id)->update(['cust_name'=>$request->name,'phone'=>$request->phone]);
        $datacount=$request->addMoreInputFields;
        $order_product=OrderProducts::where('order_id',$request->id)->delete();
        
        $datacount=$request->addMoreInputFields;
        for($i=0; $i<count($datacount); $i++)

        {
            $order_product=new OrderProducts();
            $order_product->product=$datacount[$i]['product'];
            $order_product->qty=$datacount[$i]['quantity'];
            $order_product->order_id=$request->id;
            $total_amount_for_product=Product::where('id',$datacount[$i]['product'])->first();
            $order_product->total_amount=($datacount[$i]['quantity'])*($total_amount_for_product->price);
            $order_product->save();
        }
        $amount=DB::table('orderproducts')->where('order_id',$request->id)->sum('total_amount');
        Order::where('id',$request->id)->update(['total_amount'=>$amount]);

        return redirect()->route('list_order')->with('success','Order has been updated successfully');
    }

            

     public function destroy($id)
    {
        
          Order::find($id)->delete();
          return redirect()->route('list_order')->with('success','Order has been deleted successfully');
        
    }
       
}
