<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $senha = $request->senha;
        $email = $request->email;

        $usuario = Usuario::where('email', $email)->first();

        if ($usuario) {
            // Login realizado
            $request->session()->put('usuario_nome', $usuario->nome);
            return redirect('/painel');
        } else {
            // Senha ou email incorreto
            return back()->with('erro', 'Login inválido');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}