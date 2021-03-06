<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');
Route::resource('agents', 'TourAgentController');
Route::resource('sales', 'SalesReportController');
Route::resource('guides', 'TourGuideController');
Route::resource('summaries', 'SummaryReportController');
Route::resource('commissions', 'TourCommissionController');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::resource('users', 'UserController');
Route::get('users/{user}/password', 'UserController@password')->name('users.password.reset');
Route::patch('users/{user}/password', 'UserController@passwordUpdate')->name('users.password.update');


