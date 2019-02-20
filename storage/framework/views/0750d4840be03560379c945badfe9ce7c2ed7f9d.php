<?php $__env->startSection('title', 'Edit User'); ?>
<?php $__env->startSection('active-main-menu-user', 'opened'); ?>
<?php $__env->startSection('appbottomjs'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			
		});

	    function changePassword(id) {
	     	swal({
						title: "Reset Password",
						text: "",
						type: "input",
						showCancelButton: true,
						closeOnConfirm: false,
						inputPlaceholder: "Please type a new Password:"
					}, function (inputValue) {
						if (inputValue === false) return false;
						if (inputValue.length <6 ){
	                        toastr.error("Your password at least 6 digits long!");
							return false
						}
						$.ajax({
						        url: "<?php echo e(route('user.user.update-password')); ?>",
						        type: 'POST',
						        data: {id:id, password:inputValue },
						        success: function( response ) {
						            if ( response.status === 'success' ) {
						            	swal("Nice!", response.msg ,"success");
						            }else{
						            	swal("Error!", "Sorry there is an error happens. " ,"error");
						            }
						        },
						        error: function( response ) {
						           swal("Error!", "Sorry there is an error happens. " ,"error");
						        }
						
					});
	            })
	    }

	    function updateStatus(id){

	    	
         	thestatus = $('#status-'+id);
         	active = thestatus.attr('data-value');

         	if(active == 1){
         		active = 0;
         		thestatus.attr('data-value', 1);
         	}else{
         		active = 1;
         		thestatus.attr('data-value', 0);
         	}

         	$.ajax({
		        url: "<?php echo e(route('user.user.update-status')); ?>",
		        method: 'POST',
		        data: {id:id, active:active },
		        success: function( response ) {
		            if ( response.status === 'success' ) {
		            	swal("Nice!", response.msg ,"success");
		            	
		            }else{
		            	swal("Error!", "Sorry there is an error happens. " ,"error");
		            }
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
			});

    	}
    
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>User</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="<?php echo e(route('user.user.list')); ?>"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						<a href="<?php echo e(route('user.user.create')); ?>"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
			
			<section class="card">
				<div class="card-block">
					
					
					<div class="row">
						<div class="col-xs-12">
							<div class="table-responsive">
								<table id="table-edit" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Phone</th>
											<th>E-mail</th>
											<th>Active</th>
											<th>Updated Date</th>
											<th>Image</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										<?php ($i = 1); ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										
											<tr>
												<td><?php echo e($i++); ?></td>
												<td><?php echo e($row->name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->email); ?></td>
												<td>
													<div class="checkbox-toggle">
												        <input onclick="updateStatus(<?php echo e($row->id); ?>)" type="checkbox" id="status-<?php echo e($row->id); ?>" <?php if($row->active == 1): ?> checked data-value="1" <?php else: ?> data-value="0" <?php endif; ?> >
												        <label for="status-<?php echo e($row->id); ?>"></label>
											        </div>
												</td>
												<td><?php echo e($row->updated_at); ?></td>
												<td class="table-photo">
													<img src="<?php echo e(asset ($row->image)); ?>" alt="" data-toggle="tooltip" data-placement="bottom" title="<?php echo e($row->name); ?>">
												</td>
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="<?php echo e(route('user.user.edit', $row->id)); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		<a href="#" onclick="changePassword(<?php echo e($row->id); ?>)" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none;"><span class="fa fa-key"></span></a>
			                                           		<a href="#" onclick="deleteConfirm('<?php echo e(route('user.user.trash', $row->id)); ?>', '<?php echo e(route('user.user.list')); ?>')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
			                                           	</div>
			                                       </div>
			                                    </td>
											</tr>
										
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
										
									</tbody>
								</table>
							</div >
						</div>
					</div>
					
				</div>
				
					
			</section><!--.box-typical-->
		</div>
	</div><!--.container-fluid-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>