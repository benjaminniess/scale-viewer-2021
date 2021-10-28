<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NumberStoreController extends Controller
{
    public function store(Board $board, Request $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

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
