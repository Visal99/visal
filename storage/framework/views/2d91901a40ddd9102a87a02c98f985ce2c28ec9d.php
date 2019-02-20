<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo $__env->yieldContent('title'); ?></title>

        <link href="<?php echo e(asset ('img/favicon.144x144.png.html')); ?>" rel="apple-touch-icon" type="image/png" sizes="144x144">
        <link href="<?php echo e(asset ('img/favicon.114x114.png.html')); ?>" rel="apple-touch-icon" type="image/png" sizes="114x114">
        <link href="<?php echo e(asset ('img/favicon.72x72.png.html')); ?>" rel="apple-touch-icon" type="image/png" sizes="72x72">
        <link href="<?php echo e(asset ('img/favicon.57x57.png.html')); ?>" rel="apple-touch-icon" type="image/png">
        <link href="<?php echo e(asset ('img/favicon.png.html')); ?>" rel="icon" type="image/png">
        <link href="<?php echo e(asset ('img/favicon.ico.html')); ?>" rel="shortcut icon">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php echo $__env->yieldContent('headercss'); ?>
    </head>
    <body <?php echo $__env->yieldContent('bodyclass'); ?> >
        <?php echo $__env->yieldContent('header'); ?>
        <?php echo $__env->yieldContent('menu'); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->yieldContent('modal'); ?>
        <?php echo $__env->yieldContent('bottomjs'); ?>
    </body>
</html>