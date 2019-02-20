<?php $__env->startSection('title', $title.' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-news', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    

  <style type="text/css">
      .museum-block1{
          margin-bottom:20px;
      }
  </style>
  <div class="container sidebar-page-container">
      <div class="auto-container">
            <div class="breadcrumd"><small> <a href="<?php echo e(route('home',$locale)); ?>"> <?php echo e(__('web.homepage')); ?> </a>/ <a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>''])); ?>"> <?php echo e(__('web.news')); ?> </a> </small></div>
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-md-8">
                    <div class="page-header">
                        <h1 class="font-i padding-left1"><?php echo e($title); ?></h1>
                    </div>
                    <div class="inner-news">
                      <div class="blog-list">
                          <?php if(count($data) > 0): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="blog-post style-two">
                                <div class="row clearfix">
                                    <div class="image-column col-md-4">
                                        <div class="image">
                                          <?php ($link = route('news-detail', ['locale'=>$locale, 'id'=>$row->id]) ); ?>
                                          <?php ( $img = asset('public/frontend/images/1Mthanks.jpg')); ?>
                                          <?php ( $featuredImage = $row->images()->select('img_url')->where('is_featured', 1)->first() ); ?>
                                          <?php if($featuredImage): ?>
                                            <?php ( $img = asset($featuredImage->img_url) ); ?>
                                          <?php else: ?>
                                            <?php ( $lastImage = $row->images()->select('img_url')->orderBy('data_order', 'ASC')->first() ); ?>
                                            <?php if($lastImage): ?>
                                              <?php ( $img = asset($lastImage->img_url) ); ?>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                           
                                          <a href="<?php echo e($link); ?>"><img src="<?php echo e($img); ?>" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="content-column col-md-8">
                                        <div class="inner">
                                            
                                            <div class="upper-box1 ">
                                                <i class="fa9 fa-angle-right9 " aria-hidden="true"></i>
                                                <h3>
                                                   <a href="<?php echo e($link); ?>" ><?php echo e($row->title); ?></a>  &nbsp;
                                                    <div class="post-time22">
                                                        <span class="post-type11"> <a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>$row->category->slug])); ?>" ><?php echo e($row->category->title); ?> </a> </span>  
                                                      <span class="date-format">  <?php echo e($row->event_date); ?> </span>
                                                    </div>
                                                </h3>
                                            </div>
                                            <div class="lower-box">
                                                <div class="text font-i2">
                                                    <?php ($description =str_limit(strip_tags($row->content), 110)); ?>
                                                    <p><?php echo e($description); ?></p>
                                                </div>
                                                <div class="">
                                                  <a href="<?php echo e($link); ?>"><span style="" class="view_more view-more"><?php echo e(__('web.continue-reading')); ?><i  class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <p><?php echo e(__('web.no-data')); ?></p>
                          <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php echo e($data->links('vendor.pagination.frontend-html')); ?>

                    </div>
                    
                </div>
              
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12 no-padd-t-b">
                  <aside class="sidebar">
                        <?php echo $__env->make('frontend.news.features', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  </aside>
                </div>
               
            </div>
        </div>
    </div>
  <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>