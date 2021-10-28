<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardUpdateController extends Controller
{
    public function update(Board $board, Request $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'max:90'],
            'description' => 'required',
        ]);

        $board->title = $request->title;
        $board->description = $request->description;

        $board->save();
        $board->refresh();

        return response($board, 200);
    }
}
