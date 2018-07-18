
<style>
    .cus-mar-right{    margin-right: 4px;}

</style>
<h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">{{ count($predefined_schemas)  }} Predefined Schedules</h5>

<div class=" show-grid">
@foreach($predefined_schemas as $k=>$predefined_schema)
    <div class="col-md-6 pull-left">
 <section ondragstart="scheduleboxdrg(this,'{{Request::segment(4)}}')"  ondragend="scheduledragend(this)" class=" card card-featured-left card-featured-primary mb-4"  id="scheduleid_{{$predefined_schema->schedule_id}}" draggable="true">
    <div class="card-body">
        <input type="hidden" name="scheduleid" value="{{$predefined_schema->id}}">
        <div class="widget-summary">
            <div class="widget-summary-col widget-summary-col-icon">
                <div class="summary-icon bg-primary">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
            <div class="widget-summary-col">
                <a href="{{route('admin.showPdfRoute',$predefined_schema->schedule_id)}}" class="pull-right btn-box-tool cus-mar-right" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
                <a href="#" data-toggle="modal" data-target="#delete-schedule-modal{{$predefined_schema->schedule_id }}"  class="pull-right btn-box-tool cus-mar-right" ><i class="fa fa-trash"></i></a>&nbsp;
                <a href="/admin/exercises/edit/{{Request::segment(4)}}/{{$predefined_schema->schedule_id}}" class="pull-right btn-box-tool cus-mar-right" ><i class="fa fa-edit"></i></a>&nbsp;
                <a href="#" onclick="showCarosel('{{$predefined_schema->schedule_id}}')" class="pull-right btn-box-tool cus-mar-right" ><i class="fa fa-eye"></i></a>&nbsp;


                <div id="delete-schedule-modal{{$predefined_schema->schedule_id }}" class="modal modal-danger fade">
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
                                <form method="post" role="form" id="delete_form" action="{{ route('admin.deletePredefinedSchemaRqst', $predefined_schema->schedule_id)}}">
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
@endforeach
</div>


<div class="pagination mt-5">
    {!! $predefined_schemas->links('vendor.pagination.bootstrap-4')  !!}`
</div>


<div class="modal fade" id="carosselModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog contenthere modal-lg" role="document" style="width: 80%">

    </div>
</div>




