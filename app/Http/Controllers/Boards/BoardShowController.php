<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Models\Board;

class BoardShowController extends Controller
{
    public function show(Board $board): Board
    {
        return $board;
    }
}
