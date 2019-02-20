
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
						
						<a class="nav-link <?php echo $__env->yieldContent('tab-active-edit'); ?>" onclick="window.location.href='<?php echo e(route('cp.automation.edit', $id)); ?>'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-user"></i> Overview
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo $__env->yieldContent('tab-active-location'); ?>" onclick="window.location.href='<?php echo e(route('cp.automation.location.index', $id)); ?>' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="glyphicon glyphicon-flag"></i> Location
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo $__env->yieldContent('tab-active-faq'); ?>" onclick="window.location.href='<?php echo e(route('cp.automation.faq.index', $id)); ?>' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-paperclip"></i> Faq
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
<?php echo $__env->make('cp.automation.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>