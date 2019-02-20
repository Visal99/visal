<?php $__env->startSection('section-title', 'Create New Document'); ?>
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
		    defaultPreviewContent: '<img src="http://via.placeholder.com/870x429" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});

		
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section-content'); ?>
	<div class="container-fluid">
		<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php ($en_title = ""); ?>
		<?php ($kh_title = ""); ?>
       
       	<?php if(Session::has('invalidData')): ?>
            <?php ($invalidData = Session::get('invalidData')); ?>
            <?php ($en_title = $invalidData['en_title']); ?>
            <?php ($kh_title = $invalidData['kh_title']); ?>
            
       	<?php endif; ?>
		<form id="form" action="<?php echo e(route($route.'.store')); ?>" name="form" method="POST"  enctype="multipart/form-data">
			<?php echo e(csrf_field()); ?>

			<?php echo e(method_field('PUT')); ?>

			
			<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = ""
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
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Title in english "
						   	class="form-control" />
							
				</div>
			</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="category">Category</label>
							<div class="col-sm-10">
								 <select class="select2" id="category" name="category">
								 <option value="0">Select Category</option>
	                               <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                  <option value="<?php echo e($row->id); ?>"><?php echo e($row->en_name); ?></option>
	                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	                              </select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="google_link">Google Link</label>
							<div class="col-sm-10">
								<input 	id="google_link"
										name="google_link"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Google shareble link "
									   	class="form-control" />
										
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="google_link">Official Published Date</label>
							<div class="col-sm-10">
								<div id="till-cnt" class='input-group date ' >
									<input id="official_published_date" name="official_published_date"  type='text' value = "" class="form-control" value="" placeholder="Date" />
									<span class="input-group-addon">
										<i class="font-icon font-icon-calend"></i>
									</span>
								</div>
										
							</div>
						</div>

					
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Publish</label>
							<div class="col-sm-10">
								<div class="checkbox-toggle">
									<input name="status" id="status" type="checkbox"   >
									<label onclick="change_status()" for="status"></label>
								</div>
								<input type="hidden" name="publish" id="publish" value="">
							</div>
						</div>
						
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					
					<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
				</div>
			</div>
		</form>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>