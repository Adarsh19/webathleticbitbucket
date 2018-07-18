<style>
    .img-circle-cus {
        display: block;
        width: 70px;
        height: 70px;
        margin: -25px 0;
        border: 4px solid #fff;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        object-fit: cover;
    }

    .search_users_exercises {
        max-height: 300px;
        overflow: auto
    }

    .margintop {
        margin-top: 20px;
    }

    .cus{
        width: 87px;
        float: left;
    }


</style>


<div class="" style="background-color:#545454;color:white;padding-bottom: 10px;min-height: 800px;height:auto">
    <div class="userbar col-md-12">
        @include('admin.exercises.user_top_cell')
    </div>



    <div class="col-md-12">


        <div class="search_users_exercises margintop">

        </div>

    </div>



    <div id="cart" class="col-md-12 cart" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>
    </div>


    @if(Request::segment(3) !="predefined-schemas")
    <div class="col-md-12 sortablediv">


        <div class="doprul products-list product-list-in-box sortable_exercises_added margintop">
            @include('admin.exercises.show_added_exercises')
        </div>


    </div>

    @endif
    @if(Request::segment(3) =="predefined-schemas")
    <div class="col-md-12 schedulelist">

        <div class="schedulelistinner"></div>


    </div>
    @endif


{{--    @if(Request::segment(3) !="predefined-schemas")--}}
    <div class="col-md-12 sortablebuttons">

        {{--<button type="button" class="btn btn-danger   add-button" href="" data-toggle="modal"--}}
                {{--data-target="#deleteSchema"><i class="fa fa-trash"></i> Schema verwijderen --}}
        {{--</button>--}}

        @if(Request::segment(3) !="predefined-schemas")
        @if(strlen($schedule_id))
        <button type="button" class="btn btn-success   add-button save-btn-cus" href="#" data-toggle="modal"
                data-target="#saveScheduleModal"><i class="fa fa-save"></i> Opslaan
        </button>


                <button style="margin-top: 10px;" class="btn btn-danger modal-dismiss save-btn-cus" id="delete-user-button" href="" data-toggle="modal" data-target="#deleteSchema">Verwijder </button>


            @endif
            @endif
    </div>
    {{--@endif--}}


</div>


<div id="saveScheduleModal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="color: black;font-weight: 200">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="{{ route('admin.saveSchemaRqst',$schedule_id)}}">
            {{ csrf_field() }}


            <div class="modal-content">

                <div class="modal-header hidden">
                    <h4 class="modal-title">
		                    <span class="fa-stack fa-sm">
		                        <i class="fa fa-square-o fa-stack-2x"></i>
		                        <i class="fa fa-plus fa-stack-1x"></i>
		                    </span>
                        Add User
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">


                    <div class="col " >
                        <div class="tabs tabs-dark">
                            <ul class="nav nav-tabs">
                                <li class="nav-item tab-add">
                                    <a class="nav-link tab-edit active" href="#schedule" data-toggle="tab">Maak agenda</a>
                                </li>

                                <li class="nav-item tab-delete">
                                    <a class="nav-link" id="delete-user-button" href="" data-toggle="modal"
                                       data-target="#deleteSchema">Verwijder </a>

                                    {{--<a class="nav-link" id="delete-user-button" onclick="$('#saveScheduleModal').modal('hide'); $('#delete-user-button').modal('show')">Verwijder </a>--}}
                                </li>
                            </ul>

                            <div class="tab-content" style="height: 500px;">



                                <!-- tab form add-->
                                <div id="schedule" class="tab-pane active">

                                    <div class="form-group col-md-12">
                                        <label for="sets">Schema Name</label>
                                        <input type="text" name="schema_name" class="form-control" value="{{ @$schema_details->schema_name }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="schema_note">Schema Note</label>
                                        <textarea type="text" rows="4" name="schema_note" class="form-control" value="">{{ @$schema_details->schema_note }}</textarea>
                                    </div>
                                    {{--<div class="form-group col-md-12">--}}
                                        {{--<label for="sets">Choose date type</label>--}}
                                        {{--<select class="form-control" name="savetype" onchange="chagesaveAction(this)">--}}

                                            {{--<option  value="0">Day Wise</option>--}}
                                            {{--<option @if(isset($schema_details->enddate)) selected  @endif value="1">Date Range</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}


                                    <div class="col-lg-12 form-group startdate">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                <input type="text" id="startdate" name="startdate" value="{{ @$schema_details->startdate }}" class="form-control" placeholder="dd-mm-yyyy" required>
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 form-group startdate">
                                        <div class="form-group">
                                            <label>Weeks</label>
                                            <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                <input type="number"  name="weeks" min="1" value="1" class="form-control"  required>

                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="col-lg-12 form-group enddate" style="display: none;">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>End Date</label>--}}
                                            {{--<div class="input-group date" data-date-format="dd-mm-yyyy">--}}
                                                {{--<input type="text" id="enddate" name="enddate" value="{{ @$schema_details->enddate }}" class="form-control" placeholder="dd-mm-yyyy">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<span class="fa fa-calendar"></span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="daywise" style="margin-top: 20px;">

                                        <div class="form-group daysmul col-lg-12" style="font-size: 15px;">

                                            <?php
                                                 $days=array();
                                                if(strlen(@$schema_details->days))
                                                   $days=explode(",",$schema_details->days)
                                            ?>
                                            {{--<label>Choose Days</label><br>--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(0, $days)) checked @endif value="0"> &nbsp;Sunday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(1, $days)) checked @endif value="1"> &nbsp;Monday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(2, $days)) checked @endif value="2">  &nbsp;Tuesday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(3, $days)) checked @endif value="3"> &nbsp;Wednesday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(4, $days)) checked @endif value="4"> &nbsp;Thursday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(5, $days)) checked @endif value="5">  &nbsp;Friday</label> &nbsp;&nbsp;--}}
                                            {{--<label><input type="checkbox" name="days[]" @if(in_array(6, $days)) checked @endif value="6">  &nbsp;Saturday</label> &nbsp;&nbsp;--}}



                                                <div class="weeklydays">
                                                    <label>dag </label>
                                                    <br>

                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="MO" name="days[]"type="checkbox" @if(in_array("MO", $days)) checked @endif id="mo">
                                                        <label for="mon">Ma</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="TU" name="days[]"type="checkbox" @if(in_array("TU", $days)) checked @endif id="tu">
                                                        <label for="tue">Di</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="WE" name="days[]"type="checkbox" @if(in_array("WE", $days)) checked @endif id="we">
                                                        <label for="wed">Wo</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="TH" name="days[]"type="checkbox" @if(in_array("TH", $days)) checked @endif id="th">
                                                        <label for="thr">Do</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="FR" name="days[]"type="checkbox" @if(in_array("FR", $days)) checked @endif id="fr">
                                                        <label for="fri">Vr</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="SA" name="days[]"type="checkbox" @if(in_array("SA", $days)) checked @endif id="sa">
                                                        <label for="sat">Za</label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary cus">
                                                        <input value="SU" name="days[]"type="checkbox" @if(in_array("SU", $days)) checked @endif id="su">
                                                        <label for="sun">Zo</label>
                                                    </div>

                                                </div>



                                        </div>
                                        {{--<div class="form-group col-lg-12">--}}
                                            {{--<label><input type="checkbox" @if(@$schema_details->recurring=="yes") checked @endif  name="recurring" value="recurring">Recurring</label> &nbsp;&nbsp;--}}
                                        {{--</div>--}}
                                    </div>




                                </div>

                                <!-- tab form update -->

                            </div>
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-default modal-dismiss" onclick="$('#saveScheduleModal').modal('hide')">Sluiten</button>
                            <button type="submit" class="btn btn-primary  " style="width: 100px">Opslaan</button>
                            <button type="submit" name="printpdf" value="1" class="btn btn-info">Save and Print Pdf</button>
                        </div>
                    </div>
                </footer>
            </div>



        </form>
    </div>
</div>

<div id="deleteSchema" class="modal modal-danger fade" style="color: #000;">
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
                <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteSchemaRqst',$schedule_id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-outline">Delete</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>








