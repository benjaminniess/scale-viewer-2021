<?php

namespace App\Providers;

use App\Contracts\BoardRepositoryInterface;
use App\Http\Repositories\BoardRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
    }
}
