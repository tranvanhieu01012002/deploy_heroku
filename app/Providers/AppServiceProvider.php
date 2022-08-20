<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Pagination\Paginator;
// use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use Session;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // view()->composer('Partial.header',function($view){
        //     $product_type = ProductType::all();
        //     $view->with('product_type',$product_type);
        // });
        View::composer(['Partial.header','Partial.productType'],function($view){
            $product_type = ProductType::all();
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

            }
            $view->with('product_type',$product_type);
           
        });
        View::composer(['Partial.header','Pages.checkOut'],function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(
                    [
                    'cart'=>Session::get('cart'),
                    'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice,
                    'totalQty'=>$cart->totalQty
                    ]);
            }
        });
        Paginator::useBootstrap();
        
    }
}