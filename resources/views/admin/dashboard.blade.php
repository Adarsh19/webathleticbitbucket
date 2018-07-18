@extends('layouts.admin_layout')


@section('title','Dashboard')


@section('style')

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css') }}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css') }}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
<link rel="stylesheet" href="{{ asset('admin_files/vendor/morris/morris.css') }}" />
<!-- Chart CSS -->
<link rel="stylesheet" href="{{ asset('admin_files/vendor/chartist/chartist.min.css') }}" />
<!-- Daterangepicker css-->
<link rel="stylesheet" href="{{ asset('admin_files/daterangepicker/daterangepicker.css') }}" />
<style type="text/css">
.inner-dashborad-block, .inner-dashborad-block .block-row, .inner-dashborad-graph-block .block-row {float:left;}
.inner-dashborad-block .widget-summary .summary-icon{width: 65px;height: 65px;line-height: 55px;}
.inner-dashborad-block .widget-summary .summary-icon i{font-size: 36px;}
.inner-dashborad-block.bootom-tabs .widget-summary .summary-icon {
width: 45px;
height: 45px;
line-height: 0;
border-radius: 50%;margin-right: 10px;
}
.inner-dashborad-block.bootom-tabs .widget-summary .summary-icon img {
height: inherit;
width: inherit;
}
.inner-dashborad-block.bootom-tabs .col-xl-2{
padding: 0px !important;
}
.inner-dashborad-block.bootom-tabs .card-body {	padding: 15px 5px;	}
.inner-dashborad-block.bootom-tabs .card-body .widget-summary-col .title{ font-size:12px; }
.inner-dashborad-block.bootom-tabs .card-body .widget-summary-col .num-txt{ padding: 2px 0;color:orange;font-weight:bold;
}
.line-it-blue{
	stroke: aliceblue !important;
}
.line-it-red{
	stroke: red !important;
}
.line-it-black{
	stroke: black !important;
}
.line-it-gray{
	stroke: gray !important;
}
.line-it-green{
	stroke: green !important;
}
.bg-success{
	color: #fff !important;
}
</style>
@endsection

@section('content')

				<section role="main" class="content-body">

					<header class="page-header">
						@include('admin.includes.header')
					</header>

					<section class="content-header">
					        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
					            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-home active"></i> Dashboard</a></li>
					        </ol>
				   	</section>

					<input type="file" id="fi" style="display: none;">

					<!-- start: page -->
					<div class="row">
					<!-- added by other team -->
						<div class="col-md-12 inner-dashborad-block">
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						</div>
					<!-- added by other end  -->
						<div class="col-md-12 inner-dashborad-block" style="padding: 10px;">

								<div class="col-xl-3 block-row ">
								    <!-- @php $block_image_1 = Helper::getSiteImage('banner'); @endphp -->

									<section class="card card-featured-left card-featured-secondary hvr-grow-shadow">
										<div class="card-body">
											<div class="widget-summary">
												<i class="fa fa-edit fa-stack-1x icon-edit" data-id="{{$block_image_1->id}}" data-block_id="dashboard_block_1" ></i>
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<!-- <img src="{{ asset('site_images') }}/{{$block_image_1->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_1"> -->
													</div>
												</div>
												<div class="widget-summary-col">

													<a href="{{url('admin/users')}}">
														<div class="summary">
															<h4 class="title">Huidig ledenaantal</h4>
															<div class="info">
																<strong class="amount">{{ isset($total_users) ? $total_users : '' }}</strong>
																<!-- <span class="text-primary">(14 unread)</span> -->
															</div>
														</div>
													</a>
													<!-- <div class="summary-footer">
														<a class="text-muted text-uppercase" href="{{url('admin/users')}}">(view all)</a>
													</div> -->
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-3 block-row">
								<!-- @php $block_image_2 = Helper::getSiteImage('banner'); @endphp -->
									<section class="card card-featured-left card-featured-secondary hvr-grow-shadow">
										<div class="card-body">
											<div class="widget-summary">
											<i class="fa fa-edit fa-stack-1x icon-edit" data-id="{{$block_image_2->id}}" data-block_id="dashboard_block_2" ></i>
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
													<!-- <img src="{{ asset('site_images') }}/{{$block_image_2->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_2"> -->
													</div>
												</div>
												<div class="widget-summary-col">
													<a href="{{ route('admin.packages.index', ['finance' => 'finance_tab']) }}">
														<div class="summary">
															<h4 class="title">Omzet deze maand</h4>
															<div class="info">
																<strong class="amount">€ {{ isset($turnover_this_month) ? $turnover_this_month : '0' }}</strong>
															</div>
														</div>
													</a>
												<!-- 	<div class="summary-footer">
														<a class="text-muted text-uppercase" href="{{ route('admin.packages.index', ['finance' => 'finance_tab']) }}">(withdraw)</a>
													</div> -->
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-3 block-row hvr-grow-shadow">
								<!-- @php $block_image_3 = Helper::getSiteImage('banner'); @endphp -->
									<section class="card card-featured-left card-featured-secondary">
										<div class="card-body">
											<div class="widget-summary">
											<i class="fa fa-edit fa-stack-1x icon-edit" data-id="{{$block_image_3->id}}" data-block_id="dashboard_block_3" ></i>
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
												        	<!-- <img src="{{ asset('site_images') }}/{{$block_image_3->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_3"> -->
													</div>
												</div>
												<div class="widget-summary-col">
													<a href="{{ route('admin.userIndexRoute', ['check_in' => 'check_in_tab']) }}">
														<div class="summary">
															<h4 class="title">Bezoeken vandaag</h4>
															<div class="info">
																<strong class="amount">{{$check_in_count}}</strong>
															</div>
														</div>
													</a>
												
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-3 block-row hvr-grow-shadow">
								<!-- @php $block_image_4 = Helper::getSiteImage('banner'); @endphp -->
									<section class="card card-featured-left card-featured-quaternary">
										<div class="card-body">
											<div class="widget-summary">
										<i class="fa fa-edit fa-stack-1x icon-edit" data-id="{{$block_image_4->id}}" data-block_id="dashboard_block_4" ></i>
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quaternary">
														<!-- <img src="{{ asset('site_images') }}/{{$block_image_4->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_4"> -->
													</div>
												</div>
												<div class="widget-summary-col">
													<a href="{{ url('/admin/users') }}">
														<div class="summary">
															<h4 class="title">Vandaag ingelogd</h4>
															<div class="info">
																<strong class="amount">{{ isset($today_login_users) ? $today_login_users : '' }}</strong>
															</div>
														</div>
													</a>
													<!-- <div class="summary-footer">
														<a class="text-muted text-uppercase" href="{{url('/admin/users')}}">(report)</a>
													</div> -->
												</div>
											</div>
										</div>
									</section>
								</div>
						</div>
					</div>

					<!-- Chart -->
					<div class="row inner-dashborad-graph-block">
						<div class="col-md-12 mb-4 pb-2">
								<div class="col-md-9 inner-dashborad-block">
									<div class="tabs tabs-dark">
										<ul class="nav nav-tabs charts-tabs">
										<li class="nav-item active">
											<a class="nav-link" href="#Klantgegevens" data-toggle="tab" tab-id="Klantgegevens">Klantgegevens</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#popular2" data-toggle="tab" tab-id="ChartistSimpleLineChart2">Verkoop</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#popular3" data-toggle="tab" tab-id="ChartistSimpleLineChart3">Kaart</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#popular4" data-toggle="tab" tab-id="ChartistSimpleLineChart4">Financieel</a>
										</li>

										</ul>
										<div class="tab-content">
										<!-- tab1 -->
											<div id="Klantgegevens" class="tab-pane active">
												<section class="card">
													<div class="card-body">
														<section class="card">

															<div class="card-body">

																
															   <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Totaal leden</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-success">Filiaal bezocht</button>
																<button type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Account ingelogd</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-info">Lid opgezegd</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-warning">Nieuwe leden</button>
															<div id="reportrange">
															    <i class="fa fa-calendar"></i>&nbsp;
															    <span></span> <i class="fa fa-caret-down"></i>
															</div>

																<div id="ChartistSimpleLineChart" class="ct-chart ct-perfect-fourth ct-golden-section">

																</div>
															</div>
														</section>
													</div>
										        </section>
											</div>
										<!-- tab2 -->
											<div id="popular2" class="tab-pane">
												<section class="card">
													<div class="card-body">
														<section class="card">
															<div class="card-body">

															   @foreach($products as $product)
														    	<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary" style="">{{$product->name}}</button>
														    	@endforeach


																<div id="ChartistSimpleLineChart2"></div>
															</div>
														</section>
													</div>
										        </section>
											</div>
										<!-- tab3 -->
											<div id="popular3" class="tab-pane">
												<section class="card">
													<div class="card-body">
														<section class="card">
															<div class="	card-body">
																@foreach($services as $service)
														    	<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary" style="background:{{$service->bg_color}}">{{$service->service}}</button>
														    	@endforeach

																<div id="ChartistSimpleLineChart3" class="ct-chart ct-perfect-fourth ct-golden-section"></div>
															</div>
														</section>
													</div>
										        </section>
											</div>
										<!-- tab4 -->
											<div id="popular4" class="tab-pane">
												<section class="card">
													<div class="card-body">
														<section class="card">
															<div class="card-body">

														    	<button type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Totaal aangemaakt</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-success">Betaalde facturen</button>
																<button type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Mislukte facturen</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-info">Betaald bedrag</button>

																<button type="button" class="mb-1 mt-1 mr-1 btn btn-warning">Mislukt bedrag</button>

																<div id="ChartistSimpleLineChart4" class="ct-chart ct-perfect-fourth ct-golden-section"></div>
															</div>
														</section>
													</div>
										        </section>
											</div>
										</div>
									</div>
								</div>

						<div class="col-lg-3 block-row">
								<!-- <header class="card-header">

									<h2 class="card-title" style="color: #08c;">
										<i class="fa fa-comment mr-1"></i>
										<span class="va-middle">Messages</span>
									</h2>

								</header> -->


								<div class="tabs tabs-dark">
									<ul class="nav nav-tabs">
										<li class="nav-item active">
											<a class="nav-link" href="#message1" data-toggle="tab"> Check-in
											&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" style="padding-left: 10px; padding-right: 9px;" href="#message2" data-toggle="tab">Laatst ingelogd</a>
										</li>
									</ul>
									<div class="tab-content">
									   <!-- tab1 -->
										<div id="message1" class="tab-pane active">
											<section class="card">
												<div class="card-body">
													<ul class="simple-user-list">
														
														@if(!count($check_in_log)) 

														<li>
															No Check-In registered
														</li> 

														@else 
														
														@foreach($check_in_log as $check)
														<li class="@if($check['checkremain'] < 2) bg-warning @else bg-success @endif">
															<figure class="image rounded">
																<img src="{{ asset('admin_files/img/!sample-user.jpg') }}" alt="{{ $check['username'] }}" class="rounded-circle">
															</figure>
															<span class="title">{{ $check['username'] }}</span>
															<span class="message truncate">Checked in at {{ $check['checkDate'] }}</span>
														</li>
														@endforeach

														@endif
															</ul>
													<hr class="dotted short">
												</div>
									        </section>
										</div>
										<!-- tab2 -->
										<div id="message2" class="tab-pane">
											<section class="card">
												<div class="card-body">
													<ul class="simple-user-list">
														@foreach(getLogByLogName('common.check_in') as $log)
														<li class="msg-0">
															<figure class="image rounded">
																<img src="{{ asset('admin_files/img/!sample-user.jpg') }}" alt="Joseph Doe Junior" class="rounded-circle">
															</figure>
															<span class="title">{{getUserNameById($log->causer_id)}}</span>
															<span class="message truncate">Logged in at {{$log->created_at}}</span>
														</li>
														@endforeach
															</ul>
													<hr class="dotted short">
													{{getLogByLogName('common.check_in')->links()}}
												</div>
									        </section>
										</div>
										<!-- tab2 end -->
								</div>


								</div>
							<!-- 	<div class="card-footer">
									<div class="input-group input-search">
										<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div> -->
							</div>

						</div>
					</div>

					<!-- end: Chart -->

					<!-- start: page -->
					<div class="row">
						<div class="col-md-9 inner-dashborad-block bootom-tabs">
								<div class="col-xl-2 block-row">
								    @php $block_image_1 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<img src="{{ asset('site_images') }}/{{$block_image_1->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_1">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Eerste dag</h4>
														<div class="col-sm-12 num-txt">{{$data['totalUsers']}}</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-2 block-row">
								@php $block_image_2 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
													<img src="{{ asset('site_images') }}/{{$block_image_2->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_2">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Laatste Dag</h4>
														<div class="col-sm-12 num-txt">{{$data['currentUsers']}}</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-2 block-row">
								@php $block_image_3 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
												        	<img src="{{ asset('site_images') }}/{{$block_image_3->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_3">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Verchil</h4>
														<div class="col-sm-12 num-txt">{{$data['diffUsers']}}</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-2 block-row">
								@php $block_image_4 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quaternary">
														<img src="{{ asset('site_images') }}/{{$block_image_4->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_4">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Percentage</h4>
														<div class="col-sm-12 num-txt">{{$data['diffPercentage']}}%</div>
												</div>
											</div>
										</div>
									</section>
								</div>

							<div class="col-xl-2 block-row">
								@php $block_image_4 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quaternary">
														<img src="{{ asset('site_images') }}/{{$block_image_4->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_4">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Nieuw</h4>
														<div class="col-sm-12 num-txt">{{$data['lastMonthNew']}}</div>
												</div>
											</div>
										</div>
									</section>
								</div>

								<div class="col-xl-2 block-row">
								@php $block_image_4 = Helper::getSiteImage('banner'); @endphp
									<section class="card">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quaternary">
														<img src="{{ asset('site_images') }}/{{$block_image_4->src}}" alt="Joseph Doe Junior" class="rounded-circle" id="dashboard_block_4">
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Opgezegd</h4>
														<div class="col-sm-12 num-txt">{{$data['lastMonthBlocked']}}%</div>
												</div>
											</div>
										</div>
									</section>
								</div>
						</div>
					</div>
				</section>
@endsection

@section('site_scripts')
		<!-- Specific Page Vendor -->
	<script src="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jquery-appear/jquery-appear.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/flot/jquery.flot.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/flot.tooltip/flot.tooltip.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/flot/jquery.flot.pie.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/flot/jquery.flot.categories.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/flot/jquery.flot.resize.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jquery-sparkline/jquery-sparkline.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/raphael/raphael.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/morris/morris.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/gauge/gauge.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/snap.svg/snap.svg.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/liquid-meter/liquid.meter.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/jquery.vmap.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>

	<!-- Specific Page Vendor -->
	<script src="{{ asset('admin_files/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('admin_files/daterangepicker/daterangepicker.min.js')}}"></script>

	<script src="{{ asset('user_files/js/admin.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/chartist/chartist.js')}}"></script>
	<script src="{{ asset('admin_files/js/examples/examples.charts.js')}}"></script>

	<script type="text/javascript">

function lineGraph(graphid,data, options,colors=[]) {
	
	var defaultColors = ["#0088cc", "#47a447", "#d2322d", "#5bc0de", "#ed9c28"];
	if(colors.length == 0) colors = defaultColors;
	
	if( $('#'+graphid).get(0) ) {
		chart = new Chartist.Line('#'+graphid, {
			labels: data['labels'],
			series: data['series'],
		},options);
	}

	chart.on('draw', function(context) {

			if(context.type=="line" && typeof colors[context.index] != "undefined"){
				context.element.attr({
				      style: 'stroke: '+colors[context.index]
				    });
		  	}
		  	if(context.type=="point" && typeof colors[context.seriesIndex] != "undefined"){
				context.element.attr({
				      style: 'stroke: '+colors[context.seriesIndex]
				    });
		  	}
});
}
	$(document).ready(function(){
		var options = {
		 	axisY:{ 
			 // If low is specified then the axis will display values explicitly down to this value and the computed minimum from the data is ignored
			  low: 0,
			  // Can be set to true or false. If set to true, the scale will be generated with whole numbers only.
			  onlyInteger: true
			}
		};
		var graph_users={!! json_encode($graph_users) !!};
		var graph_products={!! json_encode($graph_products) !!};
		var graph_services={!! json_encode($graph_service) !!};
		lineGraph('ChartistSimpleLineChart',graph_users,options);
// Tabs
$('.charts-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

	var chart_ = $(this).attr('tab-id');

	if(chart_ ==  "Klantgegevens"){
		lineGraph('ChartistSimpleLineChart',graph_users,options);
	}

	if(chart_ ==  "ChartistSimpleLineChart2"){
		lineGraph('ChartistSimpleLineChart2',graph_products,null);
	}

	if(chart_ ==  "ChartistSimpleLineChart3"){
		colors = [
		@foreach($services as $service)
			'{{$service->bg_color}}',
		@endforeach
		];
		lineGraph('ChartistSimpleLineChart3',graph_services,null, colors);
		
	}

	if(chart_ ==  "ChartistSimpleLineChart4"){
		lineGraph('ChartistSimpleLineChart4',{!! json_encode($graph_invoices) !!},null);
	}

});

$('.icon-edit').on('click',function(){
	var id = $(this).data().id;
	var block_id = $(this).data().block_id;
	$("#update_site_images input[name='action']").val('update_site_image');
	$("#update_site_images input[name='image_type']").val(block_id);
	$("#update_site_images input[name='id']").val(id);
	$( "#fi" ).trigger( "click" );
});

$('#fi').on('change',function(){

    $('.croppie-demo').croppie('destroy');

        $uploadCrop = $('.croppie-demo').croppie({
                enableExif: true,
                showZoomer: true,
                enableZoom: true,
                mouseWheelZoom: false,
                enforceBoundary: false,
                orientation :true,
                viewport: {
                    width: 70,
                    height: 70,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
        });

    var numImages = $(this).length;

    if(numImages == 1){
        readFile(this);
    } else {
        console.log('You can\'t upload more than one image. ');
    }

});


    var start = moment().subtract(7, 'days');
    var end = moment();
    $('#reportrange').daterangepicker({
    	locale: {
	      format: 'DD-MM-YYYY'
	    },
        startDate: start,
        endDate: end,
        ranges: {
           //'Today': [moment(), moment()],
           //'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()]
           //'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           //'This Month': [moment().startOf('month'), moment().endOf('month')],
           //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "minDate": "dd-mm-yyyy",
    	"maxDate": "dd-mm-yyyy"
    }, garphdata);
    garphdata(start,end);
    function garphdata(start, end){
    	var link="{{route('admin.dashboardGraph',['startdate'=>'sdate','enddate'=>'edate','type'=>'user'])}}";
    	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    	link=link.replace('sdate',start.format('YYYY-MM-DD'));
    	link=link.replace('edate',end.format('YYYY-MM-DD'));
    	$.get(link, function(data, status){
	   		$.each( data, function( key, value ) {
                lineGraph('ChartistSimpleLineChart',value[0],options);     
            });

	    });
    }

// document end
	});
	</script>
@endsection

@section('scripts')

@endsection