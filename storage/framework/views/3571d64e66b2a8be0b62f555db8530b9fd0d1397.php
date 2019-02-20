<?php $__env->startSection('section-title', 'Dashboard'); ?>
<?php $__env->startSection('display-btn-add-new', 'display:none'); ?>
<?php $__env->startSection('section-css'); ?>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('section-content'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>