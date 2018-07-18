@extends('layouts.admin_layout')
@section('title','Exercises')
@section('style')
    <link rel="stylesheet" href="{{ asset('exercises/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">

    <style>
        .widthc {
            width: 120px;
        }

        .customheight {
            min-height: 75px;
        }

        .predefined-schema-grid {
            display: none
        }

        .color-cus-black {
            color: #000 !important;
        }

        .save-btn-cus {
            width: 100%;
        }

        .imagesize_logo {
            height: 40px;
            width: 40px;
        }

        .cus-width-btn {
            width: 100px
        }

        .black-side-bg{

            background-color: #545454;
            color: white;
            padding-bottom: 10px;
            min-height: 800px;
            height: 100%;
        }
        .rotator{display: none;}
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
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i
                                class="fa fa-grav active"></i>&nbsp; Exercises</a></li>
            </ol>
        </section>


        {{--inside row tag content here--}}

        <div class="row">

            <div class="col-md-3 black-side-bg">

                <div style="" id="LoadingOverlayApi" data-loading-overlay>
                    <div class="dropcontent">

                        @include('admin.exercises.droparea')

                    </div>

                </div>

                {{--<div class="loading-overlay" style="background-color: rgb(255, 255, 255); border-radius: 0px;"><div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>--}}
            </div>

            {{--            @include('admin.exercises.droparea')--}}

            <div class="col-md-9">


                @if(Request::segment(3)=="predefined-schemas")
                    {{Request::segment(3)}}
                    <div class="predefined-schema-grid1">
                        <div class="row">

                            <div class="col-md-12">
                                <section class="col-md-12 card mb-4">
                                    <div class="card-body customheight">
                                        {{--<span><i class="fa fa-filter"></i> Choose Filter</span>--}}
                                        {{--<div class="box-tools pull-right col-md-3">--}}
                                        {{--<button type="button" class="btn btn-default" onclick="showexerciseview()"><i class="fa  fa-arrow-circle-left"></i> Back</button>--}}
                                        {{--</div>--}}


                                        <div class="input-group input-group-sm col-md-12">
                                            <input type="text" class="form-control search_keyword"
                                                   placeholder="e.g, shemaname, username,">
                                            <span class="input-group-btn  ">
                      <button type="button" class="btn btn-primary btn-flat" onclick="searchPrdefinedResults(this)">Search!</button>
                    </span>
                                            {{--<button type="button" class="btn btn-default" onclick="showexerciseview()"><i class="fa  fa-arrow-circle-left"></i> Back</button>--}}
                                            <a href="{{route('admin.exercisesViewRqst',$user->id)}}"
                                               class="btn btn-default"><i class="fa  fa-arrow-circle-left"></i> Back</a>

                                        </div>
                                    </div>
                                </section>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 ">
                                <section class="col-md-12 card mb-4 predefinedgrid1">
                                    @include('admin.exercises.predefined_view')
                                </section>
                            </div>

                        </div>


                    </div>

                @else
                    <div class="exercises-grid1">


                        <div class="tabs">
                            <ul class="nav nav-tabs tabs-primary justify-content-end">
                                <li class="nav-item ">
                                    {{--<a  onclick="showpredefinedview('{{$user->id}}')" class="nav-link" href="#popular7" data-toggle="tab"> Opgeslagen schema’s </a>--}}
                                    <a href="{{route('admin.exercisesPrdefefinedSchemaViewRqst',$user->id)}}"
                                       class="nav-link"> Opgeslagen schema’s </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#groupModal"
                                       data-toggle="tab">Groep toevoegen </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" data-toggle="modal" data-target="#productModaladd"
                                       href="#productModaladd" data-toggle="tab">Oefening toevoegen
                                    </a>
                                </li>
                                @if(\Illuminate\Support\Facades\Auth::user()->role=="admin")
                                    <li class="dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                    class="fa fa-search"></i> Seach By Company <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">

                                            @foreach($companies as $company)
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.exercisesViewRqst',$company->user_id)}}">{{$company->company_name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
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
                @endif


            </div>


        </div>
        <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.addExerciseGroupRqst',Request::segment(3))}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title">Groep toevoegen</h5>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="productModaladd" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.addExerciseRqst',$user->id)}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title">Oefening toevoegen</h5>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="videoname">Exercise name</label>
                                        {{--                                    <input type="hidden" name="group_id" value="{{$gid}}"/>--}}
                                        <input type="text" name="productname" class="form-control"
                                               aria-describedby="grpnameHelp"
                                               placeholder="Enter product name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="imagefile">Exercise Image file</label>
                                        <input type="file" name="imagefile" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Exercise Price</label>
                                        <input type='number' step='0.01' value='0.00' type="price" name="price"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tax">Exercise Tax</label>
                                        <input type='number' step='0.01' value='0.00' type="tax" name="tax"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tax">Priority</label>
                                        <input type='number' step='1' value='1' type="tax" name="group_priority"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tax">Select Group</label>
                                        <?php
                                        $groups = \App\ProductGroups::select('id', 'name')->where('group_type', 'exercises')
                                            ->where('user_id', $user->id)
                                            ->get();
                                        $groups_html = '<select multiple data-plugin-selectTwo class="form-control" name="group_id[]" required>';
                                        $groups_html .= '<option value="">Select Group</option>';
                                        foreach ($groups as $group) {
                                            $groups_html .= '<option value="' . $group->id . '">' . $group->name . '</option>';
                                        }
                                        echo $groups_html .= '</select>';
                                        ?>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="col-md-6 border">
                                            <label for="goal">Goal</label>
                                            <hr>
                                            <?php
                                            $goals = \App\ExerciseGoal::where('user_id', $user->id)->get();
                                            $goooals_html = "";
                                            foreach ($goals as $goal) {
                                                $goooals_html .= '<label style="width: 100%"><input type="checkbox" name="goal[]" value="' . $goal->id . '"> ' . $goal->goalname . '</label>';
                                            }
                                            echo $goooals_html;
                                            ?>

                                        </div>

                                        <div class="col-md-6 border" style="min-height: 211px;">
                                            <label for="traininglevel">Trainingsniveau</label>
                                            <hr>
                                            <?php
                                            $traininglevels = \App\ExerciseTrainingLevel::where('user_id', $user->id)->get();
                                            $traininglevels_html = "";
                                            foreach ($traininglevels as $traininglevel) {
                                                $traininglevels_html .= '<label style="width: 100%"><input type="checkbox" name="traininglevel[]" value="' . $traininglevel->id . '"> ' . $traininglevel->traininglevel . '</label>';
                                            }
                                            echo $traininglevels_html;
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6 border" style="min-height: 291px;">
                                            <label for="musclegroup">Accent Muscle Group</label>
                                            <hr>
                                            <?php
                                            $traininglevelsmg = \App\ExerciseAccentMuscleGroup::where('user_id', $user->id)->get();
                                            $traininglevelsmg_html = "";
                                            foreach ($traininglevelsmg as $traininglevelsm) {
                                                $traininglevelsmg_html .= '<label style="width: 100%"><input type="checkbox" name="musclegroup[]" value="' . $traininglevelsm->id . '"> ' . $traininglevelsm->musclegroupname . '</label>';
                                            }
                                            echo $traininglevelsmg_html;
                                            ?>

                                        </div>
                                        <div class="col-md-6 border">
                                            <label for="material">Materiaal</label>
                                            <hr>
                                            <?php
                                            $materials = \App\ExerciseMaterial::where('user_id', $user->id)->get();
                                            $materials_html = "";
                                            foreach ($materials as $material) {
                                                $materials_html .= '<label style="width: 100%"><input type="checkbox" name="material[]" value="' . $material->id . '"> ' . $material->materiallevel . '</label>';
                                            }
                                            echo $materials_html;
                                            ?>

                                        </div>


                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                            <button type="submit" class="btn btn-info">Opslaan</button>
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
    <script type="text/javascript"
            src="{{asset('/admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


    <script>
        $(function () {
            $( "#startdate" ).datepicker({ format: 'dd-mm-yyyy'})
            $( "#enddate" ).datepicker({ format: 'dd-mm-yyyy'})

            var user_id = '{{$user->id}}';
//            loaduserbar(user_id);


//            loadDropable(user_id,null);

            searchbarKeyup(user_id);



        })




    </script>

@endsection
@section('scripts')
@endsection