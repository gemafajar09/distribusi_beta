<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [["nama_cabang"=>"Cabang Utama","alamat"=>"Jln Sarang Gagak","kode_cabang"=>"99973","telepon"=>"0751767435","email"=>"cabangutama@gmail.com"],["nama_cabang"=>"Cabang Dua","alamat"=>"Jln Sarang Gagak","kode_cabang"=>"99973","telepon"=>"0751767435","email"=>"cabangdua@gmail.com"]];
        DB::table('tbl_cabang')->insert($data);
    }
}
