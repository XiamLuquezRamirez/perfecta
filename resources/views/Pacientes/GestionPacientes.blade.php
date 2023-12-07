@extends('Plantilla.Principal')
@section('title', 'Gestionar Pacientes')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="conTrata" name="conTrata" value="" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Pacientes</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>

                        <li class="breadcrumb-item active">Gestionar Pacientes
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
                    <a onclick="$.addPaciente()" class="btn btn-primary"><i class="feather icon-plus"></i> Crear
                        Paciente</a>
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
                                    <th>
                                        <span class="align-middle">Identidicación</span>
                                    </th>
                                    <th>Nombre</th>
                                    <th>Teléfono </th>
                                    <th>Deudas</th>
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
        <div class="content-body" id="cont-crear" style="display: none;">
            <div class="modal-body">
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                                        href="#account-vertical-general" aria-expanded="true">
                                        <i class="fa fa-address-card-o"></i>
                                        Datos Personales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex disabled" id="account-pill-citas" data-toggle="pill"
                                        href="#account-vertical-citas" aria-expanded="false">
                                        <i class="fa fa-calendar-check-o"></i>
                                        Citas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex disabled" id="account-pill-tratamiento" data-toggle="pill"
                                        href="#account-vertical-tratamiento" aria-expanded="false">
                                        <i class="fa fa-universal-access"></i>
                                        Tratamientos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex disabled" id="account-pill-recaudos" data-toggle="pill"
                                        href="#account-vertical-recaudos" aria-expanded="false">
                                        <i class="fa fa-calculator"></i>
                                        Recaudos
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                                aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form class="form" method="post" id="formGuardar"
                                                    action="{{ url('/') }}/AdminPacientes/GuardarPaciente">

                                                    <input type="hidden" name="idPaciente" id="idPaciente"
                                                        value="">
                                                    <input type="hidden" name="accion" id="accion" value="">
                                                    <input type="hidden" name="fotoCargada" id="fotoCargada"
                                                        value="">
                                                    <div id='div-media' class="media">
                                                        <a href="javascript: void(0);">
                                                            <img src="../../../app-assets/images/FotosPacientes/avatar-s-1.png"
                                                                class="rounded mr-75" id="previewImage"
                                                                alt="profile image" height="64" width="64">
                                                        </a>
                                                        <div class="media-body mt-75">
                                                            <div
                                                                class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label
                                                                    class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                                    for="account-upload">Subir una foto</label>
                                                                <input type="file" name="fotoPaciente"
                                                                    id="account-upload" hidden>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary ml-50"
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
                                                                    <label for="account-username">Tipo de
                                                                        Identificación</label>
                                                                    <select class="form-control" id="tipoId"
                                                                        name="tipoId" aria-invalid="false">

                                                                        <option value="">Selecciona una
                                                                            opción</option>
                                                                        <option value="RC">
                                                                            Registro Civil </option>
                                                                        <option value="TI">
                                                                            Tarjeta De Identidad </option>
                                                                        <option value="CE">
                                                                            Cédula De Extranjería </option>
                                                                        <option value="CC">
                                                                            Cédula De Ciudadanía </option>
                                                                        <option value="PA">
                                                                            Pasaporte </option>
                                                                        <option value="MS">
                                                                            Menor Sin Identificación </option>
                                                                        <option value="AS">
                                                                            Adulto Sin Identificación </option>
                                                                        <option value="NV">
                                                                            Certificado nacido vivo </option>
                                                                        <option value="SC">
                                                                            Salvoconducto de permanencia </option>
                                                                        <option value="PE">
                                                                            Permiso especial de permanencia
                                                                        </option>
                                                                        <option value="CD">
                                                                            Carné Diplomático </option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">Identificación</label>
                                                                    <input type="text" class="form-control"
                                                                        id="identificacion" name="identificacion"
                                                                        placeholder=""
                                                                        onchange="$.validaIdentificacion(this.value);"
                                                                        value="" required
                                                                        data-validation-required-message="This username field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Nombre</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nombre" name="nombre"
                                                                        onkeypress="return validartxt(event)"
                                                                        placeholder="Nombre" value="" required
                                                                        data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Apellido</label>
                                                                    <input type="text" class="form-control"
                                                                        id="apellido" name="apellido"
                                                                        onkeypress="return validartxt(event)"
                                                                        placeholder="Apellido" value="" required
                                                                        data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">Sexo</label>
                                                                    <select class="form-control" id="sexo"
                                                                        name="sexo" aria-invalid="false">
                                                                        <option value="">Selecciona una
                                                                            opción</option>
                                                                        <option value="Masculino">
                                                                            Masculino </option>
                                                                        <option value="Femenino">
                                                                            Femenino </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">Fecha de
                                                                        Nacimiento</label>
                                                                    <div
                                                                        class="form-group d-flex align-items-center position-relative">
                                                                        <!-- date picker -->
                                                                        <div class="date-icon mr-50 font-medium-3">

                                                                            <i class='feather icon-calendar'></i>

                                                                        </div>
                                                                        <div class="date-picker">
                                                                            <input type="text" id="nacimiento"
                                                                                name="nacimiento"
                                                                                class="pickadate form-control pl-1"
                                                                                placeholder="Due Date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" name="email" placeholder="Email"
                                                                        value="" required
                                                                        data-validation-required-message="This email field is required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-5">
                                                            <div class="form-group">
                                                                <label for="account-company">Dirección</label>
                                                                <input type="text" class="form-control" id="direccion"
                                                                    name="direccion" placeholder="Dirección">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="account-company">Ciudad</label>
                                                                <input type="text" class="form-control" id="ciudad"
                                                                    name="ciudad" onkeypress="return validartxt(event)"
                                                                    placeholder="Ciudad" value=""
                                                                    data-validation-required-message="This name field is required">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="account-company">Teléfono</label>
                                                                <input type="text" class="form-control" id="telefono"
                                                                    name="telefono"
                                                                    onkeypress="return validartxtnum(event)"
                                                                    placeholder="Teléfono">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-company">Observaciones</label>
                                                                <div class="form-group">
                                                                    <textarea name="observaciones" class="form-control textarea-maxlength" id="observaciones"
                                                                        placeholder="Ingrese alguna observación del paciente.." maxlength="250" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-citas" role="tabpanel"
                                                aria-labelledby="account-pill-password" aria-expanded="false">
                                                <div class="card-head">
                                                    <div class="card-header">
                                                        <h4 id="tit-citas" class="card-title">Historial de Citas</h4>
                                                        <div class="heading-elements mt-0">
                                                            <button class="btn btn-primary btn-md" id="btn-addCitas"
                                                                onclick="$.addCita();"><i
                                                                    class="d-md-none d-block feather icon-plus white"></i>
                                                                <span class="d-md-block d-none">
                                                                    <li class="fa fa-plus"></li> Agendar Cita
                                                                </span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <!-- datatable started -->
                                                        <div id="div-listCitas" class="">
                                                            <table id="table-citas" class="table" style="width: 100%;">
                                                                <thead class="border-bottom border-dark">
                                                                    <tr>
                                                                        <th>Profesional</th>
                                                                        <th>Fecha y Hora</th>
                                                                        <th>Estado</th>
                                                                        <th>Opción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="trRegistrosCitas">
                                                                </tbody>
                                                            </table>

                                                            <div id="pagination-links" class="text-center ml-1 mt-2">

                                                            </div>
                                                        </div>
                                                        <form class="form" method="post" id="formGuardarCita"
                                                            action="{{ url('/') }}/AdminCitas/GuardarCita">
                                                            <input type="hidden" name="accionCita" id="accionCita"
                                                                value="">

                                                            <div id="div-addCitas" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label
                                                                                    for="account-username">Profesional</label>
                                                                                <select
                                                                                    onchange="$.cargarDisponibilidad(this.value)"
                                                                                    class="select2 form-control"
                                                                                    id="profesional" name="profesional">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-username">Motivo de la
                                                                                    Consulta</label>
                                                                                <select class="select2 form-control"
                                                                                    id="motivo" name="motivo">
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

                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-username">Duración
                                                                                </label>
                                                                                <select class="form-control"
                                                                                    id="duracionCita" name="duracionCita"
                                                                                    aria-invalid="false">
                                                                                    <option value="15">15 minutos
                                                                                    </option>
                                                                                    <option value="30">30 minutos
                                                                                    </option>
                                                                                    <option value="60">1 hora</option>
                                                                                    <option value="120">2 horas</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-username">Cita
                                                                                    seleccionada para: </label>
                                                                                <input type="hidden" class="form-control"
                                                                                    id="fechaHoraInicio"
                                                                                    name="fechaHoraInicio"
                                                                                    placeholder="Fecha cita">
                                                                                <input type="hidden" class="form-control"
                                                                                    id="fechaHoraFinal"
                                                                                    name="fechaHoraFinal"
                                                                                    placeholder="Fecha cita">
                                                                                    <fieldset>
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control"
                                                                                            id="fechaHoraSelCita"
                                                                                            name="fechaHoraSelCita"
                                                                                            placeholder="Fecha cita">
                                                                                            <div id="div-fechaCita" class="input-group-append" id="button-addon4">
                                                                                                <button class="btn btn-primary" onclick="$.cambiaFecha();" title="Cambiar fecha" type="button"><i class="fa fa-calendar-plus-o"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <div class="form-group"
                                                                            style="inline-flex: flex; align-items: center;">
                                                                            <div class="controls align-content-center">
                                                                                <label
                                                                                    for="account-username">&nbsp;</label>
                                                                                <fieldset>
                                                                                    <label for="input-16"
                                                                                        style="cursor: pointer;"> <input
                                                                                            type="checkbox"
                                                                                            id="notifCliente" checked>
                                                                                        <li class="fa fa-envelope"></li>
                                                                                        Notificar a paciente por correo
                                                                                    </label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-body">
                                                                            <div id='fc-agenda-views'
                                                                                style=" width: 100%;  height: 600px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="button" id="btnGuardarCita"
                                                                            onclick="$.guardarCita()"
                                                                            class="btn btn-primary mr-sm-1 mb-1 mb-sm-0"
                                                                            style=""> <i
                                                                                class="fa fa-arrow-right"></i>
                                                                            Confimar Cita</button>
                                                                        <button type="reset"
                                                                            onclick="$.cancelarProCita()"
                                                                            class="btn btn-light"><i
                                                                                class="fa fa-times"></i>
                                                                            Cancelar</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade " id="account-vertical-tratamiento" role="tabpanel"
                                                aria-labelledby="account-pill-social" aria-expanded="false">
                                                <div class="card-content">
                                                    <div class="card-header">
                                                        <h4 id="tit-citas" class="card-title">Tratamientos de paciente
                                                        </h4>
                                                        <div class="heading-elements mt-0">
                                                            <p><span class="float-right"><a
                                                                        style="color: #009c9f;text-decoration: none; background-color: transparent;"
                                                                        onclick="$.verTratamientos();" target="_blank">Ver
                                                                        Tratamientos <i
                                                                            class="feather icon-arrow-right"></i></a></span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table id="recent-orders"
                                                            class="table table-hover mb-0 ps-container ps-theme-default">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>No. Tratamiento</th>
                                                                    <th>Tratamiento</th>
                                                                    <th>Profesional</th>
                                                                    <th>Estado</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tratamientos-citas">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-recaudos" role="tabpanel"
                                                aria-labelledby="account-pill-connections" aria-expanded="false">
                                                <div class="card-header">
                                                    <h4 id="tit-citas" class="card-title">Recaudos de paciente</h4>
                                                    <div class="heading-elements mt-0">
                                                        <p><span class="float-right"><a
                                                                    style="color: #009c9f;text-decoration: none; background-color: transparent;"
                                                                    onclick="$.verRecaudos();" target="_blank">Ver
                                                                    Recaudos <i
                                                                        class="feather icon-arrow-right"></i></a></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-content">

                                                    <div class="table-responsive">
                                                        <table id="recent-orders"
                                                            class="table table-hover mb-0 ps-container ps-theme-default">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>No. Tratamiento</th>
                                                                    <th>Tratamiento</th>
                                                                    <th>Profesional</th>
                                                                    <th>Total</th>
                                                                    <th>Saldo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tratamientosRecaudo-citas">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="button" id="btnGuardar" onclick="$.guardar()"
                                                        class="btn btn-primary mr-sm-1 mb-1 mb-sm-0"> <i
                                                            class="fa fa-save"></i> Guardar
                                                        Cambios</button>
                                                    <button type="button" onclick="$.ListPacientes()"
                                                        class="btn btn-warning "><i class="fa fa-reply"></i>
                                                        Atras</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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

    <form action="{{ url('/AdminPacientes/ValidarPacientes') }}" id="formValidarPacientes" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/BuscarPacientes') }}" id="formBuscarPaciente" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/AllProfesionales') }}" id="formCargarProfesionales" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/CargarDisponibilidad') }}" id="formCargarDisponibilidad" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/VerCitasPac') }}" id="formVerCitasPac" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/CargarDatosPacTrat') }}" id="formCargarDatosPacTrat" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/TratamientosRecaudo') }}" id="formCargarTratamientos" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminCitas/CambioEstadocita') }}" id="formCambioEstadocita" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/InformacionCita') }}" id="formInfoCita" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            localStorage.clear();
            var $primary = "#00b5b8",
                $secondary = "#2c3648",
                $success = "#0f8e67",
                $info = "#179bad",
                $warning = "#ffb997",
                $danger = "#ff8f9e"

            var disponibilidadJSON = [];

            $("#MenPaciente").addClass("active");

            $('#notifCliente').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            let fechaHoraSelCita;
            let fechaHoraInicio;
            let fechaHoraFinal;

            var fechaActual = new Date().toISOString().split("T")[0];
            var calendarE3 = document.getElementById("fc-agenda-views");
            var fcAgendaViews = new FullCalendar.Calendar(calendarE3, {
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                defaultView: "dayGridMonth",
                defaultDate: fechaActual,
                editable: false,
                plugins: ["dayGrid", "timeGrid", "interaction"],
                eventLimit: true, // allow "more" link when too many events
                firstDay: 1, // 1 for Monday, 0 for Sunday
                allDaySlot: false,
                height: 'auto',
                slotLabelFormat: {
                    hour: "2-digit",
                    minute: "2-digit",
                    omitZeroMinute: false,
                    meridiem: true,
                },
                buttonText: {
                    today: "Hoy",
                    month: "Mes",
                    week: "Semana",
                    day: "Día",
                },
                slotDuration: '00:15:00', // Duración de cada intervalo en la vista semanal (aquí es de una hora)
                slotLabelInterval: "00:15", // Mostrar etiquetas de hora cada una hora
                minTime: "07:00:00",
                maxTime: "19:00:00",
                locale: "es",
                {{--  events: disponibilidadJSON,  --}}
                dateClick: function(event) {
                    console.log('clicked on the date: ', event);
                    if (event) {

                        fcAgendaViews.removeAllEvents();
                        fcAgendaViews.addEventSource(disponibilidadJSON);

                        var duracionCita = parseInt(document.getElementById('duracionCita').value);
                        var nuevaCitaStart = new Date(event.date);
                        var nuevaCitaEnd = new Date(nuevaCitaStart.getTime() + duracionCita *
                            60000); // Duración en milisegundos
                        // Verifica si la nueva cita se superpone con alguna cita existente
                        var seSuperpone = disponibilidadJSON.some(function(cita) {
                            var citaStart = new Date(cita.start);
                            var citaEnd = new Date(cita.end);
                            console.log(citaEnd);
                            return (nuevaCitaStart < citaEnd && nuevaCitaEnd > citaStart);
                        });

                        if (seSuperpone) {
                            Swal.fire({
                                type: "warning",
                                title: "Oops...",
                                text: "La nueva cita se superpone con alguna cita existente, verifica la duración de la nueva",
                                confirmButtonClass: "btn btn-primary",
                                buttonsStyling: false
                            });
                            return;
                        }


                        if ($("#profesional").val() == "") {
                            Swal.fire({
                                type: "warning",
                                title: "Oops...",
                                text: "Debes de seleccionar el profesional",
                                confirmButtonClass: "btn btn-primary",
                                buttonsStyling: false
                            });
                            return;
                            fcAgendaViews2.removeAllEvents();
                        }
                        if ($("#motivo").val() == "") {
                            Swal.fire({
                                type: "warning",
                                title: "Oops...",
                                text: "Debes de seleccionar el motivo de la consulta",
                                confirmButtonClass: "btn btn-primary",
                                buttonsStyling: false
                            });
                            return;
                        }

                        let motivo = document.getElementById('motivo').value;

                        var nuevaCita = {
                            title: motivo,
                            start: nuevaCitaStart,
                            end: nuevaCitaEnd,
                        };

                        const fechaHora = new Date(nuevaCita.start);

                        // Obtiene el día, mes y año
                        const dia = fechaHora.getDate().toString().padStart(2,
                            '0'); // Asegura que el día tenga dos dígitos
                        const mes = (fechaHora.getMonth() + 1).toString().padStart(2,
                            '0'); // El mes se indexa desde 0
                        const año = fechaHora.getFullYear();

                        // Obtiene la hora y los minutos
                        const hora = fechaHora.getHours().toString().padStart(2,
                            '0'); // Asegura que la hora tenga dos dígitos
                        const minutos = fechaHora.getMinutes().toString().padStart(2,
                            '0'); // Asegura que los minutos tengan dos dígitos
                        const segundos = fechaHora.getSeconds().toString().padStart(2, '0');
                        // Combina los componentes para formar la fecha y hora en el formato deseado
                        fechaHoraSelCita = `${dia}/${mes}/${año} ${hora}:${minutos}`;
                        fechaHoraInicio = `${año}-${mes}-${dia}T${hora}:${minutos}:${segundos}`;

                        const fechaHoraFin = new Date(nuevaCita.end);

                        // Obtiene el día, mes y año
                        const dia1 = fechaHoraFin.getDate().toString().padStart(2,
                            '0'); // Asegura que el día tenga dos dígitos
                        const mes1 = (fechaHoraFin.getMonth() + 1).toString().padStart(2,
                            '0'); // El mes se indexa desde 0
                        const año1 = fechaHoraFin.getFullYear();

                        // Obtiene la hora y los minutos
                        const hora1 = fechaHoraFin.getHours().toString().padStart(2,
                            '0'); // Asegura que la hora tenga dos dígitos
                        const minutos1 = fechaHoraFin.getMinutes().toString().padStart(2,
                            '0'); // Asegura que los minutos tengan dos dígitos
                        const segundos1 = fechaHoraFin.getSeconds().toString().padStart(2, '0');
                        // Combina los componentes para formar la fecha y hora en el formato deseado

                        fechaHoraFinal = `${año1}-${mes1}-${dia1}T${hora1}:${minutos1}:${segundos1}`;

                        document.getElementById('fechaHoraSelCita').value = fechaHoraSelCita;
                        document.getElementById('fechaHoraInicio').value = fechaHoraInicio;
                        document.getElementById('fechaHoraFinal').value = fechaHoraFinal;

                        // Añade la cita al calendario
                        fcAgendaViews.addEvent(nuevaCita);

                        // Cierra el evento clickeado
                        fcAgendaViews.refetchEvents();
                    }
                }

            });

            fcAgendaViews.render();

            // Single Date Picker
            $('.pickadate').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'MM/DD/YYYY',
                    daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                }
            });

            document.getElementById('account-upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');

                if (file) {
                    const imageUrl = URL.createObjectURL(file);
                    previewImage.src = imageUrl;
                }
            });
            var citas = document.getElementById("account-pill-citas");
            var tratamiento = document.getElementById("account-pill-tratamiento");
            var recaudos = document.getElementById("account-pill-recaudos");

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
                validaIdentificacion: function(valida) {
                    var form = $("#formValidarPacientes");
                    var url = form.attr("action");
                    $('#idPac').remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + valida +
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
                addPaciente: function() {
                    $('#cont-crear').show();
                    $('#cont-lista').hide();
                    $("#btnGuardar").show();
                    $("#accion").val("agregar");
                    citas.classList.add("disabled");
                    tratamiento.classList.add("disabled");
                    recaudos.classList.add("disabled");
                    document.getElementById("div-media").style.pointerEvents = "auto";
                },
                ListPacientes: function() {
                    $('#cont-crear').hide();
                    $('#cont-lista').show();
                },
                guardar: function() {

                    if ($("#tipoId").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar tipo de indetificación",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
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
                            text: "Debes de ingresar el nombre del paciente",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#apellido").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar el apellido del paciente",
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
                            text: "Debes de ingresar el teléfono del paciente",
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
                                $("#idPaciente").val(respuesta.id);

                                //habilitar procesos pacientes
                                citas.classList.remove("disabled");
                                tratamiento.classList.remove("disabled");
                                recaudos.classList.remove("disabled");


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
                guardarCita: function() {

                    if ($("#profesional").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar el profesional...",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    if ($("#motivo").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar el tipo de consulta",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }
                    if ($("#fechaHoraSelCita").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar la hora y fecha de cita",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    let notifCliente = document.getElementById('notifCliente');

                    if (notifCliente.checked) {
                        notifClie = "si";
                    } else {
                        notifClie = "no";
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarCita");
                    var url = form.attr("action");
                    var idCitaPac = $("#idCitaPac").val();
                    var token = $("#token").val();
                    var idPac = $("#idPaciente").val()
                    $("#idtoken").remove();
                    $("#accion").remove();
                    $("#idpac").remove();
                    $("#notCliente").remove();
                    form.append("<input type='hidden' id='idCit' name='idCit'  value='" + idCitaPac +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idpac' name='idpac'  value='" + idPac +
                        "'>");
                    form.append("<input type='hidden' id='notCliente' name='notCliente'  value='" +
                        notifClie +
                        "'>");
                    form.append("<input type='hidden' id='opc' name='opc'  value='2'>");

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarCita')[0]),
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

                            //cargar citas
                            $.cargarCitas();
                            $.cancelarProCita();
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
                cargarCitas: function() {

                    var idPac = $("#idPac").val();
                    var form = $("#formVerCitasPac");
                    var url = form.attr("action");
                    $('#idCita').remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + idPac +
                        "'>");
                    var datos = form.serialize();

                    var citas = "";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            $.each(response.CitasPaciente, function(i, item) {
                                citas += '<tr><td><span class="invoice-amount">' +
                                    item.nomprof + '</span></td>';
                                var fechaHora = $.convertirFormato(item.inicio);
                                citas += '<td><span class="invoice-amount">' +
                                    fechaHora + '</span></td>';
                                citas +=
                                    '<td><span class="invoice-amount"><select class="select2-bg form-control" onchange="$.cambioEstado(this.value);" id="estadoCita">' +
                                    '<option value="Por Atender" class="por-atender">Por Atender</option>' +
                                    '<option value="Atendida" class="atendida">Atendida</option>' +
                                    '<option value="Confirmada" class="confirmada">Confirmada</option>' +
                                    '<option value="No Confirmada" class="no-confirmada">No Confirmada</option>' +
                                    '<option value="Anulada" class="anulada">Anulada</option>' +
                                    '</select></span></td>' +
                                    '<td>' +
                                    '<div class="invoice-action">' +
                                    '  <a onclick="$.editarCita(' + item.id +
                                    ');" title="Editar cita" class="invoice-action-edit cursor-pointer">' +
                                    '      <i class="feather icon-rotate-ccw"></i>' +
                                    '   </a>' +
                                    ' </div>' +
                                    '</td>' +
                                    ' </tr>';
                            });


                        }
                    });

                    $("#trRegistrosCitas").html(citas)
                },
                editar: function(id) {
                    $('#cont-crear').show();
                    $('#cont-lista').hide();
                    $("#accion").val("editar");
                    document.getElementById("div-media").style.pointerEvents = "auto";

                    $("#btnGuardar").show();

                    $("#idPaciente").val(id);

                    citas.classList.add("disabled");
                    tratamiento.classList.add("disabled");
                    recaudos.classList.add("disabled");

                    var form = $("#formBuscarPaciente");
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + id + "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();



                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#tipoId").val(respuesta.paciente.tipo_identificacion);
                            $("#identificacion").val(respuesta.paciente.identificacion);
                            $("#nombre").val(respuesta.paciente.nombre);
                            $("#apellido").val(respuesta.paciente.apellido);
                            $("#sexo").val(respuesta.paciente.sexo);
                            var fechForm = convertirFecha(respuesta.paciente
                                .fecha_nacimiento);
                            $("#nacimiento").val(fechForm);
                            $("#email").val(respuesta.paciente.email);
                            $("#telefono").val(respuesta.paciente.telefono);
                            $("#direccion").val(respuesta.paciente.direccion);
                            $("#ciudad").val(respuesta.paciente.ciudad);
                            $("#observaciones").val(respuesta.paciente.observaciones);

                            var foto = respuesta.paciente.foto;
                            $("#fotoCargada").val(foto);
                            const previewImage = document.getElementById('previewImage');
                            let url = $('#Ruta').data("ruta");
                            previewImage.src = url + "/images/FotosPacientes/" + foto;


                        }
                    });


                },
                ver: function(id) {
                    $('#cont-crear').show();
                    $('#cont-lista').hide();
                    $("#idPaciente").val(id);
                    $("#btnGuardar").hide();

                    $.cancelarProCita();

                    document.getElementById("div-media").style.pointerEvents = "none";

                    citas.classList.remove("disabled");
                    tratamiento.classList.remove("disabled");
                    recaudos.classList.remove("disabled");

                    var form = $("#formBuscarPaciente");
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + id + "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#tipoId").val(respuesta.paciente.tipo_identificacion);
                            $("#identificacion").val(respuesta.paciente.identificacion);
                            $("#nombre").val(respuesta.paciente.nombre);
                            $("#apellido").val(respuesta.paciente.apellido);
                            $("#sexo").val(respuesta.paciente.sexo);
                            var fechForm = convertirFecha(respuesta.paciente
                                .fecha_nacimiento);
                            $("#nacimiento").val(fechForm);
                            $("#email").val(respuesta.paciente.email);
                            $("#telefono").val(respuesta.paciente.telefono);
                            $("#direccion").val(respuesta.paciente.direccion);
                            $("#ciudad").val(respuesta.paciente.ciudad);
                            $("#observaciones").val(respuesta.paciente.observaciones);

                            var foto = respuesta.paciente.foto;
                            $("#fotoCargada").val(foto);
                            const previewImage = document.getElementById('previewImage');
                            let url = $('#Ruta').data("ruta");
                            previewImage.src = url + "/images/FotosPacientes/" + foto;
                            //cargar citas
                            let citasPac = "";
                            $("#trRegistrosCitas").html('')
                            $.each(respuesta.detaCita, function(i, item) {
                                citasPac +=
                                    '<tr><td><span class="invoice-amount">' + item
                                    .nomprof + '</span></td>';
                                var fechaHora = $.convertirFormato(item.inicio);
                                citasPac += '<td><span class="invoice-amount">' +
                                    fechaHora + '</span></td>';
                                citasPac +=
                                    '<td><span class="invoice-amount"><select class="select2-bg form-control" data-id="' +
                                    item.id + '" data-estado="' + item.estado +
                                    '" onchange="$.cambioEstado(this);" id="estadoCita">' +
                                    '<option value="Por Atender" class="por-atender" ' +
                                    (item.estado === 'Por Atender' ? 'selected' :
                                        '') + '>Por Atender</option>' +
                                    '<option value="Atendida" class="atendida" ' + (
                                        item.estado === 'Atendida' ? 'selected' : ''
                                    ) + '>Atendida</option>' +
                                    '<option value="Confirmada" class="confirmada" ' +
                                    (item.estado === 'Confirmada' ? 'selected' :
                                        '') + '>Confirmada</option>' +
                                    '<option value="No Confirmada" class="no-confirmada" ' +
                                    (item.estado === 'No Confirmada' ? 'selected' :
                                        '') + '>No Confirmada</option>' +
                                    '<option value="Anulada" class="anulada" ' + (
                                        item.estado === 'Anulada' ? 'selected' : ''
                                    ) + '>Anulada</option>' +
                                    '</select></span></td>' +
                                    '<td>' +
                                    '<div class="invoice-action text-center">' +
                                    '  <a onclick="$.editarCita(' + item.id +
                                    ');" title="Cambiar cita" class="invoice-action-edit cursor-pointer">' +
                                    '      <i class="feather icon-rotate-ccw"></i>' +
                                    '   </a>' +
                                    ' </div>' +
                                    '</td>' +
                                    '</tr>';
                            });

                            $("#trRegistrosCitas").html(citasPac)

                            //datos de tratameintos
                            let trTratamientos = '';
                            $("#tratamientos-citas").html('')
                            $.each(respuesta.tratamientos, function(i, item) {

                                trTratamientos += ' <tr>' +
                                    '<td class="text-truncate">' + parseInt(i + 1) +
                                    '</td>' +
                                    '<td class="text-truncate"><a style="color: #009c9f;text-decoration: none; background-color: transparent;" onclick="$.verTratmiento(' +
                                    item.id + ',' + item.paciente + ')">' +
                                    agregarCeros(item.id, 5) + '</a></td>' +
                                    '<td class="text-truncate">' + item.nombre +
                                    '</td>' +
                                    '<td class="text-truncate">' + item.nprofe +
                                    '</td>';
                                if (item.estado == 'Pendiente') {
                                    trTratamientos +=
                                        '<td class="text-truncate"><span class="badge badge-success">' +
                                        item.estado + '</span></td>';
                                } else {
                                    trTratamientos +=
                                        '<td class="text-truncate"><span class="badge badge-warning">' +
                                        item.estado + '</span></td>';
                                }
                                trTratamientos += '</tr>';
                            });

                            $('#tratamientos-citas').html(trTratamientos);

                            //datos de recaudo
                            $.buscInfTratamientos(respuesta.paciente.id);

                        }
                    });

                },
                cambioEstado: function(elemento) {

                    let idCita = elemento.dataset.id;
                    let estado = elemento.value;
                    alert(estado)


                    Swal.fire({
                        title: "Esta seguro de cambiar el estado a " + estado + " ?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, cambiar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederCambiarEstado(estado, idCita);
                            $.cargarCita();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "La cita no ha cambiado ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });

                },
                procederCambiarEstado: function(estado, idCita) {


                    var form = $("#formCambioEstadocita");
                    $('#idCita').remove();
                    form.append("<input type='hidden' id='idCita' name='idCita'  value='" + idCita +
                        "'>");
                    form.append("<input type='hidden' id='estadoCita' name='estadoCita'  value='" +
                        estado +
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
                            if (respuesta.estado == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "El estado de la cita fue cambiada a " +
                                        estado + " exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                                $.cargarCitas();
                            }
                        }
                    });
                },
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
                                    '<td class="text-truncate">' + parseInt(i + 1) +
                                    '</td>' +
                                    '<td class="text-truncate mb-25 latest-update-item-name text-bold-600"><a style="color: #009c9f;text-decoration: none; background-color: transparent;" onclick="$.verRecaudo(' +
                                    item.tratamiento + ',' + idPac + ')">' +
                                    agregarCeros(item.tratamiento, 5) +
                                    '</a></td>' +
                                    '<td class="text-truncate">' +
                                    '    <div>' +
                                    '        <p class="mb-25 latest-update-item-name text-bold-600">' +
                                    item.nombreTratamiento +
                                    '        </p>' +
                                    '    </div>' +
                                    '</td>' +
                                    '<td class="text-truncate">' +
                                    '    <div>' +
                                    item.nombreProfesional +
                                    '    </div>' +
                                    '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle;">' +
                                    formatCurrency(
                                        item.total, 'es-CO', 'COP') + '</td>' +
                                    '<td class="text-truncate" style="vertical-align: middle;">' +
                                    formatCurrency(
                                        item.saldo, 'es-CO', 'COP') + '</td>' +
                                    '</tr>';

                            });
                            $("#tratamientosRecaudo-citas").html(tratamientos);
                        }
                    });


                },
                addCita: function() {
                    $('#div-listCitas').hide();
                    $('#btn-addCitas').hide();
                    $('#div-fechaCita').hide();
                    $('#div-addCitas').show();
                    $("#accionCita").val("agregar");
                    $('#tit-citas').html('Agregar cita');
                    var agenda = document.getElementsByClassName('fc-view-container');
                    var primeClase = agenda[0];
                    primeClase.style.overflow =
                        'auto'; // Puedes ajustar 'auto' a otro valor como 'hidden' o 'scroll'
                    primeClase.style.height = '400px';
                    $.cargarProfesionales();


                },

                editarCita: function(idCita) {

                    $.cargarProfesionales();
                    $('#tit-citas').html('Editar cita');
                    $("#accionCita").val("editar");
                    $('#div-listCitas').hide();
                    $('#btn-addCitas').hide();
                    $('#div-fechaCita').show();
                    $('#div-addCitas').show();
                    var agenda = document.getElementsByClassName('fc-view-container');
                    var primeClase = agenda[0];
                    primeClase.style.overflow =
                        'auto'; // Puedes ajustar 'auto' a otro valor como 'hidden' o 'scroll'
                    primeClase.style.height = '400px';


                    var form = $("#formInfoCita");
                    $("#idCita").remove();
                    form.append("<input type='text' id='idCitaPac' name='idCitaPac'  value='" +
                        idCita +
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
                            $('#profesional').val(respuesta.CitasPaciente.profesional).trigger(
                                'change.select2');
                            $('#motivo').val(respuesta.CitasPaciente.motivo).trigger('change.select2');
                            $('#duracionCita').val(respuesta.CitasPaciente.duracion).trigger(
                                'change.select2');

                            $('#fechaHoraInicio').val(respuesta.CitasPaciente.inicio);
                            $('#fechaHoraFinal').val(respuesta.CitasPaciente.final);
                            $.convertFechaCita(respuesta.CitasPaciente.inicio);
                        }

                    });

                },
                convertFechaCita: function(inicio) {
                    const fechaHora = new Date(inicio);

                    // Obtiene el día, mes y año
                    const dia = fechaHora.getDate().toString().padStart(2,
                        '0'); // Asegura que el día tenga dos dígitos
                    const mes = (fechaHora.getMonth() + 1).toString().padStart(2,
                        '0'); // El mes se indexa desde 0
                    const año = fechaHora.getFullYear();

                    // Obtiene la hora y los minutos
                    const hora = fechaHora.getHours().toString().padStart(2,
                        '0'); // Asegura que la hora tenga dos dígitos
                    const minutos = fechaHora.getMinutes().toString().padStart(2,
                        '0'); // Asegura que los minutos tengan dos dígitos
                    const segundos = fechaHora.getSeconds().toString().padStart(2, '0');
                    // Combina los componentes para formar la fecha y hora en el formato deseado
                    fechaHoraSelCita = `${dia}/${mes}/${año} ${hora}:${minutos}`;
                    document.getElementById('fechaHoraSelCita').value = fechaHoraSelCita;

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

                verTratmiento: function(trata, paci) {
                    localStorage.clear();
                    localStorage.setItem('idTratamiento', trata);
                    localStorage.setItem('idPaciente', paci);
                    PEDGITALURL = '{{ url('/AdminPacientes/Tratamientos') }}';
                    const nuevaPestana = window.open(PEDGITALURL, '_blank');
                    nuevaPestana.focus();

                },
                verRecaudo: function(trata, paci) {
                    localStorage.clear();
                    localStorage.setItem('idTratamiento', trata);
                    localStorage.setItem('idPaciente', paci);
                    PEDGITALURL = '{{ url('/AdminPacientes/Recaudos') }}';
                    const nuevaPestana = window.open(PEDGITALURL, '_blank');
                    nuevaPestana.focus();

                },
                verTratamientos: function() {
                    localStorage.clear();
                    let paci = $('#idPaciente').val();
                    localStorage.setItem('idPaciente', paci);
                    PEDGITALURL = '{{ url('/AdminPacientes/Tratamientos') }}';
                    const nuevaPestana = window.open(PEDGITALURL, '_blank');
                },
                verRecaudos: function() {
                    localStorage.clear();
                    let paci = $('#idPaciente').val();
                    localStorage.setItem('idPaciente', paci);
                    PEDGITALURL = '{{ url('/AdminPacientes/Recaudos') }}';
                    const nuevaPestana = window.open(PEDGITALURL, '_blank');
                },
                VerTratamientosList: function(pac) {
                    $('#idPaciente').val(pac);
                    $.verTratamientos();
                },
                cambiaFecha: function(){
                    let prof = $('#profesional').val();
                   $.cargarDisponibilidad2(prof); 
                },
                cargarDisponibilidad: function(id) {

                    var form = $("#formCargarDisponibilidad");
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
                            disponibilidadJSON = respuesta.disponibilidad.map(function(
                                item) {
                                return {
                                    "start": item.inicio,
                                    "end": item.final,
                                    "title": item.nombre + " " + item.apellido,
                                    "id": item.id
                                };
                            });

                            console.log(disponibilidadJSON);
                        }

                    });

                    fcAgendaViews.removeAllEvents();
                    fcAgendaViews.addEventSource(disponibilidadJSON);

                },
                cargarDisponibilidad2: function(id) {
                    var form = $("#formCargarDisponibilidad");
                    $("#idProf").remove();
                    form.append("<input type='hidden' id='idProf' name='idProf'  value='" + id +
                        "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    idCita = $("#idCitaPac").val();
                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {

                            var disponibilidadFiltrada = respuesta.disponibilidad.filter(function(item) {
                                return item.id !== parseInt(idCita);
                            });


                             disponibilidadJSON = disponibilidadFiltrada.map(function(item) {
                                return {
                                    "start": item.inicio,
                                    "end": item.final,
                                    "title": item.nombre + " " + item.apellido,
                                    "id": item.id
                                };
                            });

                            fcAgendaViews.removeAllEvents();
                            fcAgendaViews.addEventSource(disponibilidadJSON);

                            
                        }

                    });

                   

                },
                cancelarProCita: function() {
                    fcAgendaViews.removeAllEvents();

                    $('#div-listCitas').show();
                    $('#btn-addCitas').show();
                    $('#div-addCitas').hide();
                    $('#tit-citas').html('Historial de Citas');
                    $('#profesional').val("").trigger('change.select2');
                    $('#motivo').val("").trigger('change.select2');
                    $('#duracion').val("15").trigger('change.select2');
                    $('#fechaHoraSelCita').val("");
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

                            ////datos tratamiento activos
                            let tratAct = '';
                            let consTrata = 1;
                            $("#div-trata-act").html('');

                            $.each(respuesta.tratamientosAct, function(i, item) {
                                tratAct = '<div id="tratamiento' + item.id +
                                    '" class="row">' +
                                    '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                    '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                    '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                    '            ' + item.nombre + '</h4>' +

                                    '    </div>' +
                                    '</div>' +
                                    '<div class="col-12 hvr-grow-shadow" style="cursor: pointer;">' +
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
                                    '    </div>' +
                                    '</div>' +
                                    '<div class="col-12 hvr-grow-shadow" style="cursor: pointer;">' +
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
                                    '            </p>' +
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

        function clearImage() {
            const previewImage = document.getElementById('previewImage');
            previewImage.src = '../../../app-assets/images/FotosPacientes/avatar-s-1.png';
        }

        function convertirFecha(fecha) {
            // Dividir la fecha en año, mes y día
            const [año, mes, dia] = fecha.split('-');
        
                        // Formatear la fecha en el formato dd/mm/yyyy
            const fechaFormateada = `${dia.padStart(2, '0')}/${mes.padStart(2, '0')}/${año}`;

            return fechaFormateada;
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

        function updatePercentageTratamientos(porcentaje, consTrata) {
            $('#porcentajeTrata' + consTrata).text(porcentaje + '%');
            $('#outerCircleTrata' + consTrata).css('background-image',
                `conic-gradient(#24BEC0 0deg, #24BEC0 ${3.6 * porcentaje}deg, #F0F0F0 ${3.6 * porcentaje}deg)`);
        }

        function validartxt(e) {
            tecla = e.which || e.keyCode;
            patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
            te = String.fromCharCode(tecla);
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
        }

        function agregarCeros(numero, longitud) {
            return numero.toString().padStart(longitud, '0');
        }

        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
        }
    </script>
                
    </script>
@endsection
