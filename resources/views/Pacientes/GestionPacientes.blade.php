@extends('Plantilla.Principal')
@section('title', 'Gestionar Pacientes')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
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

                                    <th>
                                        <span class="align-middle">Identidicación</span>
                                    </th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Tratamiento</th>
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
                                    <a class="nav-link d-flex disabled"  onclick="$.cargarCitas();" id="account-pill-citas" data-toggle="pill"
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
                                                        <div
                                                            class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="button" id="btnGuardar" onclick="$.guardar()"
                                                                class="btn btn-primary mr-sm-1 mb-1 mb-sm-0"> <i
                                                                    class="fa fa-save"></i> Guardar
                                                                Cambios</button>
                                                            <button type="reset" onclick="$.ListPacientes()"
                                                                class="btn btn-light"><i class="fa fa-reply"></i>
                                                                Atras</button>
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
                                                                        <th>
                                                                            <span class="align-middle">Motivo de la
                                                                                consulta</span>
                                                                        </th>
                                                                        <th>Profesional</th>
                                                                        <th>Fecha y Hora</th>
                                                                        <th>Estado</th>
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
                                                                                <input disabled type="text"
                                                                                    class="form-control"
                                                                                    id="fechaHoraSelCita"
                                                                                    name="fechaHoraSelCita"
                                                                                    placeholder="Fecha cita">
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
                                                                        <button type="button" id="btnGuardar"
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
                                            <div class="tab-pane fade" id="account-vertical-recaudo" role="tabpanel"
                                                aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form novalidate>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="accountTextarea">Bio</label>
                                                                <textarea class="form-control" id="accountTextarea" rows="3" placeholder="Your Bio data here..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-birth-date">Birth date</label>
                                                                    <input type="text"
                                                                        class="form-control birthdate-picker" required
                                                                        placeholder="Birth date" id="account-birth-date"
                                                                        data-validation-required-message="This birthdate field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="accountSelect">Country</label>
                                                                <select class="form-control" id="accountSelect">
                                                                    <option>USA</option>
                                                                    <option>India</option>
                                                                    <option>Canada</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="languageselect2">Languages</label>
                                                                <select class="form-control" id="languageselect2"
                                                                    multiple="multiple">
                                                                    <option value="English" selected>English</option>
                                                                    <option value="Spanish">Spanish</option>
                                                                    <option value="French">French</option>
                                                                    <option value="Russian">Russian</option>
                                                                    <option value="German">German</option>
                                                                    <option value="Arabic" selected>Arabic</option>
                                                                    <option value="Sanskrit">Sanskrit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-phone">Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        id="account-phone" required
                                                                        placeholder="Phone number" value="(+656) 254 2568"
                                                                        data-validation-required-message="This phone number field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-website">Website</label>
                                                                <input type="text" class="form-control"
                                                                    id="account-website" placeholder="Website address">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="musicselect2">Favourite Music</label>
                                                                <select class="form-control" id="musicselect2"
                                                                    multiple="multiple">
                                                                    <option value="Rock">Rock</option>
                                                                    <option value="Jazz" selected>Jazz</option>
                                                                    <option value="Disco">Disco</option>
                                                                    <option value="Pop">Pop</option>
                                                                    <option value="Techno">Techno</option>
                                                                    <option value="Folk" selected>Folk</option>
                                                                    <option value="Hip hop">Hip hop</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="moviesselect2">Favourite movies</label>
                                                                <select class="form-control" id="moviesselect2"
                                                                    multiple="multiple">
                                                                    <option value="The Dark Knight" selected>The Dark
                                                                        Knight
                                                                    </option>
                                                                    <option value="Harry Potter" selected>Harry Potter
                                                                    </option>
                                                                    <option value="Airplane!">Airplane!</option>
                                                                    <option value="Perl Harbour">Perl Harbour</option>
                                                                    <option value="Spider Man">Spider Man</option>
                                                                    <option value="Iron Man" selected>Iron Man</option>
                                                                    <option value="Avatar">Avatar</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                                changes</button>
                                                            <button type="reset" class="btn btn-light">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-tratamiento" role="tabpanel"
                                                aria-labelledby="account-pill-social" aria-expanded="false">
                                                <form>
                                                    <div class="card-header">
                                                        <h4 class="card-title">Planes de tratamiento</h4>
                                                        <div class="heading-elements mt-0">
                                                            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#AddContactModal"><i class="d-md-none d-block feather icon-plus white"></i>
                                                                <span class="d-md-block d-none"> <li class="fa fa-share"></li> Ir a tratamientos</span></button>
                                                            <span class="dropdown">
                                                                <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-warning dropdown-menu-right dropdown-toggle btn-md">
                                                                    <i class="fa fa-eye white"></i> </button>
                                                                <span aria-labelledby="btnSearchDrop1" class="dropdown-menu dropdown-menu-right mt-1" x-placement="bottom-end" style="position: absolute; transform: translate3d(-108px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a href="#" class="dropdown-item"><i class="fa fa-eye"></i> Todos los tratamientos</a>
                                                                    <a href="#" class="dropdown-item"><i class="fa fa-eye"></i> Tratamietos Activos</a>
                                                                    <a href="#" class="dropdown-item"><i class="fa fa-eye"></i> Tratamietos finalizados</a>
                                                                </span>
                                                            </span>
                                                            <button class="btn btn-default btn-sm"><i class="feather icon-settings white"></i></button>
                                                        </div>
                                                    </div>

                                                    <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamientos Activos</h4>
                                                    <hr>

                                                    <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                        <div class="card info-time-tracking">
                                                            <div class="card-content">
                                                                <div class="row">
                                                                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                                                                        <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                                                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamiento de depilacion laser</h4>
                                                                       
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-body">
                                                                            <div class="row justify-content-center align-items-center">
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-user"></span> Profesional:</h6>
                                                                                    <p>Mairen Pumarejo</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-th-large"></span> Especialidad:</h6>
                                                                                    <p>Consulta General</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-calendar"></span> Ultima Cita:</h6>
                                                                                    <p>23/11/2023 08:00 AM</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <div id="general_task_radial_bar_chart"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Otros Tratamientos</h4>
                                                    <hr>

                                                    <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                        <div class="card info-time-tracking">
                                                            <div class="card-content">
                                                                <div class="row">
                                                                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                                                                        <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                                                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamiento de depilacion laser</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-body">
                                                                            <div class="row justify-content-center align-items-center">
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-user"></span> Profesional:</h6>
                                                                                    <p>Mairen Pumarejo</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-th-large"></span> Especialidad:</h6>
                                                                                    <p>Consulta General</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <h6 class="pt-1"><span class="fa fa-calendar"></span> Ultima Cita:</h6>
                                                                                    <p>15/11/2023 09:00 AM</p>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                                    <div id="general_task_radial_bar_chart2"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-recaudos" role="tabpanel"
                                                aria-labelledby="account-pill-connections" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                            <strong>Twitter</strong></a>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                        <h6>You are connected to facebook.</h6>
                                                        <span>Johndoe@gmail.com</span>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <a href="javascript: void(0);" class="btn btn-danger">Connect
                                                            to
                                                            <strong>Google</strong>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                        <h6>You are connected to Instagram.</h6>
                                                        <span>Johndoe@gmail.com</span>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                            changes</button>
                                                        <button type="reset" class="btn btn-light">Cancel</button>
                                                    </div>
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var $primary = "#00b5b8",
            $secondary = "#2c3648",
            $success = "#0f8e67",
            $info = "#179bad",
            $warning = "#ffb997",
            $danger = "#ff8f9e"

            var disponibilidadJSON = [{
                    "start": "2023-10-09T08:00:00",
                    "end": "2023-10-09T09:00:00",
                    "title": "Nombre del paciente 1"
                },
                {
                    "start": "2023-10-10T10:00:00",
                    "end": "2023-10-10T11:00:00",
                    "title": "Nombre del paciente 2"
                }

            ];

            $('#notifCliente').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            var general_task_radial_bar_chart_options = {
                chart: {
                  height: 145,
                  width: 170,
                  type: 'radialBar',
                  offsetY: 30,
                  toolbar: {
                    show: false
                  }
                },
            
                plotOptions: {
                  radialBar: {
                    hollow: {
                      margin: 0,
                      size: '80%',
                    },
                    track: {
                      background: '#eee',
                      strokeWidth: '80%',
                      margin: 0, // margin is in pixels
            
                    },
            
                    dataLabels: {
                      showOn: 'always',
                      name: {
                        show: false,
                      },
                      value: {
                        formatter: function (val) {
                          return parseInt(val) + '%';
                        },
                        offsetY: 8,
                        color: $info,
                        fontSize: '20px',
                        show: true,
                      }
                    }
                  }
                },
                responsive: [
                  {
                    breakpoint: 768,
                    options: {
                      chart: {
                        width: 80,
                        offsetX: -15
                      },
                      legend: {
                        show: false
                      }
                    }
                  }
                ],
                fill: {
                  colors: [$primary]
                },
                series: [67],
                stroke: {
                  lineCap: 'flat'
                },
                labels: ['Percent'],
            
              }
            
              var general_task_radial_bar_chart = new ApexCharts(
                document.querySelector("#general_task_radial_bar_chart"),
                general_task_radial_bar_chart_options
              );
            
              var general_task_radial_bar_chart2 = new ApexCharts(
                document.querySelector("#general_task_radial_bar_chart2"),
                general_task_radial_bar_chart_options
              );
            
              general_task_radial_bar_chart.render();
              general_task_radial_bar_chart2.render();
            

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
                            alert(
                                'La nueva cita se superpone con una cita existente. Por favor, elige otra hora.'
                            );
                            return;
                        }

                        let motivo = document.getElementById('motivo').value;

                        var nuevaCita = {
                            title: motivo,
                            start: nuevaCitaStart,
                            end: nuevaCitaEnd,
                        };

                        console.log('Fecha y hora de inicio de la nueva cita: ', nuevaCita.start);
                        console.log('Fecha y hora de finalización de la nueva cita: ', nuevaCita.end);
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

                    const notifCliente = document.getElementById('notifCliente');

                    if (notifCliente.checked) {
                        notifCliente = "si";
                    } else {
                        notifCliente = "no";
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarCita");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var token = $("#token").val();
                    var idPac = $("#idPaciente").val()
                    $("#idtoken").remove();
                    $("#accion").remove();
                    $("#idpac").remove();
                    $("#notCliente").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idpac' name='idpac'  value='" + idPac +
                        "'>");
                    form.append("<input type='hidden' id='notCliente' name='notCliente'  value='" +
                        notifCliente +
                        "'>");

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
                    $('#cont-crear').show();
                    $('#cont-lista').hide();
                    $("#accion").val("editar");
                    document.getElementById("div-media").style.pointerEvents = "auto";

                    $("#btnGuardar").show();

                    $("#idPaciente").val(id);

                    citas.classList.remove("disabled");
                    tratamiento.classList.remove("disabled");
                    recaudos.classList.remove("disabled");

                    var form = $("#formBuscarPaciente");
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + id + "'>");

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

                    $("#trMultimedia").html(multimedia);
                },
                ver: function(id) {
                    $('#cont-crear').show();
                    $('#cont-lista').hide();
                    $("#idPaciente").val(id);
                    $("#btnGuardar").hide();

                    document.getElementById("div-media").style.pointerEvents = "none";

                    citas.classList.remove("disabled");
                    tratamiento.classList.remove("disabled");
                    recaudos.classList.remove("disabled");

                    var form = $("#formBuscarPaciente");
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" + id + "'>");

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

                    $("#trMultimedia").html(multimedia);
                },
                addCita: function() {
                    $('#div-listCitas').hide();
                    $('#btn-addCitas').hide();
                    $('#div-addCitas').show();
                    $('#tit-citas').html('Agregar Cita');
                    var agenda = document.getElementsByClassName('fc-view-container');
                    var primeClase = agenda[0];
                    primeClase.style.overflow =
                        'auto'; // Puedes ajustar 'auto' a otro valor como 'hidden' o 'scroll'
                    primeClase.style.height = '400px';

                    $.cargarProfesionales();

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

                        }
                    });

                    fcAgendaViews.removeAllEvents();
                    fcAgendaViews.addEventSource(disponibilidadJSON);

                },
                cancelarProCita: function() {
                    fcAgendaViews.removeAllEvents();
                    fcAgendaViews.addEventSource(disponibilidadJSON);

                    $('#div-listCitas').show();
                    $('#btn-addCitas').show();
                    $('#div-addCitas').hide();
                    $('#tit-citas').html('Historial de Citas');
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
                                citas += '<td><span class="invoice-amount">' + item.motivo + '</span></td>';
                                citas += '<td><span class="invoice-amount">' + item.nomprof  + '</span></td>';
                                var fechaHora = $.convertirFormato(item.inicio);
                                citas += '<td><span class="invoice-amount">' + fechaHora+ '</span></td>';
                                citas += '<td><span class="invoice-amount"><select class="select2-bg form-control" onchange="$.cambioEstado(this.value);" id="estadoCita">'
                                    +'<option value="Por Atender" class="por-atender">Por Atender</option>'
                                    +'<option value="Atendida" class="atendida">Atendida</option>'
                                    +'<option value="Confirmada" class="confirmada">Confirmada</option>'
                                    +'<option value="No Confirmada" class="no-confirmada">No Confirmada</option>'
                                    +'<option value="Anulada" class="anulada">Anulada</option>'
                                    +'</select></span></td>';
                            });

                        
                        }
                    });

                    $("#trRegistrosCitas").html(citas)
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

        function validartxt(e) {
            tecla = e.which || e.keyCode;
            patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
            te = String.fromCharCode(tecla);
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
        }
    </script>

    document.addEventListener('DOMContentLoaded', function() {
    var menuPaciente = document.getElementById('MenPaciente');
    if (menuPaciente) {
    menuPaciente.classList.add('active');
    }
    });


    </script>
@endsection
