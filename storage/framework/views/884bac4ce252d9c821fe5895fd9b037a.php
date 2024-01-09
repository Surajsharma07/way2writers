<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
        $mUrl = Request::url();
        $setting = getsetting();
        $title = @$setting->site_title;
        $desc = @$setting->site_desc;
        $mKWords = @$setting->site_meta_desc;
        $site_creator = trans('page_title.Frontend.site_creator');
        $ASSET_URL = asset('user-theme') . '/';
        $auth_user = Auth::user();
        $STORAGE_URL = Storage::url('/');
        $mImage = $STORAGE_URL . @$setting->preview_image;
    ?>
    <title><?php echo e(@$title); ?></title>
    <meta name="keywords" content="<?php echo e(@$mKWords); ?>" />
    <meta name="description" content="<?php echo e(@$desc); ?>" />
<meta property="og:locale" content="en_US" />
    <meta property="og:title" content="<?php echo e(@$title); ?>" />
    <meta property="og:type" content=website />
    <meta property="og:site_name" content="<?php echo e($site_creator); ?>" />
    <meta property="og:url" content="<?php echo e(@$mUrl); ?>" />
    <meta property="og:image" content="<?php echo e(@$mImage); ?>" />
    <meta property="og:description" content="<?php echo e(@$desc); ?>" />
    <!--=== twitter meta tags ===-->
    <meta name="twitter:card" content="<?php echo e(@$title); ?>" />
    <meta property="twitter:title" content="<?php echo e(@$title); ?>" />
    <meta property="twitter:description" content="<?php echo e(@$desc); ?>" />
    <meta property="twitter:url" content="<?php echo e(@$mUrl); ?>" />
    <meta property="twitter:image" content="<?php echo e(@$mImage); ?>" />
    <meta name="twitter:site" content="<?php echo e($site_creator); ?>" />
    <meta name="twitter:creator" content="<?php echo e($site_creator); ?>" />
    <!--=== twitter meta tags ===-->

    <link rel="canonical" href="<?php echo e(url()->current()); ?>" />
    <link rel="alternate" hreflang="x-default" href="<?php echo e(url()->current()); ?>" />
    <!-- Favicons -->
    <link href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" rel="icon">
    <link href="<?php echo e($STORAGE_URL . @$setting->favicon_img); ?>" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!--=== Required meta tags ===-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--=== custom css ===-->
    
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/swiper.min.css" />
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/animate.css" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/style.css" />
    <!--=== custom css ===-->
</head>

<body>
    <?php if($setting->pre_loader_img): ?>
        <div class="loader">
            <div class="spinner">
                <img src="<?php echo e($STORAGE_URL . @$setting->pre_loader_img); ?>" alt="loader" />
            </div>
        </div>
    <?php endif; ?>
    <div class="page">
        <div class="page-main homemasterblade">
            <div id="msg-toast"></div>
            <div class="tp_header_section">
                <?php echo $__env->make('frontend.layout.nav', [
                    'setting' => $setting,
                    'STORAGE_URL' => $STORAGE_URL,
                    'auth_user' => $auth_user,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('frontend.layout.header', ['setting' => $setting, 'STORAGE_URL' => $STORAGE_URL], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <main id="main">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
        <?php echo $__env->make('frontend.layout.footer', ['setting' => $setting, 'STORAGE_URL' => $STORAGE_URL], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(!$auth_user): ?>
            <?php echo $__env->make('frontend.include.login-popup', ['ASSET_URL' => $ASSET_URL], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <!-- BEGIN JAVASCRIPT -->
    <!--===Bottom To Top===-->
    <div class="tp_top_icon">
        <a id="button" class="show">
            <svg xmlns="http://www.w3.org/2000/svg" width="17.031" height="10" viewBox="0 0 17.031 10">
                <path
                    d="M12.232,10.010 C12.234,10.010 12.236,10.010 12.237,10.010 C12.489,10.010 12.740,9.886 12.965,9.649 C14.203,8.347 15.439,7.045 16.672,5.739 C17.127,5.257 17.130,4.751 16.682,4.277 C15.441,2.961 14.197,1.650 12.951,0.341 C12.738,0.117 12.486,-0.006 12.241,-0.006 C12.022,-0.006 11.815,0.090 11.642,0.272 C11.266,0.670 11.291,1.213 11.707,1.657 C12.050,2.022 12.394,2.384 12.738,2.746 L13.415,3.461 C13.458,3.508 13.496,3.559 13.541,3.622 L13.878,4.069 L1.040,4.069 C0.954,4.067 0.870,4.066 0.785,4.075 C0.366,4.117 0.032,4.467 -0.010,4.907 C-0.051,5.342 0.198,5.748 0.582,5.873 C0.737,5.923 0.918,5.931 1.091,5.932 C4.409,5.935 7.728,5.934 11.048,5.934 L13.040,5.934 L13.999,5.934 L13.034,6.948 C12.578,7.428 12.146,7.882 11.717,8.336 C11.298,8.781 11.266,9.325 11.634,9.723 C11.807,9.909 12.013,10.009 12.232,10.010 Z"
                    class="cls-1" />
            </svg>
        </a>
    </div>
    <!--===Bottom To Top===-->
    <!--=== Optional JavaScript ===-->
    <script src="<?php echo e($ASSET_URL); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/swiper.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>assets/js/custom.js"></script>
    		<link href="https://www.way2writers.com/css/slick.css" rel="stylesheet" />
<script type="text/javascript" src="https://www.way2writers.com/js/slick.min.js"></script>

    <!--=== Optional JavaScript ===-->
    <script>
        var ASSET_URL = "<?php echo e(asset('user-theme') . '/'); ?>";
var BASE_URL = "<?php echo e(url('/')); ?>/";
        $('.tp_banner_section').css('background-image', 'url(<?php echo e($STORAGE_URL . @$setting->home_page_bg_img); ?>)');
        $('.tp_TopSelling_section').css('background-image', 'url(<?php echo e($STORAGE_URL . @$setting->home_middle_banner); ?>)');

        <?php if(@$setting->is_checked_animation_bg): ?>
            $('.tp_bnnner_section2').css('background-image',
                'url(<?php echo e($STORAGE_URL . @$setting->home_page_bg_animation_img); ?>)');
        <?php endif; ?>
        var HAPPY_STRIKER = "<?php echo e($STORAGE_URL . @$setting->success_icon_img); ?>"
        var SAD_STRIKER = "<?php echo e($STORAGE_URL . @$setting->error_icon_img); ?>"
    </script>
    <script src="<?php echo e($ASSET_URL); ?>my_assets/jquery.buttonLoader.js"></script>
    <script src="<?php echo e($ASSET_URL); ?>my_assets/common.js"></script>
    <?php if(!$auth_user): ?>
        <!-- jquery validation -->
        <script src="<?php echo e($ASSET_URL); ?>my_assets/jquery.validate.js"></script>
        <script src="<?php echo e($ASSET_URL); ?>my_assets/jquery-additional-methods.min.js"></script>
        <!-- jquery validation -->
        <script src="<?php echo e($ASSET_URL); ?>my_assets/js/auth.js"></script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/layout/home_master.blade.php ENDPATH**/ ?>