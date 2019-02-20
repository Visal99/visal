<?php $__env->startSection('title'); ?>
	Contact: <?php echo $__env->yieldContent('section-title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-main-menu-contact', 'opened'); ?>
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
						<h4>Contact <span> <i class="fa fa-long-arrow-right"></i> <?php echo $__env->yieldContent('section-title'); ?></span></h4> 
					</div>
					<div class="tbl-cell tbl-cell-action">
					<?php if( $contact->has_departments == 1 ): ?>
						<a href="<?php echo e(route( $route.'.list', $contact->id)); ?>"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;   <?php echo $__env->yieldContent("display-btn-back"); ?> "><span class="fa fa-arrow-left"></span></a>
						<a href="<?php echo e(route( $route.'.create', $contact->id)); ?>"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;   <?php echo $__env->yieldContent("display-btn-add-new"); ?> "><span class="fa fa-plus"></span></a>
					<?php endif; ?>
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
<?php echo $__env->make('user/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>