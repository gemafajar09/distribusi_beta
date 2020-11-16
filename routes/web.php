<?php

Route::get('/', function () {
    return view('home');
});

// call controller folder admin
Route::group(['namespace' => 'Admin'], function() {
    // call controller modul
    Route::group(['prefix' => 'product'], function () {
        Route::get('/view_product', 'ProductController@index')->name('view_product');
    });
    Route::group(['prefix' => 'cabang'], function () {
        Route::get('/index', 'CabangController@index')->name('cabang');
    });
    Route::group(['prefix' => 'satuan'], function () {
        Route::get('/index', 'SatuanController@index')->name('satuan');
    });
    Route::group(['prefix' => 'cost'], function () {
        Route::get('/index', 'CostController@index')->name('cost');
    });
    Route::group(['prefix' => 'sales'], function () {
        Route::get('/index', 'SalesController@index')->name('sales');
    });
    Route::group(['prefix' => 'gudang'], function () {
        Route::get('/index', 'GudangController@index')->name('gudang');
    });
    Route::group(['prefix' => 'spesial'], function () {
        Route::get('/index', 'SpesialHargaController@index')->name('spesial');
    });

    Route::group(['prefix' => 'suplier'], function () {
        Route::get('/index', 'SuplierController@index')->name('suplier');
    });
    Route::group(['prefix' => 'type'], function () {
        Route::get('/index', 'TypeController@index')->name('type');
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/index', 'CustomerController@index')->name('customer');

    });
    Route::group(['prefix' => 'produk'], function () {
        Route::get('/index', 'ProductController@index')->name('produk');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/index', 'UserController@index')->name('user');
    });
    Route::group(['prefix' => 'unit'], function () {
        Route::get('/index', 'UnitController@index')->name('unit');
    });
    Route::group(['prefix' => 'stok'], function () {
        Route::get('/index', 'StokController@index')->name('stok');
    });
});

Route::group(['namespace' => 'Transaksi'], function() {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/sales_transaction', 'TransaksiSalesController@index')->name('sales_transaction');
    });
});