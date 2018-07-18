@extends('layouts.admin_layout')
@section('title', 'Profile')
@section('style')
<link rel = "stylesheet" href = "{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css')}}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')}}"/>
<style>
	.col-lg-12 ul.simple-card-list{ width: 100%; float: left; display: block; }
	.col-lg-12 ul.simple-card-list li{ width:23%; float: left; margin: 0 1%; }
	.row .col-xl-8{ flex: 0 0 74.666667%; max-width: 74.666667%; }
	.user-info-block li span{ float: right; text-transform: capitalize; }
</style>
@endsection
@section('content')
<section role = "main" class = "content-body" > <header class="page-header">
    <header class="page-header">
            <h2>Company</h2>
            @include('admin.includes.header')
    </header>

    <div class="right-wrapper">
        <a class="sidebar-right-toggle" data-open="sidebar-right" style="float:right;">
            <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
        <div class="header-right" style="float: right;">
            <div class="uw-saldo-value" style="">
                <span>Uw saldo 5.00</span>
            </div>
            <span class="separator"></span>
            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img
                            src="http://webathletic.codedrill.xyz/public/admin_files/img/!logged-user.jpg"
                            alt="Joseph Doe"
                            class="rounded-circle"
                            data-lock-picture="http://webathletic.codedrill.xyz/public/admin_files/img/!logged-user.jpg"/>
                    </figure>
                    <div
                        class="profile-info"
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
                            <a role="menuitem" tabindex="-1" href="{{ url('/profile') }}">
                                <i class="fa fa-user"></i>
                                My Profile</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true">
                                <i class="fa fa-lock"></i>
                                Lock Screen</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ url('/signout') }}">
                                <i class="fa fa-power-off"></i>
                                Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="notifications">
                <li>
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="badge">4</span>
                    </a>
                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="float-right badge badge-default">230</span>
                            Messages
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img
                                                src="http://webathletic.codedrill.xyz/public/admin_files/img/!sample-user.jpg"
                                                alt="Joseph Doe Junior"
                                                class="rounded-circle"/>
                                        </figure>
                                        <span class="title">Joseph Doe</span>
                                        <span class="message">Lorem ipsum dolor sit.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img
                                                src="http://webathletic.codedrill.xyz/public/admin_files/img/!sample-user.jpg"
                                                alt="Joseph Junior"
                                                class="rounded-circle"/>
                                        </figure>
                                        <span class="title">Joseph Junior</span>
                                        <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget
                                            risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac
                                            tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit
                                            faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque
                                            non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim
                                            sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet
                                            faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo
                                            eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec
                                            facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida
                                            dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra.
                                            Vestibulum egestas nisi quis elementum elementum.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img
                                                src="http://webathletic.codedrill.xyz/public/admin_files/img/!sample-user.jpg"
                                                alt="Joe Junior"
                                                class="rounded-circle"/>
                                        </figure>
                                        <span class="title">Joe Junior</span>
                                        <span class="message">Lorem ipsum dolor sit.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img
                                                src="http://webathletic.codedrill.xyz/public/admin_files/img/!sample-user.jpg"
                                                alt="Joseph Junior"
                                                class="rounded-circle"/>
                                        </figure>
                                        <span class="title">Joseph Junior</span>
                                        <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus
                                            lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget
                                            convallis diam.</span>
                                    </a>
                                </li>
                            </ul>
                            <hr/>
                            <div class="text-right">
                                <a href="#" class="view-more">View All</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="badge">3</span>
                    </a>
                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="float-right badge badge-default">3</span>
                            Alerts
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-thumbs-down bg-danger text-light"></i>
                                        </div>
                                        <span class="title">Server is Down!</span>
                                        <span class="message">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-lock bg-warning text-light"></i>
                                        </div>
                                        <span class="title">User Locked</span>
                                        <span class="message">15 minutes ago</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-signal bg-success text-light"></i>
                                        </div>
                                        <span class="title">Connection Restaured</span>
                                        <span class="message">10/10/2017</span>
                                    </a>
                                </li>
                            </ul>
                            <hr/>
                            <div class="text-right">
                                <a href="#" class="view-more">View All</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="header-icons-block">
                <a class="home-button" href="{{ url('/admin/dashboard') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <a class="menu-button" href="">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
                <a class="header-country-img">
                    <img
                        src="http://webathletic.codedrill.xyz/public/images/asterdam.png"
                        alt="Joseph Junior"/></a>
            </div>
        </div>
    </div>
</header>
<section class="content-header">
    <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
        <li>
            <a href="{{ url('/admin/dashboard') }}" style="text-decoration: none;color: #5c5757;">
                <i class="fa fa-home active"></i>
                Company</a>
        </li>
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
        <div class="col-lg-12 col-xl-12">
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
                <li class="primary">
                    <h3>16</h3>
                    <p class="text-light">Nullam quris ris.</p>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">
            <section class="card">
                <div class="card-body">
                    <div class="thumb-info mb-3" style="position: relative;">
                        <i
                            class="fa fa-edit fa-stack-1x icon-edit"
                            style="text-align: right;color: white;font-size: 20px;"
                            data-id="1"
                            data-block_id="avatar"></i>
                        <img
                            src="http://webathletic.codedrill.xyz/public/profile_images/1_1036243932.jpg"
                            class="rounded img-fluid"
                            id="avatar"
                            alt="Misty Streich updated">
                            <div class="thumb-info-title">
                                <span class="thumb-info-inner">Misty Streich updated</span>
                                <span class="thumb-info-type">CEO</span>
                            </div>
                        </div>
                        <div class="widget-toggle-expand mb-3">
                            <div class="widget-header">
                                <h5 class="mb-2">Profile Completion</h5>
                                <div class="widget-toggle">+</div>
                            </div>
                            <!-- <div class="widget-content-collapsed"> <div class="progress progress-xs
                            light"> <div class="progress-bar" role="progressbar" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100" style="width: 60%;"> 60% </div> </div>
                            </div> -->
                            <div class="widget-content-collapsed">
                                <div class="progress progress-xl light" style="height: 12px;font-size: 10px;">
                                    <div
                                        class="progress-bar progress-bar-success"
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        style="width: 100%;">
                                        100%
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-expanded">
                                <ul class="simple-todo-list mt-3 user-info-block">
                                    <li class="completed">
                                        <strong>Email</strong>
                                        <span>ulrichquatess@gmail.com</span>
                                    </li>
                                    <li class="completed">
                                        <strong>Age</strong>
                                        <span>
                                            Less then a year
                                        </span>
                                    </li>
                                    <li class="completed">
                                        <strong>Geslacht</strong>
                                        <span>
                                            Man
                                        </span>
                                    </li>
                                    <li class="completed">
                                        <strong>Telefoonnummer</strong>
                                        <span>9876543210</span>
                                    </li>
                                    <li class="completed">
                                        <strong>Role</strong>
                                        <span>user</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr class="dotted short">
                            <h5 class="mb-2 mt-3">About</h5>
                            <p class="text-2">hiii e</p>
                            <div class="clearfix">
                                <a class="text-uppercase text-muted float-right" href="#">(View All)</a>
                            </div>
                            <hr class="dotted short">
                                <div class="social-icons-list">
                                    <a
                                        rel="tooltip"
                                        data-placement="bottom"
                                        target="_blank"
                                        href="http://www.facebook.com"
                                        data-original-title="Facebook">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a
                                        rel="tooltip"
                                        data-placement="bottom"
                                        href="http://www.twitter.com"
                                        data-original-title="Twitter">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a
                                        rel="tooltip"
                                        data-placement="bottom"
                                        href="http://www.linkedin.com"
                                        data-original-title="Linkedin">
                                        <i class="fa fa-linkedin"></i>
                                        <span>Linkedin</span>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-xl-8">
                        <div class="tabs">
                            <ul class="nav nav-tabs tabs-primary" style="clear:both;">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#overview" data-toggle="tab">Company Information</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#Bezoeken" data-toggle="tab">Bezoeken</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Transacties" data-toggle="tab">Transacties</a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div id="overview" class="tab-pane active col-sm-12">
                                <form name="profile_add_form" data-parsley-validate class="form-horizontal" action="{{ url('/profile/update') }}" method="post">
                                    {{method_field('PATCH')}} {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}" >
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="ex. John Smith" required
                                                        maxlength="100">
                                                    <span class="help-block">
                                                        <strong>{{ $errors->signup->first('name') }}</strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                <label for="username" class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" placeholder="ex. john_smith"
                                                        required maxlength="50"> @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="email" class="form-control" id="copyright" value="{{ $user->email }}" placeholder="ex. johnsmith@mail.com"
                                                        required maxlength="100"> @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('Bedrijfsnaam') ? ' has-error' : '' }}">
                                                <label for="Bedrijfsnaam" class="col-sm-2 control-label">Bedrijfsnaam</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="Bedrijfsnaam" class="form-control" id="Bedrijfsnaam" value="{{ $user->Bedrijfsnaam }}" placeholder="ex. Bedrijfsnaam"
                                                        required maxlength="100"> @if ($errors->has('Bedrijfsnaam'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Bedrijfsnaam') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('Soort') ? ' has-error' : '' }}">
                                                <label for="email" class="col-sm-2 control-label">Soort</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="Soort" class="form-control" id="Soort" value="{{ $user->Soort }}" placeholder="ex. Soort"
                                                        required maxlength="100"> @if ($errors->has('Soort'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Soort') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-12">
                                                    <select name="gender" class="form-control" id="gender" required>
                                                        <option value="" disabled selected>Select One</option>
                                                        <option value="m" 
                                                        <?php if(  $user->gender == "m" ){ echo "selected"; } ?>
                                                        >Male</option>
                                                        <option value="f"
                                                        <?php if( $user->gender == "f" ){ echo "selected"; } ?>
                                                        >Female</option>
                                                    </select> @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" placeholder="ex. XXXXXXXXXXX"
                                                        required maxlength="250"> @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="Contactpersoon" class="col-sm-2 control-label">Contactpersoon</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="Contactpersoon" class="form-control" id="Contactpersoon" value="{{ $user->Contactpersoon }}" placeholder="ex. Contactpersoon"
                                                        required maxlength="250"> @if ($errors->has('Contactpersoon'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Contactpersoon') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                                <label for="birthday" class="col-sm-2 control-label">Birthday</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                        <input  type="text" id="userBirthDay" name="birthday" value="<?php echo date("d/m/Y", strtotime($user->birthday)); ?>" class="form-control" placeholder="dd.mm.yyyy">
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
                                                <div class="col-sm-12">
                                                    <input type="text" name="iban" class="form-control" id="iban" value="{{ $user->iban }}" placeholder="ex. NL11ABCD1234567890"
                                                        maxlength="250"> @if ($errors->has('twitter'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('iban') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('taal') ? ' has-error' : '' }}">
                                                <label for="taal" class="col-sm-2 control-label">Taal</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="taal" class="form-control" id="taal" value="{{ $user->taal }}" placeholder="ex. Dutch"
                                                        maxlength="250"> @if ($errors->has('taal'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('taal') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group{{ $errors->has('klant_sinds') ? ' has-error' : '' }}">
                                                <label for="klant_sinds" class="col-sm-2 control-label">Klant Sinds</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group date " data-date-format="dd.mm.yyyy">
                                                        <input  type="text" id="klant_sinds" name="klant_sinds" value="<?php echo date("d/m/Y", strtotime($user->klant_sinds)); ?>" class="form-control" placeholder="dd.mm.yyyy">
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
                                            <div class="form-group{{ $errors->has('cashback') ? ' has-error' : '' }}">
                                                <label for="cashback" class="col-sm-2 control-label">Cashback</label>
                                                <div class="col-sm-12">
                                                    <select name="cashback" class="form-control" id="cashback" required>
                                                        <option value="" disabled selected>Select One</option>
                                                        <option value="active" 
                                                        <?php if(  $user->cashback == "active" ){ echo "selected"; } ?>
                                                        >Active</option>
                                                        <option value="inactive"
                                                        <?php if( $user->cashback == "inactive" ){ echo "selected"; } ?>
                                                        >Inactive</option>
                                                    </select> @if ($errors->has('cashback'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cashback') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label for="address" class="col-sm-2 control-label">Address</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}" placeholder="ex. House 00, Road 00, New york, United states"
                                                        required maxlength="250"> @if ($errors->has('address'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                                <label for="about" class="col-sm-2 control-label">About Me</label>
                                                <div class="col-sm-12">
                                                    <textarea name="about" class="form-control" id="about" rows="6" placeholder="ex. about me" required maxlength="500">{{ $user->about }}</textarea>
                                                    @if ($errors->has('about'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('about') }}</strong>
                                                    </span> @endif
                                                </div>
                                            </div>
                                            <!-- /.add reason modal -->
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-12">
                                                    <button type="submit" class="btn btn-info btn-flat">@lang('common.update')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- edit panel here -->
                        <div id="Bezoeken" class="tab-pane"></div>
                        <!-- edit end panel here -->
                        <!-- edit panel here -->
                        <div id="Transacties" class="tab-pane"></div>
                        <!-- edit end panel here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end: page -->
    </section>
    @endsection @section('site_scripts')
    <!-- Specific Page Vendor -->
    <script src="{{ asset('admin_files/vendor/autosize/autosize.js')}}"></script>
    <script
        src="{{ asset('admin_files/vendor/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{ asset('admin_files/vendor/select2/js/select2.js')}}"></script>
    <script src="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.js')}}"></script>
    <script
        src="{{ asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $("#userBirthDay").datepicker({dateFormat: "dd/mm/yy"});
            $("#klant_sinds").datepicker({dateFormat: "dd/mm/yy"});
            $("#profile_edit_form").validate({
                rules: {
                    first_name: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    },
                    surname: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    },
                    email: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    },
                    // phone: { 	required: true, 	normalizer: function(value) { 		return
                    // $.trim(value); 	} }, gender: { 	required: true, 	normalizer: function(value)
                    // { 		return $.trim(value); 	} }, birthday: { 	required: true, 	normalizer:
                    // function(value) { 		return $.trim(value); 	} }, iban: { 	required: true,
                    // normalizer: function(value) { 		return $.trim(value); 	} }, taal: {
                    // required: true, 	normalizer: function(value) { 		return $.trim(value); 	} },
                    // klant_sinds: { 	required: true, 	normalizer: function(value) { 		return
                    // $.trim(value); 	} }, address: { 	required: true, 	normalizer: function(value)
                    // { 		return $.trim(value); 	} }, about: { 	required: true, 	normalizer:
                    // function(value) { 		return $.trim(value); 	} }, role: { 	required: true,
                    // normalizer: function(value) { 		return $.trim(value); 	} },
                    // activation_status: { 	required: true, 	normalizer: function(value) { 		return
                    // $.trim(value); 	} }
                }
            });
        });
    </script>
    @endsection