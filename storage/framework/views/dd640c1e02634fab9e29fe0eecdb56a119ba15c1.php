<?php $__env->startSection('section-title', 'All Document'); ?>
<?php $__env->startSection('display-btn-add-new', 'display:none'); ?>
<?php $__env->startSection('section-css'); ?>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('section-js'); ?>
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
				        url: "<?php echo e(route($route.'.order')); ?>",
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

	$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
		});
		function search(){
			key 	= $('#key').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();
			category 	= $('#category').val();
			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			if(category!=""){
				url+='&category='+category;
			}
			$(location).attr('href', '<?php echo e(route($route.'.index')); ?>'+url);
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
			        url: "<?php echo e(route($route.'.update-status')); ?>",
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

<?php $__env->startSection('section-content'); ?>

<div class="container-fluid">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Key" value="<?php echo e(isset($appends['key'])?$appends['key']:''); ?>">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2">
		<div class="form-group">
			
			<select class="select2" id="category" class="form-control">
				<?php 
					$first='';
					$othersx='';

					$category=isset($_GET['category'])?$_GET['category']:0;
					foreach($categories as $row){ 
						if($category==$row->id){
							$first='<option value="'.$row->id.'">'.$row->en_name.'</option>';
						}else{
							$othersx.='<option value="'.$row->id.'">'.$row->en_name.'</option>';
						}
					}
					echo $first.'<option value="0">Select type</option>'.$othersx;
				?>
			</select> 
        </div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2">
		<div class="form-group">
			
			<select class="select2" id="category" class="form-control">
				<?php 
					$first='';
					$othersx='';

					$category=isset($_GET['category'])?$_GET['category']:0;
					foreach($categories as $row){ 
						if($category==$row->id){
							$first='<option value="'.$row->id.'">'.$row->en_name.'</option>';
						}else{
							$othersx.='<option value="'.$row->id.'">'.$row->en_name.'</option>';
						}
					}
					echo $first.'<option value="0">Select Category</option>'.$othersx;
				?>
			</select> 
        </div>
	</div>
	

	<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="<?php echo e(isset($appends['from'])?$appends['from']:''); ?>" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="<?php echo e(isset($appends['till'])?$appends['till']:''); ?>" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="ccol-xs-12 col-sm-12 col-md-2">
		<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
	</div>
</div>
<?php if(sizeof($data) > 0): ?>
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr >
				<th>#</th>
				<th>Title</th>
				<th>Type</th>
				<th>Category</th>
				<th>Publish</th>
				<th>Created Date</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		
			
			<?php ($i = 1); ?>
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($i++); ?></td>
					<td><?php echo e($row->en_title); ?></td>
					<td><?php echo e($row->category->en_name); ?></td>
					<td><?php echo e($row->category->en_name); ?></td>
					<td>
						<div class="checkbox-toggle">
					        <input onclick="updateStatus(<?php echo e($row->id); ?>)" type="checkbox" id="status-<?php echo e($row->id); ?>" <?php if($row->is_published == 1): ?> checked data-value="1" <?php else: ?> data-value="0" <?php endif; ?> >
					        <label for="status-<?php echo e($row->id); ?>"></label>
				        </div>
					</td>
					<td><?php echo e($row->created_at); ?></td>
					<td style="white-space: nowrap; width: 1%;">
						<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                           	<div class="btn-group btn-group-sm" style="float: none;">
                           		<a href="<?php echo e(route($route.'.edit', $row->id)); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		<a href="#" onclick="deleteConfirm('<?php echo e(route($route.'.trash', $row->id)); ?>', '<?php echo e(route($route.'.index')); ?>')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
                           	</div>
                       </div>
                    </td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div >
<?php else: ?>
	<span>No Data</span>
<?php endif; ?>
<div class="row">
	<div class="col-xs-2">
		<select id="limit" onchange="search()" class="form-control" style="margin-top: 15px;width:50%">
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
	<div class="col-xs-10">

		<?php echo e($data->appends($appends)->links('vendor.pagination.custom-html')); ?>

	</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($route.'.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>