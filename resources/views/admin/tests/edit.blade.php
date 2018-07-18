@extends('layouts.admin_layout')

@section('title','Tests')

@section('style')

<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css')}}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')}}" />
@endsection

@section('content')

<section role="main" class="content-body">

    <header class="page-header">
        @include('admin.includes.header')
    </header>

    <section class="content-header">
        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Test</a></li>
        </ol>
    </section>
    <!-- start: page -->
    <input type="file" id="fi" style="display: none;">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <section class="card col-md-12">
            <div class="card-body">
                        
                <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="{{route('admin.tests.update',$test->id)}}" method="post">
                {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$test->id}}">
                    <div class="form-row">
                        @if(isAdmin())
                        <div class="form-group col-md-6">
                           <label for="name">Name</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="test_name" class="form-control" id="test_name" value="{{$test->test_name}}">
                            </div>
                        </div>
                         <div class="form-group col-md-6 test_type">
                           <label for="name">Company</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="company_id" class="form-control">
                                    <option value="0">Predefined Test</option>
                                    @foreach($companies as $c)
                                        <option value="{{$c->id}}" {{old('company_id')?(e(old('company_id'))==$c->id?'selected':''):($test->test_name==$c->id?'selected':'')}}
                                        >{{$c->company_name}}</option>
                                    @endforeach
                                </select>
                           
                            </div>
                        </div>
                        @else
                        <div class="form-group col-md-6">
                           <label for="name">Name</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="test_name" class="form-control" id="test_name" value="{{$test->test_name}}">
                            </div>
                        </div>
                       @endif
                        <div class="form-group col-md-12">
                           <label for="surname" class="control-label">Description</label>
                           <div class="input-group">
                                <textarea name="description" class="form-control" id="description" >{{$test->description}}</textarea>
                             </div>
                        </div>
                        <div class="form-group col-md-12">
                           <label for="name">Status</label>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $test->status?'selected':'' }}>Active</option>
                                    <option value="0" {{ $test->status?'':'selected' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div><br><br>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                           <br><br> <b>Questions</b>
                                <hr>
                           <br>
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="mt-repeater col-md-12 ">
                            <div class="tbheader">
                                <div class="row ">
                                    <div class="col-md-6"><label>Question</label></div>
                                    <div class="col-md-4"><label>Type</label></div>
                                    <div class="col-md-1"><label>Graph</label></div>
                                    <div class="col-md-1"><a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add hide">
                                                <i class="fa fa-plus"></i> </a></div>
                                </div>
                                <hr>
                            </div>
                            <div data-repeater-list="questions" class="item-stripe">
                                <div data-repeater-item class="row item-stripe-child"> 
                                    <div class="col-sm-6">
                                        <div class="form-group form-md-line-input" style="padding:0px;">
                                            <div class="col-md-12" style="padding:0px;">
                                                <input type="hidden" name="question_id" value="0">
                                                <input type="text" name="question" rows="1" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group form-md-line-input">
                                        <select name="type" class="form-control">
                                            <option value="text">Text Input</option>
                                            <option value="date">Datepicker</option>
                                            <option value="file">File Uploader</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 form-group form-md-line-input">
                                           <input type="checkbox" name="show_graph" value="1">
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="hidden" name="id" value="0">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger" style="padding: 2px 12px;">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info btn-flat pull-right">update</button>
                        </div>
                    </div>
                </form>

            </div>                                   
        </section>
    </div>                    <!-- end: page -->
</section>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('admin_files/js/jquery.repeater.js')}}"></script>

<script type="text/javascript">
var $repeater = $('.mt-repeater').repeater({ defaultValues: {
      'show_graph': ['1']
    }});
var appenddata=[];
@foreach($test->questions as $ques)
    var obj;
    obj = {
        'id': "{{$ques->id}}",
        'question':"{{$ques->question}}",
        'type': "{{$ques->type}}",
        'show_graph': "{{$ques->show_graph}}"
    };
    appenddata.push(obj);

@endforeach
$repeater.setList(appenddata);
</script>
@endsection