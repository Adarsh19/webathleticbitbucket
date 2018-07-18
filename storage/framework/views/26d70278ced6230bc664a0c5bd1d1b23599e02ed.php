<div class="modal-content" style="background: none;border:none;" >
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('exercises/wowslider.css')); ?>" />
    <!-- End WOWSlider.com HEAD section -->

    
        
        
    
    <div class="modal-body">
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    <?php $__currentLoopData = $predefined_schema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$predefined_schema_inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($predefined_schema_inner->imagepath)): ?>
                    <li>
                        <img src="<?php echo e(asset('admin/images/groups/exercises/'.$predefined_schema_inner->imagepath)); ?>" alt="<?php echo e($predefined_schema_inner->imagepath); ?>" title="<?php echo e($predefined_schema_inner->name); ?>" id="wows1_0"/>Sets: <?php echo e($predefined_schema_inner->sets); ?> Reps: <?php echo e($predefined_schema_inner->reps); ?> Rust: <?php echo e($predefined_schema_inner->rust); ?></li>
                    <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul></div>
            <div class="ws_thumbs">
                <div>
                    <?php $__currentLoopData = $predefined_schema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$predefined_schema_inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($predefined_schema_inner->imagepath)): ?>
                    <a href="#" title="<?php echo e($predefined_schema_inner->imagepath); ?>"><img src="<?php echo e(asset('admin/images/groups/exercises/'.$predefined_schema_inner->imagepath)); ?>" alt="" /></a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="ws_shadow"></div>
        </div>
        <script type="text/javascript" src="<?php echo e(asset('exercises//wowslider.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('exercises/script.js')); ?>"></script>
        <!-- End WOWSlider.com BODY section -->
    </div>
</div>

