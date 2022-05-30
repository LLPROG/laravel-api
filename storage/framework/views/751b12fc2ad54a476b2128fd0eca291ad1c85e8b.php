<?php $__env->startSection('title', 'Index'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col py-3">
                <a class="btn btn-primary" href="<?php echo e(route('admin.posts.create')); ?>">
                    Create a new post
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="<?php echo e(route('admin.posts.index')); ?>">
                    All Post
                </a>

                <a class="btn btn-primary" href="<?php echo e(route('admin.posts.myindex')); ?>">
                    My Post
                </a>
            </div>
        </div>

        
        <form action="" method="get" class="row g-3 my-3">

            <div class="col-md-8">
                <select class="form-select" aria-label="Default select example" name="category" id="category">
                    <option value="" selected>Select a category</option>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php if($category->id == $request->category): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInput"></label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="input" placeholder="Search by title">
              </div>

            <div class="col-md-2 d-block">
                <button class="btn btn-primary">Applica filtri</button>
            </div>
        </form>

        <?php if(session('deleted')): ?>
            <div class="alert alert-warning"><?php echo e(session('deleted')); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Content</th>
                        <th class="text-center" scope="col">Slug</th>
                        <th class="text-center" scope="col">Category</th>
                        <th class="text-center" scope="col">Tags</th>
                        <th class="text-center" scope="col">Created At</th>
                        <th class="text-center" scope="col">Updated At</th>
                        <th class="text-center" scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-id="<?php echo e($post->slug); ?>">
                                <th class="text-center" scope="row"><?php echo e($post->id); ?></th>
                                <td><?php echo e($post->title); ?></td>
                                <td><?php echo e($post->content); ?></td>
                                <td><?php echo e($post->slug); ?></td>
                                <td><?php echo e($post->category_id); ?></td>
                                <td><?php echo e($post->tags->pluck('name')->join(', ')); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($post->created_at))); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($post->updated_at))); ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo e(route('admin.posts.show', $post->slug)); ?>">View</a>
                                </td>
                                <td>
                                    <?php if(Auth::user()->id === $post->user_id): ?>
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.posts.edit', $post->slug)); ?>">Edit</a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if(Auth::user()->id === $post->user_id): ?>
                                        <button class="btn btn-danger btn-delete">Delete</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <?php echo e($posts->links()); ?>


        
        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="<?php echo e(route('admin.posts.destroy', '*****')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\boolean\laravel\laravel-api\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>