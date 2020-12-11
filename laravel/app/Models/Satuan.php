<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_satuan';
    // define primary key
    protected $primaryKey = 'id_satuan';
    // define fillable
    protected $fillable = [
        'nama_satuan', 'keterangan_satuan',
    ];
}
