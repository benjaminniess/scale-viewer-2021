<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumberController extends Controller
{
    public function store(Board $board, Request $request)
    {
        if ($board->user->id !== Auth::id()) {
            return response('wrong user', 401);
        }

        $request->validate([
            'value'       => ['required', 'max:15'],
            'description' => 'required',
        ]);

        $number = new Number();

        $number->value       = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 201);
    }

    public function update(Board $board, Number $number, Request $request)
    {
        if ($board->user->id !== Auth::id()) {
            return response('wrong user', 401);
        }

        $request->validate([
            'value'       => ['required', 'max:15'],
            'description' => 'required',
        ]);

        $number->value       = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 200);
    }
}
