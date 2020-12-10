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
        'produk_id', 'id_gudang_dari', 'id_gudang_tujuan', 'movement_date', 'note','jumlah_broken','stok_id','status_broken','id_cabang','inv_broken_exp'
    ];
    protected $attributes = [
        'status_broken'=>'0',
    ];
}
