<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use App\Models\Profesionales;
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

    }

    public function AllProfesionales() {
       
        $profesionales = Profesionales::AllProfesional();

        if (request()->ajax()) {
            return response()->json([
                'profesionales' => $profesionales,
            ]);
        }
    }

    public function CargarPacientes()
    {
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
    }

    public function Tratamientos(){
        $bandera = "";
        
        return view('Pacientes.GestionTratamientos', compact('bandera'));
    }

    public function CargarMunicipios(Request $request)
    {

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

    }

    public function GuardarPaciente()
    {
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

            }else{
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
    }

    public function BuscarPacientes() {
        $idPaciente = request()->get('idPac');
        $paciente = Pacientes::BuscarPaciente($idPaciente);

        if (request()->ajax()) {
            return response()->json([
                'paciente' => $paciente,
            ]);
        }
    }

    public function CargarPacientesCita() {
   
        $paciente = Pacientes::BuscarPacienteCita();

        if (request()->ajax()) {
            return response()->json([
                'pacientes' => $paciente,
            ]);
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
