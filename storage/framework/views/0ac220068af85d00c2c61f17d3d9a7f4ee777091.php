<?php $__env->startSection('title', $title.' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php ( $featuredImage = $data->images()->select('img_url')->orderBy('data_order', 'ASC')->first() ); ?>
  <?php if($featuredImage): ?>
    <?php $__env->startSection('seo-image', asset($featuredImage->img_url)); ?>
  <?php endif; ?>
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
            <div class="breadcrumd"><small> <a href="<?php echo e(route('home',$locale)); ?>"> <?php echo e(__('web.homepage')); ?> </a> / <a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>''])); ?>"> <?php echo e(__('web.news')); ?> </a> / <a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>$category->slug])); ?>"> <?php echo e($category->title); ?> </a> </small></div>
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-md-8">
                    <div class="page-header">
                        <h1 class="font-i padding-left1"><?php echo e($title); ?></h1>
                    </div>
                    <div class="inner-news">
                       <div class="post-time">
                          <span class="date-format"><?php echo e($data->event_date); ?></span>
                        </div>
                        <div class="blog-detail">
                           
                            <div class="news-block">
                                <div class="inner-box">
                                    <?php ( $featuredImage = $data->images()->select('img_url')->orderBy('data_order', 'ASC')->first() ); ?>
                                    <?php if($featuredImage): ?>
                                      <div class="image-box">
                                          <div class="image">
                                              <img src="<?php echo e(asset($featuredImage->img_url)); ?>" alt="">
                                          </div>
                                      </div>
                                    <?php endif; ?>

                                    <div class="content-box">
                                        <div class="upper-box">
                                            
                                        </div>
                                        <div class="lower-box">
                                            <div class="text font-i2">
                                               
                                              <?php if(!empty($data)): ?><?=$data->content?> <?php endif; ?>

                                            </div>
                                            <div class="social-box">
                                                <div class="social-links-one">
                                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.facebook.com%2Fmpwt.gov.kh%2F&layout=button_count&size=small&mobile_iframe=true&width=89&height=20&appId" width="89" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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