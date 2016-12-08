<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'carlo',
        'role' => 'admin',
        'email'    => 'carla-92-@hotmail.it',
        'password' => Hash::make('admin'),
    ));
}

}