@extends('layouts.admin_layout')
@section('title')
@lang('user.user_status')
@endsection
@section('style')

<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/select2/css/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
		<style type="text/css">
		#datatable-tabletools-status_wrapper i {position: relative;top: 3px;}
		#datatable-tabletools-status_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
		#datatable-tabletools-status_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
		#datatable-tabletools-status_wrapper a { border: none; padding: 0; background: transparent;margin:0 5px 0px 0px}
		#datatable-tabletools-status_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
		#datatable-tabletools-status_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
		#datatable-tabletools-status_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
		#datatable-tabletools-status_wrapper a span{display: block;}
		#datatable-tabletools-status_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
		div#datatable-tabletools-status_filter {float: left;text-align:right;display:block;width:70%;
			margin: 0 0 30px;}
		div#datatable-tabletools-status_filter label{ width:40%; float: left;}
		div#datatable-tabletools-status_filter label input{ height:35px;}
		div#datatable-tabletools-status_filter .pull-right{ text-align: right; }
		div#datatable-tabletools-status_filter select, div#datatable-tabletools-status_filter span{margin: 0 10px; height:35px; display: inline-block;}
		div#datatable-tabletools-status_filter select{width:20%;height: 35px;width: 150px;}
				.form-control:not(.form-control-sm):not(.form-control-lg) {
		    font-size: 0.85rem !important;
		    line-height: 0.85 !important;
		    min-height: 0.4rem !important;
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
	            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i>	@lang('user.user_status')
				</a></li>
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
				<ul class="nav nav-tabs hidden">
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
				</ul>
				<div class="tab-content">
					<div id="popular6" class="tab-pane active">
						<section class="card">
							<div class="card-body">
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools-status"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
									<thead>
										<tr>
											<th><input type="checkbox" class="datatable-checkbox-header"/></th>
											<th>@lang('common.company')</th>
											<th>@lang('common.status')</th>
											<th>@lang('common.description')</th>
											<th>Status Type</th>
											<th>@lang('common.created_at')</th>
											<th>@lang('common.updated_at')</th>
											<th width="15%">@lang('common.actions')</th>
										</tr>
									</thead>
									<!-- I also want a button “Zoeken”. Here I can search my Permissions. -->
								</table>
							</div>
				        </section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>
<div id="edit-status-modal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header hidden">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Add Status
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">×</span></button>
            </div>
		    <div class="modal-body">
				<div class="col">
					<div class="tabs tabs-dark">
						<ul class="nav nav-tabs">
							<li class="nav-item tab-add">
								<a class="nav-link" href="#add_status" data-toggle="tab">Toevoegen</a>
							</li>
							<li class="nav-item tab-edit active">
								<a class="nav-link" href="#update_status" data-toggle="tab">Wijzigen</a>
							</li>
							<li class="nav-item tab-delete">
								<a class="nav-link" id="delete-status-tab-button">@lang('common.delete') </a>
							</li>
						</ul>

						<div class="tab-content">
							<div id="add_status" class="tab-pane tab-add-pane">
								<form status="form" id="status_add_form" method="post" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="">
										<div class="form-group">
											<label for="status">@lang('user.status_input')</label>
											<input type="text" name="status" class="form-control" id="status" value="{{ old('status') }}" placeholder="@lang('common.enter_name')">
											<span class="text-danger" id="status-error"></span>
										</div>
										<div class="form-group">
											<label for="sell_category">@lang('common.description_input')</label>
											<textarea name="description" class="form-control" id="description" placeholder="@lang('common.enter_description')">{{ old('description') }}</textarea>
											<span class="text-danger" id="description-error"></span>
										</div>
										<div class="form-group">
											<label for="stype">Op welke pagina wilt u dit toevoegen?</label>
											<select id="stype" name="status_type" class="form-control">
												<option value="user">User</option>
												<option value="company">Company</option>
												<option value="other">Other</option>
											</select>
											<span class="text-danger" id="type-error"></span>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
										<button type="button" class="btn btn-info btn-flat" id="store-status-button">Save changes</button>
									</div>
								</form>
							</div>
							<div id="update_status" class="tab-pane  tab-edit-pane active">
								<form status="form" id="status_edit_form" method="post" enctype="multipart/form-data">
									{{method_field('PATCH')}}
									{{csrf_field()}}
									<input type="hidden" name="status_id" id="edit-status-id">
									<div class="">
										<div class="form-group">
											<label for="days">@lang('user.status_input')</label>
											<input type="text" name="status" class="form-control" id="edit-status" value="" placeholder="@lang('common.enter_name')">
											<span class="text-danger" id="status-error"></span>
										</div>
										<div class="form-group">
											<label for="sell_category">@lang('common.description_input')</label>
											<textarea name="description" class="form-control" id="edit-description" placeholder="@lang('common.enter_description')"></textarea>
											<span class="text-danger" id="description-error"></span>
										</div>
										<div class="form-group">
											<label for="stype">Op welke pagina wilt u dit toevoegen?</label>
											<select id="edit-stype" name="status_type" class="form-control">
												<option value="user">User</option>
												<option value="company">Company</option>
												<option value="other">Other</option>
											</select>
											<span class="text-danger" id="type-error"></span>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
										<button type="button" class="btn btn-info btn-flat update-status-button">@lang('common.update')</button>
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

<!-- view page modal -->
<div id="view-status-modal" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" permission="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" permission="document">
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
							<td>Status</td>
							<td id="view-status-status"></td>
						</tr>
						<tr>
							<td>Status omschrijving</td>
							<td id="view-status-description"></td>
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
<div id="delete-status-modal" class="modal modal-danger fade" id="modal-danger">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="fa-stack fa-sm">
						<i class="fa fa-square-o fa-stack-2x"></i>
						<i class="fa fa-trash fa-stack-1x"></i>
					</span>
					@lang('common.delete_modal_text')
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">@lang('common.close')</button>
				<form method="post" permission="form" id="delete_status_form">
					{{csrf_field()}}
					{{method_field('DELETE')}}
					<button type="submit" class="btn btn-outline">@lang('common.delete')</button>
				</form>
			</div>
		</div>
			<!-- /.modal-content -->
	</div>
		<!-- /.modal-dialog -->
</div>
	<!-- /.delete page modal -->
<div class="modal fade bulk-delete-modal" id="delete-status-modal-bulk" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
         <form method="GET" action="{{ url('admin/bulk-delete/user-status')}}" id="delete-status-form-bulk">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <!-- <input type="hidden" name="_method" value="DELETE"> -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <textarea name="ids" class="checkboxes_field"></textarea>
            <p>Really want to delete these Packages?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
          <button type="submit" class="btn btn-danger" >@lang('common.delete')</button>
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

	<!-- datatable implementing -->
    <script src="code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
    <script src="cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>
	<script>
		$.extend( true, $.fn.dataTable.defaults, {
	         "language": {
	            "info": "Weergaven _START_ naar _END_ van de _TOTAL_ resultaten",
	            'searchPlaceholder': 'Zoeken',
	        }
	    } );

        function datatableCheckbox(id){
            var checkbox = '<input type="checkbox" class="datatable-checkbox" value="'+id+'"/>';
            return checkbox;
        }
        function datatableCheckboxHeader(){
            var checkbox = '<input type="checkbox" class="datatable-checkbox-header"/>';
            return checkbox;
        }
        function controlColumnCheckboxes(el,type){
            if(typeof type === 'undefined')
                type = true;
            var datatable = el.closest('.dataTables_wrapper');
            if(type){
                datatable.find('.datatable-checkbox').prop('checked',true);
            }
            else{
                datatable.find('.datatable-checkbox').prop('checked',false);
            }
        }
        $(document).on('change','.dataTables_wrapper .datatable-checkbox',function(){
            var el = $(this);
            if(!el.is(':checked')){
                var datatable = el.closest('.dataTables_wrapper');
                datatable.find('.datatable-checkbox-header').prop('checked',false);
            }
        });
        $(document).on('change','.dataTables_wrapper .datatable-checkbox-header',function(){
            var el = $(this);
            if(el.is(':checked')){
                controlColumnCheckboxes(el,true);
            }
            else{
                controlColumnCheckboxes(el,false);
            }
        });
		$(document).on('click',".add-status-button", function(){
			// $('#edit-modal').addClass('modal_show_only_add').modal('show');
			var modal = $('#edit-status-modal');
			modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
			modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
			modal.find('.tab-content').find('.tab-pane').removeClass('active');
			modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
			modal.addClass('modal_show_only_add');
		});
		function edit(status_id){
			var url = "{{ route('admin.user_status.show', 'status_id') }}";
			url = url.replace("status_id", status_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					var modal = $('#edit-status-modal');
					modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
					modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
					modal.find('.tab-content').find('.tab-pane').removeClass('active');
					modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
					modal.removeClass('modal_show_only_add').modal('show');
					$('#edit-status-id').val(data['id']);
					$('#edit-status').val(data['status']);
					$('#edit-description').val(data['description']);
					$('#edit-stype').val(data['status_type']);
				}});
		};

		/** Update **/
		$(".update-status-button").click(function(){
			var status_id = $('#edit-status-id').val();
			var url = "{{ route('admin.user_status.update', 'status_id') }}";
			url = url.replace("status_id", status_id);
			// var page_edit_form = $("#page_edit_form");
			// var form_data = page_edit_form.serialize();
			var postData = new FormData($("#status_edit_form")[0]);
			$( '#status-error' ).html( "" );
			$( '#description-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.status){
							$( '#status-error' ).html( data.errors.status[0] );
						}
						if(data.errors.pdescription){
							$( '#description-error' ).html( data.errors.description[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.user_status.index') }}';
					}
				},
			});
		});
		$("#store-status-button").click(function(){
			var postData = new FormData($("#status_add_form")[0]);
			$( '#status-error' ).html( "" );
			$( '#description-error' ).html( "" );
			$.ajax({
				type:'POST',
				url:'{{ route('admin.user_status.store') }}',
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.status){
							$( '#status-error' ).html( data.errors.status[0] );
						}
						if(data.errors.pdescription){
							$( '#description-error' ).html( data.errors.description[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.user_status.index') }}';
					}
				},
			});
		});
		

		/** Delete **/
		function remove(status_id){
			var url = "{{ route('admin.user_status.destroy', 'status_id') }}";
			url = url.replace("status_id", status_id);
			$('#delete-status-modal').modal('show');
			$('#delete_status_form').attr('action', url);
		}
		$(document).on('click','#delete-status-tab-button',function(){
			var id = $('#edit-status-id').val();
			$(this).closest('.modal').modal('hide');
			remove(id);
		});
		function view(id){
			var url = "{{ route('admin.user_status.show', 'id') }}";
			url = url.replace("id", id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					$('#view-status-modal').modal('show');
					$('#view-status-status').text(data['status']);
					$('#view-status-description').text(data['description']);
				}});
		}
	</script>
	<script type="text/javascript">
		(function($) {
		var select_html = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-status-button" data-toggle="modal" data-target="#edit-status-modal"><i class="fa fa-magic"></i> Add Status</button></div>';
		// var select_html = '<div class="pull-right"><span style="width:auto;line-height:2.5;padding:0;"> Status </span> <select class="form-control" >';
		//     select_html+= '<option> Item 1</option>';
		//     select_html+= '<option> Item 2</option>';
		//     select_html+= '<option> Item 3</option>';
		//     select_html+= '</select><span class="hvr-grow-shadow"><i class="fa fa-user"></i> Add User</span></div>';
		'use strict';
		var datatableInitStatus = function() {
			var $table = $('#datatable-tabletools-status');
			var table = $table.dataTable({
		    bDestroy: true,
			ajax: "{{ route('admin.getUserStatusRoute') }}",
			dom: 'Bfrtip',
			buttons: [
				{
                text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                    var el = $(e.target);
                    var modal = $('#delete-status-modal-bulk');
                    var datatable = el.closest('.dataTables_wrapper');
                    var ids = [];
                    datatable.find('.datatable-checkbox').each(function(){
                        var el = $(this);
                        if(el.is(':checked')){
                            ids.push(el.val());
                        }
                    });
                    // console.log(ids,type);
                    modal.find('.checkboxes_field').val(JSON.stringify(ids));
                    modal.modal('show');
                }
            },
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
						{ "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
						{data: 'user_name'},
						{data: 'status'},
                     	{data: 'description'},
                     	{data: 'status_type'},
                     	{data: 'created_at'},
                    	{data: 'updated_at'},
                	    {data: 'action', name: 'action', orderable: false, searchable: false},
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
		$('#datatable-tabletools-status_filter').append(select_html);
	};
	$(function() {
		datatableInitStatus();
		/*$('.nav-link').on('click',function(){
			 datatableInit();
		 });
		*/
	});
}).apply(this, [jQuery]);
 </script>
@endsection
@section('scripts')
@endsection