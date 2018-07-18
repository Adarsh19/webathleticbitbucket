@extends('layouts.admin_layout')
@section('title','Products')
@section('style')

    <link rel="stylesheet" href="{{ asset('/admin_files/vendor/animate/animate.css')}}">

@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Notifications</h2>
            @include('admin.includes.header')
        </header>


        <section class="content-header">
            <ol class="breadcrumb breadcrumextra">
                <li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard </a></li>
                <li class="active"> - Notifications</li>
            </ol>
        </section>


        <!-- start: page -->
        <!-- end: page -->



        <div class="timeline">
            <div class="tm-body">


                @foreach($notifications as $notificationouter)



                    <div class="tm-title">
                        <h5 class="m-0 pt-2 pb-2 text-uppercase">{{ $notificationouter['created_at'] }}</h5>
                    </div>
                    <ol class="tm-items">
                        @foreach($notificationouter['data'] as $notificationinner)
                            <li>
                                <div class="tm-info">
                                    <div class="tm-icon"><i class="fa fa-star"></i></div>
                                    <time class="tm-datetime" datetime="2017-11-22 19:13">
                                        <div class="tm-datetime-date">{{ \Carbon\Carbon::parse($notificationinner['created_at'])->diffForHumans() }}</div>
                                        <div class="tm-datetime-time">{{ \Carbon\Carbon::parse($notificationinner['created_at'])->format('g:i A') }}</div>
                                    </time>
                                </div>
                                <div class="tm-box " data-appear-animation="fadeInRight"data-appear-animation-delay="100">
                                    <p>

                                        {{ str_replace("_",json_decode($notificationinner['data'])->schema_name,Helper::mappings($notificationinner['type']))}}
                                    </p>
                                    <div class="tm-meta">
                                    <span>
                                    <i class="fa fa-user"></i> By <a href="#">John Doe</a>
                                    </span>
                                    <span>
                                    <i class="fa fa-tag"></i> <a href="#">Porto</a>, <a href="#">Awesome</a>
                                    </span>
                                    <span>
                                    <i class="fa fa-comments"></i> <a href="#">5652 Comments</a>
                                    </span>
                                    </div>
                                </div>
                            </li>

                        @endforeach
                    </ol>

                @endforeach


            </div>
        </div>
        <!-- end: page -->



    </section>



@endsection
@section('site_scripts')


@endsection
@section('scripts')
@endsection










