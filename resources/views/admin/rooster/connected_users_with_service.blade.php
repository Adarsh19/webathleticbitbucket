<div class="col-md-6 form-group">
    <div class="form-group">
        <label class="margintop15">Booked Users</label>
        <div class="booked_users">

            @foreach($connected_users_with_service as $user)
                @if($user->bookflag)
                    @if(isset($user->user_color_code))
                       <?php $color=$user->user_color_code?>
                    @else
                        <?php $color="#0088cc"?>
                    @endif
               <div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_booked user_b_row_{{$user->id}}" data-event-class="fc-event-default" style="border-color: {{$color}}}; background-color:{{$color}}; position: relative;">{{$user->name}}
                <input class="userid" type="hidden" name="user_ids[]" value="{{$user->id}}">
                <div class="tools pull-right"><i onclick="removethisb({{$user->id}})"  class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-modal-pv2"></i></div> </div>
                @endif
            @endforeach
        </div>

    </div>

</div>

<div class="col-md-6 form-group">
    <div class="form-group">
        <label class="margintop15">Reservate Users</label>
        <div class="reservate_users">
            @foreach($connected_users_with_service as $user)
                @if(isset($user->user_color_code))
                    <?php $color=$user->user_color_code?>
                @else
                    <?php $color="#0088cc"?>
                @endif
                @if(!$user->bookflag)
                <div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_booked user_b_row_{{$user->id}}" data-event-class="fc-event-default" style="border-color: {{$color}}; background-color: {{$color}} ; position: relative;">{{$user->name}}
                    <input class="userid" type="hidden" name="user_ids[]" value="{{$user->id}}">
                    <div class="tools pull-right"><i onclick="removethisr({{$user->id}})" class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-modal-pv2"></i></div> </div>
                @endif
            @endforeach
        </div>
    </div>

</div>

{{--<script>--}}
    {{--function removethisr(id){--}}

        {{--$('.user_r_row_'+id).remove();--}}

    {{--}--}}
    {{--function removethisb(id){--}}
        {{--alert(id);--}}
        {{--$('.user_b_row_'+id).remove();--}}

    {{--}--}}
{{--</script>--}}
