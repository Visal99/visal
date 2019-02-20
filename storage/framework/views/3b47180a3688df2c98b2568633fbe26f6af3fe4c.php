<?php $__env->startSection('title', 'Edit Content'); ?>
<?php if($page == 'home'): ?>
	<?php $__env->startSection('active-main-menu-home', 'opened'); ?>
<?php endif; ?>

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
<?php if($data->image_required): ?>
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
		    defaultPreviewContent: '<img src="<?php echo e(asset ($data->image)); ?>" alt="Missing Image" class="img img-responsive" ><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be <?php echo e($data->width); ?>cmX<?php echo e($data->height); ?>cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});

		var btnCust = ''; 
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
		    defaultPreviewContent: '<img src="<?php echo e(asset ($data->kh_image)); ?>" alt="Missing Image" class="img img-responsive" ><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be <?php echo e($data->width); ?>cmX<?php echo e($data->height); ?>cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
<?php $__env->stopSection(); ?>
<?php endif; ?>


<?php $__env->startSection('page-content'); ?>
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Content</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<?php if(isset($_GET['page'])): ?>
							<?php if($_GET['page'] != ""): ?>
							 	<?php ($menu = ""); ?>
							    <?php if(isset($_GET['menu'])): ?>
							        <?php ( $menu = $_GET['menu']); ?>
							    <?php endif; ?>
								<a href="<?php echo e(route('user.content.list', ['page' => $_GET['page']])); ?>?menu=<?php echo e($menu); ?>&page=<?php echo e($_GET['page']); ?>" class="btn"><i class="fa fa-arrow-left"></i></a>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
				<div class="container-fluid">
					<h5 class="m-t-lg with-border"><?php echo e($data->name); ?></h5>
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
	              
					<form id="form" action="<?php echo e(route('user.content.update')); ?>?" name="form" method="POST"  enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<?php echo e(method_field('POST')); ?>

						<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
						<input type="hidden" name="slug" value="<?php echo e($data->slug); ?>">
						<input type="hidden" name="image_required" value="<?php echo e($data->image_required); ?>">
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Content (Kh)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" name="kh_content" class="form-control <?php if($data->editor_required): ?> summernote <?php endif; ?> "> <?php echo e($data->kh_content); ?></textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_content">Content (En)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="en_content" name="en_content" class="form-control <?php if($data->editor_required): ?> summernote <?php endif; ?>"> <?php echo e($data->en_content); ?></textarea>
								</div>	
							</div>
						</div>
						<?php if($data->image_required): ?>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="email">Image</label>
							<div class="col-sm-10">
								<div class="kv-avatar center-block">
							        <input id="image" name="image" type="file" class="file-loading">
							    </div>
							    
							</div>
							<input type="hidden" name="width" value="<?php echo e($data->width); ?>">
							<input type="hidden" name="height" value="<?php echo e($data->height); ?>">
						</div>
						<?php endif; ?>

						<?php if($data->slug == 'minister-message'): ?>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="email">Image (KHM)</label>
							<div class="col-sm-10">
								<div class="kv-avatar center-block">
							        <input id="kh_image" name="kh_image" type="file" class="file-loading">
							    </div>
							    
							</div>
							<input type="hidden" name="width" value="<?php echo e($data->width); ?>">
							<input type="hidden" name="height" value="<?php echo e($data->height); ?>">
						</div>
						<?php endif; ?>
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