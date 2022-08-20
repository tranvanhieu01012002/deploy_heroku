<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CheckFeeController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\DrinkTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('cars', ApiController::class);
Route::post('cars/search',[ApiController::class,'search']);
Route::apiResource('drinks', DrinkController::class);
Route::get('drinkType',[DrinkTypeController::class,'index']);


Route::get('/fee',[CheckFeeController::class,'index'])->name('fee.index');
Route::get("calFee", [CheckFeeController::class, 'calculateFee']);