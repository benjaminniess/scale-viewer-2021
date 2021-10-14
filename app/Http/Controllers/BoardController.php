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

    public function storeNumber(Board $board, Request $request)
    {
        $request->validate([
            'value' => ['required', 'max:15'],
            'description' => 'required',
        ]);

        $number = new Number();

        $number->value = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 201);
    }
}
