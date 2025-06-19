<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Tramite; // Asegúrate de importar el modelo Tramite si lo necesitas

class UsuarioController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('usuario.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        $user->conexion = true;
        $user->save();
        return redirect()->intended(route('tramite.index'));
        }

        return back()->withErrors([
            'email' => 'Credenciales inválidas.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
        $user->conexion = false;
        $user->save();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('usuario.login');
    }

    /**
     * Show the user registration form.
     */
    public function showRegisterForm()
    {
        return view('usuario.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Usuario::create([
            'nombre' => $validated['name'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'] ?? null,
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);
        return redirect()->route('tramite.index');
    }
    
    
    /**
     * Show the form for editing the authenticated user.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('usuario.edit', compact('user'));
    }

    /**
     * Update the authenticated user's information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:usuarios,email,' . $user->id],
            'telefono' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->nombre = $validated['name'];
        $user->email = $validated['email'];
        $user->telefono = $validated['telefono'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('usuario.edit')->with('success', 'Datos actualizados correctamente.');
    }
}

