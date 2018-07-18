@if(count($users))
    <section class="color-cus-black">
        {{--<header class="card-header">--}}
            {{--<div class="card-actions">--}}
                {{--<a class="card-action card-action-dismiss" data-card-dismiss="" onclick="closeuserlist()"></a>--}}
            {{--</div>--}}

            {{--<h2 class="card-title">--}}
                {{--<span class="badge badge-primary font-weight-normal va-middle p-2 mr-2">{{count($users)}}</span>--}}
                {{--<span class="va-middle">Users</span>--}}
            {{--</h2>--}}
        {{--</header>--}}
        <div class="card-body">
            <div class="content">
                <ul class="simple-user-list">
                    @foreach($users as $user)
                        <li  style="cursor: pointer" onclick="clickoptionUserExercises(this,'{{Request::segment(4)}}')">
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

