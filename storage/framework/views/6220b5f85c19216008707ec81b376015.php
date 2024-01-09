<?php $__env->startSection('head_scripts'); ?>
<title><?php echo app('translator')->get('page_title.Admin.contactus_page_title'); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="tp_main_content_wrappo">
    <div class="tp_tab_wrappo">
        <h4 class="tp_heading">Contact Us List</h4>
    </div>
    <div class="tp_tab_content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="tp_table_box">
                    <div class="table-responsive">
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                      <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($data->count() > 0): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="table_row_<?php echo e($item->id); ?>">
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e($item->message); ?> </td>
                                            <td> 
                                            <?php if($item->filepath): ?> <ul><li><a href="<?php echo e(asset('storage/' . $item->filepath)); ?>"
                                                            class="tp_edit tp_tooltip" title="Edit"><i class="fa fa-file"
                                                                aria-hidden="true"></i>
                                                                <span class="tp_tooltiptext">
                                                                    <p>Edit</p>
                                                                </span>
                                                            </a></li></ul><?php endif; ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="text-center">
                                        <td colspan="4">No Record Found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="tp-pagination-wrapper">
                            <?php echo e(@$data->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/single/contactus.blade.php ENDPATH**/ ?>