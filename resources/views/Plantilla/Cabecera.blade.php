<nav
    class="header-navbar navbar-expand-sm navbar navbar-with-menu navbar-light navbar-shadow border-grey border-lighten-2 navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="feather icon-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand"
                        href="{{ url('/Administracion') }}"><img class="brand-logo"
                            width="150" alt="stack admin logo"
                            src="{{ asset('app-assets/images/logo/stack-logo-light.png') }}">

                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="feather icon-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon feather icon-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                            href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span
                                class="badge badge-pill badge-danger badge-up">1</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificationes</span><span
                                        class="notification-tag badge badge-danger float-right m-0">5 Nuevas</span></h6>
                            </li>
                            <li class="scrollable-container media-list">
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i
                                                class="feather icon-user-check icon-bg-circle bg-cyan"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Cita atendida: Xiamir Luquez</h6>
                                            <p class="notification-text font-small-3 text-muted">Revisar Recaudo</p><small>
                                                <time class="media-meta text-muted"
                                                    datetime="2015-06-11T18:29:20+08:00">Hace 20 seg.</time></small>
                                        </div>
                                    </div>
                                </a>
                               
                            
                                
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                    href="javascript:void(0)">Revisar Todas</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online"><img
                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-1.png') }}"
                                    alt="avatar"><i></i></div><span class="user-name">{{ Auth::user()->nombre_usuario }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                                href="user-profile.html"><i class="feather icon-user"></i> Editar Perfil
                            </a>
                           
                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                href="{{ url('/Logout') }}"><i class="feather icon-power"></i> Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
