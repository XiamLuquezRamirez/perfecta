<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">        
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li id="MenInicio" class="nav-item"><a class="nav-link" href="{{ url('/Administracion') }}" ><i class="feather icon-home"></i><span data-i18n="Dashboard">Inicio</span></a>
            </li>
            <li id="MenPaciente" class="nav-item"><a class="nav-link" href="{{ url('/AdminPacientes/Pacientes') }}"><i class="feather icon-users"></i><span data-i18n="Templates">Pacientes</span></a>
            </li>
            <li id="MenTratamientos" class="nav-item"><a class="nav-link" href="{{ url('/AdminPacientes/Tratamientos') }}"><i class="fa fa-universal-access"></i><span data-i18n="Templates">Tratamientos</span></a>
            </li>
            <li id="MenRecaudo" class="nav-item"><a class="nav-link" href="{{ url('/AdminPacientes/Recaudos') }}"><i class="feather icon-shopping-cart"></i><span data-i18n="Templates">Recaudaciones</span></a>
            </li>
            <li id="MenCaja" class="nav-item"><a class="nav-link" href="{{ url('/Administracion/Cajas') }}"><i class="feather icon-grid"></i><span data-i18n="Layouts">Cajas</span></a>
            </li>
            <li id="MenAdmin" class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-sliders"></i><span data-i18n="Apps">Administracción</span></a>
                <ul class="dropdown-menu">
                    <li id="MenAdminGasto"  data-menu=""><a class="dropdown-item" href="{{ url('/Administracion/Gastos') }}" data-i18n="Email Application" data-toggle="dropdown">Gestión de gastos</a>
                    </li>
                    <li  id="MenAdminServicios"  data-menu=""><a class="dropdown-item" href="{{ url('/Administracion/Servicios') }}" data-i18n="Chat Application" data-toggle="dropdown">Gestión de servicios</a>
                    </li>
                    <li id="MenAdminProesional"  data-menu=""><a class="dropdown-item" href="{{ url('/Administracion/Profesionales') }}" data-i18n="Todo Application" data-toggle="dropdown">Gestión de profesionales</a>
                    </li>
                    <li id="MenAdminNotificaciones"  data-menu=""><a class="dropdown-item" href="{{ url('/Administracion/Promociones') }}" data-i18n="Todo Application" data-toggle="dropdown">Gestión de promociones</a>
                    </li>
                    <li  style="display:none;" id="MenAdminInventario"  data-menu=""><a class="dropdown-item" href="app-kanban.html" data-i18n="Kanban Application" data-toggle="dropdown">Gestión de unventario</a>
                    </li>
                    <li style="display:none;" id="MenAdminUsuuario"  data-menu=""><a class="dropdown-item" href="app-contacts.html" data-i18n="Contacts" data-toggle="dropdown">Gestión de usuarios</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
