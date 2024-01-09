<?php
    $ASSET_URL = asset('user-theme') . '/';
    $setting = getSetting();
    $price_symbol = $setting->default_symbol ?? '$';
?>

<?php $__env->startSection('head_scripts'); ?>
    <title><?php echo app('translator')->get('page_title.Frontend.user_profile_title'); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head_css'); ?>
    <link rel="stylesheet" href="<?php echo e($ASSET_URL); ?>assets/css/rating.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--===User Profile Section Start===-->
    <div class="tp_propage_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp_propage_head">
                        <h2><?php echo app('translator')->get('master.user_profile.welcome_back'); ?></h2>
                        <p><?php echo app('translator')->get('master.user_profile.profile_heading'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row tp_propage_text">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link <?php if(empty(request('tab'))): ?> active <?php endif; ?>" id="v-pills-profile-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="true"><i class="fa fa-user"
                                aria-hidden="true"></i><?php echo app('translator')->get('master.user_profile.my_profile'); ?>
                        </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-change_password" type="button" role="tab"
                            aria-controls="v-pills-change_password" aria-selected="true"><i class="fa fa-lock"
                                aria-hidden="true"></i><?php echo app('translator')->get('master.user_profile.change_password'); ?>
                        </button>
                        <button class="nav-link <?php if(request('tab') == 'my-orders'): ?> active <?php endif; ?>" id="v-pills-invoice-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-invoice" type="button" role="tab"
                            aria-controls="v-pills-invoice" aria-selected="false"><i class="fa fa-file-text"
                                aria-hidden="true"></i><?php echo app('translator')->get('master.user_profile.my_order'); ?>
                        </button>
                        <button href="#v-pills-download" class="nav-link <?php if(request('tab') == 'my-downloads'): ?> active <?php endif; ?>"
                            id="v-pills-download-tab" data-bs-toggle="pill" data-bs-target="#v-pills-download"
                            role="tab" aria-controls="v-pills-download" aria-selected="false"><i class="fa fa-download"
                                aria-hidden="true"></i><?php echo app('translator')->get('master.user_profile.my_download'); ?>
                        </button>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade  <?php if(empty(request('tab'))): ?> show active <?php endif; ?>"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead">
                                    <h3><?php echo app('translator')->get('master.user_profile.personal_details'); ?></h3>
                                </div>
                                <form action="<?php echo e(route('frontend.update_profile')); ?>" method="Post"
                                    id="update_user_details">
                                    <?php echo csrf_field(); ?>
                                    <div class="tp_propage_profile_form">
                                        <div class="tp_input_main">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card-body text-center">
                                                        <div class="tp_user_img">
                                                            <img src="<?php if(!empty($user->avatar)): ?> <?php echo e($user->avatar); ?> <?php else: ?> <?php echo e($ASSET_URL . 'assets/images/user-profile.png'); ?> <?php endif; ?>"
                                                                alt="avatar" title="avatar" class="rounded-circle"
                                                                width="150px" height="150px" id="Imagepreview" />
                                                            <div class="tp_user_edit">
                                                                <i id="OpenImgUpload"
                                                                    class="text-left fa fa-cloud-upload d-block"></i>
                                                            </div>
                                                            <input type="file" name="image" id="imgupload"
                                                                onchange="uploadImage('imgupload')" style="display:none" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.contact_email'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Email" name="email"
                                                            value="<?php echo e(@$user->email); ?>" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.full_name'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter full Name" name="full_name"
                                                            value="<?php echo e(@$user->full_name); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.user_name'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter User Name" name="username"
                                                            value="<?php echo e(@$user->username); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.mobile_number'); ?></label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Enter Mobile Number" name="mobile"
                                                            value="<?php echo e(@$user->mobile); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.country'); ?></label>
                                                        <select class="form-control form-control-lg input-font"
                                                            name="country_id">
                                                            <option value=""><?php echo app('translator')->get('master.user_profile.select_country'); ?></option>
                                                            <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($item->id); ?>"
                                                                    <?php if(@$user->country_id == $item->id): ?> selected <?php endif; ?>>
                                                                    <?php echo e($item->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.state'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your state" name="state"
                                                            value="<?php echo e(@$user->state); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.city'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your City" name="city"
                                                            value="<?php echo e(@$user->city); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="tp_input_text">
                                                        <label class="form-label"><?php echo app('translator')->get('master.user_profile.address'); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Address" name="address"
                                                            value="<?php echo e(@$user->address); ?>">

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <button class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn"
                                                        type="submit"
                                                        id="update_user_details_btn"><?php echo app('translator')->get('master.user_profile.update'); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-change_password" role="tabpanel"
                            aria-labelledby="v-pills-change_password-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead">
                                    <h3><?php echo app('translator')->get('master.user_profile.change_password'); ?></h3>
                                </div>
                                <form action="<?php echo e(route('frontend.change-password')); ?>" method="Post"
                                    id="change_password_form_id">
                                    <?php echo csrf_field(); ?>
                                    <div class="tp_propage_profile_form">
                                        <div class="tp_input_main">
                                            <div class="tp_input_text">
                                                <label class="form-label"><?php echo app('translator')->get('master.user_profile.old_password'); ?></label>
                                                <input type="password" name="old_password" class="form-control"
                                                    placeholder="Enter Your Old Password" />

                                            </div>
                                            <div class="tp_input_text">
                                                <label class="form-label"><?php echo app('translator')->get('master.user_profile.new_password'); ?></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter Your Password" />
                                            </div>
                                            <div class="tp_input_text">
                                                <label class="form-label"><?php echo app('translator')->get('master.user_profile.confirm_password'); ?></label>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    placeholder="Enter Your confirm password" />

                                            </div>
                                            <button class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn" type="submit"
                                                id="change_password_form_id_btn"><?php echo app('translator')->get('master.user_profile.update'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if(request('tab') == 'my-orders'): ?> active <?php endif; ?>" id="v-pills-invoice"
                            role="tabpanel" aria-labelledby="v-pills-invoice-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead tp_propage_invoice">

                                    <h3><?php echo app('translator')->get('master.billing_details.orders'); ?></h3>
                                </div>
                                <div class="tp_table_box tp_propage_table">
                                    <div class="table-responsive">
                                        <table id="example" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo app('translator')->get('master.billing_details.tnx_number'); ?></th>
                                                    <th><?php echo app('translator')->get('master.billing_details.amount'); ?></th>
                                                    <th><?php echo app('translator')->get('master.billing_details.payment_date'); ?></th>
                                                    <th><?php echo app('translator')->get('master.billing_details.status'); ?></th>
                                                    <th><?php echo app('translator')->get('master.billing_details.invoice'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($user->getOrders[0])): ?>
                                                    <?php $__currentLoopData = $user->getOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e(++$key); ?></td>
                                                            <td><?php echo e($items->tnx_id); ?></td>
                                                            <td><?php echo e($price_symbol); ?><?php echo e(@$items->billing_total); ?></td>
                                                            <td><?php echo e(set_date_format($items->created_at)); ?></td>
                                                            <td>
                                                                <?php echo e($items->status); ?>


                                                            </td>
                                                            <td>
                                                                <ul>
<li><a href="<?php echo e(route('frontend.download-invoice', ['tnx_id' => $items->tnx_id])); ?>"
                                                                            class="tp_edit" title="Edit"><i
                                                                                class="fa fa-eye"
                                                                                aria-hidden="true"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <tr class="text-center">
                                                        <td colspan="5"><?php echo app('translator')->get('master.billing_details.not_found'); ?></td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if(request('tab') == 'my-downloads'): ?> show active <?php endif; ?>"
                            id="v-pills-download" role="tabpanel" aria-labelledby="v-pills-download-tab">
                            <div class="tp_propage_profile_wrapper">
                                <div class="tp_propage_profilehead tp_propage_pay">
                                    <h3><?php echo app('translator')->get('master.billing_details.download'); ?></h3>
                                </div>
<div class="tp_propage_download">
    <div class="row">
        <?php if(isset($user->getOrders[0])): ?>
            <?php $__currentLoopData = $user->getOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $items1->getOrderProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $items2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $items2->getProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tp_pro_downbox">
                                <div class="tp_download_text">
                                    <div class="tp_download_text_head">
                                         
                                    <h4>Order Id: <?php echo e($items2->order_id); ?></h4>
                                     <?php
                    $orderStatus = $items1->status; // Replace 'status' with the actual attribute for order status
                ?>

                <div class="progress mt-3">
                    <?php if($orderStatus == 'Fail'): ?>
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Order Failed</div>
                    <?php elseif($orderStatus == 'Order Received'): ?>
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Order Received</div>
                    <?php elseif($orderStatus == 'proccessing'): ?>
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Processing</div>
                    <?php elseif($orderStatus == 'Complete'): ?>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Delivered</div>
                    <?php else: ?>
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Unknown Status</div>
                    <?php endif; ?>
                </div>
                                     <h5><?php echo e($items->name); ?></h5>
                                    <p>Delivery: <?php echo e($items2->delivery_option_name); ?></p>
                                    <?php if($items2->include_cover_letter): ?>
                                        <?php if($items2->cover_letter_path): ?>
                                            <p>Include Cover Letter: Yes</p>
                                        <?php else: ?>
                                            <p>Include Cover Letter: Yes</p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </div>
                                    
                                    <div class="tp-dwld-toggle">

                                        <div class="dropdown">
                                         <?php if($orderStatus == 'Complete'): ?>
                                            <button class="btn tp_btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Download
                                            </button>
                                         
<?php $fileArr = $items->getdownlaodfilelink($items2->order_id); ?>
<?php if(count($fileArr) > 0): ?>
    <ul class="dropdown-menu">
        <?php $__currentLoopData = $fileArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="dropdown-item" href="<?php echo e(asset($value['file_path'])); ?>" download>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <?php echo e($value['file_name']); ?>

                </a>
            </li>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
       <?php endif; ?>
<?php endif; ?>
                                        </div>
 <?php if($orderStatus == 'Complete'): ?>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#reviewmodal" class="btn tp_btn tp_rev_btn"
                                            onclick="setReview('<?php echo e($items->thumb); ?>', '<?php echo e($items->slug); ?>', '<?php echo e(@$items1->tnx_id); ?>', '<?php echo e(@$items->getUserProductReview->id); ?>', '<?php echo e(@$items->getUserProductReview->rating); ?>')">
                                            Review
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="r_comment_<?php echo e(@$items->getUserProductReview->id); ?>" value="<?php echo e(@$items->getUserProductReview->comment); ?>">
                               
                                </div>
                                
                            </div>
                        </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No Download Found.</p>
        <?php endif; ?>
        
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=== Section Start===-->
    
    <div class="modal fade" id="reviewmodal" tabindex="-1" aria-labelledby="reviewmodallabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bdr-radius rounded-4 overflow-hidden">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card bg-white text-dark shadow-none tp_review_model_wrapper">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="card-body">
                                <form method="post" class="tp_review_form" id="user_set_review"
                                    action="<?php echo e(route('admin.rating.store')); ?>">
                                    <div class="tp_review_box">
                                        <img id="md-review-img" src="" class="tp-review-img" alt="review-img">
                                        <div class="tp_review_box_data">
                                            <h3><?php echo app('translator')->get('master.review_model.product'); ?></h3>
                                            <div class="tp_review_star">
                                                <p><?php echo app('translator')->get('master.review_model.star_rate'); ?></p>

                                                <div class="col">
                                                    <div class="rate">
                                                        <input type="radio" id="star5" class="rate"
                                                            name="rating" value="5" />
                                                        <label for="star5" title="text"><?php echo app('translator')->get('master.review_model.5_stars'); ?></label>
                                                        <input type="radio" checked id="star4" class="rate"
                                                            name="rating" value="4" />
                                                        <label for="star4" title="text"><?php echo app('translator')->get('master.review_model.4_stars'); ?></label>
                                                        <input type="radio" id="star3" class="rate"
                                                            name="rating" value="3" />
                                                        <label for="star3" title="text"><?php echo app('translator')->get('master.review_model.3_stars'); ?></label>
                                                        <input type="radio" id="star2" class="rate"
                                                            name="rating" value="2">
                                                        <label for="star2" title="text"><?php echo app('translator')->get('master.review_model.2_stars'); ?></label>
                                                        <input type="radio" id="star1" class="rate"
                                                            name="rating" value="1" />
                                                        <label for="star1" title="text"><?php echo app('translator')->get('master.review_model.1_stars'); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tp_reviewform_box">
                                        <div class="tp_input_text">
                                            <textarea placeholder="Write a review here... " class="form-control" id="rt_comment" name="comment" rows="3"
                                                cols="50"></textarea>
                                        </div>
                                        <button id="user_set_review_btn"
                                            class="btn btn-color btn-lg px-5 py-2 btn-font tp_btn" type="submit">post
                                            Review</button>
                                    </div>
                                    <input type="hidden" name="pid" id="_pid" value="">
                                    <input type="hidden" name="txid" id="_txid" value="">
                                    <input type="hidden" name="rid" id="_rate_id" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('user-theme/my_assets/js/validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/user/profile.blade.php ENDPATH**/ ?>