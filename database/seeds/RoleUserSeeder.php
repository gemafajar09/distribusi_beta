<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [["nama_role"=>"Pimpinan"],["nama_role"=>"Super Admin"],["nama_role"=>"Admin"]];
        DB::table('tbl_role_user')->insert($data);
    }
}
