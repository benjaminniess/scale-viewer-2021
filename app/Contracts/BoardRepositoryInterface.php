<?php

namespace App\Contracts;

use App\Models\Board;
use Illuminate\Support\Collection;

interface BoardRepositoryInterface
{
    public function all(): Collection;

    public function findByID(int $boardId): Board;
}
