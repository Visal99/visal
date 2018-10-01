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

Route::get('/', function () {
    return view('frontend/home');
});

Route::get('/index', function () {
    return view('frontend/index');
});

Route::get('/home', function () {
    return view('frontend/home');
});
Route::get('/dashboard', function () {
    return view('user/test');
});



Auth::routes();

Route::get('/auth', 'HomeController@index')->name('home');



