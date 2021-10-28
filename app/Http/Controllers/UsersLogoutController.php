<?php

namespace App\Http\Controllers;

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
