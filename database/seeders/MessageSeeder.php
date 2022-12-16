<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el MessageSeeder");

        DB::table('messages')->insert(
            [
                [
                    'message' => 'soy un mensaje de la party 1',
                    'user_id' => 1,
                    'party_id' => 1,
                ],
                [
                    'message' => 'soy un mensaje de la party 2',
                    'user_id' => 1,
                    'party_id' => 2,
                ],
            ]
        );
    }
}
