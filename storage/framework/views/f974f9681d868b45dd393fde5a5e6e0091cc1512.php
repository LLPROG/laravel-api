<?php $__env->startSection('title', 'Show'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">

        
        <div class="row">
            <div class="col py-3">
                <a class="btn btn-primary" href="<?php echo e(route('admin.posts.index')); ?>">
                    Go to the list-post
                </a>
            </div>
        </div>

        
        <div class="row">
            <div class="col text-center">
                <h1 class="text-uppercase py-2">
                    <?php echo e($post->title); ?>

                </h1>
                <p class="author">
                    Post by: <?php echo e($post->user->name); ?>

                </p>

                <p class="category">
                    <?php echo e($post->category->name); ?>

                </p>

                <img  src="<?php echo e(asset('storage/' . $post->post_image)); ?>" alt="<?php echo e($post->title); ?>" class="w-50">

                <?php if($post->tags->all()): ?>
                    <p class="tags">
                        tags:
                        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#!">#<?php echo e($tag->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                <?php endif; ?>

                <p class="content pt-3">
                    <?php echo e($post->content); ?>

                </p>
            </div>
        </div>

        
        <div class="row">
            <div class="col-6">
                <a class="btn btn-primary" href="<?php echo e(url()->previous()); ?>">Back</a>
            </div>
        </div>

        <?php if(Auth::user()->id === $post->user_id): ?>

            <form method="POST" action="<?php echo e(route('admin.posts.update', $post->slug)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                    <a class="btn btn-primary my-2" href="<?php echo e(route('admin.posts.edit', $post->slug)); ?>">Edit</a>
            </form>

        <?php endif; ?>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\boolean\laravel\laravel-api\resources\views/admin/posts/show.blade.php ENDPATH**/ ?>