<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_type_produk';
    // define primary key
    protected $primaryKey = 'id_type_produk';
    // define fillable
    protected $fillable = [
        'nama_type_produk',
    ];

    public function produk()
    {
        return $this->belongsTo("App\Models\Produk", "id_type_produk", "id_type_produk");
    }
}
