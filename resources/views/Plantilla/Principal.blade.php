<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('Plantilla.Head')

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    @include('Plantilla.Cabecera')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('Plantilla.Menu')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            @yield('Contenido')
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('Plantilla.Footer')
    @yield('scripts')
</body>

</html>