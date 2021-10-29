<?php

namespace App\Http\Controllers\Boards;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardStoreRequest;
use App\Models\Board;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BoardStoreController extends Controller
{
    private BoardRepositoryInterface $boardRepository;
    
    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function store(BoardStoreRequest $request): Response
    {
        $board = $this->boardRepository->store([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return response($board, 201);
    }
}
