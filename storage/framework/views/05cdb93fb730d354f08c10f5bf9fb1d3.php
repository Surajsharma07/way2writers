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
<title><?php echo e(@$mTitle); ?></title>
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

<div>
<div style="height: 300px; background-image: url('<?php echo e($ASSET_URL); ?>assets/images/my_images/images/product-banner.jpg'); background-position: center;">

    <div style="display: block; padding: 30px; color: #fff; border-radius: 10px; position: relative; width: 100%;">
        <div style="display: flex; flex-wrap: wrap; box-sizing: border-box;">
            <div style="flex: 1 0 100%; max-width: 100%; padding-right: 15px; padding-left: 15px; box-sizing: border-box;">

                <div style="height: 300px; box-sizing: border-box; margin-top: 30px;">
                    <h3 style="line-height: 30px; text-transform: uppercase; margin-bottom: 20px; font-size: 28px; font-weight: 500; font-family: Poppins; color: #fff; margin-top: 0px;"><?php echo e(@$product->name); ?></h3>
                    <p style="font-size: 16px; font-weight: 600; margin-top: 0px; margin-bottom: 16px; width: 50%; word-wrap: break-word;"><?php echo e(@$product->short_desc); ?></p>

                        <span style="margin-top: 20px; font-size: 16px; display: block; font-weight: 300;">Get the job you deserve with a powerful, interview-winning resume.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===Single Product Details Section Start===-->
<div class="tp_singlepage_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp_in2_text">

                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="tp_template_box">
                    <div class="tp_tem_thumb">
                        <div class="tp_preview_icon">
                            <img src="<?php echo e($product->imageUrl); ?>" alt="Image" />
                            <?php if(!empty($product->preview_link)): ?>
                            <a href="<?php echo e(@$product->preview_link); ?>" class="preview_icon_overlay" target="_blank">
                                <img src="<?php echo e($ASSET_URL); ?>assets/images/preview-icon.png" alt="Image" /></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gallery_nav tp_tem_tab_buttom">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">
                                    <?php echo app('translator')->get('master.single_product.description'); ?>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">
                                    <?php echo app('translator')->get('master.single_product.previews'); ?>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">
                                    <?php echo app('translator')->get('master.single_product.reviews'); ?>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-Comments-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-Comments" type="button" role="tab"
                                    aria-controls="pills-Comments" aria-selected="false">
                                    <?php echo app('translator')->get('master.single_product.comments'); ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="tp_tem_description">
                                <?php echo @$product->description; ?>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="tp_tem_previews">
                                <h3> <?php echo app('translator')->get('master.single_product.previews_nd_screenshots'); ?></h3>
                                <?php if(!empty($product_meta->preview_imgs)): ?>
                                <?php $preview_imgs_arr = (object) unserialize(@$product_meta->preview_imgs); ?>
                                <?php $__currentLoopData = $preview_imgs_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(getImage($value)); ?>" alt="Preview Image" loading="lazy" />
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="tp_tem_comments tp_tem_reviews">
                                <div class="tp_filter_box">
                                    <div class="tp_fil_text">
                                        <h3>
                                            <img src="<?php echo e($ASSET_URL); ?>assets/images/three_star.png" alt="Image" />
                                            <?php echo e(@$product->getProductReview->count()); ?> Reviews for this product
                                        </h3>
                                    </div>
                                    <div class="tp_fil_range">
                                        <ul>
                                            <li><?php echo app('translator')->get('master.single_product.filter_by_rating'); ?></li>
                                            <li>
                                                <div class="tp_select_box">
                                                    <select class="wide tp_nice_select" id="filter_rating"
                                                        onchange="search_rating()">
                                                        <option value="">Star</option>
                                                        <?php for($i = 1; $i <= 5; $i++): ?> <option value="<?php echo e($i); ?>"><?php echo e($i); ?>

                                                            Star</option>
                                                            <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tp_comments_box" id="review_search_box">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Comments" role="tabpanel"
                            aria-labelledby="pills-Comments-tab">
                            <div class="tp_tem_comments">
                                <div class="tp_comm_box">
                                    <form method="POST" id="add-product-comment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-outline form-white">
                                            <label class="form-label fw-semibold"
                                                for="comment"><?php echo app('translator')->get('master.single_product.add_comment'); ?></label>
                                            <textarea name="comment" rows="3" cols="30"
                                                class="form-control come comment-text-area"
                                                placeholder="Add a comment here..." <?php if(!Auth::check()): ?> disabled
                                                <?php endif; ?>></textarea>
                                            <button class="tp_btn tp_btn_post" <?php if(!Auth::check()): ?>
                                                data-bs-toggle="modal" data-bs-target="#log_modal" type="button" <?php else: ?>
                                                type="submit" <?php endif; ?>
                                                id="add-product-comment-form-btn"><?php echo app('translator')->get('master.single_product.post_comment'); ?></button>
                                        </div>
                                        <input type="hidden" name="product_id" id="product_id"
                                            value="<?php echo e(@$product->id); ?>">
                                    </form>
                                </div>
                                <div class="tp_filter_box">
                                    <div class="tp_fil_text">
                                        <h3>
                                            <img src="<?php echo e($ASSET_URL); ?>assets/images/comment_icon.png" alt="Image" />
                                            <?php echo e(@$product->getProductComment->count()); ?>

                                            <?php echo app('translator')->get('master.single_product.comments_found'); ?>
                                        </h3>
                                    </div>
                                    <div class="tp_fil_range">
                                        <ul>
                                            <li>Filter By</li>
                                            <li>
                                                <div class="tp_select_box">
                                                    <select onchange="search_comment()" id="filter_month"
                                                        class="tp_nice_select">
                                                        <option value=""> Month
                                                        </option>
                                                        <?php for($m = 1; $m <= 12; $m++): ?> <?php $month=date('M',
                                                            mktime(0,0,0,$m, 1, date('Y'))); ?> <option
                                                            value="<?php echo e($m); ?>">
                                                            <?php echo e($month); ?></option>
                                                            <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tp_select_box">
                                                    <select onchange="search_comment()" id="filter_year"
                                                        class="wide tp_nice_select">
                                                        <option value="" selected> Year
                                                        </option>
                                                        <option value="<?php echo e(date('Y')); ?>"><?php echo e(date('Y')); ?>

                                                        </option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tp_comments_box" id="cmd_search_box">
                                </div>
                                <div class="text-center mt-2">
                                    <button type="button" class="tp_btn border rounded-pill d-none"
                                        id="load_more_cmd_button"
                                        data="2"><?php echo app('translator')->get('master.product_search.Loadmore'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tp_add_image" id="advertize-ad"></div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-12">
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
                                                    <h2><span></span><?php echo e($price_symbol . @$product->price); ?></h2>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
 
                                <?php if($product->category_id != 2): ?>
    <div><br>
        <input type="checkbox" value="1" name="include_cover_letter">
        <label>Include Cover Letter (<?php echo e($price_symbol); ?>350)</label>
    </div>
<?php endif; ?>

                                
<div class="tp_product_detailhead">
<h4>Select Delivery Option</h4>
</div>
<?php $__currentLoopData = $deliveryoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div>
<input type="radio" value="<?php echo e($option->id); ?>" name="delivery_option" <?php if($option->id === 1): ?> checked <?php endif; ?>>
<label><?php echo e($option->name); ?> - <?php echo e($price_symbol . $option->amount); ?></label>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
</div>
</div> 
    </div>
</div>
</div>
<div class="tp_product_detailhead">
                    </div>
                   <div class="tp_leftbar_box">
                        <div class="tp_tem_option">
                            <div class="grid_icon">
                               
                            <div class="tp_buy_btn">
                                <a href="javascript:;" <?php if(Auth::check()): ?> onclick="addToCart('',1)" <?php else: ?>
                                    data-bs-toggle="modal" data-bs-target="#log_modal" <?php endif; ?> class="tp_btn"><img
                                        src="<?php echo e($ASSET_URL); ?>assets/images/buynow.png"
                                        alt="Image" /><?php echo app('translator')->get('master.product_search.buy_now'); ?>
                                </a>

                                <button type="button" onclick="addToCart()" class="tp_btn"><img
                                        src="<?php echo e($ASSET_URL); ?>assets/images/addtocart.png" alt="Image" />
                                    <?php echo app('translator')->get('master.single_product.add_to_cart'); ?>
                                </button>
                                <?php if(isset($product->preview_link) && !empty($product->preview_link)): ?>
                                <a target="_blank" href="<?php echo e($product->preview_link); ?>" class="tp_btn"><img
                                        src="<?php echo e($ASSET_URL); ?>assets/images/live_preview.png"
                                        alt="Image" /><?php echo app('translator')->get('master.product_search.live_preview'); ?></a>
                                <?php endif; ?>

                                <input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">

                                <button type="button" <?php if(Auth::check()): ?>
                                    onclick="addtoWishlist('<?php echo e($product->slug); ?>')"
                                    class="active_red tp_btn tp_btn_wish watchlist_btn" <?php else: ?> data-bs-toggle="modal"
                                    data-bs-target="#log_modal" class="active_red tp_btn tp_btn_wish" <?php endif; ?>><i
                                        class="fa fa-heart <?php if(@$product->check_in_wishlist()): ?> active <?php endif; ?>"
                                        aria-hidden="true"></i><?php echo app('translator')->get('master.single_product.add_to_wishlist'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>

<!--===product details===-->

                <div class="tp_leftbar_box">
                    <div class="tp_product_detailhead">
                        <h4><?php echo app('translator')->get('master.single_product.product_details'); ?></h4>
                    </div>
                    <div class="tp_product_detail">
                        <?php if(@$product->product_details[0]): ?>
                        <ul>
                            <?php $__currentLoopData = @$product->product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e(@$val['key']); ?><span><?php echo e(@$val['value']); ?></span></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
               
                                    
            </div>
        </div>
    </div>
</div>
<!--===Categories Section Start===-->
<div class="tp_istop_gallery">
    <div class="container">
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
                                <a
href="<?php echo e(route('frontend.services.single_details', $items->slug)); ?>">
                                    <div class="tp_istop_box tp-animation-box">
                                        <div class="grid_img">
                                            <span class="tp-product-list-img tp-animation">
                                                <img src="<?php echo e($items->thumb); ?>" class="tp-animation-img"
                                                    alt="project-img" />
                                            </span>
                                        </div>
                                        <div class="tp_isbox_content">
                                            <div class="bottom_content">
                                                <h5><?php echo e($items->name); ?></h5>
                                                <p>also includes</p>
                                            </div>
                                            <div class="tp_product_detail">
                                                <?php if(@$items->product_details[0]): ?>
                                                <ul>
                                                    <?php $__currentLoopData = @$items->product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                        style="background:rgb(241, 241, 241) none repeat scroll 0% 0% / auto padding-box border-box;padding:10px 0px;text-align:center;list-style:outside none none;color:rgb(34, 34, 34);box-sizing:border-box;">
                                                        <i aria-hidden="true"
                                                            style="display:inline-block;font-style:normal;font-variant:normal;font-kerning: auto;font-optical-sizing: auto;font-feature-settings:normal;font-variation-settings:normal;font-weight:400;font-stretch:100%;line-height:14px;font-family:FontAwesome;font-size:14px;text-rendering: auto;-webkit-font-smoothing:antialiased;box-sizing:border-box;"></i><?php echo e(@$val['key']); ?><span><?php echo e(@$val['value']); ?></span></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <?php endif; ?>
                                            </div>
                                           

                                            <div class="addto_cart tp_live_home">

                                                <?php $productPrice = $items->productPrice(); ?>
                                                <div class="tp_flex_price_st">
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
                                                </div>
                                                
                                                <a href="javascript:;" <?php if(Auth::check()): ?> onclick="addToCart('',1)"
                                                    <?php else: ?> data-bs-toggle="modal" data-bs-target="#log_modal" <?php endif; ?>
                                                    class="tp_btn"><img src="<?php echo e($ASSET_URL); ?>assets/images/buynow.png"
                                                        alt="Image" /><?php echo app('translator')->get('master.product_search.buy_now'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="tp-pro-icon">
                                    <button type="button" <?php if(Auth::check()): ?>
                                        onclick="addtoWishlist('<?php echo e($items->slug); ?>')" class="watchlist_btn" <?php else: ?>
                                        data-bs-toggle="modal" data-bs-target="#log_modal" <?php endif; ?>><i
                                            class="fa fa-heart <?php if(@$items->check_in_wishlist()): ?> active <?php endif; ?>"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
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
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/services/single_details.blade.php ENDPATH**/ ?>