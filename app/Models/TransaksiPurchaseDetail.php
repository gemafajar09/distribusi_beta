<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPurchaseDetail extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'transaksi_purchase_detail';
    // define primary key
    protected $primaryKey = 'id_transaksi_purchase_detail';
    // define fillable
    protected $fillable = [
        'invoice_id', 'invoice_date', 'transaksi_tipe','term_until','id_suplier','produk_id','quantity','unit_satuan_price','diskon','total_price','id_cabang',
    ];
}
