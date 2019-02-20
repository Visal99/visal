<?php $__env->startSection('title',  __('web.projects'). ' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>

<?php if($data): ?> <?php $__env->startSection('image', asset($data->image_url)); ?>  <?php endif; ?>

<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-public-works', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<link href="<?php echo e(asset ('public/frontend/css/owl.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset ('public/frontend/js/owl.js')); ?>"></script>
<script type="text/javascript">
  if ($('.three-item-carousel').length) {
    $('.three-item-carousel').owlCarousel({
      loop:true,
      margin:30,
      nav:false,
      smartSpeed: 700,
      autoplay: 4000,
      navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
      responsive:{
        0:{
          items:1
        },
        480:{
          items:1
        },
        600:{
          items:1
        },
        800:{
          items:2
        },
        1024:{
          items:4
        }
      }
    });       
  }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumd"><small><a href="<?php echo e(route('home', $locale)); ?>"> <?php echo e(__('web.homepage')); ?></a> / <a href=""> <?php echo e(__('web.public-works')); ?> </a> / <a href="#"> </a> <?php echo e(__('web.projects')); ?> </small></div>
      </div>
      <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i"><?php echo e(__('web.projects')); ?></h1>
          </div>
          
          <div class="inner-news paddingtop5px">
            <div class="sectin-cnt font-i2 font-text-ct default_text">
              <div class="row">
                  <div class=" col-md-6 col-sm-12 col-xs-12">
                      <img class="img img-responsive" src="<?php if($data): ?> <?php echo e(asset($data->image_url)); ?> <?php endif; ?>" alt="">
                  </div>
                  <div class=" col-md-6 col-sm-12 col-xs-12 sectin-cnt">
                      <h4 class=""> <?php if($data): ?> <?php echo e($data->title); ?> <?php endif; ?> </h4>
                      <div class="">
                        <?php if($data): ?> <?php echo $data->content; ?> <?php endif; ?>
                      </div>
                  </div>
              </div>
              <div class="sectin-cnt title_pro">
                <h4><?php echo e(__('web.detail-imformation')); ?></h4>
                <table class="table table-bordered">
                      <tbody>
                      <!-- <tr>
                        <td>Project Process</td><td>Upgrade</td>
                      </tr>
                      <tr>
                        <td>Construction Type </td><td> Contuction </td>
                      </tr>
                      <tr>
                        <td>Category </td><td> Contuction </td>
                      </tr> -->
                      <tr>
                        <td><?php echo e(__('web.province')); ?> </td><td> <?php if($data): ?> <?php echo e($data->province); ?> <?php endif; ?> </td>
                      </tr>
                      <tr>
                        <td><?php echo e(__('web.pk-location')); ?> </td><td> <?php if($data): ?> <?php echo e($data->location); ?> <?php endif; ?> </td>
                      </tr>
                      <tr>
                        <td><?php echo e(__('web.authority-in-charge')); ?> </td><td> <?php if($data): ?> <?php echo e($data->authority); ?> <?php endif; ?> </td>
                      </tr>
                      <tr>
                        <td><?php echo e(__('web.constructor')); ?></td><td> <?php if($data): ?> <?php echo e($data->constructor); ?> <?php endif; ?> </td>
                      </tr>
                      <tr>
                        <td><?php echo e(__('web.period')); ?></td><td> <?php if($data): ?> <?php echo e($data->period); ?> <?php endif; ?> </td>
                      </tr>
                      <!-- <tr>
                        <td>Note</td><td>  </td>
                      </tr> -->
                </tbody></table>
              </div>
            </div>
          </div>

          <?php if(isset($documents)): ?>
            <?php if(sizeof($documents)>0): ?>
            <div class="row sectin-cnt">
              <h4 class=""> <i class="fa fa-list-alt"></i><?php echo e(__('web.regulations')); ?></h4>
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
          <?php endif; ?>
      </div>
      <div class="clearfixed"></div>
      <!--Sidebar Side-->
      <div class="sidebar-side col-md-4 no-padd-t-b">
        
        <?php if(isset($defaultData['publicWorks'])): ?>
          <?php ($publicWorks = $defaultData['publicWorks']); ?>
          <?php if(count($publicWorks) > 0): ?>
            <aside class="sidebar">
              <div class="sidebar-widget">
                  <article class="">
                    <div class="page-header">
                        <h1 class="text-center font-i"><?php echo e(__('web.public-works')); ?> </h1>
                    </div>
                   
                    <div class="inner-news paddingtop5px">
                      <ul class="list-group font-i2">
                          <?php ($i = 0); ?>
                          <?php $__currentLoopData = $publicWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($i++); ?>
                            <li class="list-group-item <?php if( isset($subActive)  && $subActive == $row->slug): ?> sub-menu-active  <?php endif; ?>"  <?php if($i == 1): ?> style="border-top:0px" <?php endif; ?>><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>$row->slug])); ?>"> <i class=""></i> <?php echo e($row->title); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
           
            <div class="sectin-cnt">
              <div class="page-header">
                <h1 class="padding-left1 font-i"> <?php echo e(__('web.projects')); ?></h1>
              </div>
              <div class="inner-news paddingbottom5px">
                <div class="three-item-carousel owl-carousel owl-theme">
                  <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="news-block wow fadeInLeft animated animated">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image item01">
                                    <a href=""><img src="<?php echo e(asset ($row->image_url)); ?>" alt="" /></a>
                                </div>
                            </div>
                            <div class="content-boxproject">
                                <div class="upper-box">
                                   <a href=""><?php echo e($row->title); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>   
              </div>
            </div>
        </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

  </div>
  <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>