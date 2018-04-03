<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<=10; $i++){
        	$user = new User();
		    $user->name = "user".$i;
		    $user->email = "user". $i . "@gmail.com";
		    $user->password = bcrypt("secret");
		    $user->role_id = rand(1, 3);
		    $user->save();
        }
    }
}
