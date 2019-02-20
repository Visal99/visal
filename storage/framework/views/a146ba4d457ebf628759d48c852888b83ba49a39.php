<?php $__env->startSection('title', 'Message From Minister'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-about-us', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small><?php echo e(__('web.homepage')); ?> / <?php echo e(__('web.about-ministry')); ?> / <?php echo e(__('web.message-from-minister')); ?>  </small></div>
          </div>
        <div class="col-md-12 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php echo e(__('web.message-from-minister')); ?> </h1>
          </div>
          
          <div class="inner-news paddingtop5px">
            <div class="top-mss font-i2">
              <div class="date-left">
                <span clas="mss-date float-left post-time3" style="color:#003399;"> <span class="date-format" style="color:#003399;"> <?php echo e(Date('d-m-Y')); ?> </span> </span>
              </div>
              <div style="width: 178px;" class="date-right2">
                <a href="mailto:info@mpwt.gov.kh"><span clas="mss-date float-left"><i class="fa fa-envelope"></i> <?php echo e(__('web.email')); ?></span></a>
                <a href="#" ><span clas="mss-date float-right" style="float:right;"><i class="fa fa-print"></i> <?php echo e(__('web.print')); ?></span></a>
                <br />
              </div>
            </div>
            <br>
            <hr>

            <div class="row padding15px">
            <div class="col-md-12 font-i2 display-list">
              <?php echo $content; ?>

            </div>
            <div class="col-md-12 paddingtop20px font-i2 ">

            </div>
            <div class="col-md-12 padd-t-b wrap_share">
              <div class="col-md-12 no-paddding share2">
                <div class="col-md-4 no-paddding font-i2">
                  <span><?php echo e(__('web.love-to-share-on')); ?></span>
                </div>
                <div class="col-md-4 no-paddding font-i2">
                  <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo e(route('message-from-minister', $locale)); ?>&width=125&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId" width="125" height="25" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
                <div class="col-md-4 font-i2 paddingtop6px">
                  <div class="g-plus" data-action="share" data-height="24"></div>
                </div>
              </div>
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