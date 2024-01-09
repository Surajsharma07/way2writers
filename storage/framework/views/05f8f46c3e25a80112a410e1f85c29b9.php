<?php
    $ASSET_URL = asset('admin-theme/assets') . '/';
    $price_symbol = getSetting()->default_symbol ?? '$';
?>

<?php $__env->startSection('head_scripts'); ?>
    <title><?php echo app('translator')->get('page_title.Admin.dashbord_title'); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="tp_main_content_wrappo">
        <div class="tp_dashboared_content">
            <div class="tp_shortinfo">
                <h4 class="tp_heading mb-2">Welcome <?php echo e(auth()->user()->full_name); ?></h4>
                <ul>
                    <li>
                        <div class="tp_infobox progres">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/total-user.svg" alt="total-user">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Total Users</p>
                                <h3><?php echo e($total_user); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox fine">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/active-user.svg" alt="active-user">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Active Users</p>
                                <h3><?php echo e($active_user); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox danger">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/inactive-user.svg" alt="inactive-user">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Deactivate Users</p>
                                <h3><?php echo e($deactive_user); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox primary">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/active-products.svg" alt="">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Active Products</p>
                                <h3 class="tp_blue_color"><?php echo e($active_product); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox success ">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/free-product.svg" alt="">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Free Products</p>
                                <h3 class="tp_yellow_color"><?php echo e($product_free); ?></h3>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="tp_filter_result mb-30 mt-30">
                <h4 class="tp_heading mb-20">Filter the results using these options.</h4>
                <form action="<?php echo e(route('admin.dashboard')); ?>" method="get">
                    <div class="tp_filter_result_inner">
                        <div class="tp_form_wrapper">
                            <div class="tp_custom_select">
                                <select class="form-control" name="date">
                                    <option value="">Choose</option>
                                    <option value="<?php echo e(date('Y-m-d')); ?>" <?php if(request('date') == date('Y-m-d')): ?> selected <?php endif; ?>>
                                        Today</option>
                                    <option value="<?php echo e(date('Y-m-d', strtotime('-1 day'))); ?>"
                                        <?php if(request('date') == strtotime('-1 day')): ?> selected <?php endif; ?>>
                                        Yesterday
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="tp_form_to">
                            <div class="tp_form_wrapper">
                                <input type="text" name="start_date" class="form-control"
                                    value="<?php echo e(request('start_date')); ?>" placeholder="Start Date"
                                    onfocus="(this.type = 'date')">
                            </div>
                            <span>to</span>
                            <div class="tp_form_wrapper ">
                                <input type="text" name="end_date"class="form-control" value="<?php echo e(request('end_date')); ?>"
                                    placeholder="End Date" onfocus="(this.type = 'date')">
                            </div>
                        </div>
                        <div class="tp-dash-btn">
                            <button type="submit" class="tp_btn">filter</button>
                            <a href="<?php echo e(Request::url()); ?>" class="tp_btn tp_btn_refresh"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tp_section_border"></div>
            <div class="tp_shortinfo">
                <ul>
                    <li>
                        <div class="tp_infobox progres">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/ragister-user.svg" alt="ragister">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Registrations</p>
                                <h3 class="tp_violet_color"><?php echo e($total_user_search); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox fine">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/total-user-view.svg" alt="view">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Product Views</p>
                                <h3 class="tp_orangedark_color"><?php echo e($total_product_view); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox primary">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/sales.svg" alt="sales">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Total Sale</p>
                                <h3 class="tp_orangedark_color"><?php echo e($total_product_sale); ?></h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tp_infobox success">
                            <div class="tp_infobox_img">
                                <img src="<?php echo e($ASSET_URL); ?>images/amount.svg" alt="amount">
                            </div>
                            <div class="tp_infobox_content">
                                <p>Total Amount</p>
                                <h3 class="tp_orangedark_color"><?php echo e($price_symbol . $total_product_sale_amount); ?></h3>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
            <div class="tp_chart_wrappo">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="tp_chart_box">
                            <h4>Product Views on Devices</h4>
                            <?php echo $productViewDevice->container(); ?>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="tp_chart_box">
                            <h4>Product Views from Browsers</h4>
                            <?php echo $productViewChart->container(); ?>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="tp_chart_box">
                            <h4>User Registration</h4>
                            <?php echo $userRegistrationViewChart->container(); ?>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="tp_chart_box">
                            <h4>Order Sale</h4>
                            <?php echo $saleViewChart->container(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('admin-theme/my_assets/chart.min.js')); ?>" charset="utf-8"></script>
    <?php echo $productViewDevice->script(); ?>

    <?php echo $productViewChart->script(); ?>

    <?php echo $userRegistrationViewChart->script(); ?>

    <?php echo $saleViewChart->script(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/single/dashboard.blade.php ENDPATH**/ ?>