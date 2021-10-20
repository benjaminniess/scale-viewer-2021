<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{

    public function index()
    {
        return Board::without('numbers')->get();
    }

    public function show(Board $board): Board
    {
        return $board;
    }

    public function store(Request $request)
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

    public function update(Board $board, Request $request)
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'max:90'],
            'description' => 'required',
        ]);

        $board->title = $request->title;
        $board->description = $request->description;

        $board->save();
        $board->refresh();

        return response($board, 200);
    }

    public function delete(Board $board, Request $request)
    {
        if ($request->user()->cannot('delete', $board)) {
            abort(403);
        }

        $board->delete();

        return response('Board deleted.', 204);
    }
}
