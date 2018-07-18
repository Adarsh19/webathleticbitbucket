@if(count($users))
<section class="card mb-3">
    <header class="card-header">
        <div class="card-actions">
            <a class="card-action card-action-dismiss" data-card-dismiss="" onclick ="closethis(this)"></a>
        </div>

        <h2 class="card-title">
            <span class="badge badge-primary font-weight-normal va-middle p-2 mr-2">{{count($users)}}</span>
            <span class="va-middle">Users</span>
        </h2>
    </header>
    <div class="card-body">
        <div class="content">
            <ul class="simple-user-list">
                @foreach($users as $user)
                <li onclick="chooseoption('{{$user->id}}','{{$user->user_color_code}}','{{$user->name}}','{{ $service->user_mass}}','{{$type}}')" class="pointer">
                    <input type="hidden" class="userids" id="user-id" value="{{$user->id}}">
                    <figure class="image rounded">
                        <img src="{{ asset('site_images/'.$user->avatar)}}" alt="{{$user->name}}"  onerror=this.src="{{ asset('admin_files/img/!sample-user.jpg')}}" class="rounded-circle cus-userimg">
                    </figure>
                    <span class="title">{{$user->name}}</span>
                    <span class="message truncate">{{$user->email}}</span>
                </li>
                @endforeach

            </ul>

        </div>
    </div>

</section>
<script>
    function closethis(ds){
        $('.searchsuserwithrolebox').html("");
    }

    function chooseoption(user_id,bg_color,user_name,max_users_with_service,type){

        if(bg_color.length==0)
            bg_color="#0088cc";


        if(type=="sidebar"){

            $('.user_id_connected').val(user_id);
            $('#new-event').val(user_name);
            $('.searchbaruser_right_sidebarbox').html("");

        }else{

            if($('.user_b_row_'+user_id).length==0){

                if($('.users_booked').length==max_users_with_service){
                    if($('.user_r_row_'+user_id).length==0) {
                        var userhtmlr = '<div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_reservated user_r_row_' + user_id + '" data-event-class="fc-event-default" style="border-color: ' + bg_color + '; background-color: ' + bg_color + '; position: relative;">' + user_name;
                        userhtmlr += '<input class="userid" type="hidden" name="user_ids[]" value="'+user_id+'"><div class="tools pull-right" ><i class="fa fa-trash-o pointer" onclick="removethisr('+user_id+')"></i></div> </div>';

                        $('.reservate_users').append(userhtmlr);
                    }else{
                        $('.user_r_row_'+user_id).remove();
                    }
                }else{

                    var userhtml="";
                    if($( ".users_reservated").length>0){
                        $( ".users_reservated" ).each(function( index ) {

                            var style=$(this).attr('style');
                            userhtml='<div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_booked user_b_row_'+$(this).find('.userid').val()+'" data-event-class="fc-event-default" style="'+style+'">';
                            userhtml+=$(this).html()+'</div>';
                            $('.user_r_row_'+$(this).find('.userid').val()).remove();

                            var userhtmlr = '<div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_reservated user_r_row_' + user_id + '" data-event-class="fc-event-default" style="border-color: ' + bg_color + '; background-color: ' + bg_color + '; position: relative;">' + user_name;
                            userhtmlr += '<input class="userid" type="hidden" name="user_ids[]" value="'+user_id+'"><div class="tools pull-right"><i class="fa fa-trash-o pointer" onclick="removethisr('+user_id+')"></i></div> </div>';
                            $('.reservate_users').append(userhtmlr);

                            return false;


                        });
                    }else{
                        userhtml='<div class="pointer-events-none form-group external-event badge badge-default width100 ui-draggable ui-draggable-handle users_booked user_b_row_'+user_id+'" data-event-class="fc-event-default" style="border-color: '+bg_color+'; background-color: '+bg_color+'; position: relative;">'+user_name;
                        userhtml+='<input class="userid"  type="hidden" name="user_ids[]" value="'+user_id+'"><div class="tools pull-right"><i class="fa fa-trash-o pointer" onclick="removethisb('+user_id+')"></i></div> </div>';

                    }

                    $('.booked_users').append(userhtml);
                }

            }else{
                $('.user_b_row_'+user_id).remove();
            }

            $('#added_count').text($('.users_booked').length);
            $('#reservated_count').text($('.users_reservated').length);
        }



    }


    function removethisr(id){

        $('.user_r_row_'+id).remove();

    }
    function removethisb(id){
        $('.user_b_row_'+id).remove();

    }
</script>
@endif