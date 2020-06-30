<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::user()->hasRole('admin')) {
            $this->redirectTo = route('admin.users.index');

            return $this->redirectTo;
        }

        $this->redirectTo = RouteServiceProvider::HOME;
        return $this->redirectTo;
    }
}
