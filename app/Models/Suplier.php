<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_suplier';
    // define primary key
    protected $primaryKey = 'id_suplier';
    // define fillable
    protected $fillable = [
        'nama_suplier', 'nama_perusahaan', 'alamat','kota','negara','telepon','fax','bank','no_akun','nama_akun','note',
    ];
}
