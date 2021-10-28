<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BoardStoreController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'title' => ['required', 'max:90'],
            'description' => 'required',
        ]);

        $board = new Board();

        $board->title = $request->title;
        $board->description = $request->description;
        $board->user_id = Auth::id();

        $board->save();

        return response($board, 201);
    }
}
