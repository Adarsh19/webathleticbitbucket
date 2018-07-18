

        <section class="" style="margin-top: 10px;" >
            <div class="card-body">
                <div class="content">
                    <ul class="simple-user-list color-cus-black addUsersHere">


                        @if(!empty($users))
@foreach($users as $user)
    <li  style="cursor: pointer" id="userrow_{{$user->id}}">
        <a class="close closebtn"><span aria-hidden="true" onclick="removeUser(this,'{{Request::segment(4)}}')">&times; </span></a>
        <input type="hidden" class="userids" id="user-id" value="{{$user->id}}">
        <figure class="image rounded">
            <img src="{{ asset('site_images/'.$user->avatar)}}" alt="{{$user->name}}"  onerror=this.src="{{ asset('admin_files/img/!sample-user.jpg')}}" class="rounded-circle imagesize_logo">
        </figure>
        <span class="title">{{$user->name}}</span>
        <span class="message truncate">{{$user->email}}</span>
    </li>




@endforeach
                        @endif
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



