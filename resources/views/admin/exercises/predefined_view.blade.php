
<h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">{{ count($predefined_schemas)  }} Predefined Schedules</h5>

@foreach($predefined_schemas as $k=>$predefined_schema)
    <div class="col-md-6 ">
 <section ondragstart="scheduleboxdrg(this)"  ondragend="scheduledragend(this)" class=" card card-featured-left card-featured-primary mb-4" onclick="showCarosel('{{$predefined_schema->schedule_id}}')" id="scheduleid_{{$predefined_schema->schedule_id}}" draggable="true">
    <div class="card-body">
        <input type="hidden" name="scheduleid" value="{{$predefined_schema->id}}">
        <div class="widget-summary">
            <div class="widget-summary-col widget-summary-col-icon">
                <div class="summary-icon bg-primary">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
            <div class="widget-summary-col">

                <a href="{{route('admin.showPdfRoute',$predefined_schema->schedule_id)}}" class="pull-right btn-box-tool" target="_blank"><i class="fa fa-print"></i> PDF</a>

                <div class="summary">
                    <h4 class="title">{{$predefined_schema->schema_name}}</h4>
                    <div class="info">
                        <strong class="amount">Days</strong>
                        <span class="text-primary">
                            @if(strlen($predefined_schema->days))

                                    @foreach(get_day_names_from_digit($predefined_schema->days) as $day)
                                       {{$day}} |
                                    @endforeach

                                @else
                                --
                            @endif
                        </span>
                    </div>
                    <div class="info">
                        <strong class="amount">Range</strong>
                        <span class="text-primary">
                            @if(strlen($predefined_schema->startdate))

                            {{ \Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y') }} - {{\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y') }}

                            @endif
                        </span>
                    </div>
                </div>
                <div class="summary-footer">
                    <a class="text-muted text-uppercase">Recurring: {{$predefined_schema->recurring}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
<div  id="slider_{{$predefined_schema->schedule_id}}" class="og-expander slider" style="background-color: white;display: none">


</div>
@endforeach



<div class="modal fade" id="carosselModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog contenthere modal-lg" role="document" style="width: 80%">

    </div>
</div>




