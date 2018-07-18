<?php $__currentLoopData = $predefined_schemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$predefined_schema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


        <section class="card card-featured-left card-featured-primary mb-4">
            <div class="card-body">
                <div class="widget-summary widget-summary-sm">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <input type="hidden" name="scheduleid" value="<?php echo e($predefined_schema->id); ?>">
                    <div class="widget-summary-col">
                        <a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#delete-modal-pp<?php echo e($predefined_schema->schedule_id); ?>"><i class="fa fa-trash"></i> </a>

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
                                
                                <span class="text-primary">
                                   <?php if(strlen($predefined_schema->startdate)): ?>

                                        <?php echo e(\Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y')); ?> - <?php echo e(\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y')); ?>


                                    <?php endif; ?>
                                </span>
                            </div>
                            <a class=" text-uppercase color-cus-black">Recurring: <?php echo e($predefined_schema->recurring); ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        
            
                

                
                
                    
                        
                            
                        
                    
                    
                        
                            
                            
                                
                        
                            

                                
                                    
                                

                            
                                
                            
                        
                            
                            
                                
                        
                            

                                

                            
                        
                            
                        
                        
                            
                        
                    
                
            
        




    
   
        
            
                
                

                
                    
                    
                    
                    
                    
                        
                        
                            
                        
                            
                    
                    
                        
                        

                    
                
                
            




        


       <div id="delete-modal-pp<?php echo e($predefined_schema->schedule_id); ?>" class="modal modal-danger fade">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">

                       <h4 class="modal-title color-cus-black">
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
                       <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteAddedRqst', $predefined_schema->schedule_id)); ?>">
                           <?php echo e(csrf_field()); ?>

                           <?php echo e(method_field('DELETE')); ?>

                           <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                       </form>
                   </div>
               </div>
               <!-- /.modal-content -->
           </div>
       </div>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>