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
                            id="cantNotificaPaciente"  class="badge badge-pill badge-danger badge-up">0</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificationes</span>
                                    <span id="cantNotificaPaciente2" class="notification-tag badge badge-danger float-right m-0">0 Nuevas</span></h6>
                            </li>
                            <li class="scrollable-container media-list" id="listNotof">
                             </li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online"><img
                                    src="{{ asset('app-assets/images/FotosUsuarios/'.Auth::user()->foto) }}"
                                    alt="avatar"><i></i></div><span class="user-name">{{ Auth::user()->nombre_usuario }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                                href="{{url('/Administracion/perfil')}}"><i class="feather icon-user"></i> Editar Perfil
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


