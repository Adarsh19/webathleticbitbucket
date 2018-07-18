  	<!-- edit gallery modal -->
		<div id="update-image-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header" style="display: block;">
						<button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">
								<span class="fa-stack fa-sm">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-edit fa-stack-1x"></i>
								</span>
							</h4>
						</div>
						<form role="form" id="update_site_images" >
						    <input type="hidden" name="action">
						    <input type="hidden" name="image_type">
						    <input type="hidden" name="id">
						    {{csrf_field()}}
							<div class="modal-body">
								<div class="form-group croppie-container" style="width: 400px; margin-left:190px">
									<div class="croppie-demo" ></div>
								</div>
								<textarea name="base64" id="base64" style="display: none"></textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
								<button type="button" class="btn btn-info btn-flat upload-image-result">@lang('common.update')</button>
							</div>
						</form>
					</div>
				</div>
	    </div>
<!-- /.edit galler