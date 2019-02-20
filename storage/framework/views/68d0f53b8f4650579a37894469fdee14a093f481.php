<?php $__env->startSection('title', $title.' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-documents', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="breadcrumd"><small><a href="<?php echo e(route('home', $locale)); ?>"> <?php echo e(__('web.homepage')); ?></a> / <a href="<?php echo e(route('documents-blank', ['locale'=>$locale])); ?>"> <?php echo e(__('web.official-documents')); ?> </a> <?php if($title != ""): ?> / <a href="#"> <?php echo e($title); ?> </a> <?php endif; ?> </small></div>
        </div>

        <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php if($title != ""): ?> <?php echo e($title); ?> <?php endif; ?></h1>
          </div>
          
          <div class="inner-news">
            <div class="row content-box">
                <?php if(count($data) > 0): ?>
                 <?php ($i = 0); ?>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <div class="  col-lg-12  content-box">
                      <div class=" upper-box11 " <?php if($i == 0): ?> style="border-top:0px"  <?php ($i = 2); ?> <?php endif; ?> >
                          <div class="wrap-ct-doc">
                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                              <h3>
                                <a target="_blank" href="<?php echo e($row->google_drive_url); ?>" ><?php echo e($row->title); ?></a>
                                  <div class="post-time22">
                                   
                                    <span class="date-format"><?php echo e($row->official_published_date); ?></span>
                                     <span class="post-type11">
                                      <a href="<?php echo e(route('documents', ['locale'=>$locale, 'category'=>$row->category->slug])); ?>" ><?php echo e($row->category->title); ?> </a>  
                                    </span> 

                                  </div>
                              </h3>
                          </div>
                      </div>
                  </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                <div class=" col-xs-12">
                  <p><?php echo e(__('web.no-data')); ?></p>
                </div>
                  
                <?php endif; ?>
              </div>
          </div>

          <div class="text-center">
            <?php echo e($data->links('vendor.pagination.frontend-html')); ?>

          </div>

        </div>

        <div class="clearfixed"></div>
        <!--Sidebar Side-->
        <div class="sidebar-side col-md-4 no-padd-t-b">
          
          <?php if(isset($defaultData['documentCategories'])): ?>
            <?php ($documentCategories = $defaultData['documentCategories']); ?>
            <?php if(count($documentCategories) > 0): ?>
              <aside class="sidebar">
                <div class="sidebar-widget">
                    <article class="">
                      <div class="page-header">
                          <h1 class="text-center font-i"><?php echo e(__('web.official-documents')); ?></h1>
                      </div>
                     
                      <div class="inner-news paddingtop5px">
                        <ul class="list-group font-i2">
                            <?php for($i = 0; $i < count($documentCategories); $i++): ?>
                            <li  class="list-group-item <?php if( isset($subActive)  && $subActive == $documentCategories[$i]['parent']->slug): ?> sub-menu-active  <?php endif; ?>" <?php if($i ==0): ?> style="border-top:0px" <?php endif; ?> >
                              <a href="<?php echo e(route('documents', ['locale'=>$locale, 'category'=>$documentCategories[$i]['parent']->slug])); ?>"><?php echo e($documentCategories[$i]['parent']->title); ?></a>
                            </li>
                            <?php endfor; ?>
                        </ul>
                      </div>
                    </article>
                </div>
              </aside>

            <?php endif; ?>
          <?php endif; ?>

        </div>
        <div class="clearfixed"></div>
        <?php if(isset($projects)): ?>
          <?php if(sizeof($projects) > 0): ?>
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
                                      <a href="<?php echo e(route('project-view', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><img src="<?php echo e(asset ($row->image)); ?>" alt="" /></a>
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
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

<?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>