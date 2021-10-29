<?php

namespace App\Http\Controllers\Boards;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Repositories\BoardRepository;
use Illuminate\Support\Collection;

class BoardIndexController extends Controller
{
    private BoardRepositoryInterface $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function index(): Collection
    {
        return $this->boardRepository->all();
    }
}
