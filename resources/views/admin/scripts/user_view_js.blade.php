<!-- Specific Page Vendor -->
	<script src="{{ asset('admin_files/vendor/autosize/autosize.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jquery-validation/jquery.validate.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/select2/js/select2.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.js')}}"></script>
	<script src="{{ asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
	<script src="{{ asset('user_files/js/admin.js')}}"></script>

		<script type="text/javascript">
			$(function() {
				$( "#userBirthDay" ).datepicker({ dateFormat: "dd/mm/yy" });
				$( "#klant_sinds" ).datepicker({ dateFormat: "dd/mm/yy" });

				$('#edit-profile-image').on('change',function(){

				});
				$("#profile_edit_form").validate({

					rules: {
						first_name: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						surname: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						email: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						 },
						phone: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						gender: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						birthday: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						iban: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						taal: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						klant_sinds: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						address: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						about: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						role: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						activation_status: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						}
					},
					messages: {
			            first_name: "Dit veld is verplicht",
			            surname : "Dit veld is verplicht" ,
			            gender: "Dit veld is verplicht",
			            phone: "Dit veld is verplicht",
			            birthday: "Dit veld is verplicht",
			            iban: "Dit veld is verplicht",
			            taal: "Dit veld is verplicht",
			            klant_sinds: "Dit veld is verplicht",
			            about: "Dit veld is verplicht",
			            role: "Dit veld is verplicht",
			            activation_status: "Dit veld is verplicht",
			            address: "Dit veld is verplicht",
			            email: {
			                required: "Dit veld is verplicht",
			                email: "Please enter a valid email address.",
			            }
			        },
					submitHandler: function (form) {

			            $.ajax({
			                 type: "POST",
			                 url: "{{ url('admin/users').'/'.$user->id }}",
			                 data: $(form).serialize(),
			                 success: function (res) {
			                  var select_boxs = ['gender','activation_status'];

			                  if(res.success){
			                 		 location.reload();
			                 	}
                 	
			                    if(res.errors != 'undefiled'){
			                     	$.each(res.errors,function(indx,val){

			                     	if(select_boxs.indexOf(indx) == -1){
			                     		$("input[name='"+indx+"']").siblings('.role-error').text(val[0]);
			                     	}else{
			                     		$("#"+indx).siblings('.role-error').text(val[0]);
			                     	}
			                     		
			                     	});
			                     }
			                 }
			             });
			             return false; // required to block normal submit since you used ajax
			         }
				});


$('.icon-edit').on('click',function(){
	var id = $(this).data().id;
	var block_id = $(this).data().block_id;
	$("#update_site_images input[name='action']").val('update_profile_image');
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
                    width: 250,
                    height: 270,
                    type: 'square'
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

			}); // document end 
		</script>