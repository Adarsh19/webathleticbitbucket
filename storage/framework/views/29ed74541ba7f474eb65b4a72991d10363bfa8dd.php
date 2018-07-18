


    
        
    
    
    
    
    





    <?php $__currentLoopData = $ordersdrop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <section class="toggle">
            <label>

                <div>
                <span class="text price">$<?php echo e($order->price); ?> (+<?php echo e($order->tax); ?>)</span>
                <small class="label label-danger quantity"> <?php echo e($order->quantity); ?> </small>  &nbsp;&nbsp;<span>  <?php echo e($order->name); ?></span>
                </div>
                <div class="tools pull-right tooltipicons">
                    <i class="fa fa-edit" data-toggle="modal" data-target="#edit-cartitem-modal-<?php echo e($order->productid); ?>"></i>
                    <i class="fa fa-trash-o" data-toggle="modal" data-target="#delete-cartitem-modal-<?php echo e($order->productid); ?>"></i>
                </div>
            </label>



        </section>


    
        
                      
                        
                        
                      

        
        
        
        
        
        
            
            
        
    

        <div id="delete-cartitem-modal-<?php echo e($order->productid); ?>" class="modal modal-danger fade" style="color: #000">
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
                        <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteCartItemRqst',$order->productid )); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="userid" value="<?php echo e($order->userid); ?>">
                            <input type="hidden" name="orderid" value="<?php echo e($order->orderid); ?>">
                            <?php echo e(method_field('DELETE')); ?>

                            <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div id="edit-cartitem-modal-<?php echo e($order->productid); ?>" class="modal modal-info fade">
        <div class="modal-dialog" role="document">


            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.editCartItemRqst',$order->productid)); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="userid" value="<?php echo e($order->userid); ?>">
                    <input type="hidden" name="orderid" value="<?php echo e($order->orderid); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #464646">Update Cart item</h5>
                    </div>
                    <div class="modal-body">
                        <table class="tile_info">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group col-md-12 " style="color: black">
                                        <label for="videoname">Product name</label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group col-md-12" style="color: black">
                                        <label for="price">Product Price</label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group col-md-12" style="color: black">
                                        <label for="price">Quantity</label>

                                    </div>
                                </td>
                            </tr>
                                <tr>
                                    <td>
                                        <div class="form-group col-md-12">

                                            <input type="text" name="name" class="form-control"
                                                   aria-describedby="grpnameHelp"
                                                   placeholder="Enter product name" value="<?php echo e($order->name); ?>" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-12">
                                            <input type="price" name="price"  value="<?php echo e($order->price); ?>"class="form-control" required>
                                             </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-12">
                                            <input type="price" name="quantity"  value="<?php echo e($order->quantity); ?>"class="form-control" required>


                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        </div>









    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


