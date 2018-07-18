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
    .pointer{cursor: pointer}

    .head-margin{margin-top:-5px}
    .slides-margin{margin-top:-20px}

</style>

    @if(sizeof($products) > 0 )



        @foreach($products as $keyout=>$groups)


<h5 class="font-weight-semibold text-dark text-uppercase head-margin">Group: {{$groups[0]['gname']}} &nbsp;&nbsp;&nbsp; <i class="fa fa-pencil pointer" data-toggle="modal" data-target="#editGroupModal{{$groups[0]['gid']}}" href="#editGroupModal"></i></h5>
            {{--<div class="box-header with-border text-left">--}}
                {{--<h3 class="box-title">Group: {{$keyout}}</h3>--}}

            {{--</div>--}}


<?php
//        echo "<pre>";
//print_r($groups)
//?>


<div class="modal fade" id="editGroupModal{{$groups[0]['gid']}}" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.updateExerciseGroupRqst',$groups[0]['gid'])}}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Groep toevoegen {{$groups[0]['gname']}}</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="groupname">Group name</label>
                        <input type="text" name="groupname" class="form-control" id="groupname"
                               aria-describedby="grpnameHelp" value="{{$groups[0]['gname']}}"
                               placeholder="Enter group name" required>
                        <small id="grpnameHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



            <div class="slides">



                <div class="products2 connectedSortable sortablegroups{{ $keyout }} scrolling-wrapper" id="products12"  >
                    @foreach($groups as $key=>$product)



                        @if(isset($product['id']))
                            <div class="card "  id="p_{{ $product['id'] }}_{{$user->id}}" draggable="true"  ondragstart="dragExerciseStart('p_{{ $product['id'] }}_{{$user->id}}',{{Request::segment(5)}})" ondragend="dragExerciseEnd()">
                            <div   class="itemp thumbnail "  >
                                <div class="image view view-first">
                                    <img style="object-fit: cover;width: 100%; display: block;height: 175px;" src="{{ asset('admin/images/groups/exercises/'.$product['path'])}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/exercises/noimage.jpeg')}}" />
                                    <div class="mask">


                                        <div class="tools tools-bottom">
                                            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                            <a href="#" data-toggle="modal" data-target="#productModal{{$product['id'] }}"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p{{$product['id'] }}"><i class="fa fa-times"></i></a>

                                            {{--<a href="{{ route('groupPage',['groupslug' => $product->slug ] ) }}"><i class="fa fa-eye"></i></a>--}}
                                        </div>
                                        <p>{{ $product['name'] }} </p>
                                        <a class="plusicon" onclick="addtoSchema('p_{{ $product['id'] }}_{{$user->id}}',{{Request::segment(5)}})"><i class="fa fa-plus"></i></a>

                                    </div>

                                </div>
                                <div class="caption">
                                    <p><strong>{{ $product['name'] }}</strong></p>
                                    {{--<p><strong>Price</strong>: <span>$ {{ $product['price'] }}</span></p>--}}
                                    {{--<p><strong>Tax</strong>: <span>{{ $product['tax'] }}</span></p>--}}
                                </div>
                            </div>


                            <div class="modal fade" id="productModal{{$product['id'] }}" tabindex="-2" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.editExerciseRqst', $product['id']) }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Exercise</h5>
                                            </div>
                                            <div class="modal-body">

                                                <div class="col-md-12">
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="videoname">Exercise name</label>
                                                        <input type="hidden" name="group_id" value="{{ $product['gid'] }}"/>
                                                        <input type="text" name="productname" class="form-control"  aria-describedby="grpnameHelp"
                                                               placeholder="Enter product name"  value="{{ $product['name'] }}" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="imagefile">Exercise Image file</label>
                                                        <input type="file" name="imagefile" class="form-control">
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="price">Exercise Price</label>
                                                        <input type="price" name="price" class="form-control" value="{{$product['price'] }}" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="tax">Exercise Tax</label>
                                                        <input type="tax"  name="tax" class="form-control" value="{{$product['tax'] }}"  required>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="group_priority">Priority</label>
                                                        <input type="number" name="group_priority" class="form-control" value="{{$product['group_priority'] }}"  required>
                                                    </div>


                                                    <div class="form-group col-md-6">
                                                        <label for="tax">Select Group</label>
                                                        <?php
                                                        $groups=\App\ProductGroups::select('id','name')->where('group_type','exercises')
                                                            ->where('user_id',$user->id)
                                                            ->get();
                                                        $groups_html='<select multiple data-plugin-selectTwo  class="form-control" name="group_id[]" required>';
                                                        $groups_html.='<option value="">Select Group</option>';
                                                        foreach( $groups as $group){
                                                            if($group->id==$product['gid']){
                                                                $selected="selected";
                                                            }
                                                            else{
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
                                                            $goals=\App\ExerciseGoal::
                                                               where('user_id',$user->id) ->
                                                            get();
                                                            $goooals_html="";
                                                            foreach( $goals as $goal){

                                                                if(isset($exercisedata[$product['id']]['goal']) && in_array($goal->id,$exercisedata[$product['id']]['goal']))
                                                                    $goooals_html.='<label style="width: 100%"><input checked  type="checkbox"  name="goal[]" value="'.$goal->id.'"> '.$goal->goalname.'</label>';
                                                                else
                                                                    $goooals_html.='<label style="width: 100%"><input  type="checkbox"  name="goal[]" value="'.$goal->id.'"> '.$goal->goalname.'</label>';
                                                            }
                                                            echo $goooals_html;
                                                            ?>

                                                        </div>

                                                        <div class="col-md-6 border" style="min-height: 211px;">
                                                            <label for="traininglevel">Trainingsniveau</label><hr>
                                                            <?php
                                                            $traininglevels=\App\ExerciseTrainingLevel:: where('user_id',$user->id) ->get();
                                                            $traininglevels_html="";
                                                            foreach( $traininglevels as $traininglevel){
                                                                if(isset($exercisedata[$product['id']]['traininglevel']) && in_array($traininglevel->id,$exercisedata[$product['id']]['traininglevel']))
                                                                    $traininglevels_html.='<label style="width: 100%"><input checked type="checkbox" name="traininglevel[]" value="'.$traininglevel->id.'"> '.$traininglevel->traininglevel.'</label>';
                                                                else
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
                                                            $traininglevelsmg=\App\ExerciseAccentMuscleGroup:: where('user_id',$user->id) ->get();
                                                            $traininglevelsmg_html="";
                                                            foreach( $traininglevelsmg as $traininglevelsm){
                                                                if(isset($exercisedata[$product['id']]['musclegroup']) && in_array($traininglevelsm->id,$exercisedata[$product['id']]['musclegroup']))
                                                                    $traininglevelsmg_html.='<label style="width: 100%"><input checked type="checkbox" name="musclegroup[]" value="'.$traininglevelsm->id.'"> '.$traininglevelsm->musclegroupname.'</label>';
                                                                else
                                                                    $traininglevelsmg_html.='<label style="width: 100%"><input type="checkbox" name="musclegroup[]" value="'.$traininglevelsm->id.'"> '.$traininglevelsm->musclegroupname.'</label>';
                                                            }
                                                            echo $traininglevelsmg_html;
                                                            ?>

                                                        </div>
                                                        <div class="col-md-6 border">
                                                            <label for="material">Materiaal</label><hr>
                                                            <?php
                                                            $materials=\App\ExerciseMaterial:: where('user_id',$user->id) ->get();
                                                            $materials_html="";
                                                            foreach( $materials as $material){
                                                                if(isset($exercisedata[$product['id']]['material']) && in_array($material->id,$exercisedata[$product['id']]['material']))
                                                                    $materials_html.='<label style="width: 100%"><input checked type="checkbox" name="material[]" value="'.$material->id.'"> '.$material->materiallevel.'</label>';
                                                                else
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
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                                <button type="submit" class="btn btn-info">Opslaan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





                            <div id="delete-modal-p{{$product['id'] }}" class="modal modal-danger fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title">
							<span class="fa-stack fa-sm">
								<i class="fa fa-square-o fa-stack-2x"></i>
								<i class="fa fa-trash fa-stack-1x"></i>
							</span>
                                                Are you sure want to delete this ?
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                            <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteExerciseRqst', $product['id'])}}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-outline">Delete</button>
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




                        @endif



                    @endforeach
                </div>
            </div>
            {{--<script>--}}
                {{--$( function() {--}}

                    {{--$("#qselected").sortable();--}}
                    {{--$("#qselected").disableSelection();--}}

{{--//                    $( ".drop" ).sortable({--}}
{{--//                        helper:"clone",--}}
{{--//                        opacity:0.5,--}}
{{--//                        cursor:"crosshair",--}}
{{--//                        connectWith: ".list",--}}
{{--//                        receive: function( event, ui ){ //this will prevent move than 3 items in droppable list--}}
{{--//                            if($(ui.sender).attr('id')==='sort1' && $('#sort2').children('li').length>3){--}}
{{--//                                $(ui.sender).sortable('cancel');--}}
{{--//                            }--}}
{{--//                        }--}}
{{--//                    });--}}

{{--//                    $( "#sort1,#sort2" ).disableSelection();--}}

                    {{--$( ".sortablegroups{{ $keyout }}" ).sortable({--}}
                        {{--connectWith: ".connectedSortable"--}}
                    {{--}).disableSelection();--}}



{{--//                    $( ".products2").droppable({--}}
{{--//                        drop: function(event, ui) {--}}
{{--//                            var ident = "#" +  dragged;--}}
{{--//                            $(ident).slideUp(100);--}}
{{--//                        }--}}
{{--//                    });--}}







                {{--} );--}}
            {{--</script>--}}


        @endforeach



    @else
        <div class="">
            <div class="col-lg-12">
                <h3>No Groups Available</h3>
            </div>
        </div>
    @endif







