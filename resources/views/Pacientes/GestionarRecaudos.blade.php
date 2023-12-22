@extends('Plantilla.Principal')
@section('title', 'Gestionar Recaudos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="RutaTotal" data-ruta="{{ asset('/') }}" />
    <input type="hidden" id="accion" value="" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Recaudos</h3>
        </div>
    </div>

    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="bug-list-search">
                        <div class="bug-list-search-content">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i>
                            </div>

                            <div class="position-relative">
                                <select class="select2-data-ajax form-control" id="paciente" name="paciente"></select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="content-body">

                    <section id="div-datTratameintos" style=" filter: blur(5px);" class="row all-contacts">
                        <div class="col-12">
                            <div class="card">
                                <div>
                                    <h4 class="card-title ml-2" id="titTrataPac">Planes de tratamiento del paciente</h4>
                                </div>

                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-top-border no-hover-bg" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="baseIcon-tab11" data-toggle="tab"
                                                    aria-controls="tabIcon11" href="#tabIcon11" role="tab"
                                                    aria-selected="true"><i class="fa fa-shopping-cart"></i> Realizar
                                                    recaudo al paciente</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab12" data-toggle="tab"
                                                    aria-controls="tabIcon12" href="#tabIcon12" role="tab"
                                                    aria-selected="false"><i class="fa fa-eye"></i> Recaudos realizados al
                                                    paciente</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div class="tab-pane active" id="tabIcon11" role="tabpanel"
                                                aria-labelledby="baseIcon-tab11">
                                                <div class="card-content" id="listRecaudo">
                                                    <div id="daily-activity" class="table-responsive height-300">
                                                        <table class="table table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <input type="checkbox" id="icheck-input-all"
                                                                            class="icheck-activity">
                                                                    </th>
                                                                    <th>Tratamiento</th>
                                                                    <th>Total</th>
                                                                    <th>Realizado</th>
                                                                    <th>Pagado</th>
                                                                    <th>Saldo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="trTratamientos">

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-actions">
                                                            <div class="text-right">
                                                                <button type="button" onclick="$.pagarTratamiento();"
                                                                    class="btn btn-success"> Pagar Tratamiento<i
                                                                        class="feather icon-chevron-right position-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <form class="form" method="post" id="formGuardarPagoTratamiento"
                                                    action="{{ url('/') }}/AdminPacientes/GuardarPagoTratamiento">
                                                    @csrf
                                                    <input type="hidden" name="idTransaccion" id="idTransaccion"
                                                        value="" />
                                                    <div class="card-content" style="display: none;" id="pagoRecaudo">
                                                        <div id="daily-activity" class="table-responsive"
                                                            style="overflow: hidden;">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                        </th>
                                                                        <th>Servicio</th>
                                                                        <th>Valor</th>
                                                                        <th>Abonado</th>
                                                                        <th>Estado</th>
                                                                        <th>Por Abonar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="trDetTratamientos">

                                                                </tbody>
                                                            </table>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-7 col-sm-7 mt-75">
                                                                <!-- Contenido de la primera columna -->
                                                            </div>
                                                            <div class="col-4 col-sm-4 d-flex justify-content-end mt-75">
                                                                <ul class="list-group cost-list">

                                                                    <li
                                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                                        <span
                                                                            class="cost-title text-bold-600 mr-2">Servicios
                                                                            Seleccionados:
                                                                        </span>
                                                                        <span class="cost-value" id="totalServ">$
                                                                            0,00</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                                        <span class="cost-title text-bold-600 mr-2">Saldo
                                                                            previo abonos:
                                                                        </span>
                                                                        <div class="badge badge-success" id="totalAbono">$
                                                                            10.000,00</div>

                                                                    </li>
                                                                    <li
                                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                                        <span class="cost-title text-bold-600 mr-2">Total a
                                                                            pagar: </span>
                                                                        <span class="cost-value" id="totalPago">$
                                                                            0,00</span>
                                                                    </li>

                                                                    <li
                                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                                        <div class="form-check" style="width: 100%">
                                                                            <input type="checkbox"
                                                                                onclick="$.habilAbono(this);"
                                                                                class="form-check-input" id="checkAbono">
                                                                            <label class="form-check-label"
                                                                                for="icheck-input-all">Ingresar
                                                                                abono libre:</label>
                                                                        </div>

                                                                        <input type="text" disabled valor="0,00"
                                                                            onkeypress="return validartxtnum(event)"
                                                                            onchange="$.cambioFormato(this.id);"
                                                                            onclick="this.select();" class="form-control"
                                                                            id="valorVisAbono" name="valorVisAbono">
                                                                        <input type="hidden" value="10000"
                                                                            id="valorAbonoPrev" name="valorAbonoPrev">
                                                                        <input type="hidden" value="0"
                                                                            id="valorAbono" name="valorAbono">
                                                                        <input type="hidden" value="0"
                                                                            id="totalServText" name="totalServText">
                                                                        <input type="hidden" value="no"
                                                                            id="selAbono" name="selAbono">
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12 mt-1 ml-2">
                                                                <h4>Medio de pago</h4>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id='consMedio' name='consMedio'
                                                            value="1" />
                                                        <div class="row ml-1 mr-1" id="div-medioPago">
                                                            <div style="width: 100%;" id="medioPago1"
                                                                class="bs-callout-blue-grey callout-border-left callout-bordered callout-transparent mt-1 p-1 medioPago">
                                                                <div class="row">
                                                                    <div class="col-xl-4 col-md-4 col-4">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Medio de pago:</label>
                                                                                <select class="select2 form-control"
                                                                                    id="medioPago1" name="medioPago[]"
                                                                                    onchange="$.cammbioMedioPago(1);">
                                                                                    <option value="e">Efectivo
                                                                                    </option>
                                                                                    <option value="t">Transferencia
                                                                                    </option>
                                                                                    <option value="td">Tarjeta de
                                                                                        débito</option>
                                                                                    <option value="tc">Tarjeta de
                                                                                        crédito</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-md-3 col-3">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Valor:</label>
                                                                                <input type="text"
                                                                                    onkeypress="return validartxtnum(event)"
                                                                                    data-cons="1" valor="0,00"
                                                                                    onclick="this.select();"
                                                                                    onchange="$.cambioFormatoPago(this.id);"
                                                                                    class="form-control"
                                                                                    id="valorVisPago1"
                                                                                    name="valorVisPago">
                                                                                <input type="hidden" class="montMedio"
                                                                                    value="0" id="valorPago1"
                                                                                    name="valorPago[]">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-4 col-md-4 col-4">
                                                                        <div class="form-group" id="div-tranfe1"
                                                                            style="display: none;">
                                                                            <div class="controls">
                                                                                <label>Número de Referencia:</label>
                                                                                <input type="text" valor=""
                                                                                    class="form-control"
                                                                                    id="referenciaPago"
                                                                                    name="referenciaPago[]">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-1 col-md-3 col-3 align-content-end">
                                                                        <button type="button"
                                                                            onclick="$.delMedioPago(1);"
                                                                            class="btn btn-icon btn-pure danger mr-1"><i
                                                                                class="fa fa-trash-o"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="form-group">
                                                                <button onclick="$.addMedioPago(1);"
                                                                    class="btn btn-primary mt-1" type="button">
                                                                    <i class="fa fa-plus"></i> Agregar Medio de pago
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="form-actions">
                                                                <div class="text-right">
                                                                    <button type="button" onclick="$.atrasTratamiento();"
                                                                        class="btn btn-info">
                                                                        <i
                                                                            class="feather icon-chevron-left position-left"></i>
                                                                        Atras</button>
                                                                    <button type="button"
                                                                        onclick="$.ConfirpagoTratamiento();"
                                                                        class="btn btn-success"> Confirmar pago<i
                                                                            class="feather icon-chevron-right position-right"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div class="card-content" id="listRecaudoComprobante"
                                                    style="display: none;">
                                                    <section class="app-invoice-wrapper">
                                                        <div class="row">
                                                            <div class="col-xl-9 col-md-8 col-12 printable-content">
                                                                <!-- using a bootstrap card -->
                                                                <div class="card">
                                                                    <!-- card body -->
                                                                    <div class="card-body p-2">
                                                                        <!-- card-header -->
                                                                        <div class="card-header px-0">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-md-12 col-lg-7 col-xl-4 mb-50">
                                                                                    <span
                                                                                        class="invoice-id font-weight-bold">Comprobante#
                                                                                    </span>
                                                                                    <span id="ncompro"></span>
                                                                                </div>
                                                                                <div class="col-md-12 col-lg-5 col-xl-8">
                                                                                    <div
                                                                                        class="d-flex align-items-center justify-content-end justify-content-xs-start">
                                                                                        <div class="issue-date pr-2">
                                                                                            <span
                                                                                                class="font-weight-bold no-wrap">Fecha
                                                                                                de
                                                                                                creación: </span>
                                                                                            <span
                                                                                                id="fcreacion">07/02/2019</span>
                                                                                        </div>
                                                                                        <div class="due-date">
                                                                                            <span
                                                                                                class="font-weight-bold no-wrap">Fecha
                                                                                                de
                                                                                                impresión: </span>
                                                                                            <span
                                                                                                id="fimpresion">06/04/2019</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- invoice logo and title -->
                                                                        <div class="invoice-logo-title row py-2">
                                                                            <div
                                                                                class="col-6 d-flex flex-column justify-content-center align-items-start">
                                                                                <h2 class="text-primary">Comprobante de
                                                                                    pago</h2>
                                                                                <span>PERFECTA S.A.S</span>
                                                                            </div>
                                                                            <div
                                                                                class="col-6 d-flex justify-content-end invoice-logo">
                                                                                <img src="{{ asset('app-assets/images/logo/stack-logo-light.png') }}"
                                                                                    alt="company-logo" id="logoPerfecta"
                                                                                    height="46" width="164">
                                                                            </div>
                                                                        </div>
                                                                        <hr>

                                                                        <!-- invoice address and contacts -->
                                                                        <div class="row invoice-adress-info py-2">
                                                                            <div class="col-12 mt-1 from-info">
                                                                                <div class="info-title mb-1">
                                                                                    <span class="font-weight-bold no-wrap"
                                                                                        style="font-size: 20px;">Paciente</span>
                                                                                </div>
                                                                                <div class="company-name mb-1">
                                                                                    <div class="issue-date pr-2">
                                                                                        <span
                                                                                            class="font-weight-bold no-wrap">Identificación:
                                                                                        </span>
                                                                                        <span id="nidentificacion"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="company-address mb-1">
                                                                                    <span
                                                                                        class="font-weight-bold no-wrap">Nombre
                                                                                        Paciente:
                                                                                    </span>
                                                                                    <span id="npaciente"></span>
                                                                                </div>


                                                                            </div>

                                                                        </div>

                                                                        <div class="row invoice-adress-info py-2">
                                                                            <div class="col-6 mt-1 from-info">
                                                                                <div class="info-title mb-1">
                                                                                    <span class="font-weight-bold no-wrap"
                                                                                        style="font-size: 20px;">Tratamiento</span>
                                                                                </div>
                                                                                <div class="company-name mb-1">
                                                                                    <span
                                                                                        class="font-weight-bold no-wrap">Descripción:
                                                                                    </span>
                                                                                    <span id="ntratamiento"></span>
                                                                                </div>
                                                                                <div class="company-email  mb-1 mb-1">
                                                                                    <span
                                                                                        class="font-weight-bold no-wrap">Profesional:
                                                                                    </span>
                                                                                    <span id="nprofesional"></span>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-6 mt-1 to-info">
                                                                                <div class="info-title mb-1">
                                                                                    <span>&nbsp;</span>
                                                                                </div>
                                                                                <div class="company-name mb-1">
                                                                                    <span
                                                                                        class="font-weight-bold no-wrap">Abono:
                                                                                    </span>
                                                                                    <span id="valorAbonoComp"></span>
                                                                                </div>
                                                                                <div class="company-name mb-1">
                                                                                    <span
                                                                                        class="font-weight-bold no-wrap"></span>
                                                                                    <span></span>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!--product details table -->
                                                                        <h4>Detalles medio de pago</h4>
                                                                        <div
                                                                            class="product-details-table py-2 table-responsive">
                                                                            <table class="table table-borderless">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Medio de pago
                                                                                        </th>
                                                                                        <th scope="col">Valor</th>
                                                                                        <th scope="col">Referencia de
                                                                                            pago</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tr-medioPago">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <hr>
                                                                        <h4 id="titServAbon" style="display: none;">
                                                                            Detalles de servicios
                                                                            abonados</h4>
                                                                        <div id="tablaServAbon" style="display: none;"
                                                                            class="product-details-table py-2 table-responsive">
                                                                            <table class="table table-borderless">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Servicio</th>
                                                                                        <th scope="col">Valor</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tr-servAbonado">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <hr>
                                                                        <!-- invoice total -->
                                                                        <div class="invoice-total py-2">
                                                                            <div class="row">
                                                                                <div class="col-4 col-sm-6 mt-75">

                                                                                </div>
                                                                                <div
                                                                                    class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                                                    <ul class="list-group cost-list">
                                                                                        <li
                                                                                            class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                                                            <span
                                                                                                class="font-weight-bold no-wrap mr-2">Valor
                                                                                                Total: </span>
                                                                                            <span class="cost-value"
                                                                                                id="vtotal"></span>
                                                                                        </li>
                                                                                        <li class="dropdown-divider"></li>

                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- buttons section -->
                                                            <div class="col-xl-3 col-md-4 col-12 action-btns">
                                                                <div class="card">
                                                                    <div class="card-body p-2">
                                                                        <a onclick="$.imprimirComprobante();"
                                                                            class="btn btn-info btn-block mb-1 print-invoice">
                                                                            <i
                                                                                class="feather icon-printer mr-25 common-size"></i>
                                                                            Imprimir comprobante</a>
                                                                        <a onclick="$.enviarComprobante();"
                                                                            class="btn btn-success btn-block mb-1 print-invoice">
                                                                            <i
                                                                                class="feather icon-navigation mr-25 common-size"></i>
                                                                            Enviar comprobante</a>
                                                                        <a onclick="$.otroPago();"
                                                                            class="btn btn-success btn-block mb-1"><i
                                                                                class="feather icon-credit-card mr-25 common-size"></i>
                                                                            Realizar Pago</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabIcon12" role="tabpanel"
                                                aria-labelledby="baseIcon-tab12">
                                                <div id="audience-list-scroll" style="height: 400px; overflow: auto;" class="table-responsive position-relative">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>Transacción</th>
                                                            <th>Tratamiento</th>
                                                            <th>Fecha de pago</th>
                                                            <th>Valor</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tr-recaudosRealizados">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>






                    </section>


                </div>
            </div>
        </div>

    </section>
    </div>
    </div>
    </div>
    </section>

    <div id="loader" class="loader-spinner" style="display: none;">
        <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
        <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>
    </div>

    <form action="{{ url('/AdminPacientes/TratamientosRecaudo') }}" id="formCargarTratamientos" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/TratamientosRecaudoDetalles') }}" id="formBuscDetTrata" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/CargarHistoricoTransacciones') }}" id="formCargarTransacciones" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/DeleteTransaccion') }}" id="formDeleteTransaccion" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenRecaudo").addClass("active");

            var lastSelectedData = null;
            var transaccionGlobal = [];

            $('#paciente').on('select2:select', function(e) {
                // Obtener la información del elemento seleccionado
                var selectedData = e.params.data;

                // Mostrar la información del último elemento seleccionado
                if (selectedData) {
                    lastSelectedData = selectedData;
                    mostrarInformacionUltimoSeleccionado();
                }
            });

            function mostrarInformacionUltimoSeleccionado() {
                if (lastSelectedData) {
                    var datTratameintos = document.getElementById(
                        'div-datTratameintos'
                    ); // Reemplaza 'miDiv' con el ID de tu div
                    datTratameintos.style.filter = 'none';
                    $.atrasTratamiento();
                    $.buscInfTratamientos(lastSelectedData.id);
                }
            }

            $.extend({
                buscInfTratamientos: function(idPac, idTrata) {

                    var form = $("#formCargarTratamientos");
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + idPac + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    let tratamientos = '';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {

                            $.each(respuesta.tratamientosRecaudo, function(i, item) {
                                tratamientos += '<tr >';

                                if (typeof idTrata != 'undefined') {

                                    if (item.tratamiento == idTrata) {
                                        tratamientos +=
                                            '<td class="text-truncate"  style="vertical-align: middle; ">' +
                                            '    <input type="checkbox" checked data-id="' +
                                            item
                                            .tratamiento +
                                            '" id="checkRecaudo' + item
                                            .tratamiento +
                                            '" class="icheck-activity classTrata">' +
                                            '</td>';
                                    } else {
                                        tratamientos +=
                                            '<td class="text-truncate" style="vertical-align: middle; ">' +
                                            '    <input type="checkbox"  data-id="' +
                                            item
                                            .tratamiento +
                                            '" id="checkRecaudo' + item
                                            .tratamiento +
                                            '" class="icheck-activity classTrata">' +
                                            '</td>';
                                    }

                                } else {

                                    tratamientos +=
                                        '<td class="text-truncate" style="vertical-align: middle; ">' +
                                        '    <input type="checkbox"  data-id="' +
                                        item
                                        .tratamiento +
                                        '" id="checkRecaudo' + item.tratamiento +
                                        '" class="icheck-activity classTrata">' +
                                        '</td>';

                                }

                                tratamientos += '<td class="text-truncate">' +
                                    '    <div>' +
                                    '        <p class="mb-25 latest-update-item-name text-bold-600">' +
                                    item.nombreTratamiento +
                                    '        </p>' +
                                    '        <small class="font-small-3">Prof.: ' +
                                    item.nombreProfesional + '</small>' +
                                    '    </div>' +
                                    '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle; t">' +
                                    formatCurrency(
                                        item.total, 'es-CO', 'COP') + '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle; ">' +
                                    formatCurrency(
                                        item.realizado, 'es-CO', 'COP') + '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle; ">' +
                                    formatCurrency(
                                        item.pagado, 'es-CO', 'COP') + '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle;">' +
                                    formatCurrency(
                                        item.saldo, 'es-CO', 'COP') + '</td>' +
                                    '</tr>';

                                $("#titTrataPac").html("Planes de tratamiento / " +
                                    item.nombrePaciente);
                                $("#valorAbonoPrev").val(item.saldoPrevio);
                                $("#totalAbono").html(formatCurrency(item
                                    .saldoPrevio, 'es-CO', 'COP'));

                            });
                            $("#trTratamientos").html(tratamientos);


                            //TRATAMIENTOS REALIZADOS
                            let recaudos = '';
                        
                            $.each(respuesta.recaudos, function(i, item) {
                                console.log(item.nombre);
                                recaudos+='<tr>'
                                    +'<td class="align-middle">'
                                    +'    <span>'+agregarCeros(item.id,5)+'</span>'
                                    +'</td>'
                                    +'<td class="align-middle">'
                                    +'    <span>'+item.nombre+'</span>'
                                    +'</td>'
                                    +'<td class="align-middle">'
                                    + item.created_at
                                    +'</td>'
                                    +'<td class="align-middle">'
                                  + formatCurrency(item.pago_realizado, 'es-CO', 'COP')
                                    +'</td>'
                                    +'<td class="align-middle">'
                                    +'    <div class="dropdown">'
                                    +'        <span'
                                    +'            class="feather icon-more-vertical dropdown-toggle"'
                                    +'            id="dropdownMenuButton" data-toggle="dropdown"'
                                    +'            aria-haspopup="true" aria-expanded="false">'
                                    +'        </span>'
                                    +'        <div class="dropdown-menu dropdown-menu-right"'
                                    +'            aria-labelledby="dropdownMenuButton">'
                                    +'            <a class="dropdown-item" onclick="$.printCompHistorico('+item.id+');"><li class="fa fa-print"></li> Imprimir</a>'
                                    +'                <a class="dropdown-item" onclick="$.enviarCompHistorico('+item.id+');"><li class="fa fa-paper-plane-o"></li> Enviar</a>'
                                    +'            <a class="dropdown-item" onclick="$.deleteCompHistorico('+item.id+');"><li class="fa fa-trash-o"></li> Eliminar</a>'
                                    +'        </div>'
                                    +'   </div>'
                                    +'    </span>'
                                    +'</td>'
                                +' </tr>';
                            });

                            $("#tr-recaudosRealizados").html(recaudos);
                        }
                    });

                    $.checkRecaudos();
                },
                deleteCompHistorico: function(transa){

                    var form = $("#formDeleteTransaccion");
                    $("#idTransaccion").remove();
                    form.append("<input type='hidden' id='idTransaccion' name='idTransaccion'  value='" + transa + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                         
                        }

                    });

                },
                printCompHistorico: function (transa) {

                    var form = $("#formCargarTransacciones");
                    $("#idTransaccion").remove();
                    form.append("<input type='hidden' id='idTransaccion' name='idTransaccion'  value='" + transa + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            transaccionGlobal = respuesta;
                            $.imprimirComprobante();
                        }

                    });

                },
                otroPago: function() {
                    var datTratameintos = document.getElementById(
                        'div-datTratameintos'
                    ); // Reemplaza 'miDiv' con el ID de tu div
                    datTratameintos.style.filter = 'none';
                    $.atrasTratamiento();
                    $.buscInfTratamientos(lastSelectedData.id);
                },
                imprimirComprobante: function() {
                var loader = document.getElementById('loader');
                loader.style.display = 'block';
                
                const image = document.getElementById('logoPerfecta');
                // Convertir la imagen en una URL de datos Base64
                const canvas = document.createElement('canvas');
                canvas.width = 600;
                canvas.height = 141;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(image, 0, 0);
                const base64data = canvas.toDataURL();
                
                var docDefinition = {
                    pageMargins: [40, 60, 40, 60], // Márgenes [izquierda, arriba, derecha, abajo]
                    content: [{
                            image: base64data,
                            width: 200,
                            margin: [0, 0, 0, 0],
                            alignment: 'center', // Alineación centrada
                        },
                        {
                            style: 'card',
                            stack: [{
                                    style: 'cardBody',
                                    stack: [{
                                            style: 'cardHeader',
                                            stack: [{
                                                columns: [{
                                                        width: '40%',
                                                        stack: [ {
                                                            text: 'PERFECTA S.A.S',
                                                            style: 'subheader',
                                                            alignment: 'left', // Alineación centrada
                                                        },
                                                        {
                                                            text: 'NIT: 1065643203' ,
                                                            style: 'subheaderfecha',
                                                        },
                                                        {
                                                            text: 'Teléfono: 312 8817962',
                                                            style: 'subheaderfecha',
                                                        }
                                                        ]
                                                    },
                                                    {
                                                        width: '60%',
                                                        stack: [{
                                                                text: 'Comprobante #' + agregarCeros(transaccionGlobal.transaccion.id, 5),
                                                                style: 'subheader',
                                                            },
                                                            {
                                                                text: 'Fecha de creación: ' + convertirFormatoFechaHora(transaccionGlobal.transaccion.created_at),
                                                                style: 'subheaderfecha',
                                                            },
                                                            {
                                                                text: 'Fecha de impresión: ' + convertirFormatoFechaHora(new Date()),
                                                                style: 'subheaderfecha',
                                                            }
                                                        ],
                                                        alignment: 'right',
                                                    }
                                                ]
                                            }]
                                        },
                                        {
                                            canvas: [{
                                                type: 'line',
                                                x1: 0,
                                                y1: 0,
                                                x2: 515,
                                                y2: 0,
                                                lineWidth: 1,
                                                lineColor: '#000',
                                            }]
                                        },
                
                                        {
                                            style: 'invoiceAdressInfo',
                                            stack: [{
                                                style: 'fromInfo',
                                                stack: [{
                                                        style: 'infoTitle',
                                                        text: 'Paciente',
                                                    },
                                                    {
                                                        style: 'companyName',
                                                        stack: [{
                                                            text: 'Identificación: ' + transaccionGlobal.tratamiento.identificacion,
                                                            style: 'subheader',
                                                        }]
                                                    },
                                                    {
                                                        style: 'companyAddress',
                                                        stack: [{
                                                            text: 'Nombre: ' + transaccionGlobal.tratamiento.npaciente + ' ' + transaccionGlobal.tratamiento.apellido,
                                                            style: 'subheader',
                                                        }]
                                                    }
                                                ]
                                            }]
                                        },
                                        {
                                            canvas: [{
                                                type: 'line',
                                                x1: 0,
                                                y1: 0,
                                                x2: 515,
                                                y2: 0,
                                                lineWidth: 1,
                                                lineColor: '#000',
                                            }]
                                        },
                
                                        {
                                            style: 'invoiceAdressInfo',
                                            stack: [{
                                                    style: 'fromInfo',
                                                    stack: [{
                                                            style: 'infoTitle',
                                                            text: 'Tratamiento',
                                                        },
                                                        {
                                                            style: 'companyName',
                                                            stack: [{
                                                                text: transaccionGlobal.tratamiento.nombre,
                                                                style: 'subheader',
                                                            }]
                                                        },
                                                        {
                                                            style: 'companyEmail',
                                                            stack: [{
                                                                text: 'Profesional: ' + transaccionGlobal.tratamiento.nprofe,
                                                                style: 'subheader',
                                                            }]
                                                        }
                                                    ]
                                                },
                                                {
                                                    style: 'toInfo',
                                                    stack: [{
                                                        style: 'companyName',
                                                        stack: [{
                                                            text: 'Pago realizado: ' + formatCurrency(transaccionGlobal.transaccion.pago_realizado, 'es-CO', 'COP'),
                                                            style: 'subheader',
                                                        }]
                                                    }]
                                                }
                                            ]
                                        },
                                        {
                                            canvas: [{
                                                type: 'line',
                                                x1: 0,
                                                y1: 0,
                                                x2: 515,
                                                y2: 0,
                                                lineWidth: 1,
                                                lineColor: '#000',
                                            }]
                                        },
                                    ]
                                }]
                            },
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true,
                            },
                            subheader: {
                                fontSize: 14,
                                bold: true,
                            },
                            subheaderfecha: {
                                fontSize: 10,
                                bold: false,
                            },
                            card: {
                                margin: [0, 10, 0, 10],
                            },
                            cardBody: {
                                margin: [0, 0, 0, 0],
                            },
                            cardHeader: {
                                margin: [0, 10, 0, 10],
                            },
                            invoiceAdressInfo: {
                                margin: [0, 5, 0, 5],
                            },
                            fromInfo: {
                                margin: [0, 0, 0, 0],
                            },
                            infoTitle: {
                                fontSize: 16,
                                bold: true,
                            },
                            companyName: {
                                fontSize: 14,
                                bold: true,
                            },
                            companyAddress: {
                                fontSize: 14,
                            },
                            companyEmail: {
                                fontSize: 14,
                            },
                            toInfo: {
                                margin: [0, 10, 0, 10],
                            },
                            productDetailsTable: {
                                margin: [0, 10, 0, 0],
                            },
                        },
                    };
                
                let vtotal = 0;
                let referencia = '';
                
                docDefinition.content.push({
                    margin: [0, 0, 0, 10],
                    text: 'Detalles medio de pago',
                    style: 'header',
                    alignment: 'left', // Alineación a la izquierda
                });
                
                var separatorLine = {
                    canvas: [{
                        type: 'line',
                        x1: 0,
                        y1: 0,
                        x2: 515,
                        y2: 0,
                        lineWidth: 1,
                        lineColor: '#000',
                    }]
                };
                
                docDefinition.content.push(
                    separatorLine, {
                        margin: [0, 0, 0, 5],
                        table: {
                            headerRows: 1,
                            widths: ['50%', '25%', '25%'],
                            body: [
                                ['Medio de pago', 'Referencia de pago', 'Valor']
                            ],
                        },
                        layout: {
                            hLineColor: function (i, node) {
                                return '#FFF';
                            },
                            vLineColor: function (i, node) {
                                return '#FFF';
                            },
                        },
                    }
                );
                
                $.each(transaccionGlobal.medioPago, function (i, item) {
                    referencia = item.referencia !== null ? item.referencia : '---';
                    docDefinition.content.push({
                        table: {
                            widths: ['50%', '25%', '25%'],
                            body: [
                                [item.medpago, referencia, formatCurrency(item.valor, 'es-CO', 'COP')]
                            ],
                        },
                        layout: {
                            hLineColor: function (i, node) {
                                return i === 0 ? '#000' : '#FFF';
                            },
                            vLineColor: function (i, node) {
                                return '#FFF';
                            },
                        },
                    });
                    vtotal = vtotal + item.valor;
                });
                
                if (transaccionGlobal.servTerminado.length > 0) {
                    docDefinition.content.push({
                        canvas: [{
                            type: 'line',
                            x1: 0,
                            y1: 10,
                            x2: 515,
                            y2: 10,
                            lineWidth: 1,
                            lineColor: '#000',
                        }]
                    }, {
                        margin: [0, 10, 0, 10],
                        text: 'Detalles de servicios abonados',
                        style: 'header',
                        alignment: 'left', // Alineación a la izquierda
                    });
                
                    docDefinition.content.push(
                        separatorLine, {
                            margin: [0, 0, 0, 5],
                            table: {
                                headerRows: 1,
                                widths: ['10%', '70%', '20%'],
                                body: [
                                    ['#', 'Servicio', 'Valor']
                                ],
                            },
                            layout: {
                                hLineColor: function (i, node) {
                                    return '#FFF';
                                },
                                vLineColor: function (i, node) {
                                    return '#FFF';
                                },
                            },
                        }
                    );
                
                    $.each(transaccionGlobal.servTerminado, function (i, item) {
                        docDefinition.content.push({
                            table: {
                                widths: ['10%', '70%', '20%'],
                                body: [
                                    [i + 1, item.nombre, formatCurrency(item.valor, 'es-CO', 'COP')]
                                ],
                            },
                            layout: {
                                hLineColor: function (i, node) {
                                    return i === 0 ? '#000' : '#FFF';
                                },
                                vLineColor: function (i, node) {
                                    return '#FFF';
                                },
                            },
                        });
                    });
                }
                
                docDefinition.content.push({
                    text: 'Valor Total: ' + formatCurrency(vtotal, 'es-CO', 'COP'),
                    style: 'header',
                    alignment: 'right',
                    margin: [0, 40, 0, 0],
                });
                
                setTimeout(function () {
                    // Ocultar el loader después de generar el PDF (simulación)
                    loader.style.display = 'none';
                }, 3000);
                
                // Crear y descargar el PDF
                pdfMake.createPdf(docDefinition).download('comprobante_pago.pdf');
                
                },
                checkRecaudos: function() {
                    $(".icheck-activity").iCheck({
                        checkboxClass: "icheckbox_square-green",
                        radioClass: "iradio_square-green"
                    });

                    var checkAll = $('input#icheck-input-all');
                    var checkboxes = $('input.icheck-activity');

                    checkAll.on('ifClicked', function() {
                        if (checkAll.prop('checked')) {
                            checkboxes.iCheck('uncheck');
                        } else {
                            checkboxes.iCheck('check');
                        }
                    });
                },
                checkDetaRecaudos: function() {
                    $(".icheck-activity-det").iCheck({
                        checkboxClass: "icheckbox_square-green",
                        radioClass: "iradio_square-green"
                    });
                    var checkServ = $('input.icheck-activity-det');
                    checkServ.on('ifChecked ifUnchecked', function() {

                        // Obtener valores de los atributos data
                        var valor = $(this).data('valor');
                        var id = $(this).data('id');

                        $.recorrerServ();

                    });


                    //secciones
                },
                recorrerServ: function() {

                    var checkServ = document.getElementsByClassName('icheck-activity-det');
                    var sumTotal = 0;
                    $("#totalServ").html("0,00");
                    for (var i = 0; i < checkServ.length; i++) {
                        if (checkServ[i].checked) {
                            // Obtiene el valor del atributo data-id y lo muestra en la consola
                            var dataIdValor = parseInt(checkServ[i].getAttribute('data-valor'));
                            sumTotal = sumTotal + dataIdValor;
                        }
                    }

                    $("#totalServ").html(formatCurrency(sumTotal, 'es-CO', 'COP'));

                    $.calTotal(sumTotal);
                },
                calTotal: function(sumTotal) {
                    let gtotal = sumTotal - parseInt($("#valorAbonoPrev").val());
                    $("#totalPago").html(formatCurrency(gtotal, 'es-CO', 'COP'));
                    $("#totalServText").val(gtotal);


                    let abono = document.getElementById("checkAbono");
                    if (abono.checked) {
                        $("#valorVisPago1").val(formatCurrency($("#valorAbono").val(), 'es-CO', 'COP'));
                        $("#valorPago1").val($("#valorAbono").val());
                    } else {
                        $("#valorVisPago1").val(formatCurrency(gtotal, 'es-CO', 'COP'));
                        $("#valorPago1").val(gtotal);
                    }
                },
                atrasTratamiento: function() {
                    $("#pagoRecaudo").hide();
                    $("#listRecaudo").show();
                    $("#listRecaudoComprobante").hide();
                    $("#totalServ").html("0,00");
                    $("#totalPago").html("0,00");
                    $("#valorAbono").val("0");
                    $("#totalServText").val("0");
                    $("#selAbono").val("no");
                },
                pagarTratamiento: function() {

                    $("#pagoRecaudo").show();
                    $("#listRecaudo").hide();

                    $("#selAbono").val("no");
                    $("#valorAbono").val('0');
                    $("#valorVisAbono").val('0,00');
                    $("#valorVisPago1").val('0,00');
                    $("#valorPago1").val('0');
                    var miCheckbox = document.getElementById("checkAbono");
                    miCheckbox.checked = false;
                    let abono = document.getElementById("valorVisAbono");
                    abono.disabled = true;

                    var checkboxes = document.getElementsByClassName('classTrata');
                    var dataIds = [];
                    // Itera sobre los checkboxes
                    for (var i = 0; i < checkboxes.length; i++) {
                        // Verifica si el checkbox está marcado
                        if (checkboxes[i].checked) {
                            // Obtiene el valor del atributo data-id y lo muestra en la consola
                            var dataIdValue = checkboxes[i].getAttribute('data-id');
                            dataIds.push(dataIdValue);
                        }
                    }

                    var form = $("#formBuscDetTrata");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    datos += "&dataIds=" + JSON.stringify(dataIds);

                    let trDetalles = "";

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#trDetTratamientos").html(respuesta.detaTrata);
                            $("#valorAbonoPrev").val(respuesta.saldo_previo);
                            $("#totalAbono").html(formatCurrency(respuesta.saldo_previo,
                                'es-CO', 'COP'));
                        }
                    });

                    $.checkDetaRecaudos();


                },
                convertirFormato: function(fechaHora) {
                    // Crear un objeto Date a partir de la cadena de fecha y hora
                    var fecha = new Date(fechaHora);

                    // Obtener los componentes de la fecha y la hora
                    var dia = fecha.getDate();
                    var mes = fecha.getMonth() + 1; // Los meses comienzan desde 0, por lo que sumamos 1
                    var anio = fecha.getFullYear();
                    var horas = fecha.getHours();
                    var minutos = fecha.getMinutes();
                    var ampm = horas >= 12 ? 'PM' : 'AM';

                    // Formatear los componentes en el nuevo formato
                    horas = horas % 12;
                    horas = horas ? horas : 12; // Si es 0, cambiar a 12
                    minutos = minutos < 10 ? '0' + minutos : minutos;

                    // Crear la cadena formateada
                    var nuevoFormato = `${dia}/${mes}/${anio} ${horas}:${minutos} ${ampm}`;

                    return nuevoFormato;
                },
                cambioFormato: function(id) {
                    var numero = $("#" + id).val();
                    $("#valorAbono").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVisAbono").val(formatoMoneda);

                    $("#valorVisPago1").val(formatCurrency(numero, 'es-CO', 'COP'));
                    $("#valorPago1").val(numero);



                },
                cambioFormatoPago: function(id) {
                    var numero = $("#" + id).val();
                    var idInput = $("#" + id).data('cons');
                    $("#valorPago" + idInput).val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVisPago" + idInput).val(formatoMoneda);

                },
                habilAbono: function(elemen) {
                    let abono = document.getElementById("valorVisAbono");
                    if (elemen.checked) {
                        abono.disabled = false;
                        $("#selAbono").val("si");
                        $("#valorAbono").val('0');
                        $("#valorVisAbono").val('0,00');
                        $("#valorVisPago1").val(formatCurrency(0, 'es-CO', 'COP'));
                        $("#valorPago1").val(0);
                    } else {
                        abono.disabled = true;
                        $("#valorAbono").val('0');
                        $("#valorVisAbono").val('0,00');
                        $("#selAbono").val("no");

                        $("#valorVisPago1").val(formatCurrency($("#totalServText").val(), 'es-CO',
                            'COP'));
                        $("#valorPago1").val($("#totalServText").val());

                    }


                },
                cammbioMedioPago: function(id) {
                    let val = $("#medioPago" + id).val();
                    if (val == "e") {
                        $("#div-tranfe" + id).hide();
                    } else {
                        $("#div-tranfe" + id).show();
                    }

                },
                ConfirpagoTratamiento: function() {

                    var checkServ = document.getElementsByClassName('icheck-activity-det');
                    console.log(checkServ.length);
                    var sumTotal = 0;
                    var selServ = false;

                    for (var i = 0; i < checkServ.length; i++) {
                        if (checkServ[i].checked) {
                            var dataIdValor = parseInt(checkServ[i].getAttribute('data-valor'));
                            sumTotal = sumTotal + dataIdValor;
                            selServ = true;
                        }
                    }

                    sumTotal = sumTotal - parseInt($("#valorAbonoPrev").val());

                    if (selServ == false) {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes seleccionar al menos un servicio",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1700,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var medioPagoMonto = document.getElementsByClassName('montMedio');
                    var sumMont = 0;
                    for (var i = 0; i < medioPagoMonto.length; i++) {
                        var dataIdValor = parseInt(medioPagoMonto[i].getAttribute('value'));
                        sumMont = sumMont + dataIdValor;
                    }

                    let abono = document.getElementById("checkAbono");
                    if (abono.checked) {
                        sumTotal = $("#valorAbono").val();
                    }


                    if (sumMont < sumTotal || sumMont > sumTotal) {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "El monto total debe corresponder al valor de los servicios seleccionados ",
                            confirmButtonClass: "btn btn-primary",
                            timer: 3000,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var checkboxes = document.getElementsByClassName('icheck-activity-det');
                    var dataIds = [];
                    // Itera sobre los checkboxes
                    for (var i = 0; i < checkboxes.length; i++) {
                        // Verifica si el checkbox está marcado
                        if (checkboxes[i].checked) {
                            // Obtiene el valor del atributo data-id y lo muestra en la consola
                            var dataIdValue = checkboxes[i].getAttribute('data-id');
                            dataIds.push(dataIdValue);
                        }
                    }

                    var formData = new FormData($('#formGuardarPagoTratamiento')[0]);
                    for (var j = 0; j < dataIds.length; j++) {
                        formData.append('dataIds[]', dataIds[j]);
                    }

                    var form = $("#formGuardarPagoTratamiento");

                    var url = form.attr("action");
                    var accion = $("#accio").val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(respuesta) {

                            transaccionGlobal = respuesta;

                            console.log(transaccionGlobal);

                            if (respuesta) {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "Operación realizada exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });

                                $("#idTransaccion").val(respuesta.transaccion.id);
                                $("#ncompro").html(agregarCeros(respuesta.transaccion.id,
                                    5));
                                $("#fcreacion").html(convertirFormatoFechaHora(respuesta
                                    .transaccion.created_at));
                                $("#fimpresion").html(convertirFormatoFechaHora(
                                    new Date()));

                                $("#nidentificacion").html(respuesta.tratamiento
                                    .identificacion);
                                $("#npaciente").html(respuesta.tratamiento.npaciente + ' ' +
                                    respuesta.tratamiento.apellido);

                                $("#ntratamiento").html(respuesta.tratamiento.nombre);
                                $("#nprofesional").html(respuesta.tratamiento.nprofe);
                                $("#valorAbonoComp").html(formatCurrency(respuesta
                                    .transaccion.pago_realizado, 'es-CO', 'COP'));

                                //listar medio de pago
                                let medioPago = '';
                                let vtotal = 0;
                                let referencia = '';
                                $.each(respuesta.medioPago, function(i, item) {
                                    referencia = item.referencia = item
                                        .referencia !== null ? item.referencia :
                                        "---";
                                    medioPago += '<tr>' +
                                        '<td>' + item.medpago + '</td>' +
                                        '<td class="font-weight-bold">' +
                                        formatCurrency(item.valor, 'es-CO', 'COP') +
                                        '</td>' +
                                        '<td>' + referencia + '</td>'
                                    '</tr>';
                                    vtotal = vtotal + item.valor;
                                });
                                $("#tr-medioPago").html(medioPago);

                                //Listar servicios pagados con la transaccion
                                if (respuesta.servTerminado.length > 0) {
                                    $("#titServAbon").show();
                                    $("#tablaServAbon").show();

                                    let servAbonado = '';
                                    $.each(respuesta.servTerminado, function(i, item) {
                                        servAbonado += '<tr>' +
                                            '<td>' + i + 1 + '</td>' +
                                            '<td>' + item.nombre + '</td>' +
                                            '<td class="font-weight-bold">' +
                                            formatCurrency(item.valor, 'es-CO',
                                                'COP') +
                                            '</td>' +
                                            '</tr>';
                                    });

                                    $("#tr-servAbonado").html(servAbonado);
                                }

                                $("#vtotal").html(formatCurrency(vtotal, 'es-CO', 'COP'));


                                $("#pagoRecaudo").hide();
                                $("#listRecaudo").hide();
                                $("#listRecaudoComprobante").show();

                            }
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
                addMedioPago: function(id) {
                    let consMedio = $("#consMedio").val();
                    consMedio++;
                    let medioPago = '<div style="width: 100%;" id="medioPago' + consMedio +
                        '" class="bs-callout-blue-grey callout-border-left callout-bordered callout-transparent mt-1 p-1 medioPago">' +
                        '<div class="row">' +
                        ' <div class="col-xl-4 col-md-4 col-4">' +
                        '     <div class="form-group">' +
                        '         <div class="controls">' +
                        '             <label>Medio de pago:</label>' +
                        '             <select class="select2 form-control"' +
                        '                 id="medioPago' + consMedio + '" name="medioPago[]"' +
                        '                 onchange="$.cammbioMedioPago(' + consMedio + ');">' +
                        '                 <option value="">Seleccione...' +
                        '                 </option>' +
                        '                 <option value="e">Efectivo</option>' +
                        '                 <option value="t">Transferencia</option>' +
                        '                 <option value="td">Tarjeta de débito</option>' +
                        '                 <option value="tc">Tarjeta de crédito</option>' +
                        '             </select>' +
                        '         </div>' +
                        '     </div>' +
                        ' </div>' +
                        ' <div class="col-xl-3 col-md-3 col-3">' +
                        '     <div class="form-group">' +
                        '         <div class="controls">' +
                        '             <label>Valor:</label>' +
                        '             <input type="text"  valor="0,00" data-cons="' + consMedio +
                        '" onchange="$.cambioFormatoPago(this.id);" onclick="this.select();" class="form-control" id="valorVisPago' +
                        consMedio + '" name="valorVisPago">' +
                        '             <input type="hidden" class="montMedio" value="0" id="valorPago' +
                        consMedio + '" name="valorPago[]">' +
                        '         </div>' +
                        '     </div>' +
                        ' </div>' +
                        '<div class="col-xl-4 col-md-4 col-4">' +
                        '    <div class="form-group" id="div-tranfe' + consMedio +
                        '" style="display: none;">' +
                        '         <div class="controls">' +
                        '             <label>Número de Referencia:</label>' +
                        '             <input type="text"  valor=""  class="form-control" id="referenciaPago" name="referenciaPago[]">' +
                        '         </div>' +
                        '     </div>' +
                        ' </div>' +
                        ' <div class="col-xl-1 col-md-3 col-3 align-content-end">' +
                        '     <button type="button" title="Eliminar medio de pago" onclick="$.delMedioPago(' +
                        consMedio +
                        ');" class="btn btn-icon btn-pure danger mr-1"><i class="fa fa-trash-o"></i></button>' +
                        ' </div>' +
                        ' </div>' +
                        '</div>';

                    $("#div-medioPago").append(medioPago);
                },
                delMedioPago: function(id) {
                    let medPag = document.getElementsByClassName("medioPago");
                    if (medPag.length == 1) {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debe existir almenos un medio de pago",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1700,
                            buttonsStyling: false
                        });
                        return;
                    } else {
                        $("#medioPago" + id).remove();
                        let consMedio = $("#consMedio").val();
                        consMedio--;
                        $("#consMedio").val(consMedio);

                    }
                }

            });
            var editorEvolucion = CKEDITOR.instances.evolucion_escrita;

            //leer variable localStorage tratamientos
            var ultimaParteURLAnterior = document.referrer.split('/').filter(Boolean).pop();

            if (ultimaParteURLAnterior == "Administracion" || ultimaParteURLAnterior == "Pacientes") {
                if (localStorage.getItem('idTratamiento')) {
                    let idTratamiento = localStorage.getItem('idTratamiento');
                    $.buscInfTratamientos(localStorage.getItem('idPaciente'), idTratamiento);
                    var datTratameintos = document.getElementById(
                        'div-datTratameintos'); // Reemplaza 'miDiv' con el ID de tu div
                    datTratameintos.style.filter = 'none';
                    $.pagarTratamiento();


                } else if (localStorage.getItem('idPaciente')) {
                    $.buscInfTratamientos(localStorage.getItem('idPaciente'));
                    var datTratameintos = document.getElementById(
                        'div-datTratameintos'); // Reemplaza 'miDiv' con el ID de tu div
                    datTratameintos.style.filter = 'none';
                }

            }

        });

        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
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

        function convertirFormatoFechaHora(fechaHoraString) {
            // Parsear la cadena de fecha y hora a un objeto Date
            let fechaHora = new Date(fechaHoraString);

            // Obtener los componentes de la fecha
            let dia = fechaHora.getUTCDate();
            let mes = fechaHora.getUTCMonth() + 1; // Los meses en JavaScript son indexados desde 0
            let anio = fechaHora.getUTCFullYear();

            // Formatear la cadena de fecha en el formato deseado
            let fechaFormateada = `${dia}/${mes}/${anio}`;

            // Obtener los componentes de la hora
            let horas = fechaHora.getUTCHours();
            let minutos = fechaHora.getUTCMinutes();
            let segundos = fechaHora.getUTCSeconds();

            // Formatear la cadena de hora en el formato deseado
            let horaFormateada = `${horas}:${minutos}:${segundos}`;

            // Obtener el formato AM/PM
            let ampm = horas >= 12 ? 'PM' : 'AM';

            // Ajustar las horas al formato de 12 horas
            horas = horas % 12;
            horas = horas ? horas : 12; // 0 debería mostrar como 12 en formato de 12 horas

            // Formatear la cadena completa de fecha y hora
            let fechaHoraFormateada = `${fechaFormateada} ${horaFormateada}`;

            return fechaHoraFormateada;
        }



        function agregarCeros(numero, longitud) {
            return numero.toString().padStart(longitud, '0');
        }



        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
