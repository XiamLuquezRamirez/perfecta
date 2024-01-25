<?php

namespace App\Http\Controllers;

use App\Models\Cajas;
use App\Models\Categorias;
use App\Models\Citas;
use App\Models\Gastos;
use App\Models\Pacientes;
use App\Models\Profesionales;
use App\Models\Servicios;
use App\Models\Tratamientos;
use App\Models\Usuario;
use App\Models\Consignacion;
use App\Models\Promociones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    public function Promociones()
    {
        $bandera = "";
        if (Auth::check()) {
            return view('Adminitraccion.GestionarPromociones', compact('bandera'));
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

    public function Consignaciones()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Adminitraccion.GestionConsignaciones', compact('bandera'));
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

    public function CargarPacientes()
    {
        if (Auth::check()) {
            $pacientes = Pacientes::BuscarPacienteCita();

            if (request()->ajax()) {
                return response()->json([
                    'pacientes' => $pacientes,
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

                $profesionales->where(function ($query) use ($search) {
                    $query->where('identificacion', 'LIKE', '%' . $search . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $search . '%');
                });
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

    public function CargarPromociones()
    {
        if (Auth::check()) {
            $perPage = 10; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $promociones = DB::connection('mysql')
                ->table('promociones')
                ->where('estado', 'ACTIVO');
            if ($search) {
                $promociones->where('titulo', 'LIKE', '%' . $search . '%');
            }

            $ListPromociones = $promociones->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $j = 1;
            $x = ($page - 1) * $perPage + 1;

            foreach ($ListPromociones as $i => $item) {
                if (!is_null($item)) {
                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . $j . '</span></td>
                <td><span class="invoice-date">' . $item->titulo . '</span></td>
               <td>
                    <div class="invoice-action">

                    <a onclick="$.mostPacientes(' . $item->id . ');" title="Enviar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="feather icon-mail"></i>
                    </a>
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

            $pagination = $ListPromociones->links('Adminitraccion.Paginacion')->render();

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
                <td><span class="invoice-date">$ ' . number_format($gastos, 2, ',', '.') . '</span></td>';
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
                'saldoAnterior' => $saldoAnterior,
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
            $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $fecha)));

            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $gastos = DB::connection('mysql')
                ->table('gastos')
                ->leftJoin("categorias", "categorias.id", "gastos.categoria")
                ->where('gastos.estado', 'ACTIVO')
                ->select('gastos.*', 'categorias.descripcion AS desgasto');
            if ($search) {
                $gastos->where(function ($query) use ($search) {
                    $query->where('gastos.descripcion', 'LIKE', '%' . $search . '%')
                        ->orWhere('categorias.descripcion', 'LIKE', '%' . $search . '%');
                });
            }
            $gastos->where('gastos.fecha_pago', $fechaPago);

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
                    $formaPago = ($item->forma_pago === "e") ? "Efectivo" : (($item->forma_pago === "t") ? "Transferencia" : "Opción no válida");

                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . $j . '</span></td>
                <td><span class="invoice-date">' . $item->desgasto . '</span></td>
                <td><span class="invoice-date">' . $descripcion . '</span></td>
                <td><span class="invoice-date">' . $fecha_gasto . '</span></td>
                <td><span class="invoice-date">' . $fecha_pago . '</span></td>
                <td><span class="invoice-date">' . $formaPago . '</span></td>
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

    public function CargarConsignaciones()
    {
        if (Auth::check()) {
            $perPage = 20; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            $fecha = request()->get('fecBusc');
            $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $fecha)));

            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $consignaciones = DB::connection('mysql')
                ->table('consignaciones')
                ->where('estado', 'ACTIVO');
            if ($search) {
                $consignaciones->where(function ($query) use ($search) {
                    $query->where('descripcion', 'LIKE', '%' . $search . '%')
                        ->orWhere('banco', 'LIKE', '%' . $search . '%')
                        ->orWhere('nconsignacion', 'LIKE', '%' . $search . '%');
                });
            }
            $consignaciones->where('fecha', $fechaPago);

            $ListConsignaciones = $consignaciones->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $j = 1;
            $x = ($page - 1) * $perPage + 1;
            $total = 0;

            foreach ($ListConsignaciones as $i => $item) {
                if (!is_null($item)) {
                    $total = $total + $item->valor;
                    $numero_formateado = number_format($item->valor, 2, ',', '.');
                    $fecha_pago = date('d/m/Y', strtotime($item->fecha));
                    $descripcion = $item->descripcion !== null ? $item->descripcion : "---";

                    $tdTable .= '<tr>
                <td><span class="invoice-date">' . $j . '</span></td>
                <td><span class="invoice-date">' . $descripcion . '</span></td>
                <td><span class="invoice-date">' . $fecha_pago . '</span></td>
                <td><span class="invoice-date">' . $item->banco . '</span></td>
                <td><span class="invoice-date">' . $item->nconsignacion . '</span></td>
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

            $pagination = $ListConsignaciones->links('Adminitraccion.Paginacion')->render();

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
            $gastos = Gastos::GastosCajaDet($caja->fecha_apertura);
            $consig = Consignacion::consigCaja($caja->fecha_apertura);

            if (request()->ajax()) {
                return response()->json([
                    'caja' => $caja,
                    'recaudos' => $recaudos,
                    'gastos' => $gastos,
                    'consig' => $consig
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

    public function Buscarconsignacion()
    {
        if (Auth::check()) {
            $idCons = request()->get('idCons');
            $consignacion = Consignacion::BuscarConsig($idCons);

            if (request()->ajax()) {
                return response()->json([
                    'consignacion' => $consignacion,
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

    public function BuscarPromocion()
    {
        if (Auth::check()) {
            $idProm = request()->get('idProm');
            $promociones = Promociones::BuscarPromocion($idProm);

            if (request()->ajax()) {
                return response()->json([
                    'promociones' => $promociones,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EnviarPromo()
    {
        if (Auth::check()) {
            $data = request()->all();
            $promocion = Promociones::BuscarPromocion($data['idPro']);
            $dataIdsJson = $data['dataIds'];
            $dataIdsArray = json_decode($dataIdsJson, true);
            $destinatarios = array();

            foreach ($dataIdsArray as $dataId) {
                $paciente = Pacientes::BuscarPaciente($dataId);
                if ($paciente) {
                    // Agrega el correo y nombre del paciente al array de destinatarios
                    $destinatarios[$paciente->email] = $paciente->nombre . ' ' . $paciente->apellido;
                }
            }

            $enviar = self::enviarPromocion($destinatarios, $promocion);

            if (request()->ajax()) {
                return response()->json([
                    'enviar' => $enviar,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function enviarPromocion($destinatarios, $promocion)
    {
        $mail = new PHPMailer(true);


        $mensaje = $promocion->contenido;
        $asunto = $promocion->titulo;


        $contenido = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title>Narrative Invitation Email</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
        <style type='text/css'>

        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            border: 0;
            outline: none;
        }

        a img {
            border: none;
        }

        /* General styling */

        td, h1, h2, h3  {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
        }

        td {
            font-size: 13px;
            line-height: 19px;
            text-align: left;
        }

        body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
        }

        table {
            border-collapse: collapse !important;
        }


        h1, h2, h3, h4 {
            padding: 0;
            margin: 0;
            color: #444444;
            font-weight: 400;
            line-height: 110%;
        }

        h1 {
            font-size: 35px;
        }

        h2 {
            font-size: 30px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 18px;
            font-weight: normal;
        }

        .important-font {
            color: #21BEB4;
            font-weight: bold;
        }

        .hide {
            display: none !important;
        }

        .force-full-width {
            width: 100% !important;
        }

        .rps_16ec table#x_main-wrapper {
            border-collapse: collapse;
            border-spacing: 0;
            border: none;
            margin: 0 auto;
            width: 100%;
          }

          .rps_16ec #x_greeting {
            text-align: center;
          }

          .rps_16ec table.x_appt-data {
            width: auto;
            margin: 0 auto;
          }

          .rps_16ec .x_data-row {
            margin: 0 auto;
            width: auto;
          }

          .rps_16ec .x_appt-data tr:first-child td {
            padding-top: 12px;
          }

          .rps_16ec .x_data-row .x_label {
            width: 25%;
            font-weight: bold;
            color: #0097cc;
            text-align: right;
          }

          .rps_16ec .x_header td {
            background: #0097cc;
            padding: 3px;
            color: #fafafa;
            text-align: center;
          }

          .rps_16ec #x_initial-text {
            padding: 18px 0;
            line-height: 1.4em;
          }

          .rps_16ec .x_appt-data tr:first-child td {
            padding-top: 12px;
          }
          .rps_16ec .x_data-row .x_label, .rps_16ec .x_data-row .x_data {
            padding: 4px;
              padding-top: 4px;
          }

        </style>

        <style type='text/css' media='screen'>
            @media screen {
                @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

                /* Thanks Outlook 2013! */
                td, h1, h2, h3 {
                font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 600px)'>
            /* Mobile styles */
            @media only screen and (max-width: 600px) {

            table[class='w320'] {
                width: 320px !important;
            }

            table[class='w300'] {
                width: 300px !important;
            }

            table[class='w290'] {
                width: 290px !important;
            }

            td[class='w320'] {
                width: 320px !important;
            }

            td[class~='mobile-padding'] {
                padding-left: 14px !important;
                padding-right: 14px !important;
            }

            td[class*='mobile-padding-left'] {
                padding-left: 14px !important;
            }

            td[class*='mobile-padding-right'] {
                padding-right: 14px !important;
            }

            td[class*='mobile-padding-left-only'] {
                padding-left: 14px !important;
                padding-right: 0 !important;
            }

            td[class*='mobile-padding-right-only'] {
                padding-right: 14px !important;
                padding-left: 0 !important;
            }

            td[class*='mobile-block'] {
                display: block !important;
                width: 100% !important;
                text-align: left !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                padding-bottom: 15px !important;
            }

            td[class*='mobile-no-padding-bottom'] {
                padding-bottom: 0 !important;
            }

            td[class~='mobile-center'] {
                text-align: center !important;
            }

            table[class*='mobile-center-block'] {
                float: none !important;
                margin: 0 auto !important;
            }

            *[class*='mobile-hide'] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                line-height: 0 !important;
                font-size: 0 !important;
            }

            td[class*='mobile-border'] {
                border: 0 !important;
            }
            }
        </style>
        </head>
        <body class='body' style='padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none' bgcolor='#ffffff'>
        <div class='rps_16ec'>
        <div>
        <table id='x_main-wrapper'>
        <thead id='x_logo'>
        <tr>
        <th>
        <img data-imagetype='External' src='https://perfectaestetica.com/app-assets/images/logo/logo_perfecta.png' width = '200px'  alt='PERFECTA' class='x_responsive'> 
        </th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td id='x_greeting'>
        Estimad@ <strong style='text-transform: capitalize;'> Cliente,</strong>
        </td>
        </tr>
        <tr>
        <td  id='x_initial-text'>
        " . $mensaje . "
        </td>
        </tr>
        <div>
        </body>
        </html>";

        try {
            // Configuración del servidor SMTP
            require base_path("vendor/autoload.php");
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'mail.perfectaestetica.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'notificaciones@perfectaestetica.com';
            $mail->Password = 'Mairen_2024';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS si es necesario
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('notificaciones@perfectaestetica.com', 'PERFECTA');

            foreach ($destinatarios as $correo => $nombre) {
                $mail->addAddress($correo, $nombre);
            }


            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $contenido;
             if ($promocion->archivo !== "") {
                $url = public_path('app-assets/promociones/'.$promocion->archivo);
                 $mail->addAttachment($url);
             }

            // Envío del correo
            $mail->send();

            return 'ok';
        } catch (Exception $e) {
            return "Error;".$mail->ErrorInfo;
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
                    'porcentajeCambioDia' => $porcentajeCambioDia,
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

    public function GuardarConsignacion()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idConsignacion = $data['idConsignacion'];

            if ($data['accion'] == "agregar") {
                $respuesta = Consignacion::guardar($data);

                $idConsignacion = $respuesta;
            } else {

                $respuesta = Consignacion::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idConsignacion,
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

    public function GuardarPromocion()
    {
        if (Auth::check()) {
            $data = request()->all();

            $idPromocion = $data['idPromocion'];

            if ($data['accion'] == "agregar") {
                if (isset($data['archivoProm'])) {

                    $archivo = $data['archivoProm'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/promociones/', $nombreArchivo);
                    $data['archi'] = $nombreArchivo;
                } else {
                    $data['archi'] = "no";
                }

                $respuesta = Promociones::guardar($data);
                $idPromocion = $respuesta;
            } else {
                if (isset($data['archivoProm'])) {

                    $archivo = $data['archivoProm'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/promociones/', $nombreArchivo);
                    $data['archi'] = $nombreArchivo;
                } else {
                    if ($data['archiCarg'] == 'no') {
                        $data['archi'] = "no";
                    } else {
                        $data['archi'] = $data['archiCarg'];
                    }
                }

                $respuesta = Promociones::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idPromocion,
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
    public function EliminarPromocion()
    {
        if (Auth::check()) {
            $idProm = request()->get('idProm');
            $promocion = Promociones::Eliminar($idProm);
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
            $gastos = Gastos::Eliminar($idGast);
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function EliminarConsignacion()
    {
        if (Auth::check()) {
            $idCons = request()->get('idCons');
            $consignacion = Consignacion::Eliminar($idCons);
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
