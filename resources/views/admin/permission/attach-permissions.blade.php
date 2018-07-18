@extends('layouts.admin_layout')
@section('title','Attach Permission')
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

        #datatable-tabletools-permission_wrapper i {position: relative;top: 3px;}
        #datatable-tabletools-permission_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
        #datatable-tabletools-permission_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
        #datatable-tabletools-permission_wrapper a { border: none; padding: 0; background: transparent;margin:0 5px 0px 0px}
        #datatable-tabletools-permission_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
        #datatable-tabletools-permission_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
        #datatable-tabletools-permission_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
        #datatable-tabletools-permission_wrapper a span{display: block;}
        #datatable-tabletools-permission_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
        div#datatable-tabletools-permission_filter {float: left;text-align:right;display:block;width:70%;
            margin: 0 0 30px;}
        div#datatable-tabletools-permission_filter label{ width:40%; float: left;}
        div#datatable-tabletools-permission_filter label input{ height:35px;}
        div#datatable-tabletools-permission_filter .pull-right{ text-align: right; }
        div#datatable-tabletools-permission_filter select, div#datatable-tabletools-permission_filter span{margin: 0 10px; height:35px; display: inline-block;}
        div#datatable-tabletools-permission_filter select{width:20%;height: 35px;width: 150px;}
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
	    .switch {
		  position: relative;
		  display: inline-block;
		  width: 60px;
		  height: 34px;
		}

		.switch input {display:none;}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 26px;
		  width: 26px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(26px);
		  -ms-transform: translateX(26px);
		  transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		  border-radius: 34px;
		}

		.slider.round:before {
		  border-radius: 50%;
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
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Toegangen</a></li>
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
				<ul class="nav nav-tabs">
					<li class="nav-item ">
						<a class="nav-link" href="#popular7" data-toggle="tab2">Functies</a>
					</li>
				</ul>
				<div class="tab-content">
					<!-- <div id="popular7" class="tab-pane "> -->
						<section class="card">
							<div class="card-body">
								<table class="table table-bordered table-striped mb-0" id="datatable-attachpermission" >
									<thead>
										<tr>
                                            <th>Add/Remove Permission</th>
                                            <th>Functie</th>
                                            <th>Functie omschrijving</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $permission)
										@php($isChecked = attachedPermission($roleId,$permission->id))
										<tr>
											<td>
												<label class="switch">
												  <input type="checkbox" {{$isChecked}} name="permissionsId[]" value="{{$permission->id}}" roleid={{$roleId}} class="permissionCheck">
												  <span class="slider round"></span>
												</label>
											</td>
											<td>{{$permission->permission}}</td>
											<td>{{$permission->pdescription}}</td>
										</tr>
										@endforeach
									</tbody>
									<!-- I also want a button “Zoeken”. Here I can search my users. -->
									
								</table><br>
							</div>
				        </section>
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
    <!-- add page modal -->
<!-- /.role edit permissions -->
</section>
@endsection
@section('site_scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(".permissionCheck").change(function(){
    	var el = $(this);
    	var action = 'remove';
        var permissionVal = el.val();
        var roleVal = el.attr('roleid');
        var userId = '{{Auth::id()}}';
        console.log(userId);
        if(el.is(':checked')){
            action = 'add';
        }
        $.ajax({
                type: "POST",
                url: '{{ route('admin.role.permissions.setP') }}',
                data: { permissionid: permissionVal,roleid:roleVal,action:action,userid:userId,_token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function(data) {
                      console.log(data);
                }
            });
    });
});
</script>
@endsection