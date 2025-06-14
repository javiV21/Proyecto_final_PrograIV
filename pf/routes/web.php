<?php

use App\Http\Controllers\Reacc_historiasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\HistoriasController;
use App\Http\Controllers\ComentariosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;

//----------------------------------
// Rutas para el envío de correos
//----------------------------------
// Envío de correos para el newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/
Route::middleware('guest')->group(function () {
    // Landing / info general
    Route::get('/', [HomeController::class, 'index'])
        ->name('index');

    // Registro
    Route::get('/signup', [UsuariosController::class, 'showSignupForm'])
        ->name('signup');
    Route::post('/signup', [UsuariosController::class, 'register'])
        ->name('signup.submit');

    // Verificación de cuenta
    Route::get ('/verify',       [UsuariosController::class,'showVerifyForm'])->name('verify.view');
    Route::post('/verify',       [UsuariosController::class,'verifyAccount'])->name('verify.submit');
    Route::post('/verify/resend',[UsuariosController::class,'resendToken'])->name('verify.resend');

    // Login
    Route::get('/login', [UsuariosController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [UsuariosController::class, 'login'])
        ->name('login.submit');
});

// Policies
Route::get('/policies', [HomeController::class, 'showPolicies'])
    ->name('policies');


/*
|----------------------------------
| Rutas protegidas (requieren auth)
|----------------------------------
*/
Route::middleware('auth')->group(function () {

    // Feed de historias
    Route::get('/home', [HistoriasController::class, 'index'])
        ->name('home');
    /*
    |----------------------------------
    | CRUD de historias
    |----------------------------------
    */
    // Crear historia
    Route::get('/createPost', [HistoriasController::class, 'create'])
        ->name('createPost');
    Route::post('/createPost', [HistoriasController::class, 'store'])
        ->name('historias.store');

    // Ver historia
    Route::get('/historias/{historia}', [HistoriasController::class, 'show'])
        ->name('historias.show');

    // Votar historia
    Route::post('/votar', [Reacc_historiasController::class, 'store'])->name('reacc_historias.store');

    // Editar historia
    Route::get('/historias/{historia}/edit', [HistoriasController::class, 'edit'])
        ->name('historias.edit');
    Route::put('/historias/{historia}', [HistoriasController::class, 'update'])
        ->name('historias.update');

    // Eliminar historia
    Route::delete('/historias/{historia}', [HistoriasController::class, 'destroy'])
        ->name('historias.destroy');

    // Listar historias por categoría
    Route::get('/categorias/{categoria?}', [CategoriasController::class, 'index'])
        ->name('categorias.index');

    Route::get('/categorias/{categoria}/historias', [CategoriasController::class, 'historiasAjax'])
        ->name('categorias.historias.ajax');

    /*
    |----------------------------------
    | CRUD de comentarios
    |----------------------------------
    */
    // Crear comentario
    Route::post('/historias/{historia}/comentarios', [ComentariosController::class, 'store'])
        ->name('comentarios.store');
    // Editar comentario
    Route::get('/comentarios/{comentario}/edit', [ComentariosController::class, 'edit'])
        ->name('comentarios.edit');
    Route::put('/comentarios/{comentario}', [ComentariosController::class, 'update'])
        ->name('comentarios.update');
    // Eliminar comentario
    Route::delete('/comentarios/{comentario}', [ComentariosController::class, 'destroy'])
        ->name('comentarios.destroy');
    
    /*
    |----------------------------------
    | CRUD de perfil
    |----------------------------------
    */
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
});