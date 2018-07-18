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

      <div class="modal fade" id="accept-terms" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h3>license & agreement</h3>
              </div>
            <div class="modal-body" style="text-align: center;">
                <p>
                    What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                </p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success accept-terms" >Akkoord</button>
            </div>
          </div>
        </div>
      </div>
 @yield('site_scripts')
 <script>
    // $(document).ready(function(){
    //  $(".btn").click(function(){
    //      var id = $(this).attr('id');
    //      var text = $(this).text();
    //      if(id == "store-button" || text == "Update"){
    //          var data = new FormData($(this).closest('form')[0]);
    //          var fid = $(this).closest('form').attr('id');
    //          var furl = $("#"+fid).attr('action');
    //          var string = data.toString();
    //          // var url = window.location.href;
    //          var log = string.concat(furl);
    //          // var log = url.string.furl;
    //          $.ajax({
    //              headers: {
    //                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //              },
    //              url:'{{ route('logevent') }}',
    //              type:'POST',
    //              data : log ,
    //              success:function(response) {
    //                  var object = JSON.parse(response)
    //                  if(object != 0){
    //                      return true;
    //                  }else{
    //                      return false;
    //                  }
    //              }
    //          });
    //      }
    //  });
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
<script type="text/javascript">
    
    if(!{{ Auth::user()->accepted_terms }}){
    $("#accept-terms").modal({
    backdrop: 'static',
    keyboard: false
})
    $("#accept-terms").modal("show");
}
$(".btn.accept-terms").click(function(){
    $.ajax({
        url: '{{ url('admin/accept-terms')}}',
        method: "GET",
        success:function(response){
            if(response.status){
                location = window.location.href;
            }else alert("There was an error processing your request. Try back later.")
        }
    });
})
</script>
     @yield('script')


    </body>
</html>
