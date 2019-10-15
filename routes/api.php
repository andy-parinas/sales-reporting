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
Route::delete('/sales/{sale}', 'Api\SalesReportController@destroy')->name('sales.api.destroy');

Route::get('product-types', 'Api\ProductTypeController@index');
Route::post('product-types', 'Api\ProductTypeController@store');
Route::patch('product-types/{type}', 'Api\ProductTypeController@update');

Route::get('/products', 'Api\ProductController@index');
Route::post('/products', 'Api\ProductController@store');
Route::patch('/products/{product}', 'Api\ProductController@update')->name('products.api.update');
Route::delete('/products/{product}', 'Api\ProductController@destroy')->name('products.api.destroy');


Route::get('/agents', 'Api\TourAgentController@index');
Route::get('/agents/{agent}', 'Api\TourAgentController@show');
Route::post('/agents','Api\TourAgentController@store');
Route::delete('/agents/{agent}', 'Api\TourAgentController@destroy')->name('agents.api.destroy');
Route::patch('/agents/{agent}', 'Api\TourAgentController@update')->name('agents.api.update');

Route::get('/guides', 'Api\TourGuideController@index');

Route::get('/deductions', 'Api\DeductionController@index');
Route::get('/commissions', 'Api\CommissionController@index');
