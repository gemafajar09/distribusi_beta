<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_customer';
    // define primary key
    protected $primaryKey = 'id_customer';
    // define fillable
    protected $fillable = [
        'nama_customer','nama_perusahaan','credit_plafond','alamat','negara','kota','telepon','kartu_kredit','fax','id_sales','note',
    ];
}
