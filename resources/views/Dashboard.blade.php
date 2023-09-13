@extends('Plantilla.Principal')
@section('title', 'Tablero Inicial')
@section('Contenido')
<div class="content-header row">
</div>
<div class="content-body">
    <!-- Grouped multiple cards for statistics starts here -->
    <div class="row grouped-multiple-statistics-card">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon primary d-flex justify-content-center mr-3">
                                    <i class="icon p-1 icon-bar-chart customize-icon font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">$95k</h3>
                                    <p class="sub-heading">Revenue</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon danger d-flex justify-content-center mr-3">
                                    <i class="icon p-1 icon-pie-chart customize-icon font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">18.63%</h3>
                                    <p class="sub-heading">Growth Rate</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="danger"><i class="fa fa-long-arrow-down"></i> 2.0%</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="icon p-1 icon-graph customize-icon font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">$27k</h3>
                                    <p class="sub-heading">Sales</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start">
                                <span class="card-icon warning d-flex justify-content-center mr-3">
                                    <i class="icon p-1 icon-basket-loaded customize-icon font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">13700</h3>
                                    <p class="sub-heading">Orders</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="danger"><i class="fa fa-long-arrow-down"></i> 13.6%</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Grouped multiple cards for statistics ends here -->
    <div class="content-body">
        <section id="advance-examples">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Agenda</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id='external-events'>
                                            <h4>Servicios</h4>
                                            <div class="fc-events-container">
                                                <div class='fc-event' data-color='#2D95BF'>All Day Event</div>
                                                <div class='fc-event' data-color='#48CFAE'>Long Event</div>
                                                <div class='fc-event' data-color='#50C1E9'>Meeting</div>
                                                <div class='fc-event' data-color='#FB6E52'>Birthday party</div>
                                                <div class='fc-event' data-color='#ED5564'>Lunch</div>
                                                <div class='fc-event' data-color='#F8B195'>Conference Meeting</div>
                                                <div class='fc-event' data-color='#6C5B7B'>Party</div>
                                                <div class='fc-event' data-color='#355C7D'>Happy Hour</div>
                                                <div class='fc-event' data-color='#547A8B'>Dance party</div>
                                                <div class='fc-event' data-color='#3EACAB'>Dinner</div>
                                                <p>
                                                    <input type='checkbox' id='drop-remove' />
                                                    <label for='drop-remove'>remove after drop</label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div id='fc-external-drag'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
 
</div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenAdmin").removeClass("active");
        })
    </script>

</script>
@endsection