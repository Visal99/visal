<?php $__env->startSection('section-title', 'Edit Public Service'); ?>
<?php $__env->startSection('tab-active-edit', 'active'); ?>
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
	<script>
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

			$("#url").blur(function(){
				url= $(this).val();
				if(url != ""){
					$("#iframe").attr("src", "//www.youtube.com/embed/"+url);
				}
			})
			
		}); 
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
		    defaultPreviewContent: '<img src="<?php echo e(asset($data->image_url)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
		var btnCust = ''; 
		$("#icon").fileinput({
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
		    defaultPreviewContent: '<img src="<?php echo e(asset($data->icon)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
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
				<label class="col-sm-2 form-control-label" for="kh_title">Title Abbre (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_title_abbre"
							name="kh_title_abbre"
						   	value = "<?php echo e($data->kh_title_abbre); ?>"
						   	type="text"
						   	placeholder = "Enter Khmer title abbre."
						   	class="form-control"
						   	data-validation="[L>=1, L<=100]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Title Abbre (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_title_abbre"
							name="en_title_abbre"
						   	value = "<?php echo e($data->en_title_abbre); ?>"
						   	type="text"
						   	placeholder = "Enter English title abbre."
						   	class="form-control"
						   	data-validation="[L>=1, L<=100]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_title"
							name="kh_title"
						   	value = "<?php echo e($data->kh_title); ?>"
						   	type="text"
						   	placeholder = "Enter Khmer title."
						   	class="form-control"
						   	data-validation="[L>=1, L<=100]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_title"
							name="en_title"
						   	value = "<?php echo e($data->en_title); ?>"
						   	type="text"
						   	placeholder = "Enter English title."
						   	class="form-control"
						   	data-validation="[L>=1, L<=100]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
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
				<label class="col-sm-2 form-control-label" for="email">Icon</label>
				<div class="col-sm-10">
					<div class="kv-avatar center-block">
				        <input id="icon" name="icon" type="file" class="file-loading">
				    </div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Video</label>
				<div class="col-sm-10">
					<input 	id="video"
							name="video"
						   	value = "<?php echo e($data->video); ?>"
						   	type="text"
						   	placeholder = "Enter Video code."
						   	class="form-control" />
							
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Appstore</label>
				<div class="col-sm-10">
					<input 	id="appstore"
							name="appstore"
						   	value = "<?php echo e($data->appstore); ?>"
						   	type="text"
						   	placeholder = "Enter Appstore url."
						   	class="form-control"
						   	/>
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Playstore</label>
				<div class="col-sm-10">
					<input 	id="playstore"
							name="playstore"
						   	value = "<?php echo e($data->playstore); ?>"
						   	type="text"
						   	placeholder = "Enter Playstore url."
						   	class="form-control"
						   />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Website</label>
				<div class="col-sm-10">
					<input 	id="website"
							name="website"
						   	value = "<?php echo e($data->website); ?>"
						   	type="text"
						   	placeholder = "Enter website."
						   	class="form-control"/>
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_phone">Phone (Kh)</label>
				<div class="col-sm-10">
					<input 	id="kh_phone"
							name="kh_phone"
						   	value = "<?php echo e($data->kh_phone); ?>"
						   	type="text"
						   	placeholder = "Enter Phone Number in khmer."
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_phone">Phone (En)</label>
				<div class="col-sm-10">
					<input 	id="en_phone"
							name="en_phone"
						   	value = "<?php echo e($data->en_phone); ?>"
						   	type="text"
						   	placeholder = "Enter Phone Number in english."
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Email</label>
				<div class="col-sm-10">
					<input 	id="email"
							name="email"
						   	value = "<?php echo e($data->email); ?>"
						   	type="email"
						   	placeholder = "Enter Email."
						   	class="form-control"/>
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_title">Working Hour (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_working_hour"
							name="kh_working_hour"
						   	value = "<?php echo e($data->kh_working_hour); ?>"
						   	type="text"
						   	placeholder = "Enter Woring hour in khmer."
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Working Hour (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_working_hour"
							name="en_working_hour"
						   	value = "<?php echo e($data->en_working_hour); ?>"
						   	type="text"
						   	placeholder = "Enter Woring hour in english."
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="kh_content" name="kh_content" class="form-control  summernote  "> <?php echo e($data->kh_content); ?> </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="en_content" name="en_content" class="form-control  summernote  "> <?php echo e($data->en_content); ?> </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_more">More (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="kh_more" name="kh_more" class="form-control  summernote  "> <?php echo e($data->kh_more); ?> </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_more">More (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="en_more" name="en_more" class="form-control  summernote  "> <?php echo e($data->en_more); ?> </textarea>
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
<?php echo $__env->make($route.'.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>