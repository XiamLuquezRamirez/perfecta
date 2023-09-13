<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function Login()
    {

        $respuesta = Usuario::login(request()->all());
       
        if ($respuesta){
            $rutaUrl = 'http://localhost/PEDIGITAL/public/app-assets/images/';
            return redirect('Administracion');
        }else{
            $error = "Usuario ó Contraseña Inconrrecta";
            return redirect('/')->with('error', $error);
        }
      
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Sesión Finalizada');
    }

    public function Administracion()
    {
        if (Auth::check()) {
        return view('Dashboard');
    } else {
        return redirect("/")->with("error", "Su Sesión ha Terminado");
    }
    }

}
