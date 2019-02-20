<?php $__env->startSection('title', __('general.official-document').' | '.__('general.welcome')); ?>
<?php $__env->startSection('active-law', 'actives'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<script type="text/javascript">
    $(document).ready(function() {
      $("#btn-search").click(function(){
        search();
      })
    });
    function search(){
      name  = $('#name').val();
      category  = $('#category').val();
      type  = $('#type').val();
      limit   = 10;

      url="?limit="+limit;
      if(name!=""){
        url+='&name='+name;
      }
      if(category!=""){
        url+='&category='+category;
      }
      if(type!=""){
        url+='&type='+type;
      }
      
      $(location).attr('href', '<?php echo e(route('search-laws-and-regulations', ['locale'=>$locale])); ?>'+url);
    }
  </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
   
  <!-- <div class="page_banner">
    <img src="<?php echo e(asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')); ?>">
  </div> -->

  <div class="sidebar-page-container">
      <div class="container">
          <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.official-document')); ?>  </small></div>
                    <div class="page-header">
                      <h1 class="padding-left1 font-i"><?php echo e(__('general.official-document')); ?> </h1>
                    </div>
                   
                    <div class="inner-news">
                      <?php ($i = 1); ?>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                      <div class="<?php if($i++ ==1): ?> upper-box19 <?php else: ?> upper-box11 <?php endif; ?>">
                            <h3><i class="<?php if($i==1): ?>fa9 fa-angle-right9 <?php else: ?> fa fa-angle-right <?php endif; ?> " aria-hidden="true"></i><a target="_blank" href="<?php echo e($row->google_link); ?>"><?php echo e($row->title); ?></a></h3>

                            <div class="post-time22">
                              <span class="post-type11"><?php echo e(__('web.type')); ?>: <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($row->type_id == $type->id): ?> <?php echo e($type->title); ?> <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span><?php echo e(Carbon\Carbon::parse($row->updated_at)->format('Y-M-d')); ?>

                            </div>
                      </div>
                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="text-center">
                    <?php echo e($documents->links('vendor.pagination.frontend-html')); ?>

                  </div>

                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-4 col-sm-8 col-xs-12 padd-t-b">
                  <aside class="sidebar">

                     <article class="">
                        <div class="page-header">
                            <h1 class="text-center font-i"><?php echo e(__('general.laws-and-regulations')); ?> </h1>
                        </div>
                        <div class="inner-news paddingtop5px">
                            <ul class="list-group font-i2">
                                <?php ($document_categories = $defaultData['document_categories']); ?>
                                <?php ($i = 0); ?>
                                <?php $__currentLoopData = $document_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item" <?php if($i++ == 0): ?> style="border-top:none;" <?php endif; ?> ><a href="<?php echo e(route('laws-and-regulations', ['locale'=>$locale, 'category'=>$row->slug])); ?>}"> <i class=""></i> <?php echo e($row->title); ?> </a></li>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </article>
                  </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
  <?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>