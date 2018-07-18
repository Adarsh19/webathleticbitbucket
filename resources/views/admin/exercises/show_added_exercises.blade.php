<?php
$preiousexercise_id="";
$sheduleid="";
?>
    @foreach($exercises as $exercise)


                @if($preiousexercise_id !=$exercise->exercise_id)
                      <?php
                      $preiousexercise_id=$exercise->exercise_id;
                      ?>

                      <section exercise_id="{{$exercise->exercise_id}} "class="card card-featured-left card-featured-primary mb-4" style="margin-top: 0px;">
                          <div class="card-body">
                              <div class="widget-summary widget-summary-md">
                                  <div class="widget-summary-col widget-summary-col-icon">

                                      <div class="summary-icon bg-primary">
                                          <img class="img-circle-cus"  src="{{ asset('admin/images/groups/exercises/'.$exercise->imagepath)}}" onerror=this.src="{{ asset('admin/images/groups/exercises/noimage.jpeg')}}" alt="user image">

                                      </div>

                                  </div>
                                  <div class="widget-summary-col">
                                      <div class="summary">
                                          <h4 class="title">{{ $exercise->ex_name }}</h4>
                                          <div class="info">
                                              <strong class="amount">Group</strong>
                                              <span class="text-primary">{{$exercise->group_name }}</span>
                                          </div>
                                      </div>
                                      <div class="summary-footer">
                                          <a class="text-muted text-uppercase">(view all)</a>
                                      </div>
                                  </div>
                                  <div class="pull-right" style="width: 30px;">
                                       <a  href="javascript:;" onclick="showpopup('{{$exercise->schemaexerciseid}}')" class="pull-right btn-box-tool" ><i class="fa fa-edit"></i></a>
                                  <a href="#" class=" btn-box-tool" data-toggle="modal" data-target="#delete-exercise-p{{$exercise->schemaexerciseid}}"><i class="fa fa-trash"></i></a>

                                  </div>


                              </div>
                              <div class="row" style="color: #000;">
                                  <div class="col-md-12">
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Sets {{ $exercise->sets }}</span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Reps {{ $exercise->reps }} </span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>
                                      <div class="col-sm-4 col-xs-6">
                                          <div class="description-block border-right">
                                              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Rust {{ $exercise->rust }}</span>
                                          </div>
                                          <!-- /.description-block -->
                                      </div>


                                  </div>

                              </div>
                          </div>
                      </section>


        {{--<div class="info-box">--}}
        {{--<div class="user-block">--}}
            {{--<img class="img-circle" style="width: 80px;height: 80px;" src="{{ asset('public/admin/images/groups/exercises/'.$exercise->imagepath)}}" onerror=this.src="{{ asset('admin/images/groups/exercises/noimage.jpeg')}}" alt="user image">--}}
                        {{--<span class="username">--}}
                          {{--<a href="#" data-toggle="modal" data-target="#editupdateschedule{{$exercise->id }}">{{ $exercise->ex_name }}</a>--}}
                            {{--<br>--}}
                            {{--<a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#editupdateschedule{{$exercise->schemaexerciseid }}"><i class="fa fa-edit"></i></a>--}}
                          {{--</span>--}}
            {{--<span>--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="col-sm-4 col-xs-6">--}}
                    {{--<div class="description-block border-right">--}}
                        {{--<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Sets {{ $exercise->sets }}</span>--}}
                    {{--</div>--}}
                    {{--<!-- /.description-block -->--}}
                {{--</div>--}}
                {{--<div class="col-sm-4 col-xs-6">--}}
                    {{--<div class="description-block border-right">--}}
                        {{--<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Reps {{ $exercise->reps }} </span>--}}
                    {{--</div>--}}
                    {{--<!-- /.description-block -->--}}
                {{--</div>--}}
                {{--<div class="col-sm-4 col-xs-6">--}}
                    {{--<div class="description-block border-right">--}}
                        {{--<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Rust {{ $exercise->rust }}</span>--}}
                    {{--</div>--}}
                    {{--<!-- /.description-block -->--}}
                {{--</div>--}}


            {{--</div>--}}
                {{--</span>--}}
            {{--<span class="description">Group: {{$exercise->group_name }}</span>--}}
        {{--</div>--}}
        {{--</div>--}}
@endif

<?php

if(isset($exercise->schedule_id)){

   $sheduleid=$exercise->schedule_id;

}

?>
                <input type="hidden" name="scheduleid" id="scheduleid" value="{{$sheduleid}}">
                <div class="modal fade" id="editupdateschedule{{$exercise->schemaexerciseid}}" tabindex="-2" role="dialog" aria-hidden="true" style="color: #000000;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.editScheduleRqst', $exercise->schemaexerciseid) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Schedule  Exercise of {{ $exercise->ex_name }}</h5>
                                </div>
                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label for="productname">Exercise name</label>
                                            <input type="text" name="productname" class="form-control"  aria-describedby="grpnameHelp"
                                                   placeholder="Enter product name"  value="{{ $exercise->ex_name }}" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="sets">Sets</label>
                                            <?php
                                            $sets=$exercise->sets;
                                            if($exercise->sets<2)
                                                $sets=2;
                                            $reps=$exercise->reps;
                                            if($exercise->reps<2)
                                                $reps=2;
                                            $rust=$exercise->rust;
                                            if($exercise->rust<1)
                                                $rust=1;
                                            ?>
                                            <input type="number" min="2" max="5" name="sets" id="sets{{$exercise->schemaexerciseid}}" onkeyup="showexercisesweightgrid('{{$exercise->ex_meta}}','{{$exercise->schemaexerciseid}}')" class="form-control sets" value="{{$sets}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="reps">Reps</label>
                                            <input type="number" name="reps" min="2" max="5" id="reps{{$exercise->schemaexerciseid}}" onkeyup="showexercisesweightgrid('{{$exercise->ex_meta}}','{{$exercise->schemaexerciseid}}')" class="form-control reps" value="{{$reps}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rust">Rust</label>
                                            <input type="number" name="rust" min="1" max="5"  class="form-control" value="{{$rust}}" required>
                                        </div>




                                    </div>
                                    <input type="hidden" value="{{$exercise->ex_meta}}" name="ex_meta" class="ex_meta{{$exercise->schemaexerciseid}}"/>

                                    <div class="col-lg-12 table-contents" id="table-contents{{$exercise->schemaexerciseid}}">

                                        <table class="table table-responsive-md mb-0 tab-det{{$exercise->schemaexerciseid}}" style="width: 100%; ">

                                            <tbody class="tboddy">

                                            <?php

                                            $length=count(json_decode($exercise->ex_meta,true));
                                            $metaArr=json_decode($exercise->ex_meta,true);


                                            ?>

                                            @if( $length)
                                                @foreach($metaArr as $ko=>$meta)

                                                    @if($ko==$length-1)
                                                        <?php continue; ?>
                                                    @endif
                                                    <tr @if($ko == $length-1) id ="addRow" @endif>
                                                        @foreach($meta as $key=>$cell)
                                                            @if($key==0)
                                                                <td>{{ $cell }}</td>
                                                            @else
                                                                <td><input type="text" class="form-control"  value="{{ $cell }}"> </td>
                                                            @endif
                                                        @endforeach

                                                    </tr>


                                                @endforeach
                                                <tr>
                                                    <td>Note</td>
                                                    <?php
                                                    $note=$metaArr[$length-1][1];
                                                    ?>
                                                    <td colspan="{{$exercise->reps}}" ><input onkeyup="onChangeAnyWeightOrNote('{{$exercise->schemaexerciseid}}')" value="{{ $note }}" type="text" name="note" class="form-control"> </td>
                                                </tr>
                                            @endif

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


                <div id="delete-exercise-p{{$exercise->schemaexerciseid}}" class="modal modal-danger fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title color-cus-black">
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
                                <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteexerciseScheduleRqst', $exercise->schemaexerciseid)}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-outline">Delete</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->

                </div>

    @endforeach





    @if(isset($orders) && count($orders)>0)
    <div id="deleteSchema" class="modal modal-danger fade">
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
                    <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteSchemaRqst',@$sheduleid)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline">Delete</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

{{--    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap-datepicker.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('public/admin/css/datepicker3.css') }}">--}}
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    {{--<script>--}}
        {{--$( function() {--}}
            {{--$( "#startdate" ).datepicker();--}}
            {{--$( "#enddate" ).datepicker();--}}
        {{--} );--}}
    {{--</script>--}}
    <div class="modal fade" id="saveScheduleModal" tabindex="-2" role="dialog" aria-hidden="true" style="color: black;font-weight: 200">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.saveSchemaRqst',$sheduleid)}}">
                    {{ csrf_field() }}
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="submit" name="printpdf" value="1" class="btn btn-info">Save and Print Pdf</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- /.modal -->


    @endif



<script>
    function  showpopup(id) {

        $('#editupdateschedule'+id).modal('show');
        $('#reps'+id).trigger('keyup');
    }
</script>






