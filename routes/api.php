<?php

use Illuminate\Http\Request;

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
    Route::delete('cabang/remove/{id}', 'CabangController@remove');

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
    Route::get('getsales','SalesController@getSales');
    Route::delete('sales/remove/{id}', 'SalesController@remove');

    // api suplier
    Route::get('suplier/datatable', 'SuplierController@datatable');
    Route::get('suplier/{id}', 'SuplierController@get');
    Route::get('suplier', 'SuplierController@get');
    Route::post('suplier', 'SuplierController@add');
    Route::put('suplier', 'SuplierController@edit');
    Route::delete('suplier/remove/{id}', 'SuplierController@remove');
    Route::get('getsuplier','SuplierController@getSuplier');
    Route::get('getsuplier/produk/{id}','SuplierController@getSuplierProduk');

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
    Route::get('gettype','TypeController@getType');

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

    // api spesial
    Route::get('user/datatable', 'UserController@datatable');
    Route::get('user/{id}', 'UserController@get');
    Route::get('user', 'UserController@get');
    Route::post('user', 'UserController@add');
    Route::put('user', 'UserController@edit');
    Route::delete('user/{id}', 'UserController@remove');

    // api spesial
    Route::get('unit/datatable', 'UnitController@datatable');
    Route::get('unit/{id}', 'UnitController@get');
    Route::get('unit', 'UnitController@get');
    Route::post('unit', 'UnitController@add');
    Route::put('unit', 'UnitController@edit');
    Route::delete('unit/{id}', 'UnitController@remove');
    Route::get('getunit/{id}', 'UnitController@getUnit');

    Route::get('getcustomer', 'SpesialHargaController@getCustomer');
    Route::get('getproduk', 'SpesialHargaController@getProduk');
});

Route::group(['namespace' => 'transaksi'], function () {

    // api purchase
    Route::get('purchasedetail/datatable', 'TransaksiPurchaseDetailController@datatable');
    Route::post('purchasedetail/approval', 'TransaksiPurchaseDetailController@approvalPurchase');
    
    // api purchase tmp
    Route::get('purchasetmp/datatable', 'TransaksiPurchaseTmpController@datatable');
    Route::get('purchasetmp/{id}', 'TransaksiPurchaseTmpController@get');
    Route::get('purchasetmp', 'TransaksiPurchaseTmpController@get');
    Route::post('purchasetmp', 'TransaksiPurchaseTmpController@add');
    Route::put('purchasetmp', 'TransaksiPurchaseTmpController@edit');
    Route::delete('purchasetmp/{id}', 'TransaksiPurchaseTmpController@remove');
    Route::get('registerpurchase','TransaksiPurchaseTmpController@register')->name('register-transaksi-purchase');

    // api transaksi sales
    Route::post('getsalestrans', 'TransaksiSalesController@getSales');
    Route::post('getCustomer', 'TransaksiSalesController@getCustomer');
    Route::post('getProduk', 'TransaksiSalesController@getProduk');
    Route::post('cekstok', 'TransaksiSalesController@cekstok');
    Route::post('hargakusus', 'TransaksiSalesController@hargakusus');
    Route::post('addkeranjang', 'TransaksiSalesController@addkeranjang');

    Route::get('datatable/{id}', 'TransaksiSalesController@datatable');
    Route::post('deleteitem', 'TransaksiSalesController@deleteitem');
    Route::post('rekaptransaksi', 'TransaksiSalesController@rekaptransaksi');

    // api Purchase Return
    // Route::get('purchasereturn/datatable', 'TransaksiPurchareturnController@datatable');
    Route::get('purchasereturn/{id}', 'TransaksiPurchaseReturnController@get');
    Route::get('returnpurchase/datatable', 'TransaksiPurchaseReturnController@datatable');
    Route::post('purchasereturn', 'TransaksiPurchaseReturnController@add');
    Route::delete('purchasereturn/{id}', 'TransaksiPurchaseReturnController@remove');
    Route::get('registerpurchasereturn','TransaksiPurchaseReturnController@register')->name('register-transaksi-purchase-return');
    Route::get('getsuplierproduk/{id}', 'TransaksiPurchaseReturnController@getStok');

});