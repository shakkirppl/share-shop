<?php

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
Route::Post('add_out_customer','App\Http\Controllers\ApiController@add_out_customer');
Route::Post('add_in_customer','App\Http\Controllers\ApiController@add_in_customer');
Route::Post('add_product_master','App\Http\Controllers\ApiController@add_product_master');
Route::Post('add_stock','App\Http\Controllers\ApiController@add_stock');
Route::get('get_customer','App\Http\Controllers\ApiController@get_customer');
Route::get('get_product','App\Http\Controllers\ApiController@get_product');
Route::Post('sales_integration_tally','App\Http\Controllers\ApiController@sales_integration_tally');
Route::Post('sales_order_integration_tally','App\Http\Controllers\ApiController@sales_order_integration_tally');
Route::Post('sales_return_integration_tally','App\Http\Controllers\ApiController@sales_return_integration_tally');
Route::Post('receipt_integration_tally','App\Http\Controllers\ApiController@receipt_integration_tally');

Route::Post('van_stock_request_integration_tally','App\Http\Controllers\ApiController@van_stock_request_integration_tally');
Route::Post('van_offload_request_integration_tally','App\Http\Controllers\ApiController@van_offload_request_integration_tally');

Route::Post('add_out_customer_xact','App\Http\Controllers\ApiController@add_out_customer_xact');
Route::get('get_xact_customer','App\Http\Controllers\ApiController@get_xact_customer');
Route::get('get_tally_customer','App\Http\Controllers\ApiController@get_tally_customer');