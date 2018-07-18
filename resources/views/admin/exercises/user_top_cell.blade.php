
    @if(empty($users))
        <h2>Please select User</h2>
    @else

        <section class="" style="margin-top: 10px;" >
            {{--<header class="card-header">--}}


                {{--<h2 class="card-title">--}}
                    {{--<span class="badge badge-primary font-weight-normal va-middle p-2 mr-2 counthere">{{count($users)}}</span>--}}
                    {{--<span class="va-middle">Users added</span>--}}
                {{--</h2>--}}
            {{--</header>--}}
            <div class="card-body">
                <div class="content">
                    <ul class="simple-user-list color-cus-black addUsersHere">


@foreach($users as $user)
    {{--<div class="userid_row" id="userrow_{{$user->id}}">--}}
    {{--<a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>--}}
            {{--<div class="profile clearfix " >--}}
                {{--<div class="profile_pic">--}}
                    {{--<input type="hidden" class="userids" name="userids[]" value="{{$user->id}}">--}}

                        {{--<img class="img-circle profile_img" src="{{ asset('public/web/avatar/groups/'.$user->avatar)}}" onerror=this.src="{{ asset('admin/images/groups/exercises/noimage.jpeg')}}" alt="profile" />--}}

                {{--</div>--}}
                {{--<div class="profile_info">--}}
                    {{--<span>{{ $user->name }}</span>--}}

                    {{--<h2>{{ $user->email }}</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
    {{--</div>--}}


    <li  style="cursor: pointer" id="userrow_{{$user->id}}">
        <a class="close closebtn"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>
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
            <div class="card-footer">
                <div class="input-group input-search">
                    <input type="text" class="form-control searchbaruder" placeholder="Search user...">
                </div>
            </div>
        </section>

        {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
    {{--<div class="profile_pic">--}}
        {{--<input type="hidden" id="user-id" value="{{$user->id}}">--}}
        {{--@if(isset($user->avatar))--}}
        {{--<img class="img-circle profile_img" src="{{ asset('public/web/avatar/groups/'.$user->avatar)}}" alt="profile" />--}}
        {{--@else--}}
        {{--<img class="img-circle profile_img"  src="{{ asset('public/avatar/user.png')}}" alt="profile" />--}}

        {{--@endif--}}
    {{--</div>--}}
    {{--<div class="profile_info">--}}
        {{--<span style="text-align: center">{{ $user->name }}</span>--}}

        {{--<h2>{{ $user->email }}</h2>--}}
    {{--</div>--}}
{{--</div>--}}

@endif

