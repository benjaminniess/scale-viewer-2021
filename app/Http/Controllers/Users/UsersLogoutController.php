<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersLogoutController extends Controller
{
    public static function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response('logged-out', 200);
    }
}
