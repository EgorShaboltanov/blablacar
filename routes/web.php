<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('layouts.main');
});

Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');

Route::get('/login/email',[LoginController::class, 'showLoginFormEmail'])->name('loginEmail');

Route::post('/login/email',[LoginController::class, 'loginEmailStore']);

Route::get('/home',[LoginController::class, 'ShowHome'])->name('home');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', function(){
    return view('auth.register');
})->name('register');


Route::get('/register/email', function(){
    return view('auth.email');
})->name('email');

Route::post('/register/email', [RegisterController::class, 'emailStore']);


Route::get('/register/name', function(){
    return view('auth.name');
})->name('name');

Route::post('/register/name', [RegisterController::class, 'nameStore']);

Route::get('/register/datebirth', function(){
    return view('auth.dateBirth');
})->name('dateBirth');

Route::post('/register/datebirth', [RegisterController::class, 'dateBirthStore']);

Route::get('/register/gender', function(){
    return view('auth.gender');
})->name('gender');

Route::post('/register/gender', [RegisterController::class, 'genderStore']);


Route::get('/register/password', function(){
    return view('auth.password');
})->name('password');

Route::post('/register/password', [RegisterController::class, 'passwordStore']);

Route::get('/register/phonenumber', function(){
    return view('auth.numberPhone');
})->name('numberPhone');

Route::post('/register/phonenumber', [RegisterController::class, 'phoneNumberAndRegistrationStore']);



Route::get('/register/success', [RegisterController::class, 'successRegistration'])->name('success');

// Route::get('/', function() {
//     \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot6862066323:AAE7DlrHFI-ctA5XvAIcbhEaH9Hx0h5TeME/setWebhook', [
//         'form_params' => [
//             'chat_id' => 5234014039,
//             'text' => 'Привет',
//         ],
//         'cert' => 'D:\php8\cacert.pem',
//     ]);
// });
