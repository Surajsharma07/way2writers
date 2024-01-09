<?php  $ASSET_URL = asset('admin-theme').'/'; ?>

<?php $__env->startSection('head_scripts'); ?>
<title><?php echo app('translator')->get('page_title.Admin.page_title'); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <ul>
                <li><a href="<?php echo e(route('admin.blog.index')); ?>">Manage Blogs</a></li>
                <li class="active"><a href="#">Edit Blogs</a></li>
            </ul>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form id="pages-post-form" action="<?php echo e(route('admin.blog.store')); ?>" method="POST"  enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="tp_catset_box tp_add_pages">
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Name<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name"
                                    value="<?php echo e(@$data->name); ?>">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Slug<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Slug" name="slug"
                                    value="<?php echo e(@$data->slug); ?>" >
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                    <div class="tp_form_wrapper">
                                        <label class="mb-2">Image<sup>*</sup></label>
                                        <input type="file" class="form-control" name="image" id='image'
                                            placeholder="Upload image">
                                        <?php if(isset($data->image)): ?>
                                            <input class="form-control" type="hidden" name="image"
                                                value="<?php echo e(@$data->image); ?>">
                                            <div class="tp_form_wrapper mt-2">
                                            <img src="<?php echo e(asset('storage/' . $data->image)); ?>" max-height="200px" width="200px">

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <div class="col-lg-6 col-md-12">
    <div class="tp_form_wrapper tp_pro_selectcat">
        <label class="mb-2">Blog Category<sup>*</sup></label>
        <div class="tp_custom_select tp_select_product">
            <select class="form-select" aria-label="" name="category_id">
                <option value="<?php echo e(@$data->category_id); ?>">Choose category</option>
                <?php $__empty_1 = true; $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($row->id); ?>" <?php echo e(@$data->category_id == $row->id ? 'selected' : ''); ?>>
                        <?php echo e($row->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option value="<?php echo e(@$data->category_id); ?>" disabled>No categories found</option>
                <?php endif; ?>
            </select>
            <label id="category_id-error" class="error" for="category_id"></label>
        </div>
    </div>
</div>

                          
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Content</label>
                                <textarea id="theme-editor" placeholder="Enter Content" name="description" rows="5" cols="50"><?php echo e(@$data->description); ?></textarea>
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Meta Title<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Title" name="meta_title"
                                    value="<?php echo e(@$data->meta_title); ?>">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Meta keywords<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter description"
                                    name="meta_keyword" value="<?php echo e(@$data->meta_keyword); ?>">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Sub Description<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter description" name="meta_description"
                                    value="<?php echo e(@$data->meta_description); ?>">
                            </div>
                            <div class="clearfix"></div>
                            <input type="hidden" value="<?php echo e(@$data->id); ?>" name="id">
                            <div class="tp_addpages_btn">
                                <button type="submit" class="tp_btn" id="pages-post-form-btn">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/blog/create.blade.php ENDPATH**/ ?>