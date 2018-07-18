<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title> <?php echo $__env->yieldContent('title'); ?> </title>

<!-- <<<<<<< Updated upstream
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fa/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('js/aos/aos.css')); ?>">
    <link href="<?php echo e(asset('css/jquery-ui.multidatespicker.css')); ?>" rel="stylesheet">
======= -->
    <link rel="stylesheet" href="<?php echo e(asset('user_files/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('user_files/css/fa/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('user_files/css/style.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('user_files/js/aos/aos.css')); ?>">
<!-- >>>>>>> Stashed changes -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900|Source+Serif+Pro:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800,900" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('user_files/css/custom.css')); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('user_files/js/croppie/croppie.css')); ?>">

    <!-- Styles -->
     <?php echo $__env->yieldContent('style'); ?>
     <style type="text/css">
     	.mce-notification-inner{
     		display: none !important;
     	}
     	#mceu_31{
     		display: none !important;
     	}
     	}
     </style>
</head>
<body <?php if($hasUI): ?> style="color:#<?php echo e($company_data['ui']['text']); ?> !important; background: #<?php echo e($company_data['ui']['background']); ?> !important;" <?php endif; ?>>

<?php echo $__env->make('includes.login_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('components.models.croppie', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
	var $uploadCrop;
	var BASE_URL = "<?php echo e(url('/')); ?>";
	var CROPED_IMAGES = '';
	var IMAGES_INDEX = 0;
</script>
<!-- <<<<<<< Updated upstream
<script type='text/javascript' src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script type='text/javascript' src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/aos/aos.js')); ?>"></script>
<script src="<?php echo e(asset('js/croppie/croppie.min.js')); ?>"> </script>
<script src="<?php echo e(asset('js/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/site.js')); ?>"></script>
<link href="<?php echo e(asset('css/jquery-ui.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/jquery.signature.css')); ?>" rel="stylesheet">
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> >
<script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery-ui.multidatespicker.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script src="<?php echo e(asset('js/jquery.signature.js')); ?>"></script>
======= -->
<script type='text/javascript' src="<?php echo e(asset('user_files/js/jquery.js')); ?>"></script>
<script type='text/javascript' src="<?php echo e(asset('user_files/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_files/vendor/jquery-validation/jquery.validate.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('user_files/js/aos/aos.js')); ?>"></script>
<script src="<?php echo e(asset('user_files/js/croppie/croppie.min.js')); ?>"> </script>
<script src="<?php echo e(asset('user_files/js/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('user_files/js/site.js')); ?>"></script>
<?php if(!Auth::check()): ?>
<!--  The user not logged in include login script... -->
<?php echo $__env->make('scripts.login_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>


<!-- >>>>>>> Stashed changes -->
<script type="text/javascript">

$(window).on('load', function() {
    AOS.init({
        duration: 1200,
    });
    AOS.refresh();
});
</script>
    <!-- Scripts -->
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
