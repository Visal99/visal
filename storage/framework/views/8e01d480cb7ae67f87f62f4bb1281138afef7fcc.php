
<?php $__env->startSection('section-title', $data->en_title); ?>
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
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
	<script type="text/JavaScript">
		$(document).ready(function(){
			
			<?php if($data->lat != 0 && $data->lng !=0 ): ?>
				makeMap(<?php echo e($data->lat); ?>, <?php echo e($data->lng); ?>, 20);
			<?php else: ?> 
				makeMap(11.537886, 104.910652, 20);// Map of phnom penh
			<?php endif; ?>
		})
		//var marker ="";
		function makeMap(lat, lng, zoom = 20){
			var latlng = new google.maps.LatLng(lat, lng);
			var map = new google.maps.Map(document.getElementById('map'), {
			    center: latlng,
			    zoom: zoom,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var marker = new google.maps.Marker({
			    position: latlng,
			    map: map,
			    title: '',
			    draggable: true
			});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			    $("#lat").val(this.getPosition().lat());
			    $("#lng").val(this.getPosition().lng());
			});
		}

		function enLargeMap(){

		}
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form id="form" action="<?php echo e(route($route.'.update')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('POST')); ?>

		<input type="hidden" name="id" value="<?php echo e($data->id); ?>">

		

		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="parent">Parent</label>
			<div class="col-sm-10">
				<select class="select2" id="parent" name="parent">
					<?php if(!is_null($data->parent_id)): ?>
				    	<option value="">Unset Parent</option>
				    <?php else: ?>
				    	<option value="">Select Parent</option>
				   	<?php endif; ?>

                   	<?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<option value="<?php echo e($row->id); ?>"  <?php if($data->parent_id == $row->id){ echo "selected"; }else{ echo""; } ?>><?php echo e($row->en_title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </select>
			</div>
		</div>
		
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
				<label class="col-sm-2 form-control-label" for="kh_contact_person">Contact Person (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_contact_person"
							name="kh_contact_person"
						   	value = "<?php echo e($data->kh_contact_person); ?>"
						   	type="text"
						   	placeholder = "Eg. Contact Person in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_contact_person">Contact Person (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_contact_person"
							name="en_contact_person"
						   	value = "<?php echo e($data->en_contact_person); ?>"
						   	type="text"
						   	placeholder = "Eg. Contact Person in english "
						   	class="form-control" />
							
				</div>
			</div>		
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_position">Position (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_position"
							name="kh_position"
						   	value = "<?php echo e($data->kh_position); ?>"
						   	type="text"
						   	placeholder = "Eg. Position in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_position">Position (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_position"
							name="en_position"
						   	value = "<?php echo e($data->en_position); ?>"
						   	type="text"
						   	placeholder = "Eg. Position in english "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="website">Website</label>
				<div class="col-sm-10">
					<input 	id="website"
							name="website"
						   	value = "<?php echo e($data->website); ?>"
						   	type="text"
						   	placeholder = "Eg. Enter website "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="phone">Phone </label>
				<div class="col-sm-10">
					<input 	id="phone"
							name="phone"
						   	value = "<?php echo e($data->phone); ?>"
						   	type="text"
						   	placeholder = "Eg. Enter phone "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="email">Email </label>
				<div class="col-sm-10">
					<input 	id="email"
							name="email"
						   	value = "<?php echo e($data->email); ?>"
						   	type="text"
						   	placeholder = "Eg. Enter email "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_address">Address (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_address"
							name="kh_address"
						   	value = "<?php echo e($data->kh_address); ?>"
						   	type="text"
						   	placeholder = "Eg. Address in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_address">Address (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_address"
							name="en_address"
						   	value = "<?php echo e($data->en_address); ?>"
						   	type="text"
						   	placeholder = "Eg. Address in english "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="google_link">Google Map Link</label>
				<div class="col-sm-10">
					<input 	id="google_link"
							name="google_link"
						   	value = "<?php echo e($data->google_link); ?>"
						   	type="text"
						   	placeholder = "Eg. Enter Google Map Link "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lat">Latitute</label>
							<div class="col-sm-10">
								<input 	id="lat"
										name="lat"
									   	value = "<?php echo e($data->lat); ?>"
									   	type="text"
									   	placeholder = "Eg.Enter Your Latitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lng">Longtitute</label>
							<div class="col-sm-10">
								<input 	id="lng"
										name="lng"
									   	value = "<?php echo e($data->lng); ?>"
									   	type="text"
									   	placeholder = "Eg.Enter Your Longtitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
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
			<label class="col-sm-2 form-control-label" >Map</label>
			<div id="map-cnt" class="col-sm-10">
				<div id="map" style="height:400px;border: 1px solid gray;"></div>
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
<?php echo $__env->make('cp.contact.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>