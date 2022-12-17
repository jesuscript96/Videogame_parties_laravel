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
                    'password' => '$2y$10$1H6oIAsO8WMA7nRt1YTXCOS58HTNJZv7Q7EYAAHTg96qh9a3VCXPC',
                    'mail' => "admin@admin.com",
                    'role' => true,
                ]
            ]
        );
    }
}
