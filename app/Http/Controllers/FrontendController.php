<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function terms_conditions()
    {
        return view('pages.terms-conditions');
    }

    public function privacy_policy()
    {
        return view('pages.privacy-policy');
    }
}
