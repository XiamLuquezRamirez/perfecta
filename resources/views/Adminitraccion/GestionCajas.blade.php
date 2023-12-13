@extends('Plantilla.Principal')
@section('title', 'Gestionar Cajas')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Cajas</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Gestionar Cajas
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <div class="content-body" id="cont-lista">
            <div class="row mb-1 mt-1 mt-md-0">
                <div class="col-6">
                    <div class="btn-group mr-1 mb-1">
                        <button type="button" class="btn btn-primary">Gestionar caja</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="$.abrirCaja();">Abrir Caja</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="$.resumenCajas();" href="#">Resumen de cajas</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bug-list-search">
                        <div class="bug-list-search-content">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i>
                            </div>
                            <div class="position-relative">
                                <input type="search" id="searchInput" class="form-control" placeholder="Busqueda...">
                                <div class="form-control-position">
                                    <i class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- datatable started -->
                    <div id="app-invoice-wrapper" class="">
                        <table id="app-invoice-table" class="table" style="width: 100%;">
                            <thead class="border-bottom border-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Apertura</th>
                                    <th>Cierre</th>
                                    <th>Saldo inicial</th>
                                    <th>Recaudado</th>
                                    <th>Gastos</th>
                                    <th>Saldo Caja</th>
                                    <th>Estado</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody id="trRegistros">
                            </tbody>
                        </table>

                        <div id="pagination-links" class="text-center ml-1 mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  Modal nueva caja  --}}
        <div class="modal fade text-left" id="modalCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloServicio"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardar"
                                action="{{ url('/') }}/Administracion/GuardarCaja">
                                <input type="hidden" name="idCaja" id="idCaja" value="" />
                                <input type="hidden" name="accion" id="accion" value="">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fa fa-calculator"></i> Información basica de caja
                                    </h4>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="userinput8">Saldo caja anterior:</label>
                                            <input type="text" class="form-control" disabled id="saldoAnteVis"
                                                name="saldoAnteVis" placeholder="" value="">
                                            <input type="hidden" value="" id="saldoAnte" name="saldoAnte">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="userinput8">Abono Inicial:</label>
                                            <input type="text" onchange="$.cambioFormato(this.id);"
                                                onkeypress="return validartxtnum(event)" class="form-control"
                                                id="abonoIni" name="abonoIni">
                                            <input type="hidden" value="" id="abono" name="abono">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="userinput8">Responsable Caja:</label>
                                            <input type="text" class="form-control" id="responsable"
                                                name="responsable" placeholder=""
                                                value="{{ Auth::user()->nombre_usuario }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-actions right">
                                            <button type="button" onclick="$.salir();" class="btn btn-warning mr-1">
                                                <i class="feather icon-corner-up-left"></i> Salir
                                            </button>
                                            <button type="button" id="btnGuardar" onclick="$.guardar()"
                                                class="btn btn-success">
                                                <i class="fa fa-check-square-o"></i> Guardar
                                            </button>
                                            <button type="button" id="btnNuevo" style="display: none;"
                                                onclick="$.nuevo()" class="btn btn-primary">
                                                <i class="feather icon-plus"></i> Nuevo
                                            </button>
                                        </div>
                                    </div>

                                </div>
                        </div>


                        </form>

                    </div>
                </div>

            </div>
        </div>
        {{--  Modal detalle caja  --}}
        <div class="modal fade text-left" id="modaldetCaja" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-bold-600" id="tituloCaja"></h4>
                        <h2 class="text-primary" id="valTotalGeneral">$ 0,00</h2>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row invoice-adress-info py-2 p-2" style="width: 100%;">
                                <div class="col-4 mt-1 from-info">
                                    <div class="company-name mb-1">
                                        <span class="font-weight-bold no-wrap">Fecha de apertura:
                                        </span><br>
                                        <span id="fecApertura"></span>
                                    </div>
                                </div>
                                <div class="col-4 mt-1 from-info">
                                    <div id="div-infoCierre" class="company-name mb-1" style="display: none;">
                                        <span class="font-weight-bold no-wrap">Fecha de cierre:
                                        </span><br>
                                        <span id="fecCierre"></span>
                                    </div>
                                </div>
                                <div class="col-4 mt-1 to-info">
                                    <div class="company-name mb-1">
                                        <span class="font-weight-bold no-wrap">Usuario apertura: </span><br>
                                        <span id="usuApertura"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 55%">Saldo anterior</td>
                                            <td></td>
                                            <td></td>
                                            <td id="infSaldoAnterior">$ 0,00</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 55%">Abono inicial</td>
                                            <td></td>
                                            <td></td>
                                            <td id="infAbonoInicial">$ 0,00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-teal bg-lighten-4 height-50">
                                        <tr>
                                            <th style="width: 55%">Saldo inicial total</th>
                                            <th></th>
                                            <th></th>
                                            <th id="infSaldoInicial">$ 0,00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody id="tr-mediosPago">

                                    </tbody>
                                    <tfoot class="bg-teal bg-lighten-4 height-50">
                                        <tr>
                                            <th style="width: 55%">Recaudos</th>
                                            <th></th>
                                            <th></th>
                                            <th id="totalMedioPago">$ 0,00/th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 55%">Gastos (-)</td>
                                            <td></td>
                                            <td></td>
                                            <td id="infGastos">$ 0,00</td>
                                        </tr>

                                    </tbody>
                                    <tfoot class="bg-teal bg-lighten-4 height-50">
                                        <tr>
                                            <th style="width: 55%">Total caja (saldo inicial + recaudado - gastos):
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th id="infTotalCaja">$ 0,00</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tfoot id="div-saldoCierre" style="display: none;"
                                        class="bg-teal bg-lighten-4 height-50">
                                        <tr>
                                            <th style="width: 55%">Saldo cierre::
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th id="infSaldoCierre">$ 0,00</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12" style="text-align: right">
                                    <div class="form-actions right">
                                        <button type="button" onclick="$.salirDetCaja()" class="btn btn-warning ">
                                            <i class="fa fa-reply"></i> Salir
                                        </button>
                                        <button type="button" onclick="$.imprimir()" class="btn btn-info ">
                                            <i class="fa fa-print"></i> Imprir
                                        </button>
                                        <button type="button" id="btn-cierre" onclick="$.cerrarCaja();"
                                            class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i> Cerrar caja
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>



                    </div>
                </div>

            </div>
        </div>
        {{--  Modal cierre caja  --}}
        <div class="modal fade text-left" id="modalCierre" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cierre de caja</h4>

                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardarCierreCaja"
                                action="{{ url('/') }}/Administracion/CierreCaja">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="userinput8">Fecha de ciere:</label>

                                        <div class="form-group d-flex align-items-center position-relative">
                                            <!-- date picker -->
                                            <div class="date-icon mr-50 font-medium-3">

                                                <i class='feather icon-calendar'></i>

                                            </div>
                                            <div class="date-picker">
                                                <input type="text" id="fecCierre" name="fecCierre"
                                                    class="pickadate form-control pl-1" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="userinput8">Monto en caja:</label>
                                            <input type="text" onchange="$.cambioFormato(this.id);"
                                                onkeypress="return validartxtnum(event)" onclick="this.select()"
                                                class="form-control" id="valorVisMontoCierre" value="0,00"
                                                name="valorVisMontoCierre">
                                            <input type="hidden" value="" id="valorMontoCierre"
                                                name="valorMontoCierre">
                                            <input type="hidden" value="" id="valorMontoGastos"
                                                name="valorMontoGastos">
                                            <input type="hidden" value="" id="valorMontoRecaudos"
                                                name="valorMontoRecaudos">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-actions right">
                                            <button type="button" onclick="$.salirConfcierre();"
                                                class="btn btn-warning mr-1">
                                                <i class="fa fa-reply"></i>
                                                Salir
                                            </button>
                                            <button type="button" onclick="$.confirmarCierre();"
                                                class="btn btn-success mr-1">
                                                <i class="fa fa-check-square-o"></i>
                                                Confirmar cierre
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="loader" class="loader-spinner" style="display: none;">
            <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
            <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>
        </div>

    </div>

    <form action="{{ url('/Administracion/CargarCajas') }}" id="formCargarCajas" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/ValidarProfesional') }}" id="formValidarProfesional" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/BuscarServicio') }}" id="formBuscarServicio" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/BuscarUsuario') }}" id="formValidarUsuario" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/EliminarServicio') }}" id="formEliminar" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/Administracion/ConsultarCaja') }}" id="formConsultarCaja" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenCaja").addClass("active");
            localStorage.clear();
            var respuestaGlobal;

            var picker = $('.pickadate').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY',
                    daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                }
            });
            $.extend({
                cargar: function(page, searchTerm = '') {
                    var form = $("#formCargarCajas");
                    var url = form.attr("action");
                    $('#page').remove();
                    $('#searchTerm').remove();
                    form.append("<input type='hidden' id='page' name='page'  value='" + page + "'>");
                    form.append("<input type='hidden' id='searchTerm' name='search'  value='" +
                        searchTerm +
                        "'>");
                    var datos = form.serialize();

                    $('#tdTable').empty();

                    let x = 1;
                    let tdTable = '';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            $('#trRegistros').html(response
                                .servicios
                            ); // Rellenamos la tabla con las filas generadas
                            $('#pagination-links').html(response
                                .links); // Colocamos los enlaces de paginación
                            $("#saldoAnte").val(response.saldoAnterior);
                            $("#saldoAnteVis").val(formatCurrency(response.saldoAnterior,
                                'es-CO', 'COP'));
                        }
                    });
                },
                abrirCaja: function() {

                    $("#modalCaja").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#tituloServicio").html("Abrir Caja");
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();
                    $.limpiar();
                },
                verDetalle: function(caja) {
                    $("#modaldetCaja").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var form = $("#formConsultarCaja");

                    $("#idCaja").remove();
                    form.append("<input type='hidden' id='idCaja' name='idCaja'  value='" + caja +
                        "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            respuestaGlobal = respuesta; 
                            $("#tituloCaja").html("Caja #" + agregarCeros(respuesta.caja.id,5));
                            $("#fecApertura").html(respuesta.caja.fecha_apertura);
                            $("#usuApertura").html(respuesta.caja.nombre_usuario);
                            $("#infSaldoAnterior").html(formatCurrency(parseInt(respuesta
                                .caja.saldo_anterior), 'es-CO', 'COP'));
                            $("#infAbonoInicial").html(formatCurrency(respuesta.caja
                                .abono_inicial, 'es-CO', 'COP'));
                            $("#infSaldoInicial").html(formatCurrency(respuesta.caja
                                .saldo_inicial, 'es-CO', 'COP'));


                            if (respuesta.caja.estado_caja == 'Cerrada') {
                                $("#btn-cierre").hide();
                                $("#div-saldoCierre").show();
                                $("#div-infoCierre").show();
                                $("#infSaldoCierre").html(formatCurrency(respuesta.caja
                                    .saldo_cierre, 'es-CO', 'COP'));
                                $("#fecCierre").html(respuesta.caja.fecha_cierre);
                            } else {
                                $("#btn-cierre").show();
                                $("#div-saldoCierre").hide();
                                $("#div-infoCierre").hide();
                            }

                            //informacion recaudos

                            var totals = {};

                            // Iterar sobre los recaudos y acumular los totales
                            respuesta.recaudos.forEach(function(recaudo) {
                                // Mapear los medios de pago a nombres deseados
                                var medioPagoNombre = {
                                    "e": "Efectivo",
                                    "tc": "Tarjeta de crédito",
                                    "td": "Tarjeta de débito",
                                    "t": "Transferencia"
                                    // Puedes agregar más mapeos según tus necesidades
                                } [recaudo.medio_pago];

                                // Obtener o crear la entrada para el medio de pago
                                if (!totals[medioPagoNombre]) {
                                    totals[medioPagoNombre] = {
                                        count: 0,
                                        total: 0
                                    };
                                }

                                // Incrementar la cantidad y sumar al total
                                totals[medioPagoNombre].count++;
                                totals[medioPagoNombre].total += parseInt(recaudo
                                    .valor);
                            });

                            // Mostrar los resultados

                            let mediosPago = '';
                            let totalMedioPago = 0;
                            for (var medioPagoNombre in totals) {
                                mediosPago += '<tr>' +
                                    '<td style="width: 55%">' + medioPagoNombre + ' (' +
                                    totals[medioPagoNombre].count + ')</td>' +
                                    '<td></td>' +
                                    '<td></td>' +
                                    '<td>' + formatCurrency(totals[medioPagoNombre].total,
                                        'es-CO', 'COP') + '</td>' +
                                    '</tr>';

                                totalMedioPago += totals[medioPagoNombre].total;

                                if (medioPagoNombre == 'Efectivo') {
                                    $("#valorMontoCierre").val(totals[medioPagoNombre]
                                        .total);
                                    $("#valorVisMontoCierre").val(formatCurrency(totals[
                                        medioPagoNombre].total, 'es-CO', 'COP'));

                                }
                            }

                            $("#tr-mediosPago").html(mediosPago);
                            $("#totalMedioPago").html(formatCurrency(totalMedioPago,
                                'es-CO', 'COP'));
                            $("#valorMontoRecaudos").val(totalMedioPago);


                            //informacion gastos
                            $("#infGastos").html(formatCurrency(respuesta.gastos, 'es-CO',
                                'COP'));

                            $("#valorMontoGastos").val(respuesta.gastos);

                            // total caja
                            let totalCaja = parseInt(respuesta.caja.saldo_inicial) +
                                parseInt(totalMedioPago);
                            totalCaja = totalCaja - parseInt(respuesta.gastos);

                            $("#infTotalCaja").html(formatCurrency(totalCaja, 'es-CO',
                                'COP'));
                            $("#valTotalGeneral").html(formatCurrency(totalCaja, 'es-CO',
                                'COP'));

                        }
                    });
                },
                guardar: function() {

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardar");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var token = $("#token").val();
                    $("#idtoken").remove();
                    $("#accion").remove();

                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardar')[0]),
                        processData: false,
                        contentType: false,
                        success: function(respuesta) {
                            if (respuesta.estado == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "Operación realizada exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });

                                $("#accion").val("editar");
                                $("#idCaja").val(respuesta.id);

                                $("#btnGuardar").hide();
                                $("#btnNuevo").show();
                                var loader = document.getElementById('loader');
                                loader.style.display = 'none';
                            }

                            $.cargar(1);


                        },
                        error: function() {
                            Swal.fire({
                                type: "errot",
                                title: "Opsss...",
                                text: "Ha ocurrido un error",
                                confirmButtonClass: "btn btn-primary",
                                timer: 1500,
                                buttonsStyling: false
                            });
                        }
                    });

                },
                cambioFormato: function(id) {
                    var numero = $("#" + id).val();
                    $("#abono").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#abonoIni").val(formatoMoneda);
                },
                confirmarCierre: function() {
                    Swal.fire({
                        title: "Esta seguro de cerrar esta caja?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, cerrar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederCerrar();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "Tu caja sigue abierta ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                },
                procederCerrar: function() {
                    var form = $("#formGuardarCierreCaja");
                    let caja = $("#idCaja").val();

                    $("#idCaja").remove();
                    form.append("<input type='hidden' id='idCaja' name='idCaja'  value='" + caja +
                        "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarCierreCaja')[0]),
                        processData: false,
                        contentType: false,
                        success: function(respuesta) {
                            Swal.fire({
                                type: "success",
                                title: "Cerrada!",
                                text: "La caja fue cerrada de forma exitosa.",
                                timer: 1500,
                                confirmButtonClass: "btn btn-success",
                                buttonsStyling: false
                            });

                            $.cargar(1);
                            setTimeout(() => {
                                $('#modalCierre').modal('toggle');
                            }, 2000);
                        }
                    });

                },
                salirConfcierre: function() {
                    $("#modaldetCaja").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $('#modalCierre').modal('toggle');
                    var miDiv = document.getElementById("modaldetCaja");
                    miDiv.style.setProperty("overflow-y", "auto", "important");
                },

                salir: function() {
                    $('#modalCaja').modal('hide');
                    $.limpiar();
                },
                limpiar: function() {
                    $("#abonoIni").val("");
                },
                nuevo: function() {
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();
                    $.limpiar();
                },
                cerrarCaja: function() {
                    $("#modalCierre").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modaldetCaja').modal('toggle');
                },
                salirDetCaja: function() {
                    $('#modaldetCaja').modal('toggle');
                },

                eliminar: function(id) {
                    Swal.fire({
                        title: "Esta seguro de Eliminar este registro?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederEliminar(id);
                            $.cargar(1);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "Tu registro está a salvo ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                },
                procederEliminar: function(id) {
                    var form = $("#formEliminar");

                    $("#idServ").remove();
                    form.append("<input type='hidden' id='idServ' name='idServ'  value='" + id +
                        "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            Swal.fire({
                                type: "success",
                                title: "Eliminado!",
                                text: "El Registro fue eliminado correctamente.",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });

                },
                imprimir: function() {
                   
                   

                    var totals = {};

                    // Iterar sobre los recaudos y acumular los totales
                    respuestaGlobal.recaudos.forEach(function(recaudo) {
                        // Mapear los medios de pago a nombres deseados
                        var medioPagoNombre = {
                            "e": "Efectivo",
                            "tc": "Tarjeta de crédito",
                            "td": "Tarjeta de débito",
                            "t": "Transferencia"
                            // Puedes agregar más mapeos según tus necesidades
                        } [recaudo.medio_pago];

                        // Obtener o crear la entrada para el medio de pago
                        if (!totals[medioPagoNombre]) {
                            totals[medioPagoNombre] = {
                                count: 0,
                                total: 0
                            };
                        }

                        // Incrementar la cantidad y sumar al total
                        totals[medioPagoNombre].count++;
                        totals[medioPagoNombre].total += parseInt(recaudo
                            .valor);
                    });

                    var totalRecaudos = Object.values(totals).reduce((acc, medioPago) => acc + medioPago.total, 0);

                      // total caja
                      let totalCaja = parseInt(respuestaGlobal.caja.saldo_inicial) + parseInt(totalRecaudos);
                      totalCaja = totalCaja - parseInt(respuestaGlobal.gastos);
                      let colorCaja = "";
                      let estadoCaja = "";
                    if(respuestaGlobal.caja.estado_caja == "Cerrada"){
                        estadoCaja = "Estado Cerrada";
                        colorCaja = "#FF4545";
                    }else{
                        estadOCaja = "Estado Abierta";
                        colorCaja = "#16D39A";
                       
                    }
                    
                    var docDefinition = {
                        content: [
                            {
                                
                                columns: [  {
                                    text: "" ,
                                    style: 'title'
                                },
                                {
                                    text: estadoCaja,
                                    style: 'colorTextoCaja',
                                },]
                                
                            },
                            {
                                style: 'header',
                                columns: [
                                  
                                    {
                                        text: "Caja #" + agregarCeros(respuestaGlobal.caja.id,5),
                                        style: 'title'
                                    },
                                    {
                                        text: formatCurrency(respuestaGlobal.caja.saldo_inicial, 'es-CO', 'COP'),
                                        style: 'total'
                                    }
                                ]
                                
                            },
                            {
                                style: 'body',
                                columns: [{
                                        width: '33%',
                                        stack: [{
                                                text: 'Fecha de apertura:',
                                                style: 'subTitle'
                                            },
                                            {
                                                text: respuestaGlobal.caja.fecha_apertura,
                                                style: 'info'
                                            }
                                        ]
                                    },
                                    {
                                        width: '33%',
                                        stack: [{
                                                text: 'Fecha de cierre:',
                                                style: 'subTitle'
                                            },
                                            {
                                                text: (respuestaGlobal.caja.estado_caja === 'Cerrada' ? respuestaGlobal.caja.fecha_cierre : 'No aplicable'),
                                                style: 'info'
                                            }
                                        ]
                                    },
                                    {
                                        width: '33%',
                                        stack: [{
                                                text: 'Usuario apertura:',
                                                style: 'subTitle'
                                            },
                                            {
                                                text: respuestaGlobal.caja.nombre_usuario,
                                                style: 'info'
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                            style: 'tableExample',
                                table: {
                                    widths: ['75%', '25%'],
                                    body: [
                                        ['Saldo anterior',   { text: formatCurrency(parseInt(respuestaGlobal.caja.saldo_anterior), 'es-CO', 'COP'), alignment: 'right' }],
                                        ['Abono inicial',  { text: formatCurrency(respuestaGlobal.caja.abono_inicial, 'es-CO', 'COP'), alignment: 'right' }],
                                        [{text: 'Saldo inicial total', fillColor:'#D7D7DB'},  { text: formatCurrency(respuestaGlobal.caja.saldo_inicial, 'es-CO', 'COP'), alignment: 'right',fillColor:'#D7D7DB'}]
                                    ]
                                }
                            },
                            {
                                style: 'tableExample',  // Puedes ajustar el estilo según tus necesidades
                                table: {
                                    headerRows: 0,  // Sin filas de encabezado
                                    widths: ['75%', '25%'],
                                    body: [
                                        ...Object.keys(totals).map(medioPago => [
                                            `${medioPago} (${totals[medioPago].count})`,
                                            { text: formatCurrency(totals[medioPago].total, 'es-CO', 'COP'), alignment: 'right' }
                                        ])
                                    ],
                                    // Configuración de estilos de la tabla
                                    margin: [0, 0, 0, 0],  // Configuración de márgenes para quitar el borde superior
                                    layout: {
                                        hLineWidth: function (i, node) {
                                            return (i === 0) ? 0 : 1;  // 0 para quitar el borde superior, 1 para mantener el resto de los bordes
                                        },
                                        vLineWidth: function (i, node) {
                                            return 0;
                                        },
                                        hLineColor: function (i, node) {
                                            return '#fff';  // Color blanco para ocultar el borde superior
                                        },
                                        vLineColor: function (i, node) {
                                            return '#fff';
                                        },
                                    }
                                }
                            },
                            {
                                style: 'tableExample',  // Puedes ajustar el estilo según tus necesidades
                                table: {
                                    headerRows: 0,  // Sin filas de encabezado
                                    widths: ['75%', '25%'],
                                    body: [
                                        [{text: 'Recaudos' , fillColor:'#D7D7DB'}, { text: formatCurrency(respuestaGlobal.gastos, 'es-CO', 'COP'), fillColor:'#D7D7DB', alignment: 'right' }]
                                    ],
                                    // Configuración de estilos de la tabla
                                    layout: {
                                        hLineWidth: function (i, node) {
                                            return (i === 0) ? 0 : 1;  // 0 para quitar el borde superior, 1 para mantener el resto de los bordes
                                        },
                                        vLineWidth: function (i, node) {
                                            return 0;
                                        },
                                        hLineColor: function (i, node) {
                                            return '#fff';  // Color blanco para ocultar el borde superior
                                        },
                                        vLineColor: function (i, node) {
                                            return '#fff';
                                        },
                                    }
                                }
                            },
                            {
                                style: 'tableExample',  // Puedes ajustar el estilo según tus necesidades
                                table: {
                                    headerRows: 0,  // Sin filas de encabezado
                                    widths: ['75%', '25%'],
                                    body: [
                                        [{text: 'Gastos'}, { text: formatCurrency(totalRecaudos, 'es-CO', 'COP'), alignment: 'right' }]
                                    ],
                                    // Configuración de estilos de la tabla
                                    layout: {
                                        hLineWidth: function (i, node) {
                                            return (i === 0) ? 0 : 1;  // 0 para quitar el borde superior, 1 para mantener el resto de los bordes
                                        },
                                        vLineWidth: function (i, node) {
                                            return 0;
                                        },
                                        hLineColor: function (i, node) {
                                            return '#fff';  // Color blanco para ocultar el borde superior
                                        },
                                        vLineColor: function (i, node) {
                                            return '#fff';
                                        },
                                    }
                                }
                            },
                            {
                                style: 'tableExample',  // Puedes ajustar el estilo según tus necesidades
                                table: {
                                    headerRows: 0,  // Sin filas de encabezado
                                    widths: ['75%', '25%'],
                                    body: [
                                        [{text: 'Total caja (saldo inicial + recaudado - gastos): ' , fillColor:'#D7D7DB'}, { text: formatCurrency(totalCaja, 'es-CO', 'COP'), fillColor:'#D7D7DB', alignment: 'right' }]
                                    ],
                                    // Configuración de estilos de la tabla
                                    layout: {
                                        hLineWidth: function (i, node) {
                                            return (i === 0) ? 0 : 1;  // 0 para quitar el borde superior, 1 para mantener el resto de los bordes
                                        },
                                        vLineWidth: function (i, node) {
                                            return 0;
                                        },
                                        hLineColor: function (i, node) {
                                            return '#fff';  // Color blanco para ocultar el borde superior
                                        },
                                        vLineColor: function (i, node) {
                                            return '#fff';
                                        },
                                    }
                                }
                            },
                            

                        ],
                        styles: {
                            header: {
                                margin: [0, 20, 0, 20]
                            },
                            title: {
                                fontSize: 18,
                                bold: true
                            },
                            total: {
                                fontSize: 22,
                                bold: true,
                                alignment: 'right'
                            },
                            body: {
                                margin: [0, 20, 0, 20]
                            },
                            subTitle: {
                                fontSize: 12,
                                bold: true
                            },
                            info: {
                                fontSize: 12
                            },
                            table: {
                                margin: [0, 10, 0, 10]
                            },
                            footerButtons: {
                                margin: [0, 20, 0, 0]
                            },
                            tableExample: {
                                margin: [0, 10, 0, 0]
                            },
                            tableExample1: {
                                margin: [0, 0, 0, 10]
                            },
                            colorTextoCaja: {
                                color: colorCaja,
                                bold: true,
                                fontSize: 22,
                                alignment: 'right'
                            },
                        }
                    };

                    if (respuestaGlobal.caja.estado_caja === 'Cerrada') {
                        // Agregar la tabla de saldo de cierre al documento PDF
                        docDefinition.content.push({
                            style: 'tableExample',
                            table: {
                                headerRows: 0,
                                widths: ['75%', '25%'],
                                body: [
                                    [{ text: 'Saldo cierre:', fillColor: '#D7D7DB' }, { text: formatCurrency(respuestaGlobal.caja.saldo_cierre, 'es-CO', 'COP'), fillColor: '#D7D7DB', alignment: 'right' }]
                                ],
                                // Configuración de estilos de la tabla
                                margin: [0, 0, 0, 0],  // Configuración de márgenes para quitar el borde superior
                                layout: {
                                    hLineWidth: function (i, node) {
                                        return (i === 0) ? 0 : 1;  // 0 para quitar el borde superior, 1 para mantener el resto de los bordes
                                    },
                                    vLineWidth: function (i, node) {
                                        return 0;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#fff';  // Color blanco para ocultar el borde superior
                                    },
                                    vLineColor: function (i, node) {
                                        return '#fff';
                                    },
                                }
                            }
                        });
                    }               

                    // Generar el PDF y descargarlo
                    pdfMake.createPdf(docDefinition).download('documento.pdf');

                }
            });

            $.cargar(1);
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                // Asegurarse de que 'page' sea un número antes de hacer la solicitud
                if (!isNaN(page)) {
                    $.cargar(page);
                }
            });


            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val();
                $.cargar(1, searchTerm); // Cargar la primera página con el término de búsqueda
            });
        })

        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
        }

        function agregarCeros(numero, longitud) {
            return numero.toString().padStart(longitud, '0');
        }


        function validartxtnum(e) {
            tecla = e.which || e.keyCode;
            patron = /[0-9]+$/;
            te = String.fromCharCode(tecla);
            //    if(e.which==46 || e.keyCode==46) {
            //        tecla = 44;
            //    }
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 44);
        }

        function validartxt(e) {
            tecla = e.which || e.keyCode;
            patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
            te = String.fromCharCode(tecla);
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
        }
        // Función para formatear números como moneda
       
    </script>

    </script>
@endsection
