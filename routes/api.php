<?php

use App\Http\Controllers\NumberUpdateController;
use \App\Http\Controllers\NumberStoreController;
use \App\Http\Controllers\NumberDeleteController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UsersShowController;
use App\Http\Controllers\UsersLoginController;
use App\Http\Controllers\UsersLogoutController;
use App\Http\Controllers\BoardDeleteController;
use App\Http\Controllers\BoardIndexController;
use App\Http\Controllers\BoardShowController;
use App\Http\Controllers\BoardStoreController;
use App\Http\Controllers\BoardUpdateController;

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

Route::middleware('auth:sanctum')->get('/user', [UsersShowController::class, 'show']);
Route::middleware('guest')->post('/register', [RegisteredUserController::class, 'store']);
Route::middleware('guest')->post('/login', [UsersLoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('/logout', [UserslogoutController::class, 'logout']);

Route::get('boards', [BoardIndexController::class, 'index']);
Route::get('boards/{board}', [BoardShowController::class, 'show']);

Route::middleware('auth:sanctum')->post('boards', [BoardStoreController::class, 'store']);
Route::middleware('auth:sanctum')->post('boards/{board}/numbers', [NumberStoreController::class, 'store']);

Route::middleware('auth:sanctum')->put('boards/{board}', [BoardUpdateController::class, 'update']);
Route::middleware('auth:sanctum')->put('boards/{board}/numbers/{number}', [NumberUpdateController::class, 'update']);

Route::middleware('auth:sanctum')->delete('boards/{board}', [BoardDeleteController::class, 'delete']);
Route::middleware('auth:sanctum')->delete('boards/{board}/numbers/{number}', [NumberDeleteController::class, 'delete']);
