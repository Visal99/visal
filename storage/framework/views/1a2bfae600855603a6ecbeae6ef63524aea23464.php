<div class="sidebar-widget popular-posts">
    <div class="page-header">
        <h1 class="text-center font-i"><?php echo e(__('web.featured-post')); ?></h1>
    </div>
    <div class="inner-news">
    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
    <article class="post">
        <?php ( $img = asset('public/frontend/images/1Mthanks.jpg')); ?>
        <?php ( $featuredImage = $row->images()->select('img_url')->orderBy('data_order', 'ASC')->first() ); ?>
        <?php if($featuredImage): ?>
            <?php ( $img = asset($featuredImage->img_url) ); ?>
        <?php endif; ?>
        <figure class="post-thumb"><a href="<?php echo e(route('news-detail', ['locale'=>$locale, 'id'=>$row->id])); ?>"><img src="<?php echo e($img); ?>" alt=""></a></figure>
        <div class="text font-i2"><a href="<?php echo e(route('news-detail', ['locale'=>$locale, 'id'=>$row->id])); ?>"><?php echo e($row->title); ?> </a></div>
    </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </div>  
</div>
                    