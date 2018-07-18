<style>
    .scrolling-wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }
    .card {
        display: inline-block;
    }


    .scrolling-wrapper-flexbox {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
    }
    .card {
        flex: 0 0 auto;
    }
    .plusicon{
        cursor: pointer;
        font-size: 44px;
        color: #fff !important;
    }

    .head-margin{margin-top:-5px}
    .slides-margin{margin-top:-20px}

</style>

    <?php if(sizeof($products) > 0 ): ?>

        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyout=>$groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<h5 class="font-weight-semibold text-dark text-uppercase head-margin">Group: <?php echo e($keyout); ?></h5>
            
                

            





            <div class="slides">



                <div class="products2 connectedSortable sortablegroups<?php echo e($keyout); ?> scrolling-wrapper" id="products12"  >
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                        <?php if(isset($product['id'])): ?>
                            <div class="card ">
                            <div   class="itemp thumbnail " id="p_<?php echo e($product['id']); ?>" draggable="true"   >

                                <div class="image view view-first">
                                    <img style="object-fit: cover;width: 100%; display: block;height: 175px;" src="<?php echo e(asset('admin/images/groups/exercises/'.$product['path'])); ?>" alt="image" onerror=this.src="<?php echo e(asset('admin/images/groups/exercises/noimage.jpeg')); ?>" />
                                    <div class="mask">

                                        <div class="tools tools-bottom">
                                            
                                            <a href="#" data-toggle="modal" data-target="#productModal<?php echo e($product['id']); ?>"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p<?php echo e($product['id']); ?>"><i class="fa fa-times"></i></a>

                                            
                                        </div>
                                        <p><?php echo e($product['name']); ?></p>
                                        <a class="plusicon" onclick="addtoSchema('p_<?php echo e($product['id']); ?>')"><i class="fa fa-plus"></i></a>

                                    </div>

                                </div>
                                <div class="caption">
                                    <p><strong><?php echo e($product['name']); ?></strong></p>
                                    
                                    
                                </div>
                            </div>


                            <div class="modal fade" id="productModal<?php echo e($product['id']); ?>" tabindex="-2" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="<?php echo e(route('admin.editExerciseRqst', $product['id'])); ?>" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Exercise of <?php echo e($key); ?></h5>
                                            </div>
                                            <div class="modal-body">

                                                <div class="col-md-12">
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="videoname">Exercise name</label>
                                                        <input type="hidden" name="group_id" value="<?php echo e($product['gid']); ?>"/>
                                                        <input type="text" name="productname" class="form-control"  aria-describedby="grpnameHelp"
                                                               placeholder="Enter product name"  value="<?php echo e($product['name']); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="imagefile">Exercise Image file</label>
                                                        <input type="file" name="imagefile" class="form-control">
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="price">Exercise Price</label>
                                                        <input type="price" name="price" class="form-control" value="<?php echo e($product['price']); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="tax">Exercise Tax</label>
                                                        <input type="tax"  name="tax" class="form-control" value="<?php echo e($product['tax']); ?>"  required>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="group_priority">Priority</label>
                                                        <input type="number" name="group_priority" class="form-control" value="<?php echo e($product['group_priority']); ?>"  required>
                                                    </div>


                                                    <div class="form-group col-md-6">
                                                        <label for="tax">Select Group</label>
                                                        <?php
                                                        $groups=\App\ProductGroups::select('id', 'name')->where('group_type', 'exercises')->get();
                                                        $groups_html='<select multiple data-plugin-selectTwo  class="form-control" name="group_id[]" required>';
                                                        $groups_html.='<option value="">Select Group</option>';
                                                        foreach ($groups as $group) {
                                                            if ($group->id==$product['gid']) {
                                                                $selected="selected";
                                                            } else {
                                                                $selected="";
                                                            }
                                                            $groups_html.='<option '.$selected.' value="'.$group->id.'">'.$group->name.'</option>';
                                                        }
                                                        echo $groups_html.='</select>';
                                                        ?>
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <hr>
                                                        <div class="col-md-6 border">
                                                            <label for="goal">Goal</label><hr>
                                                            <?php
                                                            $goals=\App\ExerciseGoal::get();
                                                            $goooals_html="";
                                                            foreach ($goals as $goal) {
                                                                if (isset($exercisedata[$product['id']]['goal']) && in_array($goal->id, $exercisedata[$product['id']]['goal'])) {
                                                                    $goooals_html.='<label style="width: 100%"><input checked  type="checkbox"  name="goal[]" value="'.$goal->id.'"> '.$goal->goalname.'</label>';
                                                                } else {
                                                                    $goooals_html.='<label style="width: 100%"><input  type="checkbox"  name="goal[]" value="'.$goal->id.'"> '.$goal->goalname.'</label>';
                                                                }
                                                            }
                                                            echo $goooals_html;
                                                            ?>

                                                        </div>

                                                        <div class="col-md-6 border" style="min-height: 211px;">
                                                            <label for="traininglevel">Trainingsniveau</label><hr>
                                                            <?php
                                                            $traininglevels=\App\ExerciseTrainingLevel::get();
                                                            $traininglevels_html="";
                                                            foreach ($traininglevels as $traininglevel) {
                                                                if (isset($exercisedata[$product['id']]['traininglevel']) && in_array($traininglevel->id, $exercisedata[$product['id']]['traininglevel'])) {
                                                                    $traininglevels_html.='<label style="width: 100%"><input checked type="checkbox" name="traininglevel[]" value="'.$traininglevel->id.'"> '.$traininglevel->traininglevel.'</label>';
                                                                } else {
                                                                    $traininglevels_html.='<label style="width: 100%"><input type="checkbox" name="traininglevel[]" value="'.$traininglevel->id.'"> '.$traininglevel->traininglevel.'</label>';
                                                                }
                                                            }
                                                            echo $traininglevels_html;
                                                            ?>

                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="col-md-6 border" style="min-height: 291px;">
                                                            <label for="musclegroup">Accent Muscle Group</label><hr>
                                                            <?php
                                                            $traininglevelsmg=\App\ExerciseAccentMuscleGroup::get();
                                                            $traininglevelsmg_html="";
                                                            foreach ($traininglevelsmg as $traininglevelsm) {
                                                                if (isset($exercisedata[$product['id']]['musclegroup']) && in_array($traininglevelsm->id, $exercisedata[$product['id']]['musclegroup'])) {
                                                                    $traininglevelsmg_html.='<label style="width: 100%"><input checked type="checkbox" name="musclegroup[]" value="'.$traininglevelsm->id.'"> '.$traininglevelsm->musclegroupname.'</label>';
                                                                } else {
                                                                    $traininglevelsmg_html.='<label style="width: 100%"><input type="checkbox" name="musclegroup[]" value="'.$traininglevelsm->id.'"> '.$traininglevelsm->musclegroupname.'</label>';
                                                                }
                                                            }
                                                            echo $traininglevelsmg_html;
                                                            ?>

                                                        </div>
                                                        <div class="col-md-6 border">
                                                            <label for="material">Materiaal</label><hr>
                                                            <?php
                                                            $materials=\App\ExerciseMaterial::get();
                                                            $materials_html="";
                                                            foreach ($materials as $material) {
                                                                if (isset($exercisedata[$product['id']]['material']) && in_array($material->id, $exercisedata[$product['id']]['material'])) {
                                                                    $materials_html.='<label style="width: 100%"><input checked type="checkbox" name="material[]" value="'.$material->id.'"> '.$material->materiallevel.'</label>';
                                                                } else {
                                                                    $materials_html.='<label style="width: 100%"><input type="checkbox" name="material[]" value="'.$material->id.'"> '.$material->materiallevel.'</label>';
                                                                }
                                                            }
                                                            echo $materials_html;
                                                            ?>

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





                            <div id="delete-modal-p<?php echo e($product['id']); ?>" class="modal modal-danger fade">
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
                                            <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteExerciseRqst', $product['id'])); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                                <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                <?php
                                $gslug=$product['gslug'];
                                $gid=$product['gid'];
                                ?>



                            </div>
                        </div>




                        <?php endif; ?>



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
                

                    
                    















                    
                        
                    
















                
            


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="modal fade" id="productModaladd" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="<?php echo e(route('admin.addExerciseRqst')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-header">
                            <h5 class="modal-title">Add Exercise</h5>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-12">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="videoname">Exercise name</label>

                                    <input type="text" name="productname" class="form-control"  aria-describedby="grpnameHelp"
                                           placeholder="Enter product name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="imagefile">Exercise Image file</label>
                                    <input type="file" name="imagefile" class="form-control">
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="price">Exercise Price</label>
                                    <input type='number' step='0.01' value='0.00' type="price" name="price" class="form-control"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tax">Exercise Tax</label>
                                    <input type='number' step='0.01' value='0.00' type="tax" name="tax" class="form-control"  required>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tax">Priority</label>
                                    <input type='number' step='1' value='1' type="tax" name="group_priority" class="form-control"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tax">Select Group</label>
                                    <?php
                                    $groups=\App\ProductGroups::select('id', 'name')->where('group_type', 'exercises')->get();
                                    $groups_html='<select multiple data-plugin-selectTwo class="form-control" name="group_id[]" required>';
                                    $groups_html.='<option value="">Select Group</option>';
                                    foreach ($groups as $group) {
                                        $groups_html.='<option value="'.$group->id.'">'.$group->name.'</option>';
                                    }
                                    echo $groups_html.='</select>';
                                    ?>
                                </div>






                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="col-md-6 border">
                                        <label for="goal">Goal</label><hr>
                                        <?php
                                        $goals=\App\ExerciseGoal::get();
                                        $goooals_html="";
                                        foreach ($goals as $goal) {
                                            $goooals_html.='<label style="width: 100%"><input type="checkbox" name="goal[]" value="'.$goal->id.'"> '.$goal->goalname.'</label>';
                                        }
                                        echo $goooals_html;
                                        ?>

                                    </div>

                                    <div class="col-md-6 border" style="min-height: 211px;">
                                        <label for="traininglevel">Trainingsniveau</label><hr>
                                        <?php
                                        $traininglevels=\App\ExerciseTrainingLevel::get();
                                        $traininglevels_html="";
                                        foreach ($traininglevels as $traininglevel) {
                                            $traininglevels_html.='<label style="width: 100%"><input type="checkbox" name="traininglevel[]" value="'.$traininglevel->id.'"> '.$traininglevel->traininglevel.'</label>';
                                        }
                                        echo $traininglevels_html;
                                        ?>

                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-6 border" style="min-height: 291px;">
                                        <label for="musclegroup">Accent Muscle Group</label><hr>
                                        <?php
                                        $traininglevelsmg=\App\ExerciseAccentMuscleGroup::get();
                                        $traininglevelsmg_html="";
                                        foreach ($traininglevelsmg as $traininglevelsm) {
                                            $traininglevelsmg_html.='<label style="width: 100%"><input type="checkbox" name="musclegroup[]" value="'.$traininglevelsm->id.'"> '.$traininglevelsm->musclegroupname.'</label>';
                                        }
                                        echo $traininglevelsmg_html;
                                        ?>

                                    </div>
                                    <div class="col-md-6 border">
                                        <label for="material">Materiaal</label><hr>
                                        <?php
                                        $materials=\App\ExerciseMaterial::get();
                                        $materials_html="";
                                        foreach ($materials as $material) {
                                            $materials_html.='<label style="width: 100%"><input type="checkbox" name="material[]" value="'.$material->id.'"> '.$material->materiallevel.'</label>';
                                        }
                                        echo $materials_html;
                                        ?>

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


    <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <h3>No Groups Available</h3>
            </div>
        </div>
    <?php endif; ?>







