<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el PartyUserSeeder");

        DB::table('parties_users')->insert(
            [
                [
                    'user_id' => 1,
                    'party_id' => 1,
                ],
                [
                    'name' => 2,
                    'id_game' => 2,
                ]
            ]
        );
    }
}
