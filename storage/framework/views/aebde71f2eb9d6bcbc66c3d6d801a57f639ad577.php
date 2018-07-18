<?php $__env->startSection('title','Companies'); ?>

<?php $__env->startSection('style'); ?>

<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />

<style>
    .top-tabs ul.simple-card-list{ width: 100%; float: left; display: block; }
    .top-tabs ul.simple-card-list li{ width:31.3%; float: left; margin: 0 1%; }
    .user-info-block li span{ float: right; text-transform: capitalize; }
    .bdays-cus-width{width:80px;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="content-body">

                    <header class="page-header">
                        <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </header>

                    <section class="content-header">
                        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Company</a></li>
                        </ol>
                    </section>
                    <!-- start: page -->
                    <input type="file" id="fi" style="display: none;">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">
                            <section class="card">
                                <div class="card-body">
                                    <div class="thumb-info mb-3" style="position: relative;">
                                    <i class="fa fa-edit fa-stack-1x icon-edit" onclick="uploadImage(this)" style="text-align: right;color: white;font-size: 20px;" data-id="<?php echo e($company->id); ?>" data-block_id="avatar"></i>
                                    <?php if(!empty($company->logo)): ?>
                                        <img src="<?php echo e(asset('site_images/')); ?>/<?php echo e($company->logo); ?>" class="rounded img-fluid" id="avatar" alt="<?php echo e($company->first_name .' '. $company->surname); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('admin_files/img/!logged-user.jpg')); ?>" class="rounded img-fluid" id="avatar" alt="image">

                                    <?php endif; ?>
                                        <div class="thumb-info-title">
                                            <span class="thumb-info-inner"><?php echo e($company->first_name); ?> <?php echo e($company->surname); ?></span>
                                            <span class="thumb-info-type">CEO</span>
                                        </div>
                                    </div>
                                    <div class="widget-toggle-expand mb-3">

                                        <div class="widget-content-expanded">

                                            <ul class="simple-todo-list mt-3 user-info-block">
                                                <li class="completed"><strong>Email</strong> <span><?php echo e($company->email); ?></span></li>
                                                <li class="completed"><strong>Geslacht</strong> <span>
                                                <?php echo e(($company->gender == 'm')?'Man':'Vrouw'); ?>

                                                 </span></li>
                                                <li class="completed"><strong>Telefoonnummer</strong> <span>9876543210</span></li>
                                                <li class="completed"><strong>Role</strong> <span><?php echo e($company->role); ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="widget-toggle-expand mb-3">

                                        <div class="widget-content-expanded">
                                        <form method="POST" action="" class="theme" onsubmit="colorSave(this); return false;">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
                                            <ul class="simple-todo-list mt-3 user-info-block">
                                                <?php if(isset($companyUI['header'])): ?>
                                                    <li><label>Header Color 
                                                        <input type="text" class="jscolor form-control" name="header" value="<?php echo e($companyUI['header']); ?>"></label></li>
                                                    <li><label>Side Menu Color <input type="text" class="jscolor form-control" name="sidemenu" value="<?php echo e($companyUI['sidemenu']); ?>"></label></li>
                                                    <li><label>Footer Color</label> <input type="text" class="jscolor form-control" name="footer" value="<?php echo e($companyUI['footer']); ?>"></li>
                                                    <li><label>Background Color</label> <input type="text" class="jscolor form-control" name="background" value="<?php echo e($companyUI['background']); ?>"></li>
                                                    <li><label>Text Color</label> <input type="text" class="jscolor form-control" name="text" value="<?php echo e($companyUI['text']); ?>"></li>
                                                <?php else: ?>
                                                    <li><label>Header Color 
                                                        <input type="text" class="jscolor form-control" name="header" value="171717"></label></li>
                                                    <li><label>Side Menu Color <input type="text" class="jscolor form-control" name="sidemenu" value="1D2127"></label></li>
                                                    <li><label>Footer Color</label> <input type="text" class="jscolor form-control" name="footer" value="171717"></li>
                                                    <li><label>Background Color</label> <input type="text" class="jscolor form-control" name="background" value="ffffff"></li>
                                                    <li><label>Text Color</label> <input type="text" class="jscolor form-control" name="text" value="000000"></li>
                                                <?php endif; ?>
                                                <button type="submit" class="pull-right btn btn-sm btn-default">Save</button>
                                                <div class="clearfix"></div>
                                            </ul>
                                        </form>
                                        </div>
                                    </div>

                                    <hr class="dotted short">

                                    <h5 class="mb-2 mt-3">About</h5>
                                    <p class="text-2"><?php echo e($company->about); ?></p>
                                    <div class="clearfix">
                                        <a class="text-uppercase text-muted float-right" href="#">(View All)</a>
                                    </div>

                                    <hr class="dotted short">

                                    <div class="social-icons-list">
                                        <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                                    </div>

                                </div>
                            </section>

                        </div>

                        <div class="col-xl-8 top-tabs">

                            <ul class="simple-card-list mb-3">
                                <li class="primary">
                                    <h3>488</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                                <li class="primary">
                                    <h3>€ 189,000.00</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                                <li class="primary">
                                    <h3>16</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                            </ul>


                           <div class="tabs">

                                <ul class="nav nav-tabs tabs-primary" style="clear:both;">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#overview" data-toggle="tab">Company Information</a>
                                    </li>

                                    <li class="nav-item ">
                                        <a class="nav-link" href="#openinghours" data-toggle="tab">Opening Hours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#trainingschema" data-toggle="tab">Instellingen</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="overview" class="tab-pane active">
                                        <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="<?php echo e(route('admin.updateCompanysRoute', $company->id)); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                   <label for="name">Bedrijfsnaam</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input type="text" name="company_name" class="form-control" id="name" value="<?php echo e($company->company_name); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Soort</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input type="text" name="Soort" class="form-control" id="surname" value="<?php echo e($company->Soort); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="email" class="control-label">Address</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input type="text" name="address" class="form-control" id="autocomplete" onFocus="geolocate()" value="<?php echo e($company->address); ?>"  placeholder="ex. House 00, Road 00, New york, United states">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Zipcode</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                        <input type="text" name="zipcode" class="form-control" id="postal_code" value="<?php echo e($company->zipcode); ?>">
                                                        <span class="text-danger zipcoder"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">City</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input type="text" name="City" class="form-control" id="locality" value="<?php echo e($company->City); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">State</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input type="text" name="state" class="form-control" id="administrative_area_level_1" value="<?php echo e($company->state); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Contact Persoon</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="Contactpersoon" class="form-control" id="surname" value="<?php echo e($company->Contactpersoon); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Telefoon Algemeen</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                    <input type="text" name="phone_main" class="form-control" id="copyright" value="<?php echo e($company->phone_main); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Telefoon ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                    <input type="text" name="phone_contact" class="form-control" id="copyright" value="<?php echo e($company->phone_contact); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Telefoon  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                        <input type="text" name="phone_administration" class="form-control" id="surname" value="<?php echo e($company->phone_administration); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Email Algemeen</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                    <input type="email" name="email_main" class="form-control" id="copyright" value="<?php echo e($company->email_main); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Email ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                    <input type="email" name="email_contact" class="form-control" id="copyright" value="<?php echo e($company->email_contact); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Email  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                        <input type="email" name="email_administration" class="form-control" id="surname" value="<?php echo e($company->email_administration); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">KVK nummer</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input type="text" name="kvk_number" class="form-control" id="copyright" value="<?php echo e($company->kvk_number); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">BTW nummer</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input type="text" name="btw_number" class="form-control" id="copyright" value="<?php echo e($company->btw_number); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Primaire taal</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-language"></i>
                                                        </span>
                                                        <input type="text" name="primary_language" class="form-control" id="surname" value="<?php echo e($company->primary_language); ?>">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Staat cashback toe?</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                        <select name="allow_cashback" class="form-control" id="allow_cashback" >
                                                            <option value="0" disabled selected>Maak uw keuze</option>
                                                            <option value="1" <?php echo e((($company->allow_cashback == 1)?'selected=true':'')); ?>>Ja</option>
                                                            <option value="2" <?php echo e((($company->allow_cashback == 2)?'selected=true':'')); ?>>Nee</option>
                                                        </select>
                                                        <span class="text-danger allow-cashback-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Code</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class=""></i>
                                                        </span>
                                                    <input type="text" name="" class="form-control" id="copyright" value="">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Visite location ?</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                         <select name="visit_location" class="form-control" id="visit_location" >
                                                            <option value="0" disabled selected>Maak uw keuze</option>
                                                            <option value="1" <?php echo e((($company->visit_location == 1)?'selected=true':'')); ?>>Ja</option>
                                                            <option value="2" <?php echo e((($company->visit_location == 2)?'selected=true':'')); ?>>Nee</option>
                                                        </select>
                                                        <span class="text-danger allow-cashback-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="slug" class="control-label">Slug</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                         <input type="text" name="slug" class="form-control" id="slug" value="">
                                                        <span class="text-danger slug-error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pull-right">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info btn-flat">update</button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>

                                    </div>


                                    <!-- edit panel here -->
                                    <div id="Bezoeken" class="tab-pane">

                                    </div>
                                    <!-- edit end panel here -->

                                    <!-- edit panel here -->
                                    <div id="Transacties" class="tab-pane">

                                    </div>



                                    <div id="openinghours" class="tab-pane">

                                        <form id="opening-hours-form" action="<?php echo e(route('admin.saveOpeningHoursRqst',Request::segment(3))); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="row">
                                            <div class="col-md-6 alldayhideshow">
                                                <div class="form-group">
                                                    <label>Min Time </label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input id="min_time" value="<?php echo e($opening_hours['min_time']); ?>" name="min_time" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' required>
                                                    </div>
                                                    <div class="error-msg-min"></div>
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                            <div class="col-md-6 alldayhideshow">
                                                <div class="form-group">
                                                    <label>Max Time</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input id="max_time" value="<?php echo e($opening_hours['max_time']); ?>" name="max_time" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'required >
                                                    </div>

                                                </div>
                                                <!-- /.form group -->
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12  weeklydays">
                                                <div class="form-group">

                                                        <label>Business Days </label>
                                                        <br>


                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(0,$opening_hours['days'])): ?> checked <?php endif; ?> value="0" name="days[]"type="checkbox" id="su">
                                                    <label for="sun">Zo</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input  <?php if(in_array(1,$opening_hours['days'])): ?> checked <?php endif; ?> value="1" name="days[]"type="checkbox" id="mo">
                                                    <label for="mon">Ma</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(2,$opening_hours['days'])): ?> checked <?php endif; ?> value="2" name="days[]"type="checkbox" id="tu">
                                                    <label for="tue">Di</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(3,$opening_hours['days'])): ?> checked <?php endif; ?> value="3" name="days[]"type="checkbox" id="we">
                                                    <label for="wed">Wo</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(4,$opening_hours['days'])): ?> checked <?php endif; ?> value="4" name="days[]"type="checkbox" id="th">
                                                    <label for="thr">Do</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(5,$opening_hours['days'])): ?> checked <?php endif; ?> value="5" name="days[]"type="checkbox" id="fr">
                                                    <label for="fri">Vr</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary pull-left bdays-cus-width">
                                                    <input <?php if(in_array(6,$opening_hours['days'])): ?> checked <?php endif; ?> value="6" name="days[]"type="checkbox" id="sa">
                                                    <label for="sat">Za</label>
                                                </div>

                                                    <div class="error-msg-bdays"></div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>


                                        <div class="row">
                                            <div class="col-md-6">

                                            <div class="form-group ">
                                                <label>Saved Business Hours </label>


                                                <div class="m-0 business-ranges">
                                                    <?php $__currentLoopData = $opening_hours['business_hours']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                        $id=str_replace(array(" ",":","-"), "", $range);
                                                        ?>
                                                    <div id="rng<?php echo e($id); ?>"  class="mb-1 mt-1 mr-1 btn btn-xs btn-primary">
                                                        <input type="hidden" value="<?php echo e($range); ?>" name="businesshours[]"/>  <?php echo e($range); ?>

                                                        <i class="fa fa-times" onclick="$(this).parent().remove()"></i>
                                                    </div>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </div>

                                                <div class="error-msg-bhours"></div>
                                            </div>
                                        </div>

                                            <div class="col-md-6">

                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Add Business Hours </label><br>
                                                        <label>From </label>

                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                            <input name="from" id="from-time" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' >
                                                        </div>

                                                    </div>
                                                    <!-- /.form group -->
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>To</label>

                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                            <input name="to" id="to-time" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' >
                                                        </div>

                                                    </div>
                                                    <!-- /.form group -->
                                                </div>



                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <div class="error-msg"></div>
                                                        <button  onclick="addRange()" type="button" class="mb-1 mt-1 mr-1 btn btn-xs btn-primary"><i class="fa fa-plus"> </i>Add</button>
                                                        </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>

                                        <button onclick="submitOpeningHoursForm()" type="button" class="mb-1 mt-1 mr-1 btn btn-primary"><i class="fa fa-save"> </i> Save</button>


                                        </form>

                                    </div>
                                    <!-- edit end panel here -->


                                    <div class="tab-pane" id="trainingschema">
                                        <section class="content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Material Level</h3>
                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm pull-right"
                                                                    data-toggle="modal" data-target="#add-trainingdetails-materiallevel"><i
                                                                        class="fa fa-plus"></i> Add </button>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Material Level</th>
                                                                    <th>Action</th>
                                                                </tr>

                                                                <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a><?php echo e($material->id); ?></a></td>
                                                                        <td><?php echo e($material->materiallevel); ?></td>
                                                                        <td>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-danger btn-sm"
                                                                                    data-toggle="modal" data-target="#delete-material<?php echo e($material->id); ?>"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm"
                                                                                    data-toggle="modal" data-target="#edit-trainingdetails-accentgroup<?php echo e($material->id); ?>"><i
                                                                                        class="fa fa-edit"></i></button>
                                                                        </td>
                                                                    </tr>



                                                                    <div id="edit-trainingdetails-accentgroup<?php echo e($material->id); ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                                                         aria-labelledby="myLargeModalLabel">
                                                                        <div class="modal-dialog modal-sm" role="document">
                                                                            <form method="post" action="/admin/exercises/updatetrainingMaterial/<?php echo e($material->id); ?>/<?php echo e(Request::segment(3)); ?>">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">

                                                                                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Edit Material
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span></button>
                                                                                    </div>


                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group  col-md-12">
                                                                                                <label class="col-sm-12">Edit Material</label>
                                                                                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                                                                                       placeholder="Material name" value="<?php echo e($material->materiallevel); ?>" required/>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                                                                                        </button>
                                                                                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>




                                                                    <div id="delete-material<?php echo e($material->id); ?>" class="modal modal-danger fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                                                        <?php echo app('translator')->getFromJson('common.delete_modal_text'); ?>
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deletetrainingMaterialRequest', $material->id)); ?>">
                                                                                        <?php echo e(csrf_field()); ?>

                                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->

                                                                    </div>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /.box -->

                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Goal</h3>
                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm pull-right"
                                                                    data-toggle="modal" data-target="#add-trainingdetails-goal"><i
                                                                        class="fa fa-plus"></i> Add </button>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Goal</th>
                                                                    <th>Action</th>
                                                                </tr>

                                                                <?php $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a><?php echo e($goal->id); ?></a></td>
                                                                        <td><?php echo e($goal->goalname); ?></td>
                                                                        <td>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-danger btn-sm"
                                                                                    data-toggle="modal" data-target="#delete-goal<?php echo e($goal->id); ?>"><i
                                                                                        class="fa fa-trash" ></i></button>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm"
                                                                                    data-toggle="modal" data-target="#edit-goal<?php echo e($goal->id); ?>"><i
                                                                                        class="fa fa-edit"></i></button>
                                                                        </td>
                                                                    </tr>

                                                                    <div id="edit-goal<?php echo e($goal->id); ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                                                         aria-labelledby="myLargeModalLabel">
                                                                        <div class="modal-dialog modal-sm" role="document">,
                                                                            <form method="post" action="/admin/exercises/updatetrainingGoal/<?php echo e($goal->id); ?>/<?php echo e(Request::segment(3)); ?>">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">

                                                                                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Edit Goal
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span></button>
                                                                                    </div>


                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group  col-md-12">
                                                                                                <label class="col-sm-12">Edit Goal</label>
                                                                                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                                                                                       placeholder="Goal name" value="<?php echo e($goal->goalname); ?>" required/>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                                                                                        </button>
                                                                                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                    <div id="delete-goal<?php echo e($goal->id); ?>" class="modal modal-danger fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                                                        <?php echo app('translator')->getFromJson('common.delete_modal_text'); ?>
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deletetrainingGoalRequest', $goal->id)); ?>">
                                                                                        <?php echo e(csrf_field()); ?>

                                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->

                                                                    </div>


                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /.box -->
                                                    <!-- /.box -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-6">
                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Training Levels</h3>
                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm pull-right"
                                                                    data-toggle="modal" data-target="#add-trainingdetails-traininglevel"><i
                                                                        class="fa fa-plus"></i> Add </button>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Training Levels</th>
                                                                    <th>Action</th>
                                                                </tr>



                                                                <?php $__currentLoopData = $training_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a><?php echo e($training_level->id); ?></a></td>
                                                                        <td><?php echo e($training_level->traininglevel); ?></td>
                                                                        <td>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-danger btn-sm"
                                                                                    data-toggle="modal" data-target="#delete-traininglevel<?php echo e($training_level->id); ?>"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm"
                                                                                    data-toggle="modal" data-target="#edit-traininglevel<?php echo e($training_level->id); ?>" ><i
                                                                                        class="fa fa-edit"></i></button>
                                                                        </td>
                                                                    </tr>


                                                                    <div id="edit-traininglevel<?php echo e($training_level->id); ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                                                         aria-labelledby="myLargeModalLabel">
                                                                        <div class="modal-dialog modal-sm" role="document">
                                                                            <form method="post" action="/admin/exercises/updatetrainingTrainingLevel/<?php echo e($training_level->id); ?>/<?php echo e(Request::segment(3)); ?>">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">

                                                                                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Edit Accent Training Level
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span></button>
                                                                                    </div>


                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group  col-md-12">
                                                                                                <label class="col-sm-12">Edit Accent Training Level</label>
                                                                                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                                                                                       placeholder="Training Level" value="<?php echo e($training_level->traininglevel); ?>" required/>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                                                                                        </button>
                                                                                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                    <div id="delete-traininglevel<?php echo e($training_level->id); ?>" class="modal modal-danger fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                                                        <?php echo app('translator')->getFromJson('common.delete_modal_text'); ?>
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deletetrainingTrainingLevelRequest', $training_level->id)); ?>">
                                                                                        <?php echo e(csrf_field()); ?>

                                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->

                                                                    </div>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>

                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Accent Muscle Group</h3>
                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm pull-right"
                                                                    data-toggle="modal" data-target="#add-trainingdetails-accentgroup"><i
                                                                        class="fa fa-plus"></i> Add </button>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Accent Muscle Group</th>
                                                                    <th>Action</th>
                                                                </tr>

                                                                <?php $__currentLoopData = $accent_muscle_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accent_muscle_grou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a><?php echo e($accent_muscle_grou->id); ?></a></td>
                                                                        <td><?php echo e($accent_muscle_grou->musclegroupname); ?></td>
                                                                        <td>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-danger btn-sm"
                                                                                    data-toggle="modal" data-target="#delete-trainingmusclegroup<?php echo e($accent_muscle_grou->id); ?>"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                            <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-sm"
                                                                                    data-toggle="modal" data-target="#edit-trainingmusclegroup<?php echo e($accent_muscle_grou->id); ?>"><i
                                                                                        class="fa fa-edit"></i></button>
                                                                        </td>
                                                                    </tr>



                                                                    <div id="edit-trainingmusclegroup<?php echo e($accent_muscle_grou->id); ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                                                         aria-labelledby="myLargeModalLabel">
                                                                        <div class="modal-dialog modal-sm" role="document">
                                                                            <form method="post" action="/admin/exercises/updatetrainingaccentgroup/<?php echo e($accent_muscle_grou->id); ?>/<?php echo e(Request::segment(3)); ?>">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">

                                                                                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Edit Accent Muscle Group
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span></button>
                                                                                    </div>


                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group  col-md-12">
                                                                                                <label class="col-sm-12">Edit Muscle Group</label>
                                                                                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                                                                                       placeholder="Muscle Group name" value="<?php echo e($accent_muscle_grou->musclegroupname); ?>" required/>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                                                                                        </button>
                                                                                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div id="delete-trainingmusclegroup<?php echo e($accent_muscle_grou->id); ?>" class="modal modal-danger fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                                                        <?php echo app('translator')->getFromJson('common.delete_modal_text'); ?>
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deletetrainingaccentgroupRequest', $accent_muscle_grou->id)); ?>">
                                                                                        <?php echo e(csrf_field()); ?>

                                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>

                                                                    </div>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->


                                        </section>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

    <div id="add-trainingdetails-goal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" action="<?php echo e(route('admin.savetrainingGoalRequest',Request::segment(3))); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Add Goal
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>



                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-sm-12">Goal name</label>
                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                       placeholder="Goalname" required/>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="add-trainingdetails-materiallevel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" action="<?php echo e(route('admin.savetrainingMaterialRequest',Request::segment(3))); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Add Material
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-sm-12">Material name</label>
                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                       placeholder="Material name" required/>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit" id="btngoal" class="btn btn-info btn-flat update-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div id="add-trainingdetails-traininglevel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" action="<?php echo e(route('admin.savetrainingTrainingLevelRequest',Request::segment(3))); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Add Training Level
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-sm-12">Training Level</label>
                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                       placeholder="Training Level" required/>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="add-trainingdetails-accentgroup" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" action="<?php echo e(route('admin.savetrainingaccentgroupRequest',Request::segment(3))); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Add Accent Muscle Group
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-sm-12">Accent Muscle Group</label>
                                <input name="field_name" class="form-control col-sm-12" id="block_reason" rows="6"
                                       placeholder="Accent Muscle Group" required/>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit"  class="btn btn-info btn-flat update-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="upload-logo modal modal-sm" style="margin:50px auto;" role="dialog">
            <form method="post" enctype="multipart/form-data" action="<?php echo e(route('admin.imageupdate',Request::segment(3) )); ?> }}">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-stack-1x"></i>
                        </span> Add Company Logo
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-sm-12">Select File</label>
                                <input name="base64_src" class="form-control col-sm-12" id="block_reason" rows="6" type="file" 
                                       required/>
                                <input type="hidden" name="action" value="update_site_image">
                                <input type="hidden" name="id" id="company_id_in" value="">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit"  class="btn btn-info btn-flat update-button">Upload</button>
                    </div>
                </div>
            </form>
        </div>
                    <!-- end: page -->
</section>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJvNlD0UnIszNiq25gqd-ua1-C6igw_mU&libraries=places&callback=initAutocomplete"async defer></script>



<script>
        var placeSearch, autocomplete;
        var componentForm = {
            locality: 'long_name',
            administrative_area_level_1: 'long_name',
            postal_code: 'long_name'
        };

       function initAutocomplete() {
         autocomplete = new google.maps.places.Autocomplete(
             /** @type  {!HTMLInputElement} */(document.getElementById('autocomplete')),
             {types: ['geocode']});

         autocomplete.addListener('place_changed', fillInAddress);
        }

       function fillInAddress() {
         // Get the place details from the autocomplete object.
         var place = autocomplete.getPlace();
         for (var component in componentForm) {
           document.getElementById(component).value = '';
           document.getElementById(component).disabled = false;
         }

         // Get each component of the address from the place details
         // and fill the corresponding field on the form.
         for (var i = 0; i < place.address_components.length; i++) {
           var addressType = place.address_components[i].types[0];
           if (componentForm[addressType]) {
             var val = place.address_components[i][componentForm[addressType]];
             document.getElementById(addressType).value = val;
           }
         }
       }

       // Bias the autocomplete object to the user's geographical location,
       // as supplied by the browser's 'navigator.geolocation' object.
       function geolocate() {
         if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function(position) {
             var geolocation = {
               lat: position.coords.latitude,
               lng: position.coords.longitude
             };
             var circle = new google.maps.Circle({
               center: geolocation,
               radius: position.coords.accuracy
             });
             autocomplete.setBounds(circle.getBounds());
           });
         }
       }

  function addRange(){

    if($('#from-time').val() == $('#to-time').val()){
        $('.error-msg').html('<label id="fullname-error" class="error" for="fullname">Same times choosan</label>');

        return false;
    }

    if((new Date("November 13, 2013 " + $('#from-time').val())) > (new Date("November 13, 2013 " + $('#to-time').val()))){
        $('.error-msg').html('<label id="fullname-error" class="error" for="fullname">From time should be less than To time</label>');
        return false;
    }

    $('.error-msg').html("");

    var range=$('#from-time').val()+" - "+$('#to-time').val();
    var id=($('#from-time').val().replace(":","")+$('#to-time').val().replace(":",""));
    if($('#rng'+id).length==0){

        var  html='<div id="rng'+id+'"  class="mb-1 mt-1 mr-1 btn btn-xs btn-primary"><input type="hidden" value="'+range+'" name="businesshours[]"/>  '+range+'  <i class="fa fa-times" onclick="$(this).parent().remove()"></i></div>';
        $('.business-ranges').append(html);
    }
    else{
        $('.error-msg').html('<label id="fullname-error" class="error" for="fullname">Range Already added</label>');
    }


}
    function submitOpeningHoursForm(){

        if(($('#min_time').val().trim()=='') || $('#max_time').val().trim()==''){
            $('.error-msg-min').html('<label id="fullname-error" class="error" for="fullname">MinTime and MaxTime is required</label>');
            return false;
        }
        var days = $('input[name="days[]"]:checked').length ;
        if(days==0){
            $('.error-msg-bdays').html('<label id="fullname-error" class="error" for="fullname">Please choose business days</label>');
            return false;

        }

        if((new Date("November 13, 2018 " + $('#min_time').val())) >= (new Date("November 13, 2018 " + $('#max_time').val()))){
            $('.error-msg-min').html('<label id="fullname-error" class="error" for="fullname">Min time should be less than Max time</label>');
            return false;
        }


        if($('.business-ranges').html().trim()==''){
            $('.error-msg-bhours').html('<label id="fullname-error" class="error" for="fullname">Please add business hours</label>');
            return false;

        }

        $('.error-msg-min').html("");
        $('.error-msg-bdays').html("");
        $('.error-msg-bhours').html("");
        $('#opening-hours-form').submit()
    }
    function colorSave(e){

         $.ajax({
                 type: "POST",
                 url: "<?php echo e(url('admin/company/updateUi')); ?>",
                 data: $(e).serialize(),
                 success: function (res) {
                        alert("Colors Updated");
                    }
             });
    }
    function uploadImage(e){
        id = $(e).data().id;
        $("#company_id_in").val(id);
        $(".upload-logo").modal("show");
    }
</script>
<script type="text/javascript" src="<?php echo e(asset('js/jscolor.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>