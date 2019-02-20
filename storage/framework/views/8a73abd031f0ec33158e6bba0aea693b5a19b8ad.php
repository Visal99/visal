<?php $__env->startSection('section-title', 'Edit Document'); ?>
<?php $__env->startSection('tab-active-edit', 'active'); ?>
<?php $__env->startSection('section-css'); ?>
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

<?php $__env->startSection('section-js'); ?>
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
		    defaultPreviewContent: '<img src="<?php echo e(asset($data->image)); ?>" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
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
					<label class="col-sm-2 form-control-label" for="category">Category</label>
					<div class="col-sm-10">
						<select class="select2" id="category" name="category">
						 
                           <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($row->id); ?>"  <?php if($data->category_id==$row->id){ echo "selected"; }else{ echo""; } ?>><?php echo e($row->en_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <option value="0">Select Category</option>
                        </select>
					</div>
				</div>
						
				<div class="form-group row">
					<label class="col-sm-2 form-control-label" for="google_link">Google Link</label>
					<div class="col-sm-10">
						<input 	id="google_link"
								name="google_link"
							   	value = "<?php echo e($data->google_drive_url); ?>"
							   	type="text"
							   	placeholder = "Eg. Enter Google shareble link "
							   	class="form-control" />
								
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label" for="google_link">Official Published Date</label>
					<div class="col-sm-10">
						<div id="till-cnt" class='input-group date ' >
							<input id="official_published_date" name="official_published_date"  type='text' value = "<?php echo e($data->official_published_date); ?>" class="form-control" value="" placeholder="Date" />
							<span class="input-group-addon">
								<i class="font-icon font-icon-calend"></i>
							</span>
						</div>
								
					</div>
				</div>
				<div class="form-group row">
						<label class="col-sm-2 form-control-label" for="kh_content">Published</label>
						<div class="col-sm-10">
							<div class="checkbox-toggle">
								<input id="status-status" name="status" type="checkbox"  <?php if($data->is_published == 1 ): ?> checked <?php endif; ?> >
								<label onclick="booleanForm('status')" for="status-status"></label>
							</div>
						</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 form-control-label"></label>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
						<button type="button" onclick="deleteConfirm('<?php echo e(route($route.'.trash', $data->id)); ?>', '<?php echo e(route($route.'.index')); ?>')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
					</div>
				</div>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.document.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>