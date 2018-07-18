 <section class="login-modal-bg">

<div id="imageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <form id="site-image-form"  enctype="multipart/form-data" method="post">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Image</h4>
      </div>
      <div class="modal-body">
    
            <input type="hidden" name="_token" id="tokenn" value="{{ csrf_token() }}">

            <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" id="image-name" style="display: block;" required="required" placeholder="Image Name" />
                          <span class="text-danger role-error"></span>
                        </div>

                        <div class="form-group col-md-6">
                           <label for="title">Title</label>
                           <input type="text" name="title"  class="form-control" id="image-title" style="display: block;" placeholder="Image Title" required="required" />
                          <span class="text-danger role-error"></span>
                        </div>
             </div>

              <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="image_hight">Image Hight <small>(pix)</small></label>
                          <input type="number" name="image_hight" class="form-control" id="image_hight" style="display: block;" required="required" />
                          <span class="text-danger role-error"></span>
                        </div>

                        <div class="form-group col-md-6">
                           <label for="image_width">Image Width <small>(pix)</small></label>
                           <input type="number" name="image_width"  class="form-control" id="image_width"  />
                          <span class="text-danger role-error"></span>
                        </div>
              </div>
 
             <div class="form-group">
                <label for="image">Description <small>(optional)</small></label>
                <input type="text" name="description" placeholder="Description" class="form-control"  id="description" />
            </div>

             <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" class="form-control" name="image"  id="fileinfoo"  />
                <input type="hidden" name="id" id="id" />
            </div>
            
       
        <div style="display: block;text-align: center;">
            <p id="msgtxt"></p>
        </div>
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                <button type="submit" class="btn btn-info btn-flat update-button">@lang('common.update')</button>
              </div>
       </form>
    </div>

  </div>
</div>



    <!-- edit gallery modal -->
    <div id="croppie-model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
            <form role="form" >
              <div class="modal-body">
                <div class="form-group croppie-container" >
                  <div class="croppie-demo" ></div>
                </div>
                <textarea name="base64" id="base64" style="display: none"></textarea>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                <button type="button" class="btn btn-info btn-flat upload-cropeie-result">@lang('common.update')</button>
              </div>

            </form>

          </div>
        </div>
      </div>
      <!-- /.edit gallery modal -->

</section>