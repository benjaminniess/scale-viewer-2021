<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumberStoreRequest;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Response;

class NumberStoreController extends Controller
{
    public function store(Board $board, NumberStoreRequest $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $number = new Number();

        $number->value = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 201);
    }
}
