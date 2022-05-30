<?php $__env->startSection('title', 'Create'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">

            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.posts.store')); ?>">

                
                <?php echo csrf_field(); ?>

                
                <div class="mb-3">
                    
                    <select class="form-select" aria-label="Default select exemple" name="category_id" id="category">
                        <option value="" selected>Select a category</option>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>


                
                <div class="mb-3">
                    
                    <label for="title" class="form-label"><?php echo e(__('Title')); ?></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo e(old('title')); ?>">
                </div>

                
                <div class="mb-3">
                    <label for="post_image">Example file input</label>
                    <input type="file" class="form-control-file" id="post_image" name="post_image">
                </div>


                
                <div class="mb-3">
                    <label for="slug" class="form-label"><?php echo e(__('Slug')); ?></label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo e(old('slug')); ?>">
                </div>
                
                <input type="button" value="Generate slug" id="btn-slugger" class=" btn btn-primary">


                
                <fieldset>
                    <legend>Tags</legend>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="checkbox" name="tags[]" id="tag-<?php echo e($tag->id); ?>" value="<?php echo e($tag->id); ?>"
                            <?php if(in_array($tag->id, old('tags', []))): ?> checked <?php endif; ?>>
                        <label for="tag-<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </fieldset>


                
                <div class="mb-3">
                    <label for="content" class="form-label"><?php echo e(__('Content')); ?></label>
                    <textarea type="text" class="form-control" id="content" name="content"><?php echo e(old('content')); ?></textarea>
                </div>

                
                <button type="submit" class="btn btn-primary">Create</button>

            </form>

            
            <div class="row">
                <div class="col">
                    <a href="<?php echo e(url()->previous()); ?>">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\boolean\laravel\laravel-api\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>