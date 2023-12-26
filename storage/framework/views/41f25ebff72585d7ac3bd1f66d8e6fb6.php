<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" href="<?php echo e('images/favicon.ico'); ?>">
   
<title><?php echo e(config('app.name')); ?></title>
</head>
<body>
	<div class="jumbotron d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-1">ShareGram</h1>
            <h5 class="offset-md-2">Social media application</h5>
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
                <p>search</p>
                </button> 
            </div>
        </form>
    </div>
    
        <div class="row-1 mt-4 container text-center">
            <?php if(isset(Auth::user()->id)): ?>
            <a href="<?php echo e(route('blog', ['username'=>Auth::user()->name])); ?>" class="btn btn-primary">My Blog</a>    
            <a href="<?php echo e(route('/following')); ?>" class="btn btn-primary">Following</a>
            <?php else: ?>
            <a href="/login" class="btn btn-primary">Login</a>    
            <a href="/register" class="btn btn-primary">Register</a>
            <?php endif; ?> 
        </div>

</body>
</html><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>