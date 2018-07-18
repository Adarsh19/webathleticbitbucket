<?php
$preiousexercise_id="";
$sheduleid="";
?>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exercise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php if($preiousexercise_id !=$exercise->exercise_id): ?>
                        <?php
                        $preiousexercise_id=$exercise->exercise_id;
                        ?>

                      <section exercise_id="<?php echo e($exercise->exercise_id); ?> "class="card card-featured-left card-featured-primary mb-4" style="margin-top: 0px;">
                          <div class="card-body">
                              <div class="widget-summary widget-summary-md">
                                  <div class="widget-summary-col widget-summary-col-icon">

                                      <div class="summary-icon bg-primary">
                                          <img class="img-circle-cus"  src="<?php echo e(asset('admin/images/groups/exercises/'.$exercise->imagepath)); ?>" onerror=this.src="<?php echo e(asset('admin/images/groups/exercises/noimage.jpeg')); ?>" alt="user image">

                                      </div>

                                  </div>
                                  <div class="widget-summary-col">
                                      <div class="summary">
                                          <h4 class="title"><?php echo e($exercise->ex_name); ?></h4>
                                          <div class="info">
                                              <strong class="amount">Group</strong>
                                              <span class="text-primary"><?php echo e($exercise->group_name); ?></span>
                                          </div>
                                      </div>
                                      <div class="summary-footer">
                                          <a class="text-muted text-uppercase">(view all)</a>
                                      </div>
                                  </div>
                                  <div class="pull-right" style="width: 30px;">
                                       <a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#editupdateschedule<?php echo e($exercise->schemaexerciseid); ?>"><i class="fa fa-edit"></i></a>
                                  <a href="#" class=" btn-box-tool" data-toggle="modal" data-target="#delete-exercise-p<?php echo e($exercise->schemaexerciseid); ?>"><i class="fa fa-trash"></i></a>

                                  </div>


                              </div>
                              <div class="row" style="color: #000;">
                                  <div class="col-md-12">
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Sets <?php echo e($exercise->sets); ?></span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Reps <?php echo e($exercise->reps); ?> </span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Rust <?php echo e($exercise->rust); ?></span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>


                                  </div>

                              </div>
                          </div>
                      </section>


        
        
            
                        
                          
                            
                            
                          
            
            
                
                    
                        
                    
                    
                
                
                    
                        
                    
                    
                
                
                    
                        
                    
                    
                


            
                
            
        
        
<?php endif; ?>

<?php

if (isset($orders) && count($orders)>0) {
    //dd($orders);
    $sheduleid=$exercise->schedule_id;
}

?>
                <div class="modal fade" id="editupdateschedule<?php echo e($exercise->schemaexerciseid); ?>" tabindex="-2" role="dialog" aria-hidden="true" style="color: #000000;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="POST" action="<?php echo e(route('admin.editScheduleRqst', $exercise->schemaexerciseid)); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Schedule  Exercise of <?php echo e($exercise->ex_name); ?></h5>
                                </div>
                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label for="productname">Exercise name</label>
                                            <input type="text" name="productname" class="form-control"  aria-describedby="grpnameHelp"
                                                   placeholder="Enter product name"  value="<?php echo e($exercise->ex_name); ?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="sets">Sets</label>
                                            <input type="number" min="1" max="5" name="sets" id="sets<?php echo e($exercise->schemaexerciseid); ?>" onkeyup="showexercisesweightgrid('<?php echo e($exercise->ex_meta); ?>','<?php echo e($exercise->schemaexerciseid); ?>')" class="form-control" value="<?php echo e($exercise->sets); ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="reps">Reps</label>
                                            <input type="number" name="reps" min="1" max="5" id="reps<?php echo e($exercise->schemaexerciseid); ?>" onkeyup="showexercisesweightgrid('<?php echo e($exercise->ex_meta); ?>','<?php echo e($exercise->schemaexerciseid); ?>')" class="form-control" value="<?php echo e($exercise->reps); ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rust">Rust</label>
                                            <input type="number" name="rust" min="1" max="5"  class="form-control" value="<?php echo e($exercise->rust); ?>" required>
                                        </div>




                                    </div>
                                    <input type="hidden" value="<?php echo e($exercise->ex_meta); ?>" name="ex_meta" class="ex_meta<?php echo e($exercise->schemaexerciseid); ?>"/>

                                    <div class="col-lg-12 table-contents" id="table-contents<?php echo e($exercise->schemaexerciseid); ?>">

                                        <table class="table table-responsive-md mb-0 tab-det<?php echo e($exercise->schemaexerciseid); ?>" style="width: 100%; ">

                                            <tbody class="tboddy">

                                            <?php

                                            $length=count(json_decode($exercise->ex_meta, true));
                                            $metaArr=json_decode($exercise->ex_meta, true);


                                            ?>

                                            <?php if( $length): ?>
                                                <?php $__currentLoopData = $metaArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ko=>$meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($ko==$length-1): ?>
                                                        <?php continue; ?>
                                                    <?php endif; ?>
                                                    <tr <?php if($ko == $length-1): ?> id ="addRow" <?php endif; ?>>
                                                        <?php $__currentLoopData = $meta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($key==0): ?>
                                                                <td><?php echo e($cell); ?></td>
                                                            <?php else: ?>
                                                                <td><input type="text" class="form-control"  value="<?php echo e($cell); ?>"> </td>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tr>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>Note</td>
                                                    <?php
                                                    $note=$metaArr[$length-1][1];
                                                    ?>
                                                    <td colspan="<?php echo e($exercise->reps); ?>" ><input onkeyup="onChangeAnyWeightOrNote('<?php echo e($exercise->schemaexerciseid); ?>')" value="<?php echo e($note); ?>" type="text" name="note" class="form-control"> </td>
                                                </tr>
                                            <?php endif; ?>

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary cus-width-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div id="delete-exercise-p<?php echo e($exercise->schemaexerciseid); ?>" class="modal modal-danger fade">
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
                                <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteexerciseScheduleRqst', $exercise->schemaexerciseid)); ?>">
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





    <?php if(isset($orders) && count($orders)>0): ?>
    <div id="deleteSchema" class="modal modal-danger fade">
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
                    <form method="post" role="form" id="delete_form" action="<?php echo e(route('admin.deleteSchemaRqst',@$sheduleid)); ?>">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    
    
    
        
            
            
        
    
    <div class="modal fade" id="saveScheduleModal" tabindex="-2" role="dialog" aria-hidden="true" style="color: black;font-weight: 200">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('admin.saveSchemaRqst',$sheduleid)); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Save Schema</h5>
                    </div>
                    <div class="modal-body">



                        <div class="box-body">



                            <div class="form-group col-md-12">
                                <label for="sets">Schema Name</label>
                                <input type="text" name="schema_name" class="form-control" value="" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="schema_note">Schema Note</label>
                                <textarea type="text" name="schema_note" class="form-control" value=""></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="sets">Choose date type</label>
                            <select class="form-control" name="savetype" onchange="chagesaveAction(this)">
                                <option value="0">Day Wise</option>
                                <option value="1">Date Range</option>
                            </select>
                                </div>


                                <div class="col-lg-12 form-group startdate">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div class="input-group date" data-date-format="dd-mm-yyyy">
                                            <input type="text" id="startdate" name="startdate" value="" class="form-control" placeholder="dd-mm-yyyy" required>
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-lg-12 form-group enddate" style="display: none;">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date" data-date-format="dd-mm-yyyy">
                                        <input type="text" id="enddate" name="enddate" value="" class="form-control" placeholder="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="daywise" style="margin-top: 20px;">

                        <div class="form-group daysmul col-lg-12" style="font-size: 15px;">
                            <label>Choose Days</label><br>
                            <label><input type="checkbox" name="days[]" value="0"> &nbsp;Sunday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="1"> &nbsp;Monday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="2">  &nbsp;Tuesday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="3"> &nbsp;Wednesday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="4"> &nbsp;Thursday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="5">  &nbsp;Friday</label> &nbsp;&nbsp;
                            <label><input type="checkbox" name="days[]" value="6">  &nbsp;Saturday</label> &nbsp;&nbsp;

                        </div>
                        <div class="form-group col-lg-12">
                            <label><input type="checkbox" name="recurring" value="recurring">Recurring</label> &nbsp;&nbsp;
                            </div>
                        </div>


                    </div>
                    </div>


                    <script>
                        $(function(){
                            $( "#startdate" ).datepicker({ format: 'dd-mm-yyyy'})
                            $( "#enddate" ).datepicker({ format: 'dd-mm-yyyy'})

                        });
                    </script>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Save</button>
                        <button type="submit" name="printpdf" value="1" class="btn btn-info">Save and Print Pdf</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- /.modal -->


    <?php endif; ?>










