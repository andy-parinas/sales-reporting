<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sales', 'Api\SalesReportController@index');
Route::post('/sales', 'Api\SalesReportController@store');
Route::patch('/sales/{sale}', 'Api\SalesReportController@update');

Route::get('product-types', 'Api\ProductTypeController@index');

Route::get('/products', 'Api\ProductController@index');
Route::get('/commissions', 'Api\CommissionController@index');
Route::get('/agents', 'Api\TourAgentController@index');
Route::get('/agents/{agent}', 'Api\TourAgentController@show');
Route::get('/deductions', 'Api\DeductionController@index');

