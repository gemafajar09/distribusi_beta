<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_unit';
    // define primary key
    protected $primaryKey = 'id_unit';
    // define fillable
    protected $fillable = [
        'produk_id','maximum_unit_name','minimum_unit_name','default_value','note',
    ];
}
