 <header>
        <nav class="navbar navbar-expand-lg navbar-black bg-black" <?php if($hasUI): ?> style="background:#<?php echo e($company_data['ui']['header']); ?> !important;" <?php endif; ?>>
            <a class="navbar-brand" href="#" id="log">
            <!-- <img src="images/logo.png" width="200" alt=""> -->
                <?php if($is_company && $company_data['logo'] != ""): ?> <img src="<?php echo e(url('/site_images')); ?>/<?php echo e($company_data['logo']); ?>"> <?php else: ?> <img src="<?php echo e(url('/images')); ?>/logo.png"> <?php endif; ?>  
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <?php if(!$is_company): ?>

                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('methodsRoute')); ?>">Online Coaching</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="video.html">Video - Bibliotheek</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('service')); ?>">Diensten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/client')); ?>">Succesverhalen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/contact')); ?>">Contact</a>
                            </li>
                            <?php if(!Auth::check()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/signup')); ?>">Aanmelden</a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::check() && Auth::User()->role_id == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/dashboard')); ?>">Dashboard</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                            <?php if(!Auth::check()): ?>
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Inloggen</a>
                            <?php else: ?>
                                <a class="nav-link" href="<?php echo e(url('/signout')); ?>">Afmelden</a>
                            <?php endif; ?>
                            </li>
                    <?php else: ?>

                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>/service">Diensten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>/client">Succesverhalen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>/contact">Contact</a>
                            </li>
                            <?php if(!Auth::check()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>/signup">Aanmelden</a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::check() && Auth::User()->role_id == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/dashboard')); ?>">Dashboard</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                            <?php if(!Auth::check()): ?>
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Inloggen</a>
                            <?php else: ?>
                                <a class="nav-link" href="<?php echo e(url('org')); ?>/<?php echo e($company_data['slug']); ?>/signout">Afmelden</a>
                            <?php endif; ?>
                            </li>


                    <?php endif; ?>
                    
                </ul>
                <!-- <div class="form-inline my-1 my-lg-0">
                    <button class="btn btn-outline-warning my-2 my-sm-0" onclick="sideMenu('open');"><i class="fas fa-bars"></i></button>
                </div> -->
            </div>
        </nav>
       <div class="jumbotron jumbotron-fluid">
            <div class="jumbo-bg">
                <!-- <img src="images/home-img.png " alt=" "> -->
           <?php Helper::renderSiteImage(2); ?>
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