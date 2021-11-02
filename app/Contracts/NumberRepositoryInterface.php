<?php

namespace App\Contracts;

use App\Models\Board;
use App\Models\Number;
use Illuminate\Support\Collection;

interface NumberRepositoryInterface
{
    public function all(): Collection;

    public function findByID(int $numberId): Number;

    public function deleteById(int $numberId): void;

    public function store(Board $board, array $numberProperties): Number;

    public function update(int $numberId, array $numberProperties): Board;
}
