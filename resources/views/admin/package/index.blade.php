@extends('layouts.admin_layout')
@section('title','Packages')
@section('style')

<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
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
@endsection
@section('content')

<section role="main" class="content-body">

	<header class="page-header">
		<!-- <h2>Packages</h2> -->
		@include('admin.includes.header')
	</header>

	<section class="content-header">
	        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
	            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-cube active"></i> Lidmaatschappen</a></li>
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

				<ul class="nav nav-tabs">
					<li class="nav-item {{ empty($finance) ? 'active' :'' }}">
						<a class="nav-link" href="#popular6" data-toggle="tab">Package</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#popular5" data-toggle="tab">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ !empty($finance) ? 'active' : '' }}" href="#popular4" 
						data-toggle="tab">Finance</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="popular6" class="tab-pane {{ empty($finance) ? 'active' :'' }}">
						<section class="card">
							<div class="card-body">
								@can ('check-block', 'packages.tab1')
                   				<table class="table table-bordered table-striped mb-0" id="datatable-tabletools"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
									<thead>
										<tr>
											<!-- <th>Service</th>
											<th>Days</th>
											<th>Credits</th>
											<th>Pro Rato</th>
											<th>Start Fee</th>
											<th>Entree</th>
											<th>Enquette</th>
											<th>Sell Category</th>
											<th>Max Users</th>
											<th>Auto Paymentmode</th>
											<th>@lang('common.created_at')</th>
											<th>@lang('common.updated_at')</th>
											<th width="15%">Action</th> -->

											<th><input type="checkbox" class="datatable-checkbox-header"/></th>
											<th>Name</th>
											@if(isAdmin())
											<th>Company Name</th>
											@endif
											<!-- <th>Diensten</th> -->
											<th>Dagen geldig</th>
											<th>Prijs</th>
											<th>Pro Rato</th>
											<th>Opstartkosten</th>
											<th>Toegang</th>
											<th>Enquette</th>
											<th>Verkoop-Categorie</th>
											<th>Max klanten</th>
											<th>Maandelijks incasseren</th>
											<th width="15%">Opties</th>
										</tr>
									</thead>
									<!-- I also want a button �Zoeken�. Here I can search my Packages. -->
								</table>
								@endcan
								@cannot('check-block', 'packages.tab1')
								<b class="text-center">You are unauthorized for this tab.</b>
								@endcannot
							</div>
				        </section>
					</div>
					<div id="popular5" class="tab-pane">
						<section class="card">
							<div class="card-body">
								@can('check-block', 'packages.tab2')
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools-service"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
									<thead>
										<tr>
                                            <!-- <th>Service</th>
                                            <th>Service Description</th>
                                            <th>Service Max Users</th>
                                            <th>Service Price</th>
                                            <th>Service Payment Time</th>
                                            <?php if($user->role == "admin"){?>
                                            <th>Service Provider Company</th>
                                            <?php } ?>
                                            <th>@lang('common.created_at')</th>
                                            <th>@lang('common.updated_at')</th>
                                            <th width="15%">Action</th> -->

                                            <th><input type="checkbox" class="datatable-checkbox-header"/></th>
                                            <th>Diensten</th>
                                            <th>Maximaal gebruikers</th>
                                            <th>Diensten Prijs</th>
                                            <th>Betaaltermijn</th>
                                            <?php if($user->role == "admin"){?>
                                            <th>Bedrijf</th>
                                            <?php } ?>
                                            <th>Toegevoegd op</th>
                                            <th>Bijgewerkt op</th>
                                            <th width="15%">Opties</th>
										</tr>
									</thead>
									<!-- I also want a button “Zoeken”. Here I can search my users. -->
								</table>
								@endcan
								@cannot('check-block', 'packages.tab2')
								<b class="text-center">You are unauthorized for this tab.</b>
								@endcannot
							</div>
				        </section>
					</div>
					<div id="popular4" class="tab-pane {{ !empty($finance) ? 'active' : '' }}">
                        <section class="card">
                            <div class="card-body">
                                @can('check-block', 'packages.tab3')
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools-financieel"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="datatable-checkbox-header"/></th>
											<th>User Name</th>
                                            <th>Package</th>
                                            <th>Invoice Number</th>
                                            <th>Quanity</th>
                                            <th>Total Amount</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
											<th width="15%">Opties</th>
                                        </tr>
                                    </thead>
                                </table>
                                @endcan
								@cannot('check-block', 'packages.tab3')
								<b class="text-center">You are unauthorized for this tab.</b>
								@endcannot
                            </div>
                        </section>
                    </div>
				</div>
			</div>
		</div>
	</div>					
	<!-- end: page -->

	<div id="edit-modal-service" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header hidden">
	                <h4 class="modal-title">
	                    <span class="fa-stack fa-sm">
	                        <i class="fa fa-square-o fa-stack-2x"></i>
	                        <i class="fa fa-plus fa-stack-1x"></i>
	                    </span>
	                    Product toevoegen
	                </h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
	                    <span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <div class="col">
	                    <div class="tabs tabs-dark">
	                        <ul class="nav nav-tabs">
	                            <li class="nav-item tab-add">
	                                <a class="nav-link" href="#add_service_tab_pane" data-toggle="tab">Toevoegen</a>
	                            </li>
	                            <li class="nav-item tab-edit active">
	                                <a class="nav-link" href="#update_service_tab_pane" data-toggle="tab">Wijzigen</a>
	                            </li>
	                            @can('check-route', 'admin.services.delete')
							    <li class="nav-item tab-delete">
	                                <a class="nav-link" id="delete-service-tab-button">@lang('common.delete') </a>
	                            </li>
	                            @endcan
	                        </ul>

	                        <div class="tab-content">
	                            <div id="add_service_tab_pane" class="tab-pane tab-add-pane">
	                            @can('check-route', 'admin.services.add')
	                            	<form service="form" id="service_add_form" method="post" enctype="multipart/form-data">
						                {{ csrf_field() }}
						                <div class="">
						                    <div class="form-group">
						                        <label for="days">Diensten</label>
						                        <input type="text" name="service" class="form-control" id="service" value="{{ old('service') }}" placeholder="ex: Dagen">
						                        <span class="text-danger" id="service-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="sell_category">Omschrijving</label>
						                        <textarea name="sdescription" class="form-control" id="sdescription" placeholder="ex: sdescription">{{ old('sdescription') }}</textarea>
						                        <span class="text-danger" id="sdescription-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Diensten Prijs</label>
						                        <input type="text" name="sprice" class="form-control" id="sprice" value="{{ old('sprice') }}" placeholder="ex: Dagen">
						                        <span class="text-danger" id="sprice-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Maximaal gebruikers</label>
						                        <input type="text" name="user_mass" class="form-control" id="user_mass" value="{{ old('user_mass') }}" placeholder="ex: Dagen">
						                        <span class="text-danger" id="user_mass-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Hoever van tevoren wilt u de credits afschrijven</label>
						                        <input type="text" name="payment_time" class="form-control" id="payment_time" value="{{ old('payment_time') }}" placeholder="ex: Dagen">
						                        <span class="text-danger" id="payment_time-error"></span>
						                    </div>
						                    <?php if($user->role == "admin"){?>
						                    <div class="form-group">
						                        <label for="cname">kies bedrijf</label>
						                        <select class="form-control" name="company_id" id="cname">
						                            <option selected disabled>Select One</option>
						                            @foreach($companys as $c)
						                                <option value="<?php echo $c->id; ?>" 
						                                <?php if( $user->role == $c->id){ echo "selected"; } ?>
						                                ><?php echo $c->company_name; ?></option>
						                            @endforeach
						                        </select>
						                        <span class="text-danger" id="cname-error"></span>
						                    </div>
						                    <?php } ?>
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
						                    <button type="button" class="btn btn-info btn-flat" id="store-button-service">Save changes</button>
						                </div>
						            </form>
						        @endcan
						        @cannot('check-route', 'admin.services.add')
								<b class="text-center">You are unauthorized for this tab.</b>
								@endcannot
	                            </div>
	                            <div id="update_service_tab_pane" class="tab-pane  tab-edit-pane active">
	                                @can('check-route', 'admin.services.edit')
									<form service="form" id="service_edit_form" method="post" enctype="multipart/form-data">
						                {{method_field('PATCH')}}
						                {{csrf_field()}}
						                <input type="hidden" name="service_id" id="edit-service-id">
						                <div class="">
						                    <div class="form-group">
						                        <label for="days">Diensten</label>
						                        <input type="text" name="service" class="form-control" id="edit-service-service" value="">
						                        <span class="text-danger" id="service-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="sell_category">Omschrijving</label>
						                        <textarea name="sdescription" class="form-control" id="edit-sdescription"></textarea>
						                        <span class="text-danger" id="sdescription-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Diensten Prijs</label>
						                        <input type="text" name="sprice" class="form-control" id="edit-sprice" value="">
						                        <span class="text-danger" id="sprice-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Maximaal gebruikers</label>
						                        <input type="text" name="user_mass" class="form-control" id="edit-user_mass" value="">
						                        <span class="text-danger" id="user_mass-error"></span>
						                    </div>
						                    <div class="form-group">
						                        <label for="days">Hoever van tevoren wilt u de credits afschrijven</label>
						                        <input type="text" name="payment_time" class="form-control" id="edit-payment_time" value="">
						                        <span class="text-danger" id="payment_time-error"></span>
						                    </div>
						                    <?php if($user->role == "admin"){?>
						                    <div class="form-group">
						                        <label for="days">kies bedrijf</label>
						                        <select class="form-control" name="company_id" id="edit-cname">
						                            <option selected disabled>Select One</option>
						                            @foreach($companys as $c)
						                                <option value="<?php echo $c->id; ?>" ><?php echo $c->company_name; ?></option>
						                            @endforeach
						                        </select>
						                        <span class="text-danger" id="cname-error"></span>
						                    </div>
						                    <?php } ?>
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
						                    <button type="button" class="btn btn-info btn-flat update-button-service">@lang('common.update')</button>
						                </div>
						            </form>
						            @endcan
							        @cannot('check-route', 'admin.services.edit')
									<b class="text-center">You are unauthorized for this tab.</b>
									@endcannot
		                            
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div id="edit-modal-package" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header hidden">
	                <h4 class="modal-title">
	                    <span class="fa-stack fa-sm">
	                        <i class="fa fa-square-o fa-stack-2x"></i>
	                        <i class="fa fa-plus fa-stack-1x"></i>
	                    </span>
	                    Add Package
	                </h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
	                    <span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <div class="col">
	                    <div class="tabs tabs-dark">
	                        <ul class="nav nav-tabs">
	                            <li class="nav-item tab-add">
	                                <a class="nav-link" href="#add_package_tab_pane" data-toggle="tab">Toevoegen</a>
	                            </li>
	                            <li class="nav-item tab-edit active">
	                                <a class="nav-link" href="#update_package_tab_pane" data-toggle="tab">Wijzigen</a>
	                            </li>
	                            @cannot('check-route', 'admin.packages.delete')
							    <li class="nav-item tab-delete">
	                                <a class="nav-link" id="delete-package-tab-button">@lang('common.delete') </a>
	                            </li>
	                            @endcan
	                        </ul>

	                        <div class="tab-content">
	                            <div id="add_package_tab_pane" class="tab-pane tab-add-pane">
	                            	@can('check-route', 'admin.packages.add')
									<form role="form" id="package_add_form" method="post" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="">
													@if(isAdmin())
											<div class="row">	
												<div class="form-group col-md-6">
						                           <label for="name">Company</label>
						                           <div class="input-group">
						                                <span class="input-group-addon">
						                                    <i class="fa fa-building"></i>
						                                </span>
						                                <select name="company_id" class="form-control" id="company_id">
						                                    @foreach($companys as $c)
						                                        <option value="{{$c->id}}"
						                                        >{{$c->company_name}}</option>
						                                    @endforeach
						                                </select>
						                           		<span class="text-danger" id="company_id-error"></span>
						                            </div>
						                        </div>
						                	</div>
						                        @endif
										
											<div class="row">	
												<div class="form-group col-md-6">
													<label>Name</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input class="form-control" name="name" id="name">
													</div>
													<span class="text-danger" id="name-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label>@lang('common.services_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<select class="form-control" name="service[]" id="service" multiple="multiple" data-plugin-multiselect data-plugin-options='{ "maxHeight": 200 }'>
															<option selected disabled>Select One</option>
															@foreach($services as $service)
															<option value="{{ $service->id }}">{{ $service->service }}</option>
															@endforeach
														</select>
													</div>
													<span class="text-danger" id="service-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label>@lang('common.role_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<select class="form-control" name="role_id" id="role_id">
															<option selected disabled>Select One</option>
															@foreach($roles as $role)
															<option value="{{ $role->id }}">{{ $role->role }}</option>
															@endforeach
														</select>
													</div>
													<span class="text-danger" id="role_id-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="days">
													@lang('common.valid_days_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil"></i>
														</span>
														<input type="text" name="days" class="form-control" id="days" value="{{ old('days') }}" placeholder="@lang('common.days_plchldr')">
													</div>
													<span class="text-danger" id="days-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="credits">@lang('common.price_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-money"></i>
														</span>
														<input type="text" name="credits" class="form-control" id="credits" value="{{ old('credits') }}" placeholder="@lang('common.enter_price')">
													</div>
													<span class="text-danger" id="credits-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="pro_rato">@lang('common.pro_rato_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-mars"></i>
														</span>
														<input type="text" name="pro_rato" class="form-control" id="pro_rato" value="{{ old('pro_rato') }}" placeholder="@lang('common.pro_rato_plchldr')">
													</div>
													<span class="text-danger" id="pro_rato-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label>@lang('common.auto_payment_mode_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-mars"></i>
														</span>
														<select class="form-control" name="expand_automatically" id="expand_automatically">
															<option selected disabled>Select One</option>
															<option value="1">@lang('common.package_active')</option>
															<option value="0">@lang('common.package_in_active')</option>
														</select>
													</div>
													<span class="text-danger" id="expand_automatically-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="Start_fee">@lang('common.opstartkosten_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-address-book-o"></i>
														</span>
														<input type="text" name="Start_fee" class="form-control" id="Start_fee" value="{{ old('Start_fee') }}" placeholder="@lang('common.opstartkosten_plchldr')">
													</div>
													<span class="text-danger" id="Start_fee-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="entree">@lang('common.toegang_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<input type="text" name="entree" class="form-control" id="entree" value="{{ old('entree') }}" placeholder="@lang('common.toegang_plchldr')">
													</div>
													<span class="text-danger" id="entree-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="enquette">Enquette</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil-square-o"></i>
														</span>
														<input type="text" name="enquette" class="form-control" id="enquette" value="{{ old('enquette') }}" placeholder="ex: Enquette">
													</div>
													<span class="text-danger" id="enquette-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="max_users">Max klanten</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input type="text" name="max_users" class="form-control" id="max_users" value="{{ old('max_users') }}" placeholder="ex: Max Users">
													</div>
													<span class="text-danger" id="max_users-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="sell_category">Verkoop-Categorie</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil"></i>
														</span>
														<input name="sell_category" class="form-control" id="sell_category" placeholder="ex: sell_category" value="{{ old('sell_category') }}">
													</div>
													<span class="text-danger" id="sell_category-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="payment_days">@lang('common.payment_date')</label>

													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" value="" data-plugin-datepicker data-plugin-options='{ "multidate": true }' class="form-control" id="payment_days" name="payment_days" >
													</div>
												</div>
											</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
											<button type="button" class="btn btn-info btn-flat" id="store-button">Save changes</button>
										</div>
									</form>
									@endcan
							        @cannot('check-route', 'admin.packages.add')
									<b class="text-center">You are unauthorized for this tab.</b>
									@endcannot
	                            </div>
	                            <div id="update_package_tab_pane" class="tab-pane  tab-edit-pane active">
	                                @can('check-route', 'admin.packages.edit')
									<form role="form" id="package_edit_form" method="post" enctype="multipart/form-data">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="package_id" id="edit-package-id">
										<div class="">
											@if(isAdmin())
												<div class="form-group col-md-6">
						                    <div class="row">
											       <label for="name">Company</label>
						                           <div class="input-group">
						                                <span class="input-group-addon">
						                                    <i class="fa fa-building"></i>
						                                </span>
						                                <select name="company_id" class="form-control" id="edit-company_id">
						                                    @foreach($companys as $c)
						                                        <option value="{{$c->id}}"
						                                        >{{$c->company_name}}</option>
						                                    @endforeach
						                                </select>
						                           
						                            </div>
						                            <span class="text-danger" id="edit-company_id-error"></span>
						                        </div>
						                    </div>
						                        @endif
												
											<div class="row">
												<div class="form-group col-md-6">
													<label>Name</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input class="form-control" name="name" id="edit-name">
													</div>
													<span class="text-danger" id="edit-name-error"></span>
												</div>
												
												<div class="form-group col-md-6">
													<label>@lang('common.services_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<select class="form-control"  name="service[]" id="edit-service" multiple="multiple" data-plugin-multiselect data-plugin-options='{ "maxHeight": 200 }'>
															<option selected disabled>Select One</option>
															@foreach($services as $service)
															<option value="{{ $service->id }}">{{ $service->service }}</option>
															@endforeach
														</select>
													</div>
													<span class="text-danger" id="edit-service-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label>@lang('common.role_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<select class="form-control" name="role_id" id="edit-role_id">
															<option selected disabled>Select One</option>
															@foreach($roles as $role)
															<option value="{{ $role->id }}">{{ $role->role }}</option>
															@endforeach
														</select>
													</div>
													<span class="text-danger" id="edit-role_id-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="days">@lang('common.valid_days_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil"></i>
														</span>
														<input type="text" name="days" class="form-control" id="edit-days" value="" placeholder="@lang('common.days_plchldr')">
													</div>
													<span class="text-danger" id="edit-days-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="credits">@lang('common.price_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-money"></i>
														</span>
														<input type="text" name="credits" class="form-control" id="edit-credits" value="" placeholder="@lang('common.enter_price')enter_price">
													</div>
													<span class="text-danger" id="edit-credits-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="pro_rato">@lang('common.pro_rato_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-mars"></i>
														</span>
														<input type="text" name="pro_rato" class="form-control" id="edit-pro_rato" value="" placeholder="@lang('common.pro_rato_plchldr')">
													</div>
													<span class="text-danger" id="edit-pro_rato-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label>@lang('common.auto_payment_mode_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-mars"></i>
														</span>
														<select class="form-control" name="expand_automatically" id="edit-expand_automatically">
															<option selected disabled>Select One</option>
															<option value="1">@lang('common.package_active')</option>
															<option value="0">@lang('common.package_in_active')</option>
														</select>
													</div>
													<span class="text-danger" id="edit-expand_automatically-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="Start_fee">@lang('common.opstartkosten_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-address-book-o"></i>
														</span>
														<input type="text" name="Start_fee" class="form-control" id="edit-Start_fee" value="" placeholder="@lang('common.opstartkosten_plchldr')">
													</div>
													<span class="text-danger" id="edit-Start_fee-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="entree">@lang('common.toegang_label')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-send-o"></i>
														</span>
														<input type="text" name="entree" class="form-control" id="edit-entree" value="" placeholder="@lang('common.toegang_plchldr')">
													</div>
													<span class="text-danger" id="edit-entree-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="enquette">Enquette</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil-square-o"></i>
														</span>
														<input type="text" name="enquette" class="form-control" id="edit-enquette" value="" placeholder="ex: Enquette">
													</div>
													<span class="text-danger" id="edit-enquette-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="max_users">Max Uses</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input type="text" name="max_users" class="form-control" id="edit-max_users" value="" placeholder="ex: Max Users">
													</div>
													<span class="text-danger" id="edit-max_users-error"></span>
												</div>
												<div class="form-group col-md-6">
													<label for="sell_category">Verkoop-Categorie</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-pencil"></i>
														</span>
														<input name="sell_category" class="form-control" id="edit-sell_category" placeholder="ex: sell_category"/>
													</div>
													<span class="text-danger" id="edit-sell_category-error"></span>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label for="payment_days">@lang('common.payment_date')</label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" value="" data-plugin-datepicker data-plugin-options='{ "multidate": true }' class="form-control" id="edit-payment_days" name="payment_days" >
													</div>
													<span class="text-danger" id="edit-payment_days-error"></span>
												</div>
											</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
											<button type="button" class="btn btn-info btn-flat update-button-package">@lang('common.update')</button>
										</div>
									</form>
									@endcan
							        @cannot('check-route', 'admin.packages.edit')
									<b class="text-center">You are unauthorized for this tab.</b>
									@endcannot
	                            
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- start delete-model-package  -->
	@can('check-route', 'admin.packages.delete')
	<div id="delete-modal-package" class="modal modal-danger fade" id="modal-danger">
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
					<form method="post" role="form" id="delete_form">
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
	@endcan
	<!-- end delete-model-package  -->

	<!-- start delete-model-service  -->
	@can('check-route', 'admin.services.delete')
	<div id="delete-modal-service" class="modal modal-danger fade" id="modal-danger">
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
	                <form method="post" service="form" id="delete_form_service">
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
	@endcan
	<!-- end delete-model-service  -->

	<!-- start view-model-package  -->
	@can('check-block', 'packages.tab1')
	<div id="view-modal-package" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
								<td>Name</td>
								<td id="view-name"></td>
							</tr>
							<tr>
								<td>Diensten</td>
								<td id="view-service"></td>
							</tr>
							<tr>
								<td>Dagen geldig</td>
								<td id="view-days"></td>
							</tr>
							<tr>
								<td>Prijs</td>
								<td id="view-credits"></td>
							</tr>
							<tr>
								<td>Pro Rato</td>
								<td id="view-pro_rato"></td>
							</tr>
							<tr>
								<td>Opstartkosten</td>
								<td id="view-Start_fee"></td>
							</tr>
							<tr>
								<td>Toegang</td>
								<td id="view-entree"></td>
							</tr>
							<tr>
								<td>Enquette</td>
								<td id="view-enquette"></td>
							</tr>
							<tr>
								<td>Max klanten</td>
								<td id="view-max_users"></td>
							</tr>
							<tr>
								<td>Role</td>
								<td id="view-role_id"></td>
							</tr>
							<tr>
								<td>Verkoop-Categorie</td>
								<td id="view-sell_category"></td>
							</tr>
							<tr>
								<td>Payment days</td>
								<td id="view-payment_days"></td>
							</tr>
							<tr>
								<td>Auto Payment Mode</td>
								<td id="view-expand_automatically"></td>
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
	@endcan
	<!-- end view-model-package  -->

	<!-- start view-model-service  -->
	@can ('check-block', 'packages.tab2')
    <div id="view-modal-service" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" service="dialog" aria-labelledby="myLargeModalLabel">
	    <div class="modal-dialog modal-lg" service="document">
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
	                            <td>Diensten</td>
	                            <td id="view-service-service"></td>
	                        </tr>
	                        <tr>
	                            <td>Omschrijving</td>
	                            <td id="view-sdescription"></td>
	                        </tr>
	                        <tr>
	                            <td>Diensten Prijs</td>
	                            <td id="view-sprice"></td>
	                        </tr>
	                        <tr>
	                            <td>Maximaal gebruikers</td>
	                            <td id="view-user_mass"></td>
	                        </tr>
	                        <tr>
	                            <td>Betaaltermijn</td>
	                            <td id="view-payment_time"></td>
	                        </tr>
	                        <?php if($user->role == "admin"){?>
	                        <tr>
	                            <td>kies bedrijf</td>
	                            <td id="view-cname"></td>
	                        </tr>
	                        <?php } ?>
	                        <tr>
                                <td>Live Service Link</td>
                                <td id="view-live_service_link"></td>
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
	@endcan
	<!-- end view-model-service  -->


	@can ('check-route', 'admin.services.delete')
    <div class="modal fade bulk-delete-modal" id="delete-service-modal-bulk" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
             <form method="GET" action="{{ url('admin/bulk-delete/services')}}" id="delete-service-form-bulk">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea name="ids" class="checkboxes_field"></textarea>
                <p>Really want to delete these Services?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
              <button type="submit" class="btn btn-danger" >@lang('common.delete')</button>
            </div>
            </form>
          </div>
        </div>
    </div>
    @endcan
    @can ('check-route', 'admin.packages.delete')
    <div class="modal fade bulk-delete-modal" id="delete-package-modal-bulk" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
             <form method="GET" action="{{ url('admin/bulk-delete/packages')}}" id="delete-package-form-bulk">
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
    @endcan
</section>
@endsection
@section('site_scripts') 
	<!-- Specific Page Vendor -->
	
		<script src="{{ asset('admin_files/vendor/select2/js/select2.js')}}"></script>
	
	<script type="text/javascript" src="{{ asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
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
		$(document).on('click',".add-package-button", function(){
            var modal = $('#edit-modal-package');
            modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
            modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
            modal.find('.tab-content').find('.tab-pane').removeClass('active');
            modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
            modal.addClass('modal_show_only_add');
        });
		$(document).on('click',".add-service-button", function(){
            var modal = $('#edit-modal-service');
            modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
            modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
            modal.find('.tab-content').find('.tab-pane').removeClass('active');
            modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
            modal.addClass('modal_show_only_add');
        });
		function remove(package_id){
			var url = "{{ route('admin.packages.destroy', 'package_id') }}";
			url = url.replace("package_id", package_id);
			$('#delete-modal-package').modal('show');
			$('#delete_form').attr('action', url);
		}

		$(document).on('click','#delete-package-tab-button',function(){
            var id = $('#edit-package-id').val();
            $(this).closest('.modal').modal('hide');
            remove(id);
        });

		function remove_service(service_id){
            var url = "{{ route('admin.services.destroy', 'service_id') }}";
            url = url.replace("service_id", service_id);
            $('#delete-modal-service').modal('show');
            $('#delete_form_service').attr('action', url);
        }

		$(document).on('click','#delete-service-tab-button',function(){
            var id = $('#edit-service-id').val();
            $(this).closest('.modal').modal('hide');
            remove_service(id);
        });

		function view(id){
			var url = "{{ route('admin.packages.show', 'id') }}";
			url = url.replace("id", id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					$('#view-modal-package').modal('show');
					$('#view-name').text(data['name']);
					$('#view-service').text(data['service']);
					$('#view-role_id').text(data['role']);
					$('#view-days').text(data['days']);
					$('#view-credits').text(data['credits']);
					$('#view-pro_rato').text(data['pro_rato']);
					$('#view-Start_fee').text(data['Start_fee']);
					$('#view-entree').text(data['entree']);
					$('#view-enquette').text(data['enquette']);
					$('#view-max_users').text(data['max_users']);
					$('#view-sell_category').text(data['sell_category']);
					var date = data['payment_days'].replace(/,/g, ',\n');
					$('#view-payment_days').text(date);
					if(data['expand_automatically'] == 0){
						$('#view-expand_automatically').text('Inactive');
					}
					if(data['expand_automatically'] == 1){
						$('#view-expand_automatically').text('Active');
					}
				}
			});
		}

		function view_service(id){
            var url = "{{ route('admin.services.show', 'id') }}";
            url = url.replace("id", id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                $('#view-modal-service').modal('show');
                $('#view-service-service').text(data['service']);
                $('#view-sdescription').text(data['sdescription']);
                $('#view-user_mass').text(data['user_mass']);
                $('#view-sprice').text(data['sprice']);
                $('#view-payment_time').text(data['payment_time']);
                $('#view-live_service_link').html('<a target="new" href="'+BASE_URL+'/services/'+data['id']+'">Link</a>');
                <?php if($user->role == "admin"){?>
                $('#view-cname').text(data['cname']);
                <?php }?>
            }});
        }

		$(".update-button-package").click(function(){
			var package_id = $('#edit-package-id').val();
			var url = "{{ route('admin.packages.update', 'package_id') }}";
			url = url.replace("package_id", package_id);
			// var page_edit_form = $("#page_edit_form");
			// var form_data = page_edit_form.serialize();
			var postData = new FormData($("#package_edit_form")[0]);
			$( '#edit-service-error' ).html( "" );
			$( '#edit-name-error' ).html( "" );
			$( '#edit-days-error' ).html( "" );
			$( '#edit-credits-error' ).html( "" );
			$( '#edit-pro_rato-error' ).html( "" );
			$( '#edit-expand_automatically-error' ).html( "" );
			$( '#edit-entree-error' ).html( "" );
			$( '#edit-Start_fee-error' ).html( "" );
			$( '#edit-sell_category-error' ).html( "" );
			$( '#edit-enquette-error' ).html( "" );
			$( '#edit-payment_days' ).html( "" );
			$( '#edit-max_users' ).html( "" );
			$( '#edit-role_id' ).html( "" );
			$( '#edit-company_id-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.name){
							$( '#edit-name-error' ).html( data.errors.name[0] );
						}
						if(data.errors.service){
							$( '#edit-service-error' ).html( data.errors.service[0] );
						}
						if(data.errors.days){
							$( '#edit-days-error' ).html( data.errors.days[0] );
						}
						if(data.errors.credits){
							$( '#edit-credits-error' ).html( data.errors.credits[0] );
						}
						if(data.errors.company_id){
							$( '#edit-company_id-error' ).html( data.errors.company_id[0] );
						}
						if(data.errors.pro_rato){
							$( '#edit-pro_rato-error' ).html( data.errors.pro_rato[0] );
						}
						if(data.errors.expand_automatically){
							$( '#edit-expand_automatically-error' ).html( data.errors.expand_automatically[0] );
						}
						if(data.errors.entree){
							$( '#edit-entree-error' ).html( data.errors.entree[0] );
						}
						if(data.errors.Start_fee){
							$( '#edit-Start_fee-error' ).html( data.errors.Start_fee[0] );
						}
						if(data.errors.sell_category){
							$( '#edit-sell_category-error' ).html( data.errors.sell_category[0] );
						}
						if(data.errors.enquette){
							$( '#edit-enquette-error' ).html( data.errors.enquette[0] );
						}
						if(data.errors.max_users){
							$( '#edit-max_users-error' ).html( data.errors.max_users[0] );
						}
						if(data.errors.role_id){
							$( '#edit-role_id-error' ).html( data.errors.role_id[0] );
						}
						if(data.errors.payment_days){
							$( '#edit-payment_days-error' ).html( data.errors.payment_days[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.packages.index') }}';
					}
				},
			});
		});

		$(".update-button-service").click(function(){
            var service_id = $('#edit-service-id').val();
            var url = "{{ route('admin.services.update', 'service_id') }}";
            url = url.replace("service_id", service_id);
            var postData = new FormData($("#service_edit_form")[0]);
            $('#service-error').html("");
            $('#sdescription-error').html("");
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.service){
                            $('#service-error').html(data.errors.service[0]);
                        }
                        if (data.errors.sdescription){
                            $('#sdescription-error').html(data.errors.sdescription[0]);
                        }
                        if (data.errors.user_mass){
                            $('#user_mass-error').html(data.errors.user_mass[0]);
                        }
                        if (data.errors.sprice){
                            $('#sprice-error').html(data.errors.sprice[0]);
                        }
                        if (data.errors.payment_time){
                            $('#payment_time-error').html(data.errors.payment_time[0]);
                        }
                        <?php if($user->role == "admin"){?>
                        if (data.errors.cname){
                            $('#cname-error').html(data.errors.cname[0]);
                        }
                        <?php }?>
                    }
                    if (data.success) {
                        window.location.href = '{{ route('admin.services.index') }}';
                    }
                },
            });
        });

		function edit(package_id) {
			var url = "{{ route('admin.packages.show', 'package_id') }}";
			url = url.replace("package_id", package_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					var modal = $('#edit-modal-package');
                    modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
                    modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
                    modal.find('.tab-content').find('.tab-pane').removeClass('active');
                    modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
                    modal.removeClass('modal_show_only_add').modal('show');
					$('#edit-package-id').val(data['id']);
					$('#edit-name').val(data['name']);
					$('#edit-service').val(data['services_all']);
					$('#edit-days').val(data['days']);
					$('#edit-credits').val(data['credits']);
					$('#edit-company_id').val(data['company_id']);
					$('#edit-pro_rato').val(data['pro_rato']);
					$('#edit-Start_fee').val(data['Start_fee']);
					$('#edit-entree').val(data['entree']);
					$('#edit-enquette').val(data['enquette']);
					$('#edit-sell_category').val(data['sell_category']);
					$('#edit-expand_automatically').val(data['expand_automatically']);
					$('#edit-payment_days').val(data['payment_days']);
					$('#edit-role_id').val(data['role_id']);
					$('#edit-max_users').val(data['max_users']);
					$('#edit-service').multiselect("refresh");
					
				}});
		}

		function edit_service(service_id){
            var url = "{{ route('admin.services.show', 'service_id') }}";
            url = url.replace("service_id", service_id);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success:function(data){
                    var modal = $('#edit-modal-service');
                    modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
                    modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
                    modal.find('.tab-content').find('.tab-pane').removeClass('active');
                    modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
                    modal.removeClass('modal_show_only_add').modal('show');
                    $('#edit-service-id').val(data['id']);
                    $('#edit-service-service').val(data['service']);
                    $('#edit-sdescription').val(data['sdescription']);
                    $('#edit-user_mass').val(data['user_mass']);
                    $('#edit-sprice').val(data['sprice']);
                    $('#edit-payment_time').val(data['payment_time']);
                    <?php if($user->role == "admin"){?>
                        $('#edit-cname').val(data['cname']);
                    <?php }?>
            }});
        }
</script>
<script type="text/javascript">
 	(function($) {
var select_html = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-package-button" data-toggle="modal" data-target="#edit-modal-package"><i class="fa fa-cube"></i> Add Package</button></div>';
// var select_html = '<div class="pull-right"><span style="width:auto;line-height:2.5;padding:0;"> Status </span> <select class="form-control" >';
//     select_html+= '<option> Item 1</option>';
//     select_html+= '<option> Item 2</option>';
//     select_html+= '<option> Item 3</option>';
//     select_html+= '</select><span class="hvr-grow-shadow"><i class="fa fa-user"></i> Add User</span></div>';
	'use strict';
	var datatableInit_package = function() {
		var $table = $('#datatable-tabletools');
		var table = $table.dataTable({
		    bDestroy: true,
			ajax: "{{ route('admin.getPackagesRoute') }}",
			dom: 'Bfrtip',
			buttons: [
            {
                text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                    var el = $(e.target);
                    var modal = $('#delete-package-modal-bulk');
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
					{data: 'name'},
					@if(isAdmin())
                    {data: 'company_name'},
                    @endif
                    //{data: 'service'},
                    {data: 'days'},
                    {data: 'credits'},
                    {data: 'pro_rato'},
                    {data: 'Start_fee'},
                    {data: 'entree'},
                    {data: 'enquette'},
                    {data: 'sell_category'},
					{data: 'max_users'},
				 	{data: 'eauto'},
                    // {data: 'created_at'},
                    // {data: 'updated_at'},
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
		$('#datatable-tabletools_filter').append(select_html);
	};
	$("#store-button").click(function(){
		var postData = new FormData($("#package_add_form")[0]);
		$( '#name-error' ).html( "" );
		$( '#company_id-error' ).html( "" );
		$( '#service-error' ).html( "" );
		$( '#days-error' ).html( "" );
		$( '#credits-error' ).html( "" );
		$( '#pro_rato-error' ).html( "" );
		$( '#expand_automatically-error' ).html( "" );
		$( '#entree-error' ).html( "" );
		$( '#Start_fee-error' ).html( "" );
		$( '#sell_category-error' ).html( "" );
		$( '#enquette-error' ).html( "" );
		$( '#max_uses-error' ).html( "" );
		$( '#role_id-error' ).html( "" );
		$.ajax({
			type:'POST',
			url:'{{ route('admin.packages.store') }}',
			processData: false,
			contentType: false,
			data : postData,
			success:function(data) {
				console.log(data);
				if(data.errors) {
					if(data.errors.name){
						$( '#name-error' ).html( data.errors.name[0] );
					}
					if(data.errors.service){
						$( '#service-error' ).html( data.errors.service[0] );
					}
					if(data.errors.days){
						$( '#days-error' ).html( data.errors.days[0] );
					}
					if(data.errors.credits){
						$( '#credits-error' ).html( data.errors.credits[0] );
					}
					if(data.errors.pro_rato){
						$( '#pro_rato-error' ).html( data.errors.pro_rato[0] );
					}
					if(data.errors.company_id){
						$( '#company_id-error' ).html( data.errors.company_id[0] );
					}								
		
					if(data.errors.expand_automatically){
						$( '#expand_automatically-error' ).html( data.errors.expand_automatically[0] );
					}
					if(data.errors.entree){
						$( '#entree-error' ).html( data.errors.entree[0] );
					}
					if(data.errors.Start_fee){
						$( '#Start_fee-error' ).html( data.errors.Start_fee[0] );
					}
					if(data.errors.sell_category){
						$( '#sell_category-error' ).html( data.errors.sell_category[0] );
					}
					if(data.errors.enquette){
						$( '#enquette-error' ).html( data.errors.enquette[0] );
					}
					if(data.errors.role_id){
						$( '#role_id-error' ).html( data.errors.role_id[0] );
					}
					if(data.errors.max_users){
						$( '#max_users-error' ).html( data.errors.max_users[0] );
					}
				}
				if(data.success) {
					window.location.href = '{{ route('admin.packages.index') }}';
				}
			},
		});
	});

	$("#store-button-service").click(function(){
        var postData = new FormData($("#service_add_form")[0]);
        $('#service-error').html("");
        $('#sdescription-error').html("");
        $.ajax({
            type:'POST',
            url:'{{ route('admin.services.store') }}',
            processData: false,
            contentType: false,
            data : postData,
            success:function(data) {
                console.log(data);
                if (data.errors) {
                    if (data.errors.service){
                        $('#service-error').html(data.errors.service[0]);
                    }
                    if (data.errors.sdescription){
                        $('#sdescription-error').html(data.errors.sdescription[0]);
                    }
                    if (data.errors.user_mass){
                        $('#user_mass-error').html(data.errors.user_mass[0]);
                    }
                    if (data.errors.sprice){
                        $('#sprice-error').html(data.errors.sprice[0]);
                    }
                    if (data.errors.payment_time){
                        $('#payment_time-error').html(data.errors.payment_time[0]);
                    }
                    <?php if($user->role == "admin"){?>
                    if (data.errors.cname){
                        $('#cname-error').html(data.errors.cname[0]);
                    }
                    <?php }?>
                }
                if (data.success) {
                    window.location.href = '{{ route('admin.services.index') }}';
                }
            },
        });
    });

	// start service function
	var select_html_service = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-service-button" data-toggle="modal" data-target="#edit-modal-service"><i class="fa fa-object-group"></i> Product toevoegen</button></div>';
        // var select_html_service = '<div class="pull-right"><span style="width:auto;line-height:2.5;padding:0;"> Status </span> <select class="form-control" >';
        //     select_html_service+= '<option> Item 1</option>';
        //     select_html_service+= '<option> Item 2</option>';
        //     select_html_service+= '<option> Item 3</option>';
        //     select_html_service+= '</select><span class="hvr-grow-shadow"><i class="fa fa-user"></i> Add User</span></div>';
	var datatableInit_service = function() {
		var $table = $('#datatable-tabletools-service');
		var table = $table.dataTable({
		    bDestroy: true,
			ajax: "{{ route('admin.getServicesRoute') }}",
			dom: 'Bfrtip',
			buttons: [
            {
                text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                    var el = $(e.target);
                    var modal = $('#delete-service-modal-bulk');
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
			            { "data": "service" },
                        { "data": "user_mass" },
                        { "data": "sprice" },
                        { "data": "payment_time" },
                        <?php if($user->role == "admin"){?>
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
	
	var datatableInit_finance = function(){
		var $table = $('#datatable-tabletools-financieel');
			var table = $table.dataTable({
				bDestroy: true,
				ajax: "{{ route('admin.getInvoiceRoute') }}",
				dom: 'Bfrtip',
				buttons: [
				{
					text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
					titleAttr:'Delete',
					action: function(e, dt, node, config){
						var el = $(e.target);
						var modal = $('#delete-service-modal-bulk');
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
							{ "data": "user_id" },
							{ "data": "package_id" },
							{ "data": "invoice_number" },
							{ "data": "quantity" },
							{ "data": "total_amount" },
							{ "data": "invoice_date" },
							{ "data": "due_date" },
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
			
	};		
	$(function() {
		datatableInit_package();
		datatableInit_service();
		datatableInit_finance();
	});
	// end service function

}).apply(this, [jQuery]);
</script>
@endsection
@section('script')

<script src="{{ asset('admin_files/js/datepicker.js') }}"></script>
<script>		  
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})
(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42715764-8', 'auto');
ga('send', 'pageview');
</script>
@endsection