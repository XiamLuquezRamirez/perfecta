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
                                            <h4 id="tit-div-trata-act"
                                                class="pl-2 mb-0 title-info-time-heading text-bold-500">Tratamientos Activos
                                            </h4>
                                            <hr>
                                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card info-time-tracking">
                                                    <div class="card-content" id="div-trata-act">

                                                    </div>
                                                </div>
                                            </div>

                                            <h4 id="tit-div-trata-otr"
                                                class="pl-2 mb-0 title-info-time-heading text-bold-500">Otros Tratamientos
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
                                                        <h4 class="modal-title" id="tituloTratamiento">Crear Tratamiento
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
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5">Nombre:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="nombreSeccion"
                                                                                    name="nombreSeccion">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="userinput8">Descripción:</label>
                                                                                <textarea id="descripcionSeccion" rows="5" class="form-control border-primary" name="descripcionSeccion"
                                                                                    placeholder="Descripcion"></textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-actions right">
                                                                                <button type="button"
                                                                                    onclick="$.salirSeccion();"
                                                                                    class="btn btn-warning mr-1">
                                                                                    <i
                                                                                        class="feather icon-corner-up-left"></i>
                                                                                    Salir
                                                                                </button>
                                                                                <button type="button" id="btnGuardar"
                                                                                    onclick="$.guardarSeccion()"
                                                                                    class="btn btn-success">
                                                                                    <i class="fa fa-check-square-o"></i>
                                                                                    Guardar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
                                                                <input type="hidden" name="servSeccion" id="servSeccion"
                                                                    value="" />
                                                                <input type="hidden" name="origServicio"
                                                                    id="origServicio" value="" />
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
                                                                                    onclick="this.select();"
                                                                                    onchange="$.cambioFormato(this.id);"
                                                                                    class="form-control" id="valorVis"
                                                                                    name="valorVis">
                                                                                <input type="hidden" value=""
                                                                                    id="valor" name="valor">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-actions right">
                                                                                <button type="button"
                                                                                    onclick="$.salirServicio();"
                                                                                    class="btn btn-warning mr-1">
                                                                                    <i
                                                                                        class="feather icon-corner-up-left"></i>
                                                                                    Salir
                                                                                </button>
                                                                                <button type="button" id="btnGuardar"
                                                                                    onclick="$.guardarServicio()"
                                                                                    class="btn btn-success">
                                                                                    <i class="fa fa-check-square-o"></i>
                                                                                    Guardar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--  Modal nueva evolcion  --}}
                                        <div class="modal fade text-left" id="modalEvoluciones" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="tituloEvolucion">Agregar Evolución
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"
                                                                style="font-size: 25px;">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form class="form" method="post" id="formGuardarEvolucion"
                                                                action="{{ url('/') }}/AdminPacientes/GuardarEvolucion">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-9 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5">Seleccione el
                                                                                    profesional que realizó el servicio
                                                                                    seleccionado:</label>
                                                                                <select class="select2 form-control"
                                                                                    id="profesionalEvolucion"
                                                                                    name="profesionalEvolucion">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5"> % de
                                                                                    avance:</label>
                                                                                <select class="form-control"
                                                                                    onchange="$.cambiarAvance(this.value)"
                                                                                    id="pavance" name="pavance">
                                                                                    <option value="0">0%</option>
                                                                                    <option value="25">25%</option>
                                                                                    <option value="50">50%</option>
                                                                                    <option value="75">75%</option>
                                                                                    <option value="100">(Realizar) 100%
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="userinput5">Evolución
                                                                                    escrita:</label>
                                                                                <textarea cols="80" id="evolucion_escrita" name="evolucion_escrita" rows="10"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-12 mb-2 mt-2 file-repeater">
                                                                            <div id="items-archivo"
                                                                                data-repeater-list="repeater-list">
                                                                                <div data-repeater-item>
                                                                                    <div class="row mb-1">
                                                                                        <div class="col-9 col-xl-10">
                                                                                            <label
                                                                                                class="file center-block">
                                                                                                <input type="file"
                                                                                                    accept=".jpg, .jpeg, .png, .gif, .mp4, .avi, .mov, .pdf"
                                                                                                    name="archivo"
                                                                                                    id="archivo">
                                                                                                <span
                                                                                                    class="file-custom"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-2 col-xl-1">
                                                                                            <button type="button"
                                                                                                data-repeater-delete
                                                                                                title="Eliminar Archivo"
                                                                                                class="btn btn-icon btn-pure danger mr-1"><i
                                                                                                    class="fa fa-trash-o"></i></button>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="button" data-repeater-create
                                                                                class="btn btn-primary">
                                                                                <i class="icon-plus4"></i> Agregar archivo
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-actions right">
                                                                                <button type="button"
                                                                                    onclick="$.salirEvolucion();"
                                                                                    class="btn btn-warning mr-1">
                                                                                    <i
                                                                                        class="feather icon-corner-up-left"></i>
                                                                                    Salir
                                                                                </button>
                                                                                <button type="button"
                                                                                    id="btnGuardarEvolucion"
                                                                                    onclick="$.guardarEvolucion()"
                                                                                    class="btn btn-success">
                                                                                    <i class="fa fa-check-square-o"></i>
                                                                                    Guardar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

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
                                                            <div
                                                                class="statistics-chart-data d-flex justify-content-center ml-auto mr-auto pb-50 mb-0">
                                                                <div class="collection mr-1">
                                                                    <span
                                                                        class="list-group-item-icon d-inline font-weight-bold">
                                                                        <i
                                                                            class="icon text-primary bg-light-primary icon-wallet total-products-icon rounded-circle p-50"></i>
                                                                        Total:
                                                                    </span>
                                                                    <span id="infTotal"></span>
                                                                </div>
                                                                <div class="collection mr-1">
                                                                    <span
                                                                        class="list-group-item-icon d-inline font-weight-bold">
                                                                        <i
                                                                            class="icon text-primary bg-light-primary icon-check total-products-icon rounded-circle p-50"></i>
                                                                        Realizado:
                                                                    </span>
                                                                    <span id="infRealizado"></span>
                                                                </div>

                                                                <div class="collection mr-1">
                                                                    <span
                                                                        class="list-group-item-icon d-inline font-weight-bold">
                                                                        <i
                                                                            class="icon text-danger bg-light-danger icon-basket-loaded total-products-icon rounded-circle p-50"></i>
                                                                        Pagado:
                                                                    </span>
                                                                    <span id="infPagado"></span>
                                                                </div>
                                                                <div class="collection mr-1">
                                                                    <span
                                                                        class="list-group-item-icon d-inline font-weight-bold">
                                                                        <i
                                                                            class="icon text-primary bg-light-primary icon-graph total-products-icon rounded-circle p-50"></i>
                                                                        Saldo:
                                                                    </span>
                                                                    <span id="infSaldo"></span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <button type="button" onclick="$.addSeccion();"
                                                                    class="btn btn-danger mr-1"><i class="fa fa-plus"></i>
                                                                    Agregar Sección</button>
                                                                <button style="display: none;"
                                                                    onclick="$.addServicioTrata();" type="button"
                                                                    class="btn btn-primary "><i class="fa fa-plus"></i>
                                                                    Agregar Servicio</button>
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
                                        <a id="lisTodos" class="list-group-item tagEstados active" data-id="1"
                                            onclick="$.mostrarTratamientos(this);">Todos</a>
                                        <a id="lisActivos" class="list-group-item tagEstados" data-id="2"
                                            onclick="$.mostrarTratamientos(this);">Activos</a>
                                        <a id="lisOtros" class="list-group-item tagEstados" data-id="3"
                                            onclick="$.mostrarTratamientos(this );">Otros</a>
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

    <form action="{{ url('/Administracion/BuscarServicio') }}" id="formBuscaServicios" method="POST">
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
    <form action="{{ url('/AdminPacientes/busEditServ') }}" id="formEditarServicio" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/busEditSecc') }}" id="formEditarSeccion" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>

    <form action="{{ url('/AdminPacientes/EliminarServicio') }}" id="formEliminarServicio" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/EliminarSeccion') }}" id="formEliminarSeccion" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/EliminarTratamiento') }}" id="formEliminarTratamiento" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>
    <form action="{{ url('/AdminPacientes/busEditTrata') }}" id="formEditarTratamiento" method="POST">
        @csrf
        <!-- Tus campos del formulario aquí -->
    </form>


@endsection

@section('scripts')
    <script>
        (function(window, document, $) {
            'use strict';

            // Default
            $('.repeater-default').repeater();

            // Custom Show / Hide Configurations
            $('.file-repeater, .contact-repeater').repeater({
                show: function() {
                    $(this).slideDown();
                },
                hide: function(remove) {
                    var element = $(this);
                    Swal.fire({
                        title: "¿Está seguro?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, Eliminar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-primary",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            element.slideUp(remove);
                            Swal.fire({
                                type: "success",
                                title: "Eliminado!",
                                text: "El archivo a sido eliminado.",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                }
            });



        })(window, document, jQuery);

        ///////////////////CONFIGURACION EDITOR

        CKEDITOR.editorConfig = function(config) {
            config.toolbarGroups = [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                {
                    name: 'styles',
                    groups: ['styles']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker', 'editing']
                },
                {
                    name: 'forms',
                    groups: ['forms']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                },
                {
                    name: 'links',
                    groups: ['links']
                },
                {
                    name: 'insert',
                    groups: ['insert']
                },
                {
                    name: 'colors',
                    groups: ['colors']
                },
                {
                    name: 'tools',
                    groups: ['tools']
                },
                {
                    name: 'others',
                    groups: ['others']
                },
                {
                    name: 'about',
                    groups: ['about']
                }
            ];

            config.removeButtons =
                'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Replace,Find,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,SelectAll,Button,ImageButton,HiddenField,Strike,CopyFormatting,RemoveFormat,Indent,Blockquote,Outdent,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,BGColor,ShowBlocks,About,Underline,Italic';
        };

        $(document).ready(function() {
            $("#MenTratamientos").addClass("active");

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
                    $.buscInfGeneralPaciente(lastSelectedData.id);
                }
            }

            $.extend({
                addTratamiento: function() {

                    $("#modalTratamiento").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#nombre_tratamiento").val('');
                    $('#profesional').val('').trigger('change.select2');
                    $('#especialidad').val('').trigger('change.select2');


                    $("#tituloTratamiento").html("Agregar tratamiento.");
                    $("#accion").val("agregar");
                    $.cargarProfesionales();
                },
                cambiarAvance: function(val) {
                    var boton = document.getElementById('btnGuardarEvolucion');
                    if (boton) {
                        boton.innerHTML = '<i class="fa fa-check-square-o"></i> Guardar avance (' +
                            val + '%)';
                    }
                },
                editarTratamiento: function(id) {

                    $("#modalTratamiento").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#tituloTratamiento").html("Editar tratamiento.");
                    $("#accion").val("editar");

                    $.cargarProfesionales();

                    $("#idTratamiento").val(id);

                    var form = $("#formEditarTratamiento");
                    $("#idTrat").remove();
                    form.append("<input type='hidden' id='idTrat' name='idTrat'  value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#nombre_tratamiento").val(respuesta.tratraEdit.nombre);
                            $('#profesional').val(respuesta.tratraEdit.profesional).trigger(
                                'change.select2');
                            $('#especialidad').val(respuesta.tratraEdit.especialidad)
                                .trigger('change.select2');
                        }
                    });


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

                    let servSEccion = '';
                    let totalTrata = 0;
                    let pagado = 0;
                    let realizado = 0;

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#tit_tratamiento").html(respuesta.Tratamientos.nombre);
                            $("#nseccciones").html(respuesta.ContTratamientos);

                            $.each(respuesta.servTratamiento, function(i, item) {


                                totalTrata = totalTrata + parseInt(item.valor);
                                pagado = pagado + parseInt(item.pagado);
                                if (item.estado_serv == "Terminado") {
                                    realizado = realizado + parseInt(item.valor);
                                }

                                let porAvancTrat = item.avance;
                                var formatoMoneda = formatCurrency(item.valor,
                                    'es-CO', 'COP');

                                servSEccion = '<tr id="tr-serv' + item.id + '">' +
                                    '<td class="align-middle">' +
                                    '    <div title="Agregar Avance" id="outerCircle' +
                                    item.id +
                                    '" class="outerCircle"' +
                                    '        onclick="$.addEvolucion(' + item.id +
                                    ',' + item.seccion + ');"' +
                                    '        style="cursor: pointer;display: flex; justify-content: center; align-items: center; padding: 0; height: 50px; width: 50px; border-radius: 100%; background-image: conic-gradient(#94d3a2 0deg, #94d3a2 162deg, #D3D3D3 162deg)">' +
                                    '        <div style="display: flex; justify-content: center; align-items: center; padding: 0; height: 40px; width: 40px; border-radius: 100%; background-color:white">' +
                                    '            <span id="porcentajeServ' + item
                                    .id + '">95%</span>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '</td>' +
                                    '<td class="align-middle">' +
                                    '    <span>' + item.nombre + '</span>' +
                                    '</td>' +
                                    '<td class="align-middle">' +
                                    '    <span>' + formatoMoneda + '</span>' +
                                    '</td>' +
                                    '<td class="align-middle">';
                                if (item.estado_serv == 'Activo') {
                                    servSEccion +=
                                        '    <span class="badge badge-info">' + item
                                        .estado_serv + '</span>';
                                } else {
                                    servSEccion +=
                                        '    <span class="badge badge-success">' +
                                        item.estado_serv + '</span>';
                                }

                                servSEccion += '</td>' +
                                    '<td class="align-middle">' +
                                    '    <div class="dropdown">' +
                                    '        <span class="feather icon-more-vertical dropdown-toggle"' +
                                    '            id="dropdownMenuButton"' +
                                    '            data-toggle="dropdown"' +
                                    '            aria-haspopup="true"' +
                                    '            aria-expanded="false">' +
                                    '        </span>' +
                                    '        <div class="dropdown-menu dropdown-menu-right"' +
                                    '            aria-labelledby="dropdownMenuButton"' +
                                    '            x-placement="bottom-end"' +
                                    '            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 18px, 0px);"' +
                                    '            x-out-of-boundaries="">' +
                                    '        <a onclick="$.addEvolucion(' + item
                                    .id + ',' + item.seccion +
                                    ');" class="dropdown-item">' +
                                    '        <i class="feather icon-trending-up"></i>' +
                                    '         Registrar Evolución' +
                                    '        </a>' +
                                    '        <a onclick="$.editServSecc(' + item
                                    .id + ');" class="dropdown-item">' +
                                    '        <i class="feather icon-edit"></i>' +
                                    '         Editar' +
                                    '        </a>' +
                                    '        <a  id="btnDel' + item.id +
                                    '" data-id="' + item.id + '" data-seccion="' +
                                    item.seccion +
                                    '" onclick="$.delServSecc(this.id);"  class="dropdown-item">' +
                                    '        <i class="feather icon-trash-2"></i>' +
                                    '        Eliminar' +
                                    '        </a>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '</td>' +
                                    '</tr>';

                                $("#trServicioSeccion" + item.seccion).append(
                                    servSEccion);
                                updatePercentageServicios(porAvancTrat,
                                    item.id);
                            });

                            let saldo = totalTrata - pagado;

                            //informacion de presupuesto tratamiento
                            $("#infTotal").html(formatCurrency(totalTrata, 'es-CO', 'COP'));
                            $("#infRealizado").html(formatCurrency(realizado, 'es-CO',
                                'COP'));
                            $("#infPagado").html(formatCurrency(pagado, 'es-CO', 'COP'));
                            $("#infSaldo").html(formatCurrency(saldo, 'es-CO', 'COP'));


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
                    $("#profesionalEvolucion").html(select);
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

                                select += '<option value="' + item.id +
                                    '"><strong>' + item
                                    .nombre + '</strong> &nbsp;&nbsp;&nbsp;(' +
                                    formatCurrency(item.valor, 'es-CO', 'COP') +
                                    ')</option>';

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

                                $("#div-trata-act").html('');

                                $.each(respuesta.newTrata, function(i, item) {

                                    newTrata = '<div id="tratamiento' + item.id +
                                        '" class="row">' +
                                        '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                        '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                        '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                        '            ' + item.nombre + '</h4>' +
                                        '        <span class="pr-2 fonticon-wrap"' +
                                        '            style="cursor: pointer; ">' +
                                        '            <i onclick="$.editarTratamiento(' +
                                        item.id +
                                        ');" style="transition: all .2s ease-in-out;" title="Editar Tratamiento"' +
                                        '                class="fa fa-pencil font-medium-5 hvr-grow-shadow mr-1"></i>' +
                                        '            <i onclick="$.eliminarTratamiento(' +
                                        item.id +
                                        ');" title="Eliminar Tratamiento"' +
                                        '                class="fa fa-trash-o  font-medium-5 hvr-grow-shadow"></i>' +
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
                                        '            </p>' +
                                        '            </div>' +
                                        '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                        '                <h6 class="pt-1"><span' +
                                        '                        class="fa fa-list"></span> Servicios Activos:</h6>' +
                                        '                <p>0</p>' +
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
                    $("#descripcionSeccion").val('');
                    $("#accion").val('agregar');

                },
                addEvolucion: function(idServ, idSeccion) {

                    $("#modalEvoluciones").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $('#pavance').val("0").trigger('change.select2');
                    $("#items-archivo").html('');
                    var boton = document.getElementById('btnGuardarEvolucion');
                    if (boton) {
                        boton.innerHTML = '<i class="fa fa-check-square-o"></i> Guardar avance (0%)';
                    }

                    $("#idSeccion").val(idSeccion);
                    $("#idServicio").val(idServ);
                    $.cargarProfesionales();
                    $.iniciaEditor();
                },
                iniciaEditor: function() {
                    CKEDITOR.replace('evolucion_escrita', {
                        width: '100%',
                        height: 150
                    });
                },
                editarSeccion: function(id) {
                    $("#modalSesiones").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#nombreSeccion").val('');
                    $("#descripcionSeccion").val('');

                    $("#accion").val('editar');
                    $("#idSeccion").val(id);

                    var form = $("#formEditarSeccion");
                    $("#idSecc").remove();
                    form.append("<input type='hidden' id='idSecc' name='idSecc'  value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#nombreSeccion").val(respuesta.seccionesEdit.nombre);
                            $("#descripcionSeccion").val(respuesta.seccionesEdit
                                .descripcion);
                        }
                    });

                },
                salirSeccion: function() {
                    $('#modalSesiones').modal('toggle');
                },
                salirEvolucion: function() {
                    $('#modalEvoluciones').modal('toggle');
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
                                    consfirmButtonClass: "btn btn-primary",
                                    timer: 1500,
                                    buttonsStyling: false
                                });

                                if (accion == "agregar") {
                                    //$.dibujarSeccion(respuesta);
                                    $.verTratamiento($("#idTratamiento").val());
                                } else {
                                    $("#nomSeccion" + respuesta.seccion.id).html(respuesta
                                        .seccion.nombre);
                                }

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
                    let divSecciones = '<div id="seccion' + respuesta.seccion.id +
                        '" class="card collapse-header" role="tablist">' +
                        '<div id="headingCollapse5"' +
                        '    class="card-header d-flex justify-content-between align-items-center hvr-grow-shadow m-1"' +
                        '    style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;"' +
                        '    data-toggle="collapse" role="tab"' +
                        '    data-target="#collapse' + respuesta.seccion.id + '"' +
                        '    aria-expanded="false"' +
                        '   aria-controls="collapse' + respuesta.seccion.id + '">' +
                        '    <div class="collapse-title media">' +
                        '        <div class="media-body mt-25">' +
                        '            <h4 id="nomSeccion' + respuesta.seccion.id + '">' + respuesta
                        .seccion.nombre + '</h4>' +
                        '        </div>' +
                        '    </div>' +
                        '    <div' +
                        '        class="information d-sm-flex d-none align-items-center">' +
                        '        <div class="collection mr-1">' +
                        '            <span' +
                        '                class="bullet bullet-xs bullet-primary"></span>' +
                        '            <span id="span-total' + respuesta.seccion.id +
                        '" class="font-weight-bold">$ 0,00</span>' +
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
                        '               <a onclick="$.addServicioSeccion(' + respuesta.seccion.id +
                        ');" class="dropdown-item mail-reply">' +
                        '                    <i class="feather icon-plus"></i>' +
                        '                   Agregar Servicio' +
                        '                </a>' +
                        '                <div class="dropdown-divider">' +
                        '                </div>' +
                        '                <a onclick="$.editarSeccion(' + respuesta.seccion.id +
                        ');"  class="dropdown-item">' +
                        '                    <i class="feather icon-edit" ></i>' +
                        '                   Editar sección' +
                        '                </a>' +
                        '                <a onclick="$.eliminarSeccion(' + respuesta.seccion.id +
                        ');"  class="dropdown-item">' +
                        '                    <i class="feather icon-trash-2"></i>' +
                        '                    Eliminar Sección' +
                        '                </a>' +
                        '            </div>' +
                        '       </div>' +
                        '    </div>' +
                        '</div>' +
                        '<div id="collapse' + respuesta.seccion.id + '" role="tabpanel"' +
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
                addServicioTrata: function() {
                    $("#origServicio").val("trata");
                    $("#modalServicios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#valorVis").val("");
                    $("#valor").val("");
                    $("#accion").val('agregar');

                    $.cargarServicios();
                },
                addServicioSeccion: function(id) {
                    $("#origServicio").val("secc");
                    $("#servSeccion").val(id);
                    $("#idSeccion").val(id);
                    $("#accion").val('agregar');

                    $("#modalServicios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#valorVis").val("");
                    $("#valor").val("");

                    $.cargarServicios();

                },
                salirServicio: function() {
                    $('#modalServicios').modal('toggle');
                },
                guardarServicio: function() {
                    if ($("#servicioTrat").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar el servicio",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }

                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarServicio");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var idSeccion = $("#idSeccion").val();
                    var idTratamiento = $("#idTratamiento").val();
                    var idPaciente = $("#idPaciente").val();
                    var token = $("#token").val();
                    $("#accion").remove();
                    $("#idtoken").remove();
                    $("#idSecc").remove();
                    $("#idTrata").remove();
                    $("#idPac").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idSecc' name='idSecc'  value='" +
                        idSeccion +
                        "'>");
                    form.append("<input type='hidden' id='idTrata' name='idTrata'  value='" +
                        idTratamiento +
                        "'>");
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" +
                        idPaciente +
                        "'>");


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarServicio')[0]),
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

                                if ($("#origServicio").val() == "secc") {
                                    //$("#trServicioSeccion" + idSeccion).html('');
                                    ///$.dibujarServicioSecc(respuesta);
                                    $.verTratamiento($("#idTratamiento").val());
                                } else {
                                    $.dibujarServicioTrat(respuesta);
                                }

                                var totalServicios = formatCurrency(respuesta.totServ,
                                    'es-CO', 'COP');

                                $("#span-total" + idSeccion).html(totalServicios);



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
                guardarEvolucion: function() {

                    for (var instanceName in CKEDITOR.instances) {
                        CKEDITOR.instances[instanceName].updateElement();
                    }

                    if ($("#profesionalEvolucion").val().trim() === "") {
                        Swal.fire({
                            type: "warning",
                            title: "Oops...",
                            text: "Debes de seleccionar el profesional que realizo el servicio",
                            confirmButtonClass: "btn btn-primary",
                            timer: 1500,
                            buttonsStyling: false
                        });
                        return;
                    }


                    var loader = document.getElementById('loader');
                    loader.style.display = 'block';

                    var form = $("#formGuardarEvolucion");
                    var url = form.attr("action");
                    var accion = $("#accion").val();
                    var idSeccion = $("#idSeccion").val();
                    var idTratamiento = $("#idTratamiento").val();
                    var idPaciente = $("#idPaciente").val();
                    var idServicio = $("#idServicio").val();
                    var token = $("#token").val();
                    $("#accion").remove();
                    $("#idtoken").remove();
                    $("#idSecc").remove();
                    $("#idTrata").remove();
                    $("#idPac").remove();
                    $("#idSer").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='idSecc' name='idSecc'  value='" +
                        idSeccion +
                        "'>");
                    form.append("<input type='hidden' id='idTrata' name='idTrata'  value='" +
                        idTratamiento +
                        "'>");
                    form.append("<input type='hidden' id='idPac' name='idPac'  value='" +
                        idPaciente +
                        "'>");
                    form.append("<input type='hidden' id='idSer' name='idSer'  value='" +
                        idServicio +
                        "'>");


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData($('#formGuardarEvolucion')[0]),
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
                                $("#trServicioSeccion" + idSeccion).html('');
                                $.dibujarServicioSecc(respuesta);
                                var totalServicios = formatCurrency(respuesta.totServ,
                                    'es-CO', 'COP');
                                $("#span-total" + idSeccion).html(totalServicios);

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
                dibujarServicioSecc: function(respuesta) {

                    $.each(respuesta.servSeccion, function(i, item) {
                        let porAvancTrat = item.avance;
                        var formatoMoneda = formatCurrency(item.valor,
                            'es-CO', 'COP');

                        let servicio = '<tr id="tr-serv' + item.id + '">' +
                            '<td' +
                            '    class="align-middle">' +
                            '    <div title="Agregar Avance" id="outerCircle' + item.id +
                            '" class="outerCircle"' +
                            '        onclick="$.addEvolucion(' + item.id + ',' + item.seccion +
                            ');"' +
                            '        style="cursor: pointer; display: flex; justify-content: center; align-items: center; padding: 0; height: 50px; width: 50px; border-radius: 100%; background-image: conic-gradient(#94d3a2 0deg, #94d3a2 162deg, #D3D3D3 162deg)">' +
                            '        <div style="display: flex; justify-content: center; align-items: center; padding: 0; height: 40px; width: 40px; border-radius: 100%; background-color:white">' +
                            '            <span' +
                            '                id="porcentajeServ' + item.id + '">0%</span>' +
                            '        </div>' +
                            '    </div>' +
                            '</td>' +
                            '<td class="align-middle">' +
                            '    <span>' + item.nombre + '</span>' +
                            '</td>' +
                            '<td class="align-middle">' +
                            '    <span>' + formatoMoneda + '</span>' +
                            '</td>' +
                            '<td class="align-middle">';
                        if (item.estado_serv == 'Activo') {
                            servicio += '    <span class="badge badge-info">' + item
                                .estado_serv + '</span>';
                        } else {
                            servicio += '    <span class="badge badge-success">' + item
                                .estado_serv + '</span>';
                        }

                        servicio += '</td>' +
                            '<td  class="align-middle">' +
                            '    <div class="dropdown">' +
                            '        <span class="feather icon-more-vertical dropdown-toggle"' +
                            '            id="dropdownMenuButton"' +
                            '            data-toggle="dropdown"' +
                            '            aria-haspopup="true"' +
                            '            aria-expanded="false">' +
                            '        </span>' +
                            '        <div class="dropdown-menu dropdown-menu-right"' +
                            '            aria-labelledby="dropdownMenuButton"' +
                            '            x-placement="bottom-end"' +
                            '            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 18px, 0px);"' +
                            '            x-out-of-boundaries="">' +
                            '        <a onclick="$.addEvolucion(' + item.id + ',' + item
                            .seccion + ');" class="dropdown-item">' +
                            '        <i class="feather icon-trending-up"></i>' +
                            '         Registrar Evolución' +
                            '        </a>' +
                            '        <a onclick="$.editServSecc(' + item
                            .id + ');" class="dropdown-item">' +
                            '        <i class="feather icon-edit"></i>' +
                            '         Editar' +
                            '        </a>' +
                            '        <a  id="btnDel' + item.id + '" data-id="' + item.id +
                            '" data-seccion="' + item.seccion +
                            '" onclick="$.delServSecc(this.id);"  class="dropdown-item">' +
                            '        <i class="feather icon-trash-2"></i>' +
                            '        Eliminar' +
                            '        </a>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';

                        $("#trServicioSeccion" + item.seccion).append(servicio);

                        updatePercentageServicios(porAvancTrat, item.id);
                    });
                },
                dibujarServicioTrat: function(respuesta) {

                    $.each(respuesta.servSeccion, function(i, item) {
                        let porAvancTrat = item.avance;
                        var formatoMoneda = formatCurrency(item.valor, 'es-CO', 'COP');

                        let servicio = '';

                        updatePercentageServicios(porAvancTrat, item.id);
                    });
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
                editServSecc: function(id) {
                    $("#modalServicios").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $("#accion").val('editar');
                    $("#idServicio").val(id);

                    $.cargarServicios();

                    var form = $("#formEditarServicio");
                    $("#idServ").remove();
                    form.append("<input type='hidden' id='idServ' name='idServ'  value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            var valorServicio = formatCurrency(respuesta.serviciosEdit
                                .valor, 'es-CO', 'COP');

                            $('#servicioTrat').val(respuesta.serviciosEdit.servicio)
                                .trigger('change.select2');
                            $("#valor").val(respuesta.serviciosEdit.valor);
                            $("#valorVis").val(valorServicio);

                            var InputVal = document.getElementById("valorVis");
                            if (respuesta.serviciosEdit.descuento == "No") {
                                InputVal.disabled = true;
                            } else {
                                InputVal.disabled = false;
                            }

                            $("#idSeccion").val(respuesta.serviciosEdit.seccion);

                        }
                    });

                },
                delServSecc: function(id) {

                    let idServ = $("#" + id).data("id");
                    let idSecc = $("#" + id).data("seccion");

                    console.log(idServ + " " + idSecc);

                    Swal.fire({
                        title: "Esta seguro de Eliminar este registro?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederEliminarServ(idServ, idSecc);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "Tu registro está a salvo ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                },
                procederEliminarServ: function(idServ, idSecc) {

                    var form = $("#formEliminarServicio");

                    $("#idServ").remove();
                    $("#idSecc").remove();
                    form.append("<input type='hidden' id='idServ' name='idServ'  value='" + idServ +
                        "'>");
                    form.append("<input type='hidden' id='idSecc' name='idSecc'  value='" + idServ +
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
                            Swal.fire({
                                type: "success",
                                title: "Eliminado!",
                                text: "El Registro fue eliminado correctamente.",
                                confirmButtonClass: "btn btn-success"
                            });

                            $.verTratamiento($("#idTratamiento").val());



                        }
                    });

                },
                eliminarSeccion: function(idSecc) {

                    Swal.fire({
                        title: "Esta seguro de Eliminar este registro?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederEliminarSeccion(idSecc);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "Tu registro está a salvo ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                },
                procederEliminarSeccion: function(idSecc) {


                    var form = $("#formEliminarSeccion");

                    $("#idSecc").remove();
                    form.append("<input type='hidden' id='idSecc' name='idSecc'  value='" + idSecc +
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
                            if (respuesta.seccionStatus == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "Eliminado!",
                                    text: "El registro fue eliminado correctamente.",
                                    confirmButtonClass: "btn btn-success"
                                });
                                $.verTratamiento($("#idTratamiento").val());
                            } else {
                                Swal.fire({
                                    type: "warning",
                                    title: "Alerta!",
                                    text: "La seccion no puede ser eliminada, tiene Servicios cargados.",
                                    confirmButtonClass: "btn btn-warning"
                                });

                            }
                        }
                    });
                },
                eliminarTratamiento: function(idTrata) {

                    Swal.fire({
                        title: "Esta seguro de Eliminar este registro?",
                        text: "¡No podrás revertir esto!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonClass: "btn btn-warning",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            $.procederEliminarTratamiento(idTrata);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelado",
                                text: "Tu registro está a salvo ;)",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                    });
                },
                procederEliminarTratamiento: function(idTrata) {

                    var form = $("#formEliminarTratamiento");

                    $("#idTrata").remove();
                    form.append("<input type='hidden' id='idTrata' name='idTrata'  value='" + idTrata +
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
                            if (respuesta.tratamientoStatus == "ok") {
                                Swal.fire({
                                    type: "success",
                                    title: "Eliminado!",
                                    text: "El registro fue eliminado correctamente.",
                                    confirmButtonClass: "btn btn-success"
                                });
                                $("#tratamiento" + idTrata).remove();
                            } else {
                                Swal.fire({
                                    type: "warning",
                                    title: "Alerta!",
                                    text: "El tratamiento no puede ser eliminada, tiene secciones cargadas.",
                                    confirmButtonClass: "btn btn-warning"
                                });

                            }
                        }
                    });
                },
                mostrarTratamientos: function(elemento) {
                    var elementosLista = document.querySelectorAll('.tagEstados');

                    elementosLista.forEach(function(elementoLista) {
                        elementoLista.classList.remove('active');
                    });


                    elemento.classList.add('active');

                    var opc = elemento.getAttribute('data-id');

                    if (opc == 1) {
                        $("#div-trata-act").show();
                        $("#tit-div-trata-act").show();
                        $("#div-trata-otr").show();
                        $("#tit-div-trata-otr").show();
                    } else if (opc == 2) {
                        $("#div-trata-act").show();
                        $("#tit-div-trata-act").show();
                        $("#div-trata-otr").hide();
                        $("#tit-div-trata-otr").hide();
                    } else {
                        $("#div-trata-act").hide();
                        $("#tit-div-trata-act").hide();
                        $("#div-trata-otr").show();
                        $("#tit-div-trata-otr").show();
                    }

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
                            $("#div-trata-act").html('');

                            $.each(respuesta.tratamientosAct, function(i, item) {

                                const serviciosPorTratamiento = respuesta.servi
                                    .filter(servicio => servicio.tratamiento == item
                                        .id);
                                const serviciosTerminadosPorTratamiento =
                                    serviciosPorTratamiento.filter(servicio =>
                                        servicio.estado_serv === "Terminado");
                                const totalServiciosPorTratamiento =
                                    serviciosPorTratamiento.length;
                                const porcentajeTerminado = (
                                    serviciosTerminadosPorTratamiento.length /
                                    totalServiciosPorTratamiento) * 100;

                                let totalActivos = totalServiciosPorTratamiento -
                                    serviciosTerminadosPorTratamiento.length;


                                tratAct = '<div id="tratamiento' + item.id +
                                    '" class="row">' +
                                    '<div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">' +
                                    '    <div class="info-time-tracking-title d-flex justify-content-between align-items-center">' +
                                    '        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">' +
                                    '            ' + item.nombre + '</h4>' +
                                    '        <span class="pr-2 fonticon-wrap"' +
                                    '            style="cursor: pointer; ">' +
                                    '            <i onclick="$.editarTratamiento(' +
                                    item.id +
                                    ');" style="transition: all .2s ease-in-out;" title="Editar Tratamiento"' +
                                    '                class="fa fa-pencil font-medium-5 hvr-grow-shadow mr-1"></i>' +
                                    '            <i onclick="$.eliminarTratamiento(' +
                                    item.id + ');" title="Eliminar Tratamiento"' +
                                    '                class="fa fa-trash-o  font-medium-5 hvr-grow-shadow"></i>' +
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
                                    '                        class="fa fa-list"></span> Servicios activos:</h6>' +
                                    '                <p>' + totalActivos + '</p>' +
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
                                updatePercentageTratamientos(porcentajeTerminado,
                                    consTrata);
                                consTrata++;
                            });

                            $('#conTrata').val(consTrata);
                            ////datos otros tratamiento
                            let tratOtr = '';
                            let consTrataOtro = 1;

                            $.each(respuesta.tratamientosOtr, function(i, item) {

                                const serviciosPorTratamiento2 = respuesta.servi
                                    .filter(servicio => servicio.tratamiento == item
                                        .id);
                                const serviciosTerminadosPorTratamiento2 =
                                    serviciosPorTratamiento2.filter(servicio =>
                                        servicio.estado_serv === "Terminado");
                                const totalServiciosPorTratamiento2 =
                                    serviciosPorTratamiento2.length;
                                const porcentajeTerminado2 = (
                                    serviciosTerminadosPorTratamiento2.length /
                                    totalServiciosPorTratamiento2) * 100;

                                let totalActivos2 = totalServiciosPorTratamiento2 -
                                    serviciosTerminadosPorTratamiento2.length;

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
                                    '            </p>' +
                                    '            </div>' +
                                    '            <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">' +
                                    '                <h6 class="pt-1"><span' +
                                    '                        class="fa fa-list"></span> Servicios activos:</h6>' +
                                    '                <p>' + totalActivos2 + '</p>' +
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
                                updatePercentageTratamientos(porcentajeTerminado2,
                                    consTrataOtro);
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

            var editorEvolucion = CKEDITOR.instances.evolucion_escrita;
            //leer variable localStorage tratamientos
            var ultimaParteURLAnterior = document.referrer.split('/').filter(Boolean).pop();
            if(ultimaParteURLAnterior == "Administracion"  || ultimaParteURLAnterior == "Pacientes"){
                if (localStorage.getItem('idTratamiento')) {
                    $.buscInfGeneralPaciente(localStorage.getItem('idPaciente'));
                    $.verTratamiento(localStorage.getItem('idTratamiento'));
                }else if(localStorage.getItem('idPaciente')){
                    $.buscInfGeneralPaciente(localStorage.getItem('idPaciente'));
                }

            }
        });



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

        function updatePercentageServicios(porcentaje, consServ) {
            $('#porcentajeServ' + consServ).text(porcentaje + '%');
            $('#outerCircle' + consServ).css('background-image',
                `conic-gradient(#24BEC0 0deg, #24BEC0 ${3.6 * porcentaje}deg, #F0F0F0 ${3.6 * porcentaje}deg)`);
        }

       

        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
