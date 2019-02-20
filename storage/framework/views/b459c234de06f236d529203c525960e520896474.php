<?php $__env->startSection('title', 'Update Profile'); ?>

<?php $__env->startSection('appheadercss'); ?>
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

<?php $__env->startSection('appbottomjs'); ?>
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

	

	<script>
		
		var btnCust = ''; 
		$("#image").fileinput({
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="<?php echo e(asset ($data->image)); ?>" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-content'); ?>

<header class="page-content-header">
	<div class="container-fluid">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h3>Profile</h3>
				</div>
				<div class="tbl-cell tbl-cell-action">
					
				</div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
			
			
			

			<section class="card">
				<div class="card-block">
					<div class="row">
						<div class="col-md-6">
							<h5 class="m-t-lg with-border">Your Information</h5>
							
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
							<form id="form" action="<?php echo e(route('user.profile.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<?php echo e(method_field('POST')); ?>

								<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
								<div class="form-group row">
									<label class="col-sm-2 form-control-label" for="name">Name</label>
									<div class="col-sm-10">
										<input 	id="name"
												name="name"
											   	value = "<?php echo e($data->name); ?>"
											   	type="text"
											   	placeholder = "Eg. Jhon Son"
											   	class="form-control"
											   	data-validation="[L>=2, L<=18, MIXED]"
												data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
												
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 form-control-label" for="phone">Phone</label>
									<div class="col-sm-10">
										<input 	id="phone"
												name="phone"
											   	value = "<?php echo e($data->phone); ?>"
											   	type="text" 
											   	placeholder = "Eg. 093123457"
											   	class="form-control"
											   	data-validation="[L>=9, L<=10, numeric]"
												data-validation-message="$ is not correct." 
												data-validation-regex="/(^[00-9].{8}$)|(^[00-9].{9}$)/"
												data-validation-regex-message="$ must start with 0 and has 10 or 11 digits" />
												
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-2 form-control-label" for="email">Email</label>
									<div class="col-sm-10">
										<input 	id="email"
												name="email"
												value = "<?php echo e($data->email); ?>"
												type="text"
												placeholder = "Eg. you@example.com"
											   	class="form-control"
											   	data-validation="[EMAIL]">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-2 form-control-label" for="email">Image</label>
									<div class="col-sm-10">
										<div class="kv-avatar center-block">
									        <input id="image" name="image" type="file" class="file-loading">
									    </div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-2 form-control-label"></label>
									<div class="col-sm-10">
										<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
									</div>
								</div>
							</form>

						</div>
						<div class="col-md-6">
							<h5 class="m-t-lg with-border">Change Password</h5>
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
							<form id="form" action="<?php echo e(route('user.profile.reset-password')); ?>" name="form" method="POST"  enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<?php echo e(method_field('POST')); ?>

								<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
								<div class="form-group row">
									<label class="col-sm-4 form-control-label" for="name">Current Password</label>
									<div class="col-sm-8">
										<input 	id="password"
												name="password"
											   	value = ""
											   	type="password"
											   	placeholder = ""
											   	class="form-control"
											   	data-validation="[L>=6, L<=18]"
												data-validation-message="$ must be between 6 and 18 characters." />
												
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 form-control-label" for="new-password">New Password</label>
									<div class="col-sm-8">
										<input 	id="new-password"
												name="new-password"
											   	value = ""
											   	type="password"
											   	placeholder = ""
											   	class="form-control"
											   	data-validation="[L>=6, L<=18]"
												data-validation-message="$ must be between 6 and 18 characters." />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 form-control-label" for="confirm-password">Confirm Password</label>
									<div class="col-sm-8">
										<input 	id="confirm-password"
												name="confirm-password"
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
						</div>
					</div><!--.row-->

					
				</div>
			</section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>