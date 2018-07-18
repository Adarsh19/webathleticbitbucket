@extends('layouts.admin_layout')
@section('title','Products')
@section('style')
    <link rel="stylesheet" href="{{ asset('exercises/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">

    <style>
        .widthc{width:120px;}
        .customheight{min-height: 75px;}
        .predefined-schema-grid{display: none}
        .color-cus-black{color:#000 !important;}
        .save-btn-cus{  width: 122px;}
        .imagesize_logo{
            height: 40px;
            width: 40px;
        }
        .cus-width-btn{width:100px}
    </style>
@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Exercises</h2>
            @include('admin.includes.header')
        </header>




        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-grav active"></i>&nbsp; Exercises</a></li>
            </ol>
        </section>




        {{--inside row tag content here--}}

        <div class="row">

            @include('admin.exercises.droparea')

            <div class="col-md-9">

                <div class="exercises-grid">


                    <div class="tabs">
                        <ul class="nav nav-tabs tabs-primary justify-content-end">
                            <li class="nav-item ">
                                <a  onclick="showpredefinedview()" class="nav-link" href="#popular7" data-toggle="tab"> Opgeslagen schema’s </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#recent7" data-toggle="tab">Groep toevoegen </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="modal" data-target="#productModaladd" href="#recent7" data-toggle="tab">Oefening toevoegen
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="popular7" class="tab-pane active">

                                @include('admin.exercises.filter')

                                @include('admin.exercises.grid_view')
                                <hr>
                                {{--<div class="row">--}}

                                    {{--<div class="col-md-12">--}}
                                        {{--<section class="col-md-12 card mb-4">--}}
                                            {{--@include('admin.exercises.grid_view')--}}
                                        {{--</section>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                                 </div>

                        </div>
                    </div>




                {{--<div class="row">--}}

                    {{--<div class="col-md-12">--}}
                        {{--<section class="col-md-12 card mb-4">--}}
                            {{--<div class="card-body customheight">--}}
                                {{--<span><i class="fa fa-filter"></i> Choose Filter</span>--}}
                                {{--<div class="box-tools pull-right">--}}
                                    {{--<button type="button" class="mb-1 mt-1 mr-1 btn btn-default" onclick="showpredefinedview()"><i class="fa fa-hand-o-up"></i> Predefined Schemas</button>--}}
                                    {{--<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary widthc" href="#" data-toggle="modal" data-target="#groupModal"><i class="fa fa-plus"></i> Add  Group</button>--}}
                                    {{--<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary widthc" href="#" data-toggle="modal" data-target="#productModaladd"><i class="fa fa-plus"></i> Add  Exercise</button>--}}
                                {{--</div>--}}
                                {{--<hr>--}}

                                {{--@include('admin.exercises.filter')--}}
                            {{--</div>--}}
                        {{--</section>--}}
                    {{--</div>--}}

                {{--</div>--}}
                {{--<div class="row">--}}

                    {{--<div class="col-md-12">--}}
                        {{--<section class="col-md-12 card mb-4">--}}
                            {{--@include('admin.exercises.grid_view')--}}
                        {{--</section>--}}
                    {{--</div>--}}

                {{--</div>--}}
                </div>
                <div class="predefined-schema-grid">
                    <div class="row">

                        <div class="col-md-12">
                            <section class="col-md-12 card mb-4">
                                <div class="card-body customheight">
                                    {{--<span><i class="fa fa-filter"></i> Choose Filter</span>--}}
                                    {{--<div class="box-tools pull-right col-md-3">--}}
                                        {{--<button type="button" class="btn btn-default" onclick="showexerciseview()"><i class="fa  fa-arrow-circle-left"></i> Back</button>--}}
                                    {{--</div>--}}


                                    <div class="input-group input-group-sm col-md-12">
                                        <input type="text" class="form-control search_keyword" placeholder="e.g, shemaname, username," >
                    <span class="input-group-btn  ">
                      <button type="button" class="btn btn-primary btn-flat" onclick="searchPrdefinedResults(this)">Search!</button>
                    </span>
                                        <button type="button" class="btn btn-default" onclick="showexerciseview()"><i class="fa  fa-arrow-circle-left"></i> Back</button>

                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 ">
                            <section class="col-md-12 card mb-4 predefinedgrid">

                            </section>
                        </div>

                    </div>


                    </div>


            </div>



        </div>
        <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.addExerciseGroupRqst')}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title">Add Exercise Group</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="groupname">Group name</label>
                                <input type="text" name="groupname" class="form-control" id="groupname"
                                       aria-describedby="grpnameHelp"
                                       placeholder="Enter group name" required>
                                <small id="grpnameHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>



@endsection
@section('site_scripts')

    <script type="text/javascript" src="{{asset('exercises/exercises.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin_files/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


@endsection
@section('scripts')
@endsection