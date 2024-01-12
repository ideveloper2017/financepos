@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/nprogress.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datepicker.min.css')}}">
@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>{{ __('translate.Customer_details') }}</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div id="section_Client_details">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="ol-lg-3 col-md-6 col-sm-6 col-12">
                    <table class="display table table-md">
                        <tbody>
                            <tr>
                                <th>{{ __('translate.FullName') }}</th>
                                <td>{{$client_data['full_name']}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translate.Code') }}</th>
                                <td>{{$client_data['code']}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translate.Phone') }}</th>
                                <td>{{$client_data['phone']}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translate.Address') }}</th>
                                <td>{{$client_data['address']}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translate.Status') }}</th>
                                <td>
                                    @if($client_data['status'] == 1)
                                    <span class="badge badge-success">{{ __('translate.Active Client') }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('translate.Inactive Client') }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center">
                            <i class="i-Full-Cart"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-2">{{ __('translate.Total Sales') }}</p>
                                <p class="text-primary text-24 line-height-1 m-0" id="sales_data">
                                    {{$client_data['total_sales']}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-2">{{ __('translate.Total Amount') }}</p>
                                <p class="text-primary text-24 line-height-1 m-0" id="purchases_data">
                                    {{$client_data['total_amount']}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-Bag"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-2">{{ __('translate.Total paid') }}</p>
                                <p class="text-primary text-24 line-height-1 m-0" id="return_sales_data">
                                    {{$client_data['total_paid']}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-2">{{ __('translate.Total debt') }}</p>
                                <p class="text-primary text-24 line-height-1 m-0" id="return_purchases_data">
                                    {{$client_data['total_debt']}}</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="sale_tab" data-toggle="tab" data-target="#sell" type="button"
                                role="tab" aria-controls="sell" aria-selected="true">{{ __('translate.Sales') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="quotation_tab" data-toggle="tab" data-target="#quotation" type="button"
                                role="tab" aria-controls="quotation" aria-selected="false">{{ __('translate.SalesReturn') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment_received_tab" data-toggle="tab" data-target="#payment_received"
                                type="button" role="tab" aria-controls="payment_received" aria-selected="false">{{ __('translate.payment_sale') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    {{-- Sell Tab--}}
                    <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sale_tab">
{{--                        <form @submit.prevent="update_sms_body('sale')">--}}
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="sale_table" class="display table table-hover table_height">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class="not_show">{{ __('translate.Action') }}</th>
                                            <th>{{ __('translate.date') }}</th>
                                            <th>{{ __('translate.Ref') }}</th>
                                            <th>{{ __('translate.Created_by') }}</th>
                                            <th>{{ __('translate.Customer') }}</th>
                                            <th>{{ __('translate.warehouse') }}</th>
                                            <th>{{ __('translate.Total') }}</th>
                                            <th>{{ __('translate.Paid') }}</th>
                                            <th>{{ __('translate.Due') }}</th>
                                            <th>{{ __('translate.Payment_Status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
{{--                                    <button type="submit" :disabled="Submit_Processing" class="btn btn-primary">--}}
{{--                      <span v-if="Submit_Processing" class="spinner-border spinner-border-sm" role="status"--}}
{{--                            aria-hidden="true"></span> <i class="i-Yes me-2 font-weight-bold"></i> {{ __('translate.Submit') }}--}}
{{--                                    </button>--}}
                                </div>
                            </div>
{{--                        </form>--}}

                    </div>

                    {{-- quotation_tab --}}
                    <div class="tab-pane fade" id="quotation" role="tabpanel" aria-labelledby="quotation_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="sales_return_table" class="display table table_height">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('translate.Date') }}</th>
                                            <th>{{ __('translate.Ref') }}</th>
                                            <th>{{ __('translate.Customer') }}</th>
                                            <th>{{ __('translate.warehouse') }}</th>
                                            <th>{{ __('translate.Sale_Ref') }}</th>
                                            <th>{{ __('translate.Total') }}</th>
                                            <th>{{ __('translate.Paid') }}</th>
                                            <th>{{ __('translate.Due') }}</th>
                                            <th>{{ __('translate.Payment_Status') }}</th>
                                            <th class="not_show">{{ __('translate.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- payment_received tab --}}
                    <div class="tab-pane fade" id="payment_received" role="tabpanel" aria-labelledby="payment_received_tab">

                        <form @submit.prevent="update_sms_body('payment_received')">
                            <div class="row">
                                <div class=" col-md-12">
                                    <span> <strong>{{ __('translate.Available_Tags') }} : </strong></span>
                                    <p>
{{--                                        {contact_name},{business_name},{payment_number},{paid_amount}--}}
                                    </p>
                                </div>
                                <hr>
                                <div class="form-group col-md-12">
                                    <label for="sms_body_payment_received">{{ __('translate.SMS_Body') }} </label>
                                    <textarea type="text" v-model="sms_body_payment_received" class="form-control height-200"
                                              name="sms_body_payment_received" id="sms_body_payment_received"
                                              placeholder="{{ __('translate.SMS_Body') }}"></textarea>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
{{--                                    <button type="submit" :disabled="Submit_Processing" class="btn btn-primary">--}}
{{--                      <span v-if="Submit_Processing" class="spinner-border spinner-border-sm" role="status"--}}
{{--                            aria-hidden="true"></span> <i class="i-Yes me-2 font-weight-bold"></i> {{ __('translate.Submit') }}--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


</div>


@endsection

@section('page-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/nprogress.js')}}"></script>



<script>
    $(function () {
        "use strict";
        var client_id;
        $(document).ready(function () {
            client_id={{$client_data['code']}};
            sale_datatable(client_id);
            sales_return_datatable(client_id);
        })

        function sale_datatable( client_id = '') {
            var table = $('#sale_table').DataTable({
                processing: true,
                serverSide: true,
                "order": [[0, "desc"]],
                'columnDefs': [
                    {
                        'targets': [0],
                        'visible': false,
                        'searchable': false,
                    },
                    {
                        'targets': [1, 4, 5, 6, 7, 8, 9, 10],
                        "orderable": false,
                    },
                ],
                ajax: {
                    url: "{{ route('client_sales_datatable') }}",
                    data: {
                        // start_date: start_date === null ? '' : start_date,
                        // end_date: end_date === null ? '' : end_date,
                        // Ref: Ref === null ? '' : Ref,
                        client_id: client_id == '0' ? '' : client_id,
                        // warehouse_id: warehouse_id == '0' ? '' : warehouse_id,
                        // payment_statut: payment_statut == '0' ? '' : payment_statut,
                        "_token": "{{ csrf_token()}}"
                    },
                    dataType: "json",
                    type: "post"
                },
                columns: [
                    {data: 'id', className: "d-none"},
                    {data: 'action'},
                    {data: 'date'},
                    {data: 'Ref'},
                    {data: 'created_by'},
                    {data: 'client_name'},
                    {data: 'warehouse_name'},
                    {data: 'GrandTotal'},
                    {data: 'paid_amount'},
                    {data: 'due'},
                    {data: 'payment_status'},

                ],

                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: "<'row'<'col-sm-12 col-md-7'lB><'col-sm-12 col-md-5 p-0'f>>rtip",
                oLanguage: {
                    sEmptyTable: "{{ __('datatable.sEmptyTable') }}",
                    sInfo: "{{ __('datatable.sInfo') }}",
                    sInfoEmpty: "{{ __('datatable.sInfoEmpty') }}",
                    sInfoFiltered: "{{ __('datatable.sInfoFiltered') }}",
                    sInfoThousands: "{{ __('datatable.sInfoThousands') }}",
                    sLengthMenu: "_MENU_",
                    sLoadingRecords: "{{ __('datatable.sLoadingRecords') }}",
                    sProcessing: "{{ __('datatable.sProcessing') }}",
                    sSearch: "",
                    sSearchPlaceholder: "{{ __('datatable.sSearchPlaceholder') }}",
                    oPaginate: {
                        sFirst: "{{ __('datatable.oPaginate.sFirst') }}",
                        sLast: "{{ __('datatable.oPaginate.sLast') }}",
                        sNext: "{{ __('datatable.oPaginate.sNext') }}",
                        sPrevious: "{{ __('datatable.oPaginate.sPrevious') }}",
                    },
                    oAria: {
                        sSortAscending: "{{ __('datatable.oAria.sSortAscending') }}",
                        sSortDescending: "{{ __('datatable.oAria.sSortDescending') }}",
                    }
                },
                {{--buttons: [--}}
                {{--    {--}}
                {{--        extend: 'collection',--}}
                {{--        text: "{{ __('translate.EXPORT') }}",--}}
                {{--        buttons: [--}}
                {{--            {--}}
                {{--                extend: 'print',--}}
                {{--                text: 'Print',--}}
                {{--                exportOptions: {--}}
                {{--                    columns: ':visible:Not(.not_show)',--}}
                {{--                    rows: ':visible'--}}
                {{--                },--}}
                {{--                title: function () {--}}
                {{--                    return 'Sales List';--}}
                {{--                },--}}
                {{--            },--}}
                {{--            {--}}
                {{--                extend: 'pdf',--}}
                {{--                text: 'Pdf',--}}
                {{--                exportOptions: {--}}
                {{--                    columns: ':visible:Not(.not_show)',--}}
                {{--                    rows: ':visible'--}}
                {{--                },--}}
                {{--                title: function () {--}}
                {{--                    return 'Sales List';--}}
                {{--                },--}}
                {{--            },--}}
                {{--            {--}}
                {{--                extend: 'excel',--}}
                {{--                text: 'Excel',--}}
                {{--                exportOptions: {--}}
                {{--                    columns: ':visible:Not(.not_show)',--}}
                {{--                    rows: ':visible'--}}
                {{--                },--}}
                {{--                title: function () {--}}
                {{--                    return 'Sales List';--}}
                {{--                },--}}
                {{--            },--}}
                {{--            {--}}
                {{--                extend: 'csv',--}}
                {{--                text: 'Csv',--}}
                {{--                exportOptions: {--}}
                {{--                    columns: ':visible:Not(.not_show)',--}}
                {{--                    rows: ':visible'--}}
                {{--                },--}}
                {{--                title: function () {--}}
                {{--                    return 'Sales List';--}}
                {{--                },--}}
                {{--            },--}}
                {{--        ]--}}
                {{--    }]--}}
            });
        }
        function sales_return_datatable(client_id =''){
            var table = $('#sales_return_table').DataTable({
                processing: true,
                serverSide: true,
                "order": [[ 0, "desc" ]],
                'columnDefs': [
                    {
                        'targets': [0],
                        'visible': false,
                        'searchable': false,
                    },
                    {
                        'targets': [1,2,3,4,5,6,7,8,9,10],
                        "orderable": false,
                    },
                ],

                ajax: {
                    url: "{{ route('client_sales_return_datatable') }}",
                    data: {
                        client_id: client_id == '0'?'':client_id,
                        "_token": "{{ csrf_token()}}"
                    },
                },
                columns: [
                    {data: 'id', name: 'id',className: "d-none"},
                    {data: 'date', name: 'date'},
                    {data: 'Ref', name: 'Ref'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'warehouse_name', name: 'warehouse_name'},
                    {data: 'sale_ref', name: 'sale_ref'},
                    {data: 'GrandTotal', name: 'GrandTotal'},
                    {data: 'paid_amount', name: 'paid_amount'},
                    {data: 'due', name: 'due'},
                    {data: 'payment_status', name: 'payment_status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],

                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: "<'row'<'col-sm-12 col-md-7'lB><'col-sm-12 col-md-5 p-0'f>>rtip",
                oLanguage: {
                    sEmptyTable: "{{ __('datatable.sEmptyTable') }}",
                    sInfo: "{{ __('datatable.sInfo') }}",
                    sInfoEmpty: "{{ __('datatable.sInfoEmpty') }}",
                    sInfoFiltered: "{{ __('datatable.sInfoFiltered') }}",
                    sInfoThousands: "{{ __('datatable.sInfoThousands') }}",
                    sLengthMenu: "_MENU_",
                    sLoadingRecords: "{{ __('datatable.sLoadingRecords') }}",
                    sProcessing: "{{ __('datatable.sProcessing') }}",
                    sSearch: "",
                    sSearchPlaceholder: "{{ __('datatable.sSearchPlaceholder') }}",
                    oPaginate: {
                        sFirst: "{{ __('datatable.oPaginate.sFirst') }}",
                        sLast: "{{ __('datatable.oPaginate.sLast') }}",
                        sNext: "{{ __('datatable.oPaginate.sNext') }}",
                        sPrevious: "{{ __('datatable.oPaginate.sPrevious') }}",
                    },
                    oAria: {
                        sSortAscending: "{{ __('datatable.oAria.sSortAscending') }}",
                        sSortDescending: "{{ __('datatable.oAria.sSortDescending') }}",
                    }
                },
                buttons: [
                    {
                        extend: 'collection',
                        text: "{{ __('translate.EXPORT') }}",
                        buttons: [
                            {
                                extend: 'print',
                                text: 'print',
                                exportOptions: {
                                    columns: ':visible:Not(.not_show)',
                                    rows: ':visible'
                                },
                                title: function(){
                                    return 'Sales Return List';
                                },
                            },
                            {
                                extend: 'pdf',
                                text: 'pdf',
                                exportOptions: {
                                    columns: ':visible:Not(.not_show)',
                                    rows: ':visible'
                                },
                                title: function(){
                                    return 'Sales Return List';
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'excel',
                                exportOptions: {
                                    columns: ':visible:Not(.not_show)',
                                    rows: ':visible'
                                },
                                title: function(){
                                    return 'Sales Return List';
                                },
                            },
                            {
                                extend: 'csv',
                                text: 'csv',
                                exportOptions: {
                                    columns: ':visible:Not(.not_show)',
                                    rows: ':visible'
                                },
                                title: function(){
                                    return 'Sales Return List';
                                },
                            },
                        ]
                    }]
            });
        }
    })
    var app = new Vue({
        el: '#section_Client_details',
        data: {
            SubmitProcessing:false,
        },
        methods: {

        },

        //-----------------------------Autoload function-------------------
        created() {
        }
    })
</script>

@endsection
