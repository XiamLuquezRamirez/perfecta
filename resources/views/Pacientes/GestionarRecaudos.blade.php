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
                                    <h4 class="card-title ml-2">Planes de tratamiento del paciente</h4>
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
                                                <button type="reset" onclick="$.pagarTratamiento();"
                                                    class="btn btn-success"> Pagar Tratamiento<i
                                                        class="feather icon-chevron-right position-right"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-content" style="display: none;" id="pagoRecaudo">
                                    <div id="daily-activity" class="table-responsive" style="overflow: hidden;">
                                        <table class="table table-hover mb-0" >
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
                                                <!-- Elemento 1 -->
                                            <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title text-bold-600 mr-2">Servicios Seleccionados: </span>
                                                    <span class="cost-value" id="totalServ">$ 0,00</span>
                                                </li>
                                                <!-- Elemento 2 -->
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <div class="form-check" style="width: 100%">
                                                        <input type="checkbox" class="form-check-input" id="icheck-input-all">
                                                        <label class="form-check-label" for="icheck-input-all">Ingresar abono</label>
                                                    </div>
                                                    
                                                    <input type="text" disabled onchange="$.cambioFormato(this.id);" class="form-control" id="valorVis" name="valorVis">
                                                    <input type="hidden" value="" id="valor" name="valor">
                                                </li>
                                                <!-- Otros elementos de la lista si los hay -->
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-2">
                                        <div class="form-actions">
                                            <div class="text-right">
                                                <button type="reset" onclick="$.atrasTratamiento();" class="btn btn-info">
                                                    <i class="feather icon-chevron-left position-left"></i> Atras</button>
                                                <button type="reset" onclick="$.pagarTratamiento();"
                                                    class="btn btn-success"> Pagar Tratamiento<i
                                                        class="feather icon-chevron-right position-right"></i></button>
                                            </div>
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
                    checkServ.on('ifChecked ifUnchecked', function () {
  
                        // Obtener valores de los atributos data
                        var valor = $(this).data('valor');
                        var id = $(this).data('id');

                        $.recorrerServ();
            
                   });


                    //secciones
                },
                recorrerServ: function() {
                    var checkServ = document.getElementsByClassName('icheck-activity-det');
                    $sumTotal = 0;
                    $("#totalServ").html("0,00");
                    for (var i = 0; i < checkServ.length; i++) {
                        if (checkServ[i].checked) {
                            // Obtiene el valor del atributo data-id y lo muestra en la consola
                            var dataIdValor = parseInt(checkServ[i].getAttribute('data-valor'));
                            $sumTotal=$sumTotal+dataIdValor;
                        }
                    }

                    $("#totalServ").html(formatCurrency($sumTotal, 'es-CO', 'COP'));
                },
                atrasTratamiento: function() {
                    $("#pagoRecaudo").hide();
                    $("#listRecaudo").show();
                },
                pagarTratamiento: function() {

                    $("#pagoRecaudo").show();
                    $("#listRecaudo").hide();

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
                    var numero = $("#"+id).val();
                    $("#valor").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVis").val(formatoMoneda);
        
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

     

        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
