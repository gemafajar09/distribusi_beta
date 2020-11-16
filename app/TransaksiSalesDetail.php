<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSalesDetail extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_sales_details';
    protected $primaryKey = 'id_transaksi_detail ';
    protected $fillable = [
        'invoice_id', 'invoice_date', 'stok_id','qty_carton','qty_cup','qty_pcs','qty_bungkus',
    ];
}
