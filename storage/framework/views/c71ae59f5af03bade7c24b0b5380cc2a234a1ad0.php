	<!-- Specific Page Vendor -->
	<script src="<?php echo e(asset('admin_files/vendor/select2/js/select2.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/media/js/dataTables.bootstrap4.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')); ?>"></script>
    <!-- Form --> 
    <script src="<?php echo e(asset('admin_files/vendor/jquery-validation/jquery.validate.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/select2/js/select2.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')); ?>"></script>
   	<script src="<?php echo e(asset('admin_files/vendor/pnotify/pnotify.custom.js')); ?>"></script>

   	<script src="<?php echo e(asset('user_files/js/admin.js')); ?>"></script>
   	<!-- Daterangepicker js -->
	<script src="<?php echo e(asset('admin_files/daterangepicker/moment.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/daterangepicker/daterangepicker.min.js')); ?>"></script>
   	<!-- Chart js -->
   	<script src="<?php echo e(asset('admin_files/vendor/chartist/chartist.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('admin_files/js/examples/examples.charts.js')); ?>"></script> -->

	<!-- Examples -->
	<!-- <script src="<?php echo e(asset('admin_files/js/examples/examples.modals.js')); ?>"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJvNlD0UnIszNiq25gqd-ua1-C6igw_mU&libraries=places"></script>
   
<script type="text/javascript">
function datatableCheckbox(id, checkin=false, type="user"){
	var checkbox = '<input type="checkbox" class="datatable-checkbox" data-type="'+type+'" value="'+id+'"/> ';
	if(!checkin){
		checkbox = '<i class="fa fa-hand-paper-o" style="font-size:16px; top:-2px;left:-2px;" data-id="'+id+'"></i> '+checkbox;
	}
	return checkbox;
}
function datatableCheckboxHeader(){
	var checkbox = '<input type="checkbox" class="datatable-checkbox-header"/>';
	return checkbox;
}
function controlColumnCheckboxes(el,type){
	if(typeof type === 'undefined')
		type = true;
	var datatable = el.closest('.dataTables_wrapper');
	if(type){
		datatable.find('.datatable-checkbox').prop('checked',true);
	}
	else{
		datatable.find('.datatable-checkbox').prop('checked',false);
	}
}
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

var options = {
 	axisY:{ 
	 // If low is specified then the axis will display values explicitly down to this value and the computed minimum from the data is ignored
	  low: 0,
	  // Can be set to true or false. If set to true, the scale will be generated with whole numbers only.
	  onlyInteger: true
	}
};

function lineGraph(graphid,data, options,colors=[]) {
	
	var defaultColors = ["#0088cc", "#47a447", "#d2322d", "#5bc0de", "#ed9c28"];
	if(colors.length == 0) colors = defaultColors;
    if( $('#'+graphid).get(0) ) {
    
        chart = new Chartist.Line('#'+graphid, {
            labels: data['labels'],
            series: data['series']
        },options);
    }
    chart.on('draw', function(context) {

			if(context.type=="line" && typeof colors[context.index] != "undefined"){
				context.element.attr({
				      style: 'stroke: '+colors[context.index]
				    });
		  	}
		  	if(context.type=="point" && typeof colors[context.seriesIndex] != "undefined"){
				context.element.attr({
				      style: 'stroke: '+colors[context.seriesIndex]
				    });
		  	}
});
}
	var start = moment().subtract(7, 'days');
    var end = moment();
    function garphdata(start, end){
    	var link="<?php echo e(route('admin.dashboardGraph',['startdate'=>'sdate','enddate'=>'edate','type'=>'user'])); ?>";
    	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    	link=link.replace('sdate',start.format('YYYY-MM-DD'));
    	link=link.replace('edate',end.format('YYYY-MM-DD'));
    	$.get(link, function(data, status){
	   		$.each( data, function( key, value ) {
                lineGraph('ChartistSimpleLineChart2',value[0],options);     
            });

	    });
    }
        
    var map ;
 	(function($) {

 		google.maps.event.addDomListener(window, 'load', function () {
	        var places = new google.maps.places.Autocomplete(document.getElementById('address'));
	        google.maps.event.addListener(places, 'place_changed', function () {
	            
	            var components=this.getPlace().address_components,city='n/a';
			      if(components){
			        for(var c=0;c<components.length;++c){
			          if(components[c].types.indexOf('locality')>-1
			              &&
			             components[c].types.indexOf('political')>-1
			            ){
			            city=components[c].long_name;
			            break;
			          }
			        }
			      }
			    $('#city').val(city);
	            var place = places.getPlace();
	            var city = place.name;
	            var lat = place.geometry.location.lat();
	            var lng = place.geometry.location.lng();
	            $('#latitude').val(lat);
	            $('#longitude').val(lng);
	        });
	    });

	     google.maps.event.addDomListener(window, 'load', function () {
	        var places = new google.maps.places.Autocomplete(document.getElementById('update-address'));
	        google.maps.event.addListener(places, 'place_changed', function () {
	        	var components=this.getPlace().address_components,city='n/a';
			      if(components){
			        for(var c=0;c<components.length;++c){
			          if(components[c].types.indexOf('locality')>-1
			              &&
			             components[c].types.indexOf('political')>-1
			            ){
			            city=components[c].long_name;
			            break;
			          }
			        }
			      }
	            var place = places.getPlace();
	            $('#update-city').val(city);
	            var city = place.name;
	            var lat = place.geometry.location.lat();
	            var lng = place.geometry.location.lng();
	            $('#update-latitude').val(lat);
	            $('#update-longitude').val(lng);
	        });
	    });


	function initMap() {
         map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {lat: 52.379189, lng: 4.899431}
        });
        setMarkers(map);
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var beaches = <?php echo json_encode($users, 15, 512) ?>;

      function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
          url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
       scaledSize: new google.maps.Size(40, 40), // scaled size
	    origin: new google.maps.Point(0,0), // origin
	    anchor: new google.maps.Point(0, 0) // anchor
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {

            var beach = beaches[i];
            if(beach.latitude != null && beach.longitude.length != null ){

            if(beach.gender){
            	image.url = BASE_URL+'/images/map/icon-'+beach.gender+'.png'
            }

            var marker = new google.maps.Marker({
	            position: {lat: parseFloat(beach.latitude), lng: parseFloat(beach.longitude)},
	            map: map,
	            icon: image,
	            shape: shape,
	            title: beach[0],
	            zIndex: beach[3]
            });
          }
        }
      }

initMap();

var select_html= '<button class="btn btn-info btn-md hvr-grow-shadow add-user-form pull-right" href="#add-user-modal" data-toggle="modal"><i class="fa fa-user"></i> Add User</button>';
	select_html+= '<a class="btn btn_stattus btn-force btn-warning btn-md hvr-grow-shadow pull-right" href="<?php echo e(route('admin.user_status.index')); ?>"><i class="fa fa-magic"></i>Status</a>';

	select_html+= '<div class="pull-right"><span style="width:auto;line-height:2.5;padding:0;"> Status </span> <select class="form-control user_status_filter" >';
    // select_html+= '<option> Item 1</option>';
    select_html+= '<option value="">Select</option>';
       
    <?php $__currentLoopData = $user_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	select_html+= '<option value="<?php echo e($user_status->id); ?>"><?php echo e($user_status->status); ?></option>';
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    select_html+= '</select></div>';

    var datatableInitCount = 0;
	var datatableInit = function(type,typeOriginal,objArg) {
		var columnRenders = [];
		columnRenders['default'] = [
			            { "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
			            // { "data": "name", "title":'Voornaam' },
			            { "render": function(data, type, user){
			            		return '<a href="'+BASE_URL +'/admin/users/view/'+user.id+'">'+user.name+'</a>'
			            	}, 
			            	"title":'Voornaam' },
			            { "render": function(){return ""}, "title":'Achternaam' },
			            { "render": function(){return "" /*package*/}, "title":'Lidmaatschap' },
			            // { "data": "pro_account", "title":'ID' },
			            { "render": function(data, type, user){
			            	var btn = '';
			            	var value = user.installed_app;
			            	if(typeof value !== undefined){
			            		value = parseInt(value);
			            		if(value == 1)
				            		btn = '<i class="fa fa-check text-success"></i>';
				            	else
				            		btn = '<i class="fa fa-remove text-danger"></i>';
				            }
			            	return btn;
			             /*installed_app*/}, "title":'App' },
			            { "render": function( data, type, user){
			            	var btn = '';
			            	var value = user.browser_extension;
			            	if(typeof value !== undefined){
			            		value = parseInt(value);
			            		if(value == 1)
				            		btn = '<i class="fa fa-check text-success"></i>';
				            	else
				            		btn = '<i class="fa fa-remove text-danger"></i>';
				            }
			            	return btn;
			             /*browser_extension*/}, "title":'Spaarhulp' },
			            { "render": function(){return ""}, "title":'€' },
			            {  "render": function(){return "" /*start_date*/}, "title":'Lidsinds' },
			            {  "render": function(){return "" /*last_date_visit*/}, "title":'Laatste bezoek' },
			            { "render": function ( data, type, user) {
			            	// console.log(data, type, user);
                        return '<button type="button" class="btn btn-primary btn-xs edit-user-button" data-userdata=\''+JSON.stringify(user)+'\'><i class="fa fa-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-xs btn-success view-user-button" data-id="'+user.id+'" ><i class="fa fa-eye" aria-hidden="true"></i></button><button class="btn btn-danger btn-xs delete-user-button" data-id="'+user.id+'" ><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-success btn-xs check-in-user" data-id="'+user.id+'" ><i class="fa fa-check" aria-hidden="true"></i></button>';
                            },

                            "title" : 'Actions'
                        }
			        ];
		columnRenders['company'] = [
			            // { "data": "id", "title":'ID' },
			            { "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
			            // { "data": "name", "title":'Voornaam' },
			            { "render": function(data, type, user){
			            		return '<a href="'+BASE_URL +'/admin/users/view/'+user.id+'">'+user.name+'</a>'
			            	}, 
			            	"title":'Voornaam' },
			            { "render": function(){return ""}, "title":'Achternaam' },
			            { "data": "role", "title":'Functie' },
			            {  "render": function(){return "" /*last_date_visit*/}, "title":'Laatste bezoek' },
			            { "render": function ( data, type, user) {
                        return '<button type="button" class="btn btn-primary btn-xs edit-user-button" data-userdata=\''+JSON.stringify(user)+'\'><i class="fa fa-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-xs btn-success view-user-button" data-id="'+user.id+'" ><i class="fa fa-eye" aria-hidden="true"></i></button><button class="btn btn-danger btn-xs delete-user-button" data-id="'+user.id+'" ><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger btn-xs favorite-user-button" data-id="'+user.id+'" hidden></button><button class="btn btn-danger btn-xs mail-user-button" data-id="'+user.id+'" hidden></button><button class="btn btn-danger btn-xs block-user-button" data-id="'+user.id+'" hidden></button>';
                            },
                            "title" : 'Actions'
                        }
			        ];
		columnRenders['access'] = [
			            { "render": function(){return ""}, "title":'totaal' },
			            { "data": "name", "title":'Name' },
			            { "render": function(){return ""}, "title":'Ingecheckt' },
			            { "render": function(){return ""}, "title":'locatie' },
			            {  "render": function(){return ""}, "title":'credites' },
			            { "render": function(){return ""}, "title" : 'bericht' }
			        ];
		columnRenders['checkin'] = [
			           { "render": function(data, type, user){return datatableCheckbox(user.id, true, "checkin")}, "title":datatableCheckboxHeader() },
			           { "data": "username", "title":'Lid'},
			            { "data": "checkDate", "title":'Check-in tijd'},
			            { "data": "checkremain", "title":'Beschikbare credits'},
			            { "data": "company", "title":'Bedrijfsnaam'},
			            { "render": function ( data, type, user) {
                        return '<button class="btn btn-danger btn-xs remove-checkin" data-id="'+user.id+'" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            },
                            "title" : 'Opties'
                        }
			        ];

		columnRenders['history'] = [
		 				{"render": function(data, type, user){return datatableCheckbox(user.id, true, "history")}, "title":datatableCheckboxHeader()}, 
			            {'data':'log_name', "title":' <?php echo app('translator')->getFromJson('common.log_name'); ?> ' },
			             {'data':'description', "title":' <?php echo app('translator')->getFromJson('common.description'); ?> ' },
			             {'data':'causer_name', "title":' <?php echo app('translator')->getFromJson('common.causer_name'); ?> ' },
			             {"render": function ( data, type, user) {
			             	return moment(user.created_at).format("MM-DD-YYYY HH:mm");
			             }
			             	,"title":' <?php echo app('translator')->getFromJson('common.date_time'); ?> ' },
			             { "render": function ( data, type, user) {
                        return '<button class="btn btn-danger btn-xs remove-log" data-id="'+user.id+'" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            },
                            "title" : 'Opties'
                        }
			        ];
			        // console.log(columnRenders[type]);
		var columnRendersUsing = typeof columnRenders[type] !== 'undefined' ? columnRenders[type] : columnRenders['default'];
		if(typeof typeOriginal !== 'undefined'){
			columnRendersUsing = columnRenders[typeOriginal];
		}
		var $table = $('#datatable-tabletools');
		if(datatableInitCount){
			$table.dataTable().fnDestroy();
			var columnheader = '<tr>';
			var columnRendersUsing
			for(var x in columnRendersUsing){
				if(typeof columnRendersUsing[x].title !== 'undefined')
					columnheader += '<th>'+columnRendersUsing[x].title+'</th>';
				else
					columnheader += '<th></th>';
			}
			$table.find('thead').html('');
			$table.find('tbody').html('');
			$(columnheader).appendTo($table.find('thead'));
		}
		datatableInitCount++;
		var urlQuery = '';
		if(typeof objArg !== 'undefined' && typeof objArg.urlQuery !== 'undefined') urlQuery = objArg.urlQuery;
		var user_status = '';
		if(typeof objArg !== 'undefined' && typeof objArg.user_status !== 'undefined') user_status = objArg.user_status;

		var $table = $('#datatable-tabletools');
		// console.log($table.find('thead'));
		var table = $table.dataTable({
			"aaSorting": [],
            "language": {
			      "emptyTable": "Helaas, deze tabel is leeg, of er is niets gevonden",
			      "infoEmpty": "Helaas, deze tabel is leeg, of er is niets gevonden"
			    },
		    bDestroy: true,
			ajax: "<?php echo e(url('admin/users?type=')); ?>"+type+urlQuery,
			dom: 'Bfrtip',
			buttons: [
			{
                text:     '<span class="btn hvr-grow-shadow  checkbox-delete-btn"><i class="fa fa-trash "></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                	var el = $(e.target);
                	var modal = $('#delete-user-modal-bulk');
                	var datatable = el.closest('.dataTables_wrapper');
                	var ids = [];
                	datatable.find('.datatable-checkbox').each(function(){
                		var el = $(this);
                		 el_type = el.data().type;
                		if(el.is(':checked')){
                			ids.push(el.val());
                		}
                	});
                	// console.log(ids,type);
                	modal.find('.checkboxes_field').html(JSON.stringify(ids));
                	modal.find('.type').val(el_type);
                	modal.find('.method').remove();
                	modal.modal('show');
                }
            },
			{
                extend:   'print',
                text:     '<span class="hvr-grow-shadow"><i class="fa fa-file-text-o"></i> Print</span>',
                titleAttr:'print'
            },
            {
                extend:  'excelHtml5',
                text:    '<span class="hvr-grow-shadow"><i class="fa fa-file-excel-o"></i> Excel</span>',
                titleAttr: 'Excel',
                // action: function ( e, dt, node, config ) {
                // 	//var data = this.buttons.exportData();
                // 	//var json_data =JSON.stringify(data);
                // 	//genrate_file(json_data,'Excel');
                // },
                // enabled: true
            },
            {
                extend:    'pdfHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-pdf-o"></i> PDF</span>',
                titleAttr: 'PDF'
            }
        ],
			
			columns: columnRendersUsing,
			fnDrawCallback: function() {
			    var $paginate = this.siblings('.dataTables_paginate');

			    if (this.api().data().length <= this.fnSettings()._iDisplayLength){
			        $paginate.hide();
			    }
			    else{
			        $paginate.show();
			    }
			    if(user_status != ''){
			    	$(document).find('.user_status_filter').val(user_status);
			    }
			}
			
		});
		if(type != 'checkin'){
			$('#datatable-tabletools_filter').append(select_html);
		}
	};
	$(function() {
		datatableInit('user');
		$('.user-list-block .nav-link').on('click',function(){
			var type = $(this).attr('type-data');
			var typeOriginal = $(this).attr('type-data-original');
			if(type == 'show-chat'){
					if( $('#ChartistSimpleLineChart2').get(0) ) {
						garphdata(start,end);
    				}
					return ;
			}
			else if( type == "map"){
				if(map == "undefiled" ){
					initMap();
				}else{
					google.maps.event.trigger(map, 'resize');
				}
				return ;
			}
			else{
				datatableInit(type,typeOriginal);
			}
		});
		$(document).on('change','.user_status_filter',function(){
			var el = $(this);
			var value = el.val().trim();
			var navLink = $('.user-list-block .nav-item.active');
			var type = navLink.find('a').attr('type-data');
			var typeOriginal = navLink.find('a').attr('type-data-original');
			datatableInit(type,typeOriginal,{'urlQuery':'&user_status='+value,'user_status':value});
		});
	});

}).apply(this, [jQuery]);


$(function() {


	// $( "#userBirthDay" ).datepicker({ dateFormat: "dd-mm-yy" });
	// $( "#klant_sinds" ).datepicker({ dateFormat: "dd-mm-yy" });
	// $( "#update-birthday" ).datepicker({ dateFormat: "dd-mm-yy" });
	// $( "#update-klant_sinds" ).datepicker({ dateFormat: "dd-mm-yy" });

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "minDate": "MM/DD/YYYY",
    	"maxDate": "MM/DD/YYYY"
    }, garphdata);
    garphdata(start,end);

//remove check in
$(document).on("click", ".remove-checkin", function(){
		log_id = $(this).data().id;
	$.ajax({
		url: '<?php echo e(url('admin/check-in-remove')); ?>',
		method: "GET",
		data :  {log_id : log_id},
		success:function(response){
			if(response.status){
				$("#flash-message .modal-body").html(response.msg);
				$("#flash-message .modal-body").addClass("text-success");
				$("#flash-message").modal("show");
				$('.nav-link.active').trigger("click");
			}else alert("There was an error processing your request. Try back later.")
		}
	});
});
//remove log
$(document).on("click", ".remove-log", function(){
		log_id = $(this).data().id;
	
		$('#delete-log-from #log_id').val(log_id);
		$('#delete-log-modal').modal('show');
});

    // open edit user popup
	$(document).on('click','.edit-user-button',function(){
		var userData  = $(this).data().userdata;
		$.each(userData,function(inx,val){
			$('#update-'+inx).val(val);
			$('#update-'+inx).trigger("change");
		});
		var modal = $('#add-user-modal');
		modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
		modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
		modal.find('.tab-content').find('.tab-pane').removeClass('active');
		modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
		modal.removeClass('modal_show_only_add').modal('show');
	});
	$(document).on('click','.add-user-form',function(){
		<?php if(Auth::check() && Auth::User()->role_id == 3): ?> 
			$("#company").val(<?php echo e(Auth::User()->company); ?>);
			$("#company").trigger("change");
		<?php endif; ?>
		var modal = $('#add-user-modal');
		modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
		modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
		modal.find('.tab-content').find('.tab-pane').removeClass('active');
		modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
		modal.addClass('modal_show_only_add');
	});

	// open delete user from popup
	$(document).on('click','#delete-user-button',function(){
		var id = $('#update-id').val();
		var url= BASE_URL+'/admin/users/'+id;
		$('#delete-user-from').attr('action',url);
		$('#add-user-modal').modal('hide');
		$('#delete-user-modal').modal('show');
	});
	// open delete user from popup
	$(document).on('click','#block-user-button',function(){
		var id = $('#update-id').val();
		var url= BASE_URL+'/admin/users/'+id;
		$('#delete-user-from').attr('action',url);
		$('#add-user-modal').modal('hide');
		$('#delete-user-modal').modal('show');
	});
// open delete user from users list
	$(document).on('click','.delete-user-button',function(){
		var id = $(this).data().id;
		var url= BASE_URL+'/admin/users/'+id;
		$('#delete-user-from').attr('action',url);
		$('#delete-user-modal').modal('show');
	});
// view user button code 


$(document).on('click','.view-user-button',function(){
		var id = $(this).data().id;
		var url= BASE_URL+'/admin/users/'+id;
		window.open(url, '_blank');
	});

	$("#add-user-form").validate({

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
			password: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				}
			 },
			  confirm_password: {
			 	equalTo: "#password",
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
            password : "Dit veld is verplicht"  ,
            confirm_passwordphone: "Dit veld is verplicht",
            gender: "Dit veld is verplicht",
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

			$('.role-error').html('');

            $.ajax({
                 type: "POST",
                 url: "<?php echo e(url('admin/users')); ?>",
                 data: $(form).serialize(),
                 success: function (res) {

                 	if(res.success){
                 		 location.reload();
                 	}

                  var select_boxs = ['gender','activation_status','role'];

                    if(res.errors != 'undefiled'){

                     	$.each(res.errors,function(indx,val){

	                     		$("#"+indx).siblings('.role-error').text(val[0]);
                     		
                     	});

                     }
                 }
             });
             //return false; // required to block normal submit since you used ajax
        }
	});

	// update user form code
	$("#update-user-form").validate({

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
			password: {
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

			$('.role-error').html('');
			var id = $('#update-id').val();
            $.ajax({
                 type: "POST",
                 url: "<?php echo e(url('admin/users')); ?>/"+id,
                 data: $(form).serialize(),
                 success: function (res) {

                 	if(res.success){
                 		 location.reload();
                 	}

                    if(res.errors != 'undefiled'){

                     	$.each(res.errors,function(indx,val){
	                     		$("#update-"+indx).siblings('.role-error').text(val[0]);
                     	});

                     }
                 }
             });
             //return false; // required to block normal submit since you used ajax
        }
	});

   // add User modal code 
   /*
   $('.add-user-form').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true,
		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					//this.st.focus = '#name';
				}
			}
		}
	});
	*/
	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
// document end 
});

$(document).on('click','.check-in-user',function(){
	var user_id = $(this).data().id;

	$.ajax({
		url:"<?php echo e(url('admin/check-in')); ?>",
		data:{user_id:user_id, _token: '<?php echo e(csrf_token()); ?>'},
		type:'post',
		success:function(response){
			$("#flash-message .modal-body").html(response.msg);
			$("#flash-message .modal-body").addClass("text-success");
			$("#flash-message").modal("show");
		}
	});

});
$(document).on('click','tr',function(){
	$('.droppable').droppable({
		accept: ".fa-hand-grab-o",
		activeClass: "accepting-drops",
		hoverClass: "ui-droppable-hover",
		tolerance : "pointer"
	});
$('.droppable-checkin').mouseover(function(){
	$('.droppable-checkin').addClass("ui-droppable-hover");
});
$('.droppable-checkin').droppable({
		drop : function(event, ui){
		userTuple = $(ui.draggable[0]).parent().parent();
		$(".check-in-user", userTuple).trigger("click");
}});
$('.droppable-block').droppable({
		drop : function(event, ui){
		userTuple = $(ui.draggable[0]).parent().parent();
		$(".block-user-button", userTuple).trigger("click");
}});
$('.droppable-favorite').droppable({
		drop : function(event, ui){
		userTuple = $(ui.draggable[0]).parent().parent();
		$(".favorite-user-button-user-button", userTuple).trigger("click");
}});
$('.droppable-mail').droppable({
		drop : function(event, ui){
		userTuple = $(ui.draggable[0]).parent().parent();
		$(".mail-user-button", userTuple).trigger("click");
}});

	if($(this).hasClass('selected')){
		$(this).removeClass('selected');
		fa = $('.fa-hand-grab-o', this);
		fa.removeClass("fa-hand-grab-o");
		fa.addClass("fa-hand-paper-o");
		fa.removeClass("text-success");
		fa.draggable("disable");
	}
	else {

		//remove on others
			$("tr").removeClass('selected');
			$(this).addClass('selected');
			all_fa = $('.fa-hand-grab-o');
			all_fa.removeClass('fa-hand-grab-o')
			all_fa.removeClass('text-success')
			all_fa.addClass('fa-hand-paper-o')
			all_fa.draggable("disable");
		
		//add to current
		fa = $('.fa-hand-paper-o', this);
		fa.removeClass("fa-hand-paper-o");
		fa.addClass("fa-hand-grab-o");
		fa.addClass("text-success");
		
		fa.draggable({
			addClasses: true,
			zIndex:99999,
			drag: function( event, ui ) {
				$(".drop-wrap").show();
			},
			stop: function( event, ui ) {
				$(this).css('left', '-2px');
				$(this).css('top', '-2px');
				$(".drop-wrap").hide();

			}

		});

		fa.draggable("enable");
	}
});


	$('.charts-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

	var chart_ = $(this).attr('tab-id'); 

	if(chart_ ==  "ChartistSimpleLineChart2"){
		if( $('#ChartistSimpleLineChart2').get(0) ) {
			garphdata(start,end);
    	}
	}
});

//Permissions	
(function($) {
        var select_html = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-permission-button" data-toggle="modal" data-target="#edit-permission-modal"><i class="fa fa-magic"></i> Toegang toevoegen</button></div>';
        'use strict';
        var datatableInitPermission = function() {
            var $table = $('#datatable-tabletools-permission');
            var table = $table.dataTable({
            bDestroy: true,
            ajax: "<?php echo e(route('admin.getPermissionsRoute')); ?>",
            dom: 'Bfrtip',
            buttons: [
                {
                    text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                    titleAttr:'Delete',
                    action: function(e, dt, node, config){
                        var el = $(e.target);
                        var modal = $('#delete-permission-modal-bulk');
                        var datatable = el.closest('.dataTables_wrapper');
                        var ids = [];
                        datatable.find('.datatable-checkbox').each(function(){
                            var el = $(this);
                            if(el.is(':checked')){
                                ids.push(el.val());
                            }
                        });
                        // console.log(ids,type);
                        modal.find('.checkboxes_field').val(JSON.stringify(ids));
                        modal.modal('show');
                    }
                },
                {
                    extend:    'print',
                    text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-text-o"></i> Print</span>',
                    titleAttr: 'print'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-excel-o"></i> Excel</span>',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-pdf-o"></i> PDF</span>',
                    titleAttr: 'PDF'
                },
            ],
            columns: [
                        { "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
                        {data: 'permission'},
                        {data: 'pdescription'},
                        {data: 'created_at'},
                        {data: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
            fnDrawCallback: function() {
                var $paginate = this.siblings('.dataTables_paginate');

                if (this.api().data().length <= this.fnSettings()._iDisplayLength){
                    $paginate.hide();
                }
                else{
                    $paginate.show();
                }
            },
            "language": {
			      "emptyTable": "Helaas, deze tabel is leeg, of er is niets gevonden",
			      "infoEmpty": "Helaas, deze tabel is leeg, of er is niets gevonden"
			    }
        });
        $('#datatable-tabletools-permission_filter').append(select_html);
    };
    $(function() {
        datatableInitPermission();
        /*$('.nav-link').on('click',function(){
             datatableInit();
         });
        */
    });
}).apply(this, [jQuery]);
       $(document).on('click',".add-permission-button", function(){
            // $('#edit-modal').addClass('modal_show_only_add').modal('show');
            var modal = $('#edit-permission-modal');
            modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
            modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
            modal.find('.tab-content').find('.tab-pane').removeClass('active');
            modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
            modal.addClass('modal_show_only_add');
        });
        function permissionEdit(permission_id){
            var url = "<?php echo e(route('admin.permissions.show', 'permission_id')); ?>";
            url = url.replace("permission_id", permission_id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                    var modal = $('#edit-permission-modal');
                    modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
                    modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
                    modal.find('.tab-content').find('.tab-pane').removeClass('active');
                    modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
                    modal.removeClass('modal_show_only_add').modal('show');
                    $('#edit-route_name').val(data['route_name']);
                    $('#edit-block_name').val(data['block_name']);
                    $('#edit-dependent_routes').val(data['dependent_routes']);
                   
                    $('#edit-permission-id').val(data['id']);
                    $('#edit-permission').val(data['permission']);
                    $('#edit-pdescription').val(data['pdescription']);
                }});
        };

        /** Update **/
        $(".update-permission-button").click(function(){
            var permission_id = $('#edit-permission-id').val();
            var url = "<?php echo e(route('admin.permissions.update', 'permission_id')); ?>";
            url = url.replace("permission_id", permission_id);
            // var page_edit_form = $("#page_edit_form");
            // var form_data = page_edit_form.serialize();
            var postData = new FormData($("#permission_edit_form")[0]);
            $( '#edit-permission-error' ).html( "" );
            $( '#edit-pdescription-error' ).html( "" );
            $('#edit-route_name-error').html("");
            $('#edit-block_name-error').html("");
            $('#edit-dependent_routes-error').html("");
                 
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if(data.errors) {
                        if(data.errors.permission){
                            $( '#edit-permission-error' ).html( data.errors.permission[0] );
                        }
                        if(data.errors.pdescription){
                            $( '#edit-pdescription-error' ).html( data.errors.pdescription[0] );
                        }
                        if(data.errors.route_name){
                            $( '#edit-route_name-error' ).html( data.errors.route_name[0] );
                        }
						if(data.errors.block_name){
                            $( '#edit-block_name-error' ).html( data.errors.block_name[0] );
                        }
 						if(data.errors.dependent_routes){
                            $( '#edit-dependent_routes-error' ).html( data.errors.dependent_routes[0] );
                        }

                 
                    }
                    if(data.success) {
                        window.location.href = '<?php echo e(route('admin.permissions.index')); ?>';
                    }
                },
            });
        });
        $("#store-permission-button").click(function(){
            var postData = new FormData($("#permission_add_form")[0]);
            $( '#permission-error' ).html( "" );
            $( '#pdescription-error' ).html( "" );
            $('#route_name-error').html("");
            $('#block_name-error').html("");
            $('#dependent_routes-error').html("");
            $.ajax({
                type:'POST',
                url:'<?php echo e(route('admin.permissions.store')); ?>',
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if(data.errors) {
                        if(data.errors.permission){
                            $( '#permission-error' ).html( data.errors.permission[0] );
                        }
                        if(data.errors.pdescription){
                            $( '#pdescription-error' ).html( data.errors.pdescription[0] );
                        }
                        if(data.errors.route_name){
                            $( '#route_name-error' ).html( data.errors.route_name[0] );
                        }
						if(data.errors.block_name){
                            $( '#block_name-error' ).html( data.errors.block_name[0] );
                        }
 						if(data.errors.dependent_routes){
                            $( '#dependent_routes-error' ).html( data.errors.dependent_routes[0] );
                        }

                    }
                    if(data.success) {
                        window.location.href = '<?php echo e(route('admin.permissions.index')); ?>';
                    }
                },
            });
        });

     /** Delete **/
function permissionRemove(permission_id){
    var url = "<?php echo e(route('admin.permissions.destroy', 'permission_id')); ?>";
    url = url.replace("permission_id", permission_id);
    $('#delete-permission-modal').modal('show');
    $('#delete_permission_form').attr('action', url);
}
$(document).on('click','#delete-permission-tab-button',function(){
    var id = $('#edit-permission-id').val();
    $(this).closest('.modal').modal('hide');
    permissionRemove(id);
});
function permissionView(id){
    var url = "<?php echo e(route('admin.permissions.show', 'id')); ?>";
    url = url.replace("id", id);
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success:function(data){
            $('#view-permission-modal').modal('show');
            $('#view-permission-permission').text(data['permission']);
            $('#view-permission-pdescription').text(data['pdescription']);
        }});
}
//roles
	(function($) {
        var select_html = '<div class="pull-right"><button type="button" class="btn btn-info btn-md hvr-grow-shadow add-button" data-toggle="modal" data-target="#edit-modal-role"><i class="fa fa-object-group"></i> Functie toevoegen</button></div>';
            'use strict';
	var datatableInitrole = function() {
		var $table = $('#datatable-tabletools-role');
		var table = $table.dataTable({

            "language": {
			      "emptyTable": "Helaas, deze tabel is leeg, of er is niets gevonden",
			      "infoEmpty": "Helaas, deze tabel is leeg, of er is niets gevonden"
			    },

		    bDestroy: true,
			ajax: "<?php echo e(route('admin.getRolesRoute')); ?>",
			dom: 'Bfrtip',
			buttons: [
            {
                text:     '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                    var el = $(e.target);
                    var modal = $('#delete-role-modal-bulk');
                    var datatable = el.closest('.dataTables_wrapper');
                    var ids = [];
                    datatable.find('.datatable-checkbox').each(function(){
                        var el = $(this);
                        if(el.is(':checked')){
                            ids.push(el.val());
                        }
                    });
                    // console.log(ids,type);
                    modal.find('.checkboxes_field').val(JSON.stringify(ids));
                    modal.modal('show');
                }
            },
			{
                extend:    'print',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-text-o"></i> Print</span>',
                titleAttr: 'print'
            },
            {
                extend:    'excelHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-excel-o"></i> Excel</span>',
                titleAttr: 'Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-pdf-o"></i> PDF</span>',
                titleAttr: 'PDF'
            },
        ],
			columns: [
                        { "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
			            { "data": "role" },
                        { "data": "rdescription" },
			            { "data": "created_at" },
			            { "data": "updated_at" },
						{ "data": "action", orderable: false, searchable: false},
			        ],
            fnDrawCallback: function() {
                var $paginate = this.siblings('.dataTables_paginate');

                if (this.api().data().length <= this.fnSettings()._iDisplayLength){
                    $paginate.hide();
                }
                else{
                    $paginate.show();
                }
            }
		});
		$('#datatable-tabletools-role_filter').append(select_html);
	};
	$(function() {
		datatableInitrole();
		// $('.nav-link').on('click',function(){
		// 	 datatableInit();
		//  });
	});
}).apply(this, [jQuery]);

$(document).on('click',".add-button", function(){
            var modal = $('#edit-modal');
            modal.find('.nav.nav-tabs').find('.nav-item').addClass('disabled').removeClass('active').find('a').removeClass('active');
            modal.find('.nav.nav-tabs').find('.nav-item.tab-add').removeClass('disabled').addClass('active').find('a').addClass('active');
            modal.find('.tab-content').find('.tab-pane').removeClass('active');
            modal.find('.tab-content').find('.tab-pane.tab-add-pane').addClass('active');
            modal.addClass('modal_show_only_add');
        });
        function edit(role_id){
            var url = "<?php echo e(route('admin.roles.show', 'role_id')); ?>";
            url = url.replace("role_id", role_id);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success:function(data){
                    var modal = $('#edit-modal');
                    modal.find('.nav.nav-tabs').find('.nav-item').removeClass('disabled').removeClass('active').find('a').removeClass('active');
                    modal.find('.nav.nav-tabs').find('.nav-item.tab-edit').addClass('active').find('a').addClass('active');
                    modal.find('.tab-content').find('.tab-pane').removeClass('active');
                    modal.find('.tab-content').find('.tab-pane.tab-edit-pane').addClass('active');
                    modal.removeClass('modal_show_only_add').modal('show');
                    $('#edit-role-id').val(data['id']);
                    $('#edit-role').val(data['role']);
                    $('#edit-rdescription').val(data['rdescription']);
            }});
        }
        /** Update **/
        $(".update-button").click(function(){
            var role_id = $('#edit-role-id').val();
            var url = "<?php echo e(route('admin.roles.update', 'role_id')); ?>";
            url = url.replace("role_id", role_id);
            // var page_edit_form = $("#page_edit_form");
            // var form_data = page_edit_form.serialize();
            var postData = new FormData($("#role_edit_form")[0]);
            $('#role-error').html("");
            $('#rdescription-error').html("");
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.role){
                            $('#role-error').html(data.errors.role[0]);
                        }
                        if (data.errors.rdescription){
                            $('#rdescription-error').html(data.errors.rdescription[0]);
                        }
                    }
                    if (data.success) {
                        window.location.href = '<?php echo e(route('admin.roles.index')); ?>';
                    }
                },
            });
        });
        function roleeditpermission(role_id){
            var url = "<?php echo e(route('admin.roles.edit', 'role_id')); ?>";
            url = url.replace("role_id", role_id);
            $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success:function(data){
                $('.permission').prop('checked', false);
                for (var i = 0; i < data.length; i++){
                    $('#edit-permission-role').val(data[i].role);
                    $("#edit-permission-permissions" + data[i].id).prop('checked', true);
                }
                $('#edit-permission-role-modal').modal('show');
                $('#edit-permission-role-id').val(role_id);
            }});
        }
        /** Delete **/
        function remove(role_id){
            var url = "<?php echo e(route('admin.roles.destroy', 'role_id')); ?>";
            url = url.replace("role_id", role_id);
            $('#delete-modal').modal('show');
            $('#delete_form').attr('action', url);
        }
        $(document).on('click','#delete-tab-button',function(){
            var id = $('#edit-role-id').val();
            $(this).closest('.modal').modal('hide');
            remove(id);
        });
        /** Add **/
        
        /** Store **/
        $("#store-button").click(function(){
            var postData = new FormData($("#role_add_form")[0]);
            $('#role-error').html("");
            $('#rdescription-error').html("");
            $.ajax({
                type:'POST',
                url:'<?php echo e(route('admin.roles.store')); ?>',
                processData: false,
                contentType: false,
                data : postData,
                success:function(data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.role){
                            $('#role-error').html(data.errors.role[0]);
                        }
                        if (data.errors.rdescription){
                            $('#rdescription-error').html(data.errors.rdescription[0]);
                        }
                    }
                    if (data.success) {
                        window.location.href = '<?php echo e(route('admin.roles.index')); ?>';
                    }
                },
            });
        });
        function view(id){
            var url = "<?php echo e(route('admin.roles.show', 'id')); ?>";
            url = url.replace("id", id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){
                $('#view-modal').modal('show');
                $('#view-role').text(data['role']);
                $('#view-rdescription').text(data['rdescription']);
            }});
        }
        function attach_permissions(id){
            var url = "<?php echo e(route('admin.role.permissions')); ?>?id="+id;
            window.location =url;
        }



	$('#company, #update-company').change(function(){
		id = $(this).val();
		$.ajax({
		url: '<?php echo e(url('admin/packages-get')); ?>',
		data:{company_id : id},
		method: "GET",
		async :false,
		success:function(response){
			if(response.packages){
				packages = response.packages;
		     	$('#packagefk, #update-packagefk').html("");
				for(i=0;i<packages.length;i++) {
				     $('#packagefk, #update-packagefk')
				         .append($("<option></option>")
				         .attr("value",packages[i].id)
				         .attr("id",packages[i].id)
				         .text(packages[i].name));
				     }
				 }
			else alert("There was an error processing your request. Try back later.")
		}
	});
	});

	
</script>


<?php $__env->stopSection(); ?>