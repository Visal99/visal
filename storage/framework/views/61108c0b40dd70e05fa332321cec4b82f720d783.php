 <ul class="list-group font-i2">
      <li class="list-group-item <?php if( isset($subActive)  && $subActive == 'mission-and-vision'): ?> sub-menu-active  <?php endif; ?>" style="border-top:0px"><a href="<?php echo e(route('mission-and-vision', $locale)); ?>"> <i class=""></i> <?php echo e(__('web.mission-and-vision')); ?></a></li>
      <li class="list-group-item <?php if( isset($subActive)  && $subActive == 'the-senior-minister'): ?> sub-menu-active <?php endif; ?>" > <a href="<?php echo e(route('the-senior-minister', $locale)); ?>"> <i class=""></i> <?php echo e(__('web.the-senior-minister')); ?></a></li>
      <li class="list-group-item <?php if( isset($subActive)  && $subActive == 'message-from-minister'): ?> sub-menu-active <?php endif; ?>" ><a href="<?php echo e(route('message-from-minister', $locale)); ?>"> <i class=""></i> <?php echo e(__('web.message-from-minister')); ?></a></li>
      <li class="list-group-item <?php if( isset($subActive)  && $subActive == 'organization-chart' ): ?> sub-menu-active <?php endif; ?>"   ><a href="<?php echo e(route('organization-chart', $locale)); ?>"> <i class=""></i> <?php echo e(__('web.organization-chart')); ?></a></li>
  </ul>