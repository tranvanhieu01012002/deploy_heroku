<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Giaiptb1;
use Illuminate\Http\Request;
use App\Http\Controllers\Calculato;
use App\Http\Controllers\gCalendarController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\userController;
use Carbon\Carbon;
use Faker\Guesser\Name;
use Spatie\GoogleCalendar\Event;

use function Psy\sh;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [ShopController::class, 'index']);
// Route::get('/',function(){
//     return view('welcome');
// });

Route::get('/add-to-cart/{id}', [ShopController::class, 'getAddToCart'])->name('addToCart');

Route::get('/detail/{id}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/check-out', [ShopController::class, 'checkout'])->name('check-out');


Route::get('cake-type', [ShopController::class, 'cakeType'])->name('cake-type');

Route::get('delete-cart/{id}', [ShopController::class, 'getDeleteItemCart'])->name('delete-cart-item');



Route::post('check-out', [ShopController::class, 'postCheckout'])->name('payment');


Route::resource('cars', CarController::class);

Route::get('ShowCars', [CarController::class, 'index']);
Route::get('Create', [CarController::class, 'create'])->name('cars.create');
Route::post('cars', [CarController::class, 'store'])->name('cars.store');
Route::get('cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('cars/{car}', [CarController::class, 'update'])->name('cars.update');
Route::get('cars/{ShowCars}', [CarController::class, 'show']);
Route::get('/cars/delete/{car}', [CarController::class, 'destroy'])->name('cars.delete');

// Route::get('Ptb1', function(){
//     return view('Ptb1');
// });

// Route::post('Ptb1', function(Request $req){
//     $a=$req->input('a');
//     $b=$req->input('b');
//     if($a==0)
//         if($b==0)
//             $kq="pt co vo so nghiem";
//         else 
//             $kq="phuong trinh vo nghiem";
//     else $kq="phuong trinh co nghiem x=".$b/$a;
//     return view('Ptb1',compact('a','b','kq'));
// })->name('Ptb1.post');
// Route::post('Ptb1',[Giaiptb1::class,'Giai'])->name('Ptb1.post');


// Route::get('tinh',[Calculato::class,'showForm'])->name('number');
// Route::post('Calculato',[Calculato::class,'Giai'])->name('Calculato.post');
// Route::get('Calculato',[Calculato::class,'showForm'])->name('Calculato.post');

// Route::get('Shop',[ShopController::class,'index'])->name('Shop.index');

// Route::get('booking',function(){

//     $event = new Event();
//     $event->name = "test app";
//     $event->startDateTime = Carbon::now();
//     $event->endDateTime = Carbon::now()->addHour();
//     $event->save();
//     $e = Event::get();
//     dd($event);
// });
Route::get('booking', [gCalendarController::class, 'index']);
Route::post('booking', [gCalendarController::class, 'createEvent'])->name('post.calendar');

Route::get('list-province', [ShopController::class, 'testListAll']);
// Route::get('list-province/{id}',[ShopController::class,'testListDistrict']);
// Route::get('list-province/{id}/{idDistrict}',[ShopController::class,'testListWard']);
Route::get("/test", function () {
    return view('testA');
});



Route::get('vnpay-index', function () {
    return view('Pages.vnpay-index');
});
//Route xử lý nút Xác nhận thanh toán trên trang checkout.blade.php
Route::post('/vnpay/create_payment', [ShopController::class, 'createPayment'])->name('postCreatePayment');
//Route để gán cho key "vnp_ReturnUrl" ở bước 6
Route::get('/vnpay_return', [ShopController::class, 'vnpayReturn'])->name('vnpayReturn');
Route::get('/admin', function () {
    return view('Pages.Admin.index');
});
Route::get('/input-email', function () {
    return view('Pages.inputEmail');
});

Route::post('/input-email', [userController::class, 'postInputEmail'])->name('postInputEmail');

Route::get('sign-up', [userController::class, 'SignUp'])->name('user.get-sign-up');
Route::post('sign-up', [userController::class, 'SignUpForm'])->name('user.sign-up');

Route::get('login', [userController::class, 'getLogin'])->name('user.get-log-in');
Route::post('login', [userController::class, 'postLogin'])->name('user.log-in');

Route::get('logout', [userController::class, 'logout'])->name('user.logout');


Route::group(['prefix' => 'admin', 'middleware' => 'adminCheck'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/change-status/{id}/{status}',[AdminController::class,'changStatus'])->name('admin.changeStatus');
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [AdminController::class, 'category'])->name('admin.category');
    });
    Route::group(['prefix' => 'bills'], function () {
        Route::get('/', [AdminController::class, 'bills'])->name('admin.bills');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [AdminController::class, 'products'])->name('admin.product');
        Route::get('/delete/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.delete');
    });
});

Route::get('/pdf', [pdfController::class, 'index'])->name('pdf.index');