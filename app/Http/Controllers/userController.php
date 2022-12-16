<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Party;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function getUsers()
    {

        Log::info('getting all users');

        try {

            // $users = DB::select('select * from users');
            // $users = DB::table('users')->get();

            $users = User::query()->get();

            return response([
                'success' => true,
                'message' => 'all tasks retrieved successfully',
                'data' => $users
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar los users'
            ], 500);

        }

    }

    public function getAllUsers()
    {
        Log::info('getting all users');

        try {
            // $users = DB::select('select * from users');
            // $users = DB::table('users')->get();

            $users = User::query()->get();

            return response([
                'success' => true,
                'message' => 'all users retrieved successfully',
                'data' => $users
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar los users'
            ], 500);

        }

    }

    public function getUsersById($id)
    {
        Log::info('getting user by id');

        try {

            $user = User::query()->find($id);
            return response([
                'success' => true,
                'message' => 'user retrieved successfully',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el user'
            ], 500);
        }
    }

    public function createUser(Request $request)
    {

        dump(($request));

        Log::info('creating user');

        try {


            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'nickname' => 'required',
                'mail' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $name = $request->input('name');
            $nickname = $request->input('nickname');
            $mail = $request->input('mail');

            $newUser = new User();
            $newUser->name = $name;
            $newUser->nickname = $nickname;
            $newUser->mail = $mail;
            $newUser->save();

            return response([
                'success' => true,
                'message' => 'user crated successfully',
                'data' => $newUser
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido crear el user'
            ], 500);
        }
    }

    public function updateUsersById(Request $request, $id)
    {

        Log::info('updating user by id');

        try {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'nickname' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $user = User::query()->find($id);

            $user->name = $request->input('name');
            $user->nickname = $request->input('nickname');
            $user->save();

            return response([
                'success' => true,
                'message' => 'user updated successfully',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido modificar el user'
            ], 500);
        }
    }

    public function deleteUsersById($id)
    {
        Log::info('deleting user by id');

        try {

            $user = User::query()->find($id);
            $user->delete();

            return response([
                'success' => true,
                'message' => 'user deleted successfully',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido borrar el user'
            ], 500);
        }
    }

    public function getPartiesFromUser()
    {
        Log::info('getting user parties by id');

        try {

            // $parties = DB::select(`select * from bitnami_myapp.users join bitnami_myapp.parties where parties.user_id = 1`);
            // $parties = DB::select(`select * from users join parties where parties.id = 1`);

            $user_id = auth()->user()->id;

            $parties = Party::where(function ($query) {
                $query
                ->select('*')
                    ->from('users')
                    ->whereColumn('parties.user_id', 'users.id');
            }, $user_id)->get();



            return response([
                'success' => true,
                'message' => 'user parties retrieved successfully',
                'data' => $parties
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el user parties'
            ], 500);
        }
    }

    public function getGamesFromUser()
    {
        Log::info('getting user games by id');

        try {

            // $parties = DB::select(`select * from bitnami_myapp.users join bitnami_myapp.parties where parties.user_id = 1`);
            // $parties = DB::select(`select * from users join parties where parties.id = 1`);

            $user_id = auth()->user()->id;

            $games = Game::where(function ($query) {
                $query
                ->select('*')
                    ->from('users')
                    ->whereColumn('games.user_id', 'users.id');
            }, $user_id)->get();



            return response([
                'success' => true,
                'message' => 'user games retrieved successfully',
                'data' => $games
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el user games'
            ], 500);
        }
    }
}