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

        <div class="modal fade text-left" id="modaldetCaja" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloCaja"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                           

                            <div class="row">
                             <div class="col-12">
                                <div class="card-header latest-update-heading d-flex justify-content-between">
                                    <h4 class="latest-update-heading-title text-bold-500">Latest Update</h4>
                                    <div class="dropdown update-year-menu pb-1">
                                        <a class="bg-transparent dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">2019</a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">2018</a>
                                            <a class="dropdown-item" href="#">2017</a>
                                            <a class="dropdown-item" href="#">2016</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content latest-update-tracking-list pt-0 pb-1 px-2 position-relative">
                                    <ul class="list-group">
                                        <li class="list-group-item pt-0 px-0 latest-updated-item border-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon text-primary bg-light-primary icon-bag total-products-icon rounded-circle p-50"></i>
                                                </span>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Products</p>
                                                    <small class="font-small-3">1.2k Products</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">$10.5k</span>
                                        </li>
                                        <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                                </span>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                    <small class="font-small-3">39.2k Sales</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">26M</span>
                                        </li>
                                        <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon icon-bag bg-light-danger text-danger total-products-icon rounded-circle p-50"></i>
                                                </span>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Products</p>
                                                    <small class="font-small-3">1.2k Products</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">$10.5k</span>
                                        </li>
                                        <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon icon-credit-card bg-light-primary text-primary total-revenue-icon rounded-circle p-50"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                    <small class="font-small-3">45.5k New Revenue</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">15.6M</span>
                                        </li>
                                        <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                                </span>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                    <small class="font-small-3">39.2k Sales</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">26M</span>
                                        </li>
                                        <li class="list-group-item px-0 latest-updated-item border-0 pb-0 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="list-group-item-icon d-inline mr-1">
                                                    <i class="icon icon-credit-card bg-light-danger text-danger total-revenue-icon rounded-circle p-50"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                    <small class="font-small-3">45.5k New Revenue</small>
                                                </div>
                                            </div>
                                            <span class="update-profit text-bold-600">15.6M</span>
                                        </li>
                                    </ul>
                                </div>
                             </div>


                                <div class="col-12">

                                    <div class="form-actions right">
                                        <button type="button" onclick="$.cancelar();" class="btn btn-warning mr-1">
                                            <i class="feather icon-x"></i> Cancelar
                                        </button>
                                        <button type="button" id="btnGuardar" onclick="$.guardar()"
                                            class="btn btn-success">
                                            <i class="fa fa-check-square-o"></i> Guardar
                                        </button>
                                        <button type="button" id="btnNuevo" style="display: none;" onclick="$.nuevo()"
                                            class="btn btn-primary">
                                            <i class="feather icon-plus"></i> Nuevo
                                        </button>
                                    </div>
                                </div>
                            </div>
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
        <!-- Tus c
                    ampos del formulario aquí -->
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenPaciente").removeClass("active");
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
                verDetalle: function() {
                    $("#modaldetCaja").modal({
                        backdrop: 'static',
                        keyboard: false
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
    </script>

    </script>
@endsection
