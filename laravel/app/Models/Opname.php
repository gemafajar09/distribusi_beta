<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_opname';
    // define primary key
    protected $primaryKey = 'id_opname';
    // define fillable
    protected $fillable = [
        'stok_id','jumlah_fisik','balance','update_opname',
    ];
}
