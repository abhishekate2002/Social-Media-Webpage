<?php $__env->startSection('title', 'Following'); ?>
<?php $__env->startSection('content'); ?>
<?php if(isset($following) && count($following) > 0): ?>
<div class="bg-white font-sans antialiased">
    <div class="container row-1 bg-white font-sans antialiased ">
        <form action="/search" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo $__env->yieldContent('content'); ?>
                <div class="container input-group">
                    <div class="form-outline col">
                        <input name="search-input" type="search" class="form-control"
                        placeholder="<?php if(isset($query)): ?> <?php echo e($query); ?> <?php else: ?> Search a blog... <?php endif; ?>"/>
                    </div>
                    <button type="submit" class="px-0 btn rounded btn-primary col-1 mx-1">
                    <i class="bi bi-search"></i>
                    </button> 
                </div>
            </form>
            <div class="container">
            <?php if(isset($query) && $query == ""): ?>
            <p>Showing all results</p>
            <?php elseif(isset($query)): ?>
            <p>Results for <b> <?php echo e($query); ?></b>:</p>
            <?php endif; ?>
        </div>
        </div>
        <?php endif; ?>
        <div class="container row-1 mt-5">
            <?php if(isset($following) && count($following) > 0): ?>
            <h4 class="row-1 mx-2">Following <?php echo e(count($following)); ?> blog(s).</h4>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Username</th>
                        <th scope="col">Followers</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="col-2" ><img class="col-15 img-fluid img-thumbnail" style="max-height: 100px" src="/images/<?php echo e($user->image->path); ?>" alt="" /></td>
                        <td class="align-middle"><a href="<?php echo e(route('blog', $user->username)); ?>" class="lead text-reset text-decoration-none"><?php echo e($user->username); ?></a></td>
                        <td class="align-middle lead"><?php echo e(count($user->followers)); ?></td>
                        <td class="align-middle"><a class="btn btn-primary" href="<?php echo e(route('unfollow', $user->id)); ?>">Unfollow</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($following->links()); ?>

            <?php elseif(isset($query)): ?>
            <p>No results found for<b> <?php echo e($query); ?></b>.</p>
            <?php else: ?>
            <h4 class="row-1 mx-auto text-center bg-white font-sans antialiased">You aren't following any blogs.</h4>
            <?php endif; ?>
            
        </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/following.blade.php ENDPATH**/ ?>