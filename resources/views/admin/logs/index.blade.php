@extends('layouts.admin_layout')
@section('title','Logs')
@section('style')

<!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('admin_files/css/datepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_files/vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_files/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_files/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
        <style type="text/css">
        #datatable-tabletools_wrapper i {position: relative;top: 3px;}
        #datatable-tabletools_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
        #datatable-tabletools_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
        #datatable-tabletools_wrapper a { border: none; padding: 0; background: transparent;margin:0 5px 0px 0px}
        #datatable-tabletools_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
        #datatable-tabletools_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
        #datatable-tabletools_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
        #datatable-tabletools_wrapper a span{display: block;}
        #datatable-tabletools_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
        div#datatable-tabletools_filter {float: left;text-align:right;display:block;width:70%;
            margin: 0 0 30px;}
        div#datatable-tabletools_filter label{ width:40%; float: left;}
        div#datatable-tabletools_filter label input{ height:35px;}
        div#datatable-tabletools_filter .pull-right{ text-align: right; }
        div#datatable-tabletools_filter select, div#datatable-tabletools_filter span{margin: 0 10px; height:35px; display: inline-block;}
        div#datatable-tabletools_filter select{width:20%;height: 35px;width: 150px;}
                .form-control:not(.form-control-sm):not(.form-control-lg) {
            font-size: 0.85rem !important;
            line-height: 0.85 !important;
            min-height: 0.4rem !important;
        }

        /* start service stayle */
        #datatable-tabletools-service_wrapper i {position: relative;top: 3px;}
        #datatable-tabletools-service_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
        #datatable-tabletools-service_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
        #datatable-tabletools-service_wrapper a { border: none; padding: 0; background: transparent;margin:0 5px 0px 0px}
        #datatable-tabletools-service_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
        #datatable-tabletools-service_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
        #datatable-tabletools-service_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
        #datatable-tabletools-service_wrapper a span{display: block;}
        #datatable-tabletools-service_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
        div#datatable-tabletools-service_filter {float: left;text-align:right;display:block;width:70%;
            margin: 0 0 30px;}
        div#datatable-tabletools-service_filter label{ width:40%; float: left;}
        div#datatable-tabletools-service_filter label input{ height:35px;}
        div#datatable-tabletools-service_filter .pull-right{ text-align: right; }
        div#datatable-tabletools-service_filter select, div#datatable-tabletools-service_filter span{margin: 0 10px; height:35px; display: inline-block;}
        div#datatable-tabletools-service_filter select{width:20%;height: 35px;width: 150px;}
                .form-control:not(.form-control-sm):not(.form-control-lg) {
            font-size: 0.85rem !important;
            line-height: 0.85 !important;
            min-height: 0.4rem !important;
        }
        /* end service stayle */
        </style>
        <style type="text/css">
    .modal-title{
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<section service="main" class="content-body">

    <header class="page-header">
        <!-- <h2>Services</h2> -->
        @include('admin.includes.header')
    </header>

    <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-wrench active"></i> Diensten</a></li>
            </ol>
    </section>

    <!-- start: page -->
    <div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col">
            <section class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-logs">
                                    <thead>
                                        <tr>
                                           <th>ID</th>
                                            <th>@lang('common.log_name')</th>
                                            <th>@lang('common.description')</th>
                                            <th>Caused For</th>
                                            <th>@lang('common.causer_name')</th>
                                            <th>@lang('common.date_time')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                        <tr>
                                            <td>{{$log->id}}</td>
                                            <td>{{$log->log_name}}</td>
                                            <td>{{$log->description}}</td>
                                            <td>{{$log->subject}}</td>
                                            <td>{{$log->causer->name}}</td>
                                            <td>{{$log->created_at}}</td>
                                        </tr>
                                        @endforeach
                                        {{$logs->links()}}
                                    </tbody>

                                </table>
                            </div>
            </section>
    </div>
    <!-- end: page -->
</section>

@endsection
@section('site_scripts')
    <!-- Specific Page Vendor -->
        <script src="{{ asset('admin_files/vendor/select2/js/select2.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>

        <!-- datatable implementing -->
        <script src="code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
        <script src="cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script src="{{ asset('admin_files/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>
        <script type="text/javascript" src="{{ asset('public/admin/datatable/js/buttons.flash.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/admin/datatable/js/buttons.colVis.min.js') }}"></script>
<!-- <script>
        $.extend( true, $.fn.dataTable.defaults, {
             "language": {
                "info": "Weergaven _START_ naar _END_ van de _TOTAL_ resultaten",
            }
        } );
</script>
<script type="text/javascript">
    (function($) {
    'use strict';

    var datatableInit_logs = function() {
        var $table = $('#datatable-tabletools-logs');
        var table = $table.dataTable({
            bDestroy: true,
            ajax: "{{ route('admin.getServicesRoute') }}",
            dom: 'Bfrtip',
            buttons: [
            {
                extend:    'print',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-text-o"></i> Print</span>',
                titleAttr: 'print'
            },
            {
                extend:    'excelHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-excel-o"></i> Excel</span>',
                titleAttr: 'Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-pdf-o"></i> PDF</span>',
                titleAttr: 'PDF'
            },
        ],
            columns: [
                        { "data": "id" },
                        { "data": "sdescription" },
                        { "data": "user_mass" },
                        { "data": "sprice" },
                        { "data": "payment_time" },
                        <?php if ($user->role == "admin") {?>
                        { "data": "cname" },
                        <?php } ?>
                        { "data": "created_at" },
                        { "data": "updated_at" },
                        { "data": "action", orderable: false, searchable: false},
                    ],
            fnDrawCallback: function() {
                var $paginate = this.siblings('.dataTables_paginate');

                if (this.api().data().length <= this.fnSettings()._iDisplayLength){
                    $paginate.hide();
                }
                else{
                    $paginate.show();
                }
            }
        });
        $('#datatable-tabletools-service_filter').append(select_html_service);
    }; 
    $(function() {
        datatableInit_logs();
    });
    // end service function

}).apply(this, [jQuery]);
</script> -->
@endsection
@section('scripts')
<script src="{{ asset('admin_files/js/datepicker.js') }}"></script>
<script>          
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})
(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42715764-8', 'auto');
ga('send', 'pageview');
</script>
@endsection
