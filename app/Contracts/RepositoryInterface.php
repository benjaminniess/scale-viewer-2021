<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;

    public function findByID(int $modelId): Model;

    public function deleteById(int $modelId): void;

    public function store(array $modelProperties): Model;

    public function update(int $modelId, array $modelProperties): Model;
}
