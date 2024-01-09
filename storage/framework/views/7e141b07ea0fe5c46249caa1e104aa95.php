<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $ASSET_URL = asset('admin-theme/assets') . '/';
        $auth_user = Auth::user();
        $setting = getsetting();
        $title = @$setting->site_title;
        $desc = @$setting->site_meta_desc;
        $mKWords = @$setting->site_meta_keywords;
        $STORAGE_URL = Storage::url('/');
    ?>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="keywords" content="<?php echo e(@$mKWords); ?>" />
    <meta name="description" content="<?php echo e(@$desc); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="MobileOptimized" content="320" />
    <!-------- Favicon Link -------->
    <link rel="shortcut icon" href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" />
    <link href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" rel="apple-touch-icon">
    <!-------- Style-sheet Start -------->
    <link rel="stylesheet" type="text/css" href="<?php echo e($ASSET_URL); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e($ASSET_URL); ?>css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('admin-theme/my_assets/select2.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e($ASSET_URL); ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin-theme/my_assets/iziToast.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.3/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.3/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.3/mode/htmlmixed/htmlmixed.js"></script>
<script src="https://cdn.tiny.cloud/1/0kf5dq45kjoznix7uqs3wt58ur6v0pifikad2bht0sthqxid/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- button laoder validation -->
    <link rel="stylesheet" href="<?php echo e(asset('user-theme/my_assets/buttonLoader.css')); ?>">
    <?php echo $__env->yieldContent('head_scripts'); ?>
</head>
<body>
    <!-------- Loader Start -------->
    <?php if($setting->pre_loader_img): ?>
    <div class="loader">
        <div class="spinner">
            <img src="<?php echo e($STORAGE_URL . @$setting->pre_loader_img); ?>" alt="loader" />
        </div>
    </div>
    <?php endif; ?>
     <!-------- Loader End -------->
    <!-------- Main Wrappo Start -------->
    <div class="ts_message_popup">
        <p class="ts_message_popup_text"></p>
    </div>
    <!-- Page -->
    <div class="tp_main_wrappo">
        <?php echo $__env->make('admin.layouts.menu', ['ASSET_URL' => $ASSET_URL, 'auth_user' => $auth_user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="tp_main_structure">
            <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- BEGIN JAVASCRIPT -->
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>

    <!-------- Main JS file Start -------->
    <script type="text/javascript" src="<?php echo e($ASSET_URL); ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo e($ASSET_URL); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('admin-theme/my_assets/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e($ASSET_URL); ?>js/custom.js"></script>
    <script type="text/javascript" src="<?php echo e($ASSET_URL); ?>ckeditor5/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo e($ASSET_URL); ?>js/form-editor.js"></script>
    <!-- jquery validation -->
    <script src="<?php echo e(asset('user-theme/my_assets/jquery.validate.js')); ?>"></script>
    <script src="<?php echo e(asset('user-theme/my_assets/jquery-additional-methods.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-theme/my_assets/iziToast.min.js')); ?>"></script>
    <!-- button laoder validation -->
	<script src="<?php echo e(asset('user-theme/my_assets/jquery.buttonLoader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-theme/my_assets/common.js')); ?>"></script>
    <script>
        var ASSET_URL = "<?php echo e(asset('admin-theme') . '/'); ?>";
        var BASE_URL = "<?php echo e(url('/')); ?>";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>