<?php $__env->startSection('head_scripts'); ?>
    <?php
        $ASSET_URL = asset('user-theme') . '/';
        $setting = getsetting();
        $mUrl = Request::url();
        $mImage = Storage::url($setting->preview_image);
        $mTitle = trans('page_title.Frontend.sign_in_title');
        $mDescr = trans('page_title.Frontend.sign_in_desc');
        $mKWords = trans('page_title.Frontend.sign_in_keyword');
        $site_creator = trans('page_title.Frontend.site_creator');
    ?>
    <title><?php echo e(@$mTitle); ?></title>
    <meta name="keywords" content="<?php echo e(@$mKWords); ?>" />
    <meta name="description" content="<?php echo e(@$mDescr); ?>" />

<meta property="og:locale" content="en_US" />
    <meta property=og:type content=website />
    <meta property="og:site_name" content="<?php echo e($site_creator); ?>" />
    <meta property="og:title" content="<?php echo e(@$mTitle); ?>" />
    <meta property="og:description" content="<?php echo e(@$mDescr); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="og:image" content="<?php echo e(@$mImage); ?>" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="<?php echo e(@$mTitle); ?>" />
    <meta property="twitter:description" content="<?php echo e(@$mDescr); ?>" />
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="twitter:image" content="<?php echo e(@$mImage); ?>" />
    <meta name="twitter:site" content="<?php echo e($site_creator); ?>" />
    <meta name="twitter:creator" content="<?php echo e($site_creator); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section>
        <!--=== start Main wraapper ===-->
        <div class="tp_main_wrapper">
            <!--===Login Section Start===-->
            <div class="tp_login_section">
                <div class="tp_login_flex">
                    <div class="tp_login_main">
                        <div class="tp_login_auth">
                            <a href="<?php echo e(route('frontend.home')); ?>">
                                <img src="<?php echo e(Storage::url($setting->my_logo)); ?>" alt="logo" />
                            </a>
                            <h1><?php echo app('translator')->get('master.login.login_account'); ?></h1>
                            <h5><?php echo app('translator')->get('master.login.theme_portal_login'); ?></h5>
                            <div class="tp_login_form">
                                <form action="<?php echo e(route('frontend.userlogin')); ?>" method="POST"
                                    id="login-form">
                                    <?php echo csrf_field(); ?>
                                    <div class="login-content">
                                        <div class="tp_input_main">
                                            <p><?php echo app('translator')->get('master.login.email'); ?></p>
                                            <div class="tp_input">
                                                <input type="text" placeholder="Enter Your Email" name="email">
                                                <img src="<?php echo e($ASSET_URL); ?>assets/images/auth/msg.svg" alt="" />
                                            </div>
                                            <label id="email-error" class="error" for="email"></label>

                                            <p><?php echo app('translator')->get('master.login.password'); ?></p>
                                            <div class="tp_input">
                                                <input type="password" placeholder="Enter Your Password" name="password">
                                                <img class="toggle-password"
                                                    src="<?php echo e($ASSET_URL); ?>assets/images/auth/password.svg"
                                                    style="cursor:pointer" alt="password" />
                                            </div>
                                            <label id="password-error" class="error" for="password"></label>
                                        </div>
                                    </div>
                                    <div class="tp_check_section">
                                        <ul>
                                            <li>
                                                <div class="tp_checkbox">
                                                    <input type="checkbox" id="auth_remember" name="auth_remember"
                                                        value="1">
                                                    <label for="auth_remember"><?php echo app('translator')->get('master.login.remember_me'); ?></label>
                                                </div>
                                                <span><a
                                                        href="<?php echo e(route('frontend.forgot')); ?>"><?php echo app('translator')->get('master.login.forgot_password'); ?></a></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tp_login_btn">
                                        <button type="submit" class="tp_btn" id="login-form-btn"><?php echo app('translator')->get('master.login.login'); ?></button>
                                        <div class="tp_socialbtn_wrapper">
                                            <?php if(@$setting->is_check_facebook_login || @$setting->is_check_google_login): ?>
                                            <!--=== Socail login ===-->
                                                <span>Or</span>
                                                <div class="tp_social_btn">

                                                    <?php if(@$setting->is_check_facebook_login): ?>
                                                        <a href="<?php echo e(route('frontend.login.google')); ?>" class="tp_btn"
                                                            id="">
                                                            <i class="fa fa-google" aria-hidden="true"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                
                                                    <?php if(@$setting->is_check_google_login): ?>
                                                        <a href="<?php echo e(route('frontend.login.facebook')); ?>" class="tp_btn"
                                                            id="">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                </div>
                                                <!--=== Socail login ===-->
                                            <?php endif; ?>
                                        </div>
                                        <p><?php echo app('translator')->get('master.login.not_account'); ?> <a
                                                href="<?php echo e(route('frontend.sign-up')); ?>"><?php echo app('translator')->get('master.login.create_account'); ?></a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===Login Section End===-->
        </div>
        <!--=== End Main wraapper ===-->
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.login_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/login.blade.php ENDPATH**/ ?>