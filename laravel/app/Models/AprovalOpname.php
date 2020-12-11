<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AprovalOpname extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_aproval_opname';
    // define primary key
    protected $primaryKey = 'id_aproval_opname';
    // define fillable
    protected $fillable = [
        'id_opname','stok_id','jumlah_fisik','date_adjust','status'
    ];
    protected $attributes = [
        'status'=>'0',
    ];
}
