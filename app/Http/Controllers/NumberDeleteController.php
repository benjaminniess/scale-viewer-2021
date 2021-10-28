<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NumberDeleteController extends Controller
{
    public function delete(Board $board, Number $number, Request $request): Response
    {
        if ($request->user()->cannot('delete', $number)) {
            abort(403);
        }

        $number->delete();

        return response('Number deleted', 204);
    }
}
