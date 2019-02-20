<?php ( $department_name ="" ); ?>
<?php if( $contact->has_departments == 1 ): ?>
	<?php ( $department_name =" -> ".$data->en_title ); ?>
	<?php $__env->startSection('active-main-menu-contact-general-department', 'opened'); ?>
<?php endif; ?>
<?php $__env->startSection('section-title', $contact->en_title.$department_name ); ?>
<?php $__env->startSection('tab-active-message', 'active'); ?>
<?php $__env->startSection('active-main-menu-contact', 'opened'); ?>
<?php $__env->startSection('tab-css'); ?>
	
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
			
		});


	</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	<?php if(sizeof($messages) > 0): ?>
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Organization</th>
					<th>Position</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Message</th>
				</tr>
			</thead>
			<tbody ondrop="alert('ddd')">

				<?php ($i = 1); ?>
				<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr id="element-<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>" class="moveable" feature-order="" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
						<td><?php echo e($i++); ?></td>
						<td><?php echo e($row->name); ?></td>
						<td><?php echo e($row->organization); ?></td>
						<td><?php echo e($row->position); ?></td>
						<td><?php echo e($row->phone); ?></td>
						<td><?php echo e($row->email); ?></td>
						<td><textarea class="form-control"><?php echo e($row->message); ?></textarea></td>
						
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div >
	<?php else: ?>
	<span>No Data</span>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>