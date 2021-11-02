<?php

namespace App\Providers;

use App\Contracts\BoardRepositoryInterface;
use App\Contracts\NumberRepositoryInterface;
use App\Http\Repositories\BoardRepository;
use App\Http\Repositories\NumberRepository;
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
        $this->app->bind(NumberRepositoryInterface::class, NumberRepository::class);
    }
}
