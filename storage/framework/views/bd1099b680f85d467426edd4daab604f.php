<?php $__env->startSection('title', $blog->user->username . '\'s blog'); ?>
<?php $__env->startSection('content'); ?>
<div class="container justify-content-center">
        <div class="card">
                <img class="card-img" style="height: 30em" src="/images/<?php echo e($blog->image->path); ?>" class="img-fluid" alt="" />
                <div class="card-img-overlay text-end"><h3><i class="text-white bi bi-gear-fill"></i></h3></div>
                <div class="card-img-overlay text-white d-flex flex-column justify-content-end gap-2 text-center">
                        <img style="max-height: 200px" class="rounded-circle col-md-2 col-sm-4" src="/images/<?php echo e($blog->user->image->path); ?>" alt="" />
                        <h2 class="card-title row-1 col-md-2 col-sm-4"><?php echo e($blog->user->username); ?></h2>
                </div>
        </div>
        <div class="card">
        <div class="card-body">
                <h5 class="card-subtitle">About</h5>
                <p class="mt-2 mb-2 pt-1 pb-1 border-top border-bottom"><?php echo e($blog->about); ?></p>

                <p class="float-start col mt-3">Followers: <?php echo e(count($blog->user->followers)); ?></p>
                <?php if(!isset(Auth::user()->id)): ?>
                <?php elseif(Auth::user()->id == $blog->user->id): ?>
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="<?php echo e(route('posts.create')); ?>">New Post</a>
                <?php elseif($isFollowing): ?>
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="<?php echo e(route('unfollow', $blog->user->id)); ?>">Unfollow</a>
                <?php else: ?>
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="<?php echo e(route('follow', $blog->user->id)); ?>">Follow</a>
                <?php endif; ?>
        </div>      
</div>
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mt-5">
                <div class="card-header d-flex">
                        <h3 class="card-title col"><?php echo e($post->title); ?></h3>

                        <div class="d-flex justify-content-end align-items-center ">
                        <h5 class="mb-0 mx-3"><?php echo e($post->created_at); ?></h5>

                        <?php if(isset(Auth::user()->id) && (
                                Auth::user()->id == $blog->user->id || Auth::user()->is_admin == true
                                )): ?>
                                <form action="<?php echo e(route('posts.destroy',  $post->id)); ?>" method="POST">
                                <?php echo method_field('DELETE'); ?>
                                <?php echo csrf_field(); ?>
                                <button name="Delete post" class="px-2 mx-2 btn btn-circle btn-lg d-flex justify-content-center align-items-center text-danger bi bi-x-circle-fill"></button>
                                </form>
                        <?php endif; ?>
                        <?php if(isset(Auth::user()->id) && (Auth::user()->id == $blog->user->id)): ?>
                                <a name="View post" class="px-2 btn btn-circle btn-lg d-flex justify-content-center align-items-center text-primary bi bi-pencil-square" href="<?php echo e(route('posts.edit',  $post->id)); ?>"></a>
                               
                        <?php endif; ?>
                        </div>
                </div>
                <div class="card-body row">
                        <h5 class="preview-text col"><?php echo e($post->body); ?></h5>
                        <a class="float-end btn btn-primary col-md-2 col-sm-2 mx-md-3 mb-auto mt-auto" href="<?php echo e(route('posts.show',  $post->id)); ?>">
                                Continue Reading
                        </a>
                </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="mt-5">
<?php echo e($posts->links()); ?>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/blog/view.blade.php ENDPATH**/ ?>