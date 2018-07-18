<style>
    .img-circle-cus{
        display: block;
        width: 70px;
        height: 70px;
        margin: -25px 0;
        border: 4px solid #fff;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        object-fit: cover;
    }
    .search_users_exercises{max-height: 300px;overflow: auto}
    .margintop{margin-top: 10px;}
</style>


<div class="col-md-3 col-sm-12 col-xs-12" style="background-color:#545454;color:white;padding-bottom: 10px;min-height: 800px">
    <div class="userbar col-md-12" style="margin-bottom: 10px;overflow: auto;min-height: 50px;max-height: 300px">
    </div>
    <hr id="line">

    {{--<div class="col-md-12">--}}

            {{--<input type="text" class="form-control searchbaruder" placeholder="Search user...">--}}



    {{--</div>--}}

    <div class="col-md-12">


        <div class="search_users_exercises margintop">

        </div>

        {{--<div class="searchresultsbox" style="overflow: auto;min-height: 50px;max-height: 300px">--}}

        {{--</div>--}}
    </div>

    <div id="cart" class="col-md-12 cart" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>
    </div>




    <div class="col-md-12 sortablediv">



        <div   class="doprul products-list product-list-in-box sortable_exercises_added" >
        </div>



    </div>



    <div class="col-md-12 schedulelist" style="display: none">

        <div class="schedulelistinner"></div>

        {{--<button type="button" class="pull-right btn btn-success   add-button" href="#" data-toggle="modal" data-target="#saveScheduleModal"><i class="fa fa-save"></i> Save</button>--}}


    </div>


    <div class="col-md-12 sortablebuttons" style="padding-top: 20px" >

        <button type="button" class="btn btn-danger   add-button" href="" data-toggle="modal" data-target="#deleteSchema"><i class="fa fa-trash"></i> Schema verwijderen  </button>
        <button type="button" class="btn btn-success   add-button save-btn-cus" href="#" data-toggle="modal" data-target="#saveScheduleModal"><i class="fa fa-save"></i> Opslaan</button>
    </div>




        {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
            {{--<div class="info-box schedulebox">--}}
                {{--<span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>--}}
                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">Daad</span>--}}
                    {{--<span class="info-box-text">Recurring <small class="--}}
                    {{--label pull-right bg-yellow">NO</small></span>--}}
                    {{--@if(strlen($predefined_schema->days))--}}
                    {{--<span class="info-box-text">Days </span>--}}
                    {{--@foreach(get_day_names_from_digit($predefined_schema->days) as $day)--}}
                    {{--<small class="pull-right ">{{$day}} | </small>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--@if(strlen($predefined_schema->startdate))--}}
                    {{--<span class="info-box-text">Range </span>--}}
                    {{--<small class=" pull-right">{{ \Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y') }} - {{\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y') }}</small>--}}

                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}






</div>








