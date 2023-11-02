@extends('Plantilla.Principal')
@section('title', 'Gestionar Profesionales')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Profesionales</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>

                        <li class="breadcrumb-item active">Gestionar Profesionales
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
                    <a onclick="$.addProfesional()" class="btn btn-primary"><i class="feather icon-plus"></i> Crear
                        Profesional</a>
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
                                    <th>
                                        <span class="align-middle">Identidicación</span>
                                    </th>
                                    <th>Nombre</th>
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
        <div class="modal fade text-left" id="modalProfesional" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloProfesional"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardar"
                                action="{{ url('/') }}/Administracion/GuardarProfesional">
                                <input type="hidden" name="idProfesional" id="idProfesional" value="" />
                                <input type="hidden" name="idUsuario" id="idUsuario" value="" />
                                <input type="hidden" name="accion" id="accion" value="">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fa fa-list-alt"></i> Información basica del
                                        profesional</h4>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Identificación:</label>
                                            <input type="text" class="form-control" id="identificacion"
                                                name="identificacion" placeholder=""
                                                onchange="$.validaIdentificacion(this.value);" value="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="userinput8">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="userinput8">Email:</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Teléfono:</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                placeholder="" value="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="fa fa-user"></i> Información del usuario
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Usuario:</label>
                                            <input type="text" class="form-control" onchange="$.validaUsuario(this.value);"  id="usuario" name="usuario"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Contraseña:</label>
                                            <input type="password" class="form-control" id="pasword" name="pasword"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="userinput8">Repetir contraseña:</label>
                                            <input type="password" onchange="$.validaPass();"  class="form-control" id="rpasword" name="rpasword"
                                                placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <div class="form-group">
                                            <label for="userinput8">Estado de la cuenta:</label>
                                            <select class="form-control" id="estado" name="estado"
                                                aria-invalid="false">
                                                <option value="">Selecciona una
                                                    opción</option>
                                                <option value="Habilitada">
                                                    Habilitada </option>
                                                <option value="Deshabilitada">
                                                    Deshabilitada </option>
                                            </select>
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
            <h2 class="parpadeo" style="color: #FC4F00; font-weight: bold;">Cargando...</h2>

        </div>

    </div>

    <form action="{{ url('/Administracion/CargarProfesionales') }}" id="formCargarProfesionales" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/ValidarProfesional') }}" id="formValidarProfesional" method="POST">
        @csrf
        <!-- Tus c
            ampos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/BuscarProfesional') }}" id="formBuscarProfesional" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/BuscarUsuario') }}" id="formValidarUsuario" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/EliminarProfesional') }}" id="formEliminar" method="POST">
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
                    var form = $("#formCargarProfesionales");
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
                                .profesionales
                                ); // Rellenamos la tabla con las filas generadas
                            $('#pagination-links').html(response
                                .links); // Colocamos los enlaces de paginación
                        }
                    });
                },
                validaIdentificacion: function(valida) {
                    var form = $("#formValidarProfesional");
                    var url = form.attr("action");
                    $('#idProf').remove();
                    form.append("<input type='hidden' id='idProf' name='idProf'  value='" + valida +
                    "'>");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.existe === "si") {
                                Swal.fire({
                                    type: "warning",
                                    title: "Oops...",
                                    text: "Esta identificación se enuentra registrada",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                                $("#identificacion").val("");
                                return;
                            }

                        }
                    });
                },
                validaUsuario: function(valida) {
                    var form = $("#formValidarUsuario");
                    var url = form.attr("action");
                    $('#Usu').remove();
                    form.append("<input type='hidden' id='Usu' name='Usu'  value='" + valida +
                    "'>");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.existe === "si") {
                                Swal.fire({
                                    type: "warning",
                                    title: "Oops...",
                                    text: "Este nombre de usuario se enuentra registrado",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                                $("#usuario").val("");
                                return;
                            }

                        }
                    });
                },
                validaPass: function() {
                    // Obtén las contraseñas ingresadas por el usuario
                    const password = document.getElementById('pasword').value;
                    const rpassword = document.getElementById('rpasword').value;

                    // Compara las contraseñas
                    if (password !== rpassword) {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Las contraseñas no coinciden... Verificar",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                       document.getElementById("pasword").value = "";
                       document.getElementById("rpasword").value = "";
                    }
                },
                addProfesional: function() {

                    $("#modalProfesional").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#tituloProfesional").html("Crear Profesional");
                    $("#accion").val("agregar");
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();
                    $.limpiar();


                },

                guardar: function() {

                   
                    if ($("#identificacion").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el numero de indetificación",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#nombre").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el nombre del profesional",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

               
                    if ($("#telefono").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el teléfono del profesional",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
               
                    if ($("#email").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el email del profesional",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    if ($("#estado").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar el estado del profesional",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    if ($("#pasword").val().trim() != '' && $("#rpasword").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de confirmar la contraseña",
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
                                $("#idProfesional").val(respuesta.id);

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
                editar: function(id) {
               
                    $("#modalProfesional").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#accion").val("editar");
                    $("#idProfesional").val(id);
                    $("#btnGuardar").show();
                    $("#btnNuevo").hide();


                    var form = $("#formBuscarProfesional");
                    $("#idProf").remove();
                    form.append("<input type='hidden' id='idProf' name='idProf'  value='" + id + "'>");

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
                            
                            $("#identificacion").val(respuesta.profesional.identificacion);
                            $("#nombre").val(respuesta.profesional.nombre);
                            $("#email").val(respuesta.profesional.correo);
                            $("#telefono").val(respuesta.profesional.celular);
                            $("#usuario").val(respuesta.profesional.login_usuario);
                            $("#idUsuario").val(respuesta.profesional.usuario);
                            
                            $('#estado').val(respuesta.profesional.estado_cuenta).trigger('change.select2');
                        }
                    });

                    $("#trMultimedia").html(multimedia);
                },
                cancelar: function () {
                    $('#modalProfesional').modal('hide');
                },
                limpiar: function () {
                    $("#identificacion").val("");
                    $("#nombre").val("");
                    $("#email").val("");
                    $("#telefono").val("");
                    $("#usuario").val("");
                    $("#pasword").val("");
                    $("#rpasword").val("");
                    $('#estado').val("").trigger('change.select2');
                   
                },
                nuevo: function(){
                    $("#accion").val("agregar");
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

                    $("#idProf").remove();
                    form.append("<input type='hidden' id='idProf' name='idProf'  value='" + id +
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
