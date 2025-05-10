<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use function Termwind\renderUsing;



class UsuariosController extends Controller
{
    public function showSignupForm()
    {
        return view('signupForm');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'edad'     => 'required|integer|min:0|max:120',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'edad' => $data['edad'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        if(!$user) {
            return back()->withErrors(['error' => 'Error al crear el usuario.']);
        }
        Auth::login($user);
        return redirect()->route('home');
    }


    public function showLoginForm()
    {
        return view('loginForm');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

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

        return redirect()->route('/');
    }
    /** Show users info */

    public function userProfile()
    {
        $user = Auth::user();
        return view('userProfile', compact('user'));
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
