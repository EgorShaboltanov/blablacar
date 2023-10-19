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

Route::get('/register/password', function(){
    return view('auth.password');
})->name('password');

Route::post('/register/password', [RegisterController::class, 'passwordStoreAndRegistation']);

Route::get('/register/success', function(){
    return view('auth.password');
})->name('password');

Route::get('/register/success', [RegisterController::class, 'successRegistration'])->name('success');
