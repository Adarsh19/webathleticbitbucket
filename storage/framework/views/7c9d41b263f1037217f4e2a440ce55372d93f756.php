
    


    

 
    
        
        
        
        
            

        
    
    
        

        
    
 
 

    

    
       
    





<?php if(count($users)): ?>
    <section class="color-cus-black">
        <header class="card-header">
            <div class="card-actions">
                <a class="card-action card-action-dismiss" data-card-dismiss="" onclick="closeuserlist()"></a>
            </div>

            <h2 class="card-title">
                <span class="badge badge-primary font-weight-normal va-middle p-2 mr-2"><?php echo e(count($users)); ?></span>
                <span class="va-middle">Users</span>
            </h2>
        </header>
        <div class="card-body">
            <div class="content">
                <ul class="simple-user-list">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li  style="cursor: pointer" onclick="clickoptionUserExercises(this)">
                            <input type="hidden" class="userids" id="user-id" value="<?php echo e($user->id); ?>">
                            <figure class="image rounded">
                                <img src="<?php echo e(asset('site_images/'.$user->avatar)); ?>" alt="<?php echo e($user->name); ?>"  onerror=this.src="<?php echo e(asset('admin_files/img/!sample-user.jpg')); ?>" class="rounded-circle imagesize_logo">
                            </figure>
                            <span class="title"><?php echo e($user->name); ?></span>
                            <span class="message truncate"><?php echo e($user->email); ?></span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>
        </div>


    </section>

<?php else: ?>

    <div class="profile clearfix " onclick="clickoption(this)">
        No Results Found
    </div>

<?php endif; ?>

