<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Profesionales;
use App\Models\Tratamientos;
use App\Models\Secciones;
use App\Models\ItemsTratamiento;
use App\Models\Servicios;
use App\Models\Evoluciones;
use App\Models\Especialidades;
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

    public function AllEspecialidades()
    {
        if (Auth::check()) {
            $especialidades = Especialidades::AllEspecialidades();

            if (request()->ajax()) {
                return response()->json([
                    'especialidades' => $especialidades,
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

    public function busEditServ()
    {
        if (Auth::check()) {
            $idServ = request()->get('idServ');
            $serviciosEdit = Secciones::BuscarServicioEdit($idServ);

            if (request()->ajax()) {
                return response()->json([
                    'serviciosEdit' => $serviciosEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function busEditSecc()
    {
        if (Auth::check()) {
            $idSecc = request()->get('idSecc');
            $seccionesEdit = Secciones::buscSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'seccionesEdit' => $seccionesEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function busEditTrata()
    {
        if (Auth::check()) {
            $idTrat = request()->get('idTrat');
            $tratraEdit = Tratamientos::busTatamiento($idTrat);

            if (request()->ajax()) {
                return response()->json([
                    'tratraEdit' => $tratraEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ConsultarEvoluciones()
    {
        if (Auth::check()) {
            $idSecc = request()->get('idSecc');
            $idServ = request()->get('idServ');
            $Seccion = Secciones::buscSeccion($idSecc);

            $evoluciones = Evoluciones::ConsultarEvolucionesServ($idServ);

            foreach ($evoluciones as $evo) {
                $archivosEvolucion = Evoluciones::consulArcEvol($evo->id);
                $evo->archivos = $archivosEvolucion;
            }

            if (request()->ajax()) {
                return response()->json([
                    'Seccion' => $Seccion,
                    'evoluciones' => $evoluciones,
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
            $idSecc = request()->get('idSecc');

            $serviciosEdit = Secciones::eliminarServ($idServ);
            $servSeccion = Secciones::buscServSecc($idSecc);
            $totServ = Secciones::busTotalSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'serviciosEdit' => $serviciosEdit,
                    'servSeccion' => $servSeccion,
                    'totServ' => $totServ
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarSeccion()
    {
        if (Auth::check()) {

            $idSecc = request()->get('idSecc');

            $servSeccion = Secciones::buscServSecc($idSecc);
            $seccionStatus = "";

            if ($servSeccion->count() == 0) {
                $serviciosEdit = Secciones::eliminarSeccion($idSecc);
                $serviciosEdit = ItemsTratamiento::eliminarSeccion($idSecc);

                $seccionStatus = "ok";
            } else {
                $seccionStatus = "fail";
                $serviciosEdit = "";
            }

            if (request()->ajax()) {
                return response()->json([
                    'seccionStatus' => $seccionStatus,
                    'serviciosEdit' => $serviciosEdit
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarTratamiento()
    {
        if (Auth::check()) {

            $idTrata = request()->get('idTrata');

            $Secciones = Secciones::buscSecc($idTrata);
            $tratamientoStatus = "";

            if ($Secciones->count() == 0) {
                $trataEdit = Tratamientos::eliminarTrata($idTrata);
                $tratamientoStatus = "ok";
            } else {
                $tratamientoStatus = "fail";
                $trataEdit = "";
            }

            if (request()->ajax()) {
                return response()->json([
                    'tratamientoStatus' => $tratamientoStatus,
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
            $servi = Secciones::allSevicios($idPac);

            if (request()->ajax()) {
                return response()->json([
                    'paciente' => $paciente,
                    'tratamientosAct' => $tratamientosAct,
                    'tratamientosOtr' => $tratamientosOtr,
                    'citas' => $citas,
                    'servi' => $servi
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function TratamientosRecaudo()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $tratamientosRecaudo = collect(Tratamientos::TratamientosPacientesRecaudo($idPac));


            $resultadosAgrupados = collect();

            $tratamientosAgrupados = $tratamientosRecaudo->groupBy('tratamiento');

            // Recorrer la colección agrupada y calcular sumas\
            $realizadoTratamiento = 0;
            $tratamientosAgrupados->each(function ($tratamientosPorTratamiento, $tratamiento) use ($resultadosAgrupados) {
                $totalTratamiento = $tratamientosPorTratamiento->sum('valor');
                $pagadoTratamiento = $tratamientosPorTratamiento->sum('pagado');
                $saldoTratamiento = $totalTratamiento - $pagadoTratamiento;

                $estado_serv = $tratamientosPorTratamiento->first()->estado_serv;

                if ($estado_serv == "Terminado") {
                    $realizadoTratamiento = $tratamientosPorTratamiento->sum('valor');
                }

                $nombreTratamiento = $tratamientosPorTratamiento->first()->ntrara;
                $nombreProfesional = $tratamientosPorTratamiento->first()->nprof;
                $nombrePaciente = $tratamientosPorTratamiento->first()->npac;
                $saldoPrevio = $tratamientosPorTratamiento->first()->sprev;

                // Agregar los resultados a la nueva colección
                $resultadosAgrupados->push([
                    'tratamiento' => $tratamiento,
                    'nombreTratamiento' => $nombreTratamiento,
                    'nombreProfesional' => $nombreProfesional,
                    'nombrePaciente' => $nombrePaciente,
                    'saldoPrevio' => $saldoPrevio,
                    'total' => $totalTratamiento,
                    'realizado' => $realizadoTratamiento,
                    'pagado' => $pagadoTratamiento,
                    'saldo' => $saldoTratamiento,
                ]);
            });


            /// Recaudos realizados al paciente

            $recaudos = Tratamientos::transaccionesPacientes($idPac);



            if (request()->ajax()) {
                return response()->json([
                    'tratamientosRecaudo' => $resultadosAgrupados,
                    'recaudos' => $recaudos
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function TratamientosRecaudoDetalles()
    {
        if (Auth::check()) {
            $data = request()->all();
            $dataIdsJson = request()->get('dataIds');
            $dataIdsArray = json_decode($dataIdsJson, true);

            $detaTrata = "";

            foreach ($dataIdsArray as $dataId) {
                //cargar tratamientos
                $tratamiento = Tratamientos::busTatamiento($dataId);

                $detaTrata .= '<tr>' .
                    '<th colspan="6" class="text-truncate">' .
                    '    <div>' .
                    '        <p class="mb-25 latest-update-item-name text-bold-600"><span class="bullet bullet-primary bullet-sm"></span> ' .
                    $tratamiento->nombre .
                    '        </p>' .
                    '    </div></th>' .
                    '</tr><input type="hidden" name="tratamientoSel" value="' . $tratamiento->id . '"/><input type="hidden" name="tratamiento" value="' . $tratamiento->id . '"/>';

                //cargar secciones
                $secciones = Secciones::buscSeccServ($tratamiento->id);
                $secc = "";
                foreach ($secciones as $dataSecc) {

                    $secc = '<tr>' .
                        '<th colspan="6" class="text-truncate">' .
                        '    <div>' .
                        '        <p class="mb-25 latest-update-item-name" style=" font-style: italic;">' .
                        $dataSecc->nombre .
                        '        </p>' .
                        '    </div></th>' .
                        '</tr>';
                    $detaTrata .= $secc;
                    //cargar servicios
                    $servicios = Secciones::buscServSecc($dataSecc->id);

                    foreach ($servicios as $dataServ) {
                        $serv = "";
                        $saldo = $dataServ->valor - $dataServ->pagado;
                        $serv = '<tr>' .
                            '<td  class="text-truncate">' .
                            '    <input type="checkbox" data-valor="' . $saldo . '" data-id="' . $dataServ->id .
                            '" id="checkRecaudo' . $dataServ->id . '"  class="icheck-activity-det">' .
                            '</td>' .
                            '<td  class="text-truncate">' .
                            '    <div>' .
                            '        <p>' .
                            $dataServ->nombre .
                            '        </p>' .
                            '    </div>' .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($dataServ->valor, 2, ',', '.') .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($dataServ->pagado, 2, ',', '.') .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">' .
                            $dataServ->estado_serv .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($saldo, 2, ',', '.')  .
                            '</td>' .
                            '</tr>';
                        $detaTrata .= $serv;
                    }
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'detaTrata' => $detaTrata,
                    'saldo_previo' => $tratamiento->saldo_previo
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

            $servTratamiento = Tratamientos::consulAllServ($idTrat);

            foreach ($ItemsTratamientos as $i => $item) {
                if ($item->tip_servi == "seccion") {

                    $seccion = Secciones::buscSeccion($item->id_servi);

                    $busTotalSeccion = Secciones::busTotalSeccion($seccion->id);
                    $total = number_format($busTotalSeccion, 2, ',', '.');


                    $ContTratamientos .= '<div id="seccion' . $seccion->id . '" class="card collapse-header mb-0" role="tablist">
                <div id="headingCollapse5"
                    class="card-header d-flex justify-content-between align-items-center m-1"
                    style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;"
                    data-toggle="collapse" role="tab"
                    data-target="#collapse' . $seccion->id . '"
                    aria-expanded="false"
                    aria-controls="collapse' . $seccion->id . '">
                    <div class="collapse-title media">

                        <div class="media-body mt-25">
                            <h4 id="nomSeccion' . $seccion->id . '">' . $seccion->nombre . '</h4>
                        </div>
                    </div>
                    <div
                        class="information d-sm-flex d-none align-items-center">
                        <div class="collection mr-1">
                            <span class="bullet bullet-xs bullet-primary"></span>
                            <span class="font-weight-bold" id="span-total' . $seccion->id . '">$ ' . $total . '</span>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle"
                                id="fisrt-open-submenu"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i  class="feather icon-more-vertical mr-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="fisrt-open-submenu">
                                <a onclick="$.addServicioSeccion(' . $seccion->id . ');"
                                    class="dropdown-item mail-reply">
                                    <i class="feather icon-plus"></i>
                                    Agregar Servicio
                                </a>
                                <div class="dropdown-divider">
                                </div>
                                <a onclick="$.editarSeccion(' . $seccion->id . ');" 
                                    class="dropdown-item">
                                    <i class="feather icon-edit"></i>
                                    Editar sección
                                </a>
                                <a onclick="$.eliminarSeccion(' . $seccion->id . ');"
                                    class="dropdown-item">
                                    <i class="feather icon-trash-2"></i>
                                    Eliminar Sección
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapse' . $seccion->id . '" role="tabpanel"
                    aria-labelledby="headingCollapse5"
                    class="collapse">
                    <div class="card-content">
                        <div class="card-body">
                          <table class="table mb-5">
                                    <tbody id="trServicioSeccion' . $seccion->id . '">
                                        

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>';
                } else {
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'Tratamientos' => $Tratamientos,
                    'ContTratamientos' => $ContTratamientos,
                    'servTratamiento' => $servTratamiento,
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
                    $conse = $i + 1;

                    $servTermi =  Servicios::buscSeccServPac($item->id);

                    $tdTable .= '<tr>
                <td>' . $conse . '</td>
                <td>
                    <a style="color:#009c9f; font-weight: bold" onclick="$.ver(' . $item->id . ');" >' . $item->identificacion . '</a>
                </td>
                <td><span class="invoice-amount" style="text-transform: capitalize;">' . $item->nombre . ' ' . $item->apellido . '</span></td>
                <td><span class="invoice-date">' . $item->telefono . '</span></td>';
                    if ($servTermi->count() > 0) {
                        $tdTable .= '<td><span class="badge badge-warning badge-pill">Pendiente</span></td>';
                    } else {
                        $tdTable .= '<td><span class="badge badge-success badge-pill">Ninguna</span></td>';
                    }

                    $tdTable .= '<td>
                    <div class="invoice-action">
                    <a onclick="$.ver(' . $item->id . ');"  title="Ver" class="invoice-action-view mr-1">
                    <i class="feather icon-eye"></i>
                    </a>
                    <a onclick="$.editar(' . $item->id . ');" title="Editar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="feather icon-edit-1"></i>
                    </a>
                    <a onclick="$.VerTratamientosList(' . $item->id . ');" title="Tratamientos" class="invoice-action-edit cursor-pointer">
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
    public function Recaudos()
    {
        $bandera = "";
        if (Auth::check()) {
            return view('Pacientes.GestionarRecaudos', compact('bandera'));
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
                $respuesta = Tratamientos::editar($data);
            }

            $newTrata =  Tratamientos::TratamientosPacientesAct($respuesta->paciente);

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
                $respuesta = Secciones::guardar($data, $idTrat);
                $itemTatra = ItemsTratamiento::guardar($respuesta->id, 'seccion', $idTrat);
            } else {
                $respuesta = Secciones::editarSeccion($data);
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

    public function GuardarPagoTratamiento()
    {
        if (Auth::check()) {
            $data = request()->all();

            $transaccion = Tratamientos::guardarTransaccion($data);

            $mediPago = Tratamientos::guardarMediosPago($data, $transaccion);

            $pagoServ = Servicios::updateSaldoServicio($data);
            $valorTotal = $pagoServ['valorTotal'];
            $collectServTerm = $pagoServ['collectServTerm'];

            foreach ($collectServTerm as $id) {
                $ServTerm = Servicios::guardarServTerm($id, $transaccion);
            }

            $updatetrata = Tratamientos::updateTrata($data['tratamientoSel'], $valorTotal);

            //consultas 
            $servTerminado = Servicios::ConultservTerminado($transaccion);
            $medioPago = Tratamientos::MediosPago($transaccion);
            $tratamiento = Tratamientos::busTatamientoRecaudo($data['tratamientoSel']);
            $transaccion = Tratamientos::buscTransaccion($transaccion);


            if (request()->ajax()) {
                return response()->json([
                    'servTerminado' => $servTerminado,
                    'medioPago' => $medioPago,
                    'tratamiento' => $tratamiento,
                    'transaccion' => $transaccion
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarHistoricoTransacciones()
    {
        if (Auth::check()) {
            $transaccion = request()->get('idTransaccion');

            $servTerminado = Servicios::ConultservTerminado($transaccion);
            $medioPago = Tratamientos::MediosPago($transaccion);
            $transaccion = Tratamientos::buscTransaccion($transaccion);
            $tratamiento = Tratamientos::busTatamientoRecaudo($transaccion->tratamiento);

            if (request()->ajax()) {
                return response()->json([
                    'servTerminado' => $servTerminado,
                    'medioPago' => $medioPago,
                    'tratamiento' => $tratamiento,
                    'transaccion' => $transaccion
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
            $idSecc = $data['idSecc'];
            $idTrata = $data['idTrata'];
            $idPac = $data['idPac'];

            if ($data['accion'] == "agregar") {
                $respuesta = Secciones::guardarServ($data, $idSecc, $idTrata, $idPac);
                if ($data["origServicio"] == "trata") {
                    $itemTatra = ItemsTratamiento::guardar($respuesta, 'trata', $idTrata);
                }
            } else {
                $respuesta = Secciones::editarServ($data);
            }

            $servSeccion = Secciones::buscServSecc($idSecc);

            $totServ = Secciones::busTotalSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $respuesta,
                    'totServ' => $totServ,
                    'servSeccion' => $servSeccion,

                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function GuardarEvolucion()
    {
        if (Auth::check()) {
            $data = request()->all();

            $idSecc = $data['idSecc'];
            $idTrata = $data['idTrata'];
            $idPac = $data['idPac'];
            $idSer = $data['idSer'];

            $respuestaEvol = Evoluciones::guardar($data, $idSecc, $idTrata, $idPac, $idSer);

            if (request()->has('repeater-list')) {
                $arc = [];
                $tip = [];
                $nom = [];
                $repeaterList = $data['repeater-list'];
                foreach ($repeaterList as $archivosEvo) {
                    if (isset($archivosEvo['archivo'])) {

                        $archivo = $archivosEvo['archivo'];
                        $nombreOriginal = $archivo->getClientOriginalName();
                        $tipoMime = $archivo->getClientMimeType();

                        // Realiza acciones con el archivo, como moverlo a una ubicación deseada
                        $prefijo = substr(md5(uniqid(rand())), 0, 6);
                        $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                        $archivo->move(public_path() . '/app-assets/evoluciones/', $nombreArchivo);
                        $arc[] = $nombreArchivo;
                        $tip[] = $tipoMime;
                        $nom[] = $nombreOriginal;
                        // Aquí puedes trabajar con los datos del archivo, como almacenarlos en una base de datos
                        $data['archivo'] = $arc;
                        $data['tipoArc'] = $tip;
                        $data['nombre'] = $nom;
                    }
                }
            }

            $updateServ = Secciones::updateServ($idSer, $data['pavance']);

            if (isset($data['archivo'])) {
                $evoArchivos = Evoluciones::guardarArcEvol($data, $respuestaEvol->id);
            }

            $servSeccion = Secciones::buscServSecc($idSecc);
            $totServ = Secciones::busTotalSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $respuestaEvol,
                    'totServ' => $totServ,
                    'servSeccion' => $servSeccion,

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
            $detaCita = Citas::buscaCitasPacientes($idPaciente);
            $paciente = Pacientes::BuscarPaciente($idPaciente);
            $tratamientos = Tratamientos::TratamientosPacientes($idPaciente);

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

    public function PacientesTratamientos(Request $request)
    {

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
