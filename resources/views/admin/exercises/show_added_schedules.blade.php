@foreach($predefined_schemas as $k=>$predefined_schema)


        <section class="card card-featured-left card-featured-primary mb-4">
            <div class="card-body">
                <div class="widget-summary widget-summary-sm">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <input type="hidden" name="scheduleid" value="{{$predefined_schema->id}}">
                    <div class="widget-summary-col">
                        <a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#delete-modal-pp{{$predefined_schema->schedule_id}}"><i class="fa fa-trash"></i> </a>

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
                                {{--<strong class="amount">Range</strong>--}}
                                <span class="text-primary">
                                   @if(strlen($predefined_schema->startdate))

                                        {{ \Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y') }} - {{\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y') }}

                                    @endif
                                </span>
                            </div>
                            <a class=" text-uppercase color-cus-black">Recurring: {{$predefined_schema->recurring}}</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        {{--<section ondragstart="scheduleboxdrg(this)" class=" card card-featured-left card-featured-primary mb-4" onclick="showCarosel('{{$predefined_schema->schedule_id}}')" id="scheduleid_{{$predefined_schema->schedule_id}}" draggable="true">--}}
            {{--<div class="card-body">--}}
                {{--<a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#delete-modal-pp{{$predefined_schema->schedule_id}}"><i class="fa fa-trash"></i> Delete</a>--}}

                {{--<input type="hidden" name="scheduleid" value="{{$predefined_schema->id}}">--}}
                {{--<div class="widget-summary">--}}
                    {{--<div class="widget-summary-col widget-summary-col-icon">--}}
                        {{--<div class="summary-icon bg-primary">--}}
                            {{--<i class="fa fa-life-ring"></i>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="widget-summary-col">--}}
                        {{--<div class="summary">--}}
                            {{--<h4 class="title">{{$predefined_schema->schema_name}}</h4>--}}
                            {{--<div class="info">--}}
                                {{--<strong class="amount">Days</strong>--}}
                        {{--<span class="text-primary">--}}
                            {{--@if(strlen($predefined_schema->days))--}}

                                {{--@foreach(get_day_names_from_digit($predefined_schema->days) as $day)--}}
                                    {{--{{$day}} |--}}
                                {{--@endforeach--}}

                            {{--@else--}}
                                {{------}}
                            {{--@endif--}}
                        {{--</span>--}}
                            {{--</div>--}}
                            {{--<div class="info">--}}
                                {{--<strong class="amount">Range</strong>--}}
                        {{--<span class="text-primary">--}}
                            {{--@if(strlen($predefined_schema->startdate))--}}

                                {{--{{ \Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y') }} - {{\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y') }}--}}

                            {{--@endif--}}
                        {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="summary-footer">--}}
                            {{--<a class="text-muted text-uppercase">Recurring: {{$predefined_schema->recurring}}</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}




    {{----}}
   {{--<div class="one-row" style="height: 90px; color: black;">--}}
        {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
            {{--<div class="info-box schedulebox"   draggable="true">--}}
                {{--<span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>--}}
                {{--<a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#delete-modal-pp{{$predefined_schema->schedule_id}}"><i class="fa fa-trash"></i> Delete</a>--}}

                {{--<div class="info-box-content">--}}
                    {{--<input type="hidden" name="scheduleid" value="{{$predefined_schema->id}}">--}}
                    {{--<span class="info-box-text">{{$predefined_schema->schema_name}}</span>--}}
                    {{--<span class="info-box-text">Recurring <small class="--}}
                    {{--label pull-right bg-yellow">{{$predefined_schema->recurring}}</small></span>--}}
                    {{--@if(strlen($predefined_schema->days))--}}
                        {{--<span class="info-box-text">Days--}}
                        {{--@foreach(get_day_names_from_digit($predefined_schema->days) as $day)--}}
                            {{--<small class="pull-right ">{{$day}} | </small>--}}
                        {{--@endforeach--}}
                            {{--</span>--}}
                    {{--@endif--}}
                    {{--@if(strlen($predefined_schema->startdate))--}}
                        {{--<span class="info-box-text">Range--}}
                        {{--<small class=" pull-right">{{ \Carbon\Carbon::parse($predefined_schema->startdate)->format('M d Y') }} - {{\Carbon\Carbon::parse($predefined_schema->enddate)->format('M d Y') }}</small>--}}
{{--</span>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}




        {{--</div>--}}


       <div id="delete-modal-pp{{$predefined_schema->schedule_id}}" class="modal modal-danger fade">
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
                       <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteAddedRqst', $predefined_schema->schedule_id)}}">
                           {{csrf_field()}}
                           {{method_field('DELETE')}}
                           <button type="submit" class="btn btn-outline">Delete</button>
                       </form>
                   </div>
               </div>
               <!-- /.modal-content -->
           </div>
       </div>


@endforeach