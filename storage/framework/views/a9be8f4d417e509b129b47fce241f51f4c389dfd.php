
<?php $__env->startSection('section-title', 'My Profile'); ?>
<?php $__env->startSection('tab-active-edit', 'active'); ?>
<?php $__env->startSection('tab-css'); ?>
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
		function change_status(){
			val 	= $('#active').val();
			if(val == 0){
				$('#active').val(1);
			}else{
				$('#active').val(0);
			}
		}
	</script>

	

	<script>
		
		var btnCust = ''; 
		$("#picture").fileinput({
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
		    defaultPreviewContent: '<img src="<?php echo e(asset($data->picture)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form id="form" action="<?php echo e(route($route.'.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('POST')); ?>

		<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_name">Name (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_name"
						name="kh_name"
					   	value = "<?php echo e($data->kh_name); ?>"
					   	type="text"
					   	placeholder = "Eg. Jhon Son"
					   	class="form-control"
					   	data-validation="[L>=1, L<=18]"
						data-validation-message="$ is required." />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_name">Name (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_name"
						name="en_name"
					   	value = "<?php echo e($data->en_name); ?>"
					   	type="text"
					   	placeholder = "Eg. Jhon Son"
					   	class="form-control"
					   	data-validation="[L>=1, L<=18, MIXED]"
						data-validation-message="$ is required." />
						
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
			<label class="col-sm-2 form-control-label" for="email">Image</label>
			<div class="col-sm-10">
				<div class="kv-avatar center-block">
			        <input id="picture" name="picture" type="file" class="file-loading">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>