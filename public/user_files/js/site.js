function sideMenu(toggle) {
    if (toggle == 'open') {
        $('.side-menu').css({
            'width': '300px'
        });
    } else {
        $('.side-menu').css({
            'width': '0px'
        });
    }

}


function playServiceVideo() {
    $('.btn-overlay').hide();
    $('.yt')[0].src += "?autoplay=1";
    $('.yt').show();
}

function readFile(input) {
    
            if (input.files && input.files[0]) {
                $('#croppie-model').modal('show');
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

function popupResult(result) {
        if (result.src) {
            $('#base64').val(result.src);
           // $('.append_crop_image').find('ul').html("<li><input type='hidden' id='appended_deal_image' name='deal_image' value="+result.src+"/><img src='"+result.src+"' style=' height:220px; width:270px; padding: 5px; border: 1px solid rgb(232, 222, 189);'/><span><img src='"+image+"' class='remove_img' thisImg=''/></span></li>");
            $('#croppie-model').modal('hide');
        } else {
            alert('Error occured');
        }
    }


 jQuery(document).ready(function($){


  $(document).on('change','#fileinfoo' ,function () {
      var image_hight = $('#image_hight').val();
      var image_width = $('#image_width').val();

      if(image_hight == 0 && image_width == 0 ){
        alert('please provide hight and width before uploading a image.');
        return;
      }else if(image_hight < 0 && image_width < 0 ){
        alert('image hight and width must be positive value.');
        return;
      }else{

          $(this).attr('viewport-width',image_width);
          $(this).attr('viewport-height',image_hight);
          $(this).attr('boundary-width',(parseInt(image_width)+50));
          $(this).attr('boundary-height',(parseInt(image_hight)+50));

          initCroppie($(this));
          var numImages = $(this).length;
          if(numImages == 1){
              readFile(this);
          } else {
              console.log('You can\'t upload more than one image. ');
          }

    }

      
  });

  // update croppie hight width

  $(document).on('change','#image_hight' ,function () {
    initCroppie($(this));
    var numImages = $(this).length;
        // console.log(numImages);
      if(numImages == 1){
          readFile(this);
      } else {
          console.log('You can\'t upload more than one image. ');
      }
  });



        // open modal on image click
        jQuery('.site_images').on('click',function(){

            $("#imageModal").modal();
            var image_data = $(this).data().image_data;
            $.each(image_data,function(key,value){
              $('#site-image-form input[name="'+key+'"]').val(value);
            });
        });
        // close modal event
        $("#imageModal").on("hidden.bs.modal", function () {
           // $('#submit-form-image').reset();
        });
  

        $('#site-image-form').submit(function(e){
          e.preventDefault();
          var url = BASE_URL+"/updateImages";
          var formdata = new FormData(this);
          var base64_img = $('#base64').val();
          formdata.append('image_croped', base64_img );

              $.ajax({
                 type:'POST',
                 url:url,
                 data: formdata,
                 contentType: false,
                 cache: false,
                 processData:false,
                 success:function(data){
                   $('#base64').val('');
                   $('#fileinfoo').val();
                  if (data.status === 1) {
                 // $('#msgtxt').html('<span style="color: green;">Image is changed successfully</span>');
                   location.reload();
                  }else if(!data.status){
                   $('#msgtxt').html('<span style="color: red;">Something went wrong! Please try again later.</span>');
                  }else if(data.status === 2){
                    $.each(res.errors,function(indx,val){
                          $("#"+indx).siblings('.role-error').text(val[0]);
                      });
                  }
                 },
              });
              
          });


     tinymce.init({ selector:'#edit-page-content' });

    /** Edit **/
        $('.footer-links .client-edit').on('click',function(){
            var page_id = $(this).data("id");
            var url = BASE_URL+"/pages/"+page_id;
            tinymce.get('edit-page-content').setContent(' ');
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                    $('#edit-page-modal').modal('show');
                    $('#edit-page-id').val(data['id']);
                    $('#edit-page-name').val(data['page_name']);
                    $('#edit-page-slug').val(data['page_slug']);
                    tinymce.get('edit-page-content').setContent(data['page_content']);
                    $('#edit-publication-status').val(data['publication_status']);
                    $('#edit-meta-title').val(data['meta_title']);
                    $('#edit-meta-keywords').val(data['meta_keywords']);
                    $('#edit-meta-description').val(data['meta_description']);
                }});
        });

// console.log(tinymce.editors.length);

/** Update **/
        $(".update-page-button").click(function(){

            var page_id = $('#edit-page-id').val();
            var url = BASE_URL+"/pages/"+page_id;
            var content = tinyMCE.editors['edit-page-content'].getContent();

            var postData = new FormData($("#page_edit_form")[0]);

            var base64_img = $('#base64').val();
            postData.append('image_croped', base64_img );

            postData.append('page_content', content );
            $( '.page-name-error' ).html( "" );
            $( '.page-slug-error' ).html( "" );
            $( '.page-content-error' ).html( "" );
            $( '.page-featured-image-error' ).html( "" );
            $( '.publication-status-error' ).html( "" );
            $( '.meta-title-error' ).html( "" );
            $( '.meta-keywords-error' ).html( "" );
            $( '.meta-description-error' ).html( "" );
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                   
                    if(data.errors) {
                        if(data.errors.page_name){
                            $( '.page-name-error' ).html( data.errors.page_name[0] );
                        }
                        if(data.errors.page_slug){
                            $( '.page-slug-error' ).html( data.errors.page_slug[0] );
                        }
                        if(data.errors.page_content){
                            $( '.page-content-error' ).html( data.errors.page_content[0] );
                        }
                        if(data.errors.page_featured_image){
                            $( '.page-featured-image-error' ).html( data.errors.page_featured_image[0] );
                        }
                        if(data.errors.publication_status){
                            $( '.publication-status-error' ).html( data.errors.publication_status[0] );
                        }
                        if(data.errors.meta_title){
                            $( '.meta-title-error' ).html( data.errors.meta_title[0] );
                        }
                        if(data.errors.meta_keywords){
                            $( '.meta-keywords-error' ).html( data.errors.meta_keywords[0] );
                        }
                        if(data.errors.meta_description){
                            $( '.meta-description-error' ).html( data.errors.meta_description[0] );
                        }
                    }
                    if(data.success) {
                        //location.reload();
                    }
                },
            });
        });


// image cropee code start here 
           
$(document).on('change','.crope_this_image' ,function () {
    
    initCroppie($(this));

    var numImages = $(this).length;
        // console.log(numImages);
      if(numImages == 1){
          readFile(this);
      } else {
          console.log('You can\'t upload more than one image. ');
      }
});

    $(document).on('click','.upload-cropeie-result',function(){
            $uploadCrop.croppie('result', {
            }).then(function (resp) {
                popupResult({
                    src: resp,
                });
            });
    });


$('.drop-image').each(function(){
  var id = $(this).attr('id');
  if(typeof id != "undefined"){
      addEventsDrop(id);
  }
});
   

// cropee end 

// document end 
});


function addEventsDrop(id){

    var drop = document.getElementById(id);
    // Tells the browser that we *can* drop on this target
    addEventHandler(drop, 'dragover', function(e){
        e.preventDefault();
        if(!drop.classList.contains("active-drag")){
         drop.classList.add("active-drag");
        }
       
    });
    addEventHandler(drop, 'dragenter', function(e){
        e.preventDefault();
        if(!drop.classList.contains("active-drag")){
         drop.classList.add("active-drag");
        }
    });

    addEventHandler(drop, 'dragleave', function(e){
        e.preventDefault();
        if(drop.classList.contains("active-drag")){
         drop.classList.remove("active-drag");
        }
    });

    addEventHandler(drop, 'drop', function(e) {
      e = e || window.event; // get window.event if e argument missing (in IE)   
      if (e.preventDefault) {
        e.preventDefault();
      } // stops the browser from redirecting off to the image.
     drop.classList.remove("active-drag");

     initCroppie($('#'+id));

      var dt = e.dataTransfer;
      // var files = dt.files;
      //   var file = files[0];
      //   var reader = new FileReader();
        readFile(dt);
      return false;
    });
}



Function.prototype.bindToEventHandler = function bindToEventHandler() {
  var handler = this;
  var boundParameters = Array.prototype.slice.call(arguments);
  //create closure
  return function(e) {
    e = e || window.event; // get window.event if e argument missing (in IE)   
    boundParameters.unshift(e);
    handler.apply(this, boundParameters);
  }
};
 

function addEventHandler(obj, evt, handler) {
  if (obj.addEventListener) {
    // W3C method
    obj.addEventListener(evt, handler, false);
  } else if (obj.attachEvent) {
    // IE method.
    obj.attachEvent('on' + evt, handler);
  } else {
    // Old school method.
    obj['on' + evt] = handler;
  }
}


function initCroppie(element){

     var viewport_width = element.attr('viewport-width');
     var viewport_height = element.attr('viewport-height');
     var boundary_width = element.attr('boundary-width');
     var boundary_height = element.attr('boundary-height');

     viewport_width =  (typeof viewport_width == "undefined")?220:viewport_width;
     viewport_height =  (typeof viewport_height == "undefined")?270:viewport_height;

     boundary_width =  (typeof boundary_width == "undefined")?300:boundary_width;
     boundary_height =  (typeof boundary_height == "undefined")?300:boundary_height;

     if(viewport_width > 700){
      $('#croppie-model .modal-lg').addClass('large-image');
     }else{
      $('#croppie-model .modal-lg').removeClass('large-image');
     }
     

     $('.croppie-demo').croppie('destroy');

        $uploadCrop = $('.croppie-demo').croppie({
                enableExif: true,
                showZoomer: true,
                enableZoom: true,
                mouseWheelZoom: false,
                enforceBoundary: false, 
                orientation :true,
                viewport: {
                    width: viewport_width,
                    height: viewport_height,
                    type: 'square'
                },
                boundary: {
                    width: boundary_width,
                    height: boundary_height
                }
          });
}



