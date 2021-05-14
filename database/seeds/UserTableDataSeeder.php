<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Demo Admin',
            'user_type' => 'admin',
            'email' => 'demoadmin@gmail.com',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'Demo User',
            'user_type' => 'user',
            'email' => 'demouser@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
