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
              <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.about')); ?> <?php if(!empty($category)): ?>/ <?php echo e(__('general.'.$category)); ?><?php endif; ?>  </small></div>
          </div>
        <div class="col-md-8 col-sm-12 ">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php if(!empty($category)): ?> <?php echo e(__('general.'.$category)); ?><?php endif; ?> </h1>
          </div>
          <div class="inner-news font-i2 default_text">

            
            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-exclamation font-i2"></i> <?php echo e(__('general.background')); ?></h4>
              <div class="default_text font-i2">
              <p><?php if(!empty($background)): ?> <?php echo $background->content; ?><?php endif; ?></p>
              </div>
              <hr />
            </div>

            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-star-o "></i> <?php echo e(__('general.mission')); ?></h4>
              <div class="default_text">
              <p><?php if(!empty($mission)): ?> <?php echo $mission->content; ?><?php endif; ?></p>
              </div>
              <hr />
            </div>
            
            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-eye "></i> <?php echo e(__('general.vision')); ?></h4>
              <div class="default_text">
              <p><?php if(!empty($vision)): ?> <?php echo $vision->content; ?><?php endif; ?></p>
              </div>
              <hr />
            </div>
          </div>
        </div>
        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12">
          <aside class="sidebar">
            <?php echo $__env->make('frontend.sidebar.public-works', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </aside>
        </div>
        <!--End Sidebar Side-->
      </div>
    </div>
    <?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>