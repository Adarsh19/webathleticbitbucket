<?php $__env->startSection('title', 'Home'); ?>


<?php $__env->startSection('content'); ?>


    <?php echo isset($home_page->page_content) ? $home_page->page_content : ''; ?>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script>
        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault(); 
            $.ajax({
                type: "GET",
                url: 'subscribe',
                data: $(this).serialize(),
                 success: function( msg ) {
                     $("#form_message").html("<div>"+msg+"</div>");
                 }
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>