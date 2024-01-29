@extends('Plantilla.Principal')
@section('title', 'Tablero Inicial')
@section('Contenido')
    <div class="content-header row">
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-body">
        <!-- Grouped multiple cards for statistics starts here -->
        <div class="row grouped-multiple-statistics-card">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div
                                    class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                    <span class="card-icon primary d-flex justify-content-center mr-3">
                                        <i class="icon p-1 icon-user customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 id="cantPacientes" class="heading-text text-bold-600">80</h3>
                                        <p class="sub-heading">Pacientes Activos</p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div
                                    class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                    <span class="card-icon danger d-flex justify-content-center mr-3">
                                        <i class="icon p-1 fa fa-calendar customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 id="cantCitas" class="heading-text text-bold-600"></h3>
                                        <p class="sub-heading">Citas hoy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                    <span class="card-icon success d-flex justify-content-center mr-3">
                                        <i class="icon p-1 fa fa-usd customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 id="recaudoHoy" class="heading-text text-bold-600">$ 0,00</h3>
                                        <p class="sub-heading">Recaudo hoy</p>
                                    </div>
                                    <span class="inc-dec-percentage" id="porRecaudoDia">
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div class="d-flex align-items-start">
                                    <span class="card-icon warning d-flex justify-content-center mr-3">
                                        <i class="icon p-1 fa fa-usd  customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 id="recaudoMes" class="heading-text text-bold-600">$ 0,00</h3>
                                        <p class="sub-heading">Recaudo Mes</p>
                                    </div>
                                    <span class="inc-dec-percentage" id="porRecaudoMes">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grouped multiple cards for statistics ends here -->
        <div class="content-body">
            <section id="advance-examples">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Agenda</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div id='fc-agenda-views'
                                                    style="width: 100%; height: 100vh; overflow: hidden;"></div>
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

        <div class="modal fade text-left" id="modalCitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Cita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form class="form" method="post" id="formGuardarCita"
                                action="{{ url('/') }}/AdminCitas/GuardarCita">
                                <input type="hidden" name="accionCita" id="accionCita" value="">
                                <input type="hidden" name="idBloq" id="idBloq" value="">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="fa fa-list-alt"></i> Información</h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Profesional:</label>
                                                            <select onchange="$.cargarDisponibilidad(this.value)"
                                                                class="select2 form-control" id="profesional"
                                                                name="profesional">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Motivo de la
                                                                Consulta:</label>
                                                            <select class="select2 form-control" id="motivo"
                                                                name="motivo">
                                                                <option value="">Seleccione...
                                                                </option>
                                                                <option value="Consulta General">Consulta
                                                                    General</option>
                                                                <option value="Consulta Especializada">
                                                                    Consulta Especializada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Duración: </label>
                                                            <select class="form-control" id="duracionCita"
                                                                name="duracionCita" aria-invalid="false">
                                                                <option value="15">15 minutos</option>
                                                                <option value="30">30 minutos</option>
                                                                <option value="45">45 minutos</option>
                                                                <option value="60">1 hora</option>
                                                                <option value="120">2 horas</option>
                                                                <option value="150">2 horas y 30 min.</option>
                                                                <option value="180">3 horas</option>
                                                                <option value="240">4 horas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Cita
                                                                seleccionada para: </label>
                                                            <input type="hidden" class="form-control"
                                                                id="fechaHoraInicio" name="fechaHoraInicio"
                                                                placeholder="Fecha cita">
                                                            <input type="hidden" class="form-control"
                                                                id="fechaHoraFinal" name="fechaHoraFinal"
                                                                placeholder="Fecha cita">
                                                            <input disabled type="text" class="form-control"
                                                                id="fechaHoraSelCita" name="fechaHoraSelCita"
                                                                placeholder="Fecha cita">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group"
                                                        style="inline-flex: flex; align-items: center;">
                                                        <div class="controls align-content-center">
                                                            <label for="account-username">&nbsp;</label>
                                                            <fieldset>
                                                                <label for="input-16" style="cursor: pointer;"> <input
                                                                        type="checkbox" id="notifCliente" checked>
                                                                    <li class="fa fa-envelope"></li> Notificar a paciente
                                                                    por correo
                                                                </label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-body" id="calendaCita">
                                            <h4 class="form-section"><i class="fa fa-calendar"></i> Fecha</h4>
                                            <div class="card-body">
                                                <div id='fc-agenda-views2' style=" width: 100%;  height: 600px;"></div>
                                            </div>

                                        </div>

                                        <div class="form-body" id="calendaCitaPaci" style="display: none;">
                                            <h4 class="form-section"><i class="fa fa-user"></i> Información del Paciente
                                            </h4>
                                            <div class="card-body">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item" onclick="$.habPacExist();">
                                                        <a class="nav-link active" id="homeIcon-tab" data-toggle="tab"
                                                            href="#homeIcon" aria-controls="homeIcon" role="tab"
                                                            aria-selected="true"><i class="fa fa-user"></i> Paciente
                                                            existente</a>
                                                    </li>
                                                    <li class="nav-item" onclick="$.habPacNuevo();">
                                                        <a class="nav-link" id="profileIcon-tab" data-toggle="tab"
                                                            href="#profileIcon" aria-controls="profileIcon"
                                                            role="tab" aria-selected="false"><i
                                                                class="fa fa-user-plus"></i> Paciente nuevo</a>
                                                    </li>


                                                </ul>
                                                <div class="tab-content px-1 pt-1">
                                                    <div class="tab-pane active" id="homeIcon"
                                                        aria-labelledby="homeIcon-tab" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="account-username">Paciente:</label>
                                                                        <select onchange="$.selecPaciente(this.value)"
                                                                            class="select2 form-control" id="paciente"
                                                                            name="paciente">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="account-username">Comentario:</label>
                                                                        <textarea class="form-control" id="comentario" name="comentario" rows="3"
                                                                            placeholder="Ingrese un comentario"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane in" id="profileIcon">
                                                        <input type="hidden" name="idPaciente" id="idPaciente"
                                                            value="">
                                                        <input type="hidden" name="accion" id="accion"
                                                            value="agregar">
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
                                                                        onclick="$.clearImage()">Limpiar</button>
                                                                </div>
                                                                <p class="text-muted ml-75 mt-50"><small>Solo JPG, GIF o
                                                                        PNG.
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
                                                                        <label
                                                                            for="account-username">Identificación</label>
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
                                                                        <input name="nacimiento" id="nacimiento"
                                                                            class="form-control date-inputmask"
                                                                            type="text"
                                                                            placeholder="Ingresa Fecha de Nacimiento"
                                                                            data-inputmask="'alias': 'datetime','inputFormat': 'dd/mm/yyyy'">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-5">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="account-e-mail">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="email" name="email"
                                                                            placeholder="Email" value="" required
                                                                            data-validation-required-message="This email field is required">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-5">
                                                                <div class="form-group">
                                                                    <label for="account-company">Dirección</label>
                                                                    <input type="text" class="form-control"
                                                                        id="direccion" name="direccion"
                                                                        placeholder="Dirección">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="account-company">Ciudad</label>
                                                                    <input type="text" class="form-control"
                                                                        id="ciudad" name="ciudad"
                                                                        onkeypress="return validartxt(event)"
                                                                        placeholder="Ciudad" value=""
                                                                        data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label for="account-company">Teléfono</label>
                                                                    <input type="text" class="form-control"
                                                                        id="telefono" name="telefono"
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
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="account-company">Comentario</label>
                                                                    <div class="form-group">
                                                                        <textarea name="comentario2" class="form-control textarea-maxlength" id="comentario2"
                                                                            placeholder="Ingrese un comentario" maxlength="250" rows="3"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

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

                        <div class="form-actions right" id="div-btnes" style="text-align: right">

                            <button type="button" onclick="$.cancelarProCita();" class="btn btn-warning mr-1">
                                <i class="feather icon-corner-up-left"></i> Salir
                            </button>
                            <button type="button" style="display: none;" id="btnAtras" onclick="$.atrasCita()"
                                class="btn btn-info">
                                <i class="fa fa fa-arrow-left"></i> Atras
                            </button>
                            <button type="button" id="btnGuardar" onclick="$.continuar()" class="btn btn-success">
                                <i class="fa fa fa-arrow-right"></i> Continuar
                            </button>

                        </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade text-left" id="modalCitasDeta" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="media p-1">
                            <div class="media-left pr-1"><span class="avatar avatar-online avatar-sm rounded-circle"
                                    style="width: 60px !important;  height: 60px !important;"><img
                                        src="../../../app-assets/images/FotosPacientes/avatar-s-1.png" alt="avatar"
                                        id="previewImageDetCita"><i></i></span></div>
                            <div class="media-body media-middle">
                                <h5 id="npacientedetCita" style="text-transform: capitalize;"
                                    class="media-heading text-bold-600">77097205 - Xiamir Luquez Ramirez</h5>
                                <p id="edadDetaCita"></p>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="homeIcon-tab" data-toggle="tab" href="#infCita"
                                        aria-controls="homeIcon" role="tab" aria-selected="true"><i
                                            class="fa fa-calendar"></i> Detalle de la Cita</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profileIcon-tab" data-toggle="tab" href="#infTrata"
                                        aria-controls="profileIcon" role="tab" aria-selected="false"><i
                                            class="fa fa-street-view"></i> Plan de tratamiento</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" data-toggle="tab" href="#infDatos" aria-haspopup="true">
                                        <i class="fa fa-address-card-o"></i> Datos Personales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="aboutIcon-tab" data-toggle="tab" href="#infReca"
                                        aria-controls="about" role="tab" aria-selected="false"><i
                                            class="fa feather icon-shopping-cart"></i> Recaudo</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active" id="infCita" aria-labelledby="homeIcon-tab"
                                    role="tabpanel">
                                    <div class="col-12">
                                        <h5 class="mb-1"><i class="feather icon-info"></i> Información de la cita</h5>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-600">Motivo de la cita:</td>
                                                    <td id="motivoCita"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-600">Profesional:</td>
                                                    <td id="profesionalCita"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-600">Fecha y hora de Inicio:</td>
                                                    <td id="inicioCita">deanstanley@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-600">Fecha y hora de finalización:</td>
                                                    <td id="finalcita"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-600">Comentario:</td>
                                                    <td style="white-space: pre-line;" id="cometarioCita">Sin Comentario
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-600">Cambiar estado:</td>
                                                    <td id="final">
                                                        <select class="select2-bg form-control"
                                                            onchange="$.cambioEstado(this.value);" id="bg-select">
                                                            <option value="Por Atender" class="por-atender">Por Atender
                                                            </option>
                                                            <option value="Atendida" class="atendida">Atendida</option>
                                                            <option value="Confirmada" class="confirmada">Confirmada
                                                            </option>
                                                            <option value="No Confirmada" class="no-confirmada">No
                                                                Confirmada</option>
                                                            <option value="Anulada" class="anulada">Anulada</option>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2">
                                                        <div class="form-actions right">
                                                            <button type="button" onclick="$.notifCPaciente();"
                                                                class="btn btn-warning mr-1">
                                                                <i class="  feather icon-bell"></i> Notificar al Cliente
                                                            </button>
                                                            <button type="button" onclick="$.addComentario();"
                                                                class="btn btn-primary">
                                                                <i class="feather icon-message-square"></i> Agregar
                                                                Comentario
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                                <div class="tab-pane" id="infTrata" aria-labelledby="profileIcon-tab" role="tabpanel">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p><span class="float-right"><a
                                                        style="color: #009c9f;text-decoration: none; background-color: transparent;"
                                                        onclick="$.verTratamientos();" target="_blank">Ver Tratamientos <i
                                                            class="feather icon-arrow-right"></i></a></span></p>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="recent-orders"
                                                class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tratamiento</th>
                                                        <th>Nombre</th>
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
                                <div class="tab-pane" id="infDatos" aria-labelledby="dropdownIcon1-tab"
                                    role="tabpanel">
                                    <div class="col-12">


                                        <h5 class="mb-1"><i class="feather icon-info"></i> Información Personal</h5>
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-600">Identificación:</td>
                                                    <td id="identificacionCita"></td>
                                                    <td class="text-bold-600">nombre:</td>
                                                    <td id="nombreCita"></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-bold-600">Sexo:</td>
                                                    <td id="sexoCita"></td>
                                                    <td class="text-bold-600">Fecha Nacimiento:</td>
                                                    <td id="nacimientoCita"></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-bold-600">Teléfono:</td>
                                                    <td id="telefonoCita"></td>
                                                    <td class="text-bold-600">Email:</td>
                                                    <td id="emailCita"></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-bold-600">Dirección:</td>
                                                    <td id="direccionCita" colspan="3"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="infReca" aria-labelledby="dropdownIcon2-tab"
                                    role="tabpanel">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p><span class="float-right"><a
                                                        style="color: #009c9f;text-decoration: none; background-color: transparent;"
                                                        onclick="$.verRecaudos();" target="_blank">Ver Recaudos <i
                                                            class="feather icon-arrow-right"></i></a></span></p>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="recent-orders"
                                                class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>No. tratamiento</th>
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

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{--  Modal comentarios  --}}
        <div class="modal fade text-left" id="modalComentarios" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Comentarios</h4>

                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardarComentario"
                                action="{{ url('/') }}/AdminCitas/GuardarComentario">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="userinput8">Comentario:</label>
                                            <div class="d-flex align-items-start">
                                                <textarea name="comentarioCitaVal" class="form-control textarea-maxlength" id="comentarioCitaVal"
                                                    placeholder="Ingrese un comentario.." maxlength="250" rows="5"></textarea>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-actions right">
                                            <button type="button" onclick="$.guardarComentario();"
                                                class="btn btn-success mr-1">
                                                <i class="feather  icon-check"></i>
                                                Guardar
                                            </button>
                                            <button type="button" onclick="$.salirComentario();"
                                                class="btn btn-warning mr-1">
                                                <i class="feather icon-corner-up-left"></i>
                                                Salir
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
        {{--  Modal imprimir citas  --}}
        <div class="modal fade text-left" id="modalImpCitas" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Selecciona el rango de fecha </h4>

                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="userinput8">Fecha inicial:</label>

                                    <div class="form-group d-flex align-items-center position-relative">
                                        <!-- date picker -->
                                        <div class="date-icon mr-50 font-medium-3">

                                            <i class='feather icon-calendar'></i>

                                        </div>
                                        <div class="date-picker">
                                            <input type="text" id="fi" name="fi"
                                                class="pickadate form-control pl-1" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="userinput8">Fecha final:</label>

                                    <div class="form-group d-flex align-items-center position-relative">
                                        <!-- date picker -->
                                        <div class="date-icon mr-50 font-medium-3">

                                            <i class='feather icon-calendar'></i>

                                        </div>
                                        <div class="date-picker">
                                            <input type="text" id="ff" name="ff"
                                                class="pickadate form-control pl-1" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="text-align: right;">
                                    <div class="form-actions right">
                                        <button type="button" onclick="$.salirPrint();" class="btn btn-warning mr-1">
                                            <i class="fa fa-reply"></i> Salir
                                        </button>
                                        <button type="button" id="btnGuardar" onclick="$.imprimircitas()"
                                            class="btn btn-success">
                                            <i class="fa fa-print"></i> Imprimir
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{--  Modal bloquear  --}}
        <div class="modal fade text-left" id="modalBloquear" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Bloquear espacio </h4>

                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form class="form" method="post" id="formGuardarBloq"
                            action="{{ url('/') }}/AdminCitas/GuardarBloq">
                            <div class="row">
                                <div class="col-6">
                                    <label for="userinput8">Duración:</label>
                                    <select class="form-control" id="duracionBloq"
                                    name="duracionBloq" onchange="$.cambioDuracionBloq(this.value);" aria-invalid="false">
                                    <option value="15">15 minutos</option>
                                    <option value="30">30 minutos</option>
                                    <option value="45">45 minutos</option>
                                    <option value="60">1 hora</option>
                                    <option value="120">2 horas</option>
                                    <option value="150">2 horas y 30 min.</option>
                                    <option value="180">3 horas</option>
                                    <option value="240">4 horas</option>
                                </select>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="account-username">Bloqueo
                                                seleccionado para: </label>
                                            <input type="hidden" class="form-control"
                                                id="fechaHoraInicioBloq" name="fechaHoraInicioBloq"
                                                placeholder="Fecha Bloqueo">
                                            <input type="hidden" class="form-control"
                                                id="fechaHoraFinalBloq" name="fechaHoraFinalBloq"
                                                placeholder="Fecha Bloqueo">
                                            <input disabled type="text" class="form-control"
                                                id="fechaHoraSelCitaBloq" name="fechaHoraSelCitaBloq"
                                                placeholder="Fecha Bloqueo">
                                        </div>
                                    </div>
                                    
                                  
                                
                                </div>
                                <div class="col-12">
                                    <label for="userinput8">Comentario:</label>
                                    <div class="d-flex align-items-start">
                                        <textarea name="comentarioBloq" class="form-control textarea-maxlength" id="comentarioBloq"
                                            placeholder="Ingrese un comentario.." maxlength="250" rows="5"></textarea>

                                    </div>
                                </div>
                                <div class="col-12  mt-1" style="text-align: right;">
                                    <div class="form-actions right">
                                        <button type="button" onclick="$.salirBloq();" class="btn btn-warning mr-1">
                                            <i class="fa fa-reply"></i> Salir
                                        </button>
                                        <button type="button" id="btnGuardarBloq" onclick="$.guardarBloq()"
                                            class="btn btn-success">
                                            <i class="fa fa-save"></i> Guardar
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

    </div>

    <form action="{{ url('/AdminPacientes/AllProfesionales') }}" id="formCargarProfesionales" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/AllEspecialidades') }}" id="formCargarEspecialidades" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/CargarDisponibilidad') }}" id="formCargarDisponibilidad" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/CargarPacientesCita') }}" id="formCargarPacientes" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/CargarAllCitas') }}" id="formCargarCitas" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/ValidarPacientes') }}" id="formValidarPacientes" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/VerDetallesCita') }}" id="formVerDetallesCita" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/Administracion/CargarDatos') }}" id="formCargarDatos" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/CambioEstadocita') }}" id="formCambioEstadocita" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/TratamientosRecaudo') }}" id="formCargarTratamientos" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/cargarComentario') }}" id="formCargarComentarios" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/updateServiciosTerminados') }}" id="formServTerminados" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/notificaccionCita') }}" id="formCambioNotifCita" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/imprimircitas') }}" id="formImprimir" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminCitas/InfoBloqueo') }}" id="forminfoBloqueo" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenInicio").addClass("active");
            localStorage.clear();

            var disponibilidadJSON = [{
                    "start": "2023-11-02T08:00:00",
                    "end": "2023-11-02T09:00:00",
                    "title": "Nombre del paciente 1"
                },
                {
                    "start": "2023-10-10T10:00:00",
                    "end": "2023-10-10T11:00:00",
                    "title": "Nombre del paciente 2"
                }

            ];
            var disponibilidadJSONBloq = [];


            $('#bg-select').select2();

            $('#bg-select').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var selectedClass = selectedOption.attr('class');
                $(this).css('background-color', selectedOption.css('background-color'));
                $(this).css('color', selectedOption.css('color'));
            });

            $('.date-inputmask').inputmask("dd/mm/yyyy");

            var disponibilidadProfesional = [];

            $('#notifCliente').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            document.getElementById('account-upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');

                if (file) {
                    const imageUrl = URL.createObjectURL(file);
                    previewImage.src = imageUrl;
                }
            });

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


            var fechaActual = new Date().toISOString().split("T")[0];
            var calendarE3 = document.getElementById("fc-agenda-views");
            var clickedEventBloq;
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
                contentHeight: 'auto',
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
                    more: "Mas"
                },
                viewDidMount: function(viewInfo) {
                    // Aplicar estilos después de que la vista se haya montado
                    applyStylesAfterViewMount(viewInfo);
                },

                eventRender: function(info) {
                    // Cambiar el tamaño de fuente de los eventos aquí
                    info.el.style.fontSize = '9px'; // Ajustar el tamaño de fuente según tus necesidades
                    console.log(info);
                    // Agregar el campo "prof" al contenido del evento

                    var prof = info.event.extendedProps.prof;
                    var estado = info.event.extendedProps.estado;
                    var id = info.event.extendedProps.id;
                    var bloq = info.event.extendedProps.bloq;

                    if(bloq == "CITAS"){
                        if (prof) {
                            var profElement = document.createElement('div');
                            profElement.className = 'fc-event-prof';
                            profElement.textContent = 'Prof: ' + prof;
                            info.el.appendChild(profElement);
                        }
                        if (estado) {
                            var estadoElement = document.createElement('div');
                            estadoElement.className = 'fc-event-estado';
                            estadoElement.textContent = 'Estado: ' + estado;
                            estadoElement.style.fontSize = '9px';
                            info.el.appendChild(estadoElement);
                        }
    
                        info.el.style.color = '#ffff';
                        if (estado) {
                            // ... (código existente)
    
                            // Cambiar el color de fondo según el estado
                            switch (estado) {
                                case 'Por atender':
                                    info.el.style.backgroundColor =
                                        '#00B5B8'; // Color para estado pendiente
                                    break;
                                case 'Atendida':
                                    info.el.style.backgroundColor =
                                        '#2196F3'; // Color para estado confirmado
                                    break;
                                case 'Confirmada':
                                    info.el.style.backgroundColor =
                                        '#10C888'; // Color para estado cancelado
                                    break;
                                    // Añade más casos según sea necesario para otros estados
                                default:
                                    info.el.style.backgroundColor =
                                        '#2DCEE3'; // Color predeterminado si no hay coincidencia
                            }
    
                        }
                    }else{
                        info.el.style.color = '#ffff';
                        info.el.style.backgroundColor = '#547A8B';

                    }
                

                    applyStyles(info.el);
                },
                eventClick: function(info) {
                    // Obtiene el valor del campo "id" del evento clicado

                    var idCita = info.event.extendedProps.idCita;
                    var estado = info.event.extendedProps.estado;
                    var bloq = info.event.extendedProps.bloq;

                    if(bloq == "CITAS"){
                        $.verCita(idCita);
                    }else{
                        $.verBloq(idCita);     
                    }                    
                   
                },
                slotDuration: '00:15:00', // Duración de cada intervalo en la vista semanal (aquí es de una hora)
                slotLabelInterval: "00:15", // Mostrar etiquetas de hora cada una hora
                minTime: "08:00:00",
                maxTime: "18:45:00",
                hiddenDays: [0],
                locale: "es",
                dateClick: function(event) {
                    clickedEventBloq = event;
                    $('#duracionBloq').val("15").trigger('change.select2');
                   // $("#fechaHoraSelCitaBloq").val("");
                    $("#comentarioBloq").val("");

                    $("#modalBloquear").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var btnGuardar = document.getElementById("btnGuardarBloq");
                    btnGuardar.disabled = false;
                    
                },
                events: disponibilidadJSON

            });

            fcAgendaViews.render();

            var calendarE32 = document.getElementById("fc-agenda-views2");
            var fcAgendaViews2 = new FullCalendar.Calendar(calendarE32, {
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
                    more: "Mas"
                },
                slotDuration: '00:15:00', // Duración de cada intervalo en la vista semanal (aquí es de una hora)
                slotLabelInterval: "00:15", // Mostrar etiquetas de hora cada una hora
                minTime: "08:00:00",
                maxTime: "18:45:00",
                hiddenDays: [0],
                locale: "es",
                dateClick: function(event) {
                    console.log('clicked on the date: ', event);
                    if (event) {
                        var duracionCita = parseInt(document.getElementById('duracionCita').value);
                        var nuevaCitaStart = new Date(event.date);
                        var nuevaCitaEnd = new Date(nuevaCitaStart.getTime() + duracionCita *
                            60000); // Duración en milisegundos
                        // Verifica si la nueva cita se superpone con alguna cita existente
                        var seSuperpone = disponibilidadJSON.some(function(cita) {
                            var citaStart = new Date(cita.start);
                            var citaEnd = new Date(cita.end);
                            
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


                        var select2Element = $('#motivo');
                        let motivo = document.getElementById('motivo').value + "-" + select2Element
                            .find('option:selected').text();

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
                        fcAgendaViews2.addEvent(nuevaCita);

                        // Cierra el evento clickeado
                        fcAgendaViews2.refetchEvents();
                    }
                }

            });

            fcAgendaViews2.render();

            var agenda = document.getElementsByClassName('fc-view-container');
            var primeClase = agenda[0];
            var segunClase = agenda[1];
            primeClase.style.overflow = 'auto';
            primeClase.style.height = '500px';
            segunClase.style.overflow = 'auto';
            segunClase.style.height = '350px';

            var fcLeftDiv = document.querySelector('.fc-left');

            var iconElement = document.createElement('i');
            iconElement.className = 'fa fa-plus';

            var iconElement2 = document.createElement('i');
            iconElement2.className = 'fa fa-print';

            // Crea un elemento de botón
            var miBoton = document.createElement('button');
            miBoton.textContent = ' Agregar cita';
            // Crea un elemento de botón
            var miBotonImp = document.createElement('button');
            miBotonImp.textContent = ' Imprimir citas';

            // Agrega un identificador o clases al botón si es necesario
            miBoton.id = 'agregarCita';
            miBoton.classList.add('fc-today-button', 'fc-button', 'fc-button-primary');
            miBoton.insertBefore(iconElement, miBoton.firstChild);
            // Agrega un identificador o clases al botón si es necesario
            miBotonImp.id = 'imprimirCita';
            miBotonImp.classList.add('fc-today-button', 'fc-button', 'fc-button-segundary');
            miBotonImp.insertBefore(iconElement2, miBotonImp.firstChild);

            // Agrega el botón al div 'fc-left'

            fcLeftDiv.appendChild(miBoton);
            fcLeftDiv.appendChild(miBotonImp);

            miBoton.addEventListener('click', function() {
                // Aquí puedes agregar la lógica que deseas ejecutar cuando se hace clic en el botón
                $("#modalCitas").modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $("#accionCita").val("agregar");

                $('#fechaHoraSelCita').val("");
                $.cargarProfesionales();
                $.cargarEspecialidades();
                fcAgendaViews2.removeAllEvents();
                // Puedes reemplazar la alerta con la acción que desees realizar.
            });

            miBotonImp.addEventListener('click', function() {
                $("#modalImpCitas").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $.extend({

                cargarCita: function() {
                    var form = $("#formCargarCitas");
                    $("#idProf").remove();
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
                                    if(item.tblo == "CITAS"){
                                        return {
                                            "start": item.inicio,
                                            "end": item.final,
                                            "title": item.nombre + " " + item.apellido,
                                            "prof": item.nomprof,
                                            "estado": item.estado,
                                            "idCita": item.id,
                                            "bloq": item.tblo
                                        };
                                    }else{
                                        return {
                                            "start": item.inicio,
                                            "end": item.final,
                                            "title": item.comentario,
                                            "estado": item.estado,
                                            "idCita": item.id,
                                            "bloq": item.tblo
                                        };
                                    }
                                
                            });

                            console.log(disponibilidadJSON);
                            disponibilidadJSONBloq = disponibilidadJSON;
                        }

                    });

                    fcAgendaViews.removeAllEvents();
                    fcAgendaViews.addEventSource(disponibilidadJSON);
                },
                cambioDuracionBloq: function(duracion){
                    console.log(clickedEventBloq);
                    var nuevaCitaStart = new Date(clickedEventBloq.date);
                    var nuevaCitaEnd = new Date(nuevaCitaStart.getTime() + duracion *
                        60000);
                        var seSuperpone = disponibilidadJSONBloq.some(function(cita) {
                            var citaStart = new Date(cita.start);
                            var citaEnd = new Date(cita.end);
                            return (nuevaCitaStart < citaEnd && nuevaCitaEnd > citaStart);
                        });

                        
                        if (seSuperpone) {
                            Swal.fire({
                                type: "warning",
                                title: "Oops...",
                                text: "No se puede bloquear el horario seleccionado, ya que no esta disponible...",
                                confirmButtonClass: "btn btn-primary",
                                buttonsStyling: false
                            });
                            $('#duracionBloq').val("15").trigger('change.select2');
                            $("#fechaHoraSelCitaBloq").val("");
                            return;
                        }

                        var nuevaCita = {
                            title: 'Horario Bloqueado',
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

                     document.getElementById('fechaHoraSelCitaBloq').value = fechaHoraSelCita;
                     document.getElementById('fechaHoraInicioBloq').value = fechaHoraInicio;
                     document.getElementById('fechaHoraFinalBloq').value = fechaHoraFinal;
                        
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
                cargarEspecialidades: function() {

                    var form = $("#formCargarEspecialidades");
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
                            $.each(respuesta.especialidades, function(i, item) {

                                select += '<option value="' + item.id + '">' + item
                                    .nombre + '</option>';

                            });
                        }
                    });

                    $("#motivo").html(select);
                },
                cargarPacientes: function() {

                    var form = $("#formCargarPacientes");
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
                            $.each(respuesta.pacientes, function(i, item) {
                                select += '<option value="' + item.id + '">' + item
                                    .nombre + ' ' + item.apellido + '</option>';
                            });
                        }
                    });

                    $("#paciente").html(select);
                },
                cancelarProCita: function() {
                    fcAgendaViews2.removeAllEvents();
                    $('#modalCitas').modal('toggle');

                    $('#profesional').val("").trigger('change.select2');
                    $('#motivo').val("").trigger('change.select2');
                    $('#duracion').val("15").trigger('change.select2');
                    $('#fechaHoraSelCita').val("");

                    $.atrasCita();
                },
                clearImage: function() {
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = '../../../app-assets/images/FotosPacientes/avatar-s-1.png';
                },
                continuar: function() {

                    if ($("#fechaHoraSelCita").val().trim() == "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar la feha de la cita",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    $.cargarPacientes();
                    document.getElementById("calendaCita").style = "display: none";
                    document.getElementById("calendaCitaPaci").style = "display: block";

                    var btnGuardar = document.getElementById("btnGuardar");
                    var btm_atras = document.getElementById("btnAtras");
                    btm_atras.style.display = "initial";
                    btnGuardar.textContent = " Confirmar Cita";
                    var iconElement = document.createElement('i');
                    iconElement.className = 'fa fa-check';

                    btnGuardar.insertBefore(iconElement, btnGuardar.firstChild);

                    btnGuardar.onclick = function() {
                        $.guardarCita(2);
                    };
                },

                atrasCita: function() {
                    document.getElementById("calendaCita").style = "display: block";
                    document.getElementById("calendaCitaPaci").style = "display: none";
                    var btm_atras = document.getElementById("btnAtras");
                    btm_atras.style.display = "none";

                    var btnGuardar = document.getElementById("btnGuardar");
                    btnGuardar.textContent = " Continuar";
                    btnGuardar.disabled = false;

                    var iconElement = document.createElement('i');
                    iconElement.className = 'fa fa fa-arrow-right';
                    btnGuardar.insertBefore(iconElement, btnGuardar.firstChild);

                    btnGuardar.onclick = function() {
                        $.continuar();
                    };
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
                        }

                    });

                    fcAgendaViews2.removeAllEvents();
                    fcAgendaViews2.addEventSource(disponibilidadJSON);

                },
                selecPaciente: function(id) {
                    $("#idPaciente").val(id);
                    // document.getElementById("div-tratamiento").style = "display: block;";
                },
                guardarCita: function(opc) {


                    var notCli;
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
                        notCli = "si";
                    } else {
                        notCli = "no";
                    }

                    if (opc == 1) {

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
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarCita");
                    var url = form.attr("action");
                    var token = $("#token").val();
                    var idPac = $("#idPaciente").val()
                    $("#idtoken").remove();

                    $("#idpac").remove();
                    $("#opc").remove();
                    $("#notCliente").remove();
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idpac' name='idpac'  value='" + idPac +
                        "'>");
                    form.append("<input type='hidden' id='notCliente' name='notCliente'  value='" +
                        notCli +
                        "'>");
                    form.append("<input type='hidden' id='opc' name='opc'  value='" +
                        opc +
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
                                    text: "La cita fue confirmada exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });

                                $.habNueva();


                                var loader = document.getElementById('loader');
                                loader.style.display = 'none';
                            }

                            $.cargarCita();
                            $.cargarDatos();

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
                guardarBloq: function() {

                    if ($("#fechaHoraSelCitaBloq").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar la hora y fecha del bloqueo",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    if ($("#comentarioBloq").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de ingresar un comentario",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }


                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarBloq");
                    var url = form.attr("action");
                    var token = $("#token").val();
                    var idPac = $("#idPaciente").val()
                    $("#idtoken").remove();

                    $("#idpac").remove();
                    $("#opc").remove();
                    $("#notCliente").remove();
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarBloq')[0]),
                        processData: false,
                        contentType: false,
                        success: function(respuesta) {
                            if (respuesta.estado == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "El bloqueo de horario guardado exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                                var loader = document.getElementById('loader');
                                loader.style.display = 'none';
                            }

                            var btnGuardar = document.getElementById("btnGuardarBloq");
                            btnGuardar.disabled = true;

                            $.cargarCita();
                            $.cargarDatos();

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
                guardarComentario: function() {

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';


                    var form = $("#formGuardarComentario");
                    var url = form.attr("action");
                    var idCita = $("#idCita").val();
                    var token = $("#token").val();
                    $("#idtoken").remove();
                    $("#accionC").remove();
                    form.append("<input type='hidden' id='idCit' name='idCit'  value='" + idCita +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarComentario')[0]),
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

                                $("#cometarioCita").html(respuesta.comentario);
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
                habNueva: function() {
                    var btnGuardar = document.getElementById("btnGuardar");
                    btnGuardar.textContent = " Nueva Cita";
                    btnGuardar.disabled = false;

                    var btm_atras = document.getElementById("btnAtras");
                    btm_atras.style.display = "none";

                    var iconElement = document.createElement('i');
                    iconElement.className = 'fa fa-calendar-plus-o';
                    btnGuardar.insertBefore(iconElement, btnGuardar.firstChild);

                    btnGuardar.onclick = function() {
                        $.nevaCita();
                    };
                },
                nevaCita: function() {
                    fcAgendaViews2.removeAllEvents();

                    $('#profesional').val("").trigger('change.select2');
                    $('#motivo').val("").trigger('change.select2');
                    $('#duracion').val("15").trigger('change.select2');
                    $('#fechaHoraSelCita').val("");
                    $.atrasCita();
                },
                habPacNuevo: function() {
                    var btnGuardar = document.getElementById("btnGuardar");
                    btnGuardar.onclick = function() {
                        $.guardarCita(1);
                    };

                },
                habPacExist: function() {
                    var btnGuardar = document.getElementById("btnGuardar");
                    btnGuardar.onclick = function() {
                        $.guardarCita(2);
                    };
                },

                salirPrint: function () {
                    $('#modalImpCitas').modal('toggle');
                },
                salirBloq: function () {
                    $('#modalBloquear').modal('toggle');
                },
                imprimircitas: function() {
                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';
                    let ini = $("#fi").val();
                    let fin = $("#ff").val();
                    var form = $("#formImprimir");
                    var url = form.attr("action");
                    $('#finicial').remove();
                    $('#ffinal').remove();
                    form.append("<input type='hidden' id='finicial' name='finicial'  value='" + ini +
                        "'>");
                    form.append("<input type='hidden' id='ffinal' name='ffinal'  value='" + fin +
                        "'>");
                    var datos = form.serialize();

                    
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: datos,
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(data) {
                            var loader = document.getElementById('loader');
                            loader.style.display = 'none';
                            
                            Swal.fire({
                                type: "success",
                                title: "",
                                text: "Correo enviado exitosamente",
                                confirmButtonClass: "btn btn-primary",
                                timer: 1500,
                                buttonsStyling: false
                            });

                             // Crear un enlace de descarga para el PDF
                             var a = document.createElement('a');
                             var url = window.URL.createObjectURL(data);
                             a.href = url;
                             a.download = 'InformeCitas.pdf';
                             a.click();
                             window.URL.revokeObjectURL(url);

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
                addComentario: function() {
                    $("#modalComentarios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modalCitasDeta').modal('toggle');

                    // CARGAR COMENTARIO
                    var idCita = $("#idCita").val();
                    var form = $("#formCargarComentarios");
                    var url = form.attr("action");

                    form.append("<input type='hidden' id='idCit' name='idCit'  value='" + idCita +
                        "'>");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#comentarioCitaVal").val(respuesta.comentario);

                        }
                    });


                },
                salirComentario: function() {
                    $("#modalCitasDeta").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $('#modalComentarios').modal('toggle');
                    var miDiv = document.getElementById("modalCitasDeta");
                    miDiv.style.setProperty("overflow-y", "auto", "important");

                },
                verBloq: function(idBloq){
                    console.log(idBloq);
                    $("#idBloq").val(idBloq);
                    $("#accionCita").val("agregar");

                    $('#fechaHoraSelCita').val("");
                    $.cargarProfesionales();
                    $.cargarEspecialidades();
                    $("#modalCitas").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var form = $("#forminfoBloqueo");
                    var url = form.attr("action");
                    $('#idBloq').remove();
                    form.append("<input type='hidden' id='idBloq' name='idBloq'  value='" + idBloq +
                        "'>");
                    var datos = form.serialize();
                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {

                        console.log(response);


                        }
                    });


                },
                verCita: function(idCita) {
                    $("#modalCitasDeta").modal({
                        backdrop: 'static',
                        keyboard: false
                    });


                    var form = $("#formVerDetallesCita");
                    var url = form.attr("action");
                    $('#idCita').remove();
                    form.append("<input type='hidden' id='idCita' name='idCita'  value='" + idCita +
                        "'>");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(response) {
                            //datos de citas

                            $("#motivoCita").html(response.detaCita.nespec);
                            $("#profesionalCita").html(response.detaCita.nomprof);
                            var nuevoFormatoIni = $.convertirFormato(response.detaCita
                                .inicio);
                            $("#inicioCita").html(nuevoFormatoIni);
                            var nuevoFormatoFinal = $.convertirFormato(response.detaCita
                                .final);
                            $("#finalcita").html(nuevoFormatoFinal);
                            $("#cometarioCita").html(response.detaCita.comentario);
                            //datos de paciente
                            $("#idPaciente").val(response.paciente.id);
                            $("#identificacionCita").html(response.paciente
                                .tipo_identificacion + " " + response.paciente
                                .identificacion);
                            $("#nombreCita").html(response.paciente.nombre + " " + response
                                .paciente.apellido);
                            $("#npacientedetCita").html(response.paciente.nombre + " " +
                                response.paciente.apellido);
                            $("#sexoCita").html(response.paciente.sexo);
                            var fechNaci = $.convertirFormatoNac(response.paciente
                                .fecha_nacimiento);
                            $("#nacimientoCita").html(fechNaci);
                            $("#emailCita").html(response.paciente.email);
                            $("#telefonoCita").html(response.paciente.telefono);
                            $("#direccionCita").html(response.paciente.direccion);

                            var foto = response.paciente.foto;
                            const previewImage = document.getElementById(
                                'previewImageDetCita');
                            let url = $('#Ruta').data("ruta");
                            previewImage.src = url + "/images/FotosPacientes/" + foto;


                            var edad = calcularEdad(response.paciente.fecha_nacimiento)
                            $("#edadDetaCita").html(edad + " Años");

                            //datos de tratameintos
                            let trTratamientos = '';
                            $.each(response.tratamientos, function(i, item) {

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
                            $.buscInfTratamientos(response.paciente.id);

                        }
                    });

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
                convertirFormatoNac: function(fecha) {
                    // Crear un objeto Date a partir de la cadena de fecha y hora
                    var fecha = new Date(fecha);

                    // Obtener los componentes de la fecha y la hora
                    var dia = fecha.getDate();
                    var mes = fecha.getMonth() + 1; // Los meses comienzan desde 0, por lo que sumamos 1
                    var anio = fecha.getFullYear();



                    // Crear la cadena formateada
                    var nuevoFormato = `${dia}/${mes}/${anio}`;

                    return nuevoFormato;
                },
                cambioEstado: function(estado) {

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
                            $.procederCambiarEstado(estado);
                            $.cargarCita();
                            $.cargarDatos();

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

                procederCambiarEstado: function(estado) {
                    var idCita = $("#idCita").val();

                    var form = $("#formCambioEstadocita");
                    $('#idCita').remove();
                    $('#estadoCita').remove();
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
                                    timer: 2000,
                                    buttonsStyling: false
                                });
                                $.cargarCita();
                                $.cargarDatos();
                            }

                            {{--  setTimeout(function (){
                                if(respuesta.envioCorreo == 'noCorreo'){
                                    Swal.fire({
                                        type: "errot",
                                        title: "Opsss...",
                                        text: "El paciente no tiene un correo electronico asociaco",
                                        confirmButtonClass: "btn btn-primary",
                                        timer: 1500,
                                        buttonsStyling: false
                                    });
                                }else if(respuesta.envioCorreo == 'Error'){
                                    Swal.fire({
                                        type: "errot",
                                        title: "Opsss...",
                                        text: "Ha ocurrido un error",
                                        confirmButtonClass: "btn btn-primary",
                                        timer: 1500,
                                        buttonsStyling: false
                                    });
                                }else{
                                    Swal.fire({
                                        type: "success",
                                        title: "",
                                        text: "El correo fue enviado exitosamente",
                                        confirmButtonClass: "btn btn-primary",
                                        timer: 1500,
                                        buttonsStyling: false
                                    });
                                }
                            }, 3000);  --}}


                        }
                    });
                },
                notifCPaciente: function() {
                    var idCita = $("#idCita").val();

                    var form = $("#formCambioNotifCita");
                    $('#idCita').remove();
                    $('#estadoCita').remove();
                    form.append("<input type='hidden' id='idCita' name='idCita'  value='" + idCita +
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
                            if (respuesta.envioCorreo == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "",
                                    text: "El correo fue enviado exitosamente",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                            } else if (respuesta.envioCorreo == "noCorreo") {
                                Swal.fire({
                                    type: "errot",
                                    title: "Opsss...",
                                    text: "El paciente no tiene un correo electronico asociaco",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                            } else {
                                Swal.fire({
                                    type: "errot",
                                    title: "Opsss...",
                                    text: "Ha ocurrido un error",
                                    confirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });
                            }
                        }
                    });
                },
                cargarDatos: function() {
                    var form = $("#formCargarDatos");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $('#cantPacientes').html(respuesta.pacientes);
                            $('#cantCitas').html(respuesta.citasHoy);
                            $('#recaudoHoy').html(formatCurrency(respuesta.recaudosHoy,
                                'es-CO', 'COP'));
                            $('#recaudoMes').html(formatCurrency(respuesta.recaudosMes,
                                'es-CO', 'COP'));

                            //DIFERENCIA RECAUDO MES
                            if (respuesta.porcentajeCambioMes >= 0) {
                                $("#porRecaudoMes").html(
                                    '<small class="success" ><i class="fa fa-long-arrow-up"></i> ' +
                                    Math.round(respuesta.porcentajeCambioMes) +
                                    '%</small>');
                            } else {
                                let valRes = respuesta.porcentajeCambioMes;
                                $("#porRecaudoMes").html(
                                    '<small class="danger" ><i class="fa fa-long-arrow-down"></i> ' +
                                    Math.round(valRes) + '%</small>');
                            }

                            //DIFERENCIA RECAUDO DIA
                            if (respuesta.porcentajeCambioDia >= 0) {
                                $("#porRecaudoDia").html(
                                    ' <small class="success" ><i class="fa fa-long-arrow-up"></i> ' +
                                    Math.round(respuesta.porcentajeCambioDia) +
                                    '%</small>');
                            } else {
                                let valResDia = respuesta.porcentajeCambioDia;
                                $("#porRecaudoDia").html(
                                    '<small class="danger" ><i class="fa fa-long-arrow-down"></i> ' +
                                    Math.round(valResDia) + '%</small>');
                            }
                        }
                    });
                }
            });

            $.cargarCita();
            $.cargarDatos();

        });

        function validartxtnum(e) {
            tecla = e.which || e.keyCode;
            patron = /[0-9]+$/;
            te = String.fromCharCode(tecla);
            //    if(e.which==46 || e.keyCode==46) {
            //        tecla = 44;
            //    }
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 44);
        }

        function verNotifiPaci(paci) {
            localStorage.clear();
            localStorage.setItem('idPaciente', paci);
            PEDGITALURL = '{{ url('/AdminPacientes/Recaudos') }}';
            const nuevaPestana = window.open(PEDGITALURL, '_blank');
        }

        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
        }

        function validartxt(e) {
            tecla = e.which || e.keyCode;
            patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
            te = String.fromCharCode(tecla);
            return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
        }

        function miFuncionEspecifica(id) {
            // Haz lo que necesites con el parámetro "id"
            console.log("Evento con ID: " + id + " ha sido clicado.");
        }

        function applyStylesAfterViewMount(viewInfo) {
            // Obtener todos los eventos y aplicar estilos
            var events = fcAgendaViews2.getEvents();
            events.forEach(function(event) {
                applyStyles(event.el);
            });
        }

        function applyStyles(el) {
            el.style.overflow = 'hidden';
            el.style.whiteSpace = 'nowrap';
            el.style.textOverflow = 'ellipsis';

            el.style.fontSize = '9px';
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

        $(window).resize(function() {
            $('#fc-agenda-views').FullCalendar('option', 'contentHeight', 'auto');
        });



        function agregarCeros(numero, longitud) {
            return numero.toString().padStart(longitud, '0');
        }
    </script>


@endsection
