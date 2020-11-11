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

// API Front END
Route::group(['namespace' => 'Admin'], function () {
    // api produk
    Route::get('produk/datatable', 'ProductController@datatable');
    Route::get('produk/{id}', 'ProductController@get');
    Route::get('produk', 'ProductController@get');
    Route::post('produk', 'ProductController@add');
    Route::put('produk', 'ProductController@edit');
    Route::delete('produk/{id}', 'ProductController@remove');


    // api stok
    Route::get('stok/datatable', 'StokController@datatable');
    Route::get('stok/{id}', 'StokController@get');
    Route::get('stok', 'StokController@get');
    Route::post('stok', 'StokController@add');
    Route::put('stok', 'StokController@edit');
    Route::delete('stok/{id}', 'StokController@remove');

    // api cabang
    Route::get('cabang/datatable', 'CabangController@datatable');
    Route::get('cabang/{id}', 'CabangController@get');
    Route::get('cabang', 'CabangController@get');
    Route::post('cabang', 'CabangController@add');
    Route::put('cabang', 'CabangController@edit');
    Route::delete('cabang/{id}', 'CabangController@remove');

    // api satuan
    Route::get('satuan/datatable', 'SatuanController@datatable');
    Route::get('satuan/{id}', 'SatuanController@get');
    Route::get('satuan', 'SatuanController@get');
    Route::post('satuan', 'SatuanController@add');
    Route::put('satuan', 'SatuanController@edit');
    Route::delete('satuan/remove/{id}', 'SatuanController@remove');

    // api cost
    Route::get('cost/datatable', 'CostController@datatable');
    Route::get('cost/{id}', 'CostController@get');
    Route::get('cost', 'CostController@get');
    Route::post('cost', 'CostController@add');
    Route::put('cost', 'CostController@edit');
    Route::delete('cost/{id}', 'CostController@remove');


    // api sales
    Route::get('sales/datatable', 'SalesController@datatable');
    Route::get('sales/{id}', 'SalesController@get');
    Route::get('sales', 'SalesController@get');
    Route::post('sales', 'SalesController@add');
    Route::put('sales', 'SalesController@edit');
    Route::delete('sales/{id}', 'SalesController@remove');

    // api suplier
    Route::get('suplier/datatable', 'SuplierController@datatable');
    Route::get('suplier/{id}', 'SuplierController@get');
    Route::get('suplier', 'SuplierController@get');
    Route::post('suplier', 'SuplierController@add');
    Route::put('suplier', 'SuplierController@edit');
    Route::delete('suplier/{id}', 'SuplierController@remove');

    // api customer
    Route::get('customer/datatable', 'CustomerController@datatable');
    Route::get('customer/{id}', 'CustomerController@get');
    Route::get('customer', 'CustomerController@get');
    Route::post('customer', 'CustomerController@add');
    Route::put('customer', 'CustomerController@edit');
    Route::delete('customer/{id}', 'CustomerController@remove');

    // api brand
    Route::get('type/datatable', 'TypeController@datatable');
    Route::get('type/{id}', 'TypeController@get');
    Route::get('type', 'TypeController@get');
    Route::post('type', 'TypeController@add');
    Route::put('type', 'TypeController@edit');
    Route::delete('type/{id}', 'TypeController@remove');

    // api gudang
    Route::get('gudang/datatable', 'GudangController@datatable');
    Route::get('gudang/{id}', 'GudangController@get');
    Route::get('gudang', 'GudangController@get');
    Route::post('gudang', 'GudangController@add');
    Route::put('gudang', 'GudangController@edit');
    Route::delete('gudang/{id}', 'GudangController@remove');

    // api spesial
    Route::get('spesial/datatable', 'SpesialHargaController@datatable');
    Route::get('spesial/{id}', 'SpesialHargaController@get');
    Route::get('spesial', 'SpesialHargaController@get');
    Route::post('spesial', 'SpesialHargaController@add');
    Route::put('spesial', 'SpesialHargaController@edit');
    Route::delete('spesial/{id}', 'SpesialHargaController@remove');
    
    Route::get('getcustomer', 'SpesialHargaController@getCustomer');
    Route::get('getproduk', 'SpesialHargaController@getProduk');
});
