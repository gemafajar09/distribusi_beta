<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_sales')->insert([
            'nama_sales'=>'zhaini',
            'alamat'=>'ulak karang',
            'telepon'=>'0751764764',
            'target'=>1000000,
            ]);
    }
}
