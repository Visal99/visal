
<?php $__env->startSection('section-title', 'View Detail'); ?>
<?php $__env->startSection('tab-active-faq', 'active'); ?>
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
		    defaultPreviewContent: '<img src="<?php echo e(asset($data->image)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
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

		<input type="hidden" name="automation_id" value="<?php echo e($id); ?>">
		<input type="hidden" name="faq_id" value="<?php echo e($data->id); ?>">
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_question">Question (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_question"
										name="kh_question"
									   	value = "<?php echo e($data->kh_question); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Question in English. "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_question">Question (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_question"
										name="en_question"
									   	value = "<?php echo e($data->en_question); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Question in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_answer">Answer (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_answer"
										name="kh_answer"
									   	value = "<?php echo e($data->kh_answer); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Answer in Khmer "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_answer">Answer (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_answer"
										name="en_answer"
									   	value = "<?php echo e($data->en_answer); ?>"
									   	type="text"
									   	placeholder = "Eg. Enter Answer in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('<?php echo e(route($route.'.trash', ['id'=>$id, 'faq_id'=>$data->id])); ?>', '<?php echo e(route($route.'.index', $id)); ?>')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.automation.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>