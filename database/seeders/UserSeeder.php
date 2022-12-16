<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el UserSeeder");

        DB::table('users')->insert(
            [
                [
                    'name' => 'user',
                    'nickname' => 'usernickuser',
                    'password' => 'jesuprobando',
                    'mail' => "user@user.com",
                    'role' => false,
                ],
                [
                    'name' => 'admin',
                    'nickname' => 'usernickuser',
                    'password' => 'pruebasprobando',
                    'mail' => "user@user.com",
                    'role' => true,
                ]
            ]
        );
    }
}
