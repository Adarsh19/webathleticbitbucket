{{--@if(count($users))--}}
    {{--<div class="row pull-right closeuserlist" onclick="closeuserlist()"><i class="fa fa-close"></i>close</div>--}}
{{--@foreach($users as $user)--}}

    {{--<div class="col-md-12 col-sm-12 col-xs-12" onclick="clickoption(this)" >--}}

 {{--<div class="profile clearfix " userid="user_{{$user->id}}">--}}
    {{--<div class="profile_pic">--}}
        {{--<input type="hidden" class="userids" name="userids[]" value="{{$user->id}}">--}}
        {{--@if(isset($user->avatar))--}}
        {{--<img class="img-circle profile_img" src="{{ asset('public/web/avatar/groups/'.$user->avatar)}}" alt="profile" />--}}
        {{--@else--}}
            {{--<img class="img-circle profile_img"  src="{{ asset('public/avatar/user.png')}}" alt="profile" />--}}

        {{--@endif--}}
    {{--</div>--}}
    {{--<div class="profile_info">--}}
        {{--<span>{{ $user->name }}</span>--}}

        {{--<h2>{{ $user->email }}</h2>--}}
    {{--</div>--}}
 {{--</div>--}}
 {{--</div>--}}
{{--@endforeach--}}
    {{--@else--}}

    {{--<div class="profile clearfix " onclick="clickoption(this)">--}}
       {{--No Results Found--}}
    {{--</div>--}}

{{--@endif--}}



@if(count($users))
    <section class="color-cus-black">
        <header class="card-header">
            <div class="card-actions">
                <a class="card-action card-action-dismiss" data-card-dismiss="" onclick="closeuserlist()"></a>
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
                        <li  style="cursor: pointer" onclick="clickoptionUserExercises(this)">
                            <input type="hidden" class="userids" id="user-id" value="{{$user->id}}">
                            <figure class="image rounded">
                                <img src="{{ asset('site_images/'.$user->avatar)}}" alt="{{$user->name}}"  onerror=this.src="{{ asset('admin_files/img/!sample-user.jpg')}}" class="rounded-circle imagesize_logo">
                            </figure>
                            <span class="title">{{$user->name}}</span>
                            <span class="message truncate">{{$user->email}}</span>
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>


    </section>

@else

    <div class="profile clearfix " onclick="clickoption(this)">
        No Results Found
    </div>

@endif

