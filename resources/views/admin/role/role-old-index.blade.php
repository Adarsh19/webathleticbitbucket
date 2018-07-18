@extends('layouts.admin_layout')
@section('title','Roles')
@section('style')

<!-- Specific Page Vendor CSS -->
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
        </style>
        <style type="text/css">
    .modal-title{
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<section role="main" class="content-body">

    <header class="page-header">
        @include('admin.includes.header')
    </header>
    <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Roles</a></li>
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
            <div class="tabs tabs-dark">
                <!-- <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Klantgegevens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Personeel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Kaart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Statistieken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Toegang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#popular6" data-toggle="tab">Check-in</a>
                    </li>
                </ul> -->
                <div class="tab-content">
                    <div id="popular6" class="tab-pane active">
                        <section class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Role Description</th>
                                            <th>@lang('common.created_at')</th>
                                            <th>@lang('common.updated_at')</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <!-- I also want a button “Zoeken”. Here I can search my users. -->
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: page -->
    <!-- add page modal -->
<!-- /.role edit permissions -->
</section>

<div id="edit-modal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header hidden">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Add Role
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="tabs tabs-dark">
                        <ul class="nav nav-tabs">
                            <li class="nav-item tab-add">
                                <a class="nav-link" href="#add_tab_pane" data-toggle="tab">Toevoegen</a>
                            </li>
                            <li class="nav-item tab-edit active">
                                <a class="nav-link" href="#update_tab_pane" data-toggle="tab">Wijzigen</a>
                            </li>
                            <li class="nav-item tab-delete">
                                <a class="nav-link" id="delete-tab-button">Delete </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="add_tab_pane" class="tab-pane tab-add-pane">
                                <form role="form" id="role_add_form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Role</label>
                                            <input type="text" name="role" class="form-control" id="role" value="{{ old('role') }}" placeholder="ex: days">
                                            <span class="text-danger" id="role-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Role Description</label>
                                            <textarea name="rdescription" class="form-control" id="rdescription" placeholder="ex: rdescription">{{ old('rdescription') }}</textarea>
                                            <span class="text-danger" id="rdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat" id="store-button">Save changes</button>
                                    </div>
                                </form>
                            </div>
                            <div id="update_tab_pane" class="tab-pane  tab-edit-pane active">
                                <form role="form" id="role_edit_form" method="post" enctype="multipart/form-data">
                                    {{method_field('PATCH')}}
                                    {{csrf_field()}}
                                    <input type="hidden" name="role_id" id="edit-role-id">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Role</label>
                                            <input type="text" name="role" class="form-control" id="edit-role" value="" placeholder="ex: role">
                                            <span class="text-danger" id="role-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Role Description</label>
                                            <textarea name="rdescription" class="form-control" id="edit-rdescription" placeholder="ex: rdescription"></textarea>
                                            <span class="text-danger" id="rdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat update-button">@lang('common.update')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Add Role
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            

        </div>
    </div>
</div>
<!-- /.add page modal -->

<!-- view page modal -->
<div id="view-modal" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-group pull-right no-print">
                    <div class="btn-group">
                        <button class="tip btn btn-default btn-flat btn-sm" id="print-button" data-toggle="tooltip" data-original-title="Print">
                            <i class="fa fa-print"></i>
                            <span class="hidden-sm hidden-xs"></span>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="tip btn btn-default btn-flat btn-sm" data-toggle="tooltip" data-original-title="@lang('common.close')" data-dismiss="modal" aria-label="@lang('common.close')">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-sm hidden-xs"></span>
                        </button>
                    </div>
                </div>
                <h4 class="modal-title" id="view-name"></h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Role</td>
                            <td id="view-role"></td>
                        </tr>
                        <tr>
                            <td>Role Description</td>
                            <td id="view-rdescription"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="@lang('common.close')">@lang('common.close')</button>
            </div>
        </div>
    </div>
</div>
<!-- /.view page modal -->

<!-- delete page modal -->
<div id="delete-modal" class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x"></i>
                    </span>
                    Are you sure want to delete this ?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">@lang('common.close')</button>
                <form method="post" role="form" id="delete_form">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-outline">Delete</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.delete page modal -->


<!-- edit page modal -->
<div id="edit-modal-2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-edit fa-stack-1x"></i>
                    </span>
                    Edit role
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            

        </div>
    </div>
</div>
<!-- /.edit page modal -->

<!-- role edit permissions -->
<div id="edit-permission-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-edit fa-stack-1x"></i>
                    </span>
                    Edit Role Pemission
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <!--<form role="form" id="role_permission_edit_form" method="post" action="{{ route('admin.addpermisionRoute') }}" enctype="multipart/form-data">-->
            <form name="profile_add_form" data-parsley-validate class="form-horizontal" action="{{ route('admin.addpermisionRoute') }}"
                              method="post">
                {{method_field('PATCH')}}
                {{csrf_field()}}
                <input type="hidden" name="role_id" id="edit-permission-role-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-role">Role</label>
                        <input type="text" class="form-control" id="edit-permission-role" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sell_category">Role Permission</label>
                    </div>
                    <div class="form-group">
                        @foreach($permissions as $permission)
                        <div class="col-md-12">
                            <input type="checkbox" class="permission" value="<?php echo $permission->id; ?>" name="menu_id[]" id="edit-permission-permissions<?php echo $permission->id; ?>">
                            <label for="<?php echo $permission->id; ?>"><?php echo $permission->permission; ?></label>
                            <!-- <textarea class="form-control" id="edit-permission-description<?php echo $permission->id; ?>"  readonly><?php echo $permission->pdescription; ?></textarea> -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                    <button type="submit" class="btn btn-info btn-flat update-permission-button">@lang('common.update')</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('site_scripts')
    <!-- Specific Page Vendor -->
        <script src="{{ asset('admin_files/vendor/select2/js/select2.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
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
        <script>
        $.extend( true, $.fn.dataTable.defaults, {
             "language": {
                "info": "Weergaven _START_ naar _END_ van de _TOTAL_ resultaten",
            }
        } );
        $(document).on('click',".add-button", function(){
            var modal = $('#edit-modal');
            modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
            modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
            modal.find('.tab-content').find('.tab-pane').removeClass('active');
            modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
            modal.addClass('modal_show_only_add');
        });
        function edit(role_id){
            var url = "{{ route('admin.roles.show', 'role_id') }}";
            url = url.replace("role_id", role_id);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success:function(data){
                    var modal = $('#edit-modal');
                    modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
                    modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
                    modal.find('.tab-content').find('.tab-pane').removeClass('active');
                    modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
                    modal.removeClass('modal_show_only_add').modal('show');
                    $('#edit-role-id').val(data['id']);
                    $('#edit-role').val(data['role']);
                    $('#edit-rdescription').val(data['rdescription']);
            }});
        }
        /** Update **/
        $(".update-button").click(function(){
            var role_id = $('#edit-role-id').val();
            var url = "{{ route('admin.roles.update', 'role_id') }}";
            url = url.replace("role_id", role_id);
            // var page_edit_form = $("#page_edit_form");
            // var form_data = page_edit_form.serialize();
            var postData = new FormData($("#role_edit_form")[0]);
            $('#role-error').html("");
            $('#rdescription-error').html("");
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.role){
                            $('#role-error').html(data.errors.role[0]);
                        }
                        if (data.errors.rdescription){
                            $('#rdescription-error').html(data.errors.rdescription[0]);
                        }
                    }
                    if (data.success) {
                        window.location.href = '{{ route('admin.roles.index') }}';
                    }
                },
            });
        });
        function roleeditpermission(role_id){
            var url = "{{ route('admin.roles.edit', 'role_id') }}";
            url = url.replace("role_id", role_id);
            $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success:function(data){
                $('.permission').prop('checked', false);
                for (var i = 0; i < data.length; i++){
                    $('#edit-permission-role').val(data[i].role);
                    $("#edit-permission-permissions" + data[i].id).prop('checked', true);
                }
                $('#edit-permission-modal').modal('show');
                $('#edit-permission-role-id').val(role_id);
            }});
        }
        /** Delete **/
        function remove(role_id){
            var url = "{{ route('admin.roles.destroy', 'role_id') }}";
            url = url.replace("role_id", role_id);
            $('#delete-modal').modal('show');
            $('#delete_form').attr('action', url);
        }
        $(document).on('click','#delete-tab-button',function(){
            var id = $('#edit-role-id').val();
            $(this).closest('.modal').modal('hide');
            remove(id);
        });
        /** Add **/
        
        /** Store **/
        $("#store-button").click(function(){
            var postData = new FormData($("#role_add_form")[0]);
            $('#role-error').html("");
            $('#rdescription-error').html("");
            $.ajax({
                type:'POST',
                url:'{{ route('admin.roles.store') }}',
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.role){
                            $('#role-error').html(data.errors.role[0]);
                        }
                        if (data.errors.rdescription){
                            $('#rdescription-error').html(data.errors.rdescription[0]);
                        }
                    }
                    if (data.success) {
                        window.location.href = '{{ route('admin.roles.index') }}';
                    }
                },
            });
        });
        function view(id){
            var url = "{{ route('admin.roles.show', 'id') }}";
            url = url.replace("id", id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                $('#view-modal').modal('show');
                $('#view-role').text(data['role']);
                $('#view-rdescription').text(data['rdescription']);
            }});
        }
        </script>
<script type="text/javascript">
    (function($) {
        var select_html = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-button" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-object-group"></i> Add Role</button></div>';
        // var select_html = '<div class="pull-right"><span style="width:auto;line-height:2.5;padding:0;"> Status </span> <select class="form-control" >';
        //     select_html+= '<option> Item 1</option>';
        //     select_html+= '<option> Item 2</option>';
        //     select_html+= '<option> Item 3</option>';
        //     select_html+= '</select><span class="hvr-grow-shadow"><i class="fa fa-user"></i> Add User</span></div>';
            'use strict';
    var datatableInit = function() {
        var $table = $('#datatable-tabletools');
        var table = $table.dataTable({
            bDestroy: true,
            ajax: "{{ route('admin.getRolesRoute') }}",
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
                        { "data": "role" },
                        { "data": "rdescription" },
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
        $('#datatable-tabletools_filter').append(select_html);
    };
    $(function() {
        datatableInit();
        // $('.nav-link').on('click',function(){
        //   datatableInit();
        //  });
    });
}).apply(this, [jQuery]);
 </script>
@endsection
@section('scripts')
@endsection
