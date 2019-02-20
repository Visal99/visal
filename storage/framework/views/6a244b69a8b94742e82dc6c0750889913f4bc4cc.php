<?php $__env->startSection('section-title', "Public Service"); ?>
<?php $__env->startSection('tab-active-system-permision', 'active'); ?>
<?php $__env->startSection('tab-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-js'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').click(function(){
			check_id = $(this).attr('for');
			automation_id = $("#"+check_id).attr('page-id');
			features(automation_id);
		})
	})
	function features(automation_id){
		$.ajax({
		        url: "<?php echo e(route($route.'.check-public-service')); ?>?document_id=<?php echo e($id); ?>&automation_id="+automation_id,
		        type: 'GET',
		        data: { },
		        success: function( response ) {
		            if ( response.status === 'success' ) {
		            	toastr.success(response.msg);
		            }else{
		            	swal("Error!", "Sorry there is an error happens. " ,"error");
		            }
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		});
	}
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<br />
		
		
		
		<div class="row m-t-lg">
			<?php $__currentLoopData = $automations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php ( $check = "" ); ?>
		        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		            <?php if($row->automation_id == $page->id): ?>
		                <?php ( $check = "checked" ); ?>
		            <?php endif; ?>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="col-sm-6 col-sm-4 col-md-3 col-lg-3">
					<div class="checkbox-bird">
						<input type="checkbox" page-id="<?php echo e($page->id); ?>" id="page-<?php echo e($page->id); ?>" <?php echo e($check); ?>>
						<label class="item" for="page-<?php echo e($page->id); ?>"><?php echo e($page->en_title); ?></label>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<hr />

<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.document.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>