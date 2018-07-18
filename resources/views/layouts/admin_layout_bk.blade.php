<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>@yield('title')</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/animate/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/hover/hover.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin_files/vendor/pnotify/pnotify.custom.css') }}" />
		
		<link rel="stylesheet" href="{{ asset('/admin_files/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
		<!-- Specific Page Vendor CSS -->
		@yield('style')
		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('admin_files/css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('admin_files/css/skins/default.css') }}" />

		<!-- Head Libs -->
		<script src="{{ asset('admin_files/vendor/modernizr/modernizr.js') }}" ></script>

        <!-- croppie Css -->
		<link type="text/css" rel="stylesheet" href="{{ asset('user_files/js/croppie/croppie.css')}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('admin_files/css/custom.css') }}">
		
		
	</head>
	<body>
	<div class="inner-wrapper">
		<section class="body">
		<!-- start: header 
		include('admin.includes.header')
		<!-- end: header -->
			<?php $user = Auth::user(); ?>
		<!-- start: left_sidebar -->
		@include('admin.includes.left_sidebar')
		<!-- end: left sidebar -->

	    @yield('content')

	
	    <!-- start: left_sidebar -->
		@include('admin.includes.right_sidebar')
		<!-- end: left sidebar -->

		    <!-- start: left_sidebar -->
		@include('admin.includes.comman_modals')
		<!-- end: left sidebar -->

	    </section>
	</div>
<!-- Vendor -->
<script src="{{ asset('admin_files/vendor/jquery/jquery.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{ asset('admin_files/vendor/popper/umd/popper.min.js')}}"></script>
<script src="{{ asset('admin_files/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('admin_files/vendor/common/common.js')}}"></script>
<script src="{{ asset('admin_files/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{ asset('admin_files/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jquery-placeholder/jquery-placeholder.js')}}"></script>
<!-- croppie js -->
<script src="{{ asset('user_files/js/croppie/croppie.min.js')}}"> </script>
<!-- Specific Page Vendor -->
<script type="text/javascript">
	var $uploadCrop;
	var BASE_URL = "{{ url('/') }}";
	var CSRF_TOKEN =  $('meta[name="csrf-token"]').attr('content');
	
</script>

 @yield('site_scripts')
 <script>
	// $(document).ready(function(){
	// 	$(".btn").click(function(){
	// 		var id = $(this).attr('id');
	// 		var text = $(this).text();
	// 		if(id == "store-button" || text == "Update"){
	// 			var data = new FormData($(this).closest('form')[0]);
	// 			var fid = $(this).closest('form').attr('id');
	// 			var furl = $("#"+fid).attr('action');
	// 			var string = data.toString();
	// 			// var url = window.location.href;
	// 			var log = string.concat(furl);
	// 			// var log = url.string.furl;
	// 			$.ajax({
	// 				headers: {
	// 					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 				},
	// 				url:'{{ route('logevent') }}',
	// 				type:'POST',
	// 				data : log ,
	// 				success:function(response) {
	// 					var object = JSON.parse(response)
	// 					if(object != 0){
	// 						return true;
	// 					}else{
	// 						return false;
	// 					}
	// 				}
	// 			});
	// 		}
	// 	});
	// });
</script>
<!-- Theme Base, Components and Settings -->
<script src="{{ asset('admin_files/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{ asset('admin_files/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('admin_files/js/theme.init.js')}}"></script>


<!-- Examples -->
<script src="{{ asset('admin_files/js/examples/examples.dashboard.js')}}"></script>

	 @yield('script')


	</body>
</html>