<?php $__env->startSection('section-title', 'Permision'); ?>
<?php $__env->startSection('display-btn-back', 'display:none'); ?>
<?php $__env->startSection('section-css'); ?>



<?php $__env->startSection('section-content'); ?>
	
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>N. of Permisions</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php ($i = 1); ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i++); ?></td>
						<td><?php echo e($row->title); ?></td>
						<td><?php echo e(count($row->permisions)); ?></td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		<a href="<?php echo e(route($route.'.permisions', $row->id)); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				
			</tbody>
		</table>
	</div >

<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>