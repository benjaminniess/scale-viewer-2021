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
        if ($request->user()->cannot('update', $board)) {
            abort(403);
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
        if ($request->user()->cannot('update', $number)) {
            abort(403);
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

    public function delete(Board $board, Number $number, Request $request)
    {
        if ($request->user()->cannot('delete', $number)) {
            abort(403);
        }

        $number->delete();

        return response('Number deleted', 204);
    }
}
