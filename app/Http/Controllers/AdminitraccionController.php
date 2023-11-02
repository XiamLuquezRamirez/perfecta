<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profesionales;
use App\Models\Usuario;

class AdminitraccionController extends Controller
{
    public function Profesionales()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionProfesionales', compact('bandera'));

        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ValidarProfesional()
    {
        $idPac = request()->get('idPac');
        $existe = "no";
        $pacientes = DB::connection('mysql')
            ->table('profesionales')
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


    public function CargarProfesionales()
    {
        if (Auth::check()) {
            $perPage = 5; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $profesionales = DB::connection('mysql')
                ->table('profesionales')
                ->where('estado', 'ACTIVO');
            if ($search) {
                $profesionales->where('identificacion', 'LIKE', '%' . $search . '%');
                $profesionales->where('nombre', 'LIKE', '%' . $search . '%');
            }

            $ListProfesionales = $profesionales->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $x = ($page - 1) * $perPage + 1;

            

            foreach ($ListProfesionales as $i => $item) {
                if (!is_null($item)) {
                    $tdTable .= '<tr>
                <td>
                    <a style="color:#009c9f; font-weight: bold" onclick="$.editar(' . $item->id . ');" >' . $item->identificacion . '</a>
                </td>
    \
                <td><span class="invoice-date">' . $item->nombre . '</span></td>
                <td>
                    <div class="invoice-action">
                  
                    <a onclick="$.editar(' . $item->id . ');" title="Editar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="feather icon-edit-1"></i>
                    </a>
                    <a onclick="$.eliminar(' . $item->id . ');" title="Eliminar" class="invoice-action-edit cursor-pointer">
                        <i class="feather icon-trash"></i>
                    </a>
                    </div>
                </td>
            </tr>';

                    $x++;
                }
            }

            $pagination = $ListProfesionales->links('Pacientes.PaginacionPacientes')->render();

            return response()->json([
                'profesionales' => $tdTable,
                'links' => $pagination,
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarProfesional() {
        $idProfesional= request()->get('idProf');
        $profesional = Profesionales::BuscarProfesional($idProfesional);

        if (request()->ajax()) {
            return response()->json([
                'profesional' => $profesional,
            ]);
        }
    }
 

    public function BuscarUsuario() {
        $idUsu= request()->get('Usu');
        $usuario = Usuario::BuscarUsuario($idUsu);

        if ($usuario) {
            $existe = "si";
        }

        if (request()->ajax()) {
            return response()->json([
                'existe' => $existe
            ]);
        }
    }

    public function GuardarProfesional()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idProfesional = $data['idProfesional'];

            if($data['accion']=="agregar"){
                $respuesta = Usuario::guardar($data);
                $respuesta = Profesionales::guardar($data,$respuesta);
             
                $idProfesional = $respuesta;
            }else{
                $respuesta = Usuario::editar($data);
                $respuesta = Profesionales::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

         
    
            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idProfesional,
                ]);
            }

        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarProfesional()
    {
        $idProf = request()->get('idProf');
        $unidades = Profesionales::Eliminar($idProf);
        if (request()->ajax()) {
            return response()->json([
                'estado' => "ok",
            ]);
        }
    }
}
