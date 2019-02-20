<?php $__env->startSection('section-title', 'Location'); ?>
<?php $__env->startSection('tab-active-location', 'active'); ?>
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
			function dragend(e){
				//console.log(e.target);
				elements = $(".moveable");
				//console.log(elements);
				data = [];
				for(i=0; i<elements.length; i++){
					var obj = new Object();
					obj.id = $('#'+elements[i].id).attr('data-id');
					obj.order = i+1;
					data[i] = obj;
				}
				
				var string = JSON.stringify(data);
				console.log(string);
				$.ajax({
				        url: "<?php echo e(route($route.'.order-location')); ?>",
				        type: 'POST',
				        data: {string:string},
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
<?php $__env->startSection('tab-content'); ?>
	<br />
	<div class="row">
		<div class="col-md-12">
			
			<a href="<?php echo e(route($route.'.create', ['id'=>$id])); ?>" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-plus"></span></a>
	
		</div>
	</div><!--.row-->
	<br />
	<?php if(sizeof($data) > 0): ?>
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Updated Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php ($i = 1); ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr id="element-<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>" class="moveable" feature-order="<?php echo e($row->data_order); ?>" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
						<td><?php echo e($i++); ?></td>
						<td><?php echo e($row->en_title); ?></td>
						
						<td><?php echo e($row->updated_at); ?></td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="<?php echo e(route($route.'.edit', ['detail_id'=>$row->id,'id'=>$id])); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('<?php echo e(route($route.'.trash', ['id'=>$id, 'location_id'=>$row->id])); ?>', '<?php echo e(route($route.'.index', ['id'=>$id])); ?>')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		
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
<?php echo $__env->make('cp.automation.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>