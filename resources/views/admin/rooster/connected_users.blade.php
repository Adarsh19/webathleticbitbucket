

<div class="col-lg-12">
    <p class="h5 font-weight-light"><i class="fa fa-user"></i> Connected users</p>

    <hr/>

    <div id='external-events'>
        @if(count($connected_users))
            @foreach($connected_users as $connected_user)
                <div user_id="user_{{$connected_user->user_id}}" class="external-event badge badge-success ui-draggable ui-draggable-handle width100" data-event-class="fc-event-default"
                     style="border-color: {{$connected_user->user_color_code}};background-color: {{$connected_user->user_color_code}}">{{$connected_user->name}}
                    <div class="tools pull-right">
                        <i class="fa fa-edit pointer"
                           onclick="editConnectedUser('{{$connected_user->user_color_code}}','{{$connected_user->id}}','{{$connected_user->user_id}}','{{$connected_user->name}}')"></i>
                        <i class="fa fa-trash-o pointer" data-toggle="modal"
                           data-target="#delete-modal-pv{{$connected_user->user_id }}"></i>
                    </div>
                </div>


                <div id="delete-modal-pv{{$connected_user->user_id }}" class="modal modal-danger fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">
                                <span class="fa-stack fa-sm">
								<i class="fa fa-square-o fa-stack-2x"></i>
								<i class="fa fa-trash fa-stack-1x"></i>
							</span>
                                    @lang('common.delete_modal_text')
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left"
                                        data-dismiss="modal">Close
                                </button>
                                <form method="post" role="form" id="delete_form"
                                      action=" {{ route('admin.deleteConnectedUserRqst',$connected_user->user_id ) }}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @endforeach
        @else
            No users Connected
        @endif
        <hr/>
    </div>
</div>
