<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
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
        $category = Category::orderBy('id','desc')->paginate(5);
        return view('Category.index',compact('category'));
    }

    public function add_category()
    {
        return view('Category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        Category::create($request->post());

        return redirect()->route('list_category')->with('success','Catgeory has been created successfully.');
    }

    public function edit(Request $req)
    {
        $category=Category::where('id',$req->id)->first();
        return view('Category.edit',compact('category'));
    }

    public function update(Request $req)
    {
        
        $req->validate([
            'name' => 'required'
        ]);
        
        $category=Category::where('id',$req->id)->update(['name'=>$req->name]);

        return redirect()->route('list_category')->with('success','Catgeory Has Been updated successfully');
    }

            

     public function destroy($id)
    {
        $checkexists=Product::where('cat_id',$id)->exists();
        if($checkexists==true)
        {
          return redirect()->route('list_category')->with('success','Cannot delete Category!.');
        }
        else
        {
          Category::find($id)->delete();
          return redirect()->route('list_category')->with('success','Catgeory has been deleted successfully');
        } 
    }
       
}
