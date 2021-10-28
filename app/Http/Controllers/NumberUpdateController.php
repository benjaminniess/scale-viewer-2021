<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumberUpdateRequest;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Response;

class NumberUpdateController extends Controller
{
    public function update(Board $board, Number $number, NumberUpdateRequest $request): Response
    {
        if ($request->user()->cannot('update', $number)) {
            abort(403);
        }

        $number->value = $request->value;
        $number->description = $request->description;

        $board->numbers()->save($number);
        $board->refresh();

        return response($board, 200);
    }
}
