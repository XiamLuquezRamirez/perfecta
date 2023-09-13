@extends('Plantilla.Principal')
@section('title', 'Tablero Inicial')
@section('Contenido')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Invoice Edit</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Invoice</a>
                    </li>
                    <li class="breadcrumb-item active">Invoice Edit
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="media width-250 float-right">
            <div class="media-left media-middle">
                <div id="sp-bar-total-sales"></div>
            </div>
            <div class="media-body media-right text-right">
                <h3 class="m-0">$5,668</h3><span class="text-muted">Sales</span>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="content-body">
        <div class="row mb-1 mt-1 mt-md-0">
            <div class="col-12">
                <a href="invoice-add.html" class="btn btn-primary">Create Invoice</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- datatable started -->
                <div id="app-invoice-wrapper" class="">
                    <table id="app-invoice-table" class="table" style="width: 100%;">
                        <thead class="border-bottom border-dark">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    <span class="align-middle">Invoice#</span>
                                </th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Tags</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00956</a>
                                </td>
                                <td><span class="invoice-amount">$459.30</span></td>
                                <td><span class="invoice-date">12-08-19</span></td>
                                <td><span class="invoice-customer">Pixinvent PVT. LTD</span></td>
                                <td>
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Technology
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00349</a>
                                </td>
                                <td><span class="invoice-amount">$125.00</span></td>
                                <td><span class="invoice-date">08-08-19</span></td>
                                <td><span class="invoice-customer">Volkswagen</span></td>
                                <td>
                                    <span class="bullet bullet-primary bullet-sm"></span>
                                    Car
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00853</a>
                                </td>
                                <td><span class="invoice-amount">$10,503</span></td>
                                <td><span class="invoice-date">02-08-19</span></td>
                                <td><span class="invoice-customer">Chevron Corporation</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00452</a>
                                </td>
                                <td><span class="invoice-amount">$90</span></td>
                                <td><span class="invoice-date">28-07-19</span></td>
                                <td><span class="invoice-customer">Alphabet</span></td>
                                <td>
                                    <span class="bullet bullet-info bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-warning badge-pill">Partially Paid</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00123</a>
                                </td>
                                <td><span class="invoice-amount">$15,900</span></td>
                                <td><span class="invoice-date">23-07-19</span></td>
                                <td><span class="invoice-customer">Toyota Motor</span></td>
                                <td>
                                    <span class="bullet bullet-primary bullet-sm"></span>
                                    Car
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00853</a>
                                </td>
                                <td><span class="invoice-amount">$115.06</span></td>
                                <td><span class="invoice-date">24-06-19</span></td>
                                <td><span class="invoice-customer">Samsung Electronics</span></td>
                                <td>
                                    <span class="bullet bullet-info bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00153</a>
                                </td>
                                <td><span class="invoice-amount">$1,090</span></td>
                                <td><span class="invoice-date">23-05-19</span></td>
                                <td><span class="invoice-customer">Pixinvent PVT. LTD</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00326</a>
                                </td>
                                <td><span class="invoice-amount">$8,563</span></td>
                                <td><span class="invoice-date">06-01-19</span></td>
                                <td><span class="invoice-customer">Wells Fargo</span></td>
                                <td>
                                    <span class="bullet bullet-danger bullet-sm"></span>
                                    Food
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00759</a>
                                </td>
                                <td><span class="invoice-amount">$10,960.20</span></td>
                                <td><span class="invoice-date">22-05-19</span></td>
                                <td><span class="invoice-customer">Ping An Insurance</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-warning badge-pill">Partially Paid</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00999</a>
                                </td>
                                <td><span class="invoice-amount">$886.90</span></td>
                                <td><span class="invoice-date">12-05-19</span></td>
                                <td><span class="invoice-customer">Apple</span></td>
                                <td>
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00956</a>
                                </td>
                                <td><span class="invoice-amount">$459.30</span></td>
                                <td><span class="invoice-date">12-08-19</span></td>
                                <td><span class="invoice-customer">Pixinvent PVT. LTD</span></td>
                                <td>
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Technology
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00349</a>
                                </td>
                                <td><span class="invoice-amount">$125.00</span></td>
                                <td><span class="invoice-date">08-08-19</span></td>
                                <td><span class="invoice-customer">Volkswagen</span></td>
                                <td>
                                    <span class="bullet bullet-primary bullet-sm"></span>
                                    Car
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00853</a>
                                </td>
                                <td><span class="invoice-amount">$10,503</span></td>
                                <td><span class="invoice-date">02-08-19</span></td>
                                <td><span class="invoice-customer">Chevron Corporation</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00452</a>
                                </td>
                                <td><span class="invoice-amount">$90</span></td>
                                <td><span class="invoice-date">28-07-19</span></td>
                                <td><span class="invoice-customer">Alphabet</span></td>
                                <td>
                                    <span class="bullet bullet-info bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-warning badge-pill">Partially Paid</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00123</a>
                                </td>
                                <td><span class="invoice-amount">$15,900</span></td>
                                <td><span class="invoice-date">23-07-19</span></td>
                                <td><span class="invoice-customer">Toyota Motor</span></td>
                                <td>
                                    <span class="bullet bullet-primary bullet-sm"></span>
                                    Car
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00853</a>
                                </td>
                                <td><span class="invoice-amount">$115.06</span></td>
                                <td><span class="invoice-date">24-06-19</span></td>
                                <td><span class="invoice-customer">Samsung Electronics</span></td>
                                <td>
                                    <span class="bullet bullet-info bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00153</a>
                                </td>
                                <td><span class="invoice-amount">$1,090</span></td>
                                <td><span class="invoice-date">23-05-19</span></td>
                                <td><span class="invoice-customer">Pixinvent PVT. LTD</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00788</a>
                                </td>
                                <td><span class="invoice-amount">$555.50</span></td>
                                <td><span class="invoice-date">10-06-19</span></td>
                                <td><span class="invoice-customer">ExxonMobil</span></td>
                                <td>
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Mobile
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00326</a>
                                </td>
                                <td><span class="invoice-amount">$8,563</span></td>
                                <td><span class="invoice-date">06-01-19</span></td>
                                <td><span class="invoice-customer">Wells Fargo</span></td>
                                <td>
                                    <span class="bullet bullet-danger bullet-sm"></span>
                                    Food
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00759</a>
                                </td>
                                <td><span class="invoice-amount">$10,960.20</span></td>
                                <td><span class="invoice-date">22-05-19</span></td>
                                <td><span class="invoice-customer">Ping An Insurance</span></td>
                                <td>
                                    <span class="bullet bullet-secondary bullet-sm"></span>
                                    Corporation
                                </td>
                                <td><span class="badge badge-warning badge-pill">Partially Paid</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00999</a>
                                </td>
                                <td><span class="invoice-amount">$886.90</span></td>
                                <td><span class="invoice-date">12-05-19</span></td>
                                <td><span class="invoice-customer">Apple</span></td>
                                <td>
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Electronic
                                </td>
                                <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="invoice-view.html">INV-00223</a>
                                </td>
                                <td><span class="invoice-amount">$459.30</span></td>
                                <td><span class="invoice-date">28-04-19</span></td>
                                <td><span class="invoice-customer">Communications</span></td>
                                <td>
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Technology
                                </td>
                                <td><span class="badge badge-success badge-pill">PAID</span></td>
                                <td>
                                    <div class="invoice-action">
                                        <a href="invoice-view.html" class="invoice-action-view mr-1">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                        <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                            <i class="feather icon-edit-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#MenPaciente").removeClass("active");
        })
    </script>

</script>
@endsection