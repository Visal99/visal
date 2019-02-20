<?php $__env->startSection('section-title', "My logged records"); ?>
<?php $__env->startSection('tab-active-logs', 'active'); ?>
<?php $__env->startSection('tab-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-js'); ?>
<script type="text/javascript">
	function search(){
		d_from 	= $('#from').val();
		d_till 	= $('#till').val();
		limit 	= $('#limit').val();

		url="?limit="+limit;
		if(isDate(d_from)){
			if(isDate(d_till)){
				url+='&from='+d_from+'&till='+d_till;
			}
		}
		
		$(location).attr('href', '<?php echo e(route($route.'.logs', $id)); ?>'+url);
	}
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tab-content'); ?>
	
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="<?php echo e(isset($appends['from'])?$appends['from']:''); ?>" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<div id="till-cnt" class='input-group date' >
					<input id="till" type='text' class="form-control" value="<?php echo e(isset($appends['till'])?$appends['till']:''); ?>" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<button onclick="search()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
		</div>
	</div><!--.row-->
				
		
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Date & Time</th>
					<th>Operation System</th>
					<th>Broswer</th>
					<th>Version</th>
					<th>IP Address</th>
				</tr>
			</thead>
			<tbody>

				<?php ($i = 1); ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i++); ?></td>
						<td><?php echo e($row->created_at); ?></td>
						<td><?php echo e($row->os); ?></td>
						<td><?php echo e($row->broswer); ?></td>
						<td><?php echo e($row->version); ?></td>
						<td><?php echo e($row->ip); ?></td>
					</tr>
				
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				
			</tbody>
		</table>

	</div >
	
	<div class="row">
		<div class="col-xs-1" style="padding-right: 0px;">
			<select id="limit" class="form-control" style="margin-top: 15px;width:100%">
				<?php if(isset($appends['limit'])): ?>
				<option><?php echo e($appends['limit']); ?></option>
				<?php endif; ?>
				<option>10</option>
				<option>20</option>
				<option>30</option>
				<option>40</option>
				<option>50</option>
				<option>60</option>
				<option>70</option>
				<option>80</option>
				<option>90</option>
				<option>100</option>
			</select>
		</div>
		
		<div class="col-xs-11">
			<?php echo e($data->appends($appends)->links('vendor.pagination.custom-html')); ?>

		</div>
	</div>
		

<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.tabForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>