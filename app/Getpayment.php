<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Getpayment extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_getpayment';
    protected $primaryKey = 'id_getpayment ';
    protected $fillable = [
        'invoice_id','tgl_payment', 'payment', 'status'
    ];
}
