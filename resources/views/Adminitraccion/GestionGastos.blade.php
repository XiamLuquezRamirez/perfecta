@extends('Plantilla.Principal')
@section('title', 'Gestionar Gastos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Gastos</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Gestionar Gastos
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
                    <a onclick="$.addGasto()" class="btn btn-primary"><i class="feather icon-plus"></i> Agregar
                        gastos</a>
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
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>Categoria</th>
                                    <th>Valor</th>
                                    <th>Fecha</th>
                                    <th>Fecha de pago</th>
                                    <th>Acción</th>
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

        {{--  Modal nuevo profesional  --}}
        <div class="modal fade text-left" id="modalGastos" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                action="{{ url('/') }}/Administracion/GuardarServicio">
                                <input type="hidden" name="idServicio" id="idServicio" value="" />
                                <input type="hidden" name="accion" id="accion" value="">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fa fa-list-alt"></i> Información basica del
                                        Servicio</h4>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="userinput8">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="userinput8">Valor:</label>
                                            <input type="text" 
                                            onchange="$.cambioFormato(this.id);"
                                            onkeypress="return validartxtnum(event)"
                                            class="form-control" 
                                            id="valorVis"
                                             name="valorVis">
                                            <input type="hidden" value="" id="valor" name="valor">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="userinput8">Descuento:</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                    checked="">
                                                <label class="custom-control-label" for="customSwitch1">Permitir cambiar
                                                    precio del servicio al facturar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="account-company">Descripción:</label>
                                            <div class="form-group">
                                                <textarea name="descripcion" class="form-control textarea-maxlength" id="descripcion"
                                                    placeholder="Ingrese la descripción del servicio.." maxlength="250" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="form-actions right">
                            <button type="button" onclick="$.cancelar();" class="btn btn-warning mr-1">
                                <i class="feather icon-x"></i> Cancelar
                            </button>
                            <button type="button" id="btnGuardar" onclick="$.guardar()" class="btn btn-success">
                                <i class="fa fa-check-square-o"></i> Guardar
                            </button>
                            <button type="button" id="btnNuevo" style="display: none;" onclick="$.nuevo()"
                                class="btn btn-primary">
                                <i class="feather icon-plus"></i> Nuevo
                            </button>
                        </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <div id="loader" class="loader-spinner" style="display: none;">
            <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
            <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>

        </div>

    </div>

    <form action="{{ url('/Administracion/CargarGastos') }}" id="formCargarGastos" method="POST">
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
                    var form = $("#formCargarGastos");
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
                        }
                    });
                },



                addGasto: function() {

                    $("#modalGastos").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#tituloServicio").html("Agregar Gasto");
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();
                    $.limpiar();


                },

                guardar: function() {


                    if ($("#nombre").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el nombrer del servicio",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#valor").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el valor del servicio",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var checkbox = document.getElementById("customSwitch1");
                     var descuento = "";
                    // Verificar si está marcado
                    if (checkbox.checked) {
                        descuento = "Si";
                    } else {
                        descuento = "No";
                    }


                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';


                    var form = $("#formGuardar");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var token = $("#token").val();
                    $("#idtoken").remove();
                    $("#accion").remove();
                    $("#desc").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='desc' name='descuento'  value='" + descuento +
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
                                $("#idServicio").val(respuesta.id);

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
                    var numero = $("#"+id).val();
                    $("#valor").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVis").val(formatoMoneda);

                },
                editar: function(id) {

                    $("#modalServicios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#accion").val("editar");
                    $("#idServicio").val(id);
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();

                    var form = $("#formBuscarServicio");
                    $("#idServ").remove();
                    form.append("<input type='hidden' id='idServ' name='idServ'  value='" + id + "'>");

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

                            $("#nombre").val(respuesta.servicio.nombre);
                            var numero = respuesta.servicio.valor;
                            var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                            $("#valor").val(numero);
                            $("#valorVis").val(formatoMoneda);
                            $("#descripcion").val(respuesta.servicio.descripcion);
                            var checkbox = document.getElementById("customSwitch1");

                            if(respuesta.servicio.descuento == "Si"){
                                checkbox.checked = true;
                            }else{
                                checkbox.checked = false;
                            }

                         
                        }
                    });

                    $("#trMultimedia").html(multimedia);
                },
                cancelar: function() {
                    $('#modalProfesional').modal('hide');
                },
                limpiar: function() {                
                    $("#nombre").val("");
                    $("#valor").val("");
                    $("#valorVis").val("");
                    $("#descripcion").val("");
                    var checkbox = document.getElementById("customSwitch1");
                    checkbox.checked = false;
                 

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
