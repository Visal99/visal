<div class="sidebar-widget popular-posts">
    <div class="page-header">
        <h1 class="text-center font-i"><?php echo e(__('general.related-article')); ?></h1>
    </div>
    <?php ($related_press = $defaultData['related_press']); ?>
    
    <div class="inner-news">
    <?php $__currentLoopData = $related_press; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <?php ($category = 'public'); ?>
    <article class="post">
        <figure class="post-thumb"><a href="<?php echo e(route('press-view', ['locale'=>$locale, 'category'=>$row->category, 'slug'=>$row->slug])); ?>"><img src="<?php echo e(asset ($row->image)); ?>" alt=""></a></figure>
        <div class="text font-i2"><a href="<?php echo e(route('press-view', ['locale'=>$locale, 'category'=>$row->category, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?> </a></div>
        <div class="post-info"><?php echo e(Carbon\Carbon::parse($row->updated_at)->format('Y-M-d')); ?></div>
    </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </div>  
</div>
                    