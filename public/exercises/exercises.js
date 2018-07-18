/**
 * Created by showket on 5/3/18.
 */





$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var draggrop_id="";





$('#cart').bind('dragleave', function (evt) {
    //console.log(evt);
});



$('.itemp')
    .bind('dragstart', function (evt) {

        $('.cart').fadeIn();
        draggrop_id = "EXERCISSE#" + this.id


    });
$('.itemp')
    .bind('dragend', function (evt) {

        $('.cart').fadeOut();


    });





function scheduleboxdrg(ds) {
    draggrop_id="SCHEDULE#"+$(ds).attr('id')

    $('.cart').fadeIn();
    console.log($(ds).attr('id'));
    //alert("sch" + this.id)
    //evt.dataTransfer.setData('scheduleid', this.id);
    //evt.dataTransfer.setData('type', "schedule");



}

function scheduledragend(ds){
    $('.cart').fadeOut();
}





function allowDrop(ev) {
    ev.preventDefault();
}

//function drag(evt) {
//    console.log(evt.__id__);
//    evt.dataTransfer.setData('text', this.id);
//    //evt.dataTransfer.setData('price', $("#"+this.id).find('.pforprice').html());
//    //evt.dataTransfer.setData('tax', $("#"+this.id).find('.tax').html());
//}



function drop(evt) {

    //var scheduleid = evt.dataTransfer.getData("scheduleid");
    var sp=draggrop_id.split("#");
    //console.log($(evt));

    //console.log(id);
    //if($(evt).attr('id')==sp[1]){
    //    console.log("Trying to drag drop on same group");
    //    return false;
    //}
    if(sp[0] == "SCHEDULE") {
        //console.log("SCHEDULE "+scheduleid);
        var scheduleid=sp[1];

        var userids="";
        $('.userbar .userids').each(function (index, value) {
            userids+=$(this).val()+",";
        });


        if ($('.userbar .userids').length == 0) {
            showexerciseview();
            $('.flash-message').show();

            $('.flash-message').html('<p class="alert alert-error"> Please choose user/ users to assign predefined schema<a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
            $("html, body").animate({ scrollTop: 0 }, 600);

            return;
        }

        addpredefinedSchedule(scheduleid,userids);
        evt.stopPropagation();
        return false;
    }else{
        var productid = sp[1];
        createSchedule(productid);

    }
}






//$(".searchresultsbox").load(BASE_URL+"/admin/exercises/load-training-schedules");
//loaduserbar(); //loads saved user in session on load





function createSchedule(productid){



    var userids=null+",";
    $('.userbar .userids').each(function (index, value) {
        userids+=$(this).val()+",";
    });

    var url=BASE_URL+"/admin/exercises/createschedule/"+userids+"/"+productid;

    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success:function(value){
            var userids="";
            $.each(value, function(key,data) {
                //alert(data.status);

                if( typeof data.schedule_id !== 'undefined') {
                    $('.schedule_id').val(data.schedule_id);
                    userids+=data.userid+",";

                }
                $('.flash-message').show();
                var type="success";
                if(data.status=="error")
                    type="warning";
                $('.flash-message').html('<p class="alert alert-'+type+'"> '+data.message+' <a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
                $("html, body").animate({ scrollTop: 0 }, 600);




            });
            loadlist(userids)


        }
    });
}

function addpredefinedSchedule(scheduleid,userids){




    var url=BASE_URL+"/admin/exercises/addpredefinedchedule/"+userids+"/"+scheduleid;

    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success:function(value){
            var userids="";
            $.each(value, function(key,data) {

                //if( typeof data.schedule_id !== 'undefined') {
                //    $('.schedule_id').val(data.schedule_id);
                //    userids+=data.userid+",";
                //
                //}
                $('.flash-message').show();
                var type="success";
                if(data.status=="error")
                    type="warning";
                $('.flash-message').html('<p class="alert alert-'+type+'"> '+data.message+' <a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
                $("html, body").animate({ scrollTop: 0 }, 600);




            });




        }
    });


    loadAddedSchemalist(userids);

}

function loadAddedSchemalist(userids){



        var url=BASE_URL+"/admin/exercises/schema/loadAddedSchema/"+userids;

        $.ajax({
            url: url,
            method: "GET",
            dataType: "html",
            success:function(data){
                $('.schedulelistinner').html(data);
            }
        });


}

function clickclose() {

    $('flash-message').hide();
}

function clickoptionUserExercises(ds){
    var id=$(ds).find('.userids').val();

    if($("#userrow_"+id).length==0){

        var newhtml='<li style="cursor: pointer" id="userrow_'+id+'"><a class="close closebtn"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>'+$(ds).html()+"</li>";
        $('.addUsersHere').append(newhtml);

        var count=$('.addUsersHere li').length;
        $('.counthere').html(count);
        var userids="";
        $('.userbar .userids').each(function (index, value) {
            userids+=$(this).val()+",";
        });

        var url=BASE_URL+"/admin/exercises/updateSessionUsers/"+userids;
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success:function(value){
                // console.log(value);

            }
        });


        $(ds).find('.profile').addClass('selectedrow');
        var userid=$('#user-id').val();
        loadlist();
    }

//<li style="cursor: pointer">

    //var newhtml='   <div class="userid_row" id="userrow_'+id+'"><a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>'+$(ds).html()+"</div>";


    //$('.searchresultsbox').show();




};

function removeUser(ds){

    var userid=$(ds).parent().parent().find('.userids').val();


    var url=BASE_URL+"/admin/exercises/removeSessionUsers/"+userid;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(value){
            $(ds).parent().parent().remove();

            var userids=null+",";
            $('.userbar .userids').each(function (index, value) {
                userids+=$(this).val()+",";
            });

            var cc=$('.addUsersHere li').length;
            $('.counthere').html(cc);

            loadlist();

        }
    });

}

function closeuserlist(){
    $('.search_users_exercises').html("");
}

function chagesaveAction(ds){
    if($(ds).val()==0){
        $('.daysmul').show();
        $('.startdate').show();
        $('.enddate').hide();
    }else{
        $('.daysmul').hide();
        $('.startdate').show();
        $('.enddate').show();
    }

}

function loaduserbar(){
    var url=BASE_URL+"/admin/exercises/load-user-session";
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){
            $(".userbar").html(data);

              // var userid=$(data).find('#user-id').val();

                //if( typeof userid !== 'undefined')
                {


                    searchbarKeyup();
                   loadlist();
                }
        }
    });

}

function addtoSchema(productid){


    createSchedule(productid);

}


function loadlist(){

    var userids=null+",";
    $('.userbar .userids').each(function (index, value) {
        userids+=$(this).val()+",";
    });

    if( typeof userids === 'undefined'){
        userids=null;
    }
        var url=BASE_URL+"/admin/exercises/show-schedules/"+userids;
        $.ajax({
            url: url,
            method: "GET",
            dataType: "html",
            success:function(data){
                $(".doprul").html(data);
                //$("#totalprice").load(BASE_URL+"/cart/calculatetotalprice/"+userid);
            }
        });




}



function searchPrdefinedResults(ds){
    var keyword=$(".search_keyword").val();
    var url=BASE_URL+"/admin/exercises/loadPredefinedSchemaFilter/"+keyword;
    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){
            $('.predefinedgrid').html(data);
        }
    });
}


function showexerciseview(){

    $('.sortablediv').show();
    $('.schedulelist').hide();
    $('.exercises-grid').show();
    $('.predefined-schema-grid').hide();
    $('.sortablebuttons').show();

}

function showpredefinedview(){

    $('.sortablediv').hide();
    $('.schedulelist').show();
    $('.exercises-grid').hide();
    $('.predefined-schema-grid').show();
    $('.sortablebuttons').hide();

    //if ($('.userbar .userids').length == 0) {
    //    $('.flash-message').show();
    //    $('.flash-message').html('<p class="alert alert-error"> Please choose user/ users to assign predefined schema<a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
    //    $("html, body").animate({ scrollTop: 0 }, 600);
    //
    //    return;
    //}else
    {
        var url=BASE_URL+"/admin/exercises/loadPredefinedSchema";
        $('.exerciseView').hide();
        $('.predefinedschemasView').show();
        $.ajax({
            url: url,
            method: "GET",
            dataType: "html",
            success:function(data){
                $('.predefinedgrid').html(data);

                var userids=null+",";
                $('.userbar .userids').each(function (index, value) {
                    userids+=$(this).val()+",";
                });
                loadAddedSchemalist(userids);


            }
        });

    }


}

function showCarosel(scheduleid){
    //if($('.appedbox').length==0){
    //    var html='<div class="appedbox box box-success"><div class="box-header with-border"><h3 class="box-title">Exercise name</h3></div><div class="box-body no-padding"><div class="row"> </div></div></div>';
    //    $(ds).parent().parent().parent().append(html);
    //}

    var url=BASE_URL+"/admin/exercises/loadPredefinedSchema/exercise/"+scheduleid;

    $.ajax({
        url: url,
        method: "GET",
        dataType: "html",
        success:function(data){
            $('#carosselModal').modal('show');
            $(".contenthere").html(data);
        }
    });


}





function searchFilter() {

    var form_filter_data=$('.filterform').serialize();

    var formData = {
        'goal'              : $('input[name=goal]').val(),
        'traininglevel'             : $('input[name=traininglevel]').val(),
        'musclegroupname'    : $('input[name=musclegroupname]').val(),
        'materiallevel'    : $('input[name=materiallevel]').val()
    };

    $('.rotator').show();
    var url=BASE_URL+"/admin/exercises/search/filter";

    $.ajax({
        url: url,
        method: "POST",
        data: form_filter_data,
        dataType: "html",
        success:function(data){
            $(".appendgrid").html(data);
            $('.rotator').hide();
        }
    });
}



function searchbarKeyup(){
    $(".searchbaruder").keyup(function () {



        if ($(".searchbaruder").val().trim().length == 0) {
            return;
        }

        if($('#sortable .info-box').length>0){

            //showexerciseview();
            $('.flash-message').show();

            $('.flash-message').html('<p class="alert alert-error"> Please save/delete the previously added schedule, That has been added for Admin <a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
            $("html, body").animate({ scrollTop: 0 }, 600);


            return;

        }
        $('.search_users_exercises').show();
        //$('.searchresultsbox').show();

        var keyword = $(this).val();
        var url = BASE_URL+"/admin/exercises/search-user/"+keyword;
        url = url.replace("keyword", keyword);
        $.ajax({
            url: url,
            method: "GET",
            dataType: "html",
            success: function (data) {
                $('.search_users_exercises').html(data);

            }
        });

    });
}

function showexercisesweightgrid(json,eid){


    var parsej="";
    if(json.trim().length !=""){
         parsej=$.parseJSON(json);
    }


    console.log(parsej);
    var sets=$('#sets'+eid).val();
    var reps=$('#reps'+eid).val();
    // var length=parsej.length;

    console.log(sets+" "+reps);

    var length = Object.keys(parsej).length;

    var html_table='<table class="table table-responsive-md mb-0 tab-det'+eid+'" style="width: 100%; "><tbody>';
    var val="";
    for(var i=0;i<sets;i++){
        html_table+='<tr>';
        var ind=i + 1;
        html_table += '<td>Set '+ind+'</td>';
        for(var j=1;j<=reps;j++) {


            if( typeof parsej[i] !== 'undefined' || parsej != ''){
                if( typeof parsej[i][j] !== 'undefined'){
                    val=parsej[i][j];
                }
            }
            if(length-1==i)
            {


               val="";
            }


            html_table += '<td><input type="text" class="form-control" value="'+val+'" onkeyup="onChangeAnyWeightOrNote()"> </td>';
        }
        html_table+='</tr>';
    }

    html_table+='<tr><td>Note</td>';
    var note="";
    if(parsej != '') {
         note = parsej[length - 1][1];
    }
    html_table+='<td colspan="'+reps+'" ><input onkeyup="onChangeAnyWeightOrNote('+eid+')" value="'+note+'" type="text" name="note" class="form-control"> </td>';
    html_table+='</tr>';
    html_table+='</tbody>';
    html_table+='</table>';

    console.log(html_table);
    $('#table-contents'+eid).html(html_table);



    var json=html2json(eid);
    $('.ex_meta'+eid).val(json);
    console.log(json);
}

function onChangeAnyWeightOrNote(eid){
    var json=html2json(eid);
    $('.ex_meta'+eid).val(json);
}


function html2json(eid) {
    var json = '{';
    var otArr = [];

    var tbl2 = $('.tab-det'+eid+' tr').each(function(i) {
        x = $(this).children();
        var itArr = [];
        x.each(function() {
            if( typeof $(this).find('.form-control').val() === 'undefined')
            itArr.push('"' + $(this).text()  + '"');
            else
            itArr.push('"' + $(this).find('.form-control').val() + '"');
        });
        otArr.push('"' + i + '": [' + itArr.join(',') + ']');
    })
    json += otArr.join(",") + '}'

    return json;
}




$(document).ready(function(){


    //window.onscroll = function() {myFunction()};
    //
    //function myFunction() {
    //    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
    //        $("#cart").addClass("markfixed");
    //    }else{
    //        $("#cart").removeClass("markfixed");
    //    }
    //}





    $('.sortable_exercises_added').sortable().bind('sortupdate', function(e) {

        console.log("update save orders here");
        console.log(this);
    });


    var lists_to_connect="";
    $( ".slides .connectedSortable" ).each(function( index ) {
        lists_to_connect+="#"+$( this ).attr('id') +",";
    });

    var trim = lists_to_connect.replace(/(^,)|(,$)/g, "") +",#cart";

    //$(trim).sortable({
    //    zIndex: 9999999999
    //    //connectWith: '.connectedSortable',
    //    //over: function (event, ui) {
    //    //    outside = false;
    //    //},
    //    //out: function (event, ui) {
    //    //    uiout=ui;
    //    //    eventout=event;
    //    //    outside = true;
    //    //},
    //    //beforeStop: function (event, ui) {
    //    //    if (outside) {
    //    //        console.log(uiout);
    //    //
    //    //    }
    //    //}
    //});




    loaduserbar();

});

