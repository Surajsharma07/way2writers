<!--=== Start Header===-->
<div class="tp_header_wrappo">
    <div class="tp_header">
        <div class="tp_header_inner_wrapper">
                <div class="tp_welcome">
                    <p>Hi, <?php echo e(@$auth_user->full_name); ?></p>
                </div>
                <div class="tp_preview_box_wrapper">
                    <div class="tp_profile_box">
                        <span>ad</span>
                        <div class="tp_profile_open">
                            <ul>
                                <li><a href="<?php echo e(route('admin.profile')); ?>"><i class="fa fa-lock" aria-hidden="true"></i>
                                        Profile</a></li>
                                <li><a href="<?php echo e(route('admin.logout')); ?>"><i class="fa fa-power-off"
                                            aria-hidden="true"></i>logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tp_priview_box">
                        <p><a href="<?php echo e(route('frontend.home')); ?>" target="_blank">Preview Site
                                <img src="<?php echo e($ASSET_URL); ?>images/preview_icon.png" alt=""
                                    class="preview-img1">
                            </a></p>
                    </div>
                    <div class="tp_menu">
                        <div class="menu_toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!--=== End Header ===-->
<?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>