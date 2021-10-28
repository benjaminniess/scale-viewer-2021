<?php

namespace App\Http\Controllers;

use App\Models\Board;

class BoardShowController extends Controller
{
    public function show(Board $board): Board
    {
        return $board;
    }
}
