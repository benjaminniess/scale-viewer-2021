<?php

namespace App\Http\Controllers\Boards;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardDeleteController extends Controller
{
    private BoardRepositoryInterface $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function delete(Board $board, Request $request): Response
    {
        if ($request->user()->cannot('delete', $board)) {
            abort(403);
        }

        $this->boardRepository->deleteById($board->id);

        return response('Board deleted.', 204);
    }
}
