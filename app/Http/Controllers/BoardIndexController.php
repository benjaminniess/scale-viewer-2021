<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Database\Eloquent\Collection;

class BoardIndexController extends Controller
{

    public function index(): Collection
    {
        return Board::without('numbers')->get();
    }
}
