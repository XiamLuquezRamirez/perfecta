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
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i>
                            </div>
                            <form action="#">
                                <div class="position-relative">
                                    <input type="search" id="search-contacts" class="form-control"
                                        placeholder="Buscar paciente por identificación, nombre, apellido...">
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
                                                <button class="btn btn-primary btn-md" onclick="$.addTratamiento();"><i
                                                        class="d-md-none d-block feather icon-plus white"></i>
                                                    <span class="d-md-block d-none">
                                                        <li class="fa fa-plus"></li> Nuevo Tratamiento
                                                    </span></button>
                                                <span class="dropdown">
                                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="true"
                                                        class="btn btn-warning dropdown-menu-right dropdown-toggle btn-md">
                                                        <i class="feather icon-download-cloud white"></i></button>
                                                    <span aria-labelledby="btnSearchDrop1"
                                                        class="dropdown-menu dropdown-menu-right mt-1">
                                                        <a href="#" class="dropdown-item"><i
                                                                class="feather icon-upload"></i> Import</a>
                                                        <a href="#" class="dropdown-item"><i
                                                                class="feather icon-download"></i> Export</a>
                                                        <a href="#" class="dropdown-item"><i
                                                                class="feather icon-shuffle"></i> Find Duplicate</a>
                                                    </span>
                                                </span>
                                                <button class="btn btn-default btn-sm"><i
                                                        class="feather icon-settings white"></i></button>
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
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div
                                                                class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                                                                <div
                                                                    class="info-time-tracking-title d-flex justify-content-between align-items-center">
                                                                    <h4
                                                                        class="pl-2 mb-0 title-info-time-heading text-bold-500">
                                                                        Tratamiento de depilacion laser</h4>
                                                                    <span class="pr-2" style="cursor: pointer;">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 hvr-grow-shadow" style="cursor: pointer;"
                                                                onclick="$.verTratamiento();">
                                                                <div class="card-body ">
                                                                    <div
                                                                        class="row justify-content-center align-items-center">
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-user"></span> Profesional:
                                                                            </h6>
                                                                            <p>Mairen Pumarejo</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-th-large"></span>
                                                                                Especialidad:</h6>
                                                                            <p>Consulta General</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-calendar"></span> Ultima
                                                                                Cita:</h6>
                                                                            <p>23/11/2023 08:00 AM</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <div id="general_task_radial_bar_chart"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Otros Tratamientos
                                            </h4>
                                            <hr>

                                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card info-time-tracking">
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div
                                                                class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                                                                <div
                                                                    class="info-time-tracking-title d-flex justify-content-between align-items-center">
                                                                    <h4
                                                                        class="pl-2 mb-0 title-info-time-heading text-bold-500">
                                                                        Tratamiento de depilacion laser</h4>
                                                                    <span class="pr-2" style="cursor: pointer;">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 hvr-grow-shadow" style="cursor: pointer;">
                                                                <div class="card-body">
                                                                    <div
                                                                        class="row justify-content-center align-items-center">
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-user"></span> Profesional:
                                                                            </h6>
                                                                            <p>Mairen Pumarejo</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-th-large"></span>
                                                                                Especialidad:</h6>
                                                                            <p>Consulta General</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                                                            <h6 class="pt-1"><span
                                                                                    class="fa fa-calendar"></span> Ultima
                                                                                Cita:</h6>
                                                                            <p>15/11/2023 09:00 AM</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
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
                                        <form class="form" method="post" id="formGuardarTratamiento"
                                            action="{{ url('/') }}/AdminPacientes/GuardarTratamiento">
                                            <input type="hidden" name="idTratamiento" id="idTratamiento"
                                                value="" />
                                            <input type="hidden" id="accion" value="" />

                                            <div class="card-body" id="addTratamiento" style="display: none">
                                                <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Gestionar
                                                    Tratamiento</h4>
                                                <hr>
                                                <section id="user-profile-cards" class="row mt-2">
                                                    <div class="col-xl-12 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label>Nombre de tratamiento:</label>
                                                                <input type="text" class="form-control"
                                                                    id="nombre_tratamiento" name="nombre_tratamiento"
                                                                    placeholder="Nombre de tratamiento" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label>Profesional:</label>
                                                                <select class="select2 form-control" id="profesional"
                                                                    name="profesional">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-6 col-12">
                                                        <div class="form-actions right">
                                                            <button type="button" id="btn_cancelaTratamiento"
                                                                onclick="$.cancelarTrataminto();"
                                                                class="btn btn-warning mr-1">
                                                                <i class="feather icon-x"></i> Cancelar
                                                            </button>
                                                            <button type="button" id="btn_guadarTrataminto"
                                                                onclick="$.guardarTrataminto();" class="btn btn-primary">
                                                                <i class="fa fa-check-square-o"></i> Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </section>

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
                                                                    <button type="button" class="btn btn-danger mr-1"><i
                                                                            class="fa fa-plus"></i> Agregar
                                                                        Sección</button>
                                                                    <button type="button" class="btn btn-primary mr-1"><i
                                                                            class="fa fa-plus"></i> Agregar
                                                                        Procedimiento</button>
                                                                </div>
                                                                <div id="sesionesTratamiento" class="form-body pt-0">
                                                                    <div class="card-body">
                                                                        <div>

                                                                            <div  class="card collapse-icon accordion-icon-rotate">
                                                                                <div id="headingCollapse11"
                                                                                    class="card-header primary"
                                                                                    data-toggle="collapse"
                                                                                    href="#collapse11"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="collapse11">

                                                                                    <h4 style=""
                                                                                        class="form-section"
                                                                                        id="tsesion1"><i
                                                                                            class="fa fa-opencart mb-0"></i>
                                                                                        Sesion 1</h4>
                                                                                       
                                                                                </div>
                                                                                <div id="collapse11" role="tabpanel"
                                                                                    aria-labelledby="headingCollapse11"
                                                                                    class="collapse show">
                                                                                    <div class="card-content">
                                                                                        <div class="card-body">
                                                                                            <div
                                                                                                class="repeater-controls d-flex">
                                                                                                <div class="input-fields border border-light rounded p-1 d-flex"
                                                                                                    style="width: 100%">
                                                                                                    <div class="row invoice-item-controls d-flex"
                                                                                                        style="width: 100%">
                                                                                                        <div
                                                                                                            class="col-12 col-md-4 form-group item-name">
                                                                                                            <select
                                                                                                                class="form-control"
                                                                                                                id="selrct-cumpl">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-12 col-md-3 form-group item-cost">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                id="valorServ"
                                                                                                                class="form-control"
                                                                                                                value="24">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-12 col-md-2 form-group item-price">
                                                                                                            <select
                                                                                                                class="form-control"
                                                                                                                id="selrct-cumpl">
                                                                                                                <option
                                                                                                                    value="0">
                                                                                                                    0%
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="25">
                                                                                                                    25%
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="50">
                                                                                                                    50%
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="75">
                                                                                                                    75%
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="100">
                                                                                                                    100%
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>


                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="delete-and-discount-config h-100 ml-1 d-flex flex-column justify-content-between">
                                                                                                        <span
                                                                                                            class="cursor-pointer d-flex justify-content-center align-items-center">
                                                                                                            <i class="fa fa-times-circle-o font-size-increase"
                                                                                                                data-repeater-delete=""></i>
                                                                                                        </span>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="headingCollapse12"
                                                                                    class="card-header primary pt-0"
                                                                                    data-toggle="collapse"
                                                                                    href="#collapse12"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapse12">
                                                                                    <a class="card-title lead collapsed"
                                                                                        href="#">Collapsible Group
                                                                                        Item #2</a>
                                                                                </div>
                                                                                <div id="collapse12" role="tabpanel"
                                                                                    aria-labelledby="headingCollapse12"
                                                                                    class="collapse"
                                                                                    aria-expanded="false">
                                                                                    <div class="card-content">
                                                                                        <div class="card-body">
                                                                                            Sugar plum bear claw oat cake
                                                                                            chocolate jelly tiramisu dessert
                                                                                            pie. Tiramisu macaroon muffin
                                                                                            jelly marshmallow cake. Pastry
                                                                                            oat cake chupa chups. Caramels
                                                                                            marshmallow carrot cake
                                                                                            topping donut sesame snaps
                                                                                            toffee tootsie roll. Lollipop
                                                                                            sweet jelly beans oat cake
                                                                                            biscuit
                                                                                            pastry chocolate cake. Cupcake
                                                                                            chocolate biscuit lemon drops
                                                                                            cotton candy marshmallow oat
                                                                                            cake donut. Croissant chocolate
                                                                                            cake oat cake brownie topping
                                                                                            carrot cake jelly beans.
                                                                                            Dessert gingerbread marshmallow
                                                                                            pudding donut lemon drops cake.
                                                                                            Cake topping gummi bears
                                                                                            cake.
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>





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
                <div class="sidebar-detached sidebar-left ps">
                    <div class="sidebar">
                        <div class="bug-list-sidebar-content">
                            <!-- Predefined Views -->
                            <div class="card">
                                <div class="card-head">
                                    <div class="media p-1">
                                        <div class="media-left pr-1"><span
                                                class="avatar avatar-online avatar-sm rounded-circle"><img
                                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-1.png') }}"
                                                    alt="avatar"><i></i></span></div>
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
                                formatter: function(val) {
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
                responsive: [{
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
                }],
                fill: {
                    colors: [$primary]
                },
                series: [67],
                stroke: {
                    lineCap: 'flat'
                },
                labels: ['Percent'],

            }
            var general_task_radial_bar_chart_options2 = {
                chart: {
                    height: 100,
                    width: 100,
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
                                formatter: function(val) {
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
                responsive: [{
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
                }],
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
            var general_task_radial_bar_chart3 = new ApexCharts(
                document.querySelector("#general_task_radial_bar_chart3"),
                general_task_radial_bar_chart_options2
            );

            general_task_radial_bar_chart.render();
            general_task_radial_bar_chart2.render();

            $.extend({
                addTratamiento: function() {
                    $("#addTratamiento").show();
                    $("#detTratamiento").hide();
                    $("#listTratamientos").hide();
                    $("#accion").val("agregar");
                    $.cargarProfesionales();
                },
                verTratamiento: function() {
                    $("#detTratamiento").show();
                    $("#listTratamientos").hide();
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

                                $("#idTratamiento").val(respuesta.tratamiento.id);
                                $("#tit_tratamiento").html(respuesta.tratamiento.nombre);

                                $("#addTratamiento").hide();
                                $("#detTratamiento").show();

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
    </script>

    </script>
@endsection
