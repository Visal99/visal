

<?php $__env->startSection('headercss'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/user/css/lib/font-awesome/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/user/css/main.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
        <?php echo $__env->yieldContent('pagecontent'); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('bottomjs'); ?>
<script src="<?php echo e(asset ('public/user/js/lib/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset ('public/user/js/lib/tether/tether.min.js')); ?>"></script>
<script src="<?php echo e(asset ('public/user/js/lib/bootstrap/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset ('public/user/js/plugins.js')); ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="<?php echo e(asset ('public/user/js/app.js')); ?>"></script>
<?php if(Session::has('msg')): ?>
<script type="text/JavaScript">
    toastr.error("<?php echo Session::get('msg'); ?>");
</script>
<?php endif; ?>
<?php echo $__env->yieldContent('appbottomjs'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>