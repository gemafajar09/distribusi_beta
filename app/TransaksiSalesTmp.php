<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSalesTmp extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_sales_tmps';
    protected $primaryKey = 'id_transaksi_tmp ';
    protected $fillable = [
        'invoice_id', 'invoice_date', 'stok_id','qty','price','quantity','diskon','id_user','id_warehouse','harga_satuan'
    ];
}
 