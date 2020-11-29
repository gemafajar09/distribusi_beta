<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrokenExpMovementTmp extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_broken_exp_tmp';
    // define primary key
    protected $primaryKey = 'id_broken_exp_tmp';
    // define fillable
    protected $fillable = [
        'inv_broken_exp', 'stok_id', 'produk_id', 'unit_1', 'unit_2', 'unit_3', 'id_user',
    ];
}