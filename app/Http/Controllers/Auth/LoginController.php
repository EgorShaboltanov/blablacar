<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        

        $chatId = '5234014039'; // Замените на реальный Chat ID
        $token = '6862066323:AAE7DlrHFI-ctA5XvAIcbhEaH9Hx0h5TeME'; // Замените на токен вашего бота
        $message = 'Пользователь: ' . Auth::user()->name . ' зашел на сайт.';

        // Отправляем запрос к API Telegram
        $response = Http::post("https://api.telegram.org/bot$token/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        return redirect()->route('home');
    }

    return back()->withErrors([
        'password' => 'Предоставленные учетные данные не соответствуют нашим записям',
    ]);
}

    public function logout(Request $request)
    {

        $chatId = '5234014039'; // Замените на реальный Chat ID
        $token = '6862066323:AAE7DlrHFI-ctA5XvAIcbhEaH9Hx0h5TeME'; // Замените на токен вашего бота
        $message = 'Пользователь: ' . Auth::user()->name . ' вышел из учётной записи.';

           // Отправляем запрос к API Telegram
           $response = Http::post("https://api.telegram.org/bot$token/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

}
