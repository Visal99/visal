<article class="">
    <div class="page-header">
        <h1 class="text-center font-i"><?php echo e(__('general.public-works')); ?></h1>
    </div>
    <div class="inner-news paddingtop5px">
        <ul class="list-group font-i2">
            <?php ($public_works = $defaultData['public_works']); ?>
            <?php $__currentLoopData = $public_works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item" <?php if($row->id == 1): ?> style="border-top:0px solid;" <?php endif; ?>><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>$row->slug])); ?>"> <i class=""></i> <?php echo e($row->title); ?> </a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <!--  <li class="list-group-item"><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>'sewage-systems'])); ?>"> <i class=""></i> <?php echo e(__('general.sewage-systems')); ?> </a></li>
            <li class="list-group-item"><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>'road-infrastructure'])); ?>"> <i class=""></i><?php echo e(__('general.road-infrastructure')); ?> </a></li>
            <li class="list-group-item"><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>'public-works-technical'])); ?>"> <i class=""></i> <?php echo e(__('general.public-works-technical')); ?> </a></li>
            <li class="list-group-item"><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'category'=>'road-map'])); ?>"> <i class=""></i> <?php echo e(__('general.road-map')); ?> </a></li> -->
        </ul>
    </div>
</article>
