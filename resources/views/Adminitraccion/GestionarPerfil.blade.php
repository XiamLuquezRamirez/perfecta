@extends('Plantilla.Principal')
@section('title', 'Gestionar perfil')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="conTrata" name="conTrata" value="" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Información del perfil</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>

                        <li class="breadcrumb-item active">Información del perfil
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <div class="content-body" id="cont-crear">
            <div class="modal-body">
                <section id="page-account-settings">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                                <form class="form" method="post" id="formGuardar"
                                    action="{{ url('/') }}/Administracion/UpdatePerfil">

                                    <input type="hidden" name="idPaciente" id="idPaciente" value="">
                                    <input type="hidden" name="accion" id="accion" value="">
                                    <input type="hidden" name="fotoCargada" id="fotoCargada" value="">
                                    <div id='div-media' class="media">
                                        <a href="javascript: void(0);">
                                            <img src="{{ asset('app-assets/images/FotosUsuarios/' . Auth::user()->foto) }}"
                                                class="rounded mr-75" id="previewImage" alt="profile image" height="64"
                                                width="64">
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                    for="account-upload">Subir una foto</label>
                                                <input type="file" name="fotoPaciente" id="account-upload" hidden>
                                                <button type="button" class="btn btn-sm btn-secondary ml-50"
                                                    onclick="clearImage()">Limpiar</button>
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>Solo JPG, GIF o PNG.
                                                    Tam. Max. de 800kB</small></p>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-5">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        onkeypress="return validartxt(event)" placeholder="Nombre"
                                                        value="{{ Auth::user()->nombre_usuario }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Email" value="{{ Auth::user()->email_usuario }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="account-company">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono"
                                                    placeholder="Teléfono" value="{{ Auth::user()->telefono }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="account-company">Usuario</label>
                                                <input type="text" class="form-control" onchange="$.validaUsuario(this.value)" id="usuario" name="usuario"
                                                    placeholder="usuario" value="{{ Auth::user()->login_usuario }}">
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="userinput8">Cabiar Contraseña:</label>

                                                <fieldset>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" id="checkPasw" onclick="$.habilitarContra(this);"
                                                                    aria-label="Checkbox for following text input">
                                                            </div>
                                                        </div>
                                                        <input type="password" readonly class="form-control"
                                                            id="cambioPasw" name="cambioPasw"
                                                            placeholder="Ingresar contraseña" value="">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row mt-1">
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                    <button type="button" id="btnGuardar" onclick="$.guardar()"
                                        class="btn btn-primary mr-sm-1 mb-1 mb-sm-0"> <i class="fa fa-save"></i> Guardar
                                        Cambios</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div id="loader" class="loader-spinner" style="display: none;">
            <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
            <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>
        </div>
    </div>

    <form action="{{ url('/AdminPacientes/CargarPacientes') }}" id="formCargarPacientes" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/Administracion/VerificarUsuario') }}" id="formValidarUsuario" method="POST">
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
            localStorage.clear();


            $("#MenPaciente").addClass("active");


            document.getElementById('account-upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');

                if (file) {
                    const imageUrl = URL.createObjectURL(file);
                    previewImage.src = imageUrl;
                }
            });


            $.extend({
                cargar: function(page, searchTerm = '') {
                    var form = $("#formCargarPacientes");
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
                                .temas); // Rellenamos la tabla con las filas generadas
                            $('#pagination-links').html(response
                                .links); // Colocamos los enlaces de paginación
                        }
                    });
                },
                habilitarContra: function(elemt){

                  if(elemt.checked){
                    document.getElementById("cambioPasw").readOnly = false;
                  }else{
                    document.getElementById("cambioPasw").readOnly = true;
                    document.getElementById("cambioPasw").value="";
                  }
                },
                validaUsuario: function(valida) {
                    var form = $("#formValidarUsuario");
                    var url = form.attr("action");
                    $('#Usuario').remove();
                    form.append("<input type='hidden' id='Usuario' name='Usuario'  value='" + valida +
                        "'>");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.usuario > 0) {
                                Swal.fire({
                                    type: "warning",
                                    title: "Oops...",
                                    text: "Este usuario se enuentra registrado",
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
                guardar: function() {


                    if ($("#nombre").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar su nombre",
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
                            text: "Debes de ingresar su Email",
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
                            text: "Debes de ingresar su teléfono",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    if ($("#usuario").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar su usuario",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    let checkPasw = document.getElementById("checkPasw");

                    if(checkPasw.checked && document.getElementById("cambioPasw").value == ""){
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar la contraseña si se desea cambiar",
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

                }
            });
        })

        function clearImage() {
            const previewImage = document.getElementById('previewImage');
            let ruta = $('#Ruta').data('ruta');
            console.log
            previewImage.src = ruta +'/images/FotosUsuarios/avatar-s-1.png';
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
