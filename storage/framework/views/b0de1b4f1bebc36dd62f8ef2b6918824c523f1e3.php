<div class="row">
    <div class="col-lg-9 form-errors">
        
        <ul class="error-list">
		 <?php if(!empty($error->messages)): ?>
            <?php $__currentLoopData = $error->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 <?php endif; ?>
        </ul>
    </div>
</div><?php /**PATH D:\xampp\htdocs\mylaravel\resources\views/partials/formerrors.blade.php ENDPATH**/ ?>