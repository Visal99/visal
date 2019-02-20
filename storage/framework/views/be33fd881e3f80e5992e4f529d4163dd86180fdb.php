<?php $__env->startSection('title', __('general.news').' | '.__('general.welcome')); ?>
<?php $__env->startSection('active-press', 'actives'); ?>

<?php $__env->startSection('appbottomjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .museum-block1{
            margin-bottom:20px;
        }
    </style>
	<!-- <div class="page_banner">
		<img src="<?php echo e(asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')); ?>">
	</div> -->
	<div class="container sidebar-page-container">
    	<div class="auto-container">
            <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.news')); ?> </small></div>
        	<div class="row clearfix">
            	
                <!--Content Side-->
                <div class="content-side col-md-8">

                    <div class="page-header">
                        <h1 class="font-i padding-left1"><?php echo e(__('general.news')); ?> <small>   </small></h1>
                    </div>
                    <div class="inner-news">
                    	<div class="blog-list">
                            <?php ($i = 1); ?>
                            <?php ($numOfPress = count($presses)); ?>
                            <?php $__currentLoopData = $presses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!--Blog Post-->
                			<div class="blog-post style-two">
                                <div class="row clearfix">
                                    <!--Image Column-->
                                    <div class="image-column col-md-4">
                                        <div class="image">
                                            <a href="<?php echo e(route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug])); ?>"><img src="<?php echo e(asset ($row->feature_image)); ?>" alt=""></a>
                                        </div>
                                    </div>
                                    <!--Content Column-->
                                    <div class="content-column col-md-8">
                                        <div class="inner">
                                            <div class="upper-box">
                                                <div style="color:#b3000b;" class="post-time"><span>
                                                    <?php echo e($row->updated_at->format('d')); ?></span> - <?php echo e($row->updated_at->format('M-Y')); ?></div>
                                                <a href="<?php echo e(route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug])); ?>" class="font-i2">
                                                    <?php echo e($row->title); ?>

                                                </a>
                                            </div>
                                            <div class="lower-box">
                                                <div class="text font-i2">
                                                    <?php ($description =str_limit($row->description,150)); ?>
                                                    <p><?php echo e($description); ?></p>
                                                </div>
                                                <div class="">
                                                  <a href="<?php echo e(route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug])); ?>"><span style="color: #003399;" class="view_more"><?php echo e(__('general.read-more')); ?><i style="color: #003399;" class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php ($i++); ?>
                            <?php if($i <= $numOfPress): ?> 
                                
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php echo e($presses->links('vendor.pagination.frontend-html')); ?>

                    </div>
                    
                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-4 col-sm-8 col-xs-12">
                	<aside class="sidebar">
                        <?php echo $__env->make('frontend.sidebar.public-works', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
    <?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>