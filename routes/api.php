<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BoardController;

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

Route::middleware('auth:sanctum')->get('/user', [UsersController::class, 'show']);
Route::middleware('guest')->post('/register', [RegisteredUserController::class, 'store']);
Route::middleware('guest')->post('/login', [UsersController::class, 'login']);
Route::middleware('auth:sanctum')->get('/logout', [UsersController::class, 'logout']);

Route::get('boards', [BoardController::class, 'index']);
Route::get('boards/{board}', [BoardController::class, 'show']);

Route::middleware('auth:sanctum')->post('boards', [BoardController::class, 'store']);
Route::middleware('auth:sanctum')->post('boards/{board}/numbers', [BoardController::class, 'storeNumber']);

Route::middleware('auth:sanctum')->put('boards/{board}', [BoardController::class, 'update']);
