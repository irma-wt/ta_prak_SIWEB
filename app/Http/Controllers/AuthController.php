<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        // Kalau sudah login, langsung ke home
        if (session()->has('user')) {
            return redirect()->route('home');
        }
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $valid_user = "irma";
        $valid_pass = "123";

        if ($request->username == $valid_user && $request->password == $valid_pass) {
            // Set session Laravel
            session(['user' => $request->username]);

            // Proses Remember Me
            $response = redirect()->route('home');
            if ($request->has('remember')) {
                $response = $response->cookie('username', $request->username, 60);
            } else {
                $response = $response->withoutCookie('username');
            }
            return $response;
        }

        // Login gagal
        return back()->with('error', 'Username atau Password salah!');
    }

    // Logout
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('home')->withoutCookie('username');
    }
}