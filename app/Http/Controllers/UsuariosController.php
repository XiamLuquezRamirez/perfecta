<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function Login()
    {

        $respuesta = Usuario::login(request()->all());

        if ($respuesta) {
            $rutaUrl = 'http://localhost/PEDIGITAL/public/app-assets/images/';
            return redirect('Administracion');
        } else {
            $error = "Usuario ó Contraseña Inconrrecta";
            return redirect('/')->with('error', $error);
        }

    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Sesión Finalizada');
    }

    public function perfil()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionarPerfil', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function Administracion()
    {
        if (Auth::check()) {
            return view('Dashboard');
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function VerificarUsuario()
    {
        $usu = request()->get('Usuario');
        $usuario = Usuario::verifUsuario($usu);

        if (request()->ajax()) {
            return response()->json([
                'usuario' => $usuario->count(),
            ]);
        }
    }

    public function UpdatePerfil()
    {
        if (Auth::check()) {
            $data = request()->all();
            if (isset($data['fotoPaciente'])) {
                $archivo = $data['fotoPaciente'];
                $nombreOriginal = $archivo->getClientOriginalName();
                $tipoMime = $archivo->getClientMimeType();

                $prefijo = substr(md5(uniqid(rand())), 0, 6);
                $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                $archivo->move(public_path() . '/app-assets/images/FotosUsuarios/', $nombreArchivo);
                $data['img'] = $nombreArchivo;
            } else {
                $data['img'] = "avatar-s-1.png";
            }

            $perfil = Usuario::cambiosPerfil($data);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
            
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array(
                "¨", "º", "-", "~", "", "@", "|", "!",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", " h¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                " ",
            ),
            '',
            $string
        );

        return $string;
    }

}
