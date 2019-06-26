<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([

            [
                'user_id' => null,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'cwafGrDMX8EQcG3KYMx1GNzcGR487HKS0iwDMCKi',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => null,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'HrL7T4xOjwMo2bfvGaF154juddb1HMdzlRGlQIGa',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
         $this->call(RoleSeeder::class);
         $this->call(UserTableSeeder::class);
//        factory(\App\User::class, 5)->create();
    }
}
