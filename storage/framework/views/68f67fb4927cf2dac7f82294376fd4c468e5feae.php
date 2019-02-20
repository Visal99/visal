
<?php $__env->startSection('active-main-menu-about', 'opened'); ?>
<?php $__env->startSection('title'); ?>
	Biography: <?php echo $__env->yieldContent('section-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('appheadercss'); ?>
	<?php echo $__env->yieldContent('section-css'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('appbottomjs'); ?>
	<?php echo $__env->yieldContent('section-js'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Biography <span> <i class="fa fa-long-arrow-right"></i> <?php echo $__env->yieldContent('section-title'); ?></span></h3> 
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="<?php echo e(route($route.'.index')); ?>"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;   <?php echo $__env->yieldContent("display-btn-add-new"); ?> "><span class="fa fa-arrow-left"></span></a>
						<a href="<?php echo e(route($route.'.create')); ?>"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">

		<div class="box-typical box-typical-padding">	
			<?php echo $__env->yieldContent('section-content'); ?>
		</div>	
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>