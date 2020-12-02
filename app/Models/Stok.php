<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'tbl_stok';
    // define primary key
    protected $primaryKey = 'stok_id';
    // define fillable
    protected $fillable = [
        'produk_id', 'jumlah', 'id_cabang', 'capital_price',
    ];

    public function produk()
    {
        return $this->hasOne("App\Models\Produk", "produk_id");
    }

    public function cabang()
    {
        return $this->hasOne("App\Models\Cabang", "id_cabang");
    }

    public function unit_produk()
    {
        return $this->hasMany("App\Models\Unit", "id_unit", "id_unit");
    }
}
