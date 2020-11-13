<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_user';
    // define primary key
    protected $primaryKey = 'id_user';
    // define fillable
    protected $fillable = [
        'nama_user','username','password','level','telepon','email','id_cabang',
    ];
}
