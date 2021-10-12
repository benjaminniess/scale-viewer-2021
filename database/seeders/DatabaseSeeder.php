<?php

namespace Database\Seeders;


use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Board::factory()->count(10)->for(User::factory())->create();
    }
}
