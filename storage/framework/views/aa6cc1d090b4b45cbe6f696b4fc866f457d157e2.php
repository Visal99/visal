<?php $__env->startSection('title', __('general.about-us').' | '.__('general.welcome')); ?>
<?php $__env->startSection('active-about', 'actives'); ?>

<?php $__env->startSection('appbottomjs'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- <div class="page_banner">
    <img src="<?php echo e(asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')); ?>">
  </div> -->
    <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.about')); ?> / <?php echo e(__('general.organization-chart')); ?>  </small></div>
          </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php echo e(__('general.organization-chart')); ?> </h1>
          </div>
          <div class="inner-news font-i2 default_text">
            <!-- <embed src="<?php echo e(asset('public/frontend/file/organizationchart.pdf')); ?>" type="application/pdf"   height="700px" width="100%"> -->
            <a href="<?php echo e($organization->link); ?>"><img src=" <?php echo e(asset($organization->image)); ?> "></a>
            <p><?php echo e(__('general.download-link')); ?>:<a target="_blank" href="<?php echo e($organization->link); ?>" ><?php echo e(__('general.click-here')); ?></a></p>
        
          </div>
        </div>
        <div class="clearfixed"></div>
        
      </div>
    </div>
    <?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>