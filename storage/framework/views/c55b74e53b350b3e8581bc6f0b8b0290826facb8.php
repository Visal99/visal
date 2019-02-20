<?php $__env->startSection('title', 'The Sinior Minister'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-about-us', 'active'); ?>


<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small><?php echo e(__('web.homepage')); ?> / <?php echo e(__('web.about-ministry')); ?> / <?php echo e(__('web.the-senior-minister')); ?>  </small></div>
          </div>
        <div class="col-md-8 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php echo e(__('web.the-senior-minister')); ?> </h1>
          </div>
          <div class="inner-news font-i2 default_text">
            <div class="sectin-cnt">
              <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="default_text font-i2 display-list">
                <?php if($row->title != "_"): ?>
                  <h4><?php echo e($row->title); ?></h4>
                <?php endif; ?>
                
                <?php echo $row->content; ?>

              </div>
              <br />
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
        <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padd-t-b">
          <aside class="sidebar">
           <article class="">
              <div class="page-header">
                  <h1 class="text-center font-i"><?php echo e(__('web.about-ministry')); ?></h1>
              </div>
              <div class="inner-news paddingtop5px">
                 <?php echo $__env->make('frontend.about-us.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              </div>
          </article>
          </aside>
        </div>
        <!--End Sidebar Side-->
      </div>
    </div>

    <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>