<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NumberUpdateController extends Controller
{
    public function update(Board $board, Number $number, Request $request): Response
    {
        if ($request->user()->cannot('update', $number)) {
            abort(403);
        }

        $request->validate([
            'value' => ['required', 'max:15'],
            'description' => 'required',
        ]);

        $number->value = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 200);
    }
}
