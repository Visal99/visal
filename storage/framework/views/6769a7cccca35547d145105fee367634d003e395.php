<?php $__env->startSection('section-title', $contact->en_title.': Message'); ?>
<?php $__env->startSection('tab-active-message', 'active'); ?>
<?php $__env->startSection('tab-js'); ?>
	<script type="text/javascript">
		var source;
		function isbefore(a, b) {
		    if (a.parentNode == b.parentNode) {
		        for (var cur = a; cur; cur = cur.previousSibling) {
		            if (cur === b) {
		                return true;
		            }
		        }
		    }
		    return false;
		}

		function dragenter(e) {
			
		    var targetelem = e.target;
		    //console.log(e);
		    if (targetelem.nodeName == "TD") {
		       targetelem = targetelem.parentNode;   
		    }  
		    
		    if (isbefore(source, targetelem)) {
		        targetelem.parentNode.insertBefore(source, targetelem);
		        //console.log('moved :'+order);
		    } else {
		        targetelem.parentNode.insertBefore(source, targetelem.nextSibling);

		    }
		}

		function dragstart(e) {
		    source = e.target;
		    e.dataTransfer.effectAllowed = 'move';

		}
		
	</script>
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tab-content'); ?>
	<br />
	<div class="row">
		<div class="col-md-12">
			
			
		</div>
	</div><!--.row-->
	<br />
	<?php if(sizeof($data) > 0): ?>
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
					<th>Purpose</th>
					<th>Seen</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php ($i = 1); ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i++); ?></td>
						<td><?php echo e($row->name); ?></td>
						<td><?php echo e($row->organization); ?></td>
						<td><?php echo e($row->position); ?></td>
						<td><?php echo e($row->phone); ?></td>
						<td><?php echo e($row->email); ?></td>
						<td><?php echo e($row->purpose); ?></td>
						<td>
							<div class="checkbox-toggle">
						        <input type="checkbox" id="status-<?php echo e($row->id); ?>" <?php if($row->is_seen == 1): ?> checked data-value="1" <?php else: ?> data-value="0" <?php endif; ?> >
						        <label for="status-<?php echo e($row->id); ?>"></label>
					        </div>
						</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="<?php echo e(route($route.'.edit', ['detail_id'=>$row->id,'id'=>$id])); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		
	                           		
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div >
	<?php else: ?>
	<span>No data here!</span>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.contact.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>