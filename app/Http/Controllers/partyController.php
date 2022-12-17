<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class partyController extends Controller
{
    public function getParties()
    {

        Log::info('getting all parties');

        try {

            // $partys = DB::select('select * from partys');
            $parties = DB::table('partys')->get();

            // $parties = Party::query()->get();

            return response([
                'success' => true,
                'message' => 'all parties retrieved successfully',
                'data' => $parties
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar las parties'
            ], 500);

        }

    }

    public function getPartiesById($id)
    {
        Log::info('getting party by id');

        try {

            $party = DB::table('partys')->find($id);
            return response([
                'success' => true,
                'message' => 'party retrieved successfully',
                'data' => $party
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido recuperar el party'
            ], 500);
        }
    }

    public function createParty(Request $request)
    {

        dump(($request));

        Log::info('creating party');

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'game_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $name = $request->input('name');
            $game_id = $request->input('game_id');
            $user_id = auth()->user()->id;

            $newParty = new Party();
            $newParty->name = $name;
            $newParty->game_id = $game_id;
            $newParty->user_id = $user_id;
            $newParty->save();

            return response([
                'success' => true,
                'message' => 'party crated successfully',
                'data' => $newParty
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido crear el party'
            ], 500);
        }
    }

    public function updatePartyById(Request $request, $id)
    {

        Log::info('updating party by id');

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'game_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $party = Party::query()->find($id);

            $party->name = $request->input('name');
            $party->save();

            return response([
                'success' => true,
                'message' => 'party updated successfully',
                'data' => $party
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido modificar el party'
            ], 500);
        }
    }

    public function deletePartyById($id)
    {
        Log::info('deleting party by id');

        try {

            $party = Party::query()->find($id);
            $party->delete();

            return response([
                'success' => true,
                'message' => 'party deleted successfully',
                'data' => $party
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido borrar el party'
            ], 500);
        }
    }

    public function getMessagesFromParty($id)
    {
        Log::info('getting party messages');

        try {

            // $parties = DB::select(`* from bitnami_myapp.messages join bitnami_myapp.parties where messages.party_id = $id`);
            // $parties = DB::select(`* from messages join parties where party_id = $id`);

            // $parties = Message::where(function ($query) {
            //     $query
            //         ->whereColumn('part_id');
            // }, $id)->get();

            $messages = DB::table('messages')
                ->where('party_id', '=', $id)
                ->get();



            return response([
                'success' => true,
                'message' => 'party messages retrieved successfully',
                'data' => $messages
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar los party messages'
            ], 500);
        }
    }

    public function addUserToParty($id)
    {

        try {
            $user_id = auth()->user()->id;
            $partyId = $id;
            $party = Party::find($partyId);

            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => 'No existe party.'
                ], 404);
            }

            DB::table('parties_users')->insert([
                'user_id' => $user_id,
                'party_id' => $partyId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Se ha añadido el usuario a la party'
            ], 200);
        } catch (\Throwable $th) {
            Log::error("Error añadiendo el usuario a la party: " . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ups, ha ocurrido un error'
            ], 500);
        }
    }

    public function deleteUserFromParty($id)
    {

        try {
            $user_id = auth()->user()->id;
            $partyId = $id;
            $party = Party::find($partyId);

            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => 'No existe party.'
                ], 404);
            }

            $party->users()->detach($user_id);

            return response()->json([
                'success' => true,
                'message' => 'Se ha eliminado el usuario a la party'
            ], 200);
        } catch (\Throwable $th) {
            Log::error("Error eliminando el usuario de la party: " . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ups, ha ocurrido un error'
            ], 500);
        }
    }
}