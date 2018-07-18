<?php $__env->startSection('title','Tests'); ?>
<?php $__env->startSection('style'); ?>
<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/select2/css/select2.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/datatables/media/css/dataTables.bootstrap4.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.theme.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/vendor/pnotify/pnotify.custom.css')); ?>" />
		<style type="text/css">
		#datatable-tabletools_wrapper i {position: relative;top: 3px;}
		#datatable-tabletools_wrapper span.hvr-grow-shadow {padding: 0 15px;color: #fff;background: #3367b3;line-height: 30px;height: 35px;margin: 0;}
		#datatable-tabletools_wrapper .pull-right span.hvr-grow-shadow{position: relative;top: -3px;}
		#datatable-tabletools_wrapper a { border: none; margin:0 5px 0px 0px}
		#datatable-tabletools_wrapper a.buttons-csv span.hvr-grow-shadow{ background:  #3367b3 ; }
		#datatable-tabletools_wrapper a.buttons-excel span.hvr-grow-shadow{ background: #40a20c  ; }
		#datatable-tabletools_wrapper a.buttons-pdf span.hvr-grow-shadow{ background:#e72b05  ; }
		#datatable-tabletools_wrapper a span{display: block;}
		#datatable-tabletools_wrapper .dt-buttons.btn-group {padding: 0px 20px 0 0;display: block;position: relative; float: left;width: 30%;}
		div#datatable-tabletools_filter {float: left;text-align:right;display:block;width:70%;
			margin: 0 0 30px;}
		div#datatable-tabletools_filter label{ width:40%; float: left;}
		div#datatable-tabletools_filter label input{ height:35px;}
		div#datatable-tabletools_filter .pull-right{ text-align: right; }
		div#datatable-tabletools_filter select, div#datatable-tabletools_filter span{margin: 0 10px; height:35px; display: inline-block;}
		div#datatable-tabletools_filter select{width:20%;height: 35px;width: 150px;}
				.form-control:not(.form-control-sm):not(.form-control-lg) {
		    font-size: 0.85rem !important;
		    line-height: 0.85 !important;
		    min-height: 0.4rem !important;
		}
		</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Tests</h2>

			<?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</header>

		<section class="content-header">
		        <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
		            <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i class="fa fa-building active"></i> Tests</a></li>
		        </ol>
	   	</section>
		<!-- start: page -->
		<div class="row">
		<?php if($errors->any()): ?>
			<div class="alert alert-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>
			<div class="col">
							<div style="clear:both;"></div>
							<section class="card">
								<div class="card-body">
									<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
										<thead>
											<tr>
												<th>Test Name</th>
												<th>Test Name</th>
												<th>Type</th>
												<?php if(Auth::user()->role=='admin'): ?>
												<th>Company</th>
												<?php endif; ?>
												<th>Questions</th>
												<th>Opties</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
					        </section>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: page -->
	</section>

	<!-- delete page modal -->
	<div id="delete-modal" class="modal modal-danger fade" id="modal-danger">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">
	                    <span class="fa-stack fa-sm">
	                        <i class="fa fa-square-o fa-stack-2x"></i>
	                        <i class="fa fa-trash fa-stack-1x"></i>
	                    </span>
	                    <?php echo app('translator')->getFromJson('common.delete_modal_text'); ?>
	                </h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->getFromJson('common.close'); ?>">
	                <span aria-hidden="true">&times;</span></button>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	                <form method="post" service="form" id="delete_form">
	                    <?php echo e(csrf_field()); ?>

	                    <?php echo e(method_field('DELETE')); ?>

	                    <button type="submit" class="btn btn-outline"><?php echo app('translator')->getFromJson('common.delete'); ?></button>
	                </form>
	            </div>
	        </div>
	        <!-- /.modal-content -->
	    </div>
	    <!-- /.modal-dialog -->
	</div>
	<!-- /.delete page modal -->
	  <div class="modal fade" id="delete-modal-bulk" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	         <form method="POST" action="<?php echo e(route('admin.tests.bulkdelete')); ?>" id="delete-from-bulk">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body" style="text-align: center;">
			    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    <input type="hidden" name="ids" id="ids">
			    <p>Really want to delete these Tests?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
	          <button type="submit" class="btn btn-danger" ><?php echo app('translator')->getFromJson('common.delete'); ?></button>
	        </div>
	        </form>
	      </div>
	    </div>
	  </div>


<?php $__env->stopSection(); ?>
<!-- /.add page modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site_scripts'); ?>
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
	<script src="<?php echo e(asset('admin_files/vendor/jquery-ui/jquery-ui.js')); ?>"></script>
	<script src="<?php echo e(asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')); ?>"></script>
   	<script src="<?php echo e(asset('admin_files/vendor/pnotify/pnotify.custom.js')); ?>"></script>


   		<!-- Examples -->
		<!-- <script src="<?php echo e(asset('admin_files/js/examples/examples.modals.js')); ?>"></script> -->
    <script type="text/javascript">
function datatableCheckbox(id){
  var checkbox = '<input type="checkbox" class="datatable-checkbox" value="'+id+'"/>';
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

 	(function($) {

var select_html = '<a href="<?php echo e(route('admin.tests.add')); ?>" class="btn  btn-force btn-info btn-md hvr-grow-shadow pull-right"><?php echo app('translator')->getFromJson('common.add_test'); ?></a>';


	var datatableInit = function() {

		var $table = $('#datatable-tabletools');
		var table = $table.dataTable({
		    bDestroy: true,
			ajax: "<?php echo e(route('admin.tests.show')); ?>",
			dom: 'Bfrtip',
			buttons: [
			{
                text: '<span class="btn hvr-grow-shadow checkbox-delete-btn"><i class="fa fa-trash"></i></span>',
                titleAttr:'Delete',
                action: function(e, dt, node, config){
                    var el = $(e.target);
                    var modal = $('#delete-modal-bulk');
                    var datatable = el.closest('.dataTables_wrapper');
                    var ids = [];
                    datatable.find('.datatable-checkbox').each(function(){
                        var el = $(this);
                        if(el.is(':checked')){
                            ids.push(el.val());
                        }
                    });
                    // console.log(ids,type);
                    modal.find('#ids').val(JSON.stringify(ids));
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
            }
        ],
			columns: [
						{ "render": function(data, type, user){return datatableCheckbox(user.id)}, "title":datatableCheckboxHeader() },
						{ data: "name" },
			            { data: "type" },
			            <?php if(Auth::user()->role=='admin'): ?>
			            { data: "company" },
			            <?php endif; ?>
			            { data: "totalQuestions" },
			            { data: 'action', name: 'action', orderable: false, searchable: false},
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
		$('#datatable-tabletools_filter').append(select_html);
	};
	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);


$(function() {
	/*
		Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
	// document end
});
function remove(id){
    var url = "<?php echo e(route('admin.tests.destroy', 'id')); ?>";
    url = url.replace("id", id);
    $('#delete-modal').modal('show');
    $('#delete_form').attr('action', url);
}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>