<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPurchase extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'transaksi_purchase';
    // define primary key
    protected $primaryKey = 'id_transaksi_purchase';
    // define fillable
    protected $fillable = [
        'invoice_id', 'invoice_date', 'transaksi_tipe','term_until','id_suplier','produk_id','id_cabang','status'
    ];
}
