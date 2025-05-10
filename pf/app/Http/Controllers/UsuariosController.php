<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;         // o App\Models\Usuario



class UsuariosController extends Controller
{

    public function showLoginForm()
    {
        return view('loginForm');
    }
    public function login(Request $request)
    {
        // 1) Validar datos entrantes
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // 2) Intentar autenticar
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerar sesión para evitar fixation
            $request->session()->regenerate();

            // Redirigir al home/dashboard
            return redirect()->intended(route('home'));
        }

        // 3) Si falla, volver con error
        return back()
            ->withErrors([
                'email' => 'Las credenciales no coinciden.',
            ])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
