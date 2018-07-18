<style>
    .cellmarginright{margin-right:50px}
    .variationbox{    height: 245px;
        padding: 18px;}
    .card-cus{
        width: 220px;
        height: 245px;
        float:left;
        margin-right: 5px;
    }
    .card-img{
        object-fit: cover !important;
        width: 100%; display: block;
    }
    .plusicon{
        cursor: pointer;
        font-size: 44px;
        color: #fff !important;
    }
    .multipleproduct{
        position: absolute;top:0;
        z-index: 100000;;
        background: white;
        display: none;
    }
</style>
<?php if(!strlen(Request::segment(3))): ?>

<div class="">

                        
                            
                        
                        <ul id="products1">



                            
                            
                                
                                    
                                
                            

                            
                                
                                    
                                
                            
                            
                            <?php if(sizeof($productgroups) > 0 ): ?>
                                <?php $__currentLoopData = $productgroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                        <div class="card card-cus">
                                        <div class="itempro thumbnail " id="<?php echo e($productgroup->name); ?>">
                                            <div class="image view view-first">
                                                <img  class="card-img" src="<?php echo e(asset('admin/images/groups/products/'.$productgroup->imagepath)); ?>" alt="image" />
                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        
                                                        <a href="#" data-toggle="modal" data-target="#edit-modal<?php echo e($productgroup->id); ?>"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal<?php echo e($productgroup->id); ?>"><i class="fa fa-times"></i></a>
                                                        <a href="<?php echo e(route('admin.showSubGroupRqst',$productgroup->slug)); ?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    <p><?php echo e($productgroup->name); ?></p>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><strong>Group:</strong>  <?php echo e($productgroup->name); ?></p>
                                            </div>
                                        </div>
                                        </div>
                                   


                                    <div class="modal fade" id="edit-modal<?php echo e($productgroup->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="<?php echo e(route('admin.editGroupRqst',$productgroup->id)); ?>">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Sub Group</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="groupname">Group name</label>
                                                            <input type="hidden" name="parent_id" value="<?php echo e($productgroup->id); ?>"/>
                                                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
                                                                   placeholder="Enter group name" value="<?php echo e($productgroup->name); ?>" required>
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

                                    <div id="delete-modal<?php echo e($productgroup->id); ?>" class="modal modal-danger fade" >
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
                                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteProductSubGrpRqst',$productgroup->id)); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <?php endif; ?>


                            <?php if(sizeof($products) > 0 ): ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card card-cus">
                                        <div <?php if($product->total>1): ?>  onclick="openmulipopup()"  <?php endif; ?> class="itempro thumbnail " id="p_<?php echo e($product->id); ?>" <?php if($product->total==1): ?> draggable="true" <?php else: ?> style="cursor: pointer"<?php endif; ?>>

                                            <div class="image view view-first">
                                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$product->path)); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>" />
                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        <?php if($product->total==1): ?>
                                                        
                                                        <a href="#" data-toggle="modal" data-target="#productModal<?php echo e($product->id); ?>"><i class="fa fa-edit"></i></a>

                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-p<?php echo e($product->id); ?>"><i class="fa fa-times"></i></a>
                                                        <?php endif; ?>

                                                    </div>
                                                    <p><?php echo e($product->name); ?></p>

                                                    <?php if($product->total>1): ?>
                                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                                        <?php else: ?>
                                                        <a  class="plusicon" onclick="createOrder('p_<?php echo e($product->id); ?>')"><i class="fa fa-plus"></i></a>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span><?php echo e($product->name); ?></span> </p>
                                                <p><strong>Price</strong>: <span>$ <?php echo e($product->price); ?></span> <strong>Qty</strong>: <span><?php echo e($product->stock); ?>  <?php if(isset($orders[$product->id])): ?><strong>Sold </strong>: <span><?php echo e($orders[$product->id]); ?></span><?php endif; ?></span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($product->total==1): ?>
                                        <div class="modal fade" id="productModal<?php echo e($product->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="<?php echo e(route('admin.editProductRqst',$product->id)); ?>" enctype="multipart/form-data">
                                                        <?php echo e(csrf_field()); ?>

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Products </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="vary">
                                                            <div class="box thumbnail variationbox">
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="videoname">Product name</label>
                                                                    <input type="hidden" name="group_id" value="<?php echo e($product->id); ?>"/>
                                                                    <input type="text" name="productname" class="form-control" value="<?php echo e($product->name); ?>"  aria-describedby="grpnameHelp"
                                                                           placeholder="Enter product name" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="imagefile">Product Image file</label>
                                                                    <input type="file" name="imagefile" class="form-control">






                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="price">Product Price</label>
                                                                    <input type="price" name="price" class="form-control" value="<?php echo e($product->price); ?>"  required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="tax">Product Tax</label>
                                                                    <input type="tax" name="tax" class="form-control" value="<?php echo e($product->tax); ?>" required>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="stocktype">Stock Type</label>
                                                                    <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product->unlimited_stock); ?>" class="stocktype form-control" required>

                                                                        <option value="1">Unlimited</option>
                                                                        <option value="0">Limited</option>
                                                                    </select>

                                                                </div>
                                                                <div class="form-group col-md-6 stockbox" <?php if($product->unlimited_stock): ?> style="display: none";  <?php else: ?> style="display: block";  <?php endif; ?>>
                                                                    <label for="stock">Product Stock</label>
                                                                    <input type="number" name="stock"  value="<?php echo e($product->stock); ?>" class="form-control">
                                                                </div>
                                                                </div>



                                                            </div>
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
                                    <?php endif; ?>


                                    <?php if($product->total>1): ?>
                                        <div id="multipleProductsModal<?php echo e($product->id); ?>" class="multipleproduct">
                                            <div class="modal-dialog1" role="document">


                                                <div class="modal-header">
                                                    <h4>Variation products for <strong> <?php echo e($product->name); ?></strong></h4>
                                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline " style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                                </div>
                                                <?php $__currentLoopData = $variations[$product['category']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-6">
                                                        <div class="itempro thumbnail " id="<?php echo e($variation['id']); ?>" draggable="true">
                                                            <div class="image view view-first">
                                                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$variation['path'])); ?>" alt="image"  onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>"/>

                                                                <div class="mask">

                                                                    <div class="tools tools-bottom">
                                                                        <a href="#" data-toggle="modal" data-target="#productModalv<?php echo e($variation['id']); ?>"><i class="fa fa-edit"></i></a>
                                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv<?php echo e($variation['id']); ?>"><i class="fa fa-times"></i></a>

                                                                    </div>

                                                                    <p><?php echo e($variation['name']); ?></p>
                                                                    <a  class="plusicon" onclick="createOrder('p_<?php echo e($variation['id']); ?>')"><i class="fa fa-plus"></i></a>

                                                                </div>
                                                            </div>
                                                            <div class="caption">

                                                                <p><span><?php echo e($variation['name']); ?></span> </p>
                                                                <p><strong>Price</strong>: <span>$ <?php echo e($variation['price']); ?></span> <strong>Qty</strong>: <span><?php echo e($variation['stock']); ?>  <?php if(isset($orders[$variation['id']])): ?><strong>Sold </strong>: <span><?php echo e($orders[$variation['id']]); ?></span><?php endif; ?></span></p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="delete-modal-pv<?php echo e($variation['id']); ?>" class="modal modal-danger fade">
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
                                                                    <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteProductRqst',$variation['id'] )); ?>">
                                                                        <?php echo e(csrf_field()); ?>

                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>



                                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv<?php echo e($variation['id']); ?>"  class="modal modal-danger fade">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="<?php echo e(route('admin.editProductRqst',$variation['id'])); ?>" enctype="multipart/form-data">
                                                                    <?php echo e(csrf_field()); ?>

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Products to </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="vary">
                                                                            <div class="box thumbnail variationbox">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="videoname">Product name</label>
                                                                                        <input type="hidden" name="group_id" value="<?php echo e($product['id']); ?>"/>
                                                                                        <input type="text" name="productname" class="form-control" value="<?php echo e($product['name']); ?>"  aria-describedby="grpnameHelp"
                                                                                               placeholder="Enter product name" required>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="imagefile">Product Image file</label>
                                                                                        <input type="file" name="imagefile" class="form-control" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="price">Product Price</label>
                                                                                        <input type="price" name="price" class="form-control" value="<?php echo e($product['price']); ?>"  required>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="tax">Product Tax</label>
                                                                                        <input type="tax" name="tax" class="form-control" value="<?php echo e($product['tax']); ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="stocktype">Stock Type</label>
                                                                                        <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product['unlimited_stock']); ?>" class="stocktype form-control" required>

                                                                                            <option value="1">Unlimited</option>
                                                                                            <option value="0">Limited</option>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="form-group col-md-6 stockbox" <?php if($product['unlimited_stock']): ?> style="display: none";  @elsestyle="display: block";  <?php endif; ?>>
                                                                                        <label for="stock">Product Stock</label>
                                                                                        <input type="number" name="stock" value="<?php echo e($product['stock']); ?>" class="form-control">
                                                                                    </div>
                                                                                </div>



                                                                            </div>
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



                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div id="delete-modal-p<?php echo e($product->id); ?>" class="modal modal-danger fade">
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
                                                    <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteProductRqst',$product->id )); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>



                        </ul>
                    </div>



<div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('admin.addProductRqst')); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <h5 class="modal-title">Add Products</h5>
                </div>
                <div class="modal-body">
                    <div class="vary">
                    <div class="box thumbnail variationbox">
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="videoname">Product name</label>
                            <input type="hidden" name="group_id" value=""/>
                            <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                   placeholder="Enter product name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imagefile">Product Image file</label>
                            <input type="file" name="imagefile[]" class="form-control" >
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Product Price</label>
                            <input type="price" name="price[]" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tax">Product Tax</label>
                            <input type="tax" name="tax[]" class="form-control"  required>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="stocktype">Stock Type</label>
                            <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                <option value="1">Unlimited</option>
                                <option value="0">Limited</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6 stockbox" style="display: none">
                            <label for="stock">Product Stock</label>
                            <input type="number" name="stock[]" class="form-control">
                        </div>
                        </div>


                    </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>







    <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.addProductGroupRqst')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Group</h5>
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

<?php elseif(Request::segment(3)=="product-group"): ?>
    
    <div class="col-md-12">
        
            
        
        <ul id="products1">


            
                

                    
                
            
            
            
                
                    
                
            
            
                
                    
                
            
            
            <?php if(sizeof($productgroups) > 0 ): ?>
                <?php $__currentLoopData = $productgroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    ?>
                    <div class="card card-cus">
                        <div class="itempro thumbnail " id="<?php echo e($productgroup->name); ?>" >
                            <div class="image view view-first">
                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$productgroup->imagepath)); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>" />
                                <div class="mask">

                                    <div class="tools tools-bottom">
                                        
                                        <a href="#" data-toggle="modal" data-target="#edit-modal<?php echo e($productgroup->id); ?>"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete-modal<?php echo e($productgroup->id); ?>"><i class="fa fa-times"></i></a>
                                        <a href="<?php echo e(route('admin.showSubSubGroupsRqst',$productgroup->slug)); ?>"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <p><?php echo e($productgroup->name); ?></p>
                                </div>
                            </div>
                            <div class="caption">
                                <p><strong> SG: </strong><?php echo e($productgroup->name); ?></p>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="edit-modal<?php echo e($productgroup->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="<?php echo e(route('admin.editGroupRqst',$productgroup->id)); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Sub Group</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="groupname">Group name</label>
                                            <input type="hidden" name="parent_id" value="<?php echo e($productgroup->id); ?>"/>
                                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
                                                   placeholder="Enter group name" value="<?php echo e($productgroup->name); ?>" required>
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


                    <div id="delete-modal<?php echo e($productgroup->id); ?>" class="modal modal-danger fade">
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
                                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteProductSubGrpRqst',$productgroup->id)); ?> ">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(sizeof($products) > 0 ): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card card-cus">
                        <div <?php if($product->total>1): ?>  onclick="openmulipopup()"  <?php endif; ?> class="itempro thumbnail " id="p_<?php echo e($product->id); ?>" <?php if($product->total==1): ?> draggable="true" <?php else: ?> style="cursor: pointer"<?php endif; ?>>

                            <div class="image view view-first">
                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$product->path)); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>" />
                                <div class="mask">


                                    <div class="tools tools-bottom">
                                        <?php if($product->total==1): ?>
                                            
                                            <a href="#" data-toggle="modal" data-target="#productModal<?php echo e($product->id); ?>"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p<?php echo e($product->id); ?>"><i class="fa fa-times"></i></a>
                                        <?php endif; ?>

                                    </div>
                                    <p><?php echo e($product->name); ?></p>

                                    <?php if($product->total>1): ?>
                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                    <?php else: ?>
                                        <a  class="plusicon" onclick="createOrder('p_<?php echo e($product->id); ?>')"><i class="fa fa-plus"></i></a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="caption">
                                <p><span><?php echo e($product->name); ?></span> </p>
                                <p><strong>Price</strong>: <span>$ <?php echo e($product->price); ?></span> <strong>Qty</strong>: <span><?php echo e($product->stock); ?>  <?php if(isset($orders[$product->id])): ?><strong>Sold</strong>: <span><?php echo e($orders[$product->id]); ?></span><?php endif; ?></span></p>

                            </div>
                        </div>
                    </div>

                    <?php if($product->total==1): ?>
                        <div class="modal fade" id="productModal<?php echo e($product->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="<?php echo e(route('admin.editProductRqst',$product->id)); ?>" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Products </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="vary">
                                            <div class="box thumbnail variationbox">
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="videoname">Product name</label>
                                                    <input type="hidden" name="group_id" value="<?php echo e($product->id); ?>"/>
                                                    <input type="text" name="productname" class="form-control" value="<?php echo e($product->name); ?>"  aria-describedby="grpnameHelp"
                                                           placeholder="Enter product name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="imagefile">Product Image file</label>
                                                    <input type="file" name="imagefile" class="form-control">
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Product Price</label>
                                                    <input type="price" name="price" class="form-control" value="<?php echo e($product->price); ?>"  required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tax">Product Tax</label>
                                                    <input type="tax" name="tax" class="form-control" value="<?php echo e($product->tax); ?>" required>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="stocktype">Stock Type</label>
                                                    <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product->unlimited_stock); ?>" class="stocktype form-control" required>

                                                        <option value="1">Unlimited</option>
                                                        <option value="0">Limited</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6 stockbox" <?php if($product->unlimited_stock): ?> style="display: none";  @elsestyle="display: block";  <?php endif; ?>>
                                                    <label for="stock">Product Stock</label>
                                                    <input type="number" name="stock" value="<?php echo e($product->stock); ?>" class="form-control">
                                                </div>
                                                </div>



                                            </div>
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
                    <?php endif; ?>


                    <?php if($product->total>1): ?>
                        <div id="multipleProductsModal<?php echo e($product->id); ?>" class="multipleproduct">
                            <div class="modal-dialog1" role="document">

                                <div class="modal-header">
                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline pull-right" style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                </div>
                                <?php $__currentLoopData = $variations[$product['category']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="itempro thumbnail " id="<?php echo e($variation['id']); ?>" draggable="true">
                                            <div class="image view view-first">
                                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$variation['path'])); ?>" alt="image"  onerror=this.src="<?php echo e(asset('public/web/images/groups/products/noimage.jpeg')); ?>"/>

                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        <a href="#" data-toggle="modal" data-target="#productModalv<?php echo e($variation['id']); ?>"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv<?php echo e($variation['id']); ?>"><i class="fa fa-times"></i></a>

                                                    </div>

                                                    <p><?php echo e($variation['name']); ?></p>
                                                    <a  class="plusicon" onclick="createOrder('p_<?php echo e($variation['id']); ?>')"><i class="fa fa-plus"></i></a>

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span><?php echo e($variation['name']); ?></span> </p>
                                                <p><strong>Price</strong>: <span>$ <?php echo e($variation['price']); ?></span> <strong>Qty</strong>: <span><?php echo e($variation['stock']); ?>  <?php if(isset($orders[$variation['id']])): ?><strong>Sold </strong>: <span><?php echo e($orders[$variation['id']]); ?></span><?php endif; ?></span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="delete-modal-pv<?php echo e($variation['id']); ?>" class="modal modal-danger fade">
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
                                                    <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteProductRqst',$variation['id'] )); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>


                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv<?php echo e($variation['id']); ?>"  class="modal modal-danger fade">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="<?php echo e(route('admin.editProductRqst',$variation['id'])); ?>" enctype="multipart/form-data">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Products to </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="vary">
                                                            <div class="box thumbnail variationbox">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="videoname">Product name</label>
                                                                        <input type="hidden" name="group_id" value="<?php echo e($product['id']); ?>"/>
                                                                        <input type="text" name="productname" class="form-control" value="<?php echo e($product['name']); ?>"  aria-describedby="grpnameHelp"
                                                                               placeholder="Enter product name" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="imagefile">Product Image file</label>
                                                                        <input type="file" name="imagefile" class="form-control" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="price">Product Price</label>
                                                                        <input type="price" name="price" class="form-control" value="<?php echo e($product['price']); ?>"  required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tax">Product Tax</label>
                                                                        <input type="tax" name="tax" class="form-control" value="<?php echo e($product['tax']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="stocktype">Stock Type</label>
                                                                        <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product['unlimited_stock']); ?>" class="stocktype form-control" required>

                                                                            <option value="1">Unlimited</option>
                                                                            <option value="0">Limited</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group col-md-6 stockbox" <?php if($product['unlimited_stock']): ?> style="display: none";  @elsestyle="display: block";  <?php endif; ?>>
                                                                        <label for="stock">Product Stock</label>
                                                                        <input type="number" name="stock" value="<?php echo e($product['stock']); ?>" class="form-control">
                                                                    </div>
                                                                </div>



                                                            </div>
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


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </div>
                        </div>
                    <?php endif; ?>

                    <div id="delete-modal-p<?php echo e($product->id); ?>" class="modal modal-danger fade">
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
                                    <form method="post" role="form" id="delete_form" action=" <?php echo e(route('admin.deleteProductRqst',$product->id )); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>




        </ul>
    </div>


    <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.addProductGroupRqst')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Add Sub Group</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="groupname">Group name</label>
                            <input type="hidden" name="parent_id" value="<?php echo e($group->id); ?>"/>
                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
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

    <div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.addProductRqst')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Add Products to <?php echo e($group->name); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="vary">
                        <div class="box thumbnail variationbox">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="videoname">Product name</label>
                                <input type="hidden" name="group_id" value="<?php echo e($group->id); ?>"/>
                                <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                       placeholder="Enter product name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="imagefile">Product Image file</label>
                                <input type="file" name="imagefile[]" class="form-control">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price">Product Price</label>
                                <input type="price" name="price[]" class="form-control"  required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tax">Product Tax</label>
                                <input type="tax" name="tax[]" class="form-control"  required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stocktype">Stock Type</label>
                                <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                    <option value="1">Unlimited</option>
                                    <option value="0">Limited</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6 stockbox" style="display: none">
                                <label for="stock">Product Stock</label>
                                <input type="number" name="stock[]" class="form-control">
                            </div>
                            </div>

                        </div>

                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php elseif(Request::segment(3)=="product-sub-group"): ?>
    <div class="col-md-9">
        
            
        
        <ul id="products1">


            
                
                    
                
            
            

            
                
                    
                
            
            


            <?php if(sizeof($products) > 0 ): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card card-cus">
                        <div <?php if($product->total>1): ?>  onclick="openmulipopup()" <?php endif; ?> class="itempro thumbnail " id="p_<?php echo e($product->id); ?>" <?php if($product->total==1): ?> draggable="true" <?php else: ?> style="cursor: pointer"<?php endif; ?>>
                            <div class="image view view-first">
                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$product->path)); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>" />

                                <div class="mask">

                                    <div class="tools tools-bottom">
                                        <?php if($product->total==1): ?>
                                            
                                            <a href="#" data-toggle="modal" data-target="#productModal<?php echo e($product->id); ?>"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p<?php echo e($product->id); ?>"><i class="fa fa-times"></i></a>
                                        <?php endif; ?>

                                    </div>
                                    <p><?php echo e($product->name); ?></p>

                                    <?php if($product->total>1): ?>
                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                    <?php else: ?>
                                        <a  class="plusicon" onclick="createOrder('p_<?php echo e($product->id); ?>')"><i class="fa fa-plus"></i></a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="caption">
                                
                                <p><span><?php echo e($product->name); ?></span> </p>
                                <p><strong>Price</strong>: <span>$ <?php echo e($product->price); ?></span> <strong>Qty</strong>: <span><?php echo e($product->stock); ?>  <?php if(isset($orders[$product->id])): ?><strong>Sold</strong>: <span><?php echo e($orders[$product->id]); ?></span><?php endif; ?></span></p>
                            </div>
                        </div>
                    </div>


                    <?php if($product->total==1): ?>
                        <div class="modal fade" id="productModal<?php echo e($product->id); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="<?php echo e(route('admin.editProductRqst',$product->id)); ?>" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Products to <?php echo e($subgroup->name); ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="vary">
                                            <div class="box thumbnail variationbox">
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="videoname">Product name</label>
                                                    <input type="hidden" name="group_id" value="<?php echo e($product->id); ?>"/>
                                                    <input type="text" name="productname" class="form-control" value="<?php echo e($product->name); ?>"  aria-describedby="grpnameHelp"
                                                           placeholder="Enter product name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="imagefile">Product Image file</label>
                                                    <input type="file" name="imagefile" class="form-control" >
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Product Price</label>
                                                    <input type="price" name="price" class="form-control" value="<?php echo e($product->price); ?>"  required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tax">Product Tax</label>
                                                    <input type="tax" name="tax" class="form-control" value="<?php echo e($product->tax); ?>" required>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="stocktype">Stock Type</label>
                                                    <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product->unlimited_stock); ?>" class="stocktype form-control" required>

                                                        <option value="1">Unlimited</option>
                                                        <option value="0">Limited</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6 stockbox" <?php if($product->unlimited_stock): ?> style="display: none";  @elsestyle="display: none";  <?php endif; ?>>
                                                    <label for="stock">Product Stock</label>
                                                    <input type="number" name="stock" value="<?php echo e($product->stock); ?>" class="form-control">
                                                </div>
                                                </div>



                                            </div>
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
                    <?php endif; ?>




                    <?php if($product->total>1): ?>
                        <div id="multipleProductsModal<?php echo e($product->id); ?>" class="multipleproduct">
                            <div class="modal-dialog1" role="document">

                                <div class="modal-header">
                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline pull-right" style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                </div>
                                <?php $__currentLoopData = $variations[$product['category']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="itempro thumbnail " id="<?php echo e($variation['id']); ?>" draggable="true">
                                            <div class="image view view-first">
                                                <img class="card-img" src="<?php echo e(asset('public/admin/images/groups/products/'.$variation['path'])); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/products/noimage.jpeg')); ?>" />

                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        <a href="#" data-toggle="modal" data-target="#productModalv<?php echo e($variation['id']); ?>"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv<?php echo e($variation['id']); ?>"><i class="fa fa-times"></i></a>

                                                    </div>

                                                    <p><?php echo e($variation['name']); ?></p>
                                                    <a  class="plusicon" onclick="createOrder('p_<?php echo e($variation['id']); ?>')"><i class="fa fa-plus"></i></a>

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span><?php echo e($variation['name']); ?></span> </p>
                                                <p><strong>Price</strong>: <span>$ <?php echo e($variation['price']); ?></span> <strong>Qty</strong>: <span><?php echo e($variation['stock']); ?>  <?php if(isset($orders[$variation['id']])): ?><strong>Sold </strong>: <span><?php echo e($orders[$variation['id']]); ?></span><?php endif; ?></span></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="delete-modalv<?php echo e($variation['id']); ?>" class="modal modal-danger fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                        Are you sure want to delete this aa?
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" class="delete_form" action="<?php echo e(route('admin.deleteProductRqst',$variation['id'] )); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>


                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv<?php echo e($variation['id']); ?>"  class="modal modal-danger fade">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="<?php echo e(route('admin.editProductRqst',$variation['id'])); ?>" enctype="multipart/form-data">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Products to <?php echo e($subgroup->name); ?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="vary">
                                                        <div class="box thumbnail variationbox">
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="videoname">Product name</label>
                                                                <input type="hidden" name="group_id" value="<?php echo e($product['id']); ?>"/>
                                                                <input type="text" name="productname" class="form-control" value="<?php echo e($product['name']); ?>"  aria-describedby="grpnameHelp"
                                                                       placeholder="Enter product name" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="imagefile">Product Image file</label>
                                                                <input type="file" name="imagefile" class="form-control" >
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="price">Product Price</label>
                                                                <input type="price" name="price" class="form-control" value="<?php echo e($product['price']); ?>"  required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="tax">Product Tax</label>
                                                                <input type="tax" name="tax" class="form-control" value="<?php echo e($product['tax']); ?>" required>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="stocktype">Stock Type</label>
                                                                <select onchange="channgestock(this)" name="stocktype" value="<?php echo e($product['unlimited_stock']); ?>" class="stocktype form-control" required>

                                                                    <option value="1">Unlimited</option>
                                                                    <option value="0">Limited</option>
                                                                </select>

                                                            </div>
                                                            <div class="form-group col-md-6 stockbox" <?php if($product['unlimited_stock']): ?> style="display: none";  @elsestyle="display: block";  <?php endif; ?>>
                                                                <label for="stock">Product Stock</label>
                                                                <input type="number" name="stock" value="<?php echo e($product['stock']); ?>" class="form-control">
                                                            </div>
                                                            </div>



                                                        </div>
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

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </div>
                        </div>
                    <?php endif; ?>




                    <div id="delete-modal<?php echo e($product->id); ?>" class="modal modal-danger fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                        Are you sure want to delete this aa?
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <form method="post" role="form" class="delete_form" action="<?php echo e(route('admin.deleteProductRqst',$product->id )); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>




        </ul>
    </div>





    <div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.addProductRqst')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Add Products to <?php echo e($subgroup->name); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="vary">
                        <div class="box thumbnail variationbox">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="videoname">Product name</label>
                                <input type="hidden" name="group_id" value="<?php echo e($subgroup->id); ?>"/>
                                <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                       placeholder="Enter product name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="imagefile">Product Image file</label>
                                <input type="file" name="imagefile[]" class="form-control"  >
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price">Product Price</label>
                                <input type="price" name="price[]" class="form-control"  required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tax">Product Tax</label>
                                <input type="tax" name="tax[]" class="form-control"  required>
                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stocktype">Stock Type</label>
                                <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                    <option value="1">Unlimited</option>
                                    <option value="0">Limited</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6 stockbox" style="display: none">
                                <label for="stock">Product Stock</label>
                                <input type="number" name="stock[]" class="form-control">
                            </div>
                            </div>


                        </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>
        function hidebackdrop(){

            $('.modal-backdrop').css('display','none');
        }
    </script>
<?php endif; ?>






