<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

    
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-submit', [AuthController::class, 'registerSubmit'])->name('register.submit');


Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('social.callback');