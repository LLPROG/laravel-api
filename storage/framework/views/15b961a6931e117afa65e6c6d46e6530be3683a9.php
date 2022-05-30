<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <a class="btn btn-primary" href="<?php echo e(route('admin.posts.index')); ?>">
                        All Post
                    </a>

                    <a class="btn btn-primary" href="<?php echo e(route('admin.posts.myindex')); ?>">
                        My Post
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\boolean\laravel\laravel-api\resources\views/admin/home.blade.php ENDPATH**/ ?>