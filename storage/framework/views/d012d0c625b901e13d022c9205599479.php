 <!--===fa rating with count End===-->
<?php if(isset($faRating)): ?>
    <ul>
        <?php $r = $rating; ?>
        <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php if($r > 0): ?>
                    <?php if($r > 0.5): ?>
                        <i class="fa fa-star active" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    <?php endif; ?>
                <?php else: ?>
                    <i class="fa fa-star"></i>
                <?php endif; ?>
                <?php $r--; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e(number_format($rating, 1)); ?></li>
    </ul>
<?php endif; ?>
 <!--===Related Slider End===-->
 <!--===fa without count rating End===-->
<?php if(isset($faWithoutCountRating)): ?>
    <ul>
        <?php $r = $rating; ?>
        <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php if($r > 0): ?>
                    <?php if($r > 0.5): ?>
                        <i class="fa fa-star active" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    <?php endif; ?>
                <?php else: ?>
                    <i class="fa fa-star"></i>
                <?php endif; ?>
                <?php $r--; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>
 <!--=== End===-->

 <!--===Testimonial Rating End===-->
<?php if(isset($testimonialRating)): ?>
    <ul>
        <?php $r = $rating; ?>
        <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php if($r > 0): ?>
                    <?php if($r > 0.5): ?>
                        <i class="fa fa-star active fa-yellow" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fa fa-star-half-o active fa-yellow" aria-hidden="true"></i>
                    <?php endif; ?>
                <?php else: ?>
                    <i class="fa fa-star"></i>
                <?php endif; ?>
                <?php $r--; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>
 <!--===Testimonial End===-->
<?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/include/rating.blade.php ENDPATH**/ ?>