<?php ( $department_name ="" ); ?>
<?php if( $contact->has_departments == 1 ): ?>
	<?php ( $department_name =" -> ".$data->en_title ); ?>
	<?php $__env->startSection('active-main-menu-contact-general-department', 'opened'); ?>
<?php endif; ?>
<?php $__env->startSection('section-title', $contact->en_title.$department_name ); ?>
<?php $__env->startSection('tab-active-edit', 'active'); ?>
<?php $__env->startSection('active-main-menu-contact', 'opened'); ?>

<?php if($data->slug == 'department-of-information-technology-and-public-relation' || $data->slug == 'department-of-internal-audit' || $data->slug == 'department-of-railway' ): ?>
	<?php $__env->startSection('active-main-menu-contact-department', 'opened'); ?>	
<?php endif; ?>




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
			
		});


	</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<br />
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

	<form id="form" action="<?php echo e(route($route.'.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
			<?php echo e(csrf_field()); ?>

			<?php echo e(method_field('POST')); ?>

			<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
			<input type="hidden" name="contact_id" value="<?php echo e($data->contact_id); ?>">
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Title (Kh)</label>
				<div class="col-sm-10">
					<input 	id="kh-title"
							name="kh-title"
							value = "<?php echo e($data->kh_title); ?>"
							type="text"
							placeholder = ""
							class="form-control"
						    data-validation="[L>=1, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Title (En)</label>
				<div class="col-sm-10">
					<input 	id="en-title"
							name="en-title"
							value = "<?php echo e($data->en_title); ?>"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Website</label>
				<div class="col-sm-10">
					<input 	id="website"
							name="website"
							value = "<?php echo e($data->website); ?>"
							type="url"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=50]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Url</label>
				<div class="col-sm-10">
					<input 	id="url"
							name="url"
							value = "<?php echo e($data->url); ?>"
							type="url"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=1, L<=500]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Phone</label>
				<div class="col-sm-10">
					<input 	id="phone"
							name="phone"
							value = "<?php echo e($data->phone); ?>"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=50]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Email</label>
				<div class="col-sm-10">
					<input 	id="email"
							name="email"
							value = "<?php echo e($data->email); ?>"
							type="email"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Address</label>
				<div class="col-sm-10">
					<input 	id="address"
							name="address"
							value = "<?php echo e($data->address); ?>"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Latitute</label>
				<div class="col-sm-10">
					<input 	id="lat"
							name="lat"
							value = "<?php echo e($data->lat); ?>"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Longtitute</label>
				<div class="col-sm-10">
					<input 	id="lon"
							name="lon"
							value = "<?php echo e($data->lon); ?>"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				</div>
			</div>
		</form>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>