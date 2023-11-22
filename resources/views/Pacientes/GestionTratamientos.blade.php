@extends('Plantilla.Principal')
@section('title', 'Gestionar Tratamientos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="RutaTotal" data-ruta="{{ asset('/') }}" />
    <input type="hidden" id="conSeccion" name="conSeccion" value="0" />
    <input type="hidden" id="conTrata" name="conTrata" value="" />
    <input type="hidden" id="conTrataOtro" name="conTrataOtro" value="" />
    <input type="hidden" id="accion" value="" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Tratamientos</h3>
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
                            <form action="#">
                                <div class="position-relative">
                                    <select class="select2-data-ajax form-control" id="paciente" name="paciente"></select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content-body">
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-detached content-right">
                    <div class="content-body">
                        <div class="content-overlay"></div>

                        <section id="div-datTratameintos" style=" filter: blur(5px);" class="row all-contacts">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-head">
                                        <div class="card-header">
                                            <h4 class="card-title">Tratamientos</h4>
                                            <div class="heading-elements mt-0">
                                                <button id="btn-addTratamientos" class="btn btn-primary btn-md"
                                                    onclick="$.addTratamiento();"><i
                                                        class="d-md-none d-block feather icon-plus white"></i>
                                                    <span class="d-md-block d-none">
                                                        <li class="fa fa-plus"></li> Nuevo Tratamiento
                                                    </span></button>
                                                <button id="btn-atrasTratamiento" class="btn btn-info btn-md"
                                                    style="display: none;" onclick="$.atrasTratamientos();"><i
                                                        class="d-md-none d-block feather icon-plus white"></i>
                                                    <span class="d-md-block d-none">
                                                        <li class="fa fa-reply"></li> Atras Tratamiento
                                                    </span></button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" id="listTratamientos">
                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamientos Activos
                                            </h4>
                                            <hr>
                                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card info-time-tracking">
                                                    <div class="card-content" id="div-trata-act">


                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Otros Tratamientos
                                            </h4>
                                            <hr>

                                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card info-time-tracking">
                                                    <div class="card-content" id="div-trata-otr">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{--  Modal nuevo tratamiento  --}}
                                        <div class="modal fade text-left" id="modalTratamiento" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="tituloTratamiento">Crear Tratmiento
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"
                                                                style="font-size: 25px;">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form class="form" method="post"
                                                                id="formGuardarTratamiento"
                                                                action="{{ url('/') }}/AdminPacientes/GuardarTratamiento">
                                                                <input type="hidden" name="idPaciente" id="idPaciente"
                                                                    value="" />
                                                                <input type="hidden" name="idTratamiento"
                                                                    id="idTratamiento" value="" />
                                                                <section id="user-profile-cards" class="row mt-2">
                                                                    <div class="col-xl-12 col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Nombre de tratamiento:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="nombre_tratamiento"
                                                                                    name="nombre_tratamiento"
                                                                                    placeholder="Nombre de tratamiento"
                                                                                    value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Profesional:</label>
                                                                                <select class="select2 form-control"
                                                                                    id="profesional" name="profesional">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Especialidad:</label>
                                                                                <select class="select2 form-control"
                                                                                    id="especialidad" name="especialidad">
                                                                                    <option value="">Seleccione...
                                                                                    </option>
                                                                                    <option value="Consulta General">
                                                                                        Consulta
                                                                                        General</option>
                                                                                    <option value="Consulta Especializada">
                                                                                        Consulta Especializada</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-md-6 col-12">
                                                                        <div class="form-actions right">
                                                                            <button type="button"
                                                                                id="btn_cancelaTratamiento"
                                                                                onclick="$.cancelarTrataminto();"
                                                                                class="btn btn-warning mr-1">
                                                                                <i class="feather icon-corner-up-left"></i>
                                                                                Salir
                                                                            </button>
                                                                            <button type="button"
                                                                                id="btn_guadarTrataminto"
                                                                                onclick="$.guardarTrataminto();"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-check-square-o"></i>
                                                                                Guardar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--  Modal nueva sesion  --}}
                                        <div class="modal fade text-left" id="modalSesiones" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="tituloUnidad">Crear Sección</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"
                                                                style="font-size: 25px;">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form class="form" method="post" id="formGuardarSeccion"
                                                                action="{{ url('/') }}/AdminPacientes/GuardarSeccion">
                                                                <input type="hidden" name="idSeccion" id="idSeccion"
                                                                    value="" />
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label for="userinput5">Nombre:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nombreSeccion" name="nombreSeccion">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="userinput8">Descripción:</label>
                                                                    <textarea id="descripcionSeccion" rows="5" class="form-control border-primary" name="descripcionSeccion"
                                                                        placeholder="Descripcion"></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="form-actions right">
                                                            <button type="button" onclick="$.salirSeccion();"
                                                                class="btn btn-warning mr-1">
                                                                <i class="feather icon-corner-up-left"></i> Salir
                                                            </button>
                                                            <button type="button" id="btnGuardar"
                                                                onclick="$.guardarSeccion()" class="btn btn-success">
                                                                <i class="fa fa-check-square-o"></i> Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--  Modal nuevo servicio  --}}
                                        <div class="modal fade text-left" id="modalServicios" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="tituloUnidad">Crear Servicio</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"
                                                                style="font-size: 25px;">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form class="form" method="post" id="formGuardarServicio"
                                                                action="{{ url('/') }}/AdminPacientes/GuardarServicio">
                                                                <input type="hidden" name="idServicio" id="idServicio"
                                                                    value="" />
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-9 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5">Servicio:</label>
                                                                                <select class="select2 form-control"
                                                                                    id="servicioTrat"
                                                                                    onchange="$.buscInfServicio(this.value);"
                                                                                    name="servicioTrat">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5">Valor:</label>
                                                                                <input type="text"
                                                                                    onchange="$.cambioFormato(this.id);"
                                                                                    class="form-control" id="valorVis"
                                                                                    name="valorVis">
                                                                                <input type="hidden" value=""
                                                                                    id="valor" name="valor">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                        </div>
                                                        <div class="form-actions right">
                                                            <button type="button" onclick="$.salirServicio();"
                                                                class="btn btn-warning mr-1">
                                                                <i class="feather icon-corner-up-left"></i> Salir
                                                            </button>
                                                            <button type="button" id="btnGuardar"
                                                                onclick="$.guardarServicio()" class="btn btn-success">
                                                                <i class="fa fa-check-square-o"></i> Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="card-body" id="detTratamiento" style="display: none">
                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Gestionar
                                                Tratamiento</h4>
                                            <hr>
                                            <section id="user-profile-cards" class="row mt-2">
                                                <div class="col-xl-12 col-md-6 col-12">
                                                    <div class="card card border-teal border-lighten-2">
                                                        <div>
                                                            <div class="card-body">
                                                                <h4 id="tit_tratamiento" class="card-title mb-0">
                                                                    Tratamiento de depilacion laser</h4>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <button type="button" onclick="$.addSeccion();"
                                                                    class="btn btn-danger mr-1"><i class="fa fa-plus"></i>
                                                                    Agregar
                                                                    Sección</button>
                                                                <button type="button" class="btn btn-primary mr-1"><i
                                                                        class="fa fa-plus"></i> Agregar
                                                                    Servicio</button>
                                                            </div>
                                                            <div id="sesionesTratamiento" class="form-body pt-0">
                                                                <div class="carwd-body">
                                                                    <div id="nseccciones">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group list-group-flush">
                                                        </div>
                                                    </div>
                                                </div>

                                            </section>

                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div id="div-datPersona" style=" filter: blur(5px);" class="sidebar-detached sidebar-left ps">
                    <div class="sidebar">
                        <div class="bug-list-sidebar-content">
                            <!-- Predefined Views -->
                            <div class="card">
                                <div class="card-head">
                                    <div class="media p-1">
                                        <div class="media-left pr-1"><span
                                                class="avatar avatar-online avatar-sm rounded-circle"><img
                                                    id="previewImage"
                                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-1.png') }}"
                                                    alt="avatar"><i></i></span></div>
                                        <div class="media-body media-middle">
                                            <h5 id="npaciente" style="text-transform: capitalize;" class="media-heading">
                                                Xiamir Luquez</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- contacts view -->
                                <div class="card-body border-top-blue-grey border-top-lighten-5">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active">Todos</a>
                                        <a href="#" class="list-group-item list-group-item-action">Activos</a>
                                        <a href="#" class="list-group-item list-group-item-action">Otros</a>
                                    </div>
                                </div>

                                <!-- Groups-->
                                <div class="card-body">
                                    <p class="lead">Información General</p>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="fa fa-calendar float-right"></span>
                                            <a href="#" id="edadPac">23 años</a>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="feather icon-phone float-right"></span>
                                            <a id="telPac" href="#">316 4915332</a>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="feather icon-at-sign float-right"></span>
                                            <a id="emailPac" href="#">alexanderx105@hotmail.com</a>
                                        </li>

                                    </ul>
                                </div>
                                <!--/ Groups-->

                                <!--More-->
                                <div class="card-body  justify-content-between align-items-center">
                                    <p class="lead">Citas del paciente</p>
                                    <ul class="list-group" id="listCitas">

                                        <li class="list-group-item">
                                            <span class="fa fa-calendar float-right"></span>
                                            <a href="#">Consulta Especializada </a>
                                            <p class="sub-heading">23/11/2023 - 08:30 PM</p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="fa fa-calendar float-right"></span>
                                            <a href="#">Consulta Especializada </a>
                                            <p class="sub-heading">23/11/2023 - 08:30 PM</p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="fa fa-calendar float-right"></span>
                                            <a href="#">Consulta General </a>
                                            <p class="sub-heading">23/11/2023 - 08:30 PM</p>
                                        </li>

                                    </ul>
                                </div>
                                <!--/More-->

                            </div>
                            <!--/ Predefined Views -->

                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="loader" class="loader-spinner" style="display: none;">
            <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
            <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>

        </div>

    </div>

    <form action="{{ url('/AdminPacientes/AllProfesionales') }}" id="formCargarProfesionales" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/AllServicios') }}" id="formCargarServicios" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/ValidarProfesional') }}" id="formValidarProfesional" method="POST">
        @csrf
        <!-- Tus c
                                                                                            ampos del formulario aquí -->
    </form>

    <form action="{{ url('/Administracion/BuscarServicio') }}" id="formBuscaServicios" method="POST">
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

    <form action="{{ url('/AdminPacientes/CargarDatosPacTrat') }}" id="formCargarDatosPacTrat" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/SeccionesTratamientos') }}" id="formCargarSeccionesTratamientos"
        method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenPaciente").removeClass("active");


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
                    console.log(lastSelectedData.id);
                    console.log(lastSelectedData.text);
                    $.buscInfGeneralPaciente(lastSelectedData.id);
                }
            }

            $.extend({
                addTratamiento: function() {

                    $("#modalTratamiento").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#accion").val("agregar");
                    $.cargarProfesionales();
                },
                cancelarTrataminto: function() {
                    $('#modalTratamiento').modal('toggle');
                },
                verTratamiento: function(trat) {

                    $("#idTratamiento").val(trat);
                    $("#detTratamiento").show();
                    $("#listTratamientos").hide();
                    $("#btn-addTratamientos").hide();
                    $("#btn-atrasTratamiento").show();

                    var form = $("#formCargarSeccionesTratamientos");
                    $("#tratSecc").remove();
                    form.append("<input type='hidden' id='tratSecc' name='tratSecc'  value='" + trat +
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

                            $("#tit_tratamiento").html(respuesta.Tratamientos.nombre);
                            $("#nseccciones").html(respuesta.ContTratamientos);


                        }
                    });

                },
                atrasTratamientos: function() {
                    $("#detTratamiento").hide();
                    $("#listTratamientos").show();
                    $("#btn-addTratamientos").show();
                    $("#btn-atrasTratamiento").hide();
                },
                cargarProfesionales: function() {

                    var form = $("#formCargarProfesionales");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    let select = '<option value="">Seleccione...</option>';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $.each(respuesta.profesionales, function(i, item) {

                                select += '<option value="' + item.id + '">' + item
                                    .nombre + '</option>';

                            });
                        }
                    });

                    $("#profesional").html(select);
                },
                cargarServicios: function() {

                    var form = $("#formCargarServicios");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    let select = '<option value="">Seleccione...</option>';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $.each(respuesta.servicios, function(i, item) {

                                select += '<option value="' + item.id + '">' + item
                                    .nombre + '</option>';

                            });
                        }
                    });

                    $("#servicioTrat").html(select);
                },
                guardarTrataminto: function() {

                    if ($("#nombre_tratamiento").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el nombrer del tratamiento",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#profesional").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el pofesional a cargo del tratamiento",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarTratamiento");
                    var url = form.attr("action");
                    var token = $("#token").val();
                    var accion = $("#accion").val();
                    $("#idtoken").remove();
                    $("#accion").remove();

                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");

                    let newTrata = '';
                    let consTrata = 1;
                    let porAvancTrat = 0;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarTratamiento')[0]),
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

                                $.each(respuesta.newTrata, function(i, item) {

                                    newTrata += '<div class="row">' +
                                        '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                        '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                        '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                        '            ' + item.nombre + '</h4>' +
                                        '        <span class="pr-2 fonticon-wrap"' +
                                        '            style="cursor: pointer; ">' +
                                        '            <i style="transition: all .2s ease-in-out;c" title="Editar Tratamiento"' +
                                        '                class="fa fa-pencil font-medium-5"></i>' +
                                        '            <i title="Eliminar Tratamiento"' +
                                        '                class="fa fa-trash-o  font-medium-5"></i>' +
                                        '        </span>' +
                                        '    </div>' +
                                        '</div>' +
                                        '<div class="col-12 hvr-grow-shadow" style="cursor: pointer;"' +
                                        '    onclick="$.verTratamiento(' + item.id +
                                        ');">' +
                                        '    <div class="card-body ">' +
                                        '        <div class="row justify-content-center align-items-center">' +
                                        '            <div class="col-xl-4 col-lg-6 col-md-12 text-center clearfix">' +
                                        '                <h6 class="pt-1"><span' +
                                        '                        class="fa fa-user"></span> Profesional:' +
                                        '                </h6>' +
                                        '                <p>Mairen Pumarejo</p>' +
                                        '            </div>' +
                                        '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                        '                <h6 class="pt-1"><span' +
                                        '                        class="fa fa-th-large"></span>' +
                                        '                    Especialidad:</h6>' +
                                        '                <p>' + item.especialidad +
                                        '</p>' +
                                        '            </div>' +
                                        '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                        '                <h6 class="pt-1"><span' +
                                        '                        class="fa fa-calendar"></span> Ultima' +
                                        '                    Cita:</h6>' +
                                        '                <p>---</p>' +
                                        '            </div>' +
                                        '            <div class="col-xl-2 col-lg-6 col-md-12 text-center clearfix">' +
                                        '                <div id="outerCircleTrata' +
                                        consTrata + '" class="outerCircleTrata"' +
                                        '                style="display: flex; justify-content: center; align-items: center; padding: 0; height: 50px; width: 50px; border-radius: 100%; background-image: conic-gradient(#24BEC0 0deg, #24BEC0 162deg, #F0F0F0 162deg)">' +
                                        '                <div style="display: flex; justify-content: center; align-items: center; padding: 0; height: 40px; width: 40px; border-radius: 100%; background-color:white">' +
                                        '                    <span id="porcentajeTrata' +
                                        consTrata + '">0%</span>' +
                                        '                </div>' +
                                        '            </div>' +
                                        '           </div>' +
                                        '        </div>' +
                                        '    </div>' +
                                        '</div>' +
                                        '</div>';
                                    $("#div-trata-act").append(newTrata);
                                    updatePercentageTratamientos(porAvancTrat,
                                        consTrata);
                                    consTrata++;

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
                                confirmButtonClccass: "btn btn-primary",
                                timer: 1500,
                                buttonsStyling: false
                            });
                        }
                    });
                },
                addSeccion: function() {
                    $("#modalSesiones").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#nombreSeccion").val('');
                    $("#Descripcion").val('');
                    $("#accion").val('agregar');

                },
                salirSeccion: function() {
                    $('#modalSesiones').modal('toggle');
                },
                guardarSeccion: function() {


                    if ($("#nombreSeccion").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el nombrer de la sección",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';


                    var form = $("#formGuardarSeccion");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var token = $("#token").val();
                    var tratamiento = $("#idTratamiento").val();
                    $("#idtoken").remove();
                    $("#accion").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idtrata' name='idtrata'  value='" +
                        tratamiento +
                        "'>");


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarSeccion')[0]),
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

                                $.dibujarSeccion(respuesta);
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
                dibujarSeccion: function(respuesta) {
                    $("#idSeccion").val(respuesta.seccion.id);

                    let conSeccion = $("#conSeccion").val();
                    conSeccion++;
                    let divSecciones = '<div class="card collapse-header" role="tablist">' +
                        '<div id="headingCollapse5"' +
                        '    class="card-header d-flex justify-content-between align-items-center hvr-grow-shadow m-1"' +
                        '    style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;"' +
                        '    data-toggle="collapse" role="tab"' +
                        '    data-target="#collapse5"' +
                        '    aria-expanded="false"' +
                        '   aria-controls="collapse5">' +
                        '    <div class="collapse-title media">' +
                        '        <div class="media-body mt-25">' +
                        '            <h4>' + respuesta.seccion.nombre + '</h4>' +
                        '        </div>' +
                        '    </div>' +
                        '    <div' +
                        '        class="information d-sm-flex d-none align-items-center">' +
                        '        <div class="collection mr-1">' +
                        '            <span' +
                        '                class="bullet bullet-xs bullet-primary"></span>' +
                        '            <span class="font-weight-bold">$' +
                        '                0,00</span>' +
                        '        </div>' +
                        '<div class="dropdown">' +
                        '            <a href="#"' +
                        '                class="dropdown-toggle"' +
                        '                id="fisrt-open-submenu"' +
                        '                data-toggle="dropdown"' +
                        '                aria-haspopup="true"' +
                        '                aria-expanded="false">' +
                        '                <i class="feather icon-more-vertical mr-0"></i>' +
                        '            </a>' +
                        '            <div class="dropdown-menu dropdown-menu-right"' +
                        '                aria-labelledby="fisrt-open-submenu">' +
                        '               <a onclick="$.addServicioSeccion(' + conSeccion +
                        ');" class="dropdown-item mail-reply">' +
                        '                    <i class="feather icon-plus"></i>' +
                        '                   Agregar Servicio' +
                        '                </a>' +
                        '                <div class="dropdown-divider">' +
                        '                </div>' +
                        '                <a href="#"' +
                        '                    class="dropdown-item">' +
                        '                    <i class="feather icon-edit" ></i>' +
                        '                   Editar sección' +
                        '                </a>' +
                        '                <a href="#"' +
                        '                    class="dropdown-item">' +
                        '                    <i class="feather icon-trash-2"></i>' +
                        '                    Eliminar Sección' +
                        '                </a>' +
                        '            </div>' +
                        '       </div>' +
                        '    </div>' +
                        '</div>' +
                        '<div id="collapse5" role="tabpanel"' +
                        '    aria-labelledby="headingCollapse5"' +
                        '    class="collapse">' +
                        '    <div class="card-content">' +
                        '        <div class="card-body">' +
                        '          <table class="table mb-5">' +
                        '   <tbody  id="trServicioSeccion' + conSeccion + '">' +
                        '   </tbody>' +
                        '                </table>' +
                        '        </div>' +
                        '    </div>' +
                        '</div>' +
                        '</div>';

                    $("#nseccciones").append(divSecciones);

                },
                addServicioSeccion: function(id) {
                    alert('agregar servicios a seccion ' + id);
                },
                addServicio: function(id) {
                    // let servicios = '';
                    $("#modalServicios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $.cargarServicios();



                    //  $("#div-servSeccion" + id).append(servicios);
                },

                buscInfServicio: function(val) {
                    var form = $("#formBuscaServicios");
                    $("#idServ").remove();
                    form.append("<input type='hidden' id='idServ' name='idServ'  value='" + val + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            var InputVal = document.getElementById("valorVis");
                            if (respuesta.servicio.descuento == "No") {
                                InputVal.disabled = true;
                            } else {
                                InputVal.disabled = false;
                            }

                            $("#valor").val(respuesta.servicio.valor);

                            var formatoMoneda = formatCurrency(respuesta.servicio.valor,
                                'es-CO', 'COP');
                            $("#valorVis").val(formatoMoneda);
                        }
                    });


                },
                cambioFormato: function(id) {
                    var numero = $("#" + id).val();
                    $("#valor").val(numero);
                    var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                    $("#valorVis").val(formatoMoneda);

                },
                buscInfGeneralPaciente: function(pac) {
                    $("#idPaciente").val(pac);
                    $("#div-trata-act").html('');
                    var form = $("#formCargarDatosPacTrat");
                    $("#pacTrat").remove();
                    form.append("<input type='hidden' id='pacTrat' name='pacTrat'  value='" + pac +
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
                            //DATOS PERSONALES
                            $("#npaciente").html(respuesta.paciente.nombre + " " + respuesta
                                .paciente.apellido);
                            var edad = calcularEdad(respuesta.paciente.fecha_nacimiento)
                            $("#edadPac").html(edad + " Años");
                            $("#telPac").html(respuesta.paciente.telefono);
                            $("#emailPac").html(respuesta.paciente.email);

                            var foto = respuesta.paciente.foto;
                            if (foto == "") {
                                foto =
                                    "../../../app-assets/images/FotosPacientes/avatar-s-1.png";
                            }

                            const previewImage = document.getElementById('previewImage');
                            let url = $('#Ruta').data("ruta");
                            previewImage.src = url + "/images/FotosPacientes/" + foto;

                            var datTratameintos = document.getElementById(
                                'div-datTratameintos'
                            ); // Reemplaza 'miDiv' con el ID de tu div
                            datTratameintos.style.filter = 'none';
                            var datPersona = document.getElementById(
                                'div-datPersona'); // Reemplaza 'miDiv' con el ID de tu div
                            datPersona.style.filter = 'none';

                            ///datos citas
                            let citas = "";
                            $.each(respuesta.citas, function(i, item) {
                                var fechaHora = $.convertirFormato(item.inicio);

                                citas += ' <li class="list-group-item">' +
                                    '<span class="fa fa-calendar float-right"></span>' +
                                    '<a href="#">' + item.motivo + '</a>' +
                                    '<p class="font-small-2 mb-0 text-muted">' +
                                    fechaHora + '</p>' +
                                    '<p class="font-small-2 mb-0 text-muted">' +
                                    item.estado + '</p>' +
                                    '</li>';

                            });
                            $('#listCitas').html(citas);

                            ////datos tratamiento activos
                            let tratAct = '';
                            let consTrata = 1;


                            $.each(respuesta.tratamientosAct, function(i, item) {
                                tratAct += '<div class="row">' +
                                    '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                    '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                    '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                    '            ' + item.nombre + '</h4>' +
                                    '        <span class="pr-2 fonticon-wrap"' +
                                    '            style="cursor: pointer; ">' +
                                    '            <i style="transition: all .2s ease-in-out;c" title="Editar Tratamiento"' +
                                    '                class="fa fa-pencil font-medium-5"></i>' +
                                    '            <i title="Eliminar Tratamiento"' +
                                    '                class="fa fa-trash-o  font-medium-5"></i>' +
                                    '        </span>' +
                                    '    </div>' +
                                    '</div>' +
                                    '<div class="col-12 hvr-grow-shadow" style="cursor: pointer;"' +
                                    '    onclick="$.verTratamiento(' + item.id +
                                    ');">' +
                                    '    <div class="card-body ">' +
                                    '        <div class="row justify-content-center align-items-center">' +
                                    '            <div class="col-xl-4 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-user"></span> Profesional:' +
                                    '                </h6>' +
                                    '                <p>Mairen Pumarejo</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-th-large"></span>' +
                                    '                    Especialidad:</h6>' +
                                    '                <p>' + item.especialidad +
                                    '</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-calendar"></span> Fecha última atención</h6>' +
                                    '                <p>---</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-2 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <div id="outerCircleTrata' +
                                    consTrata + '" class="outerCircleTrata"' +
                                    '                style="display: flex; justify-content: center; align-items: center; padding: 0; height: 50px; width: 50px; border-radius: 100%; background-image: conic-gradient(rgb(36, 190, 192) 0deg, rgb(36, 190, 192) 0deg, rgb(240, 240, 240) 0deg);">' +
                                    '                <div style="display: flex; justify-content: center; align-items: center; padding: 0; height: 40px; width: 40px; border-radius: 100%; background-color:white">' +
                                    '                    <span id="porcentajeTrata' +
                                    consTrata + '">0%</span>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '           </div>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '</div>' +
                                    '</div>';
                                $("#div-trata-act").append(tratAct);
                                updatePercentageTratamientos(0, consTrata);
                                consTrata++;
                            });

                            $('#conTrata').val(consTrata);
                            ////datos otros tratamiento
                            let tratOtr = '';
                            let consTrataOtro = 1;

                            $.each(respuesta.tratamientosOtr, function(i, item) {
                                tratOtr += '<div class="row">' +
                                    '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                    '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                    '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                    '            ' + item.nombre + '</h4>' +
                                    '        <span class="pr-2 fonticon-wrap"' +
                                    '            style="cursor: pointer; ">' +
                                    '            <i style="transition: all .2s ease-in-out;c" title="Editar Tratamiento"' +
                                    '                class="fa fa-pencil font-medium-5"></i>' +
                                    '            <i title="Eliminar Tratamiento"' +
                                    '                class="fa fa-trash-o  font-medium-5"></i>' +
                                    '        </span>' +
                                    '    </div>' +
                                    '</div>' +
                                    '<div class="col-12 hvr-grow-shadow" style="cursor: pointer;"' +
                                    '    onclick="$.verTratamiento();">' +
                                    '    <div class="card-body ">' +
                                    '        <div class="row justify-content-center align-items-center">' +
                                    '            <div class="col-xl-4 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-user"></span> Profesional:' +
                                    '                </h6>' +
                                    '                <p>Mairen Pumarejo</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-th-large"></span>' +
                                    '                    Especialidad:</h6>' +
                                    '                <p>' + item.especialidad +
                                    '</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-calendar"></span> Fecha última atención</h6>' +
                                    '                <p>---</p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-2 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <div id="outerCircleTrata' +
                                    consTrataOtro + '" class="outerCircleTrata"' +
                                    '                style="display: flex; justify-content: center; align-items: center; padding: 0; height: 50px; width: 50px; border-radius: 100%; background-image: conic-gradient(rgb(36, 190, 192) 0deg, rgb(36, 190, 192) 0deg, rgb(240, 240, 240) 0deg);">' +
                                    '                <div style="display: flex; justify-content: center; align-items: center; padding: 0; height: 40px; width: 40px; border-radius: 100%; background-color:white">' +
                                    '                    <span id="porcentajeTrata' +
                                    consTrataOtro + '">0%</span>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '           </div>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '</div>' +
                                    '</div>';
                                $("#div-trata-otr").append(tratOtr);
                                updatePercentageTratamientos(0, consTrataOtro);
                                consTrataOtro++;
                            });
                        }
                    });
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

            });

        })


        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
        }

        function calcularEdad(fechaNacimiento) {
            // Convierte la cadena de fecha de nacimiento a un objeto Date
            var fechaNacimiento = new Date(fechaNacimiento);

            // Obtiene la fecha actual
            var fechaActual = new Date();

            // Calcula la diferencia en milisegundos entre la fecha actual y la fecha de nacimiento
            var diferencia = fechaActual - fechaNacimiento;

            // Convierte la diferencia de milisegundos a años
            var edadEnMilisegundos = new Date(diferencia);
            var edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);

            return edad;
        }


        function updatePercentage(porcentaje) {
            $('#percentage').text(porcentaje + '%');
            $('.outerCircle').css('background-image',
                `conic-gradient(#24BEC0 0deg, #24BEC0 ${3.6 * porcentaje}deg, #F0F0F0 ${3.6 * porcentaje}deg)`);
        }

        function updatePercentageTratamientos(porcentaje, consTrata) {
            $('#porcentajeTrata' + consTrata).text(porcentaje + '%');
            $('#outerCircleTrata' + consTrata).css('background-image',
                `conic-gradient(#24BEC0 0deg, #24BEC0 ${3.6 * porcentaje}deg, #F0F0F0 ${3.6 * porcentaje}deg)`);
        }

        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
