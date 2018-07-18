/* Add here all your JS customizations */
//Open modal with ID
function openModal(id) {
    $('#'+id).modal();
    }

//submit a form against form ID
  function submitForm(id) {
    var datastring = $('#'+id).serialize();
    $.ajax({
        type: "POST",
        url: $("#" + id).attr('action'),
        data: datastring,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
              // showToast('Saved Successfully!', response.message, 'success', '#43ac6a');
              $("#" + id).trigger('reset');
              location.reload();
            } else {
                if(response.errors != 'undefiled'){
                    $.each(response.errors,function(indx,val){

                            $("#"+id+" #"+indx+"-error").text(val[0]);
                        
                    });
                 }
            }

        },
        error: function () {
            //showToast('Not Saved!', 'Error posting comment, please try again!', 'error', '#a94442');
        }
    });

}

//change datatable paging style
try{
   $.extend( true, $.fn.dataTable.defaults, {
             "language": {
                "info": "Weergaven _START_ naar _END_ van de _TOTAL_ resultaten",
                'searchPlaceholder': 'Zoeken',
            }
        } );
}
catch(ex){}

// datatable checkboxes
$(document).on('change','.dataTables_wrapper .datatable-checkbox',function(){
  var el = $(this);
  if(!el.is(':checked')){
    var datatable = el.closest('.dataTables_wrapper');
    datatable.find('.datatable-checkbox-header').prop('checked',false);
  }
});
$(document).on('change','.dataTables_wrapper .datatable-checkbox-header',function(){
  var el = $(this);
  if(el.is(':checked')){
    controlColumnCheckboxes(el,true);
  }
  else{
    controlColumnCheckboxes(el,false);
  }
});
    
