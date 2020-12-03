<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_gudang';
    // define primary key
    protected $primaryKey = 'id_gudang';
    // define fillable
    protected $fillable = [
        'nama_gudang','alamat_gudang','telepon_gudang','id_cabang'
    ];
}
