<?php $__env->startSection('title', 'Update Organization'); ?>
<?php $__env->startSection('active-main-menu-organization', 'opened'); ?>
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
		function change_publish(){
			val 	= $('#publish').val();
			if(val == 0){
				$('#publish').val(1);
			}else{
				$('#publish').val(0);
			}
		}
	</script>

	

	<script>
		
		var btnCust = ''; 
		$("#en_image").fileinput({
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
		    defaultPreviewContent: '<img src="<?php echo e(asset ($data->en_image)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (10-1500)cmX(10-1500)cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
		
		$("#kh_image").fileinput({
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
		    defaultPreviewContent: '<img src="<?php echo e(asset ($data->kh_image)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (10-1500)cmX(10-1500)cm with .jpg or .png type</i></span>',
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
						<h3>Organization</h3>
					</div>
					
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
					
				<div class="container-fluid">
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
					<form id="form" action="<?php echo e(route('user.organization.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<?php echo e(method_field('POST')); ?>

						<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_link">Link (En)</label>
							<div class="col-sm-10">
								<input 	id="en_link"
										name="en_link"
									   	value = "<?php echo e($data->en_link); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Google link English"
									   	class="form-control" />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_link">Link (Kh)</label>
							<div class="col-sm-10">
								<input 	id="kh_link"
										name="kh_link"
									   	value = "<?php echo e($data->kh_link); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Google link Khmer"
									   	class="form-control" />
										
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_image">Image (En)</label>
							<div class="col-sm-10">
								<div class="kv-avatar center-block">
							        <input id="en_image" name="en_image" type="file" class="file-loading">
							    </div>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_image">Image (Kh)</label>
							<div class="col-sm-10">
								<div class="kv-avatar center-block">
							        <input id="kh_image" name="kh_image" type="file" class="file-loading">
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

				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>