  <!--===Header Section Start===-->
  <div class="tp_header_navbar">
     
  </div>

  <?php if(Route::is('frontend.product.search')): ?>
      <div class="tp_banner_section tp_single_section tp_single_search">
          <div class="container">
              <div class="tp_banner_heading">
                  <h2><?php echo app('translator')->get('master.product_search.title'); ?></h2>
                  <p>
                      <?php echo app('translator')->get('master.product_search.heading'); ?>
                  </p>
                  <form action="<?php echo e(route('frontend.product.search')); ?>" method="GET">
                      <div class="tp_search_box">
                          <div class="tp_niceselect_box">
                              <select name="category" class="tp_nice_select">
                                  <option value=""><?php echo app('translator')->get('master.home.choose_category'); ?></option>
                                  <?php if(!empty($featured_category)): ?>
                                      <?php $__currentLoopData = @$featured_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($row->slug); ?>"
                                              <?php if(request('category') == $row->slug): ?> selected <?php endif; ?>><?php echo e($row->name); ?>

                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                              </select>
                          </div>
                          <input type="text" placeholder="<?php echo app('translator')->get('master.home.search_template_here'); ?>" id="search_text" name="keyword"
                              value="<?php echo e(request('keyword')); ?>" />
                          <button type="submit" class="tp_btn"><?php echo app('translator')->get('master.home.search'); ?></button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  <?php endif; ?>

  <!--===Header Section End===-->
<?php /**PATH C:\xampp\htdocs\way2\resources\views/frontend/layout/inner_header.blade.php ENDPATH**/ ?>