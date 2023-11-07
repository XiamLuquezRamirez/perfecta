@extends('Plantilla.Principal')
@section('title', 'Gestionar Tratamientos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
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
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i></div>
                            <form action="#">
                                <div class="position-relative">
                                    <input type="search" id="search-contacts" class="form-control" placeholder="Buscar paciente por identificación, nombre, apellido...">
                                    <div class="form-control-position">
                                        <i class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                    </div>
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
    
                        <section class="row all-contacts">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-head">
                                        <div class="card-header">
                                            <h4 class="card-title">Tratamientos</h4>
                                            <div class="heading-elements mt-0">
                                                <button class="btn btn-primary btn-md" onclick="$.addTratamiento();"><i class="d-md-none d-block feather icon-plus white"></i>
                                                    <span class="d-md-block d-none"><li class="fa fa-plus"></li> Nuevo Tratamiento</span></button>
                                                <span class="dropdown">
                                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-warning dropdown-menu-right dropdown-toggle btn-md">
                                                        <i class="feather icon-download-cloud white"></i></button>
                                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu dropdown-menu-right mt-1">
                                                        <a href="#" class="dropdown-item"><i class="feather icon-upload"></i> Import</a>
                                                        <a href="#" class="dropdown-item"><i class="feather icon-download"></i> Export</a>
                                                        <a href="#" class="dropdown-item"><i class="feather icon-shuffle"></i> Find Duplicate</a>
                                                    </span>
                                                </span>
                                                <button class="btn btn-default btn-sm"><i class="feather icon-settings white"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" id="listTratamientos">
                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamientos Activos</h4>
                                            <hr>

                                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card info-time-tracking">
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                                                                <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                                                                    <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamiento de depilacion laser</h4>
                                                                    <span class="pr-2" style="cursor: pointer;">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 hvr-grow-shadow" style="cursor: pointer;" onclick="$.verTratamiento();">
                                                                <div class="card-body ">
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
                                                                    <span class="pr-2" style="cursor: pointer;">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 hvr-grow-shadow" style="cursor: pointer;" >
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
                                        </div>
                                        <div class="card-body" id="detTratamiento" style="display: none">
                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Gestionar Tratamiento</h4>
                                            <hr>
                                            <section id="user-profile-cards" class="row mt-2">
                                                <div class="col-xl-12 col-md-6 col-12">
                                                    <div class="card card border-teal border-lighten-2">
                                                        <div class="text-center">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Tratamiento de depilacion laser</h4>
                                                                </div>
                                                            <div class="card-body">
                                                                <button type="button" class="btn btn-danger mr-1"><i class="fa fa-plus"></i> Agregar Sección</button>
                                                                <button type="button" class="btn btn-primary mr-1"><i class="fa fa-plus"></i> Agregar Procedimiento</button>
                                                            </div>
                                                        </div>
                                                        <div class="list-group list-group-flush">
                                                     </div>
                                                    </div>
                                                </div>
                                                
                                            </section>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="sidebar-detached sidebar-left ps">
                    <div class="sidebar">
                        <div class="bug-list-sidebar-content">
                            <!-- Predefined Views -->
                            <div class="card">
                                <div class="card-head">
                                    <div class="media p-1">
                                        <div class="media-left pr-1"><span class="avatar avatar-online avatar-sm rounded-circle"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.png') }}" alt="avatar"><i></i></span></div>
                                        <div class="media-body media-middle">
                                            <h5 class="media-heading">Xiamir Luquez</h5>
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
                                            <a href="#">23 años</a>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="feather icon-phone float-right"></span>
                                            <a href="#">316 4915332</a>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="feather icon-at-sign float-right"></span>
                                            <a href="#">alexanderx105@hotmail.com</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <!--/ Groups-->
    
                                <!--More-->
                                <div class="card-body  justify-content-between align-items-center">
                                    <p class="lead">Citas del paciente</p>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="fa fa-calendar float-right"></span>
                                            <a href="#">Consulta General </a>
                                            <p class="sub-heading">23/11/2023 - 08:30 PM</p>
                                        </li>
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
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
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
            var $primary = "#00b5b8",
            $secondary = "#2c3648",
            $success = "#0f8e67",
            $info = "#179bad",
            $warning = "#ffb997",
            $danger = "#ff8f9e"



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

            $.extend({
                addTratamiento: function(){
                 
                },
                verTratamiento: function(){
                    $("#detTratamiento").show();
                    $("#listTratamientos").hide();
                }

            });

            


           
        })


       

     
    </script>

    </script>
@endsection
