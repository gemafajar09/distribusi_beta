<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_type_produk')->insert([
            'nama_type_produk'=>'Makanan',
            
            ]);
    }
}
