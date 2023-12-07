<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Tratamientos;

class CitasController extends Controller
{
    public function CargarDisponibilidad()
    {
        if (Auth::check()) {
            $idProf =  request()->get('idProf');
            $disponibilidad = Citas::CitasProfesional($idProf);

            if (request()->ajax()) {
                return response()->json([
                    'disponibilidad' => $disponibilidad
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarAllCitas()
    {
        if (Auth::check()) {
            $disponibilidad = Citas::AllCitas();

            if (request()->ajax()) {
                return response()->json([
                    'disponibilidad' => $disponibilidad
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function VerDetallesCita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCita');
            $detaCita = Citas::buscaDetCitas($idCita);

            $paciente = Pacientes::BuscarPaciente($detaCita->paciente);

            $tratamientos = Tratamientos::TratamientosPacientes($detaCita->paciente);

            if (request()->ajax()) {
                return response()->json([
                    'detaCita' => $detaCita,
                    'paciente' => $paciente,
                    'tratamientos' => $tratamientos,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function VerCitasPac()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $CitasPaciente = Citas::buscaCitasPacientes($idPac);


            if (request()->ajax()) {
                return response()->json([
                    'CitasPaciente' => $CitasPaciente
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CambioEstadocita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCita');
            $estadoCita = request()->get('estadoCita');
            $CitasPaciente = Citas::CambioEstadocita($idCita, $estadoCita);


            if (request()->ajax()) {
                return response()->json([
                    'CitasPaciente' => $CitasPaciente
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function InformacionCita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCitaPac');
            $CitasPaciente = Citas::buscaDetCitas($idCita);

            if (request()->ajax()) {
                return response()->json([
                    'CitasPaciente' => $CitasPaciente
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarCita()
    {
        if (Auth::check()) {
            $data = request()->all();

            if ($data["opc"] == "1") {
                if (isset($data['fotoPaciente'])) {

                    $archivo = $data['fotoPaciente'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/images/FotosPacientes/', $nombreArchivo);
                    $data['img'] = $nombreArchivo;
                } else {
                    $data['img'] = "avatar-s-1.png";
                }

                $respuesta = Pacientes::guardar($data);
                $data['idpac'] = $respuesta;
            }
            if ($data['accionCita'] == "agregar") {
                $cita = Citas::GuardarCitas($data);
            } else {
                $cita = Citas::EditarCitas($data);
            }


            if ($cita) {
                if ($data['notCliente'] == "si") {
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok"
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarComentario()
    {
        if (Auth::check()) {
            $data = request()->all();
            $cita = Citas::GuardarComentario($data);

            $comentario = Citas::buscaDetCitas($data['idCit']);


            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                    'comentario' => $comentario->comentario,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function cargarComentario()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCit');
             $comentario = Citas::buscaDetCitas($idCita);
             
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                    'comentario' => $comentario->comentario,
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
