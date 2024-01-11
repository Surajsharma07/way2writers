    <link href="https://www.way2writers.com/css/bootstrap.css" rel="stylesheet" />

  <div class="row">
		<div class="col-sm-12 social-strip">
			<div class="navbar cus-row">
				<a class="navbar-brand font18 headcall bold"  href="tel:919599889860">
<i class="bi bi-telephone" aria-hidden="true" style="color:#FFFFFF;"></i>
+91 95998 89860
				</a>
				<div class="navbar-nav-scroll">
					<ul class="nav justify-content-end">
						<li class="nav-item">
							<a class="nav-link" href="https://m.youtube.com/channel/UC-zU_pHjAD-4j5VgJsaUAwA" target="_blank" rel="noopener" aria-label="#">
								<i class="bi bi-youtube" aria-hidden="true" style="color:#FFFFFF;"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://www.facebook.com/Way2writerscom-372947246531912/" target="_blank" rel="noopener" aria-label="#">
																<i class="bi bi-facebook" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://www.linkedin.com/company/way2writers321/" target="_blank" rel="noopener" aria-label="#">
																<i class="bi bi-linkedin" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" target="_blank" rel="noopener" aria-label="#">
								<i class="bi bi-twitter" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
					
					</ul>
				</div>
                </div>
                </div>
                 <div class="container-fluid bg-white wrapper">
		<div class="row slideshow-bg">
			<div class="col-sm-12" style="
    margin: 0;
    padding: 0;
">
			<!--Parent Container Ends -->

              <div class="tp_header_box" style=" background-color: transparent; box-shadow: none; padding: 20px 30px;   font-family: 'Poppins';
   font-size: large;">    <div class="tp_header_logo">
        <a href="<?php echo e(route('frontend.home')); ?>">
            <img src="<?php echo e($STORAGE_URL . @$setting->my_logo); ?>" alt="logo" />
        </a>
    </div>
    <div class="tp_nav_main">
        <div class="tp_header_menu">
            <ul>
                <?php if(@$setting->is_check_home): ?>
                    <li <?php if(Route::is('frontend.home')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('frontend.home')); ?>">
                            <?php echo app('translator')->get('master.header.Home'); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(@$setting->is_check_about): ?>
                    <li <?php if(Route::is('frontend.about-us')): ?> class="active" <?php endif; ?>><a
                            href="<?php echo e(route('frontend.about-us')); ?>"> <?php echo app('translator')->get('master.header.About_Us'); ?></a>
                    </li>
                <?php endif; ?>

              <?php if(@$setting->is_check_product): ?>
                    <li <?php if(Route::is('frontend.product.search')): ?> class="active" <?php endif; ?>>
                            <?php echo app('translator')->get('master.header.Products'); ?>
              
                        <?php  $featured_category = getFeaturedCategory(); ?>
                        <ul class="tp_head_dropdown">

                            <?php if(!empty($featured_category)): ?>
                                <?php $__currentLoopData = @$featured_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a
                                            href="<?php echo e(route('frontend.services.single_details', $row->slug)); ?>">
                                            <?php echo e($row->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
               
     <?php if(@$setting->is_check_terms_and_condition): ?>
                    <li <?php if(Route::is('frontend.terms-and-conditions')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('frontend.terms-and-conditions')); ?>"><?php echo app('translator')->get('master.header.Terms_of_services'); ?></a>
                    </li>
                <?php endif; ?>

                <?php if(@$setting->is_check_privacy_policy): ?>
                    <li <?php if(Route::is('frontend.privacy-policy')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('frontend.privacy-policy')); ?>"><?php echo app('translator')->get('master.header.Privacy_Policy'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(@$setting->is_check_contact): ?>
                    <li <?php if(Route::is('frontend.contact-us')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('frontend.contact-us')); ?>"><?php echo app('translator')->get('master.header.Contact_Us'); ?></a>
                    </li>
                <?php endif; ?>
<li <?php if(Route::is('frontend.blogs.index')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('frontend.blogs.index')); ?>">Blogs</a>
                    </li>
               <?php if(@$setting->is_check_language): ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-language fa-lg" aria-hidden="true"></i>
                        </a>
                        <?php  $lang = getlanguage(); ?>
                        <ul class="tp_head_dropdown">
                            <?php if(!empty($lang)): ?>
                                <?php $__currentLoopData = @$lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('frontend.setlang', $row->short_name)); ?>">
                                            <?php echo e($row->name); ?> </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
        <div class="tp_toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="tp_header_login ">
            <?php if(Auth::check()): ?>
             <div class="tp_head_logged" style="
    border: none;
">
                    <div class="tp_head_cart">
                        <a href="<?php echo e(route('frontend.cart.index')); ?>">
                            <?php if(Cart::instance('default')->count() > 0): ?>
                                <span><?php echo e(Cart::instance('default')->count()); ?></span>
                            <?php endif; ?>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="tp_head_cart">
                        <a href="<?php echo e(route('frontend.wishlist')); ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-block text-decoration-none" data-bs-toggle="dropdown"
                            aria-expanded="false" id="dropdownMenuLink" role="button">
                            <img src="<?php if(!empty(@$auth_user->avatar)): ?> <?php echo e(@$auth_user->avatar); ?> <?php else: ?> <?php echo e(@$STORAGE_URL . @$setting->default_user_image); ?> <?php endif; ?>"
                                alt="<?php echo e(@$auth_user->full_name); ?>" title="<?php echo e(@$auth_user->full_name); ?>" width="32"
                                height="32" class="rounded-circle" />
                        </a>

                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownMenuLink"
                            data-popper-placement="bottom-start">
                            <li>
                                <strong class="dropdown-item" href="#"><?php echo e(@$auth_user->full_name); ?></strong>
                            </li>
                            <?php if(@$auth_user->role == 0): ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('master.header.Dashboard'); ?></a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo e(route('frontend.profile')); ?>"><?php echo app('translator')->get('master.header.Profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('frontend.profile', ['tab' => 'my-orders'])); ?>"><?php echo app('translator')->get('master.header.My_Order'); ?></a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo e(route('frontend.profile', ['tab' => 'my-downloads'])); ?>"><?php echo app('translator')->get('master.header.My_Downloads'); ?>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo e(route('frontend.logout')); ?>"><?php echo app('translator')->get('master.header.Sign_out'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('frontend.sign-in')); ?>" class="tp_btn"><?php echo app('translator')->get('master.header.Login'); ?></a>
            <?php endif; ?>
            
        </div>
        
       
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\way2\resources\views/frontend/layout/nav.blade.php ENDPATH**/ ?>