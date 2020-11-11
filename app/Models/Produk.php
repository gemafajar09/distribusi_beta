<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{   
    
    public $timestamps = false;
    // define table
    protected $table = 'tbl_produk';
    // define primary key
    protected $primaryKey = 'produk_id';
    // define fillable
    protected $fillable = [
        'id_type_produk', 'produk_brand', 'produk_nama','produk_harga','stok','id_satuan',
    ];

}
