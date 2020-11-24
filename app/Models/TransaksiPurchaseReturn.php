<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPurchaseReturn extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'transaksi_purchase_return';
    // define primary key
    protected $primaryKey = 'id_transaksi_purchase_return';
    // define fillable
    protected $fillable = [
        'return_id','return_date','id_suplier','stok_id','note_return','jumlah_return','register','status','price','id_cabang',
    ];

    protected $attributes = [
        'status' => '0', 
        'register'=>'0'
    ];
}
