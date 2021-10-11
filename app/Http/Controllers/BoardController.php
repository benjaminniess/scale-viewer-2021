<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    /**
     * @return Board[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Board::all();
    }
}
