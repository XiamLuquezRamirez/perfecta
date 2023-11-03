@extends('Plantilla.Principal')
@section('title', 'Tablero Inicial')
@section('Contenido')
    <div class="content-header row">
    </div>
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

        <div class="modal fade text-left" id="modalCitas" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
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

                        <form class="form" method="post" id="formGuardar"
                            action="{{ url('/') }}/AdminCitas/GuardarCita">
                         

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="fa fa-list-alt"></i> Información</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label
                                                            for="account-username">Profesional:</label>
                                                        <select
                                                            onchange="$.cargarDisponibilidad(this.value)"
                                                            class="select2 form-control"
                                                            id="profesional" name="profesional">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Motivo de la
                                                            Consulta:</label>
                                                        <select class="select2 form-control"
                                                            id="motivo" name="motivo">
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
                                                        <input  type="hidden" class="form-control"
                                                            id="fechaHoraInicio" name="fechaHoraInicio"
                                                            placeholder="Fecha cita">
                                                        <input  type="hidden" class="form-control"
                                                            id="fechaHoraFinal" name="fechaHoraFinal"
                                                            placeholder="Fecha cita">
                                                        <input disabled type="text" class="form-control"
                                                            id="fechaHoraSelCita" name="fechaHoraSelCita"
                                                            placeholder="Fecha cita">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" style="inline-flex: flex; align-items: center;">
                                                    <div class="controls align-content-center">
                                                        <label for="account-username">&nbsp;</label>
                                                        <fieldset>
                                                            <label for="input-16" style="cursor: pointer;"> <input type="checkbox" id="notifCliente" checked> <li class="fa fa-envelope"></li> Notificar a paciente por correo</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                     </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="fa fa-calendar"></i> Fecha</h4>
                                        <div class="card-body">
                                            <div id='fc-agenda-views2'
                                                style=" width: 100%;  height: 600px;"></div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>

                    </div>

                    <div class="form-actions right" style="text-align: right">
                        <button type="button" onclick="$.cancelarProCita();" class="btn btn-warning mr-1">
                            <i class="feather icon-x"></i> Cancelar
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

            var disponibilidadProfesional = [];   

            $('#notifCliente').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
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
                         fechaHoraInicio =  `${año}-${mes}-${dia}T${hora}:${minutos}:${segundos}`;
                        

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
                         
                        
                        
                         fechaHoraFinal =  `${año1}-${mes1}-${dia1}T${hora1}:${minutos1}:${segundos1}`;

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
            console.log(miBoton);
            fcLeftDiv.appendChild(miBoton);

            miBoton.addEventListener('click', function() {
                // Aquí puedes agregar la lógica que deseas ejecutar cuando se hace clic en el botón
                $("#modalCitas").modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $.cargarProfesionales();
                // Puedes reemplazar la alerta con la acción que desees realizar.
            });
            
            $.extend({
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
                cancelarProCita: function() {
                    fcAgendaViews2.removeAllEvents();
                    fcAgendaViews2.addEventSource(disponibilidadJSON);
                },
                continuar: function() {
                    calendarE32.style.display = 'none';
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
                            disponibilidadJSON = respuesta.disponibilidad.map(function(item) {
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
            });


        })
    </script>

    </script>
@endsection
