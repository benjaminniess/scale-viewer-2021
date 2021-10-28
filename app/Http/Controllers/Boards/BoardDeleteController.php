<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardDeleteController extends Controller
{
    public function delete(Board $board, Request $request): Response
    {
        if ($request->user()->cannot('delete', $board)) {
            abort(403);
        }

        $board->delete();

        return response('Board deleted.', 204);
    }
}
