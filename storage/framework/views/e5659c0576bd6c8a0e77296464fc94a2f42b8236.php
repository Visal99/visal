<?php $__env->startSection('title', 'Organization Chart'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-about-us', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small><?php echo e(__('web.homepage')); ?> / <?php echo e(__('web.about-ministry')); ?> / <?php echo e(__('web.organization-chart')); ?>  </small></div>
          </div>
        <div class="col-md-12 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php echo e(__('web.organization-chart')); ?> </h1>
          </div>
          
          <div class="inner-news paddingtop5px">
           

            <div class="row padding15px">
            <div class="col-md-12 font-i2 display-list">
               <a href="<?php echo e($link); ?>"><img src=" <?php echo e(asset($image)); ?> "></a>
                <a target="_blank" href="<?php echo e($link); ?>" ><?php echo e(__('web.click-here')); ?></a>
            </div>
          
          </div>

          </div>
          

        </div>

        </div>
       
      </div>
    </div>

    <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>