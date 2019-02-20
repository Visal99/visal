<?php $__env->startSection('title', 'Content'); ?>

<?php $__env->startSection('appbottomjs'); ?>
	<script type="text/javascript">
		
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Content</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
			
			<section class="card">
				<div class="card-block">
					<h5 class="m-t-lg with-border"><b style="text-transform: capitalize;"><?php echo e($page); ?> Page</b></h5>
					<div class="table-responsive">
						<table id="table-edit" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Update At</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php ($menu = ""); ?>
							    <?php if(isset($_GET['menu'])): ?>
							        <?php ( $menu = $_GET['menu']); ?>
							    <?php endif; ?>

							    <?php ($page = ""); ?>
							    <?php if(isset($_GET['page'])): ?>
							        <?php ( $page = $_GET['page']); ?>
							    <?php endif; ?>

								<?php ($i = 1); ?>
								<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								
									<tr>
										<td><?php echo e($i++); ?></td>
										<td><?php echo e($row->name); ?></td>
										<td><?php echo e($row->updated_at); ?></td>
										
										<td style="white-space: nowrap; width: 1%;">
											<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                                           	<div class="btn-group btn-group-sm" style="float: none;">
	                                           		<a href="<?php echo e(route('user.content.edit', ['slug' => $row->slug])); ?>?menu=<?php echo e($menu); ?>&page=<?php echo e($page); ?>" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
	                                           	</div>
	                                       </div>
	                                    </td>
									</tr>
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div >
				</div>
				
					
			</section><!--.box-typical-->
		</div>
	</div><!--.container-fluid-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>