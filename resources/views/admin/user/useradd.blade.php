@extends('layouts.admin_layout')
@section('title','Dashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/css/parsley.css') }}">
<style>
    .social {
        padding: 5px;
        font-size: 12px;
        width: 24px;
        text-align: center;
        text-decoration: none;
        margin: 5px 2px;
    }
    .social:hover {
        opacity: 0.7;
    }
    .facebook {
        background: #3B5998;
        color: white;
    }
    .twitter {
        background: #55ACEE;
        color: white;
    }
    .google {
        background: #dd4b39;
        color: white;
    }
    .linkedin {
        background: #007bb5;
        color: white;
    }
    .tab-pane {
        margin-top: 30px
    }
    .container {
        position: relative;
        width: 100%;
        cursor: pointer;
    }
    .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }
    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }
    .container:hover .image {
        opacity: 0.3;
    }
    .container:hover .middle {
        opacity: 1;
    }
    .text {
        background-color: rgba(50, 50, 50, 0.1);
        color: white;
        font-size: 16px;
        padding: 16px 32px;
    }
    tr.success{
        text-align: right;
    }
    tr.success td.white{
        background: white !important;
        width: 10px !important;
        padding-top: .5em;
        padding-bottom: .5em;
    }
    tr.danger td.white{
        background: white !important;
        width: 10px !important;
        padding-top: .5em;
        padding-bottom: .5em;
    }
</style>
@endsection
@section('content')
<!-- Page header -->
<!-- /.page header -->
<!-- Main content -->
<section role="main" class="content-body">
<header class="page-header">
    <h2>User Profile</h2>
    <div class="right-wrapper text-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Pages</span></li>
            <li><span>User Profile</span></li>
        </ol>
        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">/ Add</li>
    </ol>
</section>
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <?php if (Session::has('success')) { ?>
                                <div class="alert bg-success">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">@lang('common.close')</span></button>
                                        <span class="text-semibold">{{ Session::get('success') }}</span>
                                    </div>
            <?php } ?>
                            <?php if (Session::has('error')) { ?>
                                <div class="alert bg-danger">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">@lang('common.close')</span></button>
                                        <span class="text-semibold">{{ Session::get('error') }}</span>
                                    </div>
                            <?php } ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Information</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <form name="profile_add_form" data-parsley-validate class="form-horizontal" action="{{ route('admin.useraddRoute') }}"
                              method="post">
                            {{method_field('PATCH')}} {{csrf_field()}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" value="" placeholder="ex. John Smith" required
                                           maxlength="100">
                                    <span class="help-block">
                                        <strong>{{ $errors->signup->first('name') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" value="" placeholder="ex. john_smith"
                                           required maxlength="50"> @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="form-control" id="copyright" value="" placeholder="ex. johnsmith@mail.com"
                                           required maxlength="100"> @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="copyright" value="" placeholder="****"
                                           required maxlength="100"> @if ($errors->has('passwordl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control" id="gender" required>
                                        <option value="" disabled selected>Select One</option>
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select> @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone" class="form-control" id="phone" value="" placeholder="ex. XXXXXXXXXXX"
                                           required maxlength="250"> @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                        <input  type="text" id="userBirthDay" name="birthday" value="" class="form-control" placeholder="dd.mm.yyyy">
                                        <div class="input-group-addon" >
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('iban') ? ' has-error' : '' }}">
                                <label for="iban" class="col-sm-2 control-label">IBAN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="iban" class="form-control" id="iban" value="" placeholder="ex. NL11ABCD1234567890"
                                           maxlength="250"> @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('iban') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('taal') ? ' has-error' : '' }}">
                                <label for="taal" class="col-sm-2 control-label">Taal</label>
                                <div class="col-sm-10">
                                    <input type="text" name="taal" class="form-control" id="taal" value="" placeholder="ex. Dutch"
                                           maxlength="250"> @if ($errors->has('taal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('taal') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('klant_sinds') ? ' has-error' : '' }}">
                                <label for="klant_sinds" class="col-sm-2 control-label">Klant Sinds</label>
                                <div class="col-sm-10">
                                    <div class="input-group date " data-date-format="dd-mm-yyyy">
                                        <input  type="text" id="klant_sinds" name="klant_sinds" value="" class="form-control" placeholder="dd.mm.yyyy">
                                        <div class="input-group-addon" >
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('klant_sinds'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('klant_sinds') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control" id="address" value="" placeholder="ex. House 00, Road 00, New york, United states"
                                           required maxlength="250"> @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                <label for="about" class="col-sm-2 control-label">About Me</label>
                                <div class="col-sm-10">
                                    <textarea name="about" class="form-control" id="about" rows="6" placeholder="ex. about me" required maxlength="500"></textarea>                                 @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-sm-2 control-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="role" id="edit-role">
                                        <option selected disabled>Select One</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="company">Company</option>
                                    </select>
                                    <span class="text-danger role-error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="activation_status" class="col-sm-2 control-label">Activation Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="activation_status" id="edit-activation-status">
                                        <option selected disabled>Select One</option>
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                    <span class="text-danger activation-status-error"></span>
                                </div>
                            </div>
                            <div id="add-reason-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">
                                                <span class="fa-stack fa-sm">
                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                    <i class="fa fa-edit fa-stack-1x"></i>
                                                </span> Add Reason
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-sm-12">Block Reason</label>
                                                <textarea name="blockreason" class="form-control col-sm-12" id="block_reason" rows="6" placeholder="ex. payment issues" maxlength="500"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                            <button type="button" id="btnReason" class="btn btn-info btn-flat update-button">Add Reason</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.add reason modal -->
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info btn-flat">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Visits tabs -->
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->
<!-- /.main content -->
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('public/admin/js/parsley.min.js') }}"></script>
<script type="text/javascript">
            $(function() {
            $('#edit-activation-status').change(function () {
            if ($(this).val() == "0") {
            $('#add-reason-modal').modal('show');
            }
            });
            $('#btnReason').click(function() {
            $('#add-reason-modal').modal('hide');
            });
            //add-amount
            $('.add-amount').click(function() {

            $('#add-amount-modal').modal('show');
            });
            // avatar modal
            $('.avatar-modal').click(function(){
            $('#avatar-modal').modal('show');
            });
            //passowrd modal
            $('.password-modal').click(function(){
            $('#password-modal').modal('show');
            });
            // $('.input-group.date').datepicker({format: "DD-MM-YYYY"});
            // });
            $.datepicker.setDefaults({
                dateFormat: 'dd-mm-yyyy'
            });
            $('.input-group.date').datepicker({dateFormat: "dd-mm-yyyy"});
            });
</script>
@endsection
