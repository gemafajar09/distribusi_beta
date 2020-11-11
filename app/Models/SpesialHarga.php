<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpesialHarga extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_harga_khusus';
    // define primary key
    protected $primaryKey = 'id_harga_khusus';
    // define fillable
    protected $fillable = [
        'id_customer', 'produk_id', 'spesial_nominal',
    ];
}
