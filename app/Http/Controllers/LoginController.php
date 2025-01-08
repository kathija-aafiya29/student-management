<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function index()
    {
        return view('pages.dashboard'); // Make sure this view exists
    }

}
