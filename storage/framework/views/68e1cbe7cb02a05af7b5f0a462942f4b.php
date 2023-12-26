
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <title><?php echo e(config('app.name')); ?></title>
    </head>
    <body>
    <div class="jumbotron d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-1"><?php echo e(config('app.name')); ?></h1>
            <h5 class="offset-md-2">Share your inspiration</h5>
        </div>
    </div>
    
    <div class="container row-2">
        <form action="/search" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row-1 col-7 container input-group">
                <div class="form-outline col-md col-sm">
                    <input name="search-input" type="search" class="form-control" />
                </div>
                <button id="search-button" type="submit" class="btn btn-primary col-2 mx-auto">
                <i class="bi bi-search"></i>
                </button> 
            </div>
        </form>
    </div>
    
        <div class="row-1 mt-4 container text-center">
            <?php if(isset(Auth::user()->id)): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Route::is('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog', ['username'=>Auth::user()->username])); ?>"><?php echo e(__('My Blog')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Route::is('following') ? 'active' : ''); ?>" href="<?php echo e(route('following')); ?>"><?php echo e(__('Following')); ?></a>
            </li>
            <?php else: ?>
            <a href="/login" class="btn btn-primary">Login</a>    
            <a href="/register" class="btn btn-primary">Register</a>
            <?php endif; ?> 
        </div>
    </body>
    

<?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>