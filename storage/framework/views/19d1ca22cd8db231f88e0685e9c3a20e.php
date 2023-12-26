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
    <style>
        h1, .h1 {
            font-size: calc(1.35rem + 1.2vw);
        }

        h5, .h5 {
            font-size: 1.125rem;
        }
        @media (min-width: 1200px) {
            h1, .h1 {
            font-size: 2.25rem;
        }
    }
        .body 
            {
                font-family: Arial, Helvetica, sans-serif;
		        margin-left:25%;
		        margin-right:25%;
		        border: 1px solid #000000;
		        margin-bottom: 5px;
		        padding: 0px 15px 0 15px;
            }
        input[type=text], input[type=password] 
            {
            width: 97%;
            padding: 10px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #F5F5F5;
            }
        hr 
            {
            border: 1px solid #e6e6e6;
            margin-bottom: 5px;
            }
        .registerbutton
            {
            background-color: #29a329;
            color: white;
            padding: 15px 20px;
            margin: 10px 0px;
            border: none;
            cursor: pointer;
            width: 100%;
            text:bold;
            }
        

    </style>
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
                <p>search</p>
                </button> 
            </div>
        </form>
    </div>
    
        <div class="row-1 mt-4 container text-center">
            <?php if(isset(Auth::user()->id)): ?>
            <a href="<?php echo e(route('blog', ['username'=>Auth::user()->username])); ?>" class="btn btn-primary">My Blog</a>    
            <a href="<?php echo e(route('following')); ?>" class="btn btn-primary">Following</a>
            <?php else: ?>
            <a href="/login" class="btn btn-primary">Login</a>    
            <a href="/register" class="btn btn-primary">Register</a>
            <?php endif; ?> 
        </div>

</body>
</html><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>