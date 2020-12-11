<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSalesDetail extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_sales_details';
    protected $primaryKey = 'id_transaksi_detail ';
    protected $fillable = [
        'invoice_id', 'invoice_date', 'stok_id','price','quantity','diskon','id_user','harga_satuan'
    ];
}
