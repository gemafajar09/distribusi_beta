<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_stok';
    // define primary key
    protected $primaryKey = 'stok_id';
    // define fillable
    protected $fillable = [
        'produk_id', 'jumlah', 'id_cabang',
    ];
}
