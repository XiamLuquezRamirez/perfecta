<?php

namespace App\Http\Controllers;

use App\Models\Profesionales;
use App\Models\Servicios;
use App\Models\Categorias;
use App\Models\Gastos;
use App\Models\Pacientes;
use App\Models\Usuario;
use App\Models\Citas;
use App\Models\Tratamientos;
use App\Models\Cajas;
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

    public function Gastos()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionGastos', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function Cajas()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionCajas', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function cargarCategorias()
    {
        if (Auth::check()) {
            $categorias = Categorias::AllCategorias();

            if (request()->ajax()) {
                return response()->json([
                    'categorias' => $categorias,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ValidarProfesional()
    {
        if (Auth::check()) {
            $idProf = request()->get('idProf');
            $pacientes = DB::connection('mysql')
                ->table('profesionales')
                ->where('identificacion', $idProf)
                ->where('estado', 'ACTIVO')
                ->get();

            return response()->json([
                'pacientes' => $pacientes->count(),

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

            $pagination = $ListProfesionales->links('Adminitraccion.Paginacion')->render();

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
            $perPage = 10; // Número de posts por página
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

            $pagination = $ListServicios->links('Adminitraccion.Paginacion')->render();

            return response()->json([
                'servicios' => $tdTable,
                'links' => $pagination,
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarCajas()
    {
        if (Auth::check()) {
            $perPage = 5; // Número de posts por página
            $page = request()->get('page', 1);
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $servicios = DB::connection('mysql')
                ->table('cajas')
                ->leftJoin("users", "users.id", "cajas.usuario")
                ->select("cajas.*", "users.nombre_usuario")
                ->where('estado_reg', 'ACTIVO');

            $ultimaCaja = DB::connection('mysql')
                ->table('cajas')
                ->latest()
                ->first();
            $saldoAnterior = 0;
            if ($ultimaCaja) {
                $saldoAnterior = $ultimaCaja->saldo_cierre;
            }

            $ListServicios = $servicios->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $j = 1;
            $x = ($page - 1) * $perPage + 1;

            foreach ($ListServicios as $i => $item) {
                if (!is_null($item)) {
                    $saldo_inicial = $item->saldo_inicial + $item->abono_inicial;

                    $fechaApertura = $item->fecha_apertura;

                    $saldo_acomulado = Tratamientos::recaudoCaja($fechaApertura);
                    $gastos = Gastos::GastosCaja($fechaApertura);

                    $saldo = ($saldo_inicial + $saldo_acomulado);

                    $saldo = $saldo - $gastos;


                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . str_pad($j, 5, '0', STR_PAD_LEFT) . '</span></td>
                <td><span class="invoice-date">' . $fechaApertura . '</span></td>
                <td><span class="invoice-date">' . $item->fecha_cierre . '</span></td>
                <td><span class="invoice-date">$ ' . number_format($item->saldo_inicial, 2, ',', '.') . '</span></td>
                <td><span class="invoice-date">$ ' . number_format($saldo_acomulado, 2, ',', '.') . '</span></td>
                <td><span class="invoice-date">$ ' . number_format($gastos, 2, ',', '.')  . '</span></td>
                <td><span class="invoice-date">$ ' . number_format($saldo, 2, ',', '.') . '</span></td>';
                    if ($item->estado_caja == "Abierta") {
                        $tdTable .= '<td><span class="invoice-date"><span class="badge badge-success"> ' . $item->estado_caja . '</span></span></td>';
                    } else {
                        $tdTable .= '<td><span class="invoice-date"><span class="badge badge-warning"> ' . $item->estado_caja . '</span></span></td>';
                    }

                    $tdTable .= '<td>
                    <div class="invoice-action">

                    <a onclick="$.verDetalle(' . $item->id . ');" style="color:#009c9f; title="Editar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="fa fa-search"></i> Ver detalles
                    </a>
                   
                    </div>
                </td>
            </tr>';

                    $x++;
                    $j++;
                }
            }

            $pagination = $ListServicios->links('Adminitraccion.Paginacion')->render();

            return response()->json([
                'servicios' => $tdTable,
                'links' => $pagination,
                'saldoAnterior' => $saldoAnterior
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarGastos()
    {
        if (Auth::check()) {
            $perPage = 20; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            $fecha = request()->get('fecBusc');
            $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-',  $fecha)));

            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $gastos = DB::connection('mysql')
                ->table('gastos')
                ->leftJoin("categorias", "categorias.id", "gastos.categoria")
                ->where('gastos.estado', 'ACTIVO')
                ->select('gastos.*', 'categorias.descripcion AS desgasto');
            if ($search) {
                $gastos->where('gastos.descripcion', 'LIKE', '%' . $search . '%');
                $gastos->where('categorias.descripcion', 'LIKE', '%' . $search . '%');
            }
            $gastos->where('gastos.fecha_pago',  $fechaPago);

            $ListGastos = $gastos->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $j = 1;
            $x = ($page - 1) * $perPage + 1;
            $total = 0;

            foreach ($ListGastos as $i => $item) {
                if (!is_null($item)) {
                    $total = $total + $item->valor;
                    $numero_formateado = number_format($item->valor, 2, ',', '.');
                    $fecha_gasto = date('d/m/Y', strtotime($item->fecha_gasto));
                    $fecha_pago = date('d/m/Y', strtotime($item->fecha_pago));
                    $descripcion = $item->descripcion !== null ? $item->descripcion : "---";
                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . $j . '</span></td>
                <td><span class="invoice-date">' . $item->desgasto . '</span></td>
                <td><span class="invoice-date">' . $descripcion  . '</span></td>               
                <td><span class="invoice-date">' . $fecha_gasto . '</span></td>
                <td><span class="invoice-date">' . $fecha_pago . '</span></td>
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

            $pagination = $ListGastos->links('Adminitraccion.Paginacion')->render();

            return response()->json([
                'servicios' => $tdTable,
                'links' => $pagination,
                'total' => $total,
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
    public function ConsultarCaja()
    {
        if (Auth::check()) {
            $idCaja = request()->get('idCaja');
            $caja = Cajas::BuscarCajas($idCaja);

            //recaudo
            $recaudos = Tratamientos::recaudosCajaResumen($caja->fecha_apertura);

            //gastos
            $gastos = Gastos::GastosCaja($caja->fecha_apertura);


            if (request()->ajax()) {
                return response()->json([
                    'caja' => $caja,
                    'recaudos' => $recaudos,
                    'gastos' => $gastos,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarGastos()
    {
        if (Auth::check()) {
            $idGasto = request()->get('idGas');
            $gastos = Gastos::BuscarGastos($idGasto);

            if (request()->ajax()) {
                return response()->json([
                    'gastos' => $gastos,
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

    public function CargarDatos()
    {
        if (Auth::check()) {

            $pacientes = Pacientes::BuscarPacienteCita();
            $citasHoy = Citas::AllCitasHoy();
            $recaudosHoy = Tratamientos::recaudosHoy();
            $recaudosAyer = Tratamientos::recaudosAyer();
            $recaudosMes = Tratamientos::recaudosMes();

            $recaudosMesAnte = Tratamientos::recaudosMesAnte();

            $porcentajeCambioMes = 0; // Inicializar el porcentaje a cero para evitar divisiones por cero
            if ($recaudosMesAnte != 0) {
                $porcentajeCambioMes = (($recaudosMes - $recaudosMesAnte) / abs($recaudosMesAnte)) * 100;
            }
            $porcentajeCambioDia = 0; // Inicializar el porcentaje a cero para evitar divisiones por cero
            if ($recaudosAyer != 0) {
                $porcentajeCambioDia = (($recaudosHoy - $recaudosAyer) / abs($recaudosAyer)) * 100;
            }


            if (request()->ajax()) {
                return response()->json([
                    'pacientes' => $pacientes->count(),
                    'citasHoy' => $citasHoy->count(),
                    'recaudosHoy' => $recaudosHoy,
                    'recaudosMes' => $recaudosMes,
                    'porcentajeCambioMes' => $porcentajeCambioMes,
                    'porcentajeCambioDia' => $porcentajeCambioDia
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

    public function GuardarCategoria()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idCategoria = $data['idCategoria'];

            if ($data['accionCate'] == "agregar") {
                $respuesta = Categorias::guardar($data);

                $idCategoria = $respuesta;
            } else {

                $respuesta = Categorias::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idCategoria,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarGasto()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idGastos = $data['idGastos'];

            if ($data['accion'] == "agregar") {
                $respuesta = Gastos::guardar($data);

                $idGastos = $respuesta;
            } else {

                $respuesta = Gastos::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idGastos,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarCaja()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idGastos = $data['idCaja'];

            if ($data['accion'] == "agregar") {
                $respuesta = Cajas::guardar($data);
                $idGastos = $respuesta;
            } else {
                $respuesta = Gastos::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idGastos,
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
    public function EliminarCategoria()
    {
        if (Auth::check()) {
            $idCate = request()->get('idCate');
            $categoria = Categorias::Eliminar($idCate);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function EliminarGastos()
    {
        if (Auth::check()) {
            $idGast = request()->get('idGast');
            $gastos = Gastos::CambioEstado($idGast);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function CierreCaja()
    {
        if (Auth::check()) {

            $data = request()->all();
            $gastos = Cajas::CambioEstado($data);
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
