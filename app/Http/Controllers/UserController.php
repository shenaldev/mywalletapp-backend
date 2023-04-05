<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Return user registation year
     */
    public function getRegisterYear()
    {
        $registerDate = Auth::user()->created_at;
        $year = explode('-', $registerDate);
        return response()->json(['year' => $year[0]], 200);
    }

}
