<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;
class pdfController extends Controller
{
    //
    public function index()
    {
        # code...
        $products = Product::paginate(2);
        $pdf = PDF::loadView('Pages.Admin.Pdf.index',compact('products'));
        return $pdf->download('text.pdf');
    }
}
