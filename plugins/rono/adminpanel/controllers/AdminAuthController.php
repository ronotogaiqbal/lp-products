<?php namespace Rono\AdminPanel\Controllers;

use Backend\Classes\Controller;
use Rono\AdminPanel\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class AdminAuthController extends Controller
{
    public function login()
    {
        $error = Request::query('error');
        return view('rono.adminpanel::login', ['error' => $error]);
    }

    public function authenticate()
    {
        $username = Request::input('username');
        $password = Request::input('password');

        $user = User::where('username', $username)->first();

        if ($user && $user->password === $password) {
            // Redirect to dashboard
            return Redirect::to('backend/rono/adminpanel/dashboard');
        } else {
            // Redirect back with error
            return Redirect::to('backend/rono/adminpanel/auth/login?error=Invalid credentials');
        }
    }

    public function dashboard()
    {
        // Dashboard view
        return view('rono.adminpanel::dashboard');
    }
}
