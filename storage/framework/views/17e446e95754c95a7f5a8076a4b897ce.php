<?php $__env->startSection('head_scripts'); ?>
    <?php
        $ASSET_URL = asset('user-theme') . '/';
        $mUrl = Request::url();
    ?>
    <title><?php echo app('translator')->get('page_title.Admin.sign_in_title'); ?></title>
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
                                <img src="<?php echo e(Storage::url(getsetting()->my_logo)); ?>" alt="logo" />
                            </a>
                            <h1><?php echo app('translator')->get('master.login.login_account'); ?></h1>
                            <h5><?php echo app('translator')->get('master.login.theme_portal_login'); ?></h5>
                            <div class="tp_login_form">
                                <form action="<?php echo e(route('admin.post-sign-in')); ?>" method="POST" id="login-form">
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

<?php echo $__env->make('frontend.layout.login_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/login.blade.php ENDPATH**/ ?>