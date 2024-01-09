<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('image'); ?>
<img src="<?php echo e(Storage::url(getSetting()->not_found_img)); ?>" height="500px" width="500px">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('message', __('Not Found')); ?>

<?php echo $__env->make('errors::illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/errors/404.blade.php ENDPATH**/ ?>