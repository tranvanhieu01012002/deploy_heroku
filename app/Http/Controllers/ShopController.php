<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Product;

// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Session;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cakes = DB::table('products')->paginate(4);
        $cakesFull = DB::table('products')->paginate(20);
        $slides = DB::table('slide')->paginate(4);
        return view('Pages.index', compact('cakes', 'slides', 'cakesFull'));
    }
    public function cakeType()
    {
        # code...

        return view('Pages.productType');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = DB::table('products')->where('id', '=', $id)->first();

        return view('Pages.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getAddToCart(Request $request, $id)
    {
        // $product = DB::table('products')->where('id','=',$id)->get();
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDeleteItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return redirect()->back();
    }
   
    public function postCheckout(Request $request)
    {

        $cart = Session::get('cart');
        if($request->deliveryFee !== 0){
            $cart->totalPrice = $cart->totalPrice + $request->deliveryFee;
        }
        if ($request->input('payment_method') != "VNPAY") {
            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->gender = $request->input('gender');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            $customer->note = $request->input('notes');
            $customer->save();

            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->input('payment_method');
            $bill->note = $request->input('notes');
            $bill->status = 2;

            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }
            Session::forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công');
        } else { //nếu thanh toán là vnpay
            $cart = Session::get('cart');
            return view('Pages.vnpay-index', compact('cart'));
        }
    }
    public function checkOut(Request $request)
    {
        # code...
        return view('Pages.checkOut');
    }
    // public function checkOut()
    // {
    //     return view('Pages.checkOut');
    // }

    //hàm xử lý nút Xác nhận thanh toán trên trang vnpay-index.blade.php, hàm này nhận request từ trang vnpay-index.blade.php
    public function createPayment(Request $request)
    {
        $cart = Session::get('cart');
        $vnp_TxnRef = $request->transaction_id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_Amount = str_replace(',', '', $cart->totalPrice * 100);
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnpay_Data = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => route('vnpayReturn'),
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $vnpay_Data['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($vnpay_Data);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($vnpay_Data as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRECT')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            //$vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT'). $hashdata);
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASHSECRECT')); //  
            // $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        //dd($vnp_Url);
        return redirect($vnp_Url);
        die();
    }

    //ham nhan get request tra ve tu vnpay
    public function vnpayReturn(Request $request)
    {
        //dd($request->all());
        // if($request->vnp_ResponseCode=='00'){
        //     $secureHash = $request->query('vnp_SecureHash');
        //     if ($secureHash == env('VNP_HASHSECRECT')) {
        //      $cart=Session::get('cart');

        //      //lay du lieu vnpay tra ve
        //      $vnpay_Data=$request->all();

        //      //insert du lieu vao bang payments
        //      //.........

        //     //truyen vnpay_Data vao trang vnpay_return
        //     return view('vnpay_return',compact('vnpay_Data'));
        //     }
        // }
        //PHIEEN BAN 2022
        $vnp_SecureHash = $request->vnp_SecureHash;
        //echo $vnp_SecureHash;
        $vnpay_Data = array();
        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $vnpay_Data[$key] = $value;
            }
        }

        unset($vnpay_Data['vnp_SecureHash']);
        ksort($vnpay_Data);
        $i = 0;
        $hashData = "";
        foreach ($vnpay_Data as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRECT'));
        // echo $secureHash;


        if ($secureHash == $vnp_SecureHash) {
            if ($request->query('vnp_ResponseCode') == '00') {

                $cart = Session::get('cart');
                //lay du lieu vnpay tra ve
                $vnpay_Data = $request->all();
                Session::forget('cart');
                //insert du lieu vao bang payments
                //.........

                //truyen vnpay_Data vao trang vnpay_return
                return view('Pages.vnpay_return', compact('vnpay_Data'));
            }
        }
    }
 

}
