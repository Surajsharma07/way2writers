<?php
    $ASSET_URL = asset('user-theme') . '/';
    $price_symbol = getSetting()->default_symbol ?? '$';
?>

<?php $__env->startSection('head_scripts'); ?>
    <?php
        $mUrl = Request::url();
        $mImage = Storage::url(getSetting()->preview_image);
        $mTitle = @$product->meta_title;
        $mDescr = @$product->meta_desc;
        $mKWords = @$product->meta_keywords;
    ?>
    <title>
        <?php echo e(@$mTitle); ?></title>
    <meta name="keywords" content="<?php echo e(@$mKWords); ?>" />
    <meta name="description" content="<?php echo e(@$mDescr); ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property=og:type content=website />
    <meta property="og:site_name" content="Coin Gabbar" />
    <meta property="og:title" content="<?php echo e(@$mTitle); ?>" />
    <meta property="og:description" content="<?php echo e(@$mDescr); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="og:image" content="<?php echo e(@$mImage); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="<?php echo e(@$mTitle); ?>" />
    <meta property="twitter:description" content="<?php echo e(@$mDescr); ?>" />
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="twitter:image" content="<?php echo e(@$mImage); ?>" />
    <meta name="twitter:site" content="@themeportal" />
    <meta name="twitter:creator" content="@themeportal" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

        <div class="card bg-dark text-white">
  <img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/product-banner.jpg" class="card-img" alt="..." style="
    height: 300px;">
  <div class="card-img-overlay">
    <h5 class="card-title"> <?php echo e(@$product->name); ?></h5>
    <p class="card-text"><?php echo e(@$product->short_desc); ?></p>
    <p class="card-text">Get the job
                                you deserve with a powerful, interview-winning resume.</p>
  </div>
</div>
        <!--=== Single Product Details Section Start===-->
        <section class="row white-bg">
            <div class="col-sm-12">
                <div class="col-sm-12 product-page-content" style="display:block;" id="infographic">
                    <div class="row">
                        <?php echo @$product->description; ?>


                        <div class="col-sm-3 ">
                            <div class="row rht-colm">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div>

                                        <form id="add-to-card-form" method="POST">
                                            <div class="tp_sidebar_category tp_sidebar_category_single">
                                                <div class="tp_leftbar_box">
                                                    <?php if(@$product->is_free == '1'): ?>
                                                        <div class="tp_flex_price">
                                                            <p>Price</p>
                                                            <div class="tp_lowprice">
                                                                <h2>
                                                                    <?php if(!empty($product->price)): ?>
                                                                        <del><?php echo e($price_symbol . @$product->price); ?></del>
                                                                    <?php endif; ?> Free
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <?php if(@$product->is_enable_multi_price == 1 && isset($product_meta->multi_price) && !empty($product_meta->multi_price)): ?>
                                                            <?php $priceArr = (object) unserialize(@$product_meta->multi_price); ?>
                                                            <?php $__currentLoopData = $priceArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="tp_flex_price">
                                                                    <input
                                                                        <?php if(@$product_meta->enable_multi_option == 1): ?> type="checkbox" <?php else: ?> type="radio" <?php endif; ?>
                                                                        value="<?php echo e(@$value['price_id']); ?>" name="price_id[]"
                                                                        <?php if(@$value['default_price'] == 1): ?> checked <?php endif; ?>>
                                                                    <p><?php echo e(@$value['option_name']); ?></p>

                                                                    <div class="tp_lowprice">
                                                                        <?php if(!empty(@$value['offer_price']) && @$product->is_offer != 0): ?>
                                                                            <h2><span><?php echo e($price_symbol . @$value['price']); ?></span>
                                                                                <?php echo e($price_symbol . @$value['offer_price']); ?>

                                                                            </h2>
                                                                        <?php else: ?>
                                                                            <h2><?php echo e($price_symbol . @$value['price']); ?></h2>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <div class="tp_flex_price">
                                                                <p><?php echo app('translator')->get('master.product_search.Price'); ?></p>
                                                                <div class="tp_lowprice">
                                                                    <?php if(@$product->is_offer != '0'): ?>
                                                                        <h2><span><?php echo e($price_symbol . @$product->price); ?></span>
                                                                            <?php echo e($price_symbol . @$product->offer_price); ?>

                                                                        </h2>
                                                                    <?php else: ?>
                                                                        <h2><span></span><?php echo e($price_symbol . @$product->price); ?>

                                                                        </h2>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if($product->category_id != 2): ?>
                                                        <div><br>
                                                            <input type="checkbox" value="1"
                                                                name="include_cover_letter">
                                                            <label>Include Cover Letter (<?php echo e($price_symbol); ?>350)</label>
                                                        </div>
                                                    <?php endif; ?>


                                                    <div class="tp_product_detailhead">
                                                    </div>
                                                    <h5>Select Delivery Option</h5>
                                                    <?php $__currentLoopData = $deliveryoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <input type="radio" value="<?php echo e($option->id); ?>"
                                                                name="delivery_option"
                                                                <?php if($option->id === 1): ?> checked <?php endif; ?>>
                                                            <label><?php echo e($option->name); ?> -
                                                                <?php echo e($price_symbol . $option->amount); ?></label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="tp_leftbar_box">
                                    <div class="tp_tem_option">
                                        <div class="grid_icon">

                                            <div class="tp_buy_btn">
                                                <a href="javascript:;"
                                                    <?php if(Auth::check()): ?> onclick="addToCart('',1)" <?php else: ?>
                                    data-bs-toggle="modal" data-bs-target="#log_modal" <?php endif; ?>
                                                    class="tp_btn"><img src="<?php echo e($ASSET_URL); ?>assets/images/buynow.png"
                                                        alt="Image" /><?php echo app('translator')->get('master.product_search.buy_now'); ?>
                                                </a>

                                                <button type="button" onclick="addToCart()" class="tp_btn"><img
                                                        src="<?php echo e($ASSET_URL); ?>assets/images/addtocart.png"
                                                        alt="Image" />
                                                    <?php echo app('translator')->get('master.single_product.add_to_cart'); ?>
                                                </button>
                                                <?php if(isset($product->preview_link) && !empty($product->preview_link)): ?>
                                                    <a target="_blank" href="<?php echo e($product->preview_link); ?>"
                                                        class="tp_btn"><img
                                                            src="<?php echo e($ASSET_URL); ?>assets/images/live_preview.png"
                                                            alt="Image" /><?php echo app('translator')->get('master.product_search.live_preview'); ?></a>
                                                <?php endif; ?>

                                                <input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">

                                                <button type="button"
                                                    <?php if(Auth::check()): ?> onclick="addtoWishlist('<?php echo e($product->slug); ?>')"
                                    class="active_red tp_btn tp_btn_wish watchlist_btn" <?php else: ?> data-bs-toggle="modal"
                                    data-bs-target="#log_modal" class="active_red tp_btn tp_btn_wish" <?php endif; ?>><i
                                                        class="fa fa-heart <?php if(@$product->check_in_wishlist()): ?> active <?php endif; ?>"
                                                        aria-hidden="true"></i><?php echo app('translator')->get('master.single_product.add_to_wishlist'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>

                                    <div id="message"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
    </div>
    </div>
    </div>
    <section class="row white-bg">
        <div class="col-sm-12">
            <h2 class="py-5 text-center">Samples</h2>
            <?php
                $preview_imgs_arr = (array) unserialize(@$product_meta->preview_imgs);
            ?>

            <?php $__currentLoopData = array_chunk($preview_imgs_arr, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item-content">
                    <div class="row">

                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">

                                <a href="<?php echo e(getImage($value)); ?>" class="image-popup"
                                    data-mfp-src="<?php echo e(getImage($value)); ?>">
                                    <img src="<?php echo e(getImage($value)); ?>" alt="" class="img-fluid">
                                </a>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>


    <!--===Categories Section Start===-->
    <div class="tp_istop_gallery">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp_main_heading">
                        <h2>GET JOB READY NOW AT AFFORDABLE PRICE</h2>
                        <p>
                            Select a package according to your experience
                        </p>
                    </div>
                </div>
            </div>

            <div class="int_project_gallery">
                <div class="gallery_nav">
                    <ul style="width: 25%;">
                        <?php $__currentLoopData = @$featured_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a data-filter=".category-<?php echo e($row->id); ?>"> <?php echo e($row->name); ?> </a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="int_project_gallery">
                            <div class="gallery_grid">
                                <?php if(!empty($products)): ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="grid-item category-<?php echo e($items->category_id); ?>">
                                            <div class="category-filter-buttons">

                                            </div>
                                            <a href="<?php echo e(route('frontend.services.single_details', $items->slug)); ?>">
                                                <div class=" tp-animation-box">
                                                    <div class="tp_isbox_content">
                                                        <div class="card mb-4 rounded-3 shadow-sm">
                                                            <div class="card-header py-3">
                                                                <h4 class="my-0 fw-normal text-center"><?php echo e($items->name); ?>

                                                                </h4>
                                                            </div>
                                                <div class="card-body">
                                                            <h2 class="card-title pricing-card-title">
                                                                <?php $productPrice = $items->productPrice(); ?>
                                                                <?php if($productPrice['free']): ?>
                                                                    <p>
                                                                        <?php if(!empty($productPrice['price'])): ?>
                                                                            <del><?php echo e($price_symbol . @$productPrice['price']); ?></del>
                                                                        <?php endif; ?> FREE
                                                                    </p>
                                                                <?php elseif($productPrice['price']): ?>
                                                                    <?php if(@$productPrice['offer_price']): ?>
                                                                        <p><del><?php echo e($price_symbol); ?><?php echo e(@$productPrice['price']); ?></del>
                                                                        </p>
                                                                        <p><?php echo e($price_symbol); ?><?php echo e(@$productPrice['offer_price']); ?>

                                                                        </p>
                                                                    <?php else: ?>
                                                                        <p><?php echo e($price_symbol); ?><?php echo e(@$productPrice['price']); ?>

                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <p><?php echo e($price_symbol); ?><?php echo e(@$productPrice['from']); ?></p>
                                                                    <span>-</span>
                                                                    <p><?php echo e($price_symbol); ?><?php echo e(@$productPrice['to']); ?></p>
                                                                <?php endif; ?>
                                                                <small class="text-body-secondary fw-light"></small>
                                                            </h2>
                                                            <ul class="list-unstyled mt-3 mb-4">
                                                                <?php $__currentLoopData = @$items->product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="list-group">
                                                                        <a href="#"
                                                                            class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                                                            style="border: none;" aria-current="true">
                                                                            <img src="<?php echo e($ASSET_URL); ?>assets/images/check.png"
                                                                                alt="twbs" width="32"
                                                                                height="32"
                                                                                class="rounded-circle flex-shrink-0">
                                                                            <div
                                                                                class="d-flex gap-2 w-100 justify-content-between">
                                                                                <div>
                                                                                    <h6 class="mb-0">
                                                                                        <?php echo e(@$val['key']); ?><span><?php echo e(@$val['value']); ?>

                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>



                                                            <a href="javascript:;"
                                                                <?php if(Auth::check()): ?> onclick="addToCart('',1)"
                                                    <?php else: ?> data-bs-toggle="modal" data-bs-target="#log_modal" <?php endif; ?>
                                                                class="tp_btn"><img
                                                                    src="<?php echo e($ASSET_URL); ?>assets/images/buynow.png"
                                                                    alt="Image" /><?php echo app('translator')->get('master.product_search.buy_now'); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                 </div>
                                                
                                            </a>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===Section End===-->
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(asset('user-theme/my_assets/js/product_details.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\way2\resources\views/frontend/services/single_details.blade.php ENDPATH**/ ?>