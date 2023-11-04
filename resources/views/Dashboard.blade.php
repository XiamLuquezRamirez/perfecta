@extends('Plantilla.Principal')
@section('title', 'Tablero Inicial')
@section('Contenido')
    <div class="content-header row">
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
   
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
                                        <i class="icon p-1 icon-bar-chart customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 class="heading-text text-bold-600">$95k</h3>
                                        <p class="sub-heading">Revenue</p>
                                    </div>
                                    <span class="inc-dec-percentage">
                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div
                                    class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                    <span class="card-icon danger d-flex justify-content-center mr-3">
                                        <i class="icon p-1 icon-pie-chart customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 class="heading-text text-bold-600">18.63%</h3>
                                        <p class="sub-heading">Growth Rate</p>
                                    </div>
                                    <span class="inc-dec-percentage">
                                        <small class="danger"><i class="fa fa-long-arrow-down"></i> 2.0%</small>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                    <span class="card-icon success d-flex justify-content-center mr-3">
                                        <i class="icon p-1 icon-graph customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 class="heading-text text-bold-600">$27k</h3>
                                        <p class="sub-heading">Sales</p>
                                    </div>
                                    <span class="inc-dec-percentage">
                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                <div class="d-flex align-items-start">
                                    <span class="card-icon warning d-flex justify-content-center mr-3">
                                        <i class="icon p-1 icon-basket-loaded customize-icon font-large-2 p-1"></i>
                                    </span>
                                    <div class="stats-amount mr-3">
                                        <h3 class="heading-text text-bold-600">13700</h3>
                                        <p class="sub-heading">Orders</p>
                                    </div>
                                    <span class="inc-dec-percentage">
                                        <small class="danger"><i class="fa fa-long-arrow-down"></i> 13.6%</small>
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
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div id='fc-agenda-views' style=" width: 100%;  height: 400px;"></div>
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

                    
                    <input type="hidden" name="idPaciente" id="idPaciente"
                    value="">

                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardarCita"
                                action="{{ url('/') }}/AdminCitas/GuardarCita">
                            
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
                                                                <option value="60">1 hora</option>
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
                                                            <div class="col-12" id="div-tratamiento"
                                                                style="display: none;">
                                                                <h4 class="form-section"><i class="fa fa-universal-access"></i>
                                                                    Información de Tratamientos
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane in" id="profileIcon"
                                                 

                                                    <input type="hidden" name="idPaciente" id="idPaciente"
                                                        value="">
                                                    <input type="hidden" name="accion" id="accion" value="agregar">
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
                                                                        <input name="nacimiento" id="nacimiento" class="form-control date-inputmask" type="text" placeholder="Ingresa Fecha de Nacimiento" data-inputmask="'alias': 'datetime','inputFormat': 'dd/mm/yyyy'">
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
                                <i class="feather icon-x"></i> Cancelar
                            </button>
                            <button type="button" disabled id="btnAtras" onclick="$.atrasCita()" class="btn btn-info">
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

    </div>

    <form action="{{ url('/AdminPacientes/AllProfesionales') }}" id="formCargarProfesionales" method="POST">
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenAdmin").removeClass("active");

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
                eventRender: function(info) {
                    // Cambiar el tamaño de fuente de los eventos aquí
                    info.el.style.fontSize = '9px'; // Ajustar el tamaño de fuente según tus necesidades
            
                    // Agregar el campo "prof" al contenido del evento
                    console.log(info.event.extendedProps.idCita);
                    var prof = info.event.extendedProps.prof;
                    var id = info.event.extendedProps.id;

                    if (prof) {
                        var profElement = document.createElement('div');
                        profElement.className = 'fc-event-prof';
                        profElement.textContent = 'Prof: '+prof;


                        info.el.appendChild(profElement);
                    }
                },
                eventClick: function(info) {
                    // Obtiene el valor del campo "id" del evento clicado
                    
                    var idCita = info.event.extendedProps.idCita;
                    
                    // Llama a una función y pasa el parámetro "id" específico
                    miFuncionEspecifica(idCita);
                },
                slotDuration: '00:15:00', // Duración de cada intervalo en la vista semanal (aquí es de una hora)
                slotLabelInterval: "00:15", // Mostrar etiquetas de hora cada una hora
                minTime: "07:00:00",
                maxTime: "19:00:00",
                locale: "es",
                events: disponibilidadJSON,


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

                        fcAgendaViews2.removeAllEvents();
                        fcAgendaViews2.addEventSource(disponibilidadJSON);

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

            // Crea un elemento de botón
            var miBoton = document.createElement('button');
            miBoton.textContent = ' Agregar cita';

            // Agrega un identificador o clases al botón si es necesario
            miBoton.id = 'agregarCita';
            miBoton.classList.add('fc-today-button', 'fc-button', 'fc-button-primary');
            miBoton.insertBefore(iconElement, miBoton.firstChild);

            // Agrega el botón al div 'fc-left'

            fcLeftDiv.appendChild(miBoton);

            miBoton.addEventListener('click', function() {
                // Aquí puedes agregar la lógica que deseas ejecutar cuando se hace clic en el botón
                $("#modalCitas").modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#fechaHoraSelCita').val("");
                $.cargarProfesionales();
                // Puedes reemplazar la alerta con la acción que desees realizar.
            });

            $.extend({

                cargarCita: function(){
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
                                return {
                                    "start": item.inicio,
                                    "end": item.final,
                                    "title": item.nombre + " " + item.apellido,
                                    "prof": item.nomprof,
                                    "idCita": item.id
                                };
                            });
                        }

                    });

                    console.log(disponibilidadJSON);

                    fcAgendaViews.removeAllEvents();
                    fcAgendaViews.addEventSource(disponibilidadJSON);
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
                clearImage: function(){
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
                    var btm_atras = document.getElementById("btnAtras");
                    var btnGuardar = document.getElementById("btnGuardar");
                    btm_atras.disabled = false;
                    btnGuardar.textContent = " Confirmar Cita";
                    var iconElement = document.createElement('i');
                    iconElement.className = 'fa fa-check';

                    btnGuardar.insertBefore(iconElement, btnGuardar.firstChild); 

                    btnGuardar.onclick = function() {
                        $.guardarCita(2);
                    };
                },

                atrasCita: function () {
                    document.getElementById("calendaCita").style = "display: block";
                    document.getElementById("calendaCitaPaci").style = "display: none";
                   
                 var btm_atras = document.getElementById("btnAtras");
                 btm_atras.disabled = true;
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
                selecPaciente: function(id){
                    $("#idPaciente").val(id);
                    document.getElementById("div-tratamiento").style = "display: block;";
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

                    if(opc==1){

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

                                var btnGuardar = document.getElementById("btnGuardar");
                                btnGuardar.disabled = true;
                                
                                var loader = document.getElementById('loader');
                                loader.style.display = 'none';
                            }

                            $.cargarCita();
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
            });

            $.cargarCita();

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
    </script>

    </script>
@endsection
