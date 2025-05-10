<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
Route::get('/createPost', [HomeController::class, 'createPost'])->name('createPost');

// Signup and Login routes
Route::get('/signup', [UsuariosController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [UsuariosController::class, 'register'])->name('signup.submit');

Route::get('/login',[UsuariosController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuariosController::class, 'login'])->name('login.submit');

Route::get('/home', function() {
    return view('home');
})->middleware('auth')->name('home');


// Perfil de usuario (autenticados)
Route::get('/userProfile', [UsuariosController::class, 'userProfile'])
    ->middleware('auth')
    ->name('user.profile');

Route::post('/logout', [UsuariosController::class, 'logout'])
    ->name('logout');