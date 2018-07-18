<?php $user = Auth::user(); ?>
<style type="text/css">
    .userbox .role {
        color: #ACACAC;
        font-size: 0.85rem;
        line-height: 1.2rem;
    }
</style>
<a href="#" class="dash-logo">
    <span class="logo-sm">
        <img src="{{ asset('/images/vplogo.png')}}" alt="webathletic" />
    </span>
</a>

    <div class="right-wrapper">
                <a class="sidebar-right-toggle" data-open="sidebar-right" style="float:right;">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </a>
                <div class="header-right" style="float: right;">
                    <div class="uw-saldo-value" style=""><span>Uw saldo 5.00</span></div>
                    <span class="separator"></span>
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="{{ asset('profile_images/' . $user->avatar)}}" alt="{{$user->name}}" class="rounded-circle" data-lock-picture="{{ asset('profile_images/' . $user->avatar)}}" />
                            </figure>
                            <div
                                class="profile-info" data-lock-lock="{{Session::has('lock')}}" data-lock-url="{{route('admin.unlock')}}" data-lock-token="{{ csrf_token() }}"
                                data-lock-name="<?php echo $user->username; ?>"
                                data-lock-email="<?php echo $user->email; ?>">
                                <span class="name"><?php echo $user->name; ?></span>
                                <span class="role"><?php echo $user->role; ?></span>
                            </div>
                            <i class="fa custom-caret"></i>
                        </a>
                        <div class="dropdown-menu">
                            <ul class="list-unstyled mb-2">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ url('/admin/users/'.$user->id) }}"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" data-url="{{route('admin.screen-lock')}}" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ url('/signout') }}"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="notifications">                      
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge">{{count($user->unreadNotifications)}}</span>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="float-right badge badge-default">{{count($user->unreadNotifications)}}</span>
                                    Alerts
                                </div>
            
                                <div class="content">
                                    <ul>

                                        <?php
                                        $user = App\User::find($user->id);
                                        ?>

                                        @foreach ($user->unreadNotifications as $notification)

                                                <li>
                                                    <a href="#" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-bell bg-info text-light"></i>
                                                        </div>
                                                        <span class="title"> {{ str_replace("_",$notification['data']['schema_name'],Helper::mappings($notification['type']))}}</span>
                                                        <span class="message">{{$notification['created_at']->diffForHumans()}}</span>
                                                    </a>
                                                </li>

                                        @endforeach



                                        {{--<li>--}}
                                            {{--<a href="#" class="clearfix">--}}
                                                {{--<div class="image">--}}
                                                    {{--<i class="fa fa-lock bg-warning text-light"></i>--}}
                                                {{--</div>--}}
                                                {{--<span class="title">User Locked</span>--}}
                                                {{--<span class="message">15 minutes ago</span>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#" class="clearfix">--}}
                                                {{--<div class="image">--}}
                                                    {{--<i class="fa fa-signal bg-success text-light"></i>--}}
                                                {{--</div>--}}
                                                {{--<span class="title">Connection Restaured</span>--}}
                                                {{--<span class="message">10/10/2017</span>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                    <hr/>
                                    <div class="text-right">
                                        <a href="{{ route('admin.viewnotificationsRqst','all') }}" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="header-icons-block">
                        <a class="header-country-img">
                        <img src="{{ asset('images/asterdam.png')}}" alt="Joseph Junior" /></a>
                    </div>
                </div>
            </div>
