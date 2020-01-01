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
        // Run Role table seeder
        $this->call(RoleTableSeeder::class);

        // Run user table seeder
        $this->call(UserTableSeeder::class);
    }
}
