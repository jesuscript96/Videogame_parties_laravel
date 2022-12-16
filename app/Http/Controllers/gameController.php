<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Support\Facades\Validator;

use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class gameController extends Controller
{
    public function getGames()
    {

        Log::info('getting all games');

        try {

            // $games = DB::select('select * from games');
            // $games = DB::table('games')->get();

            $games = Game::query()->get();

            return response([
                'success' => true,
                'message' => 'all games retrieved successfully',
                'data' => $games
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar los games'
            ], 500);

        }

    }

    public function getGameById($id)
    {
        Log::info('getting game by id');

        try {

            $game = Game::query()->find($id);
            return response([
                'success' => true,
                'message' => 'game retrieved successfully',
                'data' => $game
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el game'
            ], 500);
        }
    }

    public function createGame(Request $request)
    {

        dump(($request));

        Log::info('creating game');


        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'tb_url' => 'required',
                'url' => 'required'

            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $title = $request->input('title');
            $tb_url = $request->input('tb_url');
            $url = $request->input('url');
            $user_id = auth()->user()->id;

            $newgame = new game();
            $newgame->title = $title;
            $newgame->tb_url = $tb_url;
            $newgame->url = $url;
            $newgame->user_id = $user_id;
            $newgame->save();

            return response([
                'success' => true,
                'message' => 'game crated successfully',
                'data' => $newgame
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido crear el game'
            ], 500);
        }
    }

    public function getPartiesFromGame($id)
    {
        Log::info('getting game parties by id');

        try {

            // $parties = DB::select(`select * from bitnami_myapp.users join bitnami_myapp.parties where parties.user_id = 1`);
            // $parties = DB::select(`select * from users join parties where parties.id = 1`);

            $parties = Party::where(function ($query) {
                $query
                    ->select('*')
                    ->from('games')
                    ->whereColumn('parties.game_id', 'games.id');
            }, $id)->get();



            return response([
                'success' => true,
                'message' => 'game parties retrieved successfully',
                'data' => $parties
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el game parties'
            ], 500);
        }
    }
}