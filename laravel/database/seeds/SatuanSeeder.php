<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_satuan')->insert([
            'nama_satuan'=>'PIECES',
            'keterangan_satuan'=>'PIECES',
            ]);
    }
}
