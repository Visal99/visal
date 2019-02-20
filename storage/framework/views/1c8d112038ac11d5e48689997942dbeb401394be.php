
<?php $__env->startSection('section-css'); ?>
	<?php echo $__env->yieldContent('tab-css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section-js'); ?>
	<?php echo $__env->yieldContent('tab-js'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section-content'); ?>
		
			
	<section class="tabs-section">
		<div class="tabs-section-nav tabs-section-nav-icons">
			<div class="tbl">
				<ul class="nav" role="tablist">
					<li class="nav-item">
						
						<a class="nav-link <?php echo $__env->yieldContent('tab-active-edit'); ?>" onclick="window.location.href='<?php echo e(route('cp.public_work.edit', $id)); ?>'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-user"></i> Overview
							</span>
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link <?php echo $__env->yieldContent('tab-active-project'); ?>" onclick="window.location.href='<?php echo e(route('cp.public_work.project.index', $id)); ?>' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-paperclip"></i> Project
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div><!--.tabs-section-nav-->

		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active">
				<div id="tab-content-cnt" class="container-fluid">
					<?php echo $__env->yieldContent('tab-content'); ?>
				</div>
			</div>
		</div><!--.tab-content-->
	</section><!--.tabs-section-->
				
	


<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.public_work.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>