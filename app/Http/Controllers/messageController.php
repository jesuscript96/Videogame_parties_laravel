<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class messageController extends Controller
{
    public function getMessages()
    {

        Log::info('getting all Messages');

        try {

            // $Messages = DB::select('select * from Messages');
            // $Messages = DB::table('Messages')->get();

            $messages = Message::query()->get();

            return response([
                'success' => true,
                'message' => 'all Messages retrieved successfully',
                'data' => $messages
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar los Messages'
            ], 500);

        }

    }

    public function getMessageById($id)
    {
        Log::info('getting Message by id');

        try {

            $message = Message::query()->find($id);
            return response([
                'success' => true,
                'message' => 'Message retrieved successfully',
                'data' => $message
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar el Message'
            ], 500);
        }
    }

    public function createMessage(Request $request)
    {


        Log::info('creating Message');

        try {

            $validator = Validator::make($request->all(), [
                'message' => 'required',
                'party_id' => 'required'

            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $message = $request->input('message');
            $user_id = auth()->user()->id;
            $party_id = $request->input('party_id');

            $newMessage = new Message();
            $newMessage->message = $message;
            $newMessage->user_id = $user_id;
            $newMessage->party_id = $party_id;
            $newMessage->save();

            return response([
                'success' => true,
                'message' => 'Message crated successfully',
                'data' => $newMessage
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se ha podido crear el Message'
            ], 500);
        }
    }
}