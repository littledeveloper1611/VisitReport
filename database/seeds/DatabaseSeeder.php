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
        // $this->call(UsersTableSeeder::class);
        $this->call(AreasDatabaseSeeder::class);
        $this->call(RoleDatabaseSeeder::class);
        $this->call(UsersDatabaseSeeder::class);
    }
}
