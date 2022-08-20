<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bill;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function index()
    {
        $admin = new Admin();
        $data= $admin->summaryInfo();
        return view('Pages.Admin.index',compact('data'));
    }
    public function products()
    {
        $products = Product::paginate(10);
        return view('Pages.Admin.Products.index',compact('products'));
    }
    public function category()
    {
        $category = ProductType::paginate(10);
        return view('Pages.Admin.Category.index',compact('category'));
    }
    public function destroyProduct($id)
    {
        # code...
        $car = Product::find($id);
        $linkImage=public_path('source/image/product').$car->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $car->delete();
        return redirect()->route('admin.product')->with('success', 'ban da xoa thanh cong');
    }
    public function bills()
    {
        $bills = Bill::paginate(10);
        return view('Pages.Admin.Bill.index',compact('bills'));
        # code...
    }
    public function changStatus($id,$status)
    {
        # code...
        if($status == 2)
        Bill::where('id',$id)->update(['status'=>$status-1]);
        else if($status == 1)
        Bill::where('id',$id)->update(['status'=>null]);
        return redirect()->back();
    }
}
