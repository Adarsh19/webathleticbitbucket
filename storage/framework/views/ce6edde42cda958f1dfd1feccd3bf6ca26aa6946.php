
<h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3"><?php echo e(count($predefined_schemas)); ?> Predefined Schedules</h5>

<?php $__currentLoopData = $predefined_schemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$predefined_schema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 ">
 <section ondragstart="scheduleboxdrg(this)"  ondragend="scheduledragend(this)" class=" card card-featured-left card-featured-primary mb-4" onclick="showCarosel('<?php echo e($predefined_schema->schedule_id); ?>')" id="scheduleid_<?php echo e($predefined_schema->schedule_id); ?>" draggable="true">
    <div class="card-body">
        <input type="hidden" name="scheduleid" value="<?php echo e($predefined_schema->id); ?>">
        <div class="widget-summary">
            <div class="widget-summary-col widget-summary-col-icon">
                <div class="summary-icon bg-primary">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
            <div class="widget-summary-col">

                <a href="<?php echo e(route('admin.showPdfRoute',$predefined_schema->schedule_id)); ?>" class="pull-right btn-box-tool" target="_blank"><i class="fa fa-print"></i> PDF</a>

                <div class="summary">
                    <h4 class="title"><?php echo e($predefined_schema->schema_name); ?></h4>
                    <div class="info">
                        <strong class="amount">Days</strong>
                        <span class="text-primary">
                            <?php if(strlen($predefined_schema->days)): ?>

                                    <?php $__currentLoopData = get_day_names_from_digit($predefined_schema->days); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php echo e($day); ?> |
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>
                                --
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info">
                        <strong class="amount">Range</strong>
                        <span class="text-primary">
                            <?php if(strlen($predefined_schema->startdate)): ?>

                            <?php echo e(\Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y')); ?> - <?php echo e(\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y')); ?>


                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <div class="summary-footer">
                    <a class="text-muted text-uppercase">Recurring: <?php echo e($predefined_schema->recurring); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
<div  id="slider_<?php echo e($predefined_schema->schedule_id); ?>" class="og-expander slider" style="background-color: white;display: none">


</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<div class="modal fade" id="carosselModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog contenthere modal-lg" role="document" style="width: 80%">

    </div>
</div>




