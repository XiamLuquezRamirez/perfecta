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
                                                <div id='fc-agenda-views' style=" width: 100%;  height: 600px;"></div>
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
        <div class="modal-dialog modal-lg" role="document">
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
                                                            for="account-username">Profesional</label>
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
                                                            Consulta</label>
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
                                                        <label for="account-username">Duración </label>
                                                        <select class="form-control" id="duracionCita"
                                                            name="duracionCita" aria-invalid="false">
                                                            <option value="15">15 minutos</option>
                                                            <option value="30">30 minutos</option>
                                                            <option value="60">1 hora</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                     </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="fa fa-calendar"></i> Fecha</h4>
                                    </div>
                                </div>
                            
                            </div>

                    </div>

                    <div class="form-actions right" style="text-align: right">
                        <button type="button" onclick="$.cancelar();" class="btn btn-warning mr-1">
                            <i class="feather icon-x"></i> Cancelar
                        </button>
                        <button type="button" id="btnGuardar" onclick="$.guardar()" class="btn btn-success">
                            <i class="fa fa-check-square-o"></i> Guardar
                        </button>
                    
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    </div>



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
                // Puedes reemplazar la alerta con la acción que desees realizar.
            });
            
           


        })
    </script>

    </script>
@endsection
