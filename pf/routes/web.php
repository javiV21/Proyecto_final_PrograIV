<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\HistoriasController;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/

// Landing / info general
Route::get('/', [HomeController::class, 'index'])
    ->name('index');

// Registro
Route::get('/signup', [UsuariosController::class, 'showSignupForm'])
    ->name('signup');
Route::post('/signup', [UsuariosController::class, 'register'])
    ->name('signup.submit');

// Login
Route::get('/login', [UsuariosController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [UsuariosController::class, 'login'])
    ->name('login.submit');

/*
|----------------------------------
| Rutas protegidas (requieren auth)
|----------------------------------
*/
Route::middleware('auth')->group(function () {

    // Feed de historias
    Route::get('/home', [HistoriasController::class, 'index'])
        ->name('home');

    // Crear historia
    Route::get('/createPost', [HistoriasController::class, 'create'])
        ->name('createPost');
    Route::post('/createPost', [HistoriasController::class, 'store'])
        ->name('historias.store');

    // Perfil
    Route::get('/userProfile', [UsuariosController::class, 'userProfile'])
        ->name('user.profile');

    // Logout
    Route::post('/logout', [UsuariosController::class, 'logout'])
        ->name('logout');

    // CRUD Categorías (si las gestionas)
    Route::resource('categorias', CategoriasController::class)
        ->except(['show']);
});

/*
|----------------------------------
Nota: Hay un bus que solo se muestran los 2 primeros post mas recientes
|----------------------------------
No es falla del doom, sino creo que de la view, o es un bug menor,
pero no afecta a la funcionalidad como tal, pero ya veremos
como lo solucionamos
*/