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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route::get('/users', 'UserController@index')->name('users.index');
// Route::get('/users/create', 'UserController@create')->name('users.create');
// Route::get('/users/{user}', 'UserController@show');
// Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
// Route::post('/users', 'UserController@store')->name('users.store');

Route::resource('users', 'UserController');


