<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => "parul",
            'email' => "parulbajaj34@gmail.com",
            'remember_token' => 'first_entry',
            'password' => bcrypt('password'),
        ]);
    }
}
