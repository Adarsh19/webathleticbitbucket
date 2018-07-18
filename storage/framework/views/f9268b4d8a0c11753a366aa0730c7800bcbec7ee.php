
    <?php if(empty($users)): ?>
        <h2>Please select User</h2>
    <?php else: ?>

        <section class="" style="margin-top: 10px;" >
            


                
                    
                    
                
            
            <div class="card-body">
                <div class="content">
                    <ul class="simple-user-list color-cus-black addUsersHere">


<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    
            
                
                    

                        

                
                
                    

                    
                
            
    


    <li  style="cursor: pointer" id="userrow_<?php echo e($user->id); ?>">
        <a class="close closebtn"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>
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
            <div class="card-footer">
                <div class="input-group input-search">
                    <input type="text" class="form-control searchbaruder" placeholder="Search user...">
                </div>
            </div>
        </section>

        
    
        
        
        
        
        

        
    
    
        

        
    


<?php endif; ?>

