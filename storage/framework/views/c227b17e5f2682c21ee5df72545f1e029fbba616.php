
<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('/admin_files/vendor/animate/animate.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Notifications</h2>
            <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </header>


        <section class="content-header">
            <ol class="breadcrumb breadcrumextra">
                <li><a href="<?php echo e(route('admin.dashboardRoute')); ?>"><i class="fa fa-home"></i> Dashboard </a></li>
                <li class="active"> - Notifications</li>
            </ol>
        </section>


        <!-- start: page -->
        <!-- end: page -->



        <div class="timeline">
            <div class="tm-body">


                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificationouter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                    <div class="tm-title">
                        <h5 class="m-0 pt-2 pb-2 text-uppercase"><?php echo e($notificationouter['created_at']); ?></h5>
                    </div>
                    <ol class="tm-items">
                        <?php $__currentLoopData = $notificationouter['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificationinner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="tm-info">
                                    <div class="tm-icon"><i class="fa fa-star"></i></div>
                                    <time class="tm-datetime" datetime="2017-11-22 19:13">
                                        <div class="tm-datetime-date"><?php echo e(\Carbon\Carbon::parse($notificationinner['created_at'])->diffForHumans()); ?></div>
                                        <div class="tm-datetime-time"><?php echo e(\Carbon\Carbon::parse($notificationinner['created_at'])->format('g:i A')); ?></div>
                                    </time>
                                </div>
                                <div class="tm-box " data-appear-animation="fadeInRight"data-appear-animation-delay="100">
                                    <p>

                                        <?php echo e(str_replace("_",json_decode($notificationinner['data'])->schema_name,Helper::mappings($notificationinner['type']))); ?>

                                    </p>
                                    <div class="tm-meta">
                                    <span>
                                    <i class="fa fa-user"></i> By <a href="#">John Doe</a>
                                    </span>
                                    <span>
                                    <i class="fa fa-tag"></i> <a href="#">Porto</a>, <a href="#">Awesome</a>
                                    </span>
                                    <span>
                                    <i class="fa fa-comments"></i> <a href="#">5652 Comments</a>
                                    </span>
                                    </div>
                                </div>
                            </li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
        </div>
        <!-- end: page -->



    </section>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('site_scripts'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>











<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>