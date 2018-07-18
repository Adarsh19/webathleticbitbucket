 
        
    
        

            
                

                    

            
            
                

                
            

        

    


 <section class="color-cus-black">

     <div class="card-body">
         <div class="content">
             <ul class="simple-user-list userbar_products_ul">
                 <?php if(!empty($user)): ?>
                 <li  style="cursor: pointer" >
                 <a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>
                     <input type="hidden" class="userids" id="user-id" value="<?php echo e($user->id); ?>">
                     <figure class="image rounded">
                         <img src="<?php echo e(asset('site_images/'.$user->avatar)); ?>" alt="<?php echo e($user->name); ?>"  onerror=this.src="<?php echo e(asset('admin_files/img/!sample-user.jpg')); ?>" class="rounded-circle imagesize_logo">
                     </figure>
                     <span class="title"><?php echo e($user->name); ?></span>
                     <span class="message truncate"><?php echo e($user->email); ?></span>
                 </li>
                     <?php else: ?>
                     <li>Please select user</li>
                     <?php endif; ?>
             </ul>
         </div>
     </div>
 </section>
