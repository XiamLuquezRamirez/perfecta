@extends('Plantilla.Principal')
@section('title', 'Gestionar Consignaciones')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Consignaciones</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Gestionar Consignaciones
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <div class="content-body" id="cont-lista">
            <div class="row mb-1 mt-1 mt-md-0">
                <div class="col-4">
                    <a onclick="$.addConsignacion()" class="btn btn-primary"><i class="feather icon-plus"></i> Agregar
                        consignación</a>
                </div>
                <div class="col-3">
                    <div class="form-group d-flex align-items-center position-relative">
                        <!-- date picker -->
                        <div class="date-icon mr-50 font-medium-3">

                            <i class='feather icon-calendar'></i>

                        </div>
                        <div class="date-picker">
                            <input type="text" id="fecha" name="fecha"
                                class="pickadate form-control pl-1" placeholder="Fecha de gastos">
                        </div>
                    </div>
                </div>
                <div class="col-5">
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
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th>Banco</th>
                                    <th># Consignación</th>
                                    <th>Valor</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="trRegistros">
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="4"></td> <!-- Si necesitas celdas combinadas -->
                                    <td><b>Total:</b></td>
                                    <td><b id="totalGastos"></b></td>
                                    <td colspan="2"></td> <!-- Para ajustar a la cantidad de columnas -->
                                </tr>
                            </tfoot>
                        </table>

                        <div id="pagination-links" class="text-center ml-1 mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  Modal nuevo gastos  --}}
        <div class="modal fade text-left" id="modalConsignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                action="{{ url('/') }}/Administracion/GuardarConsignacion">
                                <input type="hidden" name="idConsignacion" id="idConsignacion" value="" />
                                <input type="hidden" name="accion" id="accion" value="">

                                <div class="row justify-content-end">
                                    
                                    <div class="col-4">
                                        <label for="userinput8">Fecha de consignación:</label>

                                        <div class="form-group d-flex align-items-center position-relative">
                                            <!-- date picker -->
                                            <div class="date-icon mr-50 font-medium-3">

                                                <i class='feather icon-calendar'></i>

                                            </div>
                                            <div class="date-picker">
                                                <input type="text" id="fecPago" name="fecPago"
                                                    class="pickadate form-control pl-1" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="account-company">Descripción:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="descripcion"
                                                    name="descripcion" placeholder="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Banco:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="banco"
                                                    name="banco" placeholder="" value="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8"># Cuenta:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="ncuenta"
                                                    name="ncuenta" placeholder="" value="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8"># Consignación:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nconsignacion"
                                                    name="nconsignacion" placeholder="" value="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Valor:</label>
                                            <input type="text" onchange="$.cambioFormato(this.id);"
                                                onkeypress="return validartxtnum(event)" onclick="this.select()"
                                                class="form-control" id="valorVis" value="0,00" name="valorVis">
                                            <input type="hidden" value="" id="valor" name="valor">
                                        </div>
                                    </div>                                  

                                    <div class="col-12">
                                        <div class="form-actions right">
                                            <button type="button" onclick="$.cancelar();" class="btn btn-warning mr-1">
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

    <form action="{{ url('/Administracion/CargarConsignaciones') }}" id="formCargarGastos" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

   

    <form action="{{ url('/Administracion/Buscarconsignacion') }}" id="formBuscarconsignacion" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>


    <form action="{{ url('/Administracion/EliminarConsignacion') }}" id="formEliminar" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

   
    <form action="{{ url('/AdminPacientes/updateServiciosTerminados') }}" id="formServTerminados" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenAdmin").addClass("active");
            $("#MenAdminConsignacion").addClass("active");

            localStorage.clear();

            $.extend({
                cargar: function(page, searchTerm = '') {
                    var form = $("#formCargarGastos");
                    var fecha = $("#fecha").val();
                    var url = form.attr("action");
                    $('#page').remove();
                    $('#searchTerm').remove();
                    $('#fecBusc').remove();
                    form.append("<input type='hidden' id='page' name='page'  value='" + page + "'>");
                    form.append("<input type='hidden' id='searchTerm' name='search'  value='" +
                        searchTerm +
                        "'>");
                    form.append("<input type='hidden' id='fecBusc' name='fecBusc'  value='" +
                        fecha +
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

                            $("#totalGastos").html(formatCurrency(response.total, 'es-CO',
                                'COP'));
                        }
                    });
                },
                addConsignacion: function() {

                    $("#modalConsignacion").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#tituloServicio").html("Agregar consignación");
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();
                    $.limpiar();
                },
                guardar: function() {
                    if ($("#nconsignacion").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el numero de consignación",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#valor").val().trim() === "0,00" || $("#valor").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el valor de la consignación",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

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
                                $("#idConsignacion").val(respuesta.id);

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
                    $("#valor").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVis").val(formatoMoneda);

                },
                editar: function(id) {

                    $("#modalConsignacion").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#tituloServicio").html("Editar consignación");

                    $("#accion").val("editar");
                    $("#idConsignacion").val(id);
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();

                    var form = $("#formBuscarconsignacion");
                    $("#idCons").remove();
                    form.append("<input type='hidden' id='idCons' name='idCons'  value='" + id + "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    let multimedia = "";

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {

                            var fechPago = convertirFecha(respuesta.consignacion.fecha);

                            $("#fecPago").val(fechPago);
                           
                            $("#descripcion").val(respuesta.consignacion.descripcion);
                            $("#banco").val(respuesta.consignacion.banco);
                            $("#ncuenta").val(respuesta.consignacion.ncuenta);
                            $("#nconsignacion").val(respuesta.consignacion.nconsignacion);

                            var numero = respuesta.consignacion.valor;
                            var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                            $("#valor").val(numero);
                            $("#valorVis").val(formatoMoneda);

                        }
                    });

                  
                },
                cancelar: function() {
                    $('#modalConsignacion').modal('hide');
                },
                limpiar: function() {
                    $("#descripcion").val("");
                    $("#ncuenta").val("");
                    $("#nconsignacion").val("");
                    $("#banco").val("");
                    $("#valor").val("0");
                    $("#valorVis").val("0,00");
                    setToday();

                },
                nuevo: function() {
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();

                    $.limpiar();
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

                    $("#idCons").remove();
                    form.append("<input type='hidden' id='idCons' name='idCons'  value='" + id +
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
                habReferencia: function(val){
                    
                    if(val == "t"){
                        $("#div-referencia").show();
                    }else{
                        $("#div-referencia").hide();
                        $("#referencia").val("");
                    }
                },

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


        function cambioFecha(){
            var searchTerm = $("#searchInput").val();
            
            $.cargar(1, searchTerm);
        }

        $("#fecha").on("change", cambioFecha);

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

        function validartxt(e) {
            tecla = e.which || e.keyCode;
            patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
            te = String.fromCharCode(tecla);
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
        }

        function setToday() {
            $('.pickadate').val(moment().format('DD/MM/YYYY'));
        }

        function convertirFecha(fecha) {
            // Dividir la fecha en año, mes y día
            const [año, mes, dia] = fecha.split('-');

            // Formatear la fecha en el formato dd/mm/yyyy
            const fechaFormateada = `${dia.padStart(2, '0')}/${mes.padStart(2, '0')}/${año}`;

            return fechaFormateada;
        }
    </script>

    </script>
@endsection
