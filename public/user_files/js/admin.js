function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

function readFile(input) {
    
            if (input.files && input.files[0]) {
                $('#update-image-modal').modal('show');
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
            console.log(result.src);
           // $('#base64').val(result.src);
           // $('.append_crop_image').find('ul').html("<li><input type='hidden' id='appended_deal_image' name='deal_image' value="+result.src+"/><img src='"+result.src+"' style=' height:220px; width:270px; padding: 5px; border: 1px solid rgb(232, 222, 189);'/><span><img src='"+image+"' class='remove_img' thisImg=''/></span></li>");
           // $('#croppie-model').modal('hide');
        } else {
            alert('Error occured');
        }
    }


$(document).ready(function(){

// image cropee code start here 
           


// Upload image
$(document).on('click','.upload-image-result',function(){

          $uploadCrop.croppie('result', {
          }).then(function (resp) {

            var url = BASE_URL+"/admin/imgage-update";
            var postData = new FormData($("#update_site_images")[0]); //this form is in comman_modsls files
             postData.append('base64_src',resp);
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
          
                    if(data.status) {
                        var img_el = postData.get('image_type'); // Returns "Chris"
                          $('#'+img_el).attr('src',resp);
                          $('#update-image-modal').modal('hide');
                    }
                },
            });

          });
});


/** Update **/
        $(".update-profile-button").click(function(){

            var url = BASE_URL+"/users";

            var postData = new FormData($("#profile-image-form")[0]);

            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
          
                    if(data.errors) {
                        if(data.errors.meta_description){
                            $( '.meta-description-error' ).html( data.errors.meta_description[0] );
                        }
                    }
                    if(data.success) {
                        location.reload();
                    }
                },
            });
        });




// $('.drop-image').each(function(){
//  var id = $(this).attr('id');
//     console.log(id);
//     if(typeof id != "undefined"){
//         addEventsDrop(id);
//     }
// });
   

// document end 
});


// function addEventsDrop(id){

//     var drop = document.getElementById(id);
//     // Tells the browser that we *can* drop on this target
//     addEventHandler(drop, 'dragover', function(e){
//         e.preventDefault();
//         if(!drop.classList.contains("active-drag")){
//          drop.classList.add("active-drag");
//         }
       
//     });
//     addEventHandler(drop, 'dragenter', function(e){
//         e.preventDefault();
//         if(!drop.classList.contains("active-drag")){
//          drop.classList.add("active-drag");
//         }
//     });

//     addEventHandler(drop, 'dragleave', function(e){
//         e.preventDefault();
//         if(drop.classList.contains("active-drag")){
//          drop.classList.remove("active-drag");
//         }
//     });

//     addEventHandler(drop, 'drop', function(e) {
//       e = e || window.event; // get window.event if e argument missing (in IE)   
//       if (e.preventDefault) {
//         e.preventDefault();
//       } // stops the browser from redirecting off to the image.
//      drop.classList.remove("active-drag");

//      initCroppie($('#'+id));

//       var dt = e.dataTransfer;
//       // var files = dt.files;
//       //   var file = files[0];
//       //   var reader = new FileReader();
//         readFile(dt);
//       return false;
//     });
// }



// Function.prototype.bindToEventHandler = function bindToEventHandler() {
//   var handler = this;
//   var boundParameters = Array.prototype.slice.call(arguments);
//   console.log(boundParameters);
//   //create closure
//   return function(e) {
//     e = e || window.event; // get window.event if e argument missing (in IE)   
//     boundParameters.unshift(e);
//     handler.apply(this, boundParameters);
//   }
// };
 

// function addEventHandler(obj, evt, handler) {
//   if (obj.addEventListener) {
//     // W3C method
//     obj.addEventListener(evt, handler, false);
//   } else if (obj.attachEvent) {
//     // IE method.
//     obj.attachEvent('on' + evt, handler);
//   } else {
//     // Old school method.
//     obj['on' + evt] = handler;
//   }
// }


function initCroppie(element){

     var viewport_width = element.attr('viewport-width');
     var viewport_height = element.attr('viewport-height');
     var boundary_width = element.attr('boundary-width');
     var boundary_height = element.attr('boundary-width');

     viewport_width =  (typeof viewport_width == "undefined")?220:viewport_width;
     viewport_height =  (typeof viewport_height == "undefined")?270:viewport_height;

     boundary_width =  (typeof boundary_width == "undefined")?300:boundary_width;
     boundary_height =  (typeof boundary_height == "undefined")?300:boundary_height;

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



// genrate pdf,exl file to server Datatable 

function genrate_file(json_data,file_type){

    /** Update **/
            var url = BASE_URL+"/admin/genrate-file";
            var Data = {
                'rowData' : json_data,
                'file_type' : file_type,
                '_token':  CSRF_TOKEN
            }

            $.ajax({
                type:'POST',
                url: url,
                data : Data,
                success:function(data) {
                    if(data.errors) {
                        if(data.errors.meta_description){
                            $( '.meta-description-error' ).html( data.errors.meta_description[0] );
                        }
                    }
                    if(data.success) {
                        location.reload();
                    }
                },
            });
}


