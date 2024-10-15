<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category(){
        $data=Category::all();
        return view('admin.view_category',compact('data'));
    }

    public function add_category(Request $request){
        $data=new Category;
        $data->category_name=$request->category;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Category Added Successfully!');
        return redirect()->back();
    }

    public function delete_category($id){
        $data=Category::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Category Deleted Successfully!');
        return redirect()->back();
    }

    public function edit_category($id){
        $data=Category::find($id);
        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request,$id){
        $data=Category::find($id);
        $data->category_name=$request->category;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Category Updated Successfully!');
        return redirect('/view_category');
    }

    public function add_product(){
        $category=Category::all();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request){
        $data=new Product;
        $data->title=$request->title;
        $data->description=$request->description;
        $data->price=$request->price;
        $data->quantity=$request->quantity;
        $data->category=$request->category;

        $image=$request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image=$imagename;
        }

        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Product Added Successfully!');
        return redirect()->back();
    }

    public function view_product(){
        $product=Product::paginate(3);
        return view('admin.view_product',compact('product'));
    }

    public function delete_product($id){
        $data=Product::find($id);

        $image_path=public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Product Deleted Successfully!');
        return redirect()->back();
    }

    public function update_product($slug){
        $data=Product::where('slug',$slug)->get()->first();
        $category=Category::all();
        return view('admin.update_product',compact('data','category'));
    }

    public function edit_product(Request $request,$id){
        $data=Product::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $data->price=$request->price;
        $data->quantity=$request->quantity;
        $data->category=$request->category;

        $image=$request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image=$imagename;
        }

        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Product Updated Successfully!');
        return redirect('/view_product');
    }

    public function product_search(Request $request){
        $search=$request->search;
        $product=Product::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);
        return view('admin.view_product',compact('product'));
    }

    public function view_orders(){
        $data=Order::all();
        return view('admin.view_orders',compact('data'));
    }

    public function on_the_way($id){
        $data=Order::find($id);
        $data->status='On The Way';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Order Status Updated Successfully!');
        return redirect('/view_orders');
    }

    public function delivered($id){
        $data=Order::find($id);
        $data->status='Delivered';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addsuccess('Order Status Updated Successfully!');
        return redirect('/view_orders');
    }

    public function print_pdf($id){
        $data=Order::find($id);
        $pdf=PDF::loadView('admin.print_pdf',compact('data'));
        return $pdf->download('print_pdf');
    }
}
