 <header>
        <nav class="navbar navbar-expand-lg navbar-black bg-black" @if($hasUI) style="background:#{{$company_data['ui']['header']}} !important;" @endif>
            <a class="navbar-brand" href="#" id="log">
            <!-- <img src="images/logo.png" width="200" alt=""> -->
                @if($is_company && $company_data['logo'] != "") <img src="{{url('/site_images')}}/{{$company_data['logo']}}"> @else <img src="{{url('/images')}}/logo.png"> @endif  
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    @if(!$is_company)

                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('methodsRoute') }}">Online Coaching</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="video.html">Video - Bibliotheek</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('service')}}">Diensten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/client')}}">Succesverhalen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                            </li>
                            @if(!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/signup')}}">Aanmelden</a>
                            </li>
                            @endif
                            @if(Auth::check() && Auth::User()->role_id == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/admin/dashboard')}}">Dashboard</a>
                            </li>
                            @endif
                            <li class="nav-item">
                            @if(!Auth::check())
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Inloggen</a>
                            @else
                                <a class="nav-link" href="{{url('/signout')}}">Afmelden</a>
                            @endif
                            </li>
                    @else

                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}/service">Diensten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}/client">Succesverhalen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}/contact">Contact</a>
                            </li>
                            @if(!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}/signup">Aanmelden</a>
                            </li>
                            @endif
                            @if(Auth::check() && Auth::User()->role_id == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/admin/dashboard')}}">Dashboard</a>
                            </li>
                            @endif
                            <li class="nav-item">
                            @if(!Auth::check())
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Inloggen</a>
                            @else
                                <a class="nav-link" href="{{url('org')}}/{{$company_data['slug']}}/signout">Afmelden</a>
                            @endif
                            </li>


                    @endif
                    
                </ul>
                <!-- <div class="form-inline my-1 my-lg-0">
                    <button class="btn btn-outline-warning my-2 my-sm-0" onclick="sideMenu('open');"><i class="fas fa-bars"></i></button>
                </div> -->
            </div>
        </nav>
       <div class="jumbotron jumbotron-fluid">
            <div class="jumbo-bg">
                <!-- <img src="images/home-img.png " alt=" "> -->
           @php Helper::renderSiteImage(2); @endphp
            </div>
            <div class="jumbo-body">
                <div class="title-container">
                    <p class="title opacity">HALL HET ECHTE RESULTAAT OP</p>
                    <div class="underline line-right"></div>

                    <p class="subtitle"><span class="opacity">web</span><span>A</span><span class="opacity">thletic</span></p>
                    <div class="underline"></div>
                </div>

                <div class="btn-container">
                    <button class="btn-play"><i class="fas fa-play"></i> watch video</button>
                </div>

            </div>

        </div>
    </div>
</header>