
<script type="text/javascript">

$(document).ready(function(){

        /** Load datatable **/
tinymce.init({ selector:'#edit-content' });
        /** Edit **/
        $(document).on("click", ".edit-client-button i", function(){
            $('#edit-story-modal').modal('show');

            tinymce.get('edit-content').setContent('');

           // tinymce.editors[0].execCommand('mceInsertContent', false, ' ');
            var id = $(this).data("id");
            var url = "{{ url('/stories')}}/"+id;
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                    //$('#edit-story-modal').modal('show');
                    $('#edit-story-modal').modal('show');
					$('#edit-story-id').val(data['id']);
					$('#edit-name').val(data['name']);
					$('#edit-possition').val(data['possition']);
				    tinymce.get('edit-content').execCommand('mceInsertContent', false, data['content']);
					$('#edit-publication-status').val(data['publication_status']);
                }});
        });


		for (var i = 0; i < tinymce.editors.length; i++)
{
    console.log("Editor id:", tinymce.editors[i].id);
}

		/** Update **/
		/** Update **/
		$(".update-button").click(function(){
			var story_id = $('#edit-story-id').val();
            var url = "{{ url('/stories')}}/"+story_id;
			url = url.replace("story_id", story_id);

			var content = tinyMCE.editors['edit-content'].getContent();
			var postData = new FormData($("#story_edit_form")[0]);
			var base64_img = $('#base64').val();
			postData.append('thumb', base64_img);
			postData.append('content', content );
			$( '.name-error' ).html( "" );
			$( '.possition-error' ).html( "" );
			$( '.content-error' ).html( "" );
			$( '.story-featured-image-error' ).html( "" );
			$( '.publication-status-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.name){
							$( '.name-error' ).html( data.errors.name[0] );
						}
						if(data.errors.possition){
							$( '.possition-error' ).html( data.errors.possition[0] );
						}
						if(data.errors.content){
							$( '.content-error' ).html( data.errors.content[0] );
						}
						if(data.errors.story_featured_image){
							$( '.story-featured-image-error' ).html( data.errors.story_featured_image[0] );
						}
						if(data.errors.publication_status){
							$( '.publication-status-error' ).html( data.errors.publication_status[0] );
						}
					}
					if(data.success) {
					    location.reload();
					}
				},
			});
		});
      
      // end gallary 

      /** Edit **/
		$(document).on("click", ".edit-gallery-button i", function(){
			var gallery_id = $(this).data("id");
			var url = "{{ url('/gallery') }}/"+gallery_id;
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					$('#edit-gallery-modal').modal('show');
					$('#edit-gallery-id').val(data['id']);
					$('#edit-caption').val(data['caption']);
					$('#edit-publication-status').val(data['publication_status']);
				}});
		});

		/** Update **/
		$(".update-gallery-button").click(function(){
			var gallery_id = $('#edit-gallery-id').val();
			var url = "{{ url('/gallery') }}/"+gallery_id;
		
			var postData = new FormData($("#gallery_edit_form")[0]);
			
			var base64_img = $('#base64').val();
			postData.append('image_croped', base64_img );

			$( '.caption-error' ).html( "" );
			$( '.image-error' ).html( "" );
			$( '.publication-status-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.caption){
							$( '.caption-error' ).html( data.errors.caption[0] );
						}
						if(data.errors.image){
							$( '.image-error' ).html( data.errors.image[0] );
						}
						if(data.errors.publication_status){
							$( '.publication-status-error' ).html( data.errors.publication_status[0] );
						}
					}
					if(data.success) {
						location.reload();
					}
				},
			});
		});
		//
});
    </script>