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
Route::get('sales/date', 'Api\SalesReportController@getSelectedDates');
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
Route::post('/guides', 'Api\TourGuideController@store');
Route::delete('/guides/{guide}', 'Api\TourGuideController@destroy')->name('guides.api.destroy');
Route::patch('/guides/{guide}', 'Api\TourGuideController@update')->name('guides.api.update');

Route::get('/deductions', 'Api\DeductionController@index');

Route::get('/users', 'Api\UserController@index');
Route::delete('/users/{user}', 'Api\UserController@destroy')->name('users.api.destroy');

Route::get('/summaries', 'Api\SummaryReportController@index');
Route::post('/summaries', 'Api\SummaryReportController@store');
Route::delete('/summaries/{summary}', 'Api\SummaryReportController@destroy')->name('summaries.api.destroy');
Route::patch('/summaries/{summary}', 'Api\SummaryReportController@update')->name('summaries.api.update');


Route::get('/tour-types', 'Api\TourTypeController@index');
Route::post('/tour-types', 'Api\TourTypeController@store');
Route::delete('/tour-types/{type}', 'Api\TourTypeController@destroy');
Route::patch('/tour-types/{type}', 'Api\TourTypeController@update');

Route::get('/commission-types', 'Api\CommissionTypeController@index');
Route::get('/commissions', 'Api\CommissionController@index');
Route::post('/commissions', 'Api\CommissionController@store');
Route::delete('/commissions/{commission}', 'Api\CommissionController@destroy');
Route::patch('/commissions/{commission}', 'Api\CommissionController@update');

Route::post('/tour-commissions', 'Api\TourCommissionController@store');
Route::patch('/tour-commissions/{commission}', 'Api\TourCommissionController@update');
