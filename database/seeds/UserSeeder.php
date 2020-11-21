<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ["nama_user"=>"Bil Haqi","username"=>"pimpinan","password"=>Hash::make('pimpinan123'),"level"=>"1","telepon"=>"0751767435","email"=>"pimpinan@gmail.com","id_cabang"=>1];
        DB::table('tbl_user')->insert($data);
    }
}
