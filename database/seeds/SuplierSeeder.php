<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_suplier')->insert([
            'nama_suplier'=>'Heru Firdaus',
            'nama_perusahaan'=>'PT Angkasa Pura II',
            'alamat'=>'Padang Pariaman',
            'negara'=>'indonesia',
            'kota'=>'Pariaman',
            'telepon'=>'075176421',
            'fax'=>'1111',
            'bank'=>'BNI',
            'no_akun'=>'08273',
            'nama_akun'=>'heru',
            'note'=>'Suplier Royal',
            'id_cabang'=>1
            ]);
    }
}
