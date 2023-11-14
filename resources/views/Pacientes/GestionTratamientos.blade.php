@extends('Plantilla.Principal')
@section('title', 'Gestionar Tratamientos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="conSeccion" name="conSeccion" value="1" />
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
                                        </form>
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
                                                                action="{{ url('/') }}/Administracion/GuardarSeccion">
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
                                                                      <div class="card collapse-header" role="tablist">
                                                <div id="headingCollapse5" class="card-header d-flex justify-content-between align-items-center hvr-grow-shadow m-1" 
                                                style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;" data-toggle="collapse" role="tab" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                                    <div class="collapse-title media">
                                                      
                                                        <div class="media-body mt-25">
                                                       <h4>Nombre del tratamiento</h4>
                                                        </div>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">
                                                        <div class="collection mr-1">
                                                           <span class="bullet bullet-xs bullet-primary"></span>
                                                               <span class="font-weight-bold">$ 45.000,00</span>
                                                            </div>
                                                   
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class='feather icon-more-vertical mr-0'></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="fisrt-open-submenu">
                                                                <a href="#" class="dropdown-item mail-reply">
                                                                    <i class='feather icon-plus'></i>
                                                                    Agregar Servicio
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <i class='feather icon-edit'></i>
                                                                    Editar sección
                                                                </a>
                                                                <a href="#" class="dropdown-item">
                                                                    <i class='feather icon-trash-2'></i>
                                                                    Eliminar Sección
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-body py-1">
                                                            <div class="email-user-list list-group ps ps--active-y">
                                                                <ul class="users-list-wrapper media-list">
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall1">
                                                                                    <label class="custom-control-label" for="checkboxsmall1"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite warning">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-20.png" alt="avtar img holder">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate">Open source project public release 👍</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">4:14 AM</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text truncate mb-0">
                                                                                    Hey John, bah kivu decrete epanorthotic unnotched
                                                                                    Argyroneta nonius veratrine preimaginary
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall2">
                                                                                    <label class="custom-control-label" for="checkboxsmall2"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite"><i class="feather icon-star"></i></span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-17.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate">Ecommerce website Paypal integration 😃</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">2:15 AM</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    We will start the new application development soon once
                                                                                    this will be completed.
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-danger bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall3">
                                                                                    <label class="custom-control-label" for="checkboxsmall3"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate">How To Set Intentions That Energize You</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">2:15 AM</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    I will provide you more details after this Saturday. Hope
                                                                                    that will be fine for you..
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right d-flex align-items-center">
                                                                                        <i class="feather icon-paperclip mr-50"></i>
                                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall4">
                                                                                    <label class="custom-control-label" for="checkboxsmall4"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-5.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate">Harness The Power Of Words In Your Life</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">Yesterday</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text text-truncate mb-0">
                                                                                    When the equation, first to ability the forwards, the a but travelling, outlines sentinels
                                                                                    bad expand to goodness....
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right d-flex align-items-center">
                                                                                        <i class="feather icon-paperclip mr-50"></i>
                                                                                        <span class="bullet bullet-warning bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall5">
                                                                                    <label class="custom-control-label" for="checkboxsmall5"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">Helen Keller A Teller And A Seller</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">15 July</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Thanks for your feedback ! Here's a new layout for a new Modern Admin theme.
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right d-flex align-items-center">
                                                                                        <i class="feather icon-paperclip mr-50"></i>
                                                                                        <span class="bullet bullet-warning bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall6">
                                                                                    <label class="custom-control-label" for="checkboxsmall6"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite warning">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">
                                                                                        Use Your Reset Button To Change Your Vibration 🎉
                                                                                    </span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">12-07-2019</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Hey John, bah kivu decrete epanorthotic unnotched
                                                                                    Argyroneta nonius veratrine preimaginary.</p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-info bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall7">
                                                                                    <label class="custom-control-label" for="checkboxsmall7"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite warning">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">Harness The Power Of Words In Your Life</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">03-29-2019</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Hope your like it, or feel free to comment, feedback or rebound !
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall8">
                                                                                    <label class="custom-control-label" for="checkboxsmall8"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">Hypnosis 12 Steps To Acquire Mind Power</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">19 Jun</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Monstrous with geared from far and these, morals, phase rome; Class. Called get amidst of geared from
                                                                                    next...
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-danger bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall9">
                                                                                    <label class="custom-control-label" for="checkboxsmall9"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">How To Stop Living Your Life On Autopilot</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">2 Jun</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Thanks for your feedback ! Here's a new layout for a new
                                                                                    Modern Admin theme.
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-info bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall10">
                                                                                    <label class="custom-control-label" for="checkboxsmall10"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">
                                                                                        Invest a few hours contributing to the software
                                                                                        you use and love. 🍕
                                                                                    </span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">29 May</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Hope your like it, or feel free to comment, feedback or rebound !
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-info bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall11">
                                                                                    <label class="custom-control-label" for="checkboxsmall11"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-20.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0">Harness The Power Of Words In Your Life</span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">17 May</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Hope your like it, or feel free to comment, feedback or rebound !.
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-warning bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="media mail-read">
                                                                        <div class="user-action">
                                                                            <div class="checkbox-con ">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="checkboxsmall12">
                                                                                    <label class="custom-control-label" for="checkboxsmall12"></label>
                                                                                </div>
                                                                            </div>
                                                                            <span class="favorite">
                                                                                <i class="feather icon-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="pr-50">
                                                                            <div class="avatar">
                                                                                <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-17.png" alt="Generic placeholder image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="user-details">
                                                                                <div class="mail-items">
                                                                                    <span class="list-group-item-text text-truncate mb-0"> Know Yourself Your Inner Power </span>
                                                                                </div>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="mail-date">21 Mar</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mail-message">
                                                                                <p class="list-group-item-text mb-0 truncate">
                                                                                    Hope your like it, or feel free to comment, feedback or rebound !
                                                                                </p>
                                                                                <div class="mail-meta-item">
                                                                                    <span class="float-right">
                                                                                        <span class="bullet bullet-warning bullet-sm"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <!-- email user list end -->
                            
                                                                <!-- no result when nothing to show on list -->
                                                                <div class="no-results">
                                                                    <i class="feather icon-info font-large-2"></i>
                                                                    <h5>No Items Found</h5>
                                                                </div>
                                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 605px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 391px;"></div></div></div>
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
    <form action="{{ url('/Administracion/GuardarSeccion') }}" id="formGuardarSeccion" method="POST">
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
                    $("#idtoken").remove();
                    $("#accion").remove();
                    form.append("<input type='hidden' id='accion' name='accion'  value='" + accion +
                        "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
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
                    let divSecciones = '<div class="card box-shadow-0 border-primary bg-transparent">'
                        +'<div class="card-header bg-transparent">'
                        +'    <h4 class="card-title"><i class="feather icon-heart"></i> '+respuesta.seccion.nombre+'</h4>'
                        +'    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>'
                        +'    <div class="heading-elements">'
                        +'        <ul class="list-inline mb-0">'
                        +'            <li><div class="collection mr-1">'
                            +'    <span class="bullet bullet-xs bullet-primary"></span>'
                            +'   <span class="font-weight-bold">$ 45.000,00</span>'
                            +'</div></li>'
                        +'            <li><div class="dropdown">'
                        +'    <div class="dropdown-toggle cursor-pointer" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
                        +'        <i class="feather icon-more-vertical">'
                        +'         </i>'
                        +'        </div>'
                        +'        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-end" style="position: absolute; transform: translate3d(-127px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">'
                        +'             <a class="dropdown-item" href="#">'
                        +'                <i class="feather icon-plus mr-50">'
                        +'                    </i>Argregar Servicio'
                        +'                </a>'
                        +'             <a class="dropdown-item" href="#">'
                        +'                <i class="feather icon-edit mr-50">'
                        +'                    </i>Editar sección'
                        +'                </a>'
                        +'                <a class="dropdown-item kanban-delete" id="kanban-delete" href="#">'
                        +'                    <i class="feather icon-trash-2 mr-50">'
                        +'                    </i>Eliminar sección'
                        +'                </a>'
                        +'            </div>'
                        +'        </div>'
                        +'    </li>'
                        +'        </ul>'
                        +'    </div>'
                        +'</div>'
                        +'<div  class="card-content collapse show">'
                        +'    <div class="card-body" id="div-servSeccion">'
                        +'    </div>'
                        +'</div>'
                        +'</div>';

                    $("#nseccciones").append(divSecciones);

                },
                addServicio: function(id) {
                    let servicios = '';

                        $("#div-servSeccion"+id).append(servicios);
                }

            });





        })
    </script>

    </script>
@endsection
