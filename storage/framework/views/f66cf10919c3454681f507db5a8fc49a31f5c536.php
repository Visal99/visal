<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('description', $data->short_content); ?>
<?php $__env->startSection('image', $data->image); ?>
<?php $__env->startSection('active-post', 'active'); ?>

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
            <div class="breadcrumd"><small> <a href="<?php echo e(route('home',$locale)); ?>"> <?php echo e(__('web.homepage')); ?> </a> / <a href="<?php echo e(route('posts', ['locale'=>$locale])); ?>"> <?php echo e(__('web.news')); ?> </a>  </small></div>
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-md-8">
                    <div class="page-header">
                        <h1 class="font-i padding-left1"><?php if($data->source->id != 174): ?> [<?php echo e($data->source->source); ?>] - <?php endif; ?> <?php echo e($title); ?></h1>
                    </div>
                    <div class="inner-news">
                       <div class="post-time">
                          <span class="date-format"><?php echo e($data->news_date); ?></span>
                          <span class="post-type11"> <a target="_blank" href="<?php echo e($data->link); ?>" > <?php echo e($data->source->source); ?></a> </span> 
                        </div>
                        <div class="blog-detail">
                           
                            <div class="news-block">
                                <div class="inner-box">
                                    
                                      <div class="image-box">
                                          <div class="image">
                                              <img src="<?php echo e($data->image); ?>" alt="">
                                          </div>
                                      </div>
                                   

                                    <div class="content-box">
                                        <div class="upper-box">
                                            
                                        </div>
                                        <div class="lower-box">
                                            <div class="text font-i2">
                                               
                                              <?php echo e($data->long_content); ?>


                                              <?php if( $data->video != '' ): ?>
                                                <?php if(strpos($data->video, 'https://youtu.be/') !== false): ?>
                                                  <?php ( $youtubeId = str_replace('https://youtu.be/', '', $data->video) ); ?>
                                                  <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo e($youtubeId); ?>" allowfullscreen></iframe>
                                                  </div>

                                                <?php else: ?>
                                                <div>
                                                  <iframe src="https://www.facebook.com/plugins/video.php?href=<?php echo e($data->video); ?>&show_text=false&appId=661860757509897"  style="border:none; width:100%; height:400px" scrolling="yes" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>
                                                </div>
                                                  
                                                <?php endif; ?>

                                                  
                                              <?php endif; ?>


                                            </div>
                                            <div>
                                              <div class="sidebar ">
                                                <div class="sidebar-widget popular-tags">
                                                    <?php ($tags = $data->tags); ?>
                                                    <?php for($i = 0 ; $i < sizeof($tags); $i++): ?>
                                                    <a href="<?php echo e(route('posts', ['locale'=>$locale, 'tag'=>$tags[$i]->id, 'title'=>$tags[$i]->tag])); ?>"><?php echo e($tags[$i]->tag); ?></a>
                                                    <?php endfor; ?>
                                                    
                                                </div>
                                              </div>
                                                
                                            </div>
                                            <div class="social-box">
                                                <div class="social-links-one">
                                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo e(route('post', ['locale'=>$locale, 'id'=>$data->id])); ?>&layout=button_count&size=small&mobile_iframe=true&width=89&height=20&appId" width="89" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
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
                  <?php if(count($press['data']->data) > 0): ?>
                  <aside class="sidebar">
                    <div class="sidebar-widget popular-posts">
                      <div class="page-header">
                          <h1 class="text-center font-i"><?php echo e(__('web.featured-post')); ?></h1>
                      </div>
                      <div class="inner-news">
                      <?php ( $data = $press['data']->data ); ?>
                      <?php for($i = 0 ; $i < sizeof($data); $i++): ?>
                      
                      <article class="post">
                          <?php ( $link = route('post', ['locale'=>$locale, 'id'=>$data[$i]->id]) ); ?>
                          <?php ( $img = $data[$i]->image ); ?>
                          <?php if($img == ''): ?>
                            <?php ( $img = asset('public/frontend/images/placeholder.jpg') ); ?>
                            <?php if($data[$i]->video != ''): ?>
                              <?php ( $img = asset('public/frontend/images/video-placeholder.jpg') ); ?>
                            <?php endif; ?>
                          <?php endif; ?>

                          <figure class="post-thumb"><a href="<?php echo e($link); ?>"><img src="<?php echo e($img); ?>" alt=""></a></figure>
                          <div class="text font-i2"><a href="<?php echo e($link); ?>"><?php if($data[$i]->source->id != 174): ?> [<?php echo e($data[$i]->source->source); ?>] - <?php endif; ?> <?php echo e($data[$i]->title); ?></a></div>
                      </article>

                       <?php endfor; ?>
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