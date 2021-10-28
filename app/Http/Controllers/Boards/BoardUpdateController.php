<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardUpdateRequest;
use App\Models\Board;
use Illuminate\Http\Response;

class BoardUpdateController extends Controller
{
    public function update(Board $board, BoardUpdateRequest $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $board->title = $request->title;
        $board->description = $request->description;

        $board->save();
        $board->refresh();

        return response($board, 200);
    }
}
