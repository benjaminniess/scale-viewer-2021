<?php

namespace App\Contracts;

use App\Models\Board;
use Illuminate\Support\Collection;

interface BoardRepositoryInterface
{
    public function all(): Collection;

    public function findByID(int $boardId): Board;

    public function deleteById(int $boardId): void;

    public function store(array $boardProperties): Board;

    public function update(int $boardId, array $boardProperties): Board;
}
