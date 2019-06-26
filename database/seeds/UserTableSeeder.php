<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'superuser',
            'email' => 'admin@esl.com',
            'password' => bcrypt('Qwerty123!')
        ]);
    }
}
