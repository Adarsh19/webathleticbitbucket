
//$(document).ready(function () {
//
//    $('#cartbutton').click(function(){
//        var userid=$('.userbar .userids').val();
//        var url=BASE_URL+"/admin/products/getcart/"+userid;
//        $.ajax({
//            url: url,
//            method: "GET",
//            dataType: "html",
//            success:function(data){
//
//                //$("#updateorderboxModal").modal('show');
//                $("#updateorderboxModal2").modal('show');
//                $("#updateorderboxModal2").html(data);
//                //$('.body').append( $("#updateorderboxModal").html());
//                //$("#updateorderboxModal").css('position','absolute');
//            }
//        });
//
//    });
//});


function loadCart(){
    var userid=$('.userbar .userids').val();
    var url=BASE_URL+"/admin/products/getcart/"+userid;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){

            $("#updateorderboxModal2").html(data);
            $("#updateorderboxModal2").modal('show');


        }
    });
}

function showPayyPopup(userid){
    var userid=$('.userbar .userids').val();
    var url=BASE_URL+"/admin/products/cart/showpaypopup/"+userid;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){


            $("#showPayPopupModal").html(data);
            //$("#showPayPopupModal").appendTo("body");
            $("#showPayPopupModal").modal('show');

        }
    });
}

/**
 * Created by showket on 5/3/18.
 */

function closeupdatecartup(ds) {

    $('#updateorderboxModal2').modal('hide');

}
function paybycash(ds){
    $('.paybtn').removeClass('clickpaybutton');
    $(ds).addClass('clickpaybutton');
    $('.cal').show();
    $('.paybyaccount').hide();
    $('.cancelorder').hide();

}

function paybyaccount(ds){
    $('.paybtn').removeClass('clickpaybutton');
    $(ds).addClass('clickpaybutton');
    $('.cal').hide();
    $('.paybyaccount').show();
    $('.cancelorder').hide();

}
function cancelorder(ds){
    $('.paybtn').removeClass('clickpaybutton');
    $(ds).addClass('clickpaybutton');
    $('.cal').hide();
    $('.paybyaccount').hide();
    $('.cancelorder').show();

}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});







$('.paybycash').click(function(){
    var userid=$('.userbar .userids').val();
    $('.searchresultsbox').html("");
    $('.searchresultsbox').show();
    $('.searchresultsbox').load(BASE_URL+"/products/getcart/"+userid);

});









//
//$('#shopcart').bind('dragleave', function (evt) {
//    var userid=$('.userbar .userids').val();
//    var productid=evt.dataTransfer.getData('product_id');
//
//    var url=BASE_URL+"/admin/products/createorder/"+userid+"/"+productid;
//    $.ajax({
//        url: url,
//        method: "GET",
//        dataType: "json",
//        success:function(data){
//
//            if( typeof data.orderid !== 'undefined') {
//                $('#orderid').val(data.orderid);
//                loadlistproducts(userid);
//                $('.updateOrder').show();
//
//            }else{
//                $('.flash-message').show();
//                $('.flash-message').html('<p class="alert alert-warning"> '+data.message+' <a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
//                function clickclose() {
//                    $('flash-message').hide();
//                }
//            }
//        }
//    });
//
//    evt.stopPropagation();
//    return false;
//});
//
//$('.itempro')
//    .bind('dragend', function (evt) {
//        //evt.dataTransfer.setData('product_id', this.id);
//        //console.log(this.id);
//        //console.log('dragend');
//        //evt.preventDefault();
//    })
//    .bind('dragstart', function (evt) {
//        evt.dataTransfer.setData('product_id', this.id);
//        console.log(this.id);
//        console.log('dragend');
//        evt.preventDefault();
//    })
//    .bind('drag', function (evt) {
//        //console.log('drag');
//
//    });
//
//
//



//$(".searchresultsbox").load(BASE_URL+"/admin/products/loadfromsessioncart");
//loaduserbarproducts(); //loads saved user in session on load

function clickoption_user(ds){

    var html='<li  style="cursor: pointer" >'+$(ds).html()+'</li>';


    $('.userbar_products_ul').html(html)
    $('.searchresultsbox_results').html("");
    $('.searchbaruder').val("");

    var userid=$('.userbar_products_ul .userids').val();

    loadlistproducts(userid);

};


function clickoption(ds){
    var id=$(ds).find('.userids').val();
    var newhtml='   <div class="userid_row" id="userrow_'+id+'"><a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>'+$(ds).html()+"</div>";
    $('.userbar').html(newhtml);
    $('.searchresultsbox').hide();

    var userid=$('.userbar .userids').val();
    loadlistproducts(userid);
};

function addToleft(ds){
    alert();
}


function saveDefaultGroup(ds){
    if ($(ds).is(':checked')) {

        var delflag=0;
    }
    else{
        var delflag=1;
    }

    $.ajax({
        url: BASE_URL+"/admin/products/saveProductSetting/"+delflag,
        method: $('#default-setting-form').attr('method'),
        dataType: "json",
        data:$('#default-setting-form').serialize(),
        success:function(value){

            alert(value);



        }
    });

}


function removeUser(ds){

    var userid=$(ds).parent().parent().find('.userids').val();
    var url=BASE_URL+"/admin/products/removeSessionUsers/"+userid;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(value){
            $("#userrow_"+userid).remove();
            $('.doprul').html("");

        }
    });

}




function loaduserbarproducts(){

    //var userid=$('#user-id').val();
    var url=BASE_URL+"/admin/products/loadusertile/";
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){
            $(".userbar_products").html(data);

               //var userid=$(data).find('#user-id').val();
               var userid=$('.userbar .userids').val();
                //if( typeof userid !== 'undefined'){
                //   loadlistproducts(userid);
                //}

            loadlistproducts(userid);



        }
    });

}




function loadlistproducts(userid){




    var url=BASE_URL+"/admin/products/showpreviouslystoredorders/"+userid;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){
            $(".doprul").html(data);

            $("#totalprice").load(BASE_URL+"/admin/products/cart/calculatetotalprice/"+userid);


        }
    });


}

function channgestock(ds) {


    var val=$(ds).val();
    if(val=="1") {
        $(ds).parent().parent().find('.stockbox').hide();
    }else{
        $(ds).parent().parent().find('.stockbox').show();
    }
}


function openmulipopup() {
    $('.multipleproduct').show();
}
function closemulipopup() {
    $('.multipleproduct').hide();
}

$(document).ready(function(){

    $('#variation').click(function(){
        var box=' <div class="box thumbnail variationbox">'
        box+='<div class="row"><div class="form-group col-md-6">';
        box+='<label for="videoname">Product name</label>';
        box+= '<input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp" placeholder="Enter product name" required>';
        box+='</div>';
        box+='<div class="form-group col-md-6">';
        box+=    '<label for="imagefile">Product Image file</label>';
        box+='<input type="file" name="imagefile[]" class="form-control" required>';
        box+='</div></div>';
        box+='<div class="row"><div class="form-group col-md-6">';
        box+=       '<label for="price">Product Price</label>';
        box+= '<input type="price" name="price[]" class="form-control"  required>';
        box+='</div>';
        box+='<div class="form-group col-md-6">';
        box+=        '<label for="tax">Product Tax</label>';
        box+='<input type="tax" name="tax[]" class="form-control"  required>';
        box+= '</div></div>';
        box+='<div class="row"><div class="form-group col-md-6">';
        box+=       '<label for="stocktype">Stock Type</label>';
        box+='<select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>';

        box+='<option value="1">Unlimited</option>';
        box+=        '<option value="0">Limited</option>';
        box+=       '</select>';

        box+=       '</div>';
        box+=        '<div class="form-group col-md-6 stockbox" style="display: none">';
        box+=        '<label for="stock">Product Stock</label>';
        box+='<input type="number" name="stock[]" class="form-control">';
        box+=' </div></div></div>';
        $('.vary').append(box);

    });

});

