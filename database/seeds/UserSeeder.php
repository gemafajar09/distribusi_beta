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
        $data = [["nama_user"=>"Lorem Pimpinan","username"=>"pimpinan","password"=>Hash::make('123'),"level"=>"1","telepon"=>"0751767435","email"=>"pimpinan@gmail.com","id_cabang"=>1],["nama_user"=>"Lorem Kepala Cabang","username"=>"superadmin","password"=>Hash::make('123'),"level"=>"2","telepon"=>"0751767435","email"=>"kepalacabang@gmail.com","id_cabang"=>1],["nama_user"=>"Lorem Admin Cabang","username"=>"admin","password"=>Hash::make('123'),"level"=>"3","telepon"=>"0751767435","email"=>"admincabang@gmail.com","id_cabang"=>1]];
        DB::table('tbl_user')->insert($data);
    }
}
