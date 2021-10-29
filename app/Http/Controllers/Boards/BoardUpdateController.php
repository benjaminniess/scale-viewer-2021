<?php

namespace App\Http\Controllers\Boards;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardUpdateRequest;
use App\Models\Board;
use Illuminate\Http\Response;

class BoardUpdateController extends Controller
{
    private BoardRepositoryInterface $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function update(Board $board, BoardUpdateRequest $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $board = $this->boardRepository->update($board->id, [
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response($board, 200);
    }
}
