<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CabangSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(SalesSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(SuplierSeeder::class);
        $this->call(TipeSeeder::class);
        $this->call(GudangSeeder::class);
    }
}
