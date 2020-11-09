<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_brand';
    // define primary key
    protected $primaryKey = 'id_brand';
    // define fillable
    protected $fillable = [
        'nama_brand',
    ];
}
