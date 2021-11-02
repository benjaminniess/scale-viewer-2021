<?php

namespace App\Contracts;

use App\Models\Board;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface NumberRepositoryInterface
{
    public function all(): Collection;

    public function findByID(int $modelId): Model;

    public function deleteById(int $modelId): void;

    public function store(Board $board, array $modelProperties): Model;

    public function update(int $modelId, array $modelProperties): Model;
}
