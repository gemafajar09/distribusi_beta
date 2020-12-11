<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSales extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_sales';
    protected $primaryKey = 'id_transaksi_sales ';
    protected $fillable = [
        'sales_type','invoice_id', 'invoice_date', 'transaksi_tipe','term_until','sales_id','customer_id','note','totalsales','diskon'
    ];
}
