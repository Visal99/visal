<?php $__env->startSection('section-title', 'Permision'); ?>
<?php $__env->startSection('section-css'); ?>
	<style type="text/css">
	.fa-users{
		cursor:pointer;
	}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('section-js'); ?>
	<script type="text/javascript">
	

	    function users(id){
         	$("#modal").modal("show");
         	$.ajax({
		        url: "<?php echo e(route($route.'.users')); ?>?id="+id,
		        method: 'GET',
		        data: {},
		        success: function( response ) {
		           $("#result").html(response);
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
			});

    	}

    
	</script>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('section-content'); ?>
<h5><?php echo e($data->title); ?></h5>
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>N. of Users</th>
			</tr>
		</thead>
		<tbody>

			<?php ($i = 1); ?>
			<?php $__currentLoopData = $data->permisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($i++); ?></td>
					<td><?php echo e($row->title); ?></td>
					<td><?php echo e(count($row->users)); ?>&nbsp; <i class="fa fa-users" onclick="users(<?php echo e($row->id); ?>)"></i></td>
				</tr>
			
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
		</tbody>
	</table>
</div >

<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Permised Users</h4>
                </div>
                <div class="modal-upload menu-bottom">
                    <div class="modal-upload-cont">
                        <div class="modal-upload-cont-in">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab-upload-2">
                                    <div class="modal-upload-body scrollable-block">
                                       	<div class="container-fluid">
                                       		<div class="row">
                                       			<div class="col-xs-12">
                                       				<div class="chat-list-search">
														<input type="text" id="search" class="form-control form-control-rounded" placeholder="Type Name, E-mail, or Phone">
													</div>
                                       				<div id="result">
                                       					
                                       				</div>
                                       			</div>
                                       			
                                       			
                                       		</div>
                                       	</div> 
                                    </div><!--.modal-upload-body-->
                                    <div class="modal-upload-bottom">
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-rounded btn-default">Close</button>
                                    </div><!--.modal-upload-bottom-->
                                </div><!--.tab-pane-->
                              
                            </div><!--.tab-content-->
                        </div><!--.modal-upload-cont-in-->
                    </div><!--.modal-upload-cont-->
                   
                </div>
            </div>
        </div>
</div><!--.modal-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>