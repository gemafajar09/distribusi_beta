<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_cabang';
    // define primary key
    protected $primaryKey = 'id_cabang';
    // define fillable
    protected $fillable = [
        'nama_cabang', 'alamat', 'kode_cabang','telepon','email',
    ];
}
