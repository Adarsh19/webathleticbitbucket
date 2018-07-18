<script type="text/javascript">
 jQuery(document).ready(function($){

 	$("#login-form").validate({

		rules: {
			email: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				}
			 },
			password: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				}
			 },
		},
		messages: {
            password : "Dit veld is verplicht"  ,
            email: {
                required: "Dit veld is verplicht",
                email: "Please enter a valid email address.",
            }
        },
		submitHandler: function (form) {

			$('.login-error').html('');

            $.ajax({
                 type: "POST",
                 url: "{{ url('/login')}}",
                 data: $(form).serialize(),
                 success: function (res) {

                 	if(res.status){
                 		 location.href = res.redirect ;
                 	}else{
                 		$('.login-error').text(res.message);
                 	}
                 
                 }
             });
             //return false; // required to block normal submit since you used ajax
        }
	});
	// document end 
 });
</script>