<?php $__env->startSection('title','Companies'); ?>

<?php $__env->startSection('style'); ?>

<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />
<style>
    .top-tabs ul.simple-card-list{ width: 100%; float: left; display: block; }
    .top-tabs ul.simple-card-list li{ width:31.3%; float: left; margin: 0 1%; }
    .user-info-block li span{ float: right; text-transform: capitalize; }
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
                                </ul>
                                <div class="tab-content">
                                    <div id="overview" class="tab-pane active">
                                            <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="<?php echo e(route('admin.addCompanysRoute')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                   <label for="name">Bedrijfsnaam</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input type="text" name="company_name" class="form-control" id="name" value="<?php echo e(@old('company_name', '')); ?>" >
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Soort</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input type="text" name="Soort" class="form-control" id="surname"  value="<?php echo e(@old('Soort', '')); ?>">
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
                                                    <input type="text" name="address" class="form-control" id="autocomplete" value="<?php echo e(@old('address', '')); ?>" onFocus="geolocate()"   placeholder="ex. House 00, Road 00, New york, United states">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Zipcode</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                        <input type="text" name="zipcode" class="form-control" id="postal_code" value="<?php echo e(@old('zipcode', '')); ?>">
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
                                                    <input type="text" name="City" class="form-control" id="locality" value="<?php echo e(@old('City', '')); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">State</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input type="text" name="state" value="<?php echo e(@old('state', '')); ?>" class="form-control" id="administrative_area_level_1" value="">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Contact Persoon</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" value="<?php echo e(@old('Contactpersoon', '')); ?>" name="Contactpersoon" class="form-control" id="surname">
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
                                                    <input type="text" name="phone_main" class="form-control" id="copyright"  value="<?php echo e(@old('phone_main', '')); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Telefoon ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                    <input type="text" value="<?php echo e(@old('phone_contact
                                                    ', '')); ?>" name="phone_contact" class="form-control" id="copyright" >
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Telefoon  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                        <input type="text" name="phone_administration" class="form-control" id="surname" value="<?php echo e(@old('phone_administration', '')); ?>" >
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
                                                    <input type="email" name="email_main" value="<?php echo e(@old('email_main', '')); ?>" class="form-control" id="copyright" >
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Email ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                    <input type="email" name="email_contact" class="form-control" id="copyright" value="<?php echo e(@old('email_contact', '')); ?>">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Email  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                        <input type="email" name="email_administration" value="<?php echo e(@old('email_administration', '')); ?>" class="form-control" id="surname">
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
                                                    <input type="text" name="kvk_number" value="<?php echo e(@old('kvk_number', '')); ?>" class="form-control" id="copyright">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">BTW nummer</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input type="text" value="<?php echo e(@old('btw_number', '')); ?>" name="btw_number" class="form-control" id="copyright">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Primaire taal</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-language"></i>
                                                        </span>
                                                        <input type="text" name="primary_language" class="form-control" id="surname" value="<?php echo e(@old('primary_language', '')); ?>">
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
                                                            <option value="0" disabled selected>Select One</option>
                                                            <option value="1" <?php if(@old('allow_cashback') == 1): ?> selected <?php endif; ?>>Ja</option>
                                                            <option value="2" <?php if(@old('allow_cashback') == 2): ?> selected <?php endif; ?>>Nee</option>
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
                                                            <option value="0" disabled selected>Select One</option>
                                                            <option value="1" <?php if(@old('visit_location') == 1): ?> selected <?php endif; ?>>Ja</option>
                                                            <option value="2" <?php if(@old('visit_location') == 2): ?> selected <?php endif; ?>>Nee</option>
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
                                                    <button type="submit" class="btn btn-info btn-flat">Add</button>
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
                                    <!-- edit end panel here -->

                                </div>
                            </div>
                        </div>
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>