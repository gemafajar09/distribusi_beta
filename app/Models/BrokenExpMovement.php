<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrokenExpMovement extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_broken_exp';
    // define primary key
    protected $primaryKey = 'id_broken_exp';
    // define fillable
    protected $fillable = [
        'produk_id', 'id_gudang_dari', 'id_gudang_tujuan', 'movement_date', 'note', 'id_user',
    ];
}
