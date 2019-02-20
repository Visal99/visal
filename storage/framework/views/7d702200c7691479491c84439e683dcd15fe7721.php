<?php $__env->startSection('section-title', 'View Detail'); ?>
<?php $__env->startSection('tab-active-project', 'active'); ?>

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
		
	</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tab-css'); ?>
	<link href="<?php echo e(asset ('public/cp/css/plugin/fileinput/fileinput.min.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset ('public/cp/css/plugin/fileinput/theme.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
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
    <script type="text/javascript" src="<?php echo e(asset ('public/cp/js/plugin/fileinput/fileinput.min.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset ('public/cp/js/plugin/fileinput/theme.js')); ?>" type="text/javascript"></script>
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
			$("#video-cnt").hide();
			$("#url").blur(function(){
				url= $(this).val();
				if(url != ""){
					$("#video-cnt").show();
					$("#iframe").attr("src", "//www.youtube.com/embed/"+url);
				}
			})
			
		}); 
		
	</script>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<br />
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo e(route($route.'.create', $id)); ?>" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right; margin-left: 4px;"><span class="fa fa-plus"></span></a> &nbsp;
			<a href="<?php echo e(route($route.'.index', $id)); ?>" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form id="form" action="<?php echo e(route($route.'.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('POST')); ?>

		<input type="hidden" name="public_work_id" value="<?php echo e($id); ?>">
		<input type="hidden" name="project_id" value="<?php echo e($data->id); ?>">
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_title"
						name="kh_title"
					   	value = "<?php echo e($data->kh_title); ?>"
					   	type="text"
					   	placeholder = "Eg. Title in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "<?php echo e($data->en_title); ?>"
					   	type="text"
					   	placeholder = "Eg. Title in english "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_province">Province (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_province"
						name="kh_province"
					   	value = "<?php echo e($data->kh_province); ?>"
					   	type="text"
					   	placeholder = "Eg. Province in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_province">Province (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_province"
						name="en_province"
					   	value = "<?php echo e($data->en_province); ?>"
					   	type="text"
					   	placeholder = "Eg. Province in english "
					   	class="form-control" />
						
			</div>
		</div>			
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_location">Location (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_location"
						name="kh_location"
					   	value = "<?php echo e($data->kh_location); ?>"
					   	type="text"
					   	placeholder = "Eg. Location in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_location">Location (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_location"
						name="en_location"
					   	value = "<?php echo e($data->en_location); ?>"
					   	type="text"
					   	placeholder = "Eg. Location in english "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_consultant">Consultant (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_consultant"
						name="kh_consultant"
						   value = "<?php echo e($data->kh_consultant); ?>"
						   type="text"
						   placeholder = "Eg. Consultant in khmer "
						   class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_consultant">Consultant (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_consultant"
						name="en_consultant"
						   value = "<?php echo e($data->en_consultant); ?>"
						   type="text"
						   placeholder = "Eg. Consultan in english "
						   class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_authority">Authority (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_authority"
						name="kh_authority"
					   	value = "<?php echo e($data->kh_authority); ?>"
					   	type="text"
					   	placeholder = "Eg. Authority in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_authority">Authority (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_authority"
						name="en_authority"
					   	value = "<?php echo e($data->en_authority); ?>"
					   	type="text"
					   	placeholder = "Eg. Authority in english "
					   	class="form-control" />
						
			</div>
		</div>	
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_constructor">Contractor (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_constructor"
						name="kh_constructor"
					   	value = "<?php echo e($data->en_constructor); ?>"
					   	type="text"
					   	placeholder = "Eg. Constructor in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_constructor">Contractor (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_constructor"
						name="en_constructor"
					   	value = "<?php echo e($data->kh_constructor); ?>"
					   	type="text"
					   	placeholder = "Eg. Constructor in english "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_period">Period (KH)</label>
			<div class="col-sm-10">
				<input 	id="kh_period"
						name="kh_period"
					   	value = "<?php echo e($data->en_period); ?>"
					   	type="text"
					   	placeholder = "Eg. Period in khmer "
					   	class="form-control" />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_period">Period (EN)</label>
			<div class="col-sm-10">
				<input 	id="en_period"
						name="en_period"
					   	value = "<?php echo e($data->kh_period); ?>"
					   	type="text"
					   	placeholder = "Eg. Period in english "
					   	class="form-control" />
						
			</div>
		</div>	

		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
			<div class="col-sm-10">
				<div class="summernote-theme-1">
					<textarea id="kh_content" name="kh_content" class="form-control  summernote "> <?php echo e($data->kh_content); ?> </textarea>
				</div>	
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
			<div class="col-sm-10">
				<div class="summernote-theme-1">
					<textarea id="en_content" name="en_content" class="form-control  summernote "> <?php echo e($data->en_content); ?> </textarea>
				</div>	
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
						<label class="col-sm-2 form-control-label" for="kh_content">Published</label>
						<div class="col-sm-10">
							<div class="checkbox-toggle">
								<input id="status-status" type="checkbox"  <?php if($data->is_published ==1 ): ?> checked <?php endif; ?> >
								<label onclick="booleanForm('status')" for="status-status"></label>
							</div>
							<input type="hidden" name="status" id="status" value="<?php echo e($data->is_published); ?>">
						</div>
					</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('<?php echo e(route($route.'.trash', ['id'=>$id, 'project_id'=>$data->id])); ?>', '<?php echo e(route($route.'.index', $id)); ?>')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.public_work.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>