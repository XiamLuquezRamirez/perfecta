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
                                    <div class="card-content" style="display: none;" id="pagoRecaudo">
                                        <div id="daily-activity" class="table-responsive" style="overflow: hidden;">
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
                                                        <span class="cost-title text-bold-600 mr-2">Servicios Seleccionados:
                                                        </span>
                                                        <span class="cost-value" id="totalServ">$ 0,00</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                        <span class="cost-title text-bold-600 mr-2">Saldo previo abonos:
                                                        </span>
                                                        <div class="badge badge-success" id="totalAbono">$ 10.000,00</div>

                                                    </li>
                                                    <li
                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                        <span class="cost-title text-bold-600 mr-2">Total a pagar: </span>
                                                        <span class="cost-value" id="totalPago">$ 0,00</span>
                                                    </li>

                                                    <li
                                                        class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                        <div class="form-check" style="width: 100%">
                                                            <input type="checkbox" onclick="$.habilAbono(this);"
                                                                class="form-check-input" id="checkAbono">
                                                            <label class="form-check-label" for="icheck-input-all">Ingresar
                                                                abono libre:</label>
                                                        </div>

                                                        <input type="text" disabled valor="0,00"
                                                            onkeypress="return validartxtnum(event)"
                                                            onchange="$.cambioFormato(this.id);" onclick="this.select();" class="form-control"
                                                            id="valorVisAbono" name="valorVisAbono">
                                                        <input type="hidden" value="10000" id="valorAbonoPrev"
                                                            name="valorAbonoPrev">
                                                        <input type="hidden" value="0" id="valorAbono"
                                                            name="valorAbono">
                                                        <input type="hidden" value="0" id="totalServText"
                                                            name="totalServText">
                                                        <input type="hidden" value="no" id="selAbono"
                                                            name="selAbono">
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mt-1 ml-2">
                                                <h4>Medio de pago</h4>
                                            </div>
                                        </div>
                                        <input type="hidden" id='consMedio' name='consMedio' value="1" />
                                        <div class="row ml-1 mr-1" id="div-medioPago">
                                            <div style="width: 100%;" id="medioPago1"
                                                class="bs-callout-blue-grey callout-border-left callout-bordered callout-transparent mt-1 p-1 medioPago">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-4">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label>Medio de pago:</label>
                                                                <select class="select2 form-control" id="medioPago1"
                                                                    name="medioPago[]" onchange="$.cammbioMedioPago(1);">
                                                                    <option value="e">Efectivo</option>
                                                                    <option value="t">Transferencia</option>
                                                                    <option value="td">Tarjeta de débito</option>
                                                                    <option value="tc">Tarjeta de crédito</option>
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
                                                                    class="form-control" id="valorVisPago1"
                                                                    name="valorVisPago">
                                                                <input type="hidden" class="montMedio" value="0"
                                                                    id="valorPago1" name="valorPago[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-4">
                                                        <div class="form-group" id="div-tranfe1" style="display: none;">
                                                            <div class="controls">
                                                                <label>Número de Referencia:</label>
                                                                <input type="text" valor="" class="form-control"
                                                                    id="referenciaPago" name="referenciaPago[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-1 col-md-3 col-3 align-content-end">
                                                        <button type="button" onclick="$.delMedioPago(1);"
                                                            class="btn btn-icon btn-pure danger mr-1"><i
                                                                class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-group">
                                                <button onclick="$.addMedioPago(1);" class="btn btn-primary mt-1"
                                                    type="button">
                                                    <i class="fa fa-plus"></i> Agregar Medio de pago
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-actions">
                                                <div class="text-right">
                                                    <button type="button" onclick="$.atrasTratamiento();"
                                                        class="btn btn-info">
                                                        <i class="feather icon-chevron-left position-left"></i>
                                                        Atras</button>
                                                    <button type="button" onclick="$.ConfirpagoTratamiento();"
                                                        class="btn btn-success"> Confirmar pago<i
                                                            class="feather icon-chevron-right position-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenRecaudo").removeClass("active");

            var lastSelectedData = null;

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
                buscInfTratamientos: function(idPac) {

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
                                tratamientos += '<tr >' +
                                    '<td class="text-truncate" style="vertical-align: middle; ">' +
                                    '    <input type="checkbox" data-id="' + item
                                    .tratamiento +
                                    '" id="checkRecaudo" class="icheck-activity classTrata">' +
                                    '</td>' +
                                    '<td class="text-truncate">' +
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
                        }
                    });

                    $.checkRecaudos();

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
                },
                atrasTratamiento: function() {
                    $("#pagoRecaudo").hide();
                    $("#listRecaudo").show();
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
                            $("#totalAbono").html(formatCurrency(respuesta.saldo_previo,  'es-CO', 'COP'));
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
                    } else {
                        abono.disabled = true;
                        $("#valorAbono").val('0');
                        $("#valorVisAbono").val('0,00');
                        $("#selAbono").val("no");
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
                            if (respuesta) {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "Operación realizada exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });

                                var loader = document.getElementById('loader');
                                loader.style.display = 'none';
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



        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
