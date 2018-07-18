

<?php $__env->startSection('title','Tests'); ?>

<?php $__env->startSection('style'); ?>

<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="content-body">

    <header class="page-header">
        <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>

    <section class="content-header">
        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Test</a></li>
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
        <section class="card col-md-12">
            <div class="card-body">
                        
                <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="<?php echo e(route('admin.tests.store')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="0">
                    <div class="form-row">
                        <?php if(isAdmin()): ?>
                        <div class="form-group col-md-6">
                           <label for="name">Name</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="test_name" class="form-control" id="test_name" >
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-4">
                           <label for="name">Type</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="type" id="test_type" class="form-control">
                                    <option value="Predefined">Predefined</option>
                                    <option value="Test">Company Test</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group col-md-6 test_type">
                           <label for="name">Company</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="company_id" class="form-control">
                                    <option value="0">Predefined Test</option>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($c->id); ?>" <?php echo e(old('company_id')?(e(old('company_id'))==$c->id?'selected':''):''); ?>

                                        ><?php echo e($c->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                           
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="form-group col-md-12">
                           <label for="name">Name</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="test_name" class="form-control" id="test_name" >
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group col-md-12">
                           <label for="surname" class="control-label">Description</label>
                           <div class="input-group">
                                <textarea name="description" class="form-control" id="description" ></textarea>
                             </div>
                        </div>

                    </div><br><br>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                           <br><br> <b>Questions</b><br>
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="mt-repeater col-md-12 ">
                            <div class="tbheader">
                                <div class="row ">
                                    <div class="col-md-6"><label>Question</label></div>
                                    <div class="col-md-4"><label>Type</label></div>
                                    <div class="col-md-1"><label>Graph</label></div>
                                    <div class="col-md-1"><a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add hide">
                                                <i class="fa fa-plus"></i> </a></div>
                                </div>
                                <hr>
                            </div>
                            <div data-repeater-list="questions" class="item-stripe">
                                <div data-repeater-item class="row item-stripe-child"> 
                                    <div class="col-sm-6">
                                        <div class="form-group form-md-line-input" style="padding:0px;">
                                            <div class="col-md-12" style="padding:0px;">
                                                <input type="hidden" name="question_id" value="0">
                                                <input type="text" name="question" rows="1" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group form-md-line-input">
                                        <select name="type" class="form-control">
                                            <option type="text">Text Input</option>
                                            <option type="date">Datepicker</option>
                                            <option type="file">File Uploader</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 form-group form-md-line-input">
                                           <input type="checkbox" name="show_graph">
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="hidden" name="id" value="0">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger" style="padding: 2px 12px;">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info btn-flat pull-right">Add</button>
                        </div>
                    </div>
                </form>

            </div>                                   
        </section>
    </div>                    <!-- end: page -->
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('admin_files/js/jquery.repeater.js')); ?>"></script>

<script type="text/javascript">
     var $repeater = $('.mt-repeater').repeater();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>