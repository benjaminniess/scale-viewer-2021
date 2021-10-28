<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Response;

class BoardIndexController extends Controller
{

    public function index(): Response
    {
        return Board::without('numbers')->get();
    }
}
