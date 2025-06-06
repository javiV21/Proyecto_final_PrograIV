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
        try{
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
        } catch(\Exception $e) {
            return back()->withErrors(['error' => 'Error al registrar el usuario. Por favor, inténtalo de nuevo.']);
        } catch(\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return back()->withErrors(['error' => 'Error al registrar el usuario. Verifica los datos ingresados.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

    /** Mostrar formulario para ingresar el código */
    public function showVerifyForm()
    {
        try{
            // Verificar si el usuario ya está registrado
            if (! session()->has('verify_user_id')) {
                return redirect()->route('signup.form')->withErrors(['error' => 'Debes registrarte primero.']);
            }
        } catch(\Exception $e) {
            return redirect()->route('signup.form')->withErrors(['error' => 'Error al acceder al formulario de verificación.']);
        }
    }

    /** Procesar verificación del código */
    public function verifyAccount(Request $request)
    {
        try{
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
            $user->email_verified_at = now(); // Marcar como verificado
            $record->delete();

            // 5) Enviar correo de bienvenida
            Mail::to($user->email)->send(new AccountActivated($user));

            // 6) Limpiar sesión, loguear y redirigir a home
            session()->forget('verify_user_id');
            Auth::login($user);

            return redirect()->route('home')->with('status', '¡Cuenta activada con éxito!');
        } catch(\Exception $e) {
            return back()->withErrors(['error' => 'Error al verificar la cuenta. Por favor, inténtalo de nuevo.']);
        } catch(\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return back()->withErrors(['error' => 'Error al verificar la cuenta. Verifica los datos ingresados.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

    /** Reenviar un nuevo token de verificación */
    public function resendToken()
    {
        try{
            $userId = session('verify_user_id');
            $user   = User::findOrFail($userId);

            // Eliminar tokens antiguos y generar uno nuevo
            VerificationToken::where('user_id', $userId)->delete();
            $token = Str::upper(Str::random(6));
            VerificationToken::create(['user_id' => $userId, 'token' => $token]);

            // Enviar de nuevo el correo de verificación
            Mail::to($user->email)->send(new VerifyUser($user, $token));

            return back()->with('status', 'Te hemos enviado un nuevo código.');
        } catch(\Exception $e) {
            return back()->withErrors(['error' => 'Error al reenviar el código. Por favor, inténtalo de nuevo.']);
        } catch(\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return back()->withErrors(['error' => 'Error al reenviar el código. Verifica los datos ingresados.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

    public function showLoginForm()
    {
        try{
            return view('loginForm');
        } catch(\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Error al acceder al formulario de inicio de sesión.']);
        }
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);
            
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();

                return redirect()->intended(route('home'));
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al iniciar sesión. Por favor, inténtalo de nuevo.']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return back()->withErrors(['error' => 'Error al iniciar sesión. Verifica los datos ingresados.']);
        } catch (\Throwable $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }
    public function logout(Request $request)
    {
        try{
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch(\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Error al cerrar sesión. Por favor, inténtalo de nuevo.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return redirect()->route('home')->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }
    /** Show users info */
    public function userProfile()
    {
        try{
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
        } catch(\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Error al cargar el perfil de usuario. Por favor, inténtalo de nuevo.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return redirect()->route('home')->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

    public function edit()
    {
        try{
            $user = Auth::user();
            return view('configProfile', compact('user'));            
        } catch(\Exception $e) {
            return redirect()->route('user.profile')->withErrors(['error' => 'Error al acceder a la configuración del perfil.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return redirect()->route('user.profile')->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
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
        } catch(\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el perfil. Por favor, inténtalo de nuevo.']);
        } catch(\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return back()->withErrors(['error' => 'Error al actualizar el perfil. Verifica los datos ingresados.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }

    }


    public function destroy(string $id)
    {
        try{
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
            return redirect()->route('login')->with('status', 'Usuario eliminado correctamente.');
        }catch(\Exception $e) {
            return redirect()->route('user.profile')->withErrors(['error' => 'Error al eliminar el usuario. Por favor, inténtalo de nuevo.']);
        } catch(\Illuminate\Database\QueryException $e) {
            // Manejo de errores de base de datos, como duplicados
            return redirect()->route('user.profile')->withErrors(['error' => 'Error al eliminar el usuario. Verifica los datos ingresados.']);
        } catch(\Throwable $e) {
            // Manejo de errores generales
            return redirect()->route('user.profile')->withErrors(['error' => 'Error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }
}
