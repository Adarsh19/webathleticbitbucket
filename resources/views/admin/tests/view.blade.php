@extends('layouts.admin_layout')

@section('title','Companies')

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
                            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Company</a></li>
                        </ol>
                    </section>
                    <!-- start: page -->
                    <input readonly type="file" id="fi" style="display: none;">
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
                        <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">
                            <section class="card">
                                <div class="card-body">
                                    <div class="thumb-info mb-3" style="position: relative;">
                                    <i class="fa fa-edit fa-stack-1x icon-edit" style="text-align: right;color: white;font-size: 20px;" data-id="{{$company->id}}" data-block_id="avatar"></i>
                                    @if(!empty($company->avatar))
                                        <img src="{{ asset('profile_images/')}}/{{$company->avatar}}" class="rounded img-fluid" id="avatar" alt="{{$company->first_name .' '. $company->surname}}">
                                    @else
                                        <img src="{{ asset('admin_files/img/!logged-user.jpg')}}" class="rounded img-fluid" id="avatar" alt="image">

                                    @endif
                                        <div class="thumb-info-title">
                                            <span class="thumb-info-inner">{{ $company->first_name }} {{ $company->surname }}</span>
                                            <span class="thumb-info-type">CEO</span>
                                        </div>
                                    </div>

                                    <div class="widget-toggle-expand mb-3">

                                        <div class="widget-content-expanded">
                                            <ul class="simple-todo-list mt-3 user-info-block">
                                                <li class="completed"><strong>Email</strong> <span>{{$company->email}}</span></li>
                                                <li class="completed"><strong>Geslacht</strong> <span>
                                                {{ ($company->gender == 'm')?'Man':'Vrouw'}}
                                                 </span></li>
                                                <li class="completed"><strong>Telefoonnummer</strong> <span>9876543210</span></li>
                                                <li class="completed"><strong>Role</strong> <span>{{$company->role}}</span></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <hr class="dotted short">

                                    <h5 class="mb-2 mt-3">About</h5>
                                    <p class="text-2">{{ $company->about }}</p>
                                    <div class="clearfix">
                                        <a class="text-uppercase text-muted float-right" href="#">(View All)</a>
                                    </div>

                                    <hr class="dotted short">

                                    <div class="social-icons-list">
                                        <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                                        <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                                    </div>

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
                                        <a class="nav-link" href="#overview" data-toggle="tab">Company Information</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="overview" class="tab-pane active">
                                        <form id="profile_edit_form" data-parsley-validate class="form-horizontal" action="/admin/company/update/{{$company->id}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                   <label for="name">Bedrijfsnaam</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input readonly  type="text" name="company_name" class="form-control" id="name" value="{{$company->company_name}}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Soort</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-building"></i>
                                                        </span>
                                                        <input readonly type="text" name="Soort" class="form-control" id="surname" value="{{$company->Soort}}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="email" class="control-label">Address</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input readonly type="text" name="address" class="form-control" id="autocomplete" onFocus="geolocate()" value="{{$company->address}}"  placeholder="ex. House 00, Road 00, New york, United states">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Zipcode</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                        <input readonly type="text" name="zipcode" class="form-control" id="postal_code" value="{{ $company->zipcode }}">
                                                        <span class="text-danger zipcoder"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">City</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input readonly type="text" name="City" class="form-control" id="locality" value="{{$company->City}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">State</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                                    <input readonly type="text" name="state" class="form-control" id="administrative_area_level_1" value="">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Contact Persoon</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <input readonly type="text" name="Contactpersoon" class="form-control" id="surname" value="{{ $company->Contactpersoon }}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Telefoon Algemeen</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                    <input readonly type="text" name="phone_main" class="form-control" id="copyright" value="{{$company->phone_main}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Telefoon ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                    <input readonly type="text" name="phone_contact" class="form-control" id="copyright" value="{{ $company->phone_contact}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Telefoon  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                        <input readonly type="text" name="phone_administration" class="form-control" id="surname" value="{{ $company->phone_administration }}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Email Algemeen</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                    <input readonly type="text" name="email_main" class="form-control" id="copyright" value="{{$company->email_main}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Email ContactPersoon</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                    <input readonly type="text" name="email_contact" class="form-control" id="copyright" value="{{ $company->email_contact}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Email  Administratie</label>
                                                   <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>
                                                        </span>
                                                        <input readonly type="text" name="email_administration" class="form-control" id="surname" value="{{ $company->email_administration }}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">KVK nummer</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input readonly type="text" name="kvk_number" class="form-control" id="copyright" value="{{$company->kvk_number}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">BTW nummer</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </span>
                                                    <input readonly type="text" name="btw_number" class="form-control" id="copyright" value="{{ $company->btw_number}}">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Primaire taal</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-language"></i>
                                                        </span>
                                                        <input readonly type="text" name="primary_language" class="form-control" id="surname" value="{{ $company->primary_language }}">
                                                        <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Staat cashback toe?</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                        <select name="allow_cashback" class="form-control" id="allow_cashback" disabled>
                                                            <option value="0" disabled selected>Select One</option>
                                                            <option value="1" {{ (($company->allow_cashback == 1)?'selected=true':'') }}>Ja</option>
                                                            <option value="2" {{ (($company->allow_cashback == 2)?'selected=true':'') }}>Nee</option>
                                                        </select>
                                                        <span class="text-danger allow-cashback-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="email" class="control-label">Code</label>
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class=""></i>
                                                        </span>
                                                    <input readonly type="text" name="" class="form-control" id="copyright" value="">
                                                    <span class="text-danger role-error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                   <label for="surname" class="control-label">Visite location ?</label>
                                                   <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-mars"></i>
                                                        </span>
                                                         <select name="visit_location" class="form-control" id="visit_location" disabled>
                                                            <option value="0" disabled selected>Select One</option>
                                                            <option value="1" {{ (($company->visit_location == 1)?'selected=true':'') }}>Ja</option>
                                                            <option value="2" {{ (($company->visit_location == 2)?'selected=true':'') }}>Nee</option>
                                                        </select>
                                                        <span class="text-danger allow-cashback-error"></span>
                                                    </div>
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

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: page -->
</section>
@endsection