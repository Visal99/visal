<?php $__env->startSection('title', 'Project | Ministry of Public Work And Transpotation'); ?>
<?php $__env->startSection('active-home', 'actives'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- <div class="page_banner">
    <img src="<?php echo e(asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')); ?>">
  </div> -->
    <div class="container">
        <div class="page-header">
            <h1><?php echo e(__('web.public-works-projects')); ?></h1>
        </div>
        <div class="col-md-9 col-md-9 col-sm-12">
          <div class="row">
            <div class="auto-container">
              <div class="row">
                  <div class=" col-md-6 col-sm-12 col-xs-12">
                      <img class="img img-responsive" src="<?php echo e(asset ('public/frontend/images/mpwt/driving-licence.jpg')); ?>" alt="">
                  </div>
                  <div class=" col-md-6 col-sm-12 col-xs-12 sectin-cnt">
                      <h4 class=""></i> <?php if(!empty($data)): ?> <?php echo e($data->title); ?> <?php endif; ?></h4>
                      <div class="">
                        <p><?php if(!empty($data)): ?> <?php echo e($data->background); ?> <?php endif; ?></p>
                      </div>
                  </div>
                  
              </div>

            </div>
            <hr />
          </div>

          <div class="row sectin-cnt">
            <h4 > <i class="fa fa-exclamation"></i><?php echo e(__('web.detail-information')); ?> </h4>
            <table class="table table-bordered">
                  <tr>
                    <td><?php echo e(__('web.project-process')); ?></td><td>Upgrade</td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.construction-type')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->construction_type); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.category')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->category); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.province')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->province); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.location')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->location); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.authority-in-charge')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->authority); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.constructor')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->constructor); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.period')); ?> </td><td><?php if(!empty($data)): ?> <?php echo e($data->period); ?> <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e(__('web.note')); ?></td><td><?php if(!empty($data)): ?> <?php echo e($data->note); ?> <?php endif; ?></td>
                  </tr>
            </table>
            <hr />
          </div>

          <div class="row sectin-cnt">
            <h4 class=""> <i class="fa fa-list-alt"></i><?php echo e(__('web.related-projects')); ?></h4>
            <div class="three-item-carousel owl-carousel owl-theme">
                <!--News Block-->
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="news-block wow fadeInLeft animated animated">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image item01">
                                <img src="<?php echo e(asset ($row->image)); ?>" alt="" />
                                
                            </div>
                        </div>
                        <div class="content-boxproject">
                            <div class="upper-box">
                               <a href="<?php echo e(route('project-view', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a>
                            </div>
                        
                        </div>
                        
                    </div>
                </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
               
                 
            </div>
            <hr />
          </div>
        </div>
        <div class="clearfixed"></div>
        
        <!--Sidebar Side-->
        <div class="sidebar-side col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <aside class="sidebar">
            <?php echo $__env->make('frontend.sidebar.public-works', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('frontend.sidebar.automation-systems', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </aside>
        </div>
    </div>
    <br /> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>