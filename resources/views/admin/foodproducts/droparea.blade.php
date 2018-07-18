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
    .margintoptab {
        margin-top: 10px;
    }
    .sidebardr{background-color:#545454;padding-bottom: 10px;min-height: 100px;height:auto}


</style>


<div>
    <div class="col-lg-12">
    <div class="tabs margintoptab">
        <ul class="nav nav-tabs">

            @if(!empty($drop_groups))
            @foreach($drop_groups as $key=>$drop_group)
            <li class="nav-item @if($key==0) active @endif">
                <a class="nav-link @if($key==0) active @endif" href="#tab{{$drop_group->id}}" data-toggle="tab"> {{$drop_group->name}}
                    <div class="tools pull-right " >
                        <i class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-products-group-modal{{$drop_group->id }}"></i>
                        <i class="fa fa-edit pointer" data-toggle="modal" data-target="#edit-products-group-modal{{$drop_group->id }}"></i>
                    </div>
                </a>
            </li>
                <div class="modal fade" id="edit-products-group-modal{{$drop_group->id }}" tabindex="-2" role="dialog" aria-hidden="true" style="color: #000;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.editGroupRqst',$drop_group->id)}}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title">Groep toevoegen</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="groupname">Group name</label>
                                        <input type="text" name="groupname" class="form-control" id="groupname"
                                               aria-describedby="grpnameHelp" value="{{$drop_group->name}}"
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


                <div id="delete-products-group-modal{{$drop_group->id }}" class="modal modal-danger fade" style="color: #000;">
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
                                <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteGroupRqst',$drop_group->id ) }}">
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
            @endif

            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#dropgroupModal" href="#dropgroupModal"
                   data-toggle="tab"> <i class="fa fa-plus"></i> Groep </a>
            </li>
        </ul>
        <div class="tab-content sidebardr" >

            @if(!empty($drop_groups))
            @foreach($drop_groups as $key=>$drop_group)
            <div id="tab{{$drop_group->id}}" class="tab-pane @if($key==0) active @endif">
                <div class="row">


                    {{--<div class="userbar col-md-12">--}}
                    {{--@include('admin.foodproducts.user_top_cell')--}}
                    {{--</div>--}}
                    {{--<div class="col-md-12">--}}
                      {{--<div class="search_users_exercises margintop">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div id="cart" class="col-md-12 cart1" ondrop="drop(event)" ondragover="allowDrop(event)" style="    text-align: center;
    color: #fff;">
                    <h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>
                    </div>
                    {{--@if(Request::segment(3) !="predefined-schemas")--}}
                    {{--<div class="col-md-12 sortablediv">--}}


                    {{--<div class="doprul products-list product-list-in-box sortable_exercises_added margintop">--}}
                    {{--@include('admin.foodproducts.show_added_foodproducts')--}}
                    {{--</div>--}}


                    {{--</div>--}}

                    {{--@endif--}}
                    {{--@if(Request::segment(3) =="predefined-schemas")--}}
                    {{--<div class="col-md-12 schedulelist">--}}

                    {{--<div class="schedulelistinner"></div>--}}


                    {{--</div>--}}
                    {{--@endif--}}

                    {{--<div class="col-md-12 sortablebuttons">--}}

                    {{--</div>--}}



                </div>

            </div>
            @endforeach
                @endif

        </div>
    </div>
    </div>





    {{--<div class="userbar col-md-12">--}}
        {{--@include('admin.foodproducts.user_top_cell')--}}
    {{--</div>--}}



    {{--<div class="col-md-12">--}}


        {{--<div class="search_users_exercises margintop">--}}

        {{--</div>--}}

    {{--</div>--}}



    {{--<div id="cart" class="col-md-12 cart" ondrop="drop(event)" ondragover="allowDrop(event)">--}}
        {{--<h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>--}}
    {{--</div>--}}


    {{--@if(Request::segment(3) !="predefined-schemas")--}}
    {{--<div class="col-md-12 sortablediv">--}}


        {{--<div class="doprul products-list product-list-in-box sortable_exercises_added margintop">--}}
            {{--@include('admin.foodproducts.show_added_foodproducts')--}}
        {{--</div>--}}


    {{--</div>--}}

    {{--@endif--}}
    {{--@if(Request::segment(3) =="predefined-schemas")--}}
    {{--<div class="col-md-12 schedulelist">--}}

        {{--<div class="schedulelistinner"></div>--}}


    {{--</div>--}}
    {{--@endif--}}

    {{--<div class="col-md-12 sortablebuttons">--}}

    {{--</div>--}}
    {{----}}


</div>


<div id="saveScheduleModal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="color: black;font-weight: 200">
    <div class="modal-dialog modal-lg" role="document">
{{--        <form method="POST" action="{{ route('admin.saveSchemaRqst',$schedule_id)}}">--}}
            <form method="POST" action="">
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
                                    <div class="form-group col-md-12">
                                        <label for="sets">Choose date type</label>
                                        <select class="form-control" name="savetype" onchange="chagesaveAction(this)">

                                            <option  value="0">Day Wise</option>
                                            <option @if(isset($schema_details->enddate)) selected  @endif value="1">Date Range</option>
                                        </select>
                                    </div>


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
                                    <div class="col-lg-12 form-group enddate" style="display: none;">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="input-group date" data-date-format="dd-mm-yyyy">
                                                <input type="text" id="enddate" name="enddate" value="{{ @$schema_details->enddate }}" class="form-control" placeholder="dd-mm-yyyy">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="daywise" style="margin-top: 20px;">

                                        <div class="form-group daysmul col-lg-12" style="font-size: 15px;">

                                            <?php
                                                 $days=array();
                                                if(strlen(@$schema_details->days))
                                                   $days=explode(",",$schema_details->days)
                                            ?>
                                            <label>Choose Days</label><br>
                                            <label><input type="checkbox" name="days[]" @if(in_array(0, $days)) checked @endif value="0"> &nbsp;Sunday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(1, $days)) checked @endif value="1"> &nbsp;Monday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(2, $days)) checked @endif value="2">  &nbsp;Tuesday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(3, $days)) checked @endif value="3"> &nbsp;Wednesday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(4, $days)) checked @endif value="4"> &nbsp;Thursday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(5, $days)) checked @endif value="5">  &nbsp;Friday</label> &nbsp;&nbsp;
                                            <label><input type="checkbox" name="days[]" @if(in_array(6, $days)) checked @endif value="6">  &nbsp;Saturday</label> &nbsp;&nbsp;

                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label><input type="checkbox" @if(@$schema_details->recurring=="yes") checked @endif  name="recurring" value="recurring">Recurring</label> &nbsp;&nbsp;
                                        </div>
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
{{--                <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteSchemaRqst',$schedule_id)}}">--}}
                    <form method="post" role="form" id="delete_form" action="">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-outline">Delete</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>








