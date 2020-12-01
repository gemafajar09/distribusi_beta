<?php

Route::get('/', function () {
    if(Session()->has('id'))
    {
        return view('home');
    }
    else
    {
        return view('pages.login');
    }
});

// call controller folder admin

Route::group(['namespace' => 'Admin'], function () {
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
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/index', 'StokController@index')->name('stok');
        });
        Route::group(['prefix' => 'unit'], function () {
            Route::get('/index', 'UnitController@index')->name('unit');
        });
});

Route::group(['namespace' => 'Transaksi'], function() {
    Route::group(['prefix' => 'sales_transaksi'], function () {
        Route::get('/sales_transaction', 'TransaksiSalesController@index')->name('sales_transaction');

    });
    Route::group(['prefix' => 'purchase_transaksi'], function () {

        Route::get('/datatablessales','TransaksiSalesController@datatablessales')->name('datatablessales');
        Route::get('/fakturs/{id}','TransaksiSalesController@faktur');
       
        // Purchase

        Route::get('/purchase_order','TransaksiPurchaseController@index')->name('purchase_order');

        Route::get('/purchase_aproval','TransaksiPurchaseDetailController@index')->name('aproval_purchase_order');
        Route::get('/purchase_return','TransaksiPurchaseReturnController@index')->name('return_purchase_order');

    });
    Route::group(['prefix' => 'opname'], function () {

        Route::get('/stok_opname','OpnameController@index')->name('opname');
        Route::get('/datatablesopname','OpnameController@datatablesopname')->name('datatablesopname');

    });
});

Route::group(['namespace' => 'Report'], function() {
    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/report','StokReportController@index')->name('stok-report');
        Route::get('/report_stok','StokReportController@report');
        Route::get('/report_stok/{id_warehouse}','StokReportController@report');
    });
});

    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@postLogin')->name('postLogin');
    Route::get('/logout', 'LoginController@postLogout')->name('postLogout');

