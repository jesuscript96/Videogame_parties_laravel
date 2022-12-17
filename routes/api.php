<?php

use App\Http\Controllers\userController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\gameController;
use App\Http\Controllers\partyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => ['jwt.auth']
], function () {
    // USER CRUD
    // Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/userlogout', [AuthController::class, 'userLogout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/users/parties/created', [userController::class, 'getPartiesFromUser']);
    Route::get('/users/games/created', [userController::class, 'getGamesFromUser']);
    // PARTY CRUD
    Route::post('/parties/newparty', [partyController::class, 'createParty']);
    Route::post('/parties/newuser/{id}', [partyController::class, 'addUserToParty']);
    Route::delete('/parties/deleteuser', [partyController::class, 'deleteUserFromParty']);
    // GAME CRUD
    Route::post('/games/newgame', [gameController::class, 'createGame']);
    // MESSAGE CRUD
    Route::post('/messages/newmessage', [messageController::class, 'createMessage']);
    Route::get('/messages/party/{id}', [partyController::class, 'getMessagesFromParty']);
});

Route::group([
    'middleware' => ['jwt.auth', 'isAdmin']
], function () {
    // USER CRUD
    Route::get('/allusers', [userController::class, 'getAllUsers']);
    Route::get('/users/all', [userController::class, 'getUsers']);
    Route::get('/users/{id}', [userController::class, 'getUsersById']);
    Route::put('/users/update', [userController::class, 'updateUsersById']);
    Route::delete('/users/delete/{id}', [userController::class, 'deleteUsersById']);
    // PARTY CRUD
    Route::put('/parties/update/{id}', [partyController::class, 'updatePartyById']);
    Route::delete('/parties/delete/{id}', [partyController::class, 'deletePartyById']);
    // MESSAGE CRUD
    Route::get('/messages/all', [messageController::class, 'getMessages']);
});


// USER CRUD

// Route::post('/users/newuser', [userController::class, 'createUser']);
Route::post('/users/register/newuser', [AuthController::class, 'registerUser']);
Route::post('/users/login/user', [AuthController::class, 'loginUser']);


// PARTY CRUD

Route::get('/parties/all', [partyController::class, 'getParties']);
Route::get('/parties/find/{id}', [partyController::class, 'getPartiesById']);


// GAME CRUD

Route::get('/games/all', [gameController::class, 'getPartiesFromGame']);
Route::get('/games/parties/{id}', [gameController::class, 'getGames']);
Route::get('/games/find/{id}', [gameController::class, 'getGameById']);


// MESSAGE CRUD

Route::get('/messages/find/{id}', [messageController::class, 'getMessageById']);