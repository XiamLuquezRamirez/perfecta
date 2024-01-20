@extends('Plantilla.Principal')
@section('title', 'Gestionar Promociones')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Promociones</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/Administracion') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Gestionar Promociones
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <div class="content-body" id="cont-lista">
            <div class="row mb-1 mt-1 mt-md-0">
                <div class="col-6">
                    <a onclick="$.addPromocion()" class="btn btn-primary"><i class="feather icon-plus"></i> Crear
                        promoción</a>
                </div>
                <div class="col-6">
                    <div class="bug-list-search">
                        <div class="bug-list-search-content">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i>
                            </div>
                            <div class="position-relative">
                                <input type="search" id="searchInput" class="form-control" placeholder="Busqueda...">
                                <div class="form-control-position">
                                    <i class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- datatable started -->
                    <div id="app-invoice-wrapper" class="">
                        <table id="app-invoice-table" class="table" style="width: 100%;">
                            <thead class="border-bottom border-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="trRegistros">
                            </tbody>
                        </table>

                        <div id="pagination-links" class="text-center ml-1 mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  Modal nueva promocion  --}}
        <div class="modal fade text-left" id="modalPromocion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloServicio"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <form class="form" method="post" id="formGuardar"
                                action="{{ url('/') }}/Administracion/GuardarServicio">
                                <input type="hidden" name="idServicio" id="idServicio" value="" />
                                <input type="hidden" name="accion" id="accion" value="">
                                <div class="form-body">
                                    <h4 class="form-section" id="titEnvioCorreo"><i class="fa fa-list-alt"></i> Información
                                        basica del promoción</h4>
                                </div>

                                <div class="row">
                                    <div class="col-12" id="infPromocion">
                                        <div class="form-group">
                                            <label for="userinput8">Titutlo:</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo"
                                                placeholder="" value="">
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="account-company">Contenido:</label>
                                                <textarea cols="80" id="contenidoPromocion" name="contenidoPromocion" rows="10"></textarea>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="account-company">Cargar archivo:</label>
                                                <input type="file" class="form-control" id="archivoProm"
                                                    name="archivoProm" />
                                            </div>
                                        </div>
                                    </div>

                                    <div id="infPacientes" style="display: none;" class="col-12">
                                        <div id="cargaPacientes">
                                            <div>
                                                <div class="bug-list-search">
                                                    <div class="bug-list-search-content">
                                                        <div class="sidebar-toggle d-block d-lg-none"><i
                                                                class="feather icon-menu font-large-1"></i>
                                                        </div>
                                                        <div class="position-relative">
                                                            <input type="search" id="searchInput" class="form-control"
                                                                placeholder="Busqueda...">
                                                            <div class="form-control-position">
                                                                <i
                                                                    class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="daily-activity" class="table-responsive height-300">
                                                <table id="tabPaciente" class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="icheck-input-all"
                                                                    class="icheck-activity">
                                                            </th>
                                                            <th>Nombre</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="trPacientes">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-actions right">
                                            <button type="button" id="btnSalir" onclick="$.salir();"
                                                class="btn btn-warning mr-1">
                                                <i class="fa fa-reply"></i> Salir
                                            </button>
                                            <button type="button" style="display: none;" id="btnAtras" onclick="$.antras();"
                                                class="btn btn-warning mr-1">
                                                <i class="fa fa-reply"></i> Atras
                                            </button>
                                            <button type="button" id="btnContinuar" onclick="$.cargarClientes()"
                                                class="btn btn-success">
                                                <i class="fa fa-list"></i> Continuar
                                            </button>
                                            <button type="button" id="btnEnviar" style="display: none;"
                                                onclick="$.enviarPromocion()" class="btn btn-primary">
                                                <i class="fa fa-location-arrow"></i> Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <div id="loader" class="loader-spinner" style="display: none;">
                <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
                <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>

            </div>

        </div>

        <form action="{{ url('/Administracion/CargarPromociones') }}" id="formCargarPromociones" method="POST">
            @csrf
            <!-- Tus campos del formulario aquí -->
        </form>

        <form action="{{ url('/Administracion/CargarPacientes') }}" id="formargarPacientes" method="POST">
            @csrf
            <!-- Tus c
                            ampos del formulario aquí -->
        </form>

        <form action="{{ url('/Administracion/BuscarServicio') }}" id="formBuscarServicio" method="POST">
            @csrf
            <!-- Tus campos del formulario aquí -->
        </form>

        <form action="{{ url('/Administracion/BuscarUsuario') }}" id="formValidarUsuario" method="POST">
            @csrf
            <!-- Tus campos del formulario aquí -->
        </form>

        <form action="{{ url('/Administracion/EliminarServicio') }}" id="formEliminar" method="POST">
            @csrf
            <!-- Tus campos del formulario aquí -->
        </form>
        <form action="{{ url('/AdminPacientes/updateServiciosTerminados') }}" id="formServTerminados" method="POST">
            @csrf
            <!-- Tus campos del formulario aquí -->
        </form>

    @endsection

    @section('scripts')
        <script>
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
                $("#MenAdmin").addClass("active");
                $("#MenAdminNotificaciones").addClass("active");
                localStorage.clear();
                $.extend({
                    cargar: function(page, searchTerm = '') {
                        var form = $("#formCargarPromociones");
                        var url = form.attr("action");
                        $('#page').remove();
                        $('#searchTerm').remove();
                        form.append("<input type='hidden' id='page' name='page'  value='" + page + "'>");
                        form.append("<input type='hidden' id='searchTerm' name='search'  value='" +
                            searchTerm +
                            "'>");
                        var datos = form.serialize();
                        $('#tdTable').empty();

                        let x = 1;
                        let tdTable = '';
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            async: false,
                            dataType: "json",
                            success: function(response) {
                                $('#trRegistros').html(response
                                    .servicios
                                ); // Rellenamos la tabla con las filas generadas
                                $('#pagination-links').html(response
                                    .links); // Colocamos los enlaces de paginación
                            }
                        });
                    },



                    addPromocion: function() {

                        $("#modalPromocion").modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $("#tituloServicio").html("Crear Servicio");
                        $("#accion").val("agregar");
                        $("#btnGuardar").show();
                        $("#btnNuevo").hide();
                        $.limpiar();


                    },
                    antras: function() {
                        //div
                        $("#infPacientes").hide();
                        $("#infPromocion").show();
                        //botones
                        $("#btnEnviar").hide();
                        $("#btnContinuar").show();
                        $("#btnSalir").hide();
                        $("#btnSalir").show();

                    },
                    cargarClientes: function() {

                        if ($("#titulo").val().trim() === "") {
                            Swal.fire({
                                type: "warning",
                                title: "Oops...",
                                text: "Debes de ingresar el título de la promoción",
                                confirmButtonClass: "btn btn-primary",
                                timer: 1500,
                                buttonsStyling: false
                            });
                            return;
                        }

                        var loader = document.getElementById('loader');
                        loader.style.display = 'block';

                        $("#infPacientes").show();
                        $("#infPromocion").hide();
                        $("#btnEnviar").show();
                        $("#btnContinuar").hide();
                        $("#btnSalir").show();
                        $("#btnSalir").hide();


                        $("#titEnvioCorreo").html('<i class="fa fa-list-alt"></i> Seleccionar clientes');

                        let pacientes = '';

                        var form = $("#formargarPacientes");
                        var url = form.attr("action");
                        var datos = form.serialize();

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            async: false,
                            dataType: "json",
                            success: function(respuesta) {
                                $.each(respuesta.pacientes, function(i, item) {
                                    pacientes += '<tr>' +
                                        '<td class="text-truncate" style="vertical-align: middle; ">' +
                                        '<input type="checkbox"  data-id="' + item.id +
                                        '" id="checkPaciente' + item.id +
                                        '" class="icheck-activity classPaciente">' +
                                        '</td>' +
                                        '<td class="text-truncate" style="vertical-align: middle; t">' +
                                        item.nombre + ' ' + item.apellido + '</td>' +
                                        '<td class="text-truncate" style="vertical-align: middle; t">' +
                                        item.email + '</td>';
                                });

                                loader.style.display = 'none';
                            }
                        });

                        $("#trPacientes").html(pacientes);


                        $.checkPacientes();

                        var input = document.getElementById('searchInput');
                       

                        // Agregar evento de entrada para el input de búsqueda
                        input.addEventListener('input', function() {
                            searchTable(input.value);
                        });
                    },
                    checkPacientes: function() {
                        $(".icheck-activity").iCheck({
                            checkboxClass: "icheckbox_square-green",
                            radioClass: "iradio_square-green"
                        });

                        var checkAll = $('input#icheck-input-all');
                        var checkboxes = $('input.icheck-activity');

                        checkAll.on('ifClicked', function() {
                            if (checkAll.prop('checked')) {
                                checkboxes.iCheck('uncheck');
                            } else {
                                checkboxes.iCheck('check');
                            }
                        });
                    },
                    cambioFormato: function(id) {
                        var numero = $("#" + id).val();
                        $("#valor").val(numero);
                        var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                        $("#valorVis").val(formatoMoneda);

                    },
                    editar: function(id) {

                        $("#modalServicios").modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        $("#accion").val("editar");
                        $("#idServicio").val(id);
                        $("#btnGuardar").show();
                        $("#btnNuevo").hide();

                        var form = $("#formBuscarServicio");
                        $("#idServ").remove();
                        form.append("<input type='hidden' id='idServ' name='idServ'  value='" + id + "'>");

                        var url = form.attr("action");
                        var datos = form.serialize();

                        let multimedia = "";

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            async: false,
                            dataType: "json",
                            success: function(respuesta) {

                                $("#nombre").val(respuesta.servicio.nombre);
                                var numero = respuesta.servicio.valor;
                                var formatoMoneda = formatCurrency(numero, 'es-CO', 'COP');
                                $("#valor").val(numero);
                                $("#valorVis").val(formatoMoneda);
                                $("#descripcion").val(respuesta.servicio.descripcion);
                                var checkbox = document.getElementById("customSwitch1");

                                if (respuesta.servicio.descuento == "Si") {
                                    checkbox.checked = true;
                                } else {
                                    checkbox.checked = false;
                                }


                            }
                        });

                        $("#trMultimedia").html(multimedia);
                    },
                    salir: function() {
                        $('#modalPromocion').modal('hide');
                    },
                    limpiar: function() {
                        $("#nombre").val("");
                        $("#valor").val("");
                        $("#valorVis").val("");
                        $("#descripcion").val("");
                        var checkbox = document.getElementById("customSwitch1");
                        checkbox.checked = false;


                    },
                    nuevo: function() {
                        $("#accion").val("agregar");
                        $("#btnGuardar").show();
                        $("#btnNuevo").hide();
                        $.limpiar();
                    },

                    iniciaEditor: function() {
                        CKEDITOR.replace('contenidoPromocion', {
                            width: '100%',
                            height: 150
                        });
                    },

                    eliminar: function(id) {
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
                                $.procederEliminar(id);
                                $.cargar(1);
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
                    procederEliminar: function(id) {
                        var form = $("#formEliminar");

                        $("#idServ").remove();
                        form.append("<input type='hidden' id='idServ' name='idServ'  value='" + id +
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
                            }
                        });

                    },

                });

                $.cargar(1);
                $.iniciaEditor();

                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];

                    // Asegurarse de que 'page' sea un número antes de hacer la solicitud
                    if (!isNaN(page)) {
                        $.cargar(page);
                    }
                });


                $('#searchInput').on('input', function() {
                    var searchTerm = $(this).val();
                    $.cargar(1, searchTerm); // Cargar la primera página con el término de búsqueda
                });
            })

            function formatCurrency(number, locale, currencySymbol) {
                return new Intl.NumberFormat(locale, {
                    style: 'currency',
                    currency: currencySymbol,
                    minimumFractionDigits: 2
                }).format(number);
            }


            function validartxtnum(e) {
                tecla = e.which || e.keyCode;
                patron = /[0-9]+$/;
                te = String.fromCharCode(tecla);
                //    if(e.which==46 || e.keyCode==46) {
                //        tecla = 44;
                //    }
                return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 44);
            }

            function searchTable(query) {
                query = query.toLowerCase(); // Convertir la búsqueda a minúsculas para ser insensible a mayúsculas
                var table = document.getElementById('tabPaciente');
                // Iterar sobre las filas de la tabla (comenzando desde la segunda fila)
                for (var i = 1; i < table.rows.length; i++) {
                    var row = table.rows[i];
                    var match = false;

                    // Iterar sobre las celdas de la fila actual
                    for (var j = 0; j < row.cells.length; j++) {
                        var cellValue = row.cells[j].textContent.toLowerCase();

                        // Verificar si la celda contiene el texto de búsqueda
                        if (cellValue.includes(query)) {
                            match = true;
                            break;
                        }
                    }

                    // Mostrar u ocultar la fila según si hubo coincidencia
                    row.style.display = match ? '' : 'none';
                }
            }

            function validartxt(e) {
                tecla = e.which || e.keyCode;
                patron = /[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]+$/;
                te = String.fromCharCode(tecla);
                return (patron.test(te) || tecla == 9 || tecla == 8 || tecla == 37 || tecla == 39 || tecla == 46);
            }
        </script>

        </script>
    @endsection
