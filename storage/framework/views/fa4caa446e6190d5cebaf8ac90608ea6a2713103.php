<?php $__env->startSection('title','Dashboard'); ?>


<?php $__env->startSection('style'); ?>

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/morris/morris.css')); ?>" />
<!-- Chart CSS -->
<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/chartist/chartist.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/datatables/media/css/dataTables.bootstrap4.css')); ?>" />
        <style type="text/css">
        div.dataTables_wrapper select, div.dataTables_wrapper span{
            margin:0;
        }
        /* start service stayle */
        .dataTables_wrapper i {position: relative;top: 3px;}
        .dataTables_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
        .dataTables_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
        .dataTables_wrapper a { border: none; padding: 0; background: transparent;margin:0 5px 0px 0px}
        .dataTables_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
        .dataTables_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
        .dataTables_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
        .dataTables_wrapper a span{display: block;}
        .dataTables_wrapper .dt-buttons.btn-group {display: block;position: relative; float: left;width: 50%;}
        div.dataTables_wrapper label{ width:40% !important; float: left;}
        div.dataTables_wrapper label input{ height:35px;}
        div.dataTables_wrapper .pull-right{ text-align: right; }
        /* end service stayle */

<style type="text/css">
    .inner-dashborad-block .block-row, .inner-dashborad-graph-block .block-row{float: left;}
/* Pages.usesview.index */
    .modal-title {font-weight: bold;}
    .bg-grey{background-color: #BDBDBD;}
    .users-list > li {width: 10%;}
    .item-container {color: white;}
    .item-main-container {background-color: #fda538;}
    .item-sub-container {background-color: #e0972b !important;}
    th {text-align: center;}
    .tab {overflow: hidden;}
    .card-child{float: left;}
    .tab-content.pb-5{margin-left: -1.38%;}
        .myTabs .nav-link {border: 0px !important;border-radius: 0 !important;background: #FE9901 !important;color: #ffffff !important; }
        .myTabs .nav-link.active {background: #6B6B6B !important; }
        .myTabs .nav-item {margin-right: 5px;border-radius: 0px !important}
        .myTabs .nav-link h3{margin: 0!important;font-size: 20px!important;}
        .myToolbar.search-toolbar{margin-left: 0.8%!important;}
        .tab-content.pb-5 {margin-left: -1.38%;float: left;width: 100%;}
    .head-box-title{margin: 0;border-bottom: 1px solid #ffffff !important;padding: 0;color: #444439;font-size: 18px;line-height: 40px;}
    .usersview .row .box {background: #ffffff;padding: 10px;border-top: 5px solid #D2D6DE;}
    .tab.footer-tabs button {width: 16% !important; min-width: 10% !important;}
     /* Style the buttons inside the tab */
    .tab button {background-color: inherit;float: left;border: none;outline: none;cursor: pointer;padding: 14px 16px;transition: 0.3s;font-size: 17px;min-width: 200px;background: #6d6d6d; color: #fff; margin-right: 5px;}
    /* Change background color of buttons on hover */
    .tab button:hover {background-color: #000; }
    /* Create an active/current tablink class */
    .tab button.active {background-color: #ff9a00;}
     /* Style the tab content */
    .tabcontent {display: none;padding: 6px 12px;background: #fff;border-top: none;}
    .card-body .small-chart-wrapper {text-align:center; margin: 10px 0;}
    .card-body .small-chart-wrapper .small-chart-info{ padding: 0; display: block;width: 100%;}
    .card-body .small-chart-wrapper .small-chart{display: block;width: 100%;}
    .card-body .card-body_columns { width: 9%;}
    .card-body .card-body_columns .small-chart-info label{ text-transform: lowercase !important;}
    .card-body_kal .col-md-12{float: left;display: block; width: 100%}
    .card-body_kal .col-md-12 .card-child span{ display: block; width: 100%;color: red;font-weight: 700;line-height: 20px;}
    .card-body_kal .col-md-12 .card-child:first-child{text-align: left;}
    .card-body_kal .progress.light{height: 25px;border-radius: 25px !important;}
    .card-body_kal .progress .progress-bar-info{height: 25px;}
    .card-body_kal .col-md-12 .card-child span.icon-child{float: left;color: #000;padding: 10px 0; font-weight: 400;}
    .card-body_kal .col-md-12 .card-child span.icon-child i{color:#3367b3;margin-right: 7px;}
    .small-chart-wrapper canvas{ width: 40px !important; }
    .ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
      stroke: #08c !important;
    }
.ct-series-b .ct-bar, .ct-series-b .ct-line, .ct-series-b .ct-point, .ct-series-b .ct-slice-donut {
    stroke: #d9514d !important;
}
.ct-series-c .ct-bar, .ct-series-c .ct-line, .ct-series-c .ct-point, .ct-series-c .ct-slice-donut {
    stroke: #5ab75a !important;
}
.card-body_kal .col-md-12 .card-child span.icon-child{
    width: auto;
    padding: 0;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

                <section role="main" class="content-body">
                    <header class="page-header">
                    <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </header>

                <section class="content-header">
                        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> User view</a></li>
                        </ol>
                </section>

                   <!-- first block -->
                    <div class="row inner-dashborad-graph-block">

                        <div class="col-md-9 block-row">
                                    <div class="tabs tabs-dark">
                                        <ul class="nav nav-tabs charts-tabs">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="#Kcal1" data-toggle="tab">24 uur na het trainen</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#Kcal2" data-toggle="tab"> Alle overige dagen</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                        <!-- tab1 -->
                                            <div id="Kcal1" class="tab-pane active">
                                                <section class="card">
                                                    <div class="card-body card-body_kal">
                                                        <div class="col-md-12 ">
                                                            <div class="col-md-3 card-child text-right">
                                                                <strong>Doel</strong>
                                                            </div>
                                                            <div class="col-md-2 card-child">
                                                                <strong>Behaald</strong>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 ">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Kcal<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->kcal:'0'); ?>kcal</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->kcal:'0'); ?>kcal</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->kcal:0)*100/((isset($userfood))?$userfood->kcal:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Eiwit<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->eiwit:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->eiwit:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->eiwit:0)*100/((isset($userfood))?$userfood->eiwit:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Koolhydraten<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->koolhydraat:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->koolhydraat:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->koolhydraat:0)*100/((isset($userfood))?$userfood->koolhydraat:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Vezel<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->vezel:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->vezel:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->vezel:0)*100/((isset($userfood))?$userfood->vezel:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Vet<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->vet:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->vet:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->vet:0)*100/((isset($userfood))?$userfood->vet:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        <!-- tab2 -->
                                            <div id="Kcal2" class="tab-pane">
                                                <section class="card">
                                                    <div class="card-body card-body_kal">
                                                        <div class="col-md-12 ">
                                                            <div class="col-md-3 card-child text-right">
                                                                <strong>Doel</strong>
                                                            </div>
                                                            <div class="col-md-2 card-child">
                                                                <strong>Behaald</strong>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 ">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Kcal<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->kcal_baw:'0'); ?>kcal</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->kcal_baw:'0'); ?>kcal</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->kcal_baw:0)*100/((isset($userfood))?$userfood->kcal_baw:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Eiwit<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->eiwit_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->eiwit_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->eiwit_baw:0)*100/((isset($userfood))?$userfood->eiwit_baw:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Koolhydraten<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->koolhydraat_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->koolhydraat_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->koolhydraat_baw:0)*100/((isset($userfood))?$userfood->koolhydraat_baw:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Vezel<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->vezel_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->vezel_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->vezel_baw:0)*100/((isset($userfood))?$userfood->vezel_baw:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-3 card-child daily_food">
                                                                Vet<span class="icon-child pull-right"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfood)?$userfood->vet_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-2 card-child daily_food">
                                                                <span class="icon-child"><i class="fa fa-arrow-up" aria-hidden="true"></i><?php echo e(isset($userfoodused)?$userfoodused->vet_baw:'0'); ?>g</span>
                                                            </div>
                                                            <div class="col-md-7 card-child">
                                                                <div class="progress progress-xl progress-half-rounded light  daily_food" 
                                                                >
                                                                    <?php
                                                                    $thisVal = 0;
                                                                    $thisVal=((isset($userfoodused))?$userfoodused->vet_baw:0)*100/((isset($userfood))?$userfood->vet_baw:100);
                                                                    $thisVal=number_format($thisVal,2);
                                                                    
                                                                    ?>

                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $thisVal; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $thisVal; ?>%;">
                                                                    <?php echo $thisVal; ?>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    <!-- right ide block-->
                                <div class="col-md-3 block-row">

                                        <header class="card-header" style="padding: 10px 20px;">
                                            <h2 class="card-title" style="color: #08c;">
                                                <!-- <i class="fa fa-comment mr-1"></i> -->
                                                <span class="va-middle">Doelstelling</span>
                                            </h2>
                                        </header>

                                        <div class="card-body">
                                            <div class="content daily_food">
                                             <?php $msg=''; ?>
                                             <?php if(isset($userfoodused)): ?>
                                                <?php if(isset($userfoodused->daily_note)): ?>
                                                    <?php $msg=$userfoodused->daily_note; ?>
                                                <?php endif; ?>
                                             <?php endif; ?>
                                             <?php if(isset($userfood) && $msg==''): ?>
                                                <?php if(isset($userfood->daily_note)): ?>
                                                    <?php $msg=$userfood->daily_note; ?>
                                                <?php endif; ?>
                                             <?php endif; ?>
                                             <?php if($msg==''): ?>
                                                <?php $msg='Helaas, geen bericht'; ?>
                                             <?php endif; ?>

                                             <?php echo e($msg); ?>

                                            </div>
                                        </div>
                                        
                        </div>
                    </div>
                    <!-- first: Chart -->



                   <!-- second block -->
                    <div class="row">

                       <div class="col-md-12">
                           <div class="tabs tabs-dark bottom-tabs">

                            <ul class="nav nav-tabs">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#kcalinn" data-toggle="tab">Kcal Inname</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#slaap" data-toggle="tab">Slaaphygiene</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="kcalinn" class="tab-pane active">
                                    <section class="card">
                                        <div class="card-body">

                                            <div class="row">

                                            
                                                <?php for($i = 0; $i < count($sectionData['sleepdates']); $i++): ?> 
                                                <div class="card-body_columns">

                                                    <div class="small-chart-wrapper">

                                                        <div class="small-chart" id="sparklineBar<?php echo e($i); ?>"></div>

                                                        <div class="small-chart-info">

                                                            <strong class="daily_food"><?php echo e(dutch_day($sectionData['kcaldays'][$i])); ?></strong>

                                                            <label class="change-progress">
                                                            <?php $d=explode(" ", $sectionData['kcaldate'][$i]);
                                                            $d[1]=dutch_month($d[1]);
                                                            $d=implode(' ',$d);
                                                            ?>
                                                            <?php echo e($d); ?></label>

                                                        </div>

                                                    </div>

                                                </div>
                                                <?php endfor; ?>




                                            </div>

                                        </div>

                                    </section>

                                </div>
                                <div id="slaap" class="tab-pane">
                                <section class="card">
                                    
                                <div class="card-body">
                                    <div class="content" style="padding: 0 15px;">
                                       <table class=" table">
                            <?php if(isset($sectionData)): ?>
                                <?php

                                $sval = "<tr>";
                                $sdate = "<tr>";

                                for ($i = 0; $i < count($sectionData['sleepdates']); $i++) {
                                    $d=explode(" ", $sectionData['kcaldate'][$i]);
                                    $d[1]=dutch_month($d[1]);
                                    $d=implode(' ',$d);
                                    $sval .= "<td style='padding-left:10px;padding-right:10px;text-align:center' class='usermeta-update daily_food' data-id='" . $sectionData['umid'][$i] . "'>" . $sectionData['sleepvals'][$i] . "</td>";
                                    $sdate .= "<th style='padding-left:10px;padding-right:10px' class='usermeta-update change-progress' data-id='" . $sectionData['umid'][$i] . "'>" . $d . "</th>";
                                }

                                echo $sval .= "</tr>";
                                echo $sdate .= "</tr>";

                                ?>
                            <?php endif; ?>
                        </table>
                                </div>

                            </div></section>
                            </div>
                        </div>
                    </div>
                    <!-- first: Chart -->
                </div>
            </div>
                        <!-- Chart -->
                    <!-- Chart -->
          <div class="row">
            <div class="col-lg-12">
                <div class="tabs tabs-dark bottom-tabs">

                    <ul class="nav nav-tabs">
                        <?php $i=0; ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="#sleepchart" data-toggle="tab">Lichaamsgewicht</a>
                        </li>
                        
                        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\App\TestQuestion::where('tests_id',$test->id)->where('show_graph','1')->count()>0): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#<?php echo e($test->id); ?>" data-toggle="tab"><?php echo e($test->test_name); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php $i=1; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </ul>
               <div class="tab-content">
                    <?php $i=0; ?>
                    <div id="sleepchart" class="tab-pane active">
                        <section class="card">
                            <div class="card-body">
                                  <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Slaaphygiene</button>

                                    <button type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Gewicht</button>

                                    <button type="button" class="mb-1 mt-1 mr-1 btn btn-success">Kcal Inname</button>
                                    <div id="sleepchart" class="sleep-graph ct-chart ct-perfect-fourth ct-golden-section"></div>
                                 </div>
                            </section>
                        </div>
                    
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\App\TestQuestion::where('tests_id',$test->id)->where('show_graph','1')->count()>0): ?>
                    <div id="<?php echo e($test->id); ?>" class="tab-pane">
                        <section class="card">
                            <div class="card-body">
                                  <?php $__currentLoopData = \App\TestQuestion::where('tests_id',$test->id)->where('show_graph','1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ques): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($ques->status): ?>
                                     <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary"><?php echo e($ques->question); ?></button>
                                    <?php endif; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <div id="test-<?php echo e($test->id); ?>" class="tests-graph ct-chart ct-perfect-fourth ct-golden-section"></div>
                                 </div>
                            </section>
                        </div>
                    <?php endif; ?>
                    <?php $i=1; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            </div></div>
        <!-- end: Chart -->
            </div>
        <!-- bottom tabls -->
        <?php if(count($tests)>0): ?>
          <div class="row">
            <div class="col-lg-12">
                <div class="tab tabs-dark bottom-tabs">

                    <ul class="nav nav-tabs">
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item <?php echo e($i==0?'active':''); ?>">
                            <a class="nav-link" href="#<?php echo e($test->id); ?>" data-toggle="tab"><?php echo e($test->test_name); ?></a>
                        </li>
                        <?php $i=1; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </ul>
                </div>
               <div class="tab-content">
                    <?php $i=0; ?>
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="<?php echo e($test->id); ?>" class="tab-pane <?php echo e($i==0?'active':''); ?>">
                        <section class="card">
                            <div class="card-body">
                                <form action="<?php echo e(route('admin.tests.answer',$test->id)); ?>" method="post"> 
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" class="form-control" value="<?php echo e($user->id); ?>" name="id">
                                <table class="test-table table table-responsive-lg table-bordered table-striped table-sm mb-0">
                                    <thead>
                                        <tr>
                                           <?php $__currentLoopData = $test->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ques): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ques->status): ?>
                                             <th><?php echo e($ques->question); ?></th>
                                            <?php endif; ?>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           <th align="center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php $__currentLoopData = $test->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ques): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ques->status): ?>
                                            <td style="padding: 5px">
                                            <input type="<?php echo e($ques->type); ?>" class="form-control" name="answer[<?php echo e($ques->id); ?>]" data-url="<?php echo e(route('admin.tests.answer',$test->id)); ?>"></td>
                                            <?php endif; ?>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <td align="center"><button type="submit" class="btn btn-success add-row">Update</button></td>
                                        </tr>
                                        <?php $testAnswers=\App\TestAnswer::select('created_at')->where('tests_id',$test->id)->where('added_by',$user->id)->groupBy('created_at')->orderBy('created_at','desc')->get();
                                        ?>
                                        <?php $__currentLoopData = $testAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testanswer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php $__currentLoopData = $test->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ques): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ques->status): ?>
                                            <td style="padding: 5px">
                                                <?php 
                                                $ans= \App\TestAnswer::where('tests_id',$test->id)->where('added_by',$user->id)->where('question_id',$ques->id)->where('created_at',$testanswer->created_at)->first()->answer;
                                                ?>
                                                <?php if($ques->type=='date'): ?>
                                                    <?php echo e(date('d-m-Y',strtotime($ans))); ?>

                                                <?php elseif($ques->type=='file'): ?>
                                                <a href="<?php echo e(assets('/storage/uploads/'.$user->id.'/'.$test->id).'/'.$ans); ?>"><?php echo e($ans); ?></a>
                                                <?php else: ?>
                                                <?php echo e($ans); ?>

                                                <?php endif; ?>  
                                            </td>
                                            <?php endif; ?>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <td align="center"></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    </form>
                                    
                               </div>
                         </section>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                   <!-- end tabs -->
                </div>
            </div>
        </div>
        <?php endif; ?>
            <!-- end: Chart -->
    </section>

    
    <!-- start add-model-service  -->
    <div id="add-user-daily-food" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" service="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header hidden">
                    <h4 class="modal-title">
                        <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-plus fa-stack-1x"></i>
                        </span>            
                        Buiten het anabolic window
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->getFromJson('common.close'); ?>">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                <div class="col">
                    <div class="tabs tabs-dark">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link " href="#daily_food_add" data-toggle="tab">Geadviseerd</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#daily_food_consumed" data-toggle="tab">Geconsumeerd</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#overig" data-toggle="tab">Overig</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                        <!-- tab form add-->
                            <div id="daily_food_add" class="tab-pane active">
                                <form service="form" action="<?php echo e(route('admin.user.daily_food')); ?>" id="user_daily_food_add" method="post" enctype="multipart/form-data" onsubmit="submitForm('user_daily_food_add');" >
                                     <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                       
                                    <?php echo e(csrf_field()); ?>

                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Deol inname in het Anabolic Eindow</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Kcal</label>
                                            <input type="number" name="kcal" class="form-control" id="kcal" value="<?php echo e(old('kcal')); ?>" placeholder="ex: kcal">
                                            <span class="text-danger" id="kcal-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="eiwit">Eiwit</label>
                                            <input type="number" min="0" name="eiwit" class="form-control" id="eiwit" placeholder="ex: eiwit" value="<?php echo e(old('eiwit')); ?>">
                                            <span class="text-danger" id="eiwit-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Koolhydraten</label>
                                            <input type="number" min="0" name="koolhydraat" class="form-control" id="koolhydraat" value="<?php echo e(old('koolhydraat')); ?>" placeholder="ex: Koolhydraten">
                                            <span class="text-danger" id="koolhydraat-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vezel">Vezel</label>
                                            <input type="number" min="0" name="vezel" class="form-control" id="vezel" placeholder="ex: vezel" value="<?php echo e(old('vezel')); ?>">
                                            <span class="text-danger" id="vezel-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vet">vet</label>
                                            <input type="number" min="0" name="vet" class="form-control" id="vet" placeholder="ex: vet" value="<?php echo e(old('vet')); ?>">
                                            <span class="text-danger" id="vet-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Deol inname Buiten het Anabolic Eindow</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Kcal</label>
                                            <input type="number" name="kcal_baw" class="form-control" id="kcal_baw" min="0" value="<?php echo e(old('kcal_baw')); ?>" placeholder="ex: kcal">
                                            <span class="text-danger" id="kcal_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="eiwit_baw">Eiwit</label>
                                            <input type="number" name="eiwit_baw" min="0" class="form-control" id="eiwit_baw" placeholder="ex: Eiwit" value="<?php echo e(old('eiwit_baw')); ?>">
                                            <span class="text-danger" id="eiwit_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Koolhydraten</label>
                                            <input type="number" name="koolhydraat_baw" min="0" class="form-control" id="koolhydraat_baw" value="<?php echo e(old('koolhydraat_baw')); ?>" placeholder="ex: Koolhydraat">
                                            <span class="text-danger" id="Koolhydraten_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vezel_baw">Vezel</label>
                                            <input type="number" min="0" name="vezel_baw" class="form-control" id="vezel_baw" placeholder="ex: Vezel" value="<?php echo e(old('vezel_baw')); ?>">
                                            <span class="text-danger" id="vezel_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vet_baw">Vet</label>
                                            <input type="number" min="0" name="vet_baw" class="form-control" id="vet_baw" placeholder="ex: vet"  value="<?php echo e(old('vet_baw')); ?>">
                                            <span class="text-danger" id="vet_baw-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Daily Note</label>
                                            <textarea name="daily_note" class="form-control" id="daily_note" placeholder="ex: Daily Note">  <?php echo e(old('daily_note')); ?></textarea>
                                            <span class="text-danger" id="daily_note-error"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
                                            <button type="submit" class="btn btn-info btn-flat  pull-right" id="store-button-service">Save</button>
                                        </div>
                                    </div>
                                </form>                
                            </div>
                            <div id="daily_food_consumed" class="tab-pane ">
                                <form service="form" action="<?php echo e(route('admin.user.food_used')); ?>" id="user_food_used_add" method="post" enctype="multipart/form-data" onsubmit="submitForm('user_food_used_add');">
                                    <?php echo e(csrf_field()); ?>

                                   <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Deol inname in het Anabolic Eindow</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Kcal</label>
                                            <input type="number" name="kcal" class="form-control" id="kcal" value="<?php echo e(old('kcal')); ?>" placeholder="ex: kcal">
                                            <span class="text-danger" id="kcal-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="eiwit">Eiwit</label>
                                            <input type="number" min="0" name="eiwit" class="form-control" id="eiwit" placeholder="ex: eiwit" value="<?php echo e(old('eiwit')); ?>">
                                            <span class="text-danger" id="eiwit-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Koolhydraten</label>
                                            <input type="number" min="0" name="koolhydraat" class="form-control" id="koolhydraat" value="<?php echo e(old('koolhydraat')); ?>" placeholder="ex: Koolhydraten">
                                            <span class="text-danger" id="koolhydraat-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vezel">vezel</label>
                                            <input type="number" min="0" name="vezel" class="form-control" id="vezel" placeholder="ex: vezel" value="<?php echo e(old('vezel')); ?>">
                                            <span class="text-danger" id="vezel-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vet">vet</label>
                                            <input type="number" min="0" name="vet" class="form-control" id="vet" placeholder="ex: vet" value="<?php echo e(old('vet')); ?>">
                                            <span class="text-danger" id="vet-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Deol inname Buiten het Anabolic Eindow</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Kcal</label>
                                            <input type="number" name="kcal_baw" class="form-control" id="kcal_baw" min="0" value="<?php echo e(old('kcal_baw')); ?>" placeholder="ex: kcal">
                                            <span class="text-danger" id="kcal_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="eiwit_baw">Eiwit</label>
                                            <input type="number" name="eiwit_baw" min="0" class="form-control" id="eiwit_baw" placeholder="ex: Eiwit" value="<?php echo e(old('eiwit_baw')); ?>">
                                            <span class="text-danger" id="eiwit_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Koolhydraten</label>
                                            <input type="number" name="koolhydraat_baw" min="0" class="form-control" id="koolhydraat_baw" value="<?php echo e(old('koolhydraat_baw')); ?>" placeholder="ex: Koolhydraten">
                                            <span class="text-danger" id="koolhydraat_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vezel_baw">Vezel</label>
                                            <input type="number" min="0" name="vezel_baw" class="form-control" id="vezel_baw" placeholder="ex: Vezel" value="<?php echo e(old('vezel_baw')); ?>">
                                            <span class="text-danger" id="vezel_baw-error"></span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vet_baw">Vet</label>
                                            <input type="number" min="0" name="vet_baw" class="form-control" id="vet_baw" placeholder="ex: vet" value="<?php echo e(old('vet_baw')); ?>">
                                            <span class="text-danger" id="vet_baw-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Daily Note</label>
                                            <textarea name="daily_note" class="form-control" id="daily_note" placeholder="ex: Daily Note">  <?php echo e(old('daily_note')); ?></textarea>
                                            <span class="text-danger" id="daily_note-error"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
                                            <button type="submit" class="btn btn-info btn-flat pull-right" id="store-button-service">Save</button>
                                        </div>
                                    </div>
                                </form>                
                            </div>
                            <div id="overig" class="tab-pane">
                                <form service="form" action="<?php echo e(route('admin.user.daily_values')); ?>" id="user_daily_values_add" method="post" enctype="multipart/form-data" onsubmit="submitForm('user_daily_values_add');" >
                                     <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                       
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Datum</label>
                                            <input type="date" name="date" class="form-control" id="date" value="<?php echo e(old('date')); ?>" placeholder="ex: Datum">
                                            <span class="text-danger" id="date-error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="weight">Gewicht</label>
                                            <input type="number" min="0" name="weight" class="form-control" id="weight" placeholder="ex: Gewicht" value="<?php echo e(old('weight')); ?>">
                                            <span class="text-danger" id="weight-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Uw gebruikte Kcal</label>
                                            <input type="number" min="0" name="kcal" class="form-control" id="kcal" value="<?php echo e(old('kcal')); ?>" placeholder="ex: Uw gebruikte Kcal">
                                            <span class="text-danger" id="kcal-error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="file">Training File</label>
                                            <input type="file" name="file" class="form-control" id="file">
                                            <span class="text-danger" id="file-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="sleep_q1">How long heb je geslapen vandaag?</label>
                                            <input type="number" min="0" name="sleep_q1" class="form-control" id="sleep_q1" placeholder="ex: vet" value="<?php echo e(old('sleep_q1')); ?>">
                                            <span class="text-danger" id="sleep_q1-error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="sleep_q2">How je makkelijk in slaap komen?</label>
                                            <select name="sleep_q2" class="form-control" id="sleep_q2">
                                                <option value="1"
                                                 <?php echo e(old('sleep_q2')==1?'selected':''); ?>>Ja</option>
                                                <option value="0"
                                                 <?php echo e(old('sleep_q2')==0?'selected':''); ?>>Nee</option>
                                            </select>
                                            <span class="text-danger" id="sleep_q2-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="sleep_q3">Ben je's naohts wakker geworden?</label>
                                            <select name="sleep_q3" class="form-control" id="sleep_q3">
                                                <option value="1"
                                                 <?php echo e(old('sleep_q3')==1?'selected':''); ?>>Ja</option>
                                                <option value="0"
                                                 <?php echo e(old('sleep_q3')==0?'selected':''); ?>>Nee</option>
                                            </select>
                                            <span class="text-danger" id="sleep_q3-error"></span>
                                        </div>
                                        <div class="form-group col-md-6 sleep">
                                            <label for="sleep_q4">Zo ja, waar denk je dta het aan heeft gelegen?</label>
                                            <input type="text" name="sleep_q4" class="form-control" id="sleep_q4" placeholder="ex: vet" value="<?php echo e(old('sleep_q4')); ?>">
                                            <span class="text-danger" id="sleep_q4-error"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
                                            <button type="submit" class="btn btn-info btn-flat  pull-right" id="store-button-service">Save</button>
                                        </div>
                                    </div>
                                </form>                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<!-- end add-model-service  -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site_scripts'); ?>
 <?php echo $__env->make('admin.scripts.user_dashboard_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>