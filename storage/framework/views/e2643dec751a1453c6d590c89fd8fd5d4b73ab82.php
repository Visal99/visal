<?php if(count($data)>0): ?>
<table id="pop-table" class="table pop">
	<thead>
		<th>Name</th><th>E-mail</th><th>Phone</th><th></th>
	</thead>
	<tbody>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
			<tr>
				<td><?php echo e($row->en_name); ?></td><td><?php echo e($row->email); ?> <td><?php echo e($row->phone); ?></td></td><td width=8%><i onclick="window.location.href='<?php echo e(route('user.user.user.edit', $row->id)); ?>'" class="fa fa-eye"></i></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	</tbody>
</table>
<?php else: ?>
	No Data Avaiable
<?php endif; ?>
