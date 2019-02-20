<?php $__env->startSection('section-title', 'View Message'); ?>
<?php $__env->startSection('section-css'); ?>
	<link href="<?php echo e(asset ('public/user/css/plugin/fileinput/fileinput.min.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset ('public/user/css/plugin/fileinput/theme.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
	<!-- some CSS styling changes and overrides -->
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('imageuploadjs'); ?>
    <script type="text/javascript" src="<?php echo e(asset ('public/user/js/plugin/fileinput/fileinput.min.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset ('public/user/js/plugin/fileinput/theme.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section-js'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section-content'); ?>
	<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form id="form" action="<?php echo e(route($route.'.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('POST')); ?>

		<input type="hidden" name="message_id" value="<?php echo e($data->id); ?>">
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Department</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->contact->en_title); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Name</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->name); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Organization</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->organization); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Position</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->position); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Phone</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->phone); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Phone</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->phone); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Email</label>
			<div class="col-sm-10">
				<input 	id="email"
						name="en_title"
					   	value = "<?php echo e($data->email); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Purpose</label>
			<div class="col-sm-10">
				<input 	id="email"
						name="en_title"
					   	value = "<?php echo e($data->purpose); ?>"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>

		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Message</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" disabled="" name="kh_content" class="form-control"><?php echo e($data->message); ?> </textarea>
								</div>	
							</div>
						</div>
		
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>