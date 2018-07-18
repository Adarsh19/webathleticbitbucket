<style>
    .progress-bar-info {
        height: 34px !important;
    }

    .cus-margin {
        margin-bottom: 5px !important;
    }
    .heightc{
        height: 50px;
    }
    .cus{width: 65px;float:left;}
    .add_food_button{margin-right: 20px;}
</style>
<div class="">
    <div class="col-lg-5">
        <section class="card">

            <div class="card-body" style="display: block;">

                <div class="form-group row">
                    <div class="col-lg-12">
                        <div data-plugin-datepicker data-plugin-skin="primary" class="datttpicker">
                        </div>
                    </div>

                </div>
        </section>
    </div>
    <div class="col-lg-7">
        <section class="card">

            <div class="card-body">


                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child text-right">
                        <strong>Doel</strong>
                    </div>
                    <div class="col-md-2 card-child">
                        <strong>Behaald</strong>
                    </div>
                    <div class="col-md-7 card-child">

                    </div>
                </div>

                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child daily_food">
                        Kcal<span class="icon-child pull-right"><i class="fa fa-arrow-up"
                                                                   aria-hidden="true"></i>4kcal</span>
                    </div>
                    <div class="col-md-2 card-child daily_food">
                        <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i>11kcal</span>
                    </div>
                    <div class="col-md-7 card-child">
                        <div class="progress progress-xl progress-half-rounded light daily_food">

                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="275.00"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 275.00%;">
                                275.00%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child daily_food">
                        Eiwit<span class="icon-child pull-right"><i class="fa fa-arrow-up"
                                                                    aria-hidden="true"></i>5g</span>
                    </div>
                    <div class="col-md-2 card-child daily_food">
                        <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i>11g</span>
                    </div>
                    <div class="col-md-7 card-child">
                        <div class="progress progress-xl progress-half-rounded light  daily_food">

                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="220.00"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 220.00%;">
                                220.00%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child daily_food">
                        Koolhydraten<span class="icon-child pull-right"><i class="fa fa-arrow-up"
                                                                           aria-hidden="true"></i>5g</span>
                    </div>
                    <div class="col-md-2 card-child daily_food">
                        <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i>11g</span>
                    </div>
                    <div class="col-md-7 card-child">
                        <div class="progress progress-xl progress-half-rounded light  daily_food">

                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="220.00"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 220.00%;">
                                220.00%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child daily_food">
                        Vezel<span class="icon-child pull-right"><i class="fa fa-arrow-up"
                                                                    aria-hidden="true"></i>6g</span>
                    </div>
                    <div class="col-md-2 card-child daily_food">
                        <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i>11g</span>
                    </div>
                    <div class="col-md-7 card-child">
                        <div class="progress progress-xl progress-half-rounded light  daily_food">

                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="183.33"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 183.33%;">
                                183.33%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 cus-margin">
                    <div class="col-md-3 card-child daily_food">
                        Vet<span class="icon-child pull-right"><i class="fa fa-arrow-up"
                                                                  aria-hidden="true"></i>5g</span>
                    </div>
                    <div class="col-md-2 card-child daily_food">
                        <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i>11g</span>
                    </div>
                    <div class="col-md-7 card-child">
                        <div class="progress progress-xl progress-half-rounded light  daily_food">

                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="220.00"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 220.00%;">
                                220.00%
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
<input type="hidden" id="user-chart-id" value="{{Request::segment(5)}}">
    <div class="col-lg-12" style="margin-top: 10px;">
        <section class="card">

            <div class="card-body">

                <div class="page_content clear font-lato" style="margin-top: 20px; padding: 0px;  min-height: 750px;">
                    <div id="food_tracking_list">
                        <table id="foodoverview" style="width:100%; margin-top: 20px;">
                            <tbody>
                            <tr style="border-bottom: 1px solid #e7e7e7;">
                                <th style="width:50px; text-align: center;">
                                    {{--<input name="food_dummy" id="0" data-eattime="0" type="checkbox"--}}
                                           {{--onclick="$('.0 input').prop('checked', $(this).prop('checked')); show_options(this);">--}}
                                </th>
                                <th style="font-size: 20px; vertical-align: middle;" colspan="2">
                                    Ontbijt
                                </th>
                                <th style="width:150px;">Hoeveelheid</th>
                                <th style="width:80px;">Gegeten</th>
                                <th style="width:90px;">Calorieën</th>
                                <th style="width:90px;">Koolhydraten</th>
                                <th style="width:90px;">Eiwitten</th>
                                <th style="width:90px;">Vetten</th>
                            </tr>

                            {{--<tr id="0" style="background-color: #f7f7f7; border-top: 1px solid #e7e7e7;" c--}}
                                {{--class="open_food_search heightc" onclick="searchFood(this, 'fritsjanssen87'); return false;">--}}
                                {{--<td style="width:50px;"></td>--}}
                                {{--<td style="font-size: 13px;" colspan="9">--}}
                                    {{--Voeg voeding toe--}}
                                    {{--<div class="add_food_button pull-right"><i class="fa fa-plus"></i></div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}


                            @foreach($meals as $meal)
                                @if(!is_array($meal['name']))
                                    <tr style="border-bottom: 1px solid #e7e7e7;" class="heightc">
                                        <th style="width:50px; text-align: center;">
                                            <input name="food[]" id="1" data-eattime="1" type="checkbox" class="checks"
                                                   onclick="$('.checks').prop('checked', $(this).prop('checked')); show_options(this);">
                                        </th>
                                        <th style="font-size: 20px; vertical-align: middle;" colspan="2">
                                            {{$meal['name']}} <span title=""></span></th>
                                        <th colspan="7">&nbsp;</th>
                                    </tr>
                                @endif
                                @if(!is_array($meal['name']))
                                    @foreach($meal['data'] as $key=>$mealinner)
                                        <tr class="{{$key}}"
                                            @if($key%2==0) style="background-color:#f7f7f7;" @endif>
                                            <td style="width:50px; text-align: center;">
                                                <input name="food[]" data-foodid="100519" data-eattime="1" class="checks"
                                                       meal_id="{{$mealinner['mid']}}" track_id="290630588" type="checkbox"
                                                       onclick="show_options(this)"
                                                       id="">
                                            </td>
                                            <td
                                                style="cursor: pointer;">
                                                <img src="{{ asset('admin/images/groups/foodproducts/'.$mealinner['path'])}}" onerror="this.src={{ asset('admin/images/groups/foodproducts/noimage.jpeg')}}"
                                                     style="width:45px; height:45px;" class="float_left">&nbsp;
                                                <div style="float: left; padding-top: 15px; margin-left: 15px; font-weight: bold; font-size: 13px; width: 210px;"
                                                     class="nowrap">{{$mealinner['pname']}}
                                                </div>
                                            </td>
                                            <td>
                                                <div id="290630588_100519_edit" style="display: none; margin-top: 10px;"
                                                     class="icon icon_edit_nova"
                                                     >

                                                </div>
                                                <div id="290630588_100519_delete"
                                                     style="display: none; margin-top: 10px;"

                                                     class="icon icon_trash">

                                                </div>

                                            </td>
                                            <td style="color: #777777;" title="1 Eetlepel (15 gram)">
                                                <div
                                                     class="nowrapclass hands" style="width:220px;"> {{$mealinner['foodunit']}} {{$mealinner['amount']}} {{$mealinner['weight']}}m
                                                </div>
                                            </td>
                                            <td style="">
                                            </td>
                                            <td style="color: #777777;">{{$mealinner['kal']}} kcal</td>
                                            <td style="color: #777777;">{{ $mealinner['koolhydraten'] }} g.</td>
                                            <td style="color: #777777;">{{ $mealinner['eiwit'] }} g.</td>
                                            <td style="color: #777777;">{{ $mealinner['vitb1'] }} g.</td>
                                        </tr>
                                    @endforeach
                                @endif

                            @endforeach


                            </tbody>
                        </table>






                        <div class="modal fade" id="sidepopup" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <form method="post"  action="{{ route('admin.addServiceScheduleRqst') }}">

                                        {{csrf_field()}}



                                        <div class="modal-header">

                                            <h4 class="modal-title modtil">Toevoegen</h4>
                                            <button onclick="$('.checks').prop('checked', false);" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">


                                            <div style="margin: 0 auto">
                                                <button type="button" onclick="show_delete_popup(this,'{{Request::segment(6)}}')" class="btn btn-block btn-default " >Delete</button>
                                                <button type="button" onclick="copy_popup(this)" class="btn btn-block btn-primary " >Copy</button>

                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="$('.checks').prop('checked', false);" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        <div id="deletepopup" class="modal modal-danger fade" >
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
                                        <button onclick="$('.checks').prop('checked', false);" type="button" class="close" data-dismiss="modal" aria-label="Sluit">
                                            <span aria-hidden="true">&times;</span></button>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" onclick="$('.checks').prop('checked', false);" data-dismiss="modal">Close</button>
                                        <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteMealRqst') }}" id="delete_form">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <input name="ids" type="hidden" id="ids">
                                            <input name="date" type="hidden" value="" id="meal_date">
                                            <button type="submit" class="btn btn-outline" >Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>




                        <div class="modal fade" id="copypopup" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <form method="post"  action="{{ route('admin.copyMealRqst') }}">

                                        {{csrf_field()}}

                                        <input name="mids" type="hidden" id="mids">

                                        <div class="modal-header">

                                            <h4 class="modal-title modtil">Copy Meal</h4>
                                            <button onclick="$('.checks').prop('checked', false);" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="box-body">

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <div class="radio-custom radio-primary pull-right">
                                                        <input checked onclick="$('.advanced-box').hide();" type="radio" class="operationtype" name="advanced" value="default">
                                                        <label for="operationtype">Default</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Copy Date</label>
                                                        <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                                            <input type="text" name="targetdate" value="{{date('Y-m-d')}}" data-plugin-datepicker="" class="form-control targetdate">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <div class="radio-custom radio-primary pull-right">
                                                        <input type="radio" onclick="$('.advanced-box').show();" class="operationtype" name="advanced" value="advanced">
                                                        <label for="operationtype">Advanced</label>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="advanced-box" style="display: none">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                    <div class="weeklydays">
                                                        <label>dag </label>
                                                        <br>

                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="1" name="days[]"type="checkbox"  id="mo">
                                                            <label for="mon">Ma</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="2" name="days[]"type="checkbox"  id="tu">
                                                            <label for="tue">Di</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="3" name="days[]"type="checkbox"  id="we">
                                                            <label for="wed">Wo</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="4" name="days[]"type="checkbox"  id="th">
                                                            <label for="thr">Do</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="5" name="days[]"type="checkbox"  id="fr">
                                                            <label for="fri">Vr</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="6" name="days[]"type="checkbox"  id="sa">
                                                            <label for="sat">Za</label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary cus">
                                                            <input value="0" name="days[]"type="checkbox"  id="su">
                                                            <label for="sun">Zo</label>
                                                        </div>

                                                    </div>
                                                    </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label>Starts on</label>
                                                            <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                                                <input type="text" value="{{date('Y-m-d')}}" name="startdate" data-plugin-datepicker="" class="form-control startdate">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label>Ends on</label>
                                                            <div class="input-group">
														<span class="input-group-addon">
															 <input checked onclick="$('.weeks').prop('disabled', true);$('.enddate').prop('disabled', false);" type="radio" class="starts" name="startson" />
														</span>
                                                                <input type="text" value="{{date('Y-m-d')}}" name="enddate" data-plugin-datepicker="" class="form-control enddate">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label>Weeks</label>
                                                            <div class="input-group">
														<span class="input-group-addon">
															 <input  onclick="$('.enddate').prop('disabled', true);$('.weeks').prop('disabled', false)" type="radio" class="starts" name="startson" />
														</span>
                                                                <input disabled type="number" name="weeks" min="1"  class="form-control weeks">
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>








                                            </div>




                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="$('.checks').prop('checked', false);" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-block btn-primary " style="width:100px;" >Copy</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>


                </div>
            </div>
        </section>
    </div>
</div>

