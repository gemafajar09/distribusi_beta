<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_customer')->insert([
            'nama_customer'=>'Theo',
            'nama_perusahaan'=>'PT Pelindo II',
            'credit_plafond'=>250000,
            'alamat'=>'Teluk Bayur',
            'negara'=>'indonesia',
            'kota'=>'Padang',
            'telepon'=>'075176421',
            'kartu_kredit'=>'92873',
            'fax'=>'1111',
            'id_sales'=>1,
            'note'=>'customer setia',
            'id_cabang'=>1
            ]);
    }
}
