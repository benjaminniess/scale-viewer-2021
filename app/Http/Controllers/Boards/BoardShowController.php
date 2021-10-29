<?php

namespace App\Http\Controllers\Boards;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Board;

class BoardShowController extends Controller
{
    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function show(int $boardID): Board
    {
        return $this->boardRepository->findByID($boardID);
    }
}
