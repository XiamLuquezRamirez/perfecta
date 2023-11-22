<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Profesionales;
use App\Models\Tratamientos;
use App\Models\Secciones;
use App\Models\ItemsTratamiento;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function Pacientes()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Pacientes.GestionPacientes', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ValidarPacientes()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $existe = "no";
            $pacientes = DB::connection('mysql')
                ->table('pacientes')
                ->where('identificacion', $idPac)
                ->where('estado', 'ACTIVO')
                ->first();

            if ($pacientes) {
                $existe = "si";
            }

            return response()->json([
                'existe' => $existe,

            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function AllProfesionales()
    {
        if (Auth::check()) {
            $profesionales = Profesionales::AllProfesional();

            if (request()->ajax()) {
                return response()->json([
                    'profesionales' => $profesionales,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function AllServicios()
    {
        if (Auth::check()) {
            $servicios = Servicios::BuscarAllServicio();

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $servicios,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarDatosPacTrat()
    {
        if (Auth::check()) {
            $idPac = request()->get('pacTrat');
            $paciente = Pacientes::BuscarPaciente($idPac);
            $tratamientosAct = Tratamientos::TratamientosPacientesAct($idPac);
            $tratamientosOtr = Tratamientos::TratamientosPacientesOtr($idPac);
            $citas = Citas::CitasPaciente($idPac);

            if (request()->ajax()) {
                return response()->json([
                    'paciente' => $paciente,
                    'tratamientosAct' => $tratamientosAct,
                    'tratamientosOtr' => $tratamientosOtr,
                    'citas' => $citas,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function SeccionesTratamientos()
    {
        if (Auth::check()) {
           $idTrat = request()->get('tratSecc');

           $Tratamientos = Tratamientos::busTatamiento($idTrat);
           $ItemsTratamientos = ItemsTratamiento::consulAllItem($idTrat);
            $ContTratamientos = '';
            $cosSeccio = 1;

           foreach ($ItemsTratamientos as $i => $item) {
            if($item->tip_servi=="seccion"){

                $seccion = Secciones::buscSeccion($item->id_servi);

                $ContTratamientos .='<div class="card collapse-header mb-0" role="tablist">
                <div id="headingCollapse5"
                    class="card-header d-flex justify-content-between align-items-center m-1"
                    style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;"
                    data-toggle="collapse" role="tab"
                    data-target="#collapse'.$cosSeccio.'"
                    aria-expanded="false"
                    aria-controls="collapse'.$cosSeccio.'">
                    <div class="collapse-title media">

                        <div class="media-body mt-25">
                            <h4>'.$seccion->nombre.'</h4>
                        </div>
                    </div>
                    <div
                        class="information d-sm-flex d-none align-items-center">
                        <div class="collection mr-1">
                            <span
                                class="bullet bullet-xs bullet-primary"></span>
                            <span class="font-weight-bold">$
                                45.000,00</span>
                        </div>

                        <div class="dropdown">
                            <a href="#"
                                class="dropdown-toggle"
                                id="fisrt-open-submenu"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i
                                    class="feather icon-more-vertical mr-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="fisrt-open-submenu">
                                <a onclick="$.addServicio('.$cosSeccio.');"
                                    class="dropdown-item mail-reply">
                                    <i
                                        class="feather icon-plus"></i>
                                    Agregar Servicio
                                </a>
                                <div class="dropdown-divider">
                                </div>
                                <a href="#"
                                    class="dropdown-item">
                                    <i
                                        class="feather icon-edit"></i>
                                    Editar sección
                                </a>
                                <a href="#"
                                    class="dropdown-item">
                                    <i
                                        class="feather icon-trash-2"></i>
                                    Eliminar Sección
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapse'.$cosSeccio.'" role="tabpanel"
                    aria-labelledby="headingCollapse5"
                    class="collapse">
                    <div class="card-content">
                        <div class="card-body">
                          <table class="table mb-5">

                                    <tbody
                                        id="trServicioSeccion'.$cosSeccio.'">
                                        

                                    </tbody>
                                </table>
                           
                        </div>

                    </div>
                </div>
            </div>';
            $cosSeccio++;

            }else{

            }

           }

            if (request()->ajax()) {
                return response()->json([
                    'Tratamientos' => $Tratamientos,
                    'ContTratamientos' => $ContTratamientos,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    

    public function CargarPacientes()
    {
        if (Auth::check()) {
            $perPage = 5; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $pacientes = DB::connection('mysql')
                ->table('pacientes')
                ->where('estado', 'ACTIVO');
            if ($search) {
                $pacientes->where('identificacion', 'LIKE', '%' . $search . '%');
                $pacientes->where('nombre', 'LIKE', '%' . $search . '%');
                $pacientes->where('apellido', 'LIKE', '%' . $search . '%');
            }

            $ListPacientes = $pacientes->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $x = ($page - 1) * $perPage + 1;

            foreach ($ListPacientes as $i => $item) {
                if (!is_null($item)) {
                    $tdTable .= '<tr>
                <td>
                    <a style="color:#009c9f; font-weight: bold" onclick="$.ver(' . $item->id . ');" >' . $item->identificacion . '</a>
                </td>
                <td><span class="invoice-amount">' . $item->nombre . '</span></td>
                <td><span class="invoice-date">' . $item->apellido . '</span></td>

                <td>
                    <span class="bullet bullet-secondary bullet-sm"></span>
                    Tratamiento Actual
                </td>
                <td><span class="badge badge-warning badge-pill">Pendientes</span></td>
                <td>
                    <div class="invoice-action">
                    <a onclick="$.ver(' . $item->id . ');"  title="Ver" class="invoice-action-view mr-1">
                    <i class="feather icon-eye"></i>
                    </a>
                    <a onclick="$.editar(' . $item->id . ');" title="Editar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="feather icon-edit-1"></i>
                    </a>
                    <a onclick="$.eliminar(' . $item->id . ');" title="Tratamientos" class="invoice-action-edit cursor-pointer">
                        <i class="feather icon-heart"></i>
                    </a>
                    </div>
                </td>
            </tr>';

                    $x++;
                }
            }

            $pagination = $ListPacientes->links('Pacientes.PaginacionPacientes')->render();

            return response()->json([
                'temas' => $tdTable,
                'links' => $pagination,
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function Tratamientos()
    {
        $bandera = "";
        if (Auth::check()) {
            return view('Pacientes.GestionTratamientos', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarMunicipios(Request $request)
    {
        if (Auth::check()) {

            $term = $request->input('q'); // Obtener el término de búsqueda

            // Consultar municipios desde la base de datos y filtrar por término de búsqueda
            $municipios = DB::connection('mysql')
                ->table('municipios')
                ->select('id_municipio AS id', 'municipio AS text')
                ->where('estado', '1')
                ->where('municipio', 'LIKE', '%' . $term . '%')
                ->get();

            // Formatear los resultados en un array
            $formattedMunicipios = [];
            foreach ($municipios as $municipio) {
                $formattedMunicipios[] = ['id' => $municipio->id, 'text' => $municipio->text];
            }
            return response()->json(['data' => $municipios]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarTratamiento()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idProfesional = $data['idTratamiento'];

            if ($data['accion'] == "agregar") {
                $respuesta = Tratamientos::guardar($data);
            } else {
                $respuesta = Profesionales::editar($data);
            }

            $newTrata =  Tratamientos::AllActivos();


            if (request()->ajax()) {
                return response()->json([
                    'newTrata' => $newTrata,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarSeccion()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idTrat = $data['idtrata'];

            if ($data['accion'] == "agregar") {
                $respuesta = Secciones::guardar($data,$idTrat);
                $itemTatra = ItemsTratamiento::guardar($respuesta->id,'seccion', $idTrat);
            } else {
                $respuesta = Secciones::editar($data);
            }
            

            if (request()->ajax()) {
                return response()->json([
                    'seccion' => $respuesta
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarPaciente()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idPaciente = $data['idPaciente'];
            if ($data['accion'] == "agregar") {

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
                $idPaciente = $respuesta;
            } else if ($data['accion'] == "editar") {
                if (isset($data['fotoPaciente'])) {

                    $archivo = $data['fotoPaciente'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/images/FotosPacientes/', $nombreArchivo);
                    $data['img'] = $nombreArchivo;
                } else {
                    $data['img'] = $data['fotoCargada'];
                }

                $respuesta = Pacientes::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idPaciente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarPacientes()
    {
        if (Auth::check()) {
            $idPaciente = request()->get('idPac');
            $paciente = Pacientes::BuscarPaciente($idPaciente);

            if (request()->ajax()) {
                return response()->json([
                    'paciente' => $paciente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarPacientesCita()
    {
        if (Auth::check()) {
            $paciente = Pacientes::BuscarPacienteCita();

            if (request()->ajax()) {
                return response()->json([
                    'pacientes' => $paciente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function PacientesTratamientos(Request $request){

        $term = $request->input('q'); // Obtener el término de búsqueda

        // Consultar municipios desde la base de datos y filtrar por término de búsqueda
        $pacientes = DB::connection('mysql')
        ->table('pacientes')
        ->select('id', DB::raw('CONCAT(nombre, " ", apellido) AS text'))
        ->where('estado', 'ACTIVO')
        ->where(function ($query) use ($term) {
            $query->where('nombre', 'LIKE', '%' . $term . '%')
                ->orWhere('apellido', 'LIKE', '%' . $term . '%')
                ->orWhere('identificacion', 'LIKE', '%' . $term . '%');
        })
        ->get();


        // Formatear los resultados en un array
        $formattedPacientes = [];
        foreach ($pacientes as $pacient) {
            $formattedPacientes[] = ['id' => $pacient->id, 'text' => $pacient->text];
        }
           return response()->json(['data' => $pacientes]);
    
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
