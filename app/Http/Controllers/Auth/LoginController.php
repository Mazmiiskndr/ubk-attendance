<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login page.
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('backend.dashboard')
                ->with('auth', 'You are already logged in!');
        }
        $pageConfigs = ['myLayout' => 'blank'];
        return view('pages.auth.login', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Logs out the currently authenticated user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah berhasil keluar');
    }
}
