<?php $__env->startSection('title','Users'); ?>
<?php $__env->startSection('style'); ?>

<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/css/datepicker.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/select2/css/select2.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/datatables/media/css/dataTables.bootstrap4.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />

        <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/pnotify/pnotify.custom.css')); ?>" />
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/chartist/chartist.min.css')); ?>" />
		<!-- Daterangepicker css-->
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/daterangepicker/daterangepicker.css')); ?>" />
		<link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
		<style type="text/css">
		.dataTables_wrapper i {position: relative;top: 3px;}
		.dataTables_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
		.dataTables_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
		.dataTables_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
		.dataTables_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
		.dataTables_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
		.dataTables_wrapper a span{display: block;}
		.dataTables_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
		div#datatable-tabletools_filter {float: left;text-align:right;display:block;width:70%;
			margin: 0 0 30px;}
		div#datatable-tabletools_filter label{ width:40%; float: left;}
		div#datatable-tabletools_filter label input{ height:35px;}
		div#datatable-tabletools_filter select, div#datatable-tabletools_filter span{margin: 0 10px; height:35px; display: inline-block;}
		div#datatable-tabletools_filter select{width:20%;height: 35px;width: 150px;}
				.form-control:not(.form-control-sm):not(.form-control-lg) {
		    font-size: 0.85rem !important;
		    line-height: 0.85 !important;
		    min-height: 0.4rem !important;
		}
		.pac-container.pac-logo{
			z-index: 9999999999999 !important;
		}
		#map {
        height: 500px;
      }
      tr.selected{
      	box-shadow: rgba(0, 0, 0, 0.2) 1px 4px 3px 0px;
      }
      .ui-droppable-hover i{
      		color:#fff !important;
			    text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
      }
      .drop-wrap .droppable {
			    margin: 0;
			    display: block;
			    text-align: center;
			    border-bottom: 1px solid #444;
			    border-top: 1px solid #111;
			    text-shadow: 2px 2px 1px rgba(0,0,0,0.5);
			    -webkit-background-clip: text;
			    -moz-background-clip: text;
			    background-clip: text;
		}		
		.drop-wrap i{
				margin:47px 0;
		        font-size: 36px !important;
		}
		.drop-wrap {
			position: fixed;
		    top: 0px;
		    right: 0px;
		    display: none;
		    width: 300px;
		    background: #333;
		    z-index: 9999;
		    height: 100%;
		}
		.drop-wrap.acc{
			display: block;
		}
		.ui-draggable-dragging{
			font-size: 42px !important;
			font-weight: bold;
		}
		tr.bg-success{
			color:#fff !important;
		}
		/*.edit-user-button,.view-user-button ,.delete-user-button {padding :0 6px 4px 6px}*/
		</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>
	<section role="main" class="content-body">

		<header class="page-header">
			<?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</header>

		<section class="content-header">
		        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
		            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Leden</a></li>
		        </ol>
	   	</section>

		<!-- start: page -->
		<div class="row">
		<?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
			<div class="col">
					<div class="drop-wrap animated slideInRight">
							<div class=" droppable droppable-checkin"><i class="fa fa-archive"> </i>
								<div class="clearfix"></div>
							</div>
							<div class=" droppable droppable-favorite"><i class="fa fa-star"> </i>
								<div class="clearfix"></div>
							</div>
							<div class=" droppable droppable-block"><i class="fa fa-warning "> </i>
								<div class="clearfix"></div>
							</div>
							<div class=" droppable droppable-mail"><i class="fa fa-envelope"> </i>
								<div class="clearfix"></div>
							</div>
							<div class=" droppable droppable-delete"><i class="fa fa-trash"> </i>
								<div class="clearfix"></div>
							</div>
					</div>
				<div class="tabs tabs-dark user-list-block">
					<ul class="nav nav-tabs">
						<li class="nav-item <?php echo e(empty($check_in_tab) ? 'active' : ''); ?>"> 
							<a class="nav-link" href="#popular6" data-toggle="tab" type-data="user">Klantgegevens </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#popular6" data-toggle="tab" type-data="company" >Personeel</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#Kaart" data-toggle="tab" type-data="map" >Kaart</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#Statistieken" data-toggle="tab" type-data="show-chat" >Statistieken</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#popular6" data-toggle="tab" type-data="company" type-data-original="access" >Toegang</a>
						</li>
						<li class="nav-item <?php echo e(!empty($check_in_tab) ? 'active' : ''); ?>">
							<a class="nav-link" href="#popular6" data-toggle="tab" type-data="checkin" type-data-original="checkin">Check-in</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#popular6" data-toggle="tab" type-data="history" type-data-original="history"><?php echo app('translator')->getFromJson('common.history'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#roles1" data-toggle="tab" type-data="functions">Functies</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#roles2" data-toggle="tab" type-data="toegangen">Toegangen</a>
						</li>
						
					</ul>
					<div class="tab-content">
					<!-- tab one -->
						<div id="popular6" class="tab-pane <?php echo e(empty($check_in_tab) ? 'active' : ''); ?>">
							<section class="card">
								<div class="card-body">
									<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
										<thead>
											<!--
											<tr>

												<th>Id</th> (firstname)
												<th>Voornaam</th> (firstname)
												<th>Achternaam</th> (surname)
												<th>Lidmaatschap</th> ((package))
												<th>App</th>
												<th>Spaarhulp</th>
												<th>€</th>
												<th>Lidsinds</th> (starting date)
												<th>Laatste bezoek</th>  (date of last visit)
												<th>Actions</th>

											</tr>
											-->

										</thead>

										<tbody>
										</tbody>

									</table>
								</div>
					        </section>
						</div>
					<!-- tab two -->
						<div id="Kaart" class="tab-pane">
							<section class="card">
								<div class="card-body">
									<div id="map">
									</div>
								</div>
							</section>
						</div>
					<!-- tab three -->
						<div id="Statistieken" class="tab-pane">
							<section class="card">
								<div class="card-body">							<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Totaal leden</button>

									<button type="button" class="mb-1 mt-1 mr-1 btn btn-success">Filiaal bezocht</button>
									<button type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Account ingelogd</button>

									<button type="button" class="mb-1 mt-1 mr-1 btn btn-info">Lid opgezegd</button>

									<button type="button" class="mb-1 mt-1 mr-1 btn btn-warning">Nieuwe leden</button>

								<div id="reportrange">
								    <i class="fa fa-calendar"></i>&nbsp;
								    <span></span> <i class="fa fa-caret-down"></i>
								</div>

									<div id="ChartistSimpleLineChart2" class="ct-chart ct-perfect-fourth ct-golden-section">
									</div>
								</div>
							</section>
						</div>
					<!-- last tab -->
						<div id="roles1" class="tab-pane">
						<section class="card">
							<div class="card-body">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-block', 'users.tab8')): ?>
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools-role"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
									<thead>
										<tr>
                                            <th><input type="checkbox" class="datatable-checkbox-header"/></th>
                                            <th>Functie</th>
                                            <th>Functie omschrijving</th>
                                            <th>Toegevoegd op</th>
                                            <th>Gewijzigd op</th>
                                            <th width="15%">Opties</th>
										</tr>
									</thead>
									<!-- I also want a button “Zoeken”. Here I can search my users. -->
								</table>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-block', 'users.tab8')): ?>
								<b class="text-center">You are unauthorized for this tab.</b>
								<?php endif; ?>
							</div>
				        </section>
					</div>
                    <div id="roles2" class="tab-pane">
                        <section class="card">
                            <div class="card-body">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-block', 'users.tab9')): ?>
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools-permission"  data-plugin-options='{"searchPlaceholder": "Zoeken..."}'>
                                    <thead>
                                        <tr>
                                            <!-- <th>Permission</th>
                                            <th>Permission Description</th>
                                            <th><?php echo app('translator')->getFromJson('common.created_at'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('common.updated_at'); ?></th>
                                            <th width="15%">Action</th> -->

                                            <th><input type="checkbox" class="datatable-checkbox-header"/></th>
                                            <th>Toestemming</th>
                                            <th>Toestemming omschrijving</th>
                                            <th>Toegevoegd op</th>
                                            <th>Bijgewerkt op</th>
                                            <th width="15%">Opties</th>
                                        </tr>
                                    </thead>
                                    <!-- I also want a button “Zoeken”. Here I can search my Permissions. -->
                                </table>
                           		<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-block', 'users.tab9')): ?>
								<b class="text-center">You are unauthorized for this tab.</b>
								<?php endif; ?>
						
                            </div>
                        </section>
                    </div>
					<!-- end all tabs -->
					</div>
				</div>
			</div>
		</div>
		<!-- end: page -->
	</section>


	<!-- Modal Form -->
  	<!-- edit gallery modal -->
			<div id="add-user-modal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

			<div class="modal-dialog modal-lg" role="document">

				<div class="modal-content">

					<div class="modal-header hidden">

		                <h4 class="modal-title">

		                    <span class="fa-stack fa-sm">

		                        <i class="fa fa-square-o fa-stack-2x"></i>

		                        <i class="fa fa-plus fa-stack-1x"></i>

		                    </span>

		                    Add User

		                </h4>

		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

		                    <span aria-hidden="true">×</span></button>

		            </div>

				    <div class="modal-body">



				<div class="col">

					<div class="tabs tabs-dark">

						<ul class="nav nav-tabs">

							<li class="nav-item tab-add">

								<a class="nav-link " href="#add_user" data-toggle="tab">Toevoegen</a>

							</li>

							<li class="nav-item tab-edit active">

								<a class="nav-link" href="#update_user" data-toggle="tab">Wijzigen</a>

							</li>

							<li class="nav-item tab-delete">

								<a class="nav-link" id="delete-user-button"><?php echo app('translator')->getFromJson('common.delete'); ?> </a>

							</li>

						</ul>



						<div class="tab-content">

						<!-- tab form add-->

							<div id="add_user" class="tab-pane tab-add-pane">
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route', 'admin.users.index')): ?>
										<form id="add-user-form" action="post">

								            	<?php echo e(csrf_field()); ?>


										    <div class="form-row">

												<div class="form-group col-md-6">

													<label for="first_name">Voornaam</label>

													<div class="input-group">

														<span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?php echo app('translator')->getFromJson('common.first_name'); ?>">

														

													</div>

													<span class="text-danger role-error"></span>

												</div>

												<div class="form-group col-md-6 mb-3 mb-lg-0">

													<label for="inputPassword4">Achternaam</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<input type="text" class="form-control" id="surname" name="surname" placeholder="<?php echo app('translator')->getFromJson('common.surname'); ?>">

														<span class="text-danger role-error"></span>

													</div>



												</div>

											</div>

											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="email">Email</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-envelope"></i>

														</span>

														<input type="email" class="form-control" id="email" name="email" placeholder="Email">

														<span class="text-danger role-error"></span>

													</div>

													

												</div>

												<div class="form-group col-md-6">

													<label for="inputState">Geslacht</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-mars"></i>

														</span>

														<select name="gender" class="form-control" id="gender" >

															<option value="" disabled selected><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

															<option value="m" >Man</option>

															<option value="f" >Vrouw</option>

														</select>

														<span class="text-danger role-error"></span>

													</div>



												</div>

											</div>

											<div class="form-row">



												<div class="form-group col-md-6">

													<label for="password"><?php echo app('translator')->getFromJson('common.password'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-key"></i>

														</span>

														<input type="password" class="form-control" id="password" name="password" placeholder="<?php echo app('translator')->getFromJson('common.password'); ?>">

														<span class="text-danger role-error"></span>

													</div>





												</div>



												<div class="form-group col-md-6">

													<label for="password"><?php echo app('translator')->getFromJson('common.confirm_password'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-key"></i>

														</span>

														<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="<?php echo app('translator')->getFromJson('common.confirm_password'); ?>">

														<span class="text-danger role-error"></span>

													</div>





												</div>

											</div>

											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="inputZip">Telefoonnummer</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-phone"></i>

														</span>

														<input type="text" name="phone" class="form-control" id="phone" value="" placeholder="<?php echo app('translator')->getFromJson('common.phone_number'); ?>">

														<span class="text-danger role-error"></span>

													</div>





												</div>



												<div class="form-group col-md-6">

													<label for="birthday">Geboortedatum</label>

													<input  type="text" id="userBirthDay" name="birthday" class="form-control" data-plugin-datepicker data-plugin-options='{ "multidate": false }' placeholder="<?php echo app('translator')->getFromJson('common.date_of_birth'); ?>">

													<span class="text-danger role-error"></span>

												</div>

											</div>



											<div class="form-group">

												<div class="row">

													<div class="col-md-6">

														<label for="inputAddressCity"><?php echo app('translator')->getFromJson('common.user_status'); ?></label>

														 <div class="input-group">

															<span class="input-group-addon">

																<i class="fa fa-user"></i>

															</span>

																<select class="form-control" name="user_status" id="user_status">

																 <option value='0' selected><?php echo app('translator')->getFromJson('common.select'); ?></option>

															    <?php $__currentLoopData = $user_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

															    	<option value="<?php echo e($user_status->id); ?>"><?php echo e($user_status->status); ?></option>

															    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

															    </select>

													    </div>



														 

													</div>

													<div class="col-md-6">

														<label for="inputAddressCity">City</label>

														<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-map"></i>

														</span>

														<input type="text" readonly name="city" class="form-control" id="city" value="" placeholder="<?php echo app('translator')->getFromJson('common.city'); ?>">

														<span class="text-danger role-error"></span>

													</div>

														

													</div>

												</div>												

											</div>

											<div class="form-group">

												<label for="inputAddress">Uw adres</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-address-card"></i>

														</span>

														<input type="text" name="address" class="form-control" id="address" value="" placeholder="<?php echo app('translator')->getFromJson('common.address_example'); ?>">

														<span class="text-danger role-error"></span>

													</div>

											</div>

											<input type="hidden" name="latitude" id="latitude" >

											<input type="hidden" name="longitude" id="longitude" >

											<div class="form-row">

												<div class="form-group col-md-4">

													<label for="inputZip">IBAN</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-credit-card"></i>

														</span>

														<input type="text" name="iban" class="form-control" id="iban" value="" placeholder="ex. NL11ABCD1234567890" >

														<span class="text-danger role-error"></span>

													</div>

													

												</div>



												<div class="form-group col-md-4">

													<label for="inputState">Taal</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-language"></i>

														</span>

														<input type="text" name="taal" class="form-control" id="taal" value="" placeholder="ex. Dutch">

														<span class="text-danger role-error"></span>

													</div>



												</div>



												<div class="form-group col-md-4">

													<label for="inputState"><?php echo app('translator')->getFromJson('common.datepicker_placeholder'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-calendar"></i>

														</span>

														<input  type="text" id="klant_sinds" name="klant_sinds" value="" data-plugin-datepicker data-plugin-options='{ "multidate": false }' class="form-control" placeholder="<?php echo app('translator')->getFromJson('common.date_of_birth'); ?>">

														<span class="text-danger role-error"></span>

													</div>



												</div>

											</div>

											<div class="form-group">

												<label for="inputAddress2">Over mezelf</label>

													<textarea name="about" class="form-control" id="about" rows="6" placeholder="<?php echo app('translator')->getFromJson('common.about_me'); ?>" ></textarea>

													<span class="text-danger role-error"></span>

											</div>
											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="role"><?php echo app('translator')->getFromJson('common.role'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<select class="form-control" name="role" id="role">

															<option selected disabled><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

															<option value="admin">Admin</option>

															<option value="user">User</option>

															<option value="company">Company</option>

														</select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>

												<div class="form-group col-md-6">

													<label for="inputState"><?php echo app('translator')->getFromJson('common.activation_status'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<select class="form-control" name="activation_status" id="activation_status">

																<option selected disabled><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

																<option value="1"><?php echo app('translator')->getFromJson('common.active'); ?></option>

																<option value="0"><?php echo app('translator')->getFromJson('common.block'); ?></option>

														    </select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>

											</div>
											<div class="form-row">
												
												<div class="form-group col-md-6">

													<label for="inputState">Company</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-archive"></i>

														</span>
														<select class="form-control" name="company" id="company"  <?php if(Auth::check() && Auth::User()->role_id == 3): ?> disabled <?php endif; ?>>

																<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

															    	<option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>

															    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

														    </select>

														<span class="text-danger company-error"></span>

													</div>

													

												</div>
												<div class="form-group col-md-6">

													<label for="inputState">Package</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-archive"></i>

														</span>

														<select class="form-control" name="packagefk" id="packagefk">


														    </select>

														<span class="text-danger packagefk-error"></span>

													</div>

													

												</div>
											</div>
											
											<div class="form-row">

												<div class="form-group col-md-6">

													<button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('common.submit'); ?></button>

												</div>

											</div>



										</form>
									<?php endif; ?>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.index')): ?>
									<b class="text-center">You are unauthorized for this tab.</b>
									<?php endif; ?>
						
							</div>

						<!-- tab form update -->

							<div id="update_user" class="tab-pane  tab-edit-pane active">
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route','admin.users.index')): ?>
										<form id="update-user-form" action="post">

								            	<?php echo e(csrf_field()); ?>


								            	<?php echo e(method_field('PATCH')); ?>


								            	<input type="hidden" name="id" id="update-id">

										    <div class="form-row">

												<div class="form-group col-md-6">

													<label for="first_name">Voornaam</label>

													<div class="input-group">

														<span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<input type="text" class="form-control" id="update-first_name" name="first_name" placeholder="<?php echo app('translator')->getFromJson('common.first_name'); ?>">

													</div>

													

												</div>

												<div class="form-group col-md-6 mb-3 mb-lg-0">

													<label for="inputPassword4">Achternaam</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<input type="text" class="form-control" id="update-surname" name="surname" placeholder="<?php echo app('translator')->getFromJson('common.surname'); ?>">

										

													</div>

												</div>

											</div>



											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="email">Email</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-envelope"></i>

														</span>

														<input type="email" class="form-control" id="update-email" name="email" placeholder="Email">

													

													</div>

												</div>

												<div class="form-group col-md-6">

													<label for="inputState">Geslacht</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-mars"></i>

														</span>

														<select name="gender" class="form-control" id="update-gender" >

															<option value="" disabled selected><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

															<option value="m" >Man</option>

															<option value="f" >Vrouw</option>

														</select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>

											</div>



											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="inputZip">Telefoonnummer</label>



													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-phone"></i>

														</span>

														<input type="text" name="phone" class="form-control" id="update-phone" value="" placeholder="<?php echo app('translator')->getFromJson('common.phone_number'); ?>">

														<span class="text-danger role-error"></span>

													</div>

													

												</div>



												<div class="form-group col-md-6">

													<label for="inputState">Geboortedatum</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-calendar"></i>

														</span>

														<input  type="text" id="update-birthday" name="birthday" class="form-control" data-plugin-datepicker data-plugin-options='{ "multidate": false }' placeholder="<?php echo app('translator')->getFromJson('common.date_of_birth'); ?>">

														<span class="text-danger role-error"></span>

												</div>

														</div>

													



											</div>

											<div class="form-group">

												<div class="row">

													<div class="col-md-6">

														<label for="inputAddressCity"><?php echo app('translator')->getFromJson('common.user_status'); ?></label>

														<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

															<select class="form-control" name="user_status" id="update-user_status">

															 <option value='0' selected><?php echo app('translator')->getFromJson('common.select'); ?></option>

														    <?php $__currentLoopData = $user_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

														    	<option value="<?php echo e($user_status->id); ?>"><?php echo e($user_status->status); ?></option>

														    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

														    </select>

													</div>



														 

													</div>

													<div class="col-md-6">

														<label for="inputAddress">City</label>



														<div class="input-group">

														   <span class="input-group-addon">

																<i class="fa fa-map"></i>

															</span>

															<input type="text" readonly name="city" class="form-control" id="update-city" value="" placeholder="<?php echo app('translator')->getFromJson('common.city'); ?>">

															<span class="text-danger role-error"></span>

														</div>



															

													</div>

												</div>			

											</div>

											<div class="form-group">

												<label for="inputAddress">Uw adres</label>

												<div class="input-group">

													<span class="input-group-addon">

														<i class="fa fa-address-card"></i>

													</span>

													<input type="text" name="address" class="form-control" id="update-address" value="" placeholder="<?php echo app('translator')->getFromJson('common.address_example'); ?>">

													<span class="text-danger role-error"></span>

												</div>

													

											</div>



											<input type="hidden" name="latitude" id="update-latitude" >

											<input type="hidden" name="longitude" id="update-longitude" >

											



											<div class="form-row">

												<div class="form-group col-md-4">

													<label for="inputZip">IBAN</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-credit-card"></i>

														</span>

														<input type="text" name="iban" class="form-control" id="update-iban" value="" placeholder="ex. NL11ABCD1234567890" >

														<span class="text-danger role-error"></span>

													</div>

													

												</div>



												<div class="form-group col-md-4">

													<label for="inputState">Taal</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-language"></i>

														</span>

														<input type="text" name="taal" class="form-control" id="update-taal" value="" placeholder="ex. Dutch">

														<span class="text-danger role-error"></span>

													</div>

													

												</div>



												<div class="form-group col-md-4">

													<label for="inputState"><?php echo app('translator')->getFromJson('common.datepicker_placeholder'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-calendar"></i>

														</span>

															<input  type="text" id="update-klant_sinds" name="klant_sinds" value="" data-plugin-datepicker data-plugin-options='{ "multidate": false }' class="form-control" placeholder="<?php echo app('translator')->getFromJson('common.date_of_birth'); ?>">

															<span class="text-danger role-error"></span>

														</div>

													

												</div>



											</div>



											<div class="form-group">

												<label for="inputAddress2">Over mezelf</label>

													<textarea name="about" class="form-control" id="update-about" rows="6" placeholder="<?php echo app('translator')->getFromJson('common.about_me'); ?>" ></textarea>

													<span class="text-danger role-error"></span>

											</div>



											<div class="form-row">

												<div class="form-group col-md-6">

													<label for="role"><?php echo app('translator')->getFromJson('common.role'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<select class="form-control" name="role" id="update-role">

															<option selected disabled><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

															<option value="admin">Admin</option>

															<option value="user">User</option>

															<option value="company">Company</option>

														</select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>

												<div class="form-group col-md-6">

													<label for="inputState"><?php echo app('translator')->getFromJson('common.activation_status'); ?></label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-user"></i>

														</span>

														<select class="form-control" name="activation_status" id="update-activation_status">

															<option selected disabled><?php echo app('translator')->getFromJson('common.select_one'); ?></option>

															<option value="1"><?php echo app('translator')->getFromJson('common.active'); ?></option>

															<option value="0"><?php echo app('translator')->getFromJson('common.block'); ?></option>

													    </select>

													<span class="text-danger role-error"></span>

													</div>



												</div>

											</div>

											<div class="form-row">
												<div class="form-group col-md-6">

													<label for="inputState">Company</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-archive"></i>

														</span>

														<select class="form-control" name="company" id="update-company" >

															<?php if(Auth::check() && Auth::User()->role_id == 3): ?>
																<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	
																		<?php if($company->id == Auth::User()->company): ?>

																	    	<option value="<?php echo e($company->id); ?>" selected><?php echo e($company->name); ?></option>

																		<?php endif; ?>

															    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
															<?php else: ?>

																<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>

															    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>

														    </select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>
												<div class="form-group col-md-6">

													<label for="inputState">Package</label>

													<div class="input-group">

													   <span class="input-group-addon">

															<i class="fa fa-archive"></i>

														</span>

														<select class="form-control" name="packagefk" id="update-packagefk">


														    </select>

														<span class="text-danger role-error"></span>

													</div>

													

												</div>
											</div>

											<div class="form-row">

												<div class="form-group col-md-6">

													<button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('common.update'); ?></button>

												</div>

											</div>

										</form>
									<?php endif; ?>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.edit')): ?>
									<b class="text-center">You are unauthorized for this tab.</b>
									<?php endif; ?>
									</div>

							</div>

						</div>

					</div>

				</div>

			</div>



			<footer class="card-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button class="btn btn-default modal-dismiss"><?php echo app('translator')->getFromJson('common.close'); ?></button>
					</div>
				</div>
			</footer>
	     	</div>
		</div>

		<!-- Delete Modal -->
	  <div class="modal fade" id="delete-user-modal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route','admin.users.delete')): ?>
	         <form method="POST" action="" id="delete-user-from">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			    <input type="hidden" name="_method" value="DELETE">
			    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    <p>Really want to delete this profile?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	          <button type="submit" class="btn btn-danger" ><?php echo app('translator')->getFromJson('common.delete'); ?></button>
	        </div>
	        </form>
	        <?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.delete')): ?>
			<b class="text-center">You are unauthorized for this tab.</b>
			<?php endif; ?>
	      </div>
	    </div>
	  </div>

		<!-- Log Delete Modal -->
	  <div class="modal fade" id="delete-log-modal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route','admin.users.delete')): ?>
	         <form method="GET" action="<?php echo e(url('admin/log-remove')); ?>" id="delete-log-from">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    <input type="hidden" name="log_id" id="log_id" value="">
			    <p>Really want to delete this log?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	          <button type="submit" class="btn btn-danger" ><?php echo app('translator')->getFromJson('common.delete'); ?></button>
	        </div>
	        </form>
	        <?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.delete')): ?>
			<b class="text-center">You are unauthorized for this tab.</b>
			<?php endif; ?>
	      </div>
	    </div>
	  </div>

		<!-- Block Modal -->
	  <div class="modal fade" id="block-user-modal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route','admin.users.block')): ?>
	         <form method="POST" action="" id="block-user-from">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			    <input type="hidden" name="_method" value="DELETE">
			    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    <p>Really want to block this profile?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	          <button type="submit" class="btn btn-danger" >Block</button>
	        </div>
	        </form>
	        <?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.block')): ?>
			<b class="text-center">You are unauthorized for this tab.</b>
			<?php endif; ?>
	      </div>
	    </div>
	  </div>
	  <div class="modal fade" id="delete-user-modal-bulk" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('check-route','admin.users.delete')): ?>
	         <form method="POST" action="<?php echo e(route('admin.deleteBulkRequest')); ?>" id="delete-user-from-bulk">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			    <input type="hidden" name="_method" value="DELETE" class="method">
			    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    <textarea name="checkboxes_field" class="checkboxes_field hidden"></textarea>
			    <input name="type" class="type hidden" type="text">
			    <p>Really want to delete these profile?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	          <button type="submit" class="btn btn-danger" ><?php echo app('translator')->getFromJson('common.delete'); ?></button>
	        </div>
	        </form>
	        <?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('check-route', 'admin.users.delete')): ?>
			<b class="text-center">You are unauthorized for this tab.</b>
			<?php endif; ?>
	      </div>
	    </div>
	  </div>
	  <div class="modal fade" id="flash-message" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	        	Confirmation
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			   
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	        </div>
	      </div>
	    </div>
	  </div>
		</section>
<?php echo $__env->make('admin.role.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<!-- /.add page modal -->


<?php $__env->startSection('site_scripts'); ?>
<script src="<?php echo e(asset('admin_files/js/datepicker.js')); ?>"></script>
<?php echo $__env->make('admin.scripts.user_index_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>