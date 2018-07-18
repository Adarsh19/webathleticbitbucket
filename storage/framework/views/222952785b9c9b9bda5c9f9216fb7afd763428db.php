<?php $__env->startSection('title','Rooster'); ?>
<?php $__env->startSection('style'); ?>


    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/fullcalendar/fullcalendar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/fullcalendar/fullcalendar.print.css')); ?>" media="print">
    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.css')); ?>">
    <style>
        .width100{width: 100%;}
        .external-event{color:#fff !important;}
        .pointer{
            cursor: pointer;}

        .margintop15{
            margin-top: 15px;;;
        }
        .removeoptions{display: none}
        .simple-user-list li:hover{
            background-color: #f1f1f1;
        }
        .delbtn{
            display: none;}
        .editbuttons{display: none;}
        .searchbaruser_right_sidebarbox{left: 0;max-height: 300px;overflow: auto;
            text-align: left;}
        .searchsuserwithrolebox{max-height:300px;overflow: auto;}
        .red-border{border: 1px solid red;}
        .cus-userimg{
            width: 35px;
            height: 35px;
        }
        .companyfilter{
            max-height: 200px;
            overflow: auto;
        }
        .pointer-events-none{
            cursor: auto !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Rooster</h2>
            <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </header>





        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-calendar active"></i>&nbsp; Rooster</a></li>
            </ol>
        </section>



        <!-- default / right -->
        <div class="row">
            <div class="col-lg-12">




                <div class="tabs">
                    <ul class="nav nav-tabs" id="calendarTab">

                        <?php $__currentLoopData = $service_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$service_schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item <?php if($key==0): ?> active <?php endif; ?>">
                            <a id="tab<?php echo e($service_schedule->id); ?>" style="border-top-color: <?php echo e($service_schedule->color); ?>;" class="nav-link schtabs"  caltabid="<?php echo e($service_schedule->id); ?>" href="#tab_<?php echo e($service_schedule->id); ?>" data-toggle="tab"><?php echo e($service_schedule->title); ?>


                                &nbsp;
                                <div class="tools pull-right editbuttons">
                                    <i class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-schedule_modal<?php echo e($service_schedule->id); ?>"></i>
                                    <i class="fa fa-edit pointer" data-toggle="modal" data-target="#edit-schedule_modal<?php echo e($service_schedule->id); ?>"></i>
                                </div>
                            </a>

                        </li>

                            <div id="delete-schedule_modal<?php echo e($service_schedule->id); ?>" class="modal modal-danger fade">
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
                                            <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteScheduleRqst',$service_schedule->id )); ?>">
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

                            <div class="modal fade" id="edit-schedule_modal<?php echo e($service_schedule->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post"  action="<?php echo e(route('admin.editScheduleTabRqst',$service_schedule->id)); ?>">

                                            <?php echo e(csrf_field()); ?>


                                            <div class="modal-header">

                                                <h4 class="modal-title modtil">Edit Schedule <?php echo e($service_schedule->title); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="box box-warning">

                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <!-- /.form group -->
                                                                <div class="form-group">
                                                                    <label>Schedule Title</label>
                                                                    <div class="input-group">
                                                                        <input value="<?php echo e($service_schedule->title); ?>" type="text" id="schedule_title" name="schedule_title" value="" class="form-control" placeholder="Schedule Title">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <!-- /.form group -->
                                                                <div class="form-group">
                                                                    <label>Choose Role</label>
                                                                    <select class="form-control mb-3" name="role">
                                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option <?php if($service_schedule->role==$role->id): ?> selected <?php endif; ?> value="<?php echo e($role->id); ?>"><?php echo e($role->role); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Choose Color</label>
                                                                <div class="input-group color colorpicker-element  add-schedule-colorpicker" data-plugin-colorpicker="">
                                                                    <span class="input-group-addon"><i style="background-color: rgb(18, 63, 87);" ></i></span>
                                                                    <input name="color" type="text" class="form-control colorinput" value="<?php echo e($service_schedule->color); ?>" placeholder="Choose custom Color">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12">


                                                                <div class="book">
                                                                    <label class="booklabel">Dragdrop</label>

                                                                    <div class="checkbox-custom checkbox-primary">
                                                                        <input <?php if($service_schedule->dragdrop): ?> checked <?php endif; ?>  name="drag" type="checkbox" id="drag">
                                                                        <label for="drag">Drag Drop</label>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>




                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-block btn-primary btn-sm pull-right" style="width: 100px">Edit Schedule</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <li class="nav-item">
                                <a class="nav-link" href="#"   data-toggle="modal" data-target="#addScheduleModal"><i class="fa fa-plus"></i> Add Schedule</a>
                            </li>



                            <?php if($user->role=="admin"): ?>
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-search"></i> Seach By Company <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.roosterRqst',$company->user_id)); ?>" ><?php echo e($company->name); ?></a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                            <?php endif; ?>


                            

                                
                                    
                                        
                                        
                                            
                                                
                                            


                                        
                                    
                                
                            





                    </ul>
                    <div class="tab-content">
                        <?php $__currentLoopData = $service_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$service_schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="tab_<?php echo e($service_schedule->id); ?>" class="tab-pane <?php if($key==0): ?> active <?php endif; ?>">
                            <p><?php echo e($service_schedule->title); ?></p>

                            <div  id="LoadingOverlayApi" class="text-center" data-loading-overlay>
                            <div class="row calendercontent" data-loading-overlay data-loading-overlay-options='{ "startShowing": false }' style="min-height: 150px;">
                               


                                <section class="card col-lg-9 pull-left">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="calendar<?php echo e($service_schedule->id); ?>">


                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class=" col-lg-3">
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-lg-12">
                                                <p class="h5 font-weight-light"><i class="fa fa-calendar"></i> Calendar</p>

                                                <hr/>

                                                <div class="box-body no-padding">
                                                    <div id="calendarsmall<?php echo e($service_schedule->id); ?>" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="tabs">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="nav-item active">
                                                        <a class="nav-link active" href="#user_tab<?php echo e($service_schedule->id); ?>" data-toggle="tab">Leden</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#service_tab<?php echo e($service_schedule->id); ?>" data-toggle="tab">Diensten</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <input type="hidden" class="hdden_schedule_id" value="<?php echo e($service_schedule->id); ?>">
                                                    <div id="user_tab<?php echo e($service_schedule->id); ?>" class="tab-pane active">

                                                        <div class="row connected_users">

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <p class="h5 font-weight-light"><i class="fa fa-search"></i> Search and Add User</p>

                                                                <hr/>


                                                                <form method="post" action="<?php echo e(route('admin.saveConnectedUserRqst')); ?>" id="formsaveconnecteduser">
                                                                    <?php echo e(csrf_field()); ?>

                                                                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->

                                                                    <!-- /btn-group -->
                                                                    <div class="row" style="margin-bottom: 20px;">
                                                                        <div class="input-group">
                                                                            <input style="margin: 0px 10px 0px 10px;" id="new-event" type="text" name="user_name" class="form-control searchbaruser_right_sidebar"
                                                                                   placeholder="Search User">

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group" style="margin: 0px 10px 0px 10px;">
                                                                            <input class="user_id_connected" name="user_id" type="hidden">
                                                                            <input class="row_id" name="row_id" type="hidden">
                                                                            <input class="schedule_id" name="schedule_id" type="hidden" value="<?php echo e($service_schedule->id); ?>">


                                                                            <div class="input-group color colorpicker-element  choosecolor" data-plugin-colorpicker="">
                                                                                <span class="input-group-addon"><i style="background-color: rgb(18, 63, 87);"></i></span>
                                                                                <input name="color" type="text" class="form-control colorinput" value=""
                                                                                       placeholder="Choose custom Color">
                                                                                <div class="input-group-btn">
                                                                                    <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                                                                                </div>
                                                                            </div>


                                                                            <!-- /.input group -->
                                                                        </div>
                                                                    </div>

                                                                    <div class="searchbaruser_right_sidebarbox"></div>
                                                                </form>


                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div id="service_tab<?php echo e($service_schedule->id); ?>" class="tab-pane">

                                                        <div id='external-events'>

                                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div user_id="service_<?php echo e($service->id); ?>" class="external-event badge badge-success ui-draggable ui-draggable-handle width100" data-event-class="fc-event-default"
                                                                     style="border-color: <?php echo e($service->bg_color); ?>;background-color: <?php echo e($service->bg_color); ?>"><?php echo e($service->service); ?>


                                                                </div>



                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>


                                                         </div>
                                                </div>
                                            </div>
                                        </div>
















                                    </div>
                                </section>




                            </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>









    </section>

    <div class="modal fade" id="addScheduleModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post"  action="<?php echo e(route('admin.addServiceScheduleRqst')); ?>">

                    <?php echo e(csrf_field()); ?>


                    <input type="hidden" name="user_id" value="<?php echo e($segment=Request::segment(3)); ?>">

                <div class="modal-header">

                    <h4 class="modal-title modtil">Add Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="box box-warning">

                        <!-- /.box-header -->
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Schedule Title</label>
                                    <div class="input-group">
                                        <input type="text" id="schedule_title" name="schedule_title" value="" class="form-control" placeholder="Schedule Title">

                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <!-- /.form group -->
                                    <div class="form-group">
                                        <label>Choose Role</label>
                                        <select class="form-control mb-3" name="role">
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->role); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Choose Color</label>
                                <div class="input-group color colorpicker-element  add-schedule-colorpicker" data-plugin-colorpicker="">
                                    <span class="input-group-addon"><i style="background-color: rgb(18, 63, 87);"></i></span>
                                    <input name="color" type="text" class="form-control colorinput" value="" placeholder="Choose custom Color">
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">


                                    <div class="book">
                                        <label class="booklabel">Dragdrop</label>

                                        <div class="checkbox-custom checkbox-primary">
                                            <input value="1" name="drag" type="checkbox" id="drag">
                                            <label for="drag">Drag Drop</label>

                                        </div>

                                    </div>

                                </div>
                                </div>




                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-block btn-primary btn-sm pull-right" style="width: 100px">Add Schedule</button>
                </div>

            </form>
            </div>
        </div>
    </div>



    <div id="eventModal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form" id="schedule_form" method="post" action="<?php echo e(route('admin.saveScheduleEventRqst')); ?>">
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
                                    <a class="nav-link tab-edit active" href="#schedule" data-toggle="tab">Maak agenda</a>
                                </li>
                                <li class="nav-item tab-edit">
                                    <a class="nav-link" href="#bookuser" data-toggle="tab">Aanmeldingens</a>
                                </li>
                                <li class="nav-item tab-delete">
                                    <a class="nav-link" id="delete-user-button" data-toggle="modal" data-target="#delete-modal-event">Verwijder </a>
                                </li>
                            </ul>

                            <div class="tab-content">



                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" id="schedule_id" name="schedule_id" value="">
                                <input type="hidden" id="service_id" name="service_id" value="">


                                <input type="hidden" id="orig_event_id" name="orig_event_id" value="">
                                <input type="hidden" id="recur_instance_start" name="recur_instance_start" value="">
                                <input type="hidden" id="recur_series_start" name="recur_series_start" value="">



                                <input type="hidden" id="month" name="month" value="">

                                <!-- tab form add-->
                                <div id="schedule" class="tab-pane active">
                                    <!-- time Picker -->

                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <!-- select -->
                                            <div class="">
                                                <label>Dienst</label>
                                                <?php $services=\App\Service::get()?>
                                                <select class="form-control" id="changeSe" onchange="changeService(this)" name="service" required>
                                                    <option max_isers="" value="">Select Service</option>
                                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option max_users="<?php echo e($service->user_mass); ?>" value="<?php echo e($service->id); ?>"><?php echo e($service->service); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        </div>


                                        
                                            
                                            
                                                
                                                {{--<?php $schedules=\App\ServiceSchedule::get()?>--}}
                                                
                                                    
                                                    
                                                        
                                                    
                                                
                                            

                                        

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 form-group ">
                                            <div class="form-group">
                                                <label>Datum vanaf</label>
                                                <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                    <input type="text" id="date_from" name="date_from" value="" class="form-control" placeholder="dd-mm-yyyy" required>
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 alldayhideshow">
                                            <div class="form-group">
                                                <label>Tijd vanaf </label>

                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                    <input name="time_from" id="time_from" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' >
                                                </div>





                                                
                                                    

                                                    
                                                        
                                                    
                                                
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-md-6 pull-left">
                                            <!-- /.form group -->
                                            <div class="form-group">
                                                <label>Datum tot</label>
                                                <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                    <input type="text" id="date_untill" name="date_untill" value="" class="form-control" placeholder="dd-mm-yyyy" required>
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 alldayhideshow">
                                            <div class="form-group">
                                                <label>Tijd tot</label>

                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                    <input name="time_untill" id="time_untill" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' >
                                                </div>

                                                
                                                    

                                                    
                                                        
                                                    
                                                
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">


                                            <div class="allday">
                                                <label class="booklabel">Gehele dag</label>

                                                <div class="checkbox-custom checkbox-primary">
                                                    <input value="1" name="allday" type="checkbox" id="allday" onclick="checkallday()">
                                                    <label for="book">Gehele dag</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group">

                                            <div class="">
                                                <label>Herhaling</label>
                                                <select class="form-control " onchange="chooseReccuringSchedule(this)" name="recurringtype" id="recurringtype">
                                                    <option value="">Do Not Repeat</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">


                                            <div class="daily" style="display: none">
                                                <label>Herhaal ieder</label>
                                                <input type="number" class="form-control" name="numberrecur" value="1" id="interval">
                                                <label> <span class="toplabel">day</span> Kies start datum
                                                </label>
                                                <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                    <input type="text" id="date_from_recur" name="date_form_recur" value="" class="form-control" placeholder="dd-mm-yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                                <label>Kies uw
                                                </label>

                                                <div class="weeklydays" style="display: none">
                                                    <label>dag </label>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="SU" name="days[]"type="checkbox" id="su">
                                                        <label for="sun">Zo</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="MO" name="days[]"type="checkbox" id="mo">
                                                        <label for="mon">Ma</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="TU" name="days[]"type="checkbox" id="tu">
                                                        <label for="tue">Di</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="WE" name="days[]"type="checkbox" id="we">
                                                        <label for="wed">Wo</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="TH" name="days[]"type="checkbox" id="th">
                                                        <label for="thr">Do</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="FR" name="days[]"type="checkbox" id="fr">
                                                        <label for="fri">Vr</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input value="SA" name="days[]"type="checkbox" id="sa">
                                                        <label for="sat">Za</label>
                                                    </div>

                                                </div>

                                                <div class="monthly" style="display: none">
                                                    <label>on the</label>
                                                    <select class="form-control mb-3" name="monthday" id="monthdayoption">
                                                        <option value="1">Ist wedenesday</option>
                                                        <option value="2nd">2nd day</option>
                                                    </select>
                                                    <label>of each month</label>
                                                </div>

                                                <div class="yearly" style="display: none">
                                                    <label>on the</label>
                                                    <select class="form-control mb-3" name="yearday" id="yearday">
                                                        <option value="1">Ist wedenesday In May</option>
                                                        <option value="2nd">2nd day In May</option>

                                                    </select>
                                                    <label>of each month</label>
                                                </div>

                                                <select class="form-control mb-3" onchange="changeCounting(this)" name="countuingselect" id="countuingselect">
                                                    <option value="forever">Altijd</option>
                                                    <option value="for">Voor</option>
                                                    <option value="untill">tot</option>
                                                </select>
                                                <div class="untillinput" style="display: none;">
                                                    <input type="number" class="form-control"  name="untilnumber" value="1" id="untilnumber">
                                                    <label>events </label>
                                                </div>
                                                <div class="input-group date fordate" style="display: none;" data-date-format="dd-mm-yyyy">
                                                    <input type="text" id="date_untill_recur" name="date_untill_recur" value="" class="form-control" placeholder="dd-mm-yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </div>
                                                </div>

                                            </div>






                                        </div>


                                    </div>



                                    <div class="row">

                                        <div class="col-sm-12">


                                            <div class="form-group">
                                                <label class="col-lg-12 control-label text-lg-lseft pt-2">Waar is het te doen? </label>
                                                <div class="input-group">
                                                    <input type="text" id="location" name="location" value="" class="form-control" placeholder="Waar is het te doen?  (optional)">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-12 control-label text-lg-lseft pt-2" for="description">Omschrijving</label>
                                                <div class="col-lg-12">
                                                    <textarea class="form-control" rows="3"id="description" name="description" data-plugin-maxlength maxlength="140" placeholder="Omschrijving"></textarea>
                                                    <p>
                                                        <code>Maximaal</code>  140 tekens toegestaan

                                                    </p>
                                                </div>
                                            </div>




                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">


                                            <div class="book">
                                                <label class="booklabel">Leden kunnen online inschrijven? </label>

                                                <div class="checkbox-custom checkbox-primary">
                                                    <input value="1" name="book" type="checkbox" id="book">
                                                    <label for="book">Aanmeldingen</label>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-6 pull-right">


                                            <div class="book">
                                                <label class="dragablelabel">Afspraak is verplaatsbaar door te slepen? </label>

                                                <div class="checkbox-custom checkbox-primary">
                                                    <input value="1" name="dragable" type="checkbox" id="dragable">
                                                    <label for="dragable">Is verplaatsbaar in agenda </label>

                                                </div>

                                            </div>

                                        </div>
                                    </div>



                                </div>

                                <!-- tab form update -->
                                <div id="bookuser" class="tab-pane">


                                    <div class="rows">

                                        <section class="card card-featured-left card-featured-quaternary">
                                            <div class="card-body">
                                                <div class="widget-summary">
                                                    <div class="widget-summary-col widget-summary-col-icon">
                                                        <div class="summary-icon bg-quaternary">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="widget-summary-col">
                                                        <div class="summary">
                                                            <h4 class="title">Totale reserveringen</h4>
                                                            <div class="info">
                                                                <strong class="amount"><span id="added_count">0</span>/<span id="max_user_count">20</span></strong>
                                                            </div>
                                                        </div>
                                                        <div class="summary-footer">
                                                            <a class="text-muted text-uppercase"><span id="reservated_count">0</span> Reserveringen</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- select -->
                                            <div class="form-group ">
                                                <label class="margintop15">Kies een lid om toe te voegen</label>

                                                <input id="new-event" type="text" name="user_name" class="form-control searchsuserwithrole"  autocomplete="off" placeholder="Search User">

                                            </div>
                                            <div class="searchsuserwithrolebox"></div>



                                        </div>
                                    </div>
                                    <div class="row bookedreservaterow">
                                        <div class="col-md-6 form-group">
                                            <div class="form-group">
                                                <label class="margintop15">Geboekt</label>
                                                <div class="booked_users">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="form-group">
                                                <label class="margintop15">Wachtlijst</label>
                                                <div class="reservate_users">

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-12 form-group" id="recur_edit_modebox">
                                    <div class="radio-custom radio-d requiredanger">
                                    <input type="radio" class="editdeletethis" checked name="recur_edit_mode" value="single" required>
                                    <label for="editdeletethis">Wijzig / verwijder het geselecteerde
                                    </label>
                                    </div>
                                    <div class="radio-custom radio-d requiredanger">
                                    <input type="radio" class="editdeletethis" name="recur_edit_mode" value="future" required>
                                    <label for="editdeletethis">Wijzig / verwijder alles in de toekomst</label>
                                    </div>
                                    <div class="radio-custom radi requiredo-danger">
                                    <input type="radio" class="editdeletethis" name="recur_edit_mode" value="all" required>
                                    <label for="editdeletethis">Wijzig / verwijder alle events</label>
                                    </div>

                                    </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-default modal-dismiss" onclick="$('#eventModal').modal('hide')">Sluiten</button>
                            <button type="submit" class="btn btn-primary  " style="width: 100px">Opslaan</button>
                        </div>
                    </div>
                </footer>
            </div>



            </form>
        </div>
    </div>


    
        
            
                
                

                    
                    
                        
                
                
                    

                        
                        


                             


                                
                                


                                
                                
                                



                                
                                
                                    
                                        
                                            
                                        
                                        
                                            
                                        
                                    
                                    
                                        
                                            

                                            
                                                
                                                    
                                                    
                                                        
                                                        {{--<?php $services=\App\Service::get()?>--}}
                                                        
                                                            
                                                        
                                                                
                                                            
                                                        
                                                    

                                                
                                                
                                            
                                                
                                                    
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        
                                                    
                                                
                                                
                                                    
                                                        

                                                        
                                                            

                                                            
                                                                
                                                            
                                                        
                                                        
                                                    
                                                    
                                                
                                            


                                            

                                                
                                                    
                                                    
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        
                                                    
                                                
                                                
                                                    
                                                        

                                                        
                                                            

                                                            
                                                                
                                                            
                                                        
                                                        
                                                    
                                                
                                            
                                            
                                                


                                                    
                                                        

                                                        
                                                            
                                                            

                                                        

                                                    

                                                

                                            

                                            
                                                

                                                    
                                                        
                                                        
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        
                                                    
                                                

                                                
                                            
                                                


                                                    
                                                        
                                                        
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        
                                                        

                                                        
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            

                                                        

                                                        
                                                            
                                                            
                                                                
                                                                
                                                            
                                                            
                                                        

                                                        
                                                            
                                                            
                                                                
                                                                

                                                            
                                                            
                                                        

                                                        
                                                            
                                                            
                                                            
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        

                                                    






                                                


                                            



                                            

                                                


                                                    
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        
                                                    


                                                    
                                                        
                                                        
                                                            
                                                            
                                                                
                                                            
                                                        
                                                    




                                                

                                            
                                            
                                                


                                                    
                                                        

                                                        
                                                            
                                                            

                                                        

                                                    

                                                

                                                


                                                    
                                                        

                                                        
                                                            
                                                            

                                                        

                                                    

                                                
                                            



                                        
                                        


                                            

                                                
                                                    
                                                        
                                                            
                                                                
                                                                    
                                                                
                                                            
                                                            
                                                                
                                                                    
                                                                    
                                                                        
                                                                    
                                                                
                                                                
                                                                    
                                                                
                                                            
                                                        
                                                    
                                                
                                            


                                            
                                                
                                                    
                                                    
                                                        

                                                        

                                                    
                                                    



                                                
                                            
                                            
                                                
                                                    
                                                        
                                                        

                                                        

                                                    

                                                

                                                
                                                    
                                                        
                                                        

                                                        
                                                    

                                                
                                            


                                        
                                        
                                        
                                            
                                                
                                                    
                                                    
                                                
                                                
                                                    
                                                    
                                                
                                                
                                                    
                                                    
                                                

                                            


                                        
                                    
                                









                        
                        
                    
                
                
                    
                    
                    
                
                
            
        
    

    <div id="delete-modal-event" class="modal modal-danger fade" >
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Sluit">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <form method="post" role="form" id="delete_form" action="" id="delete_form">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <input name="event" type="hidden" id="hiddenevent">
                        <button type="button" class="btn btn-outline" onclick="clickDeleteonPopup()"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.add page modal -->


    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('site_scripts'); ?>
            <!-- Specific Page Vendor -->


    <script type="text/javascript" src="<?php echo e(asset('admin_files/vendor/moment/moment.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/fullcalendar/fullcalendar.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/fullcalendar/locale/nl.js')); ?>"></script>


    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/select2/js/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.nl.min.js')); ?>"></script>

    <script>


        var url_segment_date="";

        $(document).ready(function () {

//            ini_events($('#external-events div.external-event'));
            var opening_hours='<?php echo e($opening_hours); ?>';
            var firts_loaded_schedule_id='<?php echo e($default_first_calendar); ?>';
//            console.log(firts_loaded_schedule_id);

            var opening_hours = opening_hours.replace(/&quot;/g, '\"');
            var obj="";
            if(opening_hours.length>0)
             obj = jQuery.parseJSON(opening_hours);





            var url_segment='<?php echo e($segment=Request::segment(4)); ?>';
            var url_user='<?php echo e($segment=Request::segment(3)); ?>';
            url_segment_date='<?php echo e($segment=Request::segment(5)); ?>';


//            alert('#calendar'+url_segment);

            $('.schtabs').on('shown.bs.tab', function (e) {
                var scheduleid=$(this).attr('caltabid')

                //alert("len "+$('#calendar'+scheduleid).html().length  + "SCHID ->"+scheduleid);
//                var tab="tab"+scheduleid;
//                $('.nav-tabs a[href="#' + tab + '"]').tab('show');
//                if($('#calendar'+scheduleid).html().length>0){
//                   // $('#tab'+url_segment).trigger('click');
                    $('#calendar'+scheduleid).fullCalendar('render');
//                    $('.editbuttons').hide();
//                    $('#tab'+scheduleid).find('.editbuttons').show();
//                }else{

                    //$('#tab'+url_segment).trigger('click');
                    loadCalendarView(scheduleid,obj,url_user);


               // }

            });


            //Url navigation of schedules




            if( url_segment_date.length==0) {
                url_segment_date = new Date();
            }
            else{
                var sp=url_segment_date.split("-");
                url_segment_date=sp[2]+"-"+sp[1]+"-"+sp[0];
            }




          //$('#tab'+url_segment).trigger("shown.bs.tab");

//            var tab="tab"+url_segment;
//            $('.nav-tabs a[href="#' + tab + '"]').tab('show');

                   $('#tab'+url_segment).trigger('click');
                    if(url_segment>0){
                        if (typeof $('#calendar'+url_segment).length > 0){
                            $('#calendar'+url_segment).fullCalendar('render');
                            $('.editbuttons').hide();
                            $('#tab'+url_segment).find('.editbuttons').show();



                        }else{





//                            console.log(url_user);
//                            console.log(url_segment);

                            loadCalendarView(url_segment,obj,url_user);
                            //$('#calendar'+url_segment).fullCalendar('render');

                        }



                    }else{

                        loadCalendarView(firts_loaded_schedule_id,obj,url_user)
                    }











        });

        $(document).ready(function(){




            $('.add-schedule-colorpicker').colorpicker();

            $(".select2").select2();
            $("#date_untill").datepicker({ format: 'dd-mm-yyyy'});
            $("#date_untill_recur").datepicker({ format: 'dd-mm-yyyy'});
//
//
            $("#date_from").datepicker({ format: 'dd-mm-yyyy'});
            $("#date_from_recur").datepicker({ format: 'dd-mm-yyyy'});

//            $('#time_from').timepicker({
//                showMeridian: false,
//                minuteStep: 15,
//                showInputs: false,
//                disableFocus: true
//        });
//            $('#time_untill').timepicker({
//                showMeridian: false,
//                minuteStep: 15,
//                showInputs: false,
//                disableFocus: true  });




//            $('#time_from').timepicker();
//            $('#time_from').on('changeTime', function() {
//               console.log($(this).val());
//            });




//            if( window.location.hash ) {
//                // Vars
//                var tab =  window.location.hash.replace( '#', '' );
//
//
//                // Tabs
//                $( 'li.nav-item' ).removeClass( 'active' );
//                $( 'a[href="#' + tab + '"]' ).parent( 'li' ).addClass( 'active' );
//
//                // Tabs content
//                $( '.tab-pane' ).hide();
//                $( '#' + tab.replace( 'tab-', '' ) ).show();
//            }
//
//            // when the tab is selected update the url with the hash
//            $( '.tabs a' ).click( function() {
//                window.location.hash = $( this ).parent( 'li' ).attr( 'class' ).replace( ' active', '' ).replace( '_tab', '' );
//            });
        });

        function clickDeleteonPopup(){
            $('#schedule_form').attr('action','<?php echo e(route('admin.deleteServiceScheduleRqst')); ?>');
//            $('#schedule_form').attr('method','delete');
            $('#schedule_form').submit();


        }

        function checkallday(){

            if ($('#allday').is(':checked')) {
                $('.alldayhideshow').hide();
            }
            else{
                $('.alldayhideshow').show();
            }
        }
        function ini_events(ele) {
            ele.each(function () {



                var schedule_id=$(this).parent().parent().parent().parent().parent().find('.hdden_schedule_id').val();

                var eventObject = {
                    title: $.trim($(this).text()),
                    id: $.trim($(this).attr('user_id')),
                    schedule_id: schedule_id
                };

                //console.log(eventObject);

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }




        function loadCalendarView(schedule_id,opening_hours_obj,url_user){




            loadSmallCalendar(schedule_id,url_user);
            loadConnectedUsers(url_user);
            $('.editbuttons').hide();
            $('#tab'+schedule_id).find('.editbuttons').show();





            var business_days=[0,1,2,3,4,5,6];
            var business_hours='00:00:00-23:59:59';
            var min_time='00:00:00';
            var max_time='23:59:59';
            var businessHours=[];

          console.log(opening_hours_obj.business_days);

            if( typeof opening_hours_obj.business_days !== 'undefined' ){
                business_days=opening_hours_obj.business_days.split(",");

                business_hours=opening_hours_obj.business_hours.split(",");



                $.each( business_hours, function( index, value ){

                    var b_hours=value.split("-");
                    businessHours.push({
                        dow: business_days, // Monday - Friday
                        start: b_hours[0].trim(),
                        end: b_hours[1].trim(),
                    });
                });


                min_time=opening_hours_obj.min_time.trim();
                max_time=opening_hours_obj.max_time.trim();
            }else{
                businessHours.push({
                    dow: business_days, // Monday - Friday
                    start: '00:00:00',
                    end: '23:59:59',
                });
            }




            $('#calendar'+schedule_id).fullCalendar({

                defaultView: 'agendaWeek',
                selectable: true,
                height: 'auto',
                editable: true,
                droppable: true,
                dayNamesShort: ["Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"],
                buttonText: {
                    today: 'today',
                    month: 'Maand',
                    week: 'Week',
                    day: 'Dag'
                },
                defaultDate: url_segment_date,
                defaultTimedEventDuration: '00:15:00',
                minTime: min_time,
                maxTime: max_time,
                slotDuration: '00:15:00',
                slotLabelInterval: 15,
                slotLabelFormat: '(H:mm)',
                firstDay:1,
                lang:'nl',
//                agenda: 'H(:mm)',
                header: {
                    left: 'title',
                    right: 'prev,today,next,agendaDay,agendaWeek,month'
                },
                businessHours: businessHours,
                selectConstraint: "businessHours",
                drop: function(date, allDay) {

                    // this function is called when something is dropped
                    var $externalEvent = $(this);
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $externalEvent.data('eventObject');


                    console.log(originalEventObject);

                    var sp=originalEventObject.id.split("_");

                    var type=sp[0];
                    var rid=sp[1];

                    var bg_color=$(this).css("background-color");

                    if(type=="user"){
                        var user_html='<div class="form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_booked user_b_row_'+originalEventObject.id+'" data-event-class="fc-event-default" style="border-color: '+bg_color+'; background-color: '+bg_color+'; position: relative;">'+originalEventObject.title;
                        user_html+='<input class="userid"  type="hidden" name="user_ids[]" value="'+rid+'"><div class="tools pull-right"><i class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-modal-pv2"></i></div> </div>';
                        $('.booked_users').append(user_html);
                    }else{

                        //$("#changeSe").val(rid);
                        //$("#changeSe option:selected").val(rid);

                        $("#changeSe").html('<option max_users="" value="'+rid+'">'+originalEventObject.title+'</option>');
//                        alert($("#changeSe").val());
                    }


                    //No user is prefilled

                    schedule_id=originalEventObject.schedule_id;




                    fullcalendarDayClick(date,originalEventObject,schedule_id)

return false;

                },
                eventClick: function(calEvent, jsEvent, view) {



                    var service_schedule_id = calEvent.service_schedule_id;
                    var start = calEvent.start;
                    var end = calEvent.end;


                    var startdate = moment(calEvent.start).format('DD-MM-YYYY');;


                    var time_from = moment(calEvent.start).format("DD-MM-YYYY");

                    var enddate = moment(calEvent.end).format("DD-MM-YYYY");
                    var time_untill = moment(calEvent.end).format("HH:mm:ss");

                    $('#changeSe').val(service_schedule_id);
//                    $('#date_from').val(startdate);
                    $("#date_from").datepicker("update", startdate);
                    $("#date_from_recur").datepicker("update", startdate);

//                    $('#date_from_recur').val(startdate);
//                    $('#time_from').val(time_from);
                    $("#time_from").timepicker("setTime", time_from);

//                    $('#date_untill').val(enddate);
                    $("#date_untill").datepicker("update", enddate);
                    $("#date_untill_recur").datepicker("update", enddate);

//                    $('#date_untill_recur').val(enddate);
//                    $('#time_untill').val(time_untill);

                    $("#time_untill").timepicker("setTime", time_untill);

                    if (calEvent.all_day) {
                        $("#allday").prop("checked", true);
                    }

                    if (calEvent.can_user_book == '1') {
                        $("#book").attr('checked', 'checked');
                    }
                    if (calEvent.editable) {
                        $("#dragable").prop("checked", true);
                    }
                    $('#location').val(calEvent.location);
                    $('#description').val(calEvent.notes);



                    if (calEvent.rrule === undefined || calEvent.rrule === null) {

                        $('#recurringtype > option').eq(0).attr('selected', 'selected');
                        $('#recurringtype').trigger("change");
                    } else {


                        var rule = calEvent.rrule.split(/[;]/);
                        $.each(rule, function (index, value) {


                            var split = value.split("=");

                            if (value.toLowerCase().indexOf("freq") >= 0) {
                                var freq = split[1].toLowerCase();
                                $('#recurringtype').val(freq);
                                $('#recurringtype').trigger("change");

                            }
                            if (value.toLowerCase().indexOf("interval") >= 0) {
                                var interval = split[1].toLowerCase();


                                $('#interval').val(interval);

                            }
                            if (value.toLowerCase().indexOf("byday") >= 0) {
                                var intervalcomma = split[1].toLowerCase();

                                var interval = intervalcomma.split(",");
                                $.each(interval, function (indexday, valueday) {
                                    $('#' + valueday).attr('checked', 'checked');
                                });

                            }
                            if (value.toLowerCase().indexOf("count") >= 0) {
                                var count = split[1].toLowerCase();
                                $('#countuingselect').val('for');
                                $('#countuingselect').trigger("change");
                                $('#untilnumber').val(count);

                            }
                            if (value.toLowerCase().indexOf("untill") >= 0) {
                                var untill = split[1].toLowerCase();
                                $('#countuingselect').val('untill');
                                $('#countuingselect').trigger("change");

                            }
                            if (value.toLowerCase().indexOf("bymonthday") >= 0) {
                                var monthday = split[1].toLowerCase();
                                $('#monthdayoption').val(monthday);

                            }

                            if (value.toLowerCase().indexOf("bymonth") >= 0) {
                                var yearday = split[1].toLowerCase();
                                $('#yearday').val(yearday);

                            }


                            $('#schedule_id').val(calEvent.service_schedule_id);
                            $('#service_id').val(calEvent.service_schedule_id);


                        });


                    }


                    $('#orig_event_id').val(calEvent.id);
                    $('#recur_instance_start').val(calEvent.start); //needs to cross check doubt
                    $('#recur_series_start').val(calEvent.rsstart);
                    $('.delbtn').show();

                    $('.modtil').html("Edit Schedule");
                    $('#recur_edit_modebox').show();


                    $('#schedule_form').attr('action', BASE_URL+'/admin/rooster/editServiceSchedule/'+schedule_id);



                    basedOnstartDate() //Change things based on start date
                    loadConnectedUsersOnpopup(); //keyup event
                    loadBookedUsers(schedule_id) //actual saved from db

                    $('.tab-delete').show();
                    $('#eventModal').modal('show');
                    return false
//                    if (start.isAfter(moment())) {
//
//                        var eventTitle = prompt("Provide Event Title");
//                        if (eventTitle) {
//                            $("#calendar").fullCalendar('renderEvent', {
//                                title: eventTitle,
//                                start: start,
//                                end: end,
//                                stick: true
//                            });
//                            alert('Appointment booked at: ' + start.format("h(:mm)a"));
//                        }
//                    } else {
//                        alert('Cannot book an appointment in the past');
//                    }
                },
                select: function(startDate, endDate, jsEvent, view, resource) {
                    //No user is prefilled

                    fullcalendarDayClick(startDate,0,schedule_id)
                },

                events: {

                    url: BASE_URL + '/admin/rooster/loadEvents/'+schedule_id,
                    error: function (er, rr) {
                        if (rr == "parsererror") {
                             $('#errorBox').show();
                             $('#errorBox').html("No events for specified date");
                             setTimeout(function () {
                                 $('#errorBox').hide();
                             }, 3000);
                        }
                        else {
                             $('#errorBox').show();
                             $('#errorBox').html("Some error occured,Please try again");
                             setTimeout(function () {
                                 $('#errorBox').hide();
                             }, 3000);
                        }
                    },
                    success: function (obj, rr) {

                    }
                },
            });


            $(".searchbaruser_right_sidebar").keyup(function () {


                $('.searchbaruser_right_sidebarbox').show();

                var keyword = $(this).val();

                var service_id = $('#service_id').val();
                var type="sidebar";
                //we return all the users whose role match with the schedule role
                var url = BASE_URL+"/admin/rooster/searchuser/"+type+"/"+keyword+"/"+schedule_id;
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "html",
                    success: function (data) {
                        $('.searchbaruser_right_sidebarbox').html(data);

                    }
                });

            });


            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css("color");

                function rgba2hex(color_value) {
                    if (!color_value) return false;
                    var parts = color_value.toLowerCase().match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/),
                            length = color_value.indexOf('rgba') ? 3 : 2; // Fix for alpha values
                    delete(parts[0]);
                    for (var i = 1; i <= length; i++) {
                        parts[i] = parseInt(parts[i]).toString(16);
                        if (parts[i].length == 1) parts[i] = '0' + parts[i];
                    }
                    return '#' + parts.join('').toUpperCase(); // #F7F7F7
                }

                $('.colorinput').val(rgba2hex($(this).css("color")));
                //Add color effect to button
                $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
            });
            $("#add-new-event").click(function (e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $("#new-event").val();
                if (val.length == 0) {
                    return;
                } else if ($('.choosecolor').find('.colorinput').val().trim().length == 0) {
                    return;
                }

                $('#formsaveconnecteduser').submit();

//                //Create events
//                var event = $("<div />");
//                event.css({
//                    "background-color": currColor,
//                    "border-color": currColor,
//                    "color": "#fff"
//                }).addClass("external-event");
//                event.html(val);
//                $('#external-events').prepend(event);
//
//                //Add draggable funtionality
////                ini_events(event);
//                initCalendarDragNDrop(event);



                //Remove event from text input
                $("#new-event").val("");
            });

            $('.choosecolor')
                    .colorpicker()
                    .on('change', function (e) {

                        currColor = $(this).find('.colorinput').val();
                        $('#add-new-event').css({
                            "background-color": $(this).find('.colorinput').val(),
                            "border-color": $(this).find('.colorinput').val()
                        });
                    })

        }
//
//

        function fullcalendarDayClick(startDate,user,schedule_id){


            $('.tab-delete').hide();


            $('#schedule_form')[0].reset();
            var fetchDate = moment(startDate).format('YYYY-MM-DD');


            var exp = fetchDate.split("-");
//
            var fetchDatech = exp[2] + "-" + exp[1] + "-" + exp[0];

            $("#date_from").datepicker("update", fetchDatech);
            $("#date_untill").datepicker("update", fetchDatech);
            $("#date_from_recur").datepicker("update", fetchDatech);
            $("#date_untill_recur").datepicker("update", fetchDatech);

            var time = startDate.format();

            var add_minutes = function (dt, minutes) {
                return new Date((dt.getTime() + minutes * 60000));
            }
            time = time.split('T');
            var dt = time[1].split(":");
            var tt = dt[0] + ":" + dt[1];


            $("#time_from").timepicker("setTime", tt);

            function addMinutes(time, minsToAdd) {


                function D(J) {
                    return (J < 10 ? '0' : '') + J;
                };
                var piece = time.split(':');
                var mins = piece[0] * 60 + +piece[1] + +minsToAdd;

                return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
            }

            var plus15 = addMinutes(tt, '15');


            $("#time_untill").timepicker("setTime", plus15);

            $('#schedule_id').val(schedule_id);


            $('#month').val(exp[1]);


            $('.delbtn').hide();
            $('#recur_edit_modebox').hide();
            $('.modtil').html("Add Schedule");
            $('#schedule_form').attr('action', BASE_URL+'/admin/rooster/saveScheduleEvent');
            loadConnectedUsersOnpopup();
            basedOnstartDate(); //change things based on start date
            $('#eventModal').modal('show');

        }


        function loadSmallCalendar(scheduleid,url_user){
            $('#calendarsmall'+scheduleid).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: 'true',
                todayBtn: 'true',
                todayHighlight: 'true',
                orientation: 'auto top',
                language: 'nl'

            }).on('changeDate', function(ds) {
                console.log(ds.format())

                //$('#tab2').trigger("shown.bs.tab");
                window.location.href = BASE_URL+"/admin/rooster/"+url_user+"/"+scheduleid+"/"+ds.format();
            });
        }

        function loadConnectedUsers(user_id){

            $.ajax({
                url: BASE_URL+'/admin/rooster/load-connected-users/'+user_id,
                type : "GET",
                dataType: 'html',

            }).done (function(data) {
                $( ".connected_users").html(data);
                ini_events($('#external-events div.external-event'));
            }).fail (function(){
                alert("Error")
            });



            //$( ".connected_users" ).load(BASE_URL+'/admin/rooster/load-connected-users');
        }


        function loadBookedUsers(schedule_id){



            $.ajax({url: BASE_URL+'/admin/rooster/load-booked-reservate-users/'+schedule_id, success: function(result){
                $( ".bookedreservaterow" ).html(result);
            }});

//            initCalendarDragNDrop();


        }


        function changeCounting(ds) {
            if ($(ds).val() == "forever") {
                $('.untillinput').hide();
                $('.fordate').hide();
            }
            else if ($(ds).val() == "for") {
                $('.untillinput').show();
                $('.fordate').hide();
            }
            else if ($(ds).val() == "untill") {
                $('.untillinput').hide();
                $('.fordate').show();
            }

        }

        function changeService(ds) {


            $("#service_id").val($("#changeSe option:selected").val());
            var max_users = $("#changeSe option:selected").attr('max_users');

            $('#max_user_count').text(max_users);
        }

        function chooseReccuringSchedule(ds) {



            if ($(ds).val().trim() == "daily") {
                $('.daily').show();
                $('.toplabel').html(" <b>" + $(ds).val() + "</b> ")
                $('.weeklydays').hide();
                $('.monthly').hide();
                $('.yearly').hide();
            }
            else if ($(ds).val().trim() == "weekly") {
                $('.daily').show();
                $('.weeklydays').show();
                $('.monthly').hide();
                $('.yearly').hide();
            }
            else if ($(ds).val().trim() == "monthly") {
                $('.daily').show();
                $('.monthly').show();
                $('.weeklydays').hide();
                $('.yearly').hide();
            }
            else if ($(ds).val().trim() == "yearly") {
                $('.daily').show();
                $('.yearly').show();
                $('.monthly').hide();
                $('.weeklydays').hide();

            }
            else {
                $('.daily').hide();
                $('.weeklydays').hide();
            }


        }


        function basedOnstartDate(){











                   $("#date_from").datepicker({format: 'dd-mm-yyyy',}).
                            on('changeDate', function(e) {

                                var date=e.format().split("-");
                                var month=date[1];
                                var day=date[2];
                                var year=date[0];
                                var optionsM='<option value="'+day+'">'+day+' day</option>';
                                var optionsY='<option value="'+day+'">'+day+' day in '+month+'</option>';

                                $('#monthdayoption').html(optionsM);
                                $('#yearday').html(optionsY);

                               $("#date_untill").datepicker("update", e.format());
                               $("#date_from_recur").datepicker("update", e.format());
                    });

            $("#date_untill").datepicker({format: 'dd-mm-yyyy',}).
                    on('changeDate', function(e) {

                        var date=e.format();
                        if(date < $("#date_from").val()){

                            $("#date_from").datepicker("update", e.format());
                            $("#date_from_recur").datepicker("update", e.format());


                        }
                    });




        }


        function editConnectedUser(color, rowid,userid, username) {


            var url=BASE_URL+"/admin/rooster/updateConnectedUser/"+rowid

            $('#formsaveconnecteduser').attr('action',url);

            $('.user_id_connected').val(userid);
            $('.row_id').val(rowid);
            $('.colorinput').val(color);
            $('#new-event').val(username);
            $('#add-new-event').text("Update");
            $('#add-new-event').css('background-color',color);

        }


//        function clickoption(ds) {
//            var id = $(ds).find('#user-id').val();
//            var name = $(ds).find('.title').html();
//
//            $('.searchbaruser').val(name);
//            $('.searchuser').val(id);
//            $('.searchresultsbox').hide();
//
//        }


        function loadConnectedUsersOnpopup(){

            $(".searchsuserwithrole").keyup(function () {

                if (!$("#service_id").val()) {
                    $('.searchsuserwithrolebox').html('<label id="fullname-error" class="error" for="fullname">Please choose service first</label>');

                    $('.tab-add').addClass('active');
                    $('.tab-add .nav-link').addClass('active');
                    $('#schedule').addClass('active');
                    $('.tab-edit').removeClass('active');
                    $('.tab-edit .nav-link').removeClass('active');
                    $('#bookuser').removeClass('active');
                    $('.searchsuserwithrole').val("");
                    $('#changeSe').addClass('red-border');

                    return;
                }
                if ($(".searchsuserwithrole").val().trim().length == 0) {
                    return;
                }
                $('.searchsuserwithrolebox').show();

                var keyword = $(this).val();
                var service_id = $('#service_id').val();
                var type="popup";
                var url = BASE_URL + "/admin/rooster/searchuser/"+type+"/" + keyword + "/" + service_id;
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "html",
                    success: function (data) {
                        $('.searchsuserwithrolebox').html(data);

                    }
                });

            });




        }

        function removethisr(id){

        $('.user_r_row_'+id).remove();

        }
        function removethisb(id){

        $('.user_b_row_'+id).remove();

        }



    </script>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>