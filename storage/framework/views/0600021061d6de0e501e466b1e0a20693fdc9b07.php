<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-post', 'active'); ?>
<?php $__env->startSection('appbottomjs'); ?>

<script type="text/javascript" >
  
</script>

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
                          <?php if(count($press['data']->data) > 0): ?>
                            <?php ( $data = $press['data']->data ); ?>
                            <?php for($i = 0 ; $i < sizeof($data); $i++): ?>
                              <?php if( $data[$i]->pin == 0 ): ?>
                              <div class="blog-post style-two">
                                  <div class="row clearfix">
                                      <div class="image-column col-md-4">
                                          <div class="image">
                                            <?php ( $link = route('post', ['locale'=>$locale, 'id'=>$data[$i]->id]) ); ?>
                                            <?php ( $img = $data[$i]->image ); ?>
                                            <?php if($img == ''): ?>
                                              <?php ( $img = asset('public/frontend/images/placeholder.jpg') ); ?>
                                              <?php if($data[$i]->video != ''): ?>
                                                <?php ( $img = asset('public/frontend/images/video-placeholder.jpg') ); ?>
                                              <?php endif; ?>
                                            <?php else: ?>
                                             
                                             

                                            <?php endif; ?>
                                            
                                            <a href="<?php echo e($link); ?>"><img src="<?php echo e($img); ?>" alt=""></a>
                                          </div>
                                      </div>
                                      <div class="content-column col-md-8">
                                          <div class="inner">
                                             
                                              <div class="upper-box1 ">
                                                  <i class="fa9 fa-angle-right9 " aria-hidden="true"></i>
                                                  <h3>
                                                     <a href="<?php echo e($link); ?>" ><?php if($data[$i]->source->id != 174): ?> [<?php echo e($data[$i]->source->source); ?>] - <?php endif; ?> <?php echo e($data[$i]->title); ?></a>  &nbsp;
                                                     
                                                      <div class="post-time22"> 
                                                          <span class="date-format"><?php echo e($data[$i]->news_date); ?></span>
                                                          <span class="post-type11"> <a href="<?php echo e(route('posts', ['locale'=>$locale, 'source'=>$data[$i]->source->id, 'title'=>$data[$i]->source->source])); ?>" ><?php echo e($data[$i]->source->source); ?></a> </span> 
                                                      </div>
                                                  </h3>
                                              </div>
                                              <div class="lower-box">
                                                  <div class="text font-i2">
                                                       <?php ($description =str_limit(strip_tags($data[$i]->short_content), 110)); ?>
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
                              <?php endif; ?>
                            <?php endfor; ?>
                          <?php else: ?>
                            <p><?php echo e(__('web.no-data')); ?></p>
                          <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-center">
                     
                        <ul class="pagination text-center">
                         
                          <li class="page-item"><a class="page-link" href="<?php echo e($prevousPage); ?>">ទំព័រក្រោយ</a></li>
                          <li class="page-item"><a class="page-link" href="<?php echo e($nextPage); ?>">ទំព័របន្ទាប់ </a></li>
                      
                        </ul>
                      
                    </div>
                    
                </div>
              
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12 no-padd-t-b">

                  <?php if(count($sources['data']) > 0): ?>
                  <aside class="sidebar">
                    <?php ( $data = $sources['data']); ?>
                    <div class="sidebar-widget popular-posts">
                        <div class="page-header">
                            <h1 class="text-center font-i"><?php echo e(__('web.media-partners')); ?></h1>
                        </div>
                        <div class="inner-news">
                          <div class="sidebar-widget popular-tags">
                            <?php for($i = 0 ; $i < sizeof($data); $i++): ?>
                            <?php if($i<50): ?>
                            <a  <?php if($data[$i]->id == $source): ?> style="background:#b3000b;color:white" <?php endif; ?> href="<?php echo e(route('posts', ['locale'=>$locale, 'source'=>$data[$i]->id, 'title'=>$data[$i]->source])); ?>"><?php echo e($data[$i]->source); ?></a>
                            <?php endif; ?>
                            <?php endfor; ?>
                          </div>
                        </div>  
                    </div>
                    
                  </aside>
                  <br />
                  <?php endif; ?>

                  <?php if(count($tags['data']->data) > 0): ?>
                  <aside class="sidebar">
                    <?php ( $data = $tags['data']->data ); ?>
                    <div class="sidebar-widget popular-posts">
                        <div class="page-header">
                            <h1 class="text-center font-i"><?php echo e(__('web.keyword')); ?></h1>
                        </div>
                        <div class="inner-news">
                          <div class="sidebar-widget popular-tags">
                            <?php for($i = 0 ; $i < sizeof($data); $i++): ?>
                            <a <?php if($data[$i]->id == $tag): ?> style="background:#b3000b;color:white" <?php endif; ?> href="<?php echo e(route('posts', ['locale'=>$locale, 'tag'=>$data[$i]->id, 'title'=>$data[$i]->tag])); ?>"><?php echo e($data[$i]->tag); ?></a>
                            <?php endfor; ?>
                          </div>
                        </div>  
                    </div>
                    
                  </aside>
                  <?php endif; ?>
                </div>
               
            </div>
        </div>
    </div>
  <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>