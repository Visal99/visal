 <div class="navbar-collapse collapse clearfix">
    <ul class="navigation clearfix">
        <li class="<?php echo $__env->yieldContent('active-home'); ?>"><a href="<?php echo e(route('home', $locale)); ?>"><?php echo e(__('web.homepage')); ?></a></li>
        <li class="dropdown <?php echo $__env->yieldContent('active-about-us'); ?>"><a href="#"><?php echo e(__('web.about-ministry')); ?></a>
            <ul class="padding_ul">
                <li <?php if( isset($subActive) && $subActive == 'mission-and-vision'): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('mission-and-vision', $locale)); ?>"><?php echo e(__('web.mission-and-vision')); ?></a></li>
                <li <?php if( isset($subActive) && $subActive == 'the-senior-minister'): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('the-senior-minister', $locale)); ?>"><?php echo e(__('web.the-senior-minister')); ?></a></li>
                <li <?php if( isset($subActive) && $subActive == 'message-from-minister'): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('message-from-minister', $locale)); ?>"><?php echo e(__('web.message-from-minister')); ?></a></li>
                <li <?php if( isset($subActive) && $subActive == 'organization-chart'): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('organization-chart', $locale)); ?>"><?php echo e(__('web.organization-chart')); ?></a></li>
            </ul>
        </li>

        <?php if(isset($defaultData['publicServices'])): ?>
            <?php ($publicServices = $defaultData['publicServices']); ?>
            <?php if(count($publicServices) > 0): ?>
                <li class="dropdown <?php echo $__env->yieldContent('active-public-services'); ?>"><a href="#"><?php echo e(__('web.public-services')); ?></a>
                    <ul class="padding_ul">
                        <?php $__currentLoopData = $publicServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if( isset($subActive) && $subActive == $row->slug): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('public-services', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($defaultData['publicWorks'])): ?>
            <?php ($publicWorks = $defaultData['publicWorks']); ?>
            <?php if(count($publicWorks) > 0): ?>
                <li class="dropdown <?php echo $__env->yieldContent('active-public-works'); ?>"><a href="#"><?php echo e(__('web.public-works')); ?></a>
                    <ul class="padding_ul">
                        <?php $__currentLoopData = $publicWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if( isset($subActive) && $subActive == $row->slug): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('public-works', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>

         <?php if(isset($defaultData['documentCategories'])): ?>
            <?php ($documentCategories = $defaultData['documentCategories']); ?>
            <?php if(count($documentCategories) > 0): ?>
                <li class="dropdown <?php echo $__env->yieldContent('active-documents'); ?>"><a href="#"><?php echo e(__('web.official-documents')); ?></a>
                    <ul class="padding_ul">
                        
                        <?php for( $i =0; $i < sizeOf($documentCategories); $i++): ?>
                            <?php if(isset($documentCategories[$i]['children'])): ?>
                                <li class="dropdown">
                                    <a href="<?php echo e(route('documents', ['locale'=>$locale, 'category'=>'' ])); ?>"><?php echo e($documentCategories[$i]['parent']->title); ?></a>
                                    <ul class="padding_ul">
                                        <?php $__currentLoopData = $documentCategories[$i]['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('documents', ['locale'=>$locale, 'category'=>$row->slug ])); ?>"> <?php echo e($row->title); ?> </a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li <?php if( isset($subActive) && $subActive == $documentCategories[$i]['parent']->slug): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('documents', ['locale'=>$locale, 'category'=>$documentCategories[$i]['parent']->slug])); ?>"><?php echo e($documentCategories[$i]['parent']->title); ?></a></li>
                            <?php endif; ?>

                        
                        <?php endfor; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>


        <?php if(isset($defaultData['contacts'])): ?>
            <?php ($contacts = $defaultData['contacts']); ?>
            <?php if(count($contacts) > 0): ?>
                <li class="dropdown <?php echo $__env->yieldContent('active-contact-us'); ?>"><a href="#"><?php echo e(__('web.contact-us')); ?></a>
                    <ul class="padding_ul">
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <li <?php if( isset($subActive) && $subActive == $row->slug ): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('contact-us', ['locale'=>$locale, 'category'=>$row->slug])); ?>"><?php echo e($row->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>

       <!--  
       <?php if(isset($defaultData['newsCategories'])): ?>
            <?php ($newsCategories = $defaultData['newsCategories']); ?>
            <?php if(count($newsCategories) > 0): ?>
                <li class="dropdown <?php echo $__env->yieldContent('active-news'); ?>"><a href="#"><?php echo e(__('web.news')); ?></a>
                    <ul class="padding_ul">
                        <?php for( $i =0; $i < sizeOf($newsCategories); $i++): ?>
                            <?php if(isset($newsCategories[$i]['children'])): ?>
                                <li class="dropdown">
                                    <a href="#"><?php echo e($newsCategories[$i]['parent']->title); ?></a>
                                    <ul class="padding_ul">
                                        <?php $__currentLoopData = $newsCategories[$i]['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li <?php if( isset($subActive) && $subActive == $row->slug ): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>$row->slug ])); ?>"> <?php echo e($row->title); ?> </a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li <?php if( isset($subActive) && $subActive == $newsCategories[$i]['parent']->slug ): ?> class="sub-menu-active" <?php endif; ?> ><a href="<?php echo e(route('news', ['locale'=>$locale, 'category'=>$newsCategories[$i]['parent']->slug])); ?>"><?php echo e($newsCategories[$i]['parent']->title); ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        -->

        <li class="<?php echo $__env->yieldContent('active-post'); ?>"><a href="<?php echo e(route('posts', $locale)); ?>"><?php echo e(__('web.news')); ?></a></li>

        <li class="language visible-lg" style="padding-left:5px;">
            <span style="float:left;padding-top:2px;">
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['enRouteParamenters'])); ?>">
                    <img src="<?php echo e(asset('public/frontend/images/en.png')); ?>" class="img img-responsive margin_au">
                </a>
            </span>
            <span style="float:right;color:#fff;margin-left:3px;">
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['enRouteParamenters'])); ?>">EN</a>
            </span>
        </li>
        <li class="language visible-lg" style="">
            <span style="float:left;padding-top:2px;">
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['khRouteParamenters'])); ?>">
                    <img src="<?php echo e(asset('public/frontend/images/kh.png')); ?>" class="img img-responsive margin_au">
                </a>
            </span> 
            <span style="float:right;color:#fff;margin-left:3px;">
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['khRouteParamenters'])); ?>" class="kh_font">ខ្មែរ</a>
            </span>
        </li>

        <li class="language visible-md visible-sm visible-xs">
            <span>
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['khRouteParamenters'])); ?>" style="padding: 7px;">
                    <img src="<?php echo e(asset('public/frontend/images/kh.png')); ?>" class="font_margin margin_au">
                </a>
                <a href="<?php echo e(route($defaultData['routeName'], $defaultData['enRouteParamenters'])); ?>" style="padding: 5px;">
                    <img src="<?php echo e(asset('public/frontend/images/en.png')); ?>" class="font_margin margin_au">
                </a>
            </span>
        </li>
    </ul>
</div>