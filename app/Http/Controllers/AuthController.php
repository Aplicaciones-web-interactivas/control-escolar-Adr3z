<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'clave_institucional' => 'required|string',
            'contrasena'          => 'required|string',
        ]);

        $usuario = Usuario::where('clave_institucional', $request->clave_institucional)
                        ->where('activo', true)
                        ->first();

        if (!$usuario || !Hash::check($request->contrasena, $usuario->contrasena)) {
            return back()
                ->withErrors(['clave_institucional' => 'Credenciales incorrectas o usuario inactivo.'])
                ->withInput();
        }

        Auth::login($usuario);
        $request->session()->regenerate();

        return $usuario->rol === 'maestro'
            ? redirect()->route('usuarios.index')
            : redirect()->route('alumno.dashboard');
    }

    public function showRegistro()
    {
        return view('auth.registro');
    }

    public function registro(Request $request)
    {
        $request->validate([
            'nombre'              => 'required|string|max:255',
            'clave_institucional' => 'required|string|unique:usuarios,clave_institucional',
            'contrasena'          => 'required|string|min:6|confirmed',
        ]);

        Usuario::create([
            'nombre'              => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'contrasena'          => Hash::make($request->contrasena),
            'rol'                 => 'alumno',
            'activo'              => true,
        ]);

        return redirect()->route('login')->with('exito', 'Cuenta creada. Ya puedes iniciar sesión.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}