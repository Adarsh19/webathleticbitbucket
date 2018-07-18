<?php $user = Auth::user(); ?>
<style type="text/css">
    .userbox .role {
        color: #ACACAC;
        font-size: 0.85rem;
        line-height: 1.2rem;
    }
</style>
<a href="#" class="dash-logo">
    <span class="logo-sm">
        <img src="<?php echo e(asset('/images/vplogo.png')); ?>" alt="webathletic" />
    </span>
</a>

    <div class="right-wrapper">
                <a class="sidebar-right-toggle" data-open="sidebar-right" style="float:right;">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </a>
                <div class="header-right" style="float: right;">
                    <div class="uw-saldo-value" style=""><span>Uw saldo 5.00</span></div>
                    <span class="separator"></span>
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?php echo e(asset('profile_images/' . $user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle" data-lock-picture="<?php echo e(asset('profile_images/' . $user->avatar)); ?>" />
                            </figure>
                            <div
                                class="profile-info" data-lock-lock="<?php echo e(Session::has('lock')); ?>" data-lock-url="<?php echo e(route('admin.unlock')); ?>" data-lock-token="<?php echo e(csrf_token()); ?>"
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
                                    <a role="menuitem" tabindex="-1" href="<?php echo e(url('/admin/users/'.$user->id)); ?>"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" data-url="<?php echo e(route('admin.screen-lock')); ?>" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?php echo e(url('/signout')); ?>"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="notifications">                      
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge"><?php echo e(count($user->unreadNotifications)); ?></span>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="float-right badge badge-default"><?php echo e(count($user->unreadNotifications)); ?></span>
                                    Alerts
                                </div>
            
                                <div class="content">
                                    <ul>

                                        <?php
                                        $user = App\User::find($user->id);
                                        ?>

                                        <?php $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li>
                                                    <a href="#" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-bell bg-info text-light"></i>
                                                        </div>
                                                        <span class="title"> <?php echo e(str_replace("_",$notification['data']['schema_name'],Helper::mappings($notification['type']))); ?></span>
                                                        <span class="message"><?php echo e($notification['created_at']->diffForHumans()); ?></span>
                                                    </a>
                                                </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                        
                                            
                                                
                                                    
                                                
                                                
                                                
                                            
                                        
                                        
                                            
                                                
                                                    
                                                
                                                
                                                
                                            
                                        
                                    </ul>
                                    <hr/>
                                    <div class="text-right">
                                        <a href="<?php echo e(route('admin.viewnotificationsRqst','all')); ?>" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="header-icons-block">
                        <a class="header-country-img">
                        <img src="<?php echo e(asset('images/asterdam.png')); ?>" alt="Joseph Junior" /></a>
                    </div>
                </div>
            </div>
