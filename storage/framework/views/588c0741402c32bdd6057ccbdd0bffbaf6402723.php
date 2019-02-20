<?php $__env->startSection('section-title', 'Account Information'); ?>
<?php $__env->startSection('tab-active-password', 'active'); ?>
<?php $__env->startSection('tab-css'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-js'); ?>
	<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 
			$('#form').submit(function(event){
				event.prevenDefault();
				alert('This is form submit.');
			})

		}); 
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<?php if(count($errors) > 0): ?>
	    <div class="form-error-text-block">
	        <h2 style="color:red"> Error Occurs</h2>
	        <ul>
	            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <li><?php echo e($error); ?></li>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
	    </div>
	<?php endif; ?>
	<form id="form" action="<?php echo e(route($route.'.update-password')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('POST')); ?>

		<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
		<div class="form-group row">
			<label class="col-sm-4 form-control-label" for="name">Current Password</label>
			<div class="col-sm-8">
				<input 	id="old_password"
						name="old_password"
					   	value = ""
					   	type="password"
					   	placeholder = ""
					   	class="form-control"
					   	data-validation="[L>=6, L<=18]"
						data-validation-message="$ must be between 6 and 18 characters." />
						
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 form-control-label" for="new_password">New Password</label>
			<div class="col-sm-8">
				<input 	id="new_password"
						name="new_password"
					   	value = ""
					   	type="password"
					   	placeholder = ""
					   	class="form-control"
					   	data-validation="[L>=6, L<=18]"
						data-validation-message="$ must be between 6 and 18 characters." />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 form-control-label" for="confirm_password">Confirm Password</label>
			<div class="col-sm-8">
				<input 	id="confirm_password"
						name="confirm_password"
					   	value = ""
					   	type="password"
					   	placeholder = ""
					   	class="form-control"
					   	data-validation="[L>=6, L<=18]"
						data-validation-message="$ must be between 6 and 18 characters." />
			</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-4 form-control-label"></label>
			<div class="col-sm-8">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-key"></i> Change</button>
			</div>
		</div>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>