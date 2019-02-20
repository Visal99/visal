
<?php $__env->startSection('section-title', 'Add Faq'); ?>
<?php $__env->startSection('tab-active-faq', 'active'); ?>



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
			$("#video-cnt").hide();
			$("#url").blur(function(){
				url= $(this).val();
				if(url != ""){
					$("#video-cnt").show();
					$("#iframe").attr("src", "//www.youtube.com/embed/"+url);
				}
			})
			
		}); 
		
		
	</script>
	
<?php $__env->stopSection(); ?>



<?php $__env->startSection('tab-content'); ?>
	<br />
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo e(route($route.'.index', $id)); ?>" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	<?php echo $__env->make('cp.layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<form id="form" action="<?php echo e(route($route.'.store')); ?>" name="form" method="POST"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<?php echo e(method_field('PUT')); ?>

		<input type="hidden" name="automation_id" value="<?php echo e($id); ?>">
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_question">Question (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_question"
										name="kh_question"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Question in English. "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_question">Question (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_question"
										name="en_question"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Question in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_answer">Answer (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_answer"
										name="kh_answer"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Answer in Khmer "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_answer">Answer (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_answer"
										name="en_answer"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Answer in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
			</div>
		</div>
	</form>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.automation.tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>