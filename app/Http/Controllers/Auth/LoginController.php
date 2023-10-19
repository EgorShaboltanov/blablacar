<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLoginForm(){
        return view('auth.methodLogin');
    }

    function showLoginFormEmail(){
        return view('auth.login');
    }

    function showHome(){
        return view('home');
    }


    public function loginEmailStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

             return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'Предоставленные учетные данные не соответствуют нашим записям',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

}
