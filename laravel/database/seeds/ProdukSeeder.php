<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            # code...
            DB::table('tbl_produk')->insert([
            'id_type_produk'=>1,
            'produk_brand'=>'MAYORA',
            'produk_nama'=>'Coca Cola',
            'produk_harga'=>25000,
            'stok'=>100
            ]);
        
    }
}
