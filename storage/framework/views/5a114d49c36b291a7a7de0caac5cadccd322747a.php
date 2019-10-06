<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="col-lg-12">
           <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>
                <div class="panel-body">
                <order :user="<?php echo e(auth()->user()); ?>"></order>
                </div>
           </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/my_project/resources/views/order.blade.php ENDPATH**/ ?>