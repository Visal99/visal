<?php $__env->startSection('title', __('general.public-works').' | '.__('general.welcome')); ?>
<?php $__env->startSection('active-public-work', 'actives'); ?>

<?php $__env->startSection('appbottomjs'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- <div class="page_banner">
    <img src="<?php echo e(asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')); ?>">
  </div> -->
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.public-works')); ?> <?php if(!empty($data)): ?>/ <?php echo e($data->title); ?><?php endif; ?>  </small></div>
        </div>
        <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php if(!empty($data)): ?> <?php echo e($data->title); ?><?php endif; ?></h1>
          </div>
            <!-- Introduction -->
            <div class="inner-news paddingtop5px">
              <div class="sectin-cnt font-i2 font-text-ct default_text">
                <p class="" style="font-size: 14px;"><?php if(!empty($data)): ?> <?=$data->content?> <?php endif; ?></p>
              </div>
            </div>
            <?php if(sizeof($documents)>0): ?>
            <!-- Regulations -->
            <div class="row sectin-cnt">
              <h4 class=""> <i class="fa fa-list-alt"></i> <?php echo e(__('web.regulations')); ?></h3>
              <table class="table table-bordered">
                <thead class="text-center">
                  <td><?php echo e(__('web.no')); ?> </td>
                  <td><?php echo e(__('web.date')); ?> </td>
                  <td><?php echo e(__('web.type')); ?> </td>
                  <td><?php echo e(__('web.title')); ?> </td>
                </thead>
                <tbody>
                  <?php ($i = 0); ?>
                  <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php ( $i++ ); ?>
                  <tr>
                    <td><?php echo e($i); ?> </td>
                    <td><div class="post-info"><?php echo e(Carbon\Carbon::parse($row->updated_at)->format('Y-M-d')); ?></div></td>
                    <td><?php echo e($row->type); ?></td>
                    <td><a href="<?php echo e(asset($row->pdf)); ?>" target="_blank" ><?php echo e($row->title); ?></a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <hr />
            </div>
            <?php endif; ?>
         
        </div>
        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-md-4">
           <aside class="sidebar">
              <div class="sidebar-widget">
                  <?php echo $__env->make('frontend.sidebar.public-works', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
              </div>
           </aside>
        </div>
        <div class="clearfixed"></div>
        <div class="col-md-12 padd-t-b">
            <?php ($projects = $data->projects()->select($locale.'_title as title','image','slug')->get()); ?>
            <?php if(sizeof($projects)>0): ?>
            <div class="sectin-cnt">
              <div class="page-header">
                <h1 class="padding-left1 font-i"> <?php echo e(__('web.project')); ?></h1>
              </div>
              <div class="inner-news paddingbottom5px">
                <div class="three-item-carousel owl-carousel owl-theme">
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
              </div>
            </div>
            <?php endif; ?>
        </div>
      </div>
    </div>
  <?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>