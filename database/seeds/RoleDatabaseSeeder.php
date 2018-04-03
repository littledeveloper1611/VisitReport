<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Director';
        $role->save();

        $role = new Role();
        $role->name = 'Sales Manager';
        $role->save();

        $role = new Role();
        $role->name = 'Salesman';
        $role->save();
    }
}
