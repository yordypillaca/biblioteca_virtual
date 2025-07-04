<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
        ]);

        $rol = in_array($request->rol, ['usuario', 'bibliotecario']) ? $request->rol : 'usuario';

        if (Auth::check() && Auth::user()->rol === 'bibliotecario') {
            if (in_array($request->rol, ['usuario', 'bibliotecario'])) {
                $rol = $request->rol;
            }
        }

        try {
            DB::statement("BEGIN agregar_usuario(:nombre, :email, :password, :rol); END;", [
                'nombre'   => $request->nombre,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'rol'      => $rol
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()]);
        }

        return redirect('/login')->with('success', ucfirst($rol) . ' registrado exitosamente.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/home');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
