<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el GameSeeder");

        DB::table('games')->insert(
            [
                [
                    'title' => 'FIFA',
                    'tb_url' => 'https//meloinvento1.com',
                    'url' => "https//meloinvento2.com",
                    'user_id' => 1 
                ],
                [
                    'title' => 'RDR',
                    'tb_url' => 'https//melotramo1.com',
                    'url' => "https//melotramo2.com",
                    'user_id' => 2
                ]
            ]
        );
    }
}
