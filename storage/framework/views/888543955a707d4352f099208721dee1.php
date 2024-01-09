<!DOCTYPE html>
<html lang="en">
<?php
	$mUrl = Request::url();
	$setting = getsetting();
	$title = @$setting->site_title;
	$desc = @$setting->site_desc;
	$mKWords = @$setting->site_meta_desc;
	$ASSET_URL = asset('user-theme') . '/';
	$auth_user = Auth::user();
	$STORAGE_URL =Storage::url('/');
	$mImage = $STORAGE_URL.@$setting->preview_image;
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<?php echo $__env->yieldContent('head_scripts'); ?>
	<!-- Favicons -->
	<link href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" rel="icon">
    <link href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" rel="apple-touch-icon">
	<link rel="canonical" href="<?php echo e(url()->current()); ?>" />
	<link rel="alternate" hreflang="x-default" href="<?php echo e(url()->current()); ?>" />

	 <!--=== custom css ===-->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	 <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/auth.css">
	<link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>my_assets/buttonLoader.css" />
    <!--=== custom css ===-->
</head>
<body>
	<div class="page">
		<div class="page-main">
			<div id="msg-toast"></div>
			<main id="main">
				<?php echo $__env->yieldContent('content'); ?>
			</main>
		</div>
	</div>
	<!-- BEGIN JAVASCRIPT -->
	<script src="<?php echo e($ASSET_URL); ?>assets/js/jquery.min.js"></script>
	<script>
		var ASSET_URL = "<?php echo e(asset('user-theme').'/'); ?>";
var BASE_URL = "<?php echo e(url('/')); ?>/";
		var HAPPY_STRIKER = "<?php echo e($STORAGE_URL.@$setting->success_icon_img); ?>"
		var SAD_STRIKER = "<?php echo e($STORAGE_URL.@$setting->error_icon_img); ?>"
		$('.tp_main_wrapper').css('background-image', 'url(<?php echo e($STORAGE_URL.@$setting->login_sign_bg_img); ?>)');
	</script>
	<!-- button laoder validation -->
	<script src="<?php echo e($ASSET_URL); ?>my_assets/jquery.buttonLoader.min.js"></script>
	<!-- jquery validation -->
	<script src="<?php echo e($ASSET_URL); ?>my_assets/jquery.validate.js"></script>
	<script src="<?php echo e($ASSET_URL); ?>my_assets/jquery-additional-methods.min.js"></script>
	<!-- jquery validation -->
     <!-- auth js -->
	 <script src="<?php echo e($ASSET_URL); ?>my_assets/js/auth.js"></script>
	 <!-- auth js -->
    <script src="<?php echo e($ASSET_URL); ?>my_assets/common.js"></script>
	<?php echo $__env->yieldContent('scripts'); ?>
	 <!--=== End JavaScript ===-->
</body>

</html>
<?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/layout/login_master.blade.php ENDPATH**/ ?>