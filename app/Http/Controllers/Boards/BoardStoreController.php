<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardStoreRequest;
use App\Models\Board;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BoardStoreController extends Controller
{
    public function store(BoardStoreRequest $request): Response
    {
        $board = new Board();

        $board->title = $request->title;
        $board->description = $request->description;
        $board->user_id = Auth::id();

        $board->save();

        return response($board, 201);
    }
}
