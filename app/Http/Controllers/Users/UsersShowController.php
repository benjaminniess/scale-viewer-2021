<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersShowController extends Controller
{
    public static function show(Request $request): User
    {
        return $request->user();
    }
}
