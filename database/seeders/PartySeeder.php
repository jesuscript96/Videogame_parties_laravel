<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el PartySeeder");

        DB::table('parties')->insert(
            [
                [
                    'name' => 'GRUPO FIFA',
                    'game_id' => 1,
                    'user_id' => 1,
                ],
                [
                    'name' => 'GRUPO RDR',
                    'game_id' => 2,
                    'user_id' => 2,
                ]
            ]
        );
    }
}
