<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\VerifyUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\VerificationToken;
use App\Mail\AccountActivated;
use App\Models\Historia;
use App\Models\Comentario;
use Carbon\Carbon;



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
            'is_active' => false, // Por defecto, el usuario no está activo
        ]);
        // 3) Generar token de 6 caracteres y guardarlo
        $token = Str::upper(Str::random(6));
        VerificationToken::create([
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        // 4) Enviar correo de verificación
        Mail::to($user->email)->send(new VerifyUser($user, $token));

        // 5) Guardar user_id en sesión para el siguiente paso
        session(['verify_user_id' => $user->id]);

        // 6) Redirigir al formulario de verificación
        return redirect()->route('verify.view')
                        ->with('status', 'Te hemos enviado un código de verificación al correo.');
    }

    /** Mostrar formulario para ingresar el código */
    public function showVerifyForm()
    {
        return view('verifyAccount');
    }

    /** Procesar verificación del código */
    public function verifyAccount(Request $request)
    {
        // 1) Validar el token ingresado
        $request->validate([
            'token' => 'required|string|size:6',
        ]);

        $userId = session('verify_user_id');

        // 2) Recuperar el registro de token (si existe)
        $record = VerificationToken::where('user_id', $userId)
                                ->where('token', $request->token)
                                ->first();

        if (! $record) {
            return back()->withErrors(['token' => 'Código inválido.']);
        }

        // 3) Verificar expiración (>24 h)
        if (Carbon::parse($record->created_at)->addHours(24)->isPast()) {
            return back()
                ->withErrors(['token' => 'Código expirado.'])
                ->with('canResend', true);
        }

        // 4) Activar usuario y borrar el token
        $user = User::findOrFail($userId);
        $user->update(['is_active' => true]);
        $record->delete();

        // 5) Enviar correo de bienvenida
        Mail::to($user->email)->send(new AccountActivated($user));

        // 6) Limpiar sesión, loguear y redirigir a home
        session()->forget('verify_user_id');
        Auth::login($user);

        return redirect()->route('home')->with('status', '¡Cuenta activada con éxito!');
    }

    /** Reenviar un nuevo token de verificación */
    public function resendToken()
    {
        $userId = session('verify_user_id');
        $user   = User::findOrFail($userId);

        // Eliminar tokens antiguos y generar uno nuevo
        VerificationToken::where('user_id', $userId)->delete();
        $token = Str::upper(Str::random(6));
        VerificationToken::create(['user_id' => $userId, 'token' => $token]);

        // Enviar de nuevo el correo de verificación
        Mail::to($user->email)->send(new VerifyUser($user, $token));

        return back()->with('status', 'Te hemos enviado un nuevo código.');
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

        // Verificar si el usuario está activo
        /*$user = User::where('email', $credentials['email'])->first();
        if ($user && ! $user->is_active) {
            return back()->withErrors([
                'email' => 'Tu cuenta no está activa. Por favor, verifica tu correo electrónico.',
            ])->onlyInput('email');
        }*/
        
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

        return redirect()->route('login');
    }
    /** Show users info */
    public function userProfile()
    {
        $user = Auth::user();
        // Ver historias creadas por el usuario
        $historias = Historia::with(['categoria'])
            ->where('usuario_id', $user->id)
            ->withSum('reacciones_historia as reacciones_count', 'reaccion') // crea $h->reacciones_count
            ->get();
        // Ver comentarios hecho por el usuario
        $comentarios = Comentario::with(['historia'])
            ->where('usuario_id', $user->id)
            ->get();
        // Contar publicaciones y comentarios
        $publicacionesCount = $user->historia()->count();
        $comentariosCount = Comentario::where('usuario_id', $user->id)->count();
        // Contar la suma de reacciones

    return view('userProfile', compact('user', 'historias', 'comentarios', 'publicacionesCount', 'comentariosCount'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('configProfile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'edad'     => 'required|integer|min:0|max:120',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Si la contraseña es nula, no la actualiza
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        // que solicite la contraseña actual
        if ($request->filled('current_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
            }
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('status', 'Perfil actualizado correctamente.');
    }


    public function destroy(string $id)
    {
        // Eliminar usuario
        
        $user = User::findOrFail($id);
        $user->delete();
        // Eliminar historias y comentarios del usuario
        Historia::where('usuario_id', $user->id)->delete();
        Comentario::where('usuario_id', $user->id)->delete();
        // Eliminar sesión
        Auth::logout();
        // Invalidar sesión
        session()->invalidate();
        session()->regenerateToken();
        // Redirigir a la página de inicio de sesión
        // y mostrar mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario eliminado correctamente.');
    }
}
