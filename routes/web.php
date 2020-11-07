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
    return view('home');
});

// call controller folder admin
Route::group(['namespace'=>'Admin'],function(){
    
    // call controller modul
    Route::group(['prefix'=>'product'],function(){
        Route::get('/view_product','ProductController@index')->name('view_product');
    });
    
});
