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
        $this->call(RolesOneSeeder::class);
        $this->call(BaseSeeder::class);
        //$this->call(LocalSeeder::class);
    }
}
