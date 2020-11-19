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
        $data = ["nama_user"=>"Admin","username"=>"admin","password"=>Hash::make('admin123'),"level"=>"3","telepon"=>"0751767435","email"=>"bilhaqi2806@gmail.com","id_cabang"=>1];
        DB::table('tbl_user')->insert($data);
    }
}
