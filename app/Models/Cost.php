<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_cost';
    // define primary key
    protected $primaryKey = 'cost_id';
    // define fillable
    protected $fillable = [
        'id_sales', 'tanggal', 'cost_nama','nominal','note',
    ];
}
