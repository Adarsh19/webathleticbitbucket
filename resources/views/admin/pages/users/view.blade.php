@php
$incr = 0;
if(isset($user->avatar) && !empty($user->avatar)) $incr +=35;
if(isset($user->first_name) && !empty($user->first_name)) $incr+=5;
if(isset($user->surname) && !empty($user->surname)) $incr+=5;
if(isset($user->email) && !empty($user->email)) $incr+=5;
if(isset($user->gender) && !empty($user->gender)) $incr+=5;
if(isset($user->phone) && !empty($user->phone)) $incr+=5;
if(isset($user->birthday) && !empty($user->birthday)) $incr+=5;
if(isset($user->iban) && !empty($user->iban)) $incr+=5;
if(isset($user->taal) && !empty($user->taal)) $incr+=5;
if(isset($user->klant_sinds) && !empty($user->klant_sinds)) $incr+=5;
if(isset($user->address) && !empty($user->address)) $incr+=5;
if(isset($user->about) && !empty($user->about)) $incr+=5;
if(isset($user->role) && !empty($user->role)) $incr+=5;
if(isset($user->activation_status) && !empty($user->activation_status)) $incr+=5;
@endphp
@extends('layouts.admin_layout')


@section('title','Users')

@section('style')

<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css')}}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')}}" />
<style>
    .top-tabs ul.simple-card-list{ width: 100%; float: left; display: block; }
    .top-tabs ul.simple-card-list li{ width:31.3%; float: left; margin: 0 1%; }
    .user-info-block li span{ float: right; text-transform: capitalize; }
</style>
@endsection

@section('content')

<section role="main" class="content-body">

                    <header class="page-header">
                        @include('admin.includes.header')
                    </header>

                    <section class="content-header">
                            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Leden</a></li>
                            </ol>
                    </section>
                    <!-- start: page -->
                    <input type="file" id="fi" style="display: none;">
                    <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">
                            <section class="card">
                                <div class="card-body">
                                    <div class="thumb-info mb-3" style="position: relative;">
                                    <i class="fa fa-edit fa-stack-1x icon-edit" style="text-align: right;color: white;font-size: 20px;" data-id="{{$user->id}}" data-block_id="avatar"></i>
                                    @if(!empty($user->avatar))
                                        <img src="{{ asset('profile_images/')}}/{{$user->avatar}}" class="rounded img-fluid" id="avatar" alt="{{$user->first_name .' '. $user->surname}}">
                                    @else
                                        <img src="{{ asset('admin_files/img/!logged-user.jpg')}}" class="rounded img-fluid" id="avatar" alt="image">

                                    @endif
                                        <div class="thumb-info-title">
                                            <span class="thumb-info-inner">{{ $user->first_name }} {{ $user->surname }}</span>
                                            <span class="thumb-info-type">CEO</span>
                                        </div>
                                    </div>

                                    <div class="widget-toggle-expand mb-3">
                                        <div class="widget-header">
                                            <h5 class="mb-2">Profile Completion</h5>
                                            <div class="widget-toggle">+</div>
                                        </div>

                                        <div class="widget-content-collapsed">
                                            @php
                                            $stripColor = 'success';
                                             if($incr >= 25 && $incr <= 75){
                                            $stripColor = 'primary';}  @endphp
                                            <div class="progress progress-xl light" style="height: 12px;font-size: 10px;">
                                            <?php if ($incr > 25) { ?>
                                            <div class="progress-bar progress-bar-{{ $stripColor }}" role="progressbar" aria-valuenow="{{ $incr }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $incr }}%;">
                                                {{ $incr }}%
                                                </div>
                                            <?php  } else { ?>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $incr }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $incr }}%;">
                                                </div>
                                                <span style="text-align: right;float: right;display: block;margin-top: -5px;margin-left: 73px;color: #363535;"> {{ $incr }}% </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                        <div class="widget-content-expanded">
                                            <ul class="simple-todo-list mt-3 user-info-block">
                                                <li class="completed"><strong>Email</strong> <span>{{$user->email}}</span></li>
                                                <li class="completed"><strong>Age</strong> <span>

                                                     @if($age = Helper::getAgeAttribute($user->age))
                                                     {{$age}} year old
                                                     @else
                                                      Less then a year
                                                     @endif

                                                </span></li>
                                                <li class="completed"><strong>Geslacht</strong> <span>
                                                {{ ($user->gender == 'm')?'Man':'Vrouw'}}
                                                 </span></li>
                                                <li class="completed"><strong>Telefoonnummer</strong> <span>9876543210</span></li>
                                                <li class="completed"><strong>Role</strong> <span>{{$user->role}}</span></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <hr class="dotted short">

                                    <h5 class="mb-2 mt-3">About</h5>
                                    <p class="text-2">{{ $user->about }}</p>
                                    <div class="clearfix">
                                        <a class="text-uppercase text-muted float-right" href="#">(View All)</a>
                                    </div>
                                    <!--
                                    <hr class="dotted short">

                                    <div class="social-icons-list">
                                        <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                                    </div>
                                    -->

                                </div>
                            </section>

                        </div>

                        <div class="col-xl-8 top-tabs">

                            <ul class="simple-card-list mb-3">
                                <li class="primary">
                                    <h3>488</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                                <li class="primary">
                                    <h3>€ 189,000.00</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                                <li class="primary">
                                    <h3>16</h3>
                                    <p class="text-light">Nullam quris ris.</p>
                                </li>
                            </ul>


                           <div class="tabs">

                                <ul class="nav nav-tabs tabs-primary" style="clear:both;">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#overview" data-toggle="tab">Update Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#Bezoeken" data-toggle="tab">Bezoeken</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#Transacties" data-toggle="tab">Transacties</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#coaching" data-toggle="tab">Coaching</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div id="overview" class="tab-pane active">
                                        <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="" method="post">
                                            {{method_field('PATCH')}} {{csrf_field()}}

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label for="name">Voornaam</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="first_name" class="form-control" id="name" value="{{$user->first_name}}" placeholder="ex. John Smith">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                   <label for="surname" class="control-label">Achternaam</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="surname" class="form-control" id="surname" value="{{$user->surname}}"  placeholder="ex. john_smith">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="email" class="control-label">Email</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </span>
                                                    <input type="text" name="email" class="form-control" id="copyright" value="{{$user->email}}" placeholder="ex. johnsmith@mail.com">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6" >
                                                    <label for="gender" >Geslacht</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                    <select name="gender" class="form-control" id="gender" >
                                                        <option value="" disabled selected>Select One</option>
                                                        <option value="m" {{ (($user->gender == 'm')?'selected=true':'') }}>Man</option>
                                                        <option value="f" {{ (($user->gender == 'f')?'selected=true':'') }}>Vrouw</option>
                                                    </select>
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label for="phone">Telefoonnummer</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    <input type="text" name="phone" class="form-control" id="phone" value="{{$user->phone}}" placeholder="ex. XXXXXXXXXXX">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="birthday" " >Geboortedatum</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    <input  type="text" id="userBirthDay" name="birthday" value="{{ $user->birthday }}" class="form-control"
                                                    data-plugin-datepicker data-plugin-options='{ "multidate": false }' placeholder="dd.mm.yyyy">
                                                        <span class="text-danger role-error"></span>
                                                        </div>
                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label for="iban" >IBAN</label>
                                                <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input type="text" name="iban" class="form-control" id="iban" value="{{ $user->iban }}" placeholder="ex. NL11ABCD1234567890" >
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6">
                                                   <label for="taal" >Taal</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-language"></i>
                                                        </span>
                                                    <input type="text" name="taal" class="form-control" id="taal" value="{{ $user->taal }}" placeholder="ex. Dutch">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label for="klant_sinds" >Klant Sinds</label>
                                                <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input  type="text" id="klant_sinds" name="klant_sinds" value="{{ $user->klant_sinds }}" data-plugin-datepicker data-plugin-options='{ "multidate": false }' class="form-control" placeholder="dd.mm.yyyy">
                                                        <span class="text-danger role-error"></span>
                                                        </div>
                                                </div>

                                               <div class="form-group col-md-6">
                                                    <label for="address" >Uw adres</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}" placeholder="ex. House 00, Road 00, New york, United states">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                <label for="about">Over mezelf</label>

                                                    <textarea name="about" class="form-control" id="about" rows="6" placeholder="ex. about me" >{{ $user->about  }}</textarea>
                                                    <span class="text-danger role-error"></span>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">

                                                <label for="role">Role</label>
                                                <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                    <select class="form-control" name="role" id="edit-role">
                                                        <option selected disabled>Select One</option>
                                                        <option value="admin" {{ (($user->role == 'admin')?'selected=true':'') }}>Admin</option>
                                                        <option value="user" {{ (($user->role == 'user')?'selected=true':'') }}>User</option>
                                                        <option value="company" {{ (($user->role == 'company')?'selected=true':'') }}>Company</option>
                                                    </select>
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6">
                                                  <label for="activation_status" >Activation Status</label>
                                                  <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                    <select class="form-control" name="activation_status" id="activation_status">
                                                            <option selected disabled>Select One</option>
                                                            <option value="1" {{ (($user->activation_status == '1')?'selected=true':'') }}>Active</option>
                                                            <option value="0" {{ (($user->activation_status == '0')?'selected=true':'') }}>Block</option>
                                                        </select>
                                                     <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info btn-flat">update</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                    <!-- edit panel here -->
                                    <div id="Bezoeken" class="tab-pane">

                                    </div>
                                    <!-- edit end panel here -->

                                    <!-- edit panel here -->
                                    <div id="Transacties" class="tab-pane">

                                    </div>
                                    <!-- edit end panel here -->


                                    <div class="tab-pane" id="coaching">



                                        <form  id="coaching_edit_form" data-parsley-validate class="form-horizontal"
                                               action="{{ route('admin.profileupdatecoachingRqst', $user->id) }}"
                                               method="post">

                                            {{csrf_field()}}


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">hoofddoel</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text"  name="hoofddoel" class="form-control" id="hoofddoel"
                                                               value="{{ $user->hoofddoel }}" placeholder="ex. John Smith" required>
                                                        <span class="text-danger hoofddoel-error"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="surname" class="control-label">Achternaam</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="letsels" class="form-control" id="letsels"
                                                               value="{{ $user->letsels }}" placeholder="Letsels"
                                                               required maxlength="50">
                                                        <span class="text-danger letsels-error"></span>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Chronischeziekte</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="chronischeziekte" class="form-control" id="copyright"
                                                               value="{{ $user->chronischeziekte }}" placeholder="Chronische Ziekte"
                                                               required maxlength="100">
                                                        <span class="text-danger chronischeziekte-error"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="surname" class="control-label">Noodcontact</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="noodcontact" class="form-control" id="copyright"
                                                               value="{{ $user->noodcontact }}" placeholder="Noodcontact"
                                                               required maxlength="100">
                                                        <span class="text-danger noodcontact-error"></span>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Meerinformatie</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="meerinformatie" class="form-control" id="copyright"
                                                               value="{{ $user->meerinformatie }}" placeholder="Meer informatie"
                                                               required maxlength="100">
                                                        <span class="text-danger meerinformatie-error"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="surname" class="control-label">Telefoonnummernood</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="telefoonnummernood" class="form-control" id="telefoonnummernood"
                                                               value="{{ $user->telefoonnummernood }}" placeholder="ex. XXXXXXXXXXX"
                                                               required maxlength="250">
                                                        <span class="text-danger telefoonnummernood-error"></span>
                                                    </div>

                                                </div>

                                            </div>



                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Checkin text accept</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="checkin_text_accept" class="form-control" id="checkin_text_accept"
                                                               value="{{ $user->checkin_text_accept }}" placeholder="Checkin_text_accept"
                                                               maxlength="250">
                                                        <span class="text-danger checkin_text_accept-error"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="surname" class="control-label">Checkin Text Warning</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="checkin_text_warning" class="form-control" id="checkin_text_warning"
                                                               value="{{ $user->checkin_text_warning }}" placeholder="Checkin_text_warning"
                                                               maxlength="250">
                                                        <span class="text-danger checkin_text_warning-error"></span>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Checkin Text Denied</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" name="checkin_text_denied" class="form-control" id="checkin_text_denied"
                                                               value="{{ $user->checkin_text_denied }}" placeholder="Checkin_text_denied"
                                                               maxlength="250">
                                                        <span class="text-danger checkin_text_denied-error"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="goal">Goal</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>

                                                        <?php
                                                        $goals=\App\ExerciseGoal::get();
                                                        $goooals_html='<select class="form-control"  name="goal">';
                                                        $goooals_html.='<option value="">Select one</option>';
                                                        foreach ($goals as $goal) {
                                                            $selected="";
                                                            if ($goal->id==$user->goal) {
                                                                $selected="selected";
                                                            }

                                                            $goooals_html.='<option '.$selected.' value="'.$goal->id.'">'.$goal->goalname.'</option>';
                                                        }
                                                        echo $goooals_html.='</select>';
                                                        ?>

                                                        <span class="text-danger goal-error"></span>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-row">


                                                <div class="form-group col-md-6">

                                                    <label for="traininglevel">Training Level</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>

                                                        <?php
                                                        $traininglevels=\App\ExerciseTrainingLevel::get();
                                                        $traininglevels_html='<select class="form-control" name="traininglevel">';
                                                        $traininglevels_html.='<option value="">Select one</option>';
                                                        foreach ($traininglevels as $traininglevel) {
                                                            $selected="";
                                                            if ($traininglevel->id==$user->traininglevel) {
                                                                $selected="selected";
                                                            }
                                                            $traininglevels_html.='<option '.$selected.' value="'.$traininglevel->id.'">'.$traininglevel->traininglevel.'</option>';
                                                        }
                                                        echo $traininglevels_html.='</select>';
                                                        ?>

                                                        <span class="text-danger taininglevel-error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="musclegroupname">Ascent Group</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>

                                                        <?php
                                                        $traininglevelsmg=\App\ExerciseAccentMuscleGroup::get();
                                                        $traininglevelsmg_html='<select class="form-control" name="musclegroupname">';
                                                        $traininglevelsmg_html.='<option value="">Select one</option>';
                                                        foreach ($traininglevelsmg as $traininglevelsm) {
                                                            $selected="";
                                                            if ($traininglevelsm->id==$user->musclegroupname) {
                                                                $selected="selected";
                                                            }
                                                            $traininglevelsmg_html.='<option  '.$selected.' value="'.$traininglevelsm->id.'">'.$traininglevelsm->musclegroupname.'</option>';
                                                        }
                                                        echo $traininglevelsmg_html.='</select>';
                                                        ?>

                                                        <span class="text-danger musclegroupname-error"></span>
                                                    </div>
                                                </div>

                                            </div>







                                            <div class="form-row">


                                                <div class="form-group col-md-6">

                                                    <label for="materiallevel">Material</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>

                                                        <?php
                                                        $materials=\App\ExerciseMaterial::get();
                                                        $materials_html='<select class="form-control" name="materiallevel">';
                                                        $materials_html.='<option value="">Select one</option>';
                                                        foreach ($materials as $material) {
                                                            $selected="";
                                                            if ($material->id==$user->materiallevel) {
                                                                $selected="selected";
                                                            }
                                                            $materials_html.='<option '.$selected.' value="'.$material->id.'">'.$material->materiallevel.'</option>';
                                                        }
                                                        echo $materials_html.='</select>';
                                                        ?>

                                                        <span class="text-danger materiallevel-error"></span>
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- add reason modal -->
                                            <!-- /.add reason modal -->
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    {{--<button type="submit">save</button>--}}
                                                    <a href="#"
                                                       data-toggle="modal" data-target="#save-confirmation_userdetails"  class="btn btn-info btn-flat"  >Update</a>
                                                </div>
                                            </div>
                                        </form>



                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>


    <div id="save-confirmation_userdetails" class="modal modal-danger fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                        U past de voorkeuren van deze klant aan, wilt u deze voor altijd aanpassen ?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-outline" onclick="submitExercisesform()">Yes</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

    </div>



                    <!-- end: page -->
</section>


@endsection
@section('site_scripts')
     @include('admin.scripts.user_view_js')

    <script>
        function submitExercisesform(){


            $('#coaching_edit_form').submit();
            $('#save-confirmation_userdetails').modal('toggle');

        }
    </script>


     <script type="text/javascript">
         $(function () {
             $("#coaching_edit_form").validate({
             });
         });
     </script>

@endsection
