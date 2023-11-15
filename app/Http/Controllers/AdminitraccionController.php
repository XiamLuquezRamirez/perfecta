<?php

namespace App\Http\Controllers;

use App\Models\Profesionales;
use App\Models\Servicios;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
    public function Servicios()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionServicios', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function ValidarProfesional()
    {
        if (Auth::check()) {
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
    } else {
        return redirect("/")->with("error", "Su Sesión ha Terminado");
    }
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
    public function CargarServicios()
    {
        if (Auth::check()) {
            $perPage = 5; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $servicios = DB::connection('mysql')
                ->table('servicios')
                ->where('estado', 'ACTIVO');
            if ($search) {
                $servicios->where('nombre', 'LIKE', '%' . $search . '%');
            }

            $ListServicios = $servicios->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $j = 1;
            $x = ($page - 1) * $perPage + 1;

            foreach ($ListServicios as $i => $item) {
                if (!is_null($item)) {

                    $numero_formateado = number_format($item->valor, 2, ',', '.');

                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . $j . '</span></td>
                <td><span class="invoice-date">' . $item->nombre . '</span></td>
                <td><span class="invoice-date">' . $item->descuento . '</span></td>
                <td><span class="invoice-date">$ ' . $numero_formateado . '</span></td>
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
                    $j++;
                }
            }

            $pagination = $ListServicios->links('Pacientes.PaginacionPacientes')->render();

            return response()->json([
                'servicios' => $tdTable,
                'links' => $pagination,
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarProfesional()
    {
        if (Auth::check()) {
            $idProfesional = request()->get('idProf');
            $profesional = Profesionales::BuscarProfesional($idProfesional);

            if (request()->ajax()) {
                return response()->json([
                    'profesional' => $profesional,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarServicio()
    {
        if (Auth::check()) {
            $idSErvicio = request()->get('idServ');
            $servicio = Servicios::BuscarServicio($idSErvicio);

            if (request()->ajax()) {
                return response()->json([
                    'servicio' => $servicio,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarUsuario()
    {
        if (Auth::check()) {
            $idUsu = request()->get('Usu');
            $usuario = Usuario::BuscarUsuario($idUsu);

            if ($usuario) {
                $existe = "si";
            }

            if (request()->ajax()) {
                return response()->json([
                    'existe' => $existe,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarProfesional()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idProfesional = $data['idProfesional'];

            if ($data['accion'] == "agregar") {
                $respuesta = Usuario::guardar($data);
                $respuesta = Profesionales::guardar($data, $respuesta);

                $idProfesional = $respuesta;
            } else {
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

    public function GuardarServicio()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idProfesional = $data['idServicio'];

            if ($data['accion'] == "agregar") {
                $respuesta = Servicios::guardar($data);
                $idProfesional = $respuesta;
            } else {

                $respuesta = Servicios::editar($data);
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
        if (Auth::check()) {
            $idProf = request()->get('idProf');
            $profesional = Profesionales::Eliminar($idProf);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function EliminarServicio()
    {
        if (Auth::check()) {
            $idServ = request()->get('idServ');
            $servicios = Servicios::Eliminar($idServ);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
}
