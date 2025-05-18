<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\HistoriasController;
use App\Http\Controllers\ComentariosController;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/

// Landing / info general
Route::get('/', [HomeController::class, 'index'])
    ->name('index');

// Policies
Route::get('/policies', [HomeController::class, 'showPolicies'])
    ->name('policies');

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

    // Ver historia
    Route::get('/historias/{historia}', [HistoriasController::class, 'show'])
        ->name('historias.show');
    // Crear comentario
    Route::get('/historias/{historia}', [HistoriasController::class, 'show'])
        ->name('historias.show');
    Route::post('/historias/{historia}/comentarios', [ComentariosController::class, 'store'])
        ->name('comentarios.store');

    // Perfil
    Route::get('/userProfile', [UsuariosController::class, 'userProfile'])
        ->name('user.profile');

    // Formulario de edición de perfil
    Route::get('/editForm', [UsuariosController::class, 'edit'])
        ->name('user.editForm');
    
    // Actualizar perfil
    Route::put('/editProfile/{id}', [UsuariosController::class, 'update'])->name('user.update');   

    // Eliminar perfil
    Route::delete('/editProfile/{id}', [UsuariosController::class, 'destroy'])->name('user.destroy');
    
    // Logout
    Route::post('/logout', [UsuariosController::class, 'logout'])
        ->name('logout');

    // CRUD Categorías (si las gestionas)
    Route::resource('categorias', CategoriasController::class)
        ->except(['show']);
});