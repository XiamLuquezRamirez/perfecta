@extends('Plantilla.Principal')
@section('title', 'Gestionar Recaudos')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="Ruta" data-ruta="{{ asset('/app-assets/') }}" />
    <input type="hidden" id="RutaTotal" data-ruta="{{ asset('/') }}" />
    <input type="hidden" id="accion" value="" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Gestionar Recaudos</h3>
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
                <div class="content-detached">
                    <div class="content-body">
                        <section id="div-datTratameintos" style=" filter: blur(5px);" class="row all-contacts">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="daily-activity" class="table-responsive height-350">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" id="icheck-input-all"
                                                                class="icheck-activity">
                                                        </th>
                                                        <th>Tratamiento</th>
                                                        <th>Total</th>
                                                        <th>Realizado</th>
                                                        <th>Pagado</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-truncate">
                                                            <input type="checkbox" id="icheck-input-1"
                                                                class="icheck-activity" checked>
                                                        </td>
                                                        <td class="text-truncate">
                                                            <div>
                                                                <p class="mb-25 latest-update-item-name text-bold-600">
                                                                    Tratamiento</p>
                                                                <small class="font-small-3">Profesional</small>
                                                            </div>
                                                        </td>
                                                        <td class="text-truncate">$ 300.000,00</td>
                                                        <td class="text-truncate">$ 300.000,00</td>
                                                        <td class="text-truncate">$ 300.000,00</td>
                                                        <td class="text-truncate">$ 300.000,00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-actions">
                                            <div class="text-right">
                                                <button type="reset" onclick="$.pagarTratamiento();" class="btn btn-warning"> Pagar<i
                                                        class="feather icon-chevron-right position-right"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader" class="loader-spinner" style="display: none;">
            <img src="{{ asset('app-assets/images/mujer.gif') }}" width="150" />
            <h2 class="parpadeo" style="color: #D08997; font-weight: bold;">Cargando...</h2>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenRecaudo").removeClass("active");

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
                    var datTratameintos = document.getElementById(
                        'div-datTratameintos'
                    ); // Reemplaza 'miDiv' con el ID de tu div
                    datTratameintos.style.filter = 'none';
                    $.buscInfTratamientos(lastSelectedData.id);
                }
            }

            $.extend({
                buscInfTratamientos: function(idPac){

                },
                pagarTratamiento: function(){

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

        });

        function formatCurrency(number, locale, currencySymbol) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currencySymbol,
                minimumFractionDigits: 2
            }).format(number);
        }

        // Llamar a la función con un porcentaje específico (puedes cambiar este valor)
    </script>

    </script>
@endsection
