<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin == 1) {
                return redirect()->intended('admin/user');
            }
            return redirect()->intended('dashboard');
        }

        return back()->with('message', 'The provided credentials do not match our records.', );
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'https://lh3.googleusercontent.com/proxy/wDATN6gp5Z6xmwjogOL_9kmTDgM5LS4YXc9WO48kMljB3PCWp4ZV2VqaVSPYkjFn3TnNaUThjuHlgtD-oPyHWdY1FL9x-7dstRKFdl-KFDjRjH9xQ9sY13yzx9Rn-899oEi_',
            'is_admin' => '0'
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
