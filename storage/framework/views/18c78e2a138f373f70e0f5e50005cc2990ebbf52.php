
<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('exercises/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>">

    <style>
        .widthc{width:120px;}
        .customheight{min-height: 75px;}
        .predefined-schema-grid{display: none}
        .color-cus-black{color:#000 !important;}
        .save-btn-cus{  width: 122px;}
        .imagesize_logo{
            height: 40px;
            width: 40px;
        }
        .cus-width-btn{width:100px}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Exercises</h2>
            <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </header>




        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-grav active"></i>&nbsp; Exercises</a></li>
            </ol>
        </section>




        

        <div class="row">

            <?php echo $__env->make('admin.exercises.droparea', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="col-md-9">

                <div class="exercises-grid">


                    <div class="tabs">
                        <ul class="nav nav-tabs tabs-primary justify-content-end">
                            <li class="nav-item ">
                                <a  onclick="showpredefinedview()" class="nav-link" href="#popular7" data-toggle="tab"> Opgeslagen schema’s </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#recent7" data-toggle="tab">Groep toevoegen </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="modal" data-target="#productModaladd" href="#recent7" data-toggle="tab">Oefening toevoegen
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="popular7" class="tab-pane active">

                                <?php echo $__env->make('admin.exercises.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <?php echo $__env->make('admin.exercises.grid_view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <hr>
                                

                                    
                                        
                                            
                                        
                                    

                                
                                 </div>

                        </div>
                    </div>




                

                    
                        
                            
                                
                                
                                    
                                    
                                    
                                
                                

                                
                            
                        
                    

                
                

                    
                        
                            
                        
                    

                
                </div>
                <div class="predefined-schema-grid">
                    <div class="row">

                        <div class="col-md-12">
                            <section class="col-md-12 card mb-4">
                                <div class="card-body customheight">
                                    
                                    
                                        
                                    


                                    <div class="input-group input-group-sm col-md-12">
                                        <input type="text" class="form-control search_keyword" placeholder="e.g, shemaname, username," >
                    <span class="input-group-btn  ">
                      <button type="button" class="btn btn-primary btn-flat" onclick="searchPrdefinedResults(this)">Search!</button>
                    </span>
                                        <button type="button" class="btn btn-default" onclick="showexerciseview()"><i class="fa  fa-arrow-circle-left"></i> Back</button>

                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 ">
                            <section class="col-md-12 card mb-4 predefinedgrid">

                            </section>
                        </div>

                    </div>


                    </div>


            </div>



        </div>
        <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="<?php echo e(route('admin.addExerciseGroupRqst')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-header">
                            <h5 class="modal-title">Add Exercise Group</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="groupname">Group name</label>
                                <input type="text" name="groupname" class="form-control" id="groupname"
                                       aria-describedby="grpnameHelp"
                                       placeholder="Enter group name" required>
                                <small id="grpnameHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('site_scripts'); ?>

    <script type="text/javascript" src="<?php echo e(asset('exercises/exercises.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>