<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProducts;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::with('cat_deatils')->orderBy('id','desc')->paginate(5);
        return view('Product.index',compact('product'));
    }

     public function add_product()
    {
        $cat=Category::get();
        return view('Product.add',compact('cat'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'name'   => 'required',
                'image'  =>'required|mimes:jpeg,png,jpg,gif',
                'cat_id' => 'required',
                'price'  => 'required'
        ]);
        
        
        if($request->hasFile('image'))
        {
            $filename=$request->getSchemeAndHttpHost(). '/assets/image/' . time() . '.' .$request->image->extension();

            $request->image->move(public_path('/assets/image/'),$filename);
        }
        $product=new Product();
        $product->name=$request->name;
        $product->cat_id=$request->cat_id;
        $product->price=$request->price;
        $product->image=$filename;
        $product->save();

        return redirect()->route('list_product')->with('success','Product has been created successfully.');
    }

    public function edit(Request $req)
    {
        $cat=Category::get();
        $product=Product::where('id',$req->id)->first();
        return view('Product.edit',compact('product','cat'));
    }

    public function image_delete($id)
    {
        $path="http://127.0.0.1:8000/assets/image/".$id;
        unlink('assets/image/'.$id);
        $product=Product::where('image',$path)->update(['image'=>null]);
        return redirect()->back()->with('success', 'successfully delete the images.');   

    }

    public function update(Request $req)
    {
        $req->validate([
                'name'   => 'required',
                'cat_id' => 'required',
                'price'  => 'required'
        ]);
        
        
        if($req->hasFile('image') != null)
        {
            $filename=$req->getSchemeAndHttpHost(). '/assets/image/' . time() . '.' .$req->image->extension();

            $req->image->move(public_path('/assets/image/'),$filename);
        }
        else
        {
          $data= Product::where('id',$req->id)->first();
          $filename=$data->image;
        }
        
        $category=Product::where('id',$req->id)->update(['name'=>$req->name,'cat_id'=>$req->cat_id,'price'=>$req->price,'image'=>$filename]);

        return redirect()->route('list_product')->with('success','Product Has Been updated successfully');
    }

        
     public function destroy($id)
    {
        
        $checkexists=OrderProducts::where('product',$id)->exists();
        if($checkexists==true)
        {
          return redirect()->route('list_product')->with('success','Cannot delete Product!.');
        }
        else
        {
          Product::find($id)->delete();
          return redirect()->route('list_product')->with('success','Product has been deleted successfully');
        
        }
       
    }
}
