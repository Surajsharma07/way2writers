
<?php $__env->startSection('head_scripts'); ?>
<title>blogs</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="tp_main_content_wrappo">
    <div class="tp_tab_wrappo">
        <ul>
        <li><a href="<?php echo e(route('admin.blog.create')); ?>">Add blogs</a></li>
            <li class="active" ><a href="<?php echo e(route('admin.blog.index')); ?>">Manage blogs</a></li>
        </ul>
    </div>
    <div class="tp_tab_content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="tp_table_box tp_table_pages">
                    <div class="table-responsive">
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slugs</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($data->count() > 0): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="table_row_<?php echo e($item->id); ?>">
                                            <td ><?php echo e(++$key); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->slug); ?></td>
                                            <td><?php echo e(Illuminate\Support\Str::limit($item->description, $limit = 100, $end = '...')); ?></td>
                                            <td> <img src="<?php echo e(asset('storage/' . $item->image)); ?>" max-height="400px" width="200px"></td>
                                            <td>
                                                <ul>
                                                    <li><a href="<?php echo e(route('admin.blog.edit', $item->id)); ?>"
                                                            class="tp_edit tp_tooltip" title="Edit"><i class="fa fa-pencil"
                                                                aria-hidden="true"></i>
                                                                <span class="tp_tooltiptext">
                                                                    <p>Edit</p>
                                                                </span>
                                                            </a></li>
                                                            <li><a href="#" class="tp_delete tp_tooltip" title="Delete"
                                                                onclick="delete_single_details('<?php echo e(route('admin.blog.destroy', $item->id)); ?>',<?php echo e($item->id); ?>)"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i>
                                                                    <span class="tp_tooltiptext">
                                                                    <p>Delete</p>
                                                                </span>
                                                            </a>
                                                        </li>
                                                   
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="text-center">
                                        <td colspan="7">No Record Found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/admin/blog/index.blade.php ENDPATH**/ ?>