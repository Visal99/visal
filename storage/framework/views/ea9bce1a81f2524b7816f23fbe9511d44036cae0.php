<?php $__env->startSection('title', __('general.laws-and-regulations').' | '.__('general.welcome')); ?>
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
                <div class="col-md-12">
                    <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.laws-and-regulations')); ?> <?php if(!empty($page_name)): ?>/ <?php echo e($page_name); ?> <?php endif; ?>  </small></div>
                </div>
                <div class="content-side col-md-8 col-sm-12 col-xs-12">
                    <div class="page-header">
                      <h1 class="padding-left1 font-i"><?php if(!empty($page_name)): ?> <?php echo e($page_name); ?> <?php endif; ?> </h1>
                    </div>
                    <!-- <div class="inner-news">
                      <h4 class=""><?php echo e(__('web.road-transportation')); ?></h4>
                      <br />
                      
                        <div class="contact-form">
                          
                              <div class="row ">
                                  <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                      <select id="type" class="">
                                        <option><?php echo e(__('web.select-type')); ?></option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                      <select id="category" class="">
                                        <option value="0"><?php echo e(__('web.select-categories')); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->id); ?>" ><?php echo e($row->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                      <input type="text" name="email" id="name" value="" placeholder="<?php echo e(__('web.title-of-document')); ?>" required="">
                                  </div>
                                  <div class="form-group col-md-2 col-sm-6 col-xs-12">
                                      <button id="btn-search" type="submit" class=" btn default-button blue-btn"><i class="fa fa-search"></i> <?php echo e(__('web.search')); ?></button>
                                  </div>

                                 

                              </div>
                         
                        </div>

                        <table class="table table-bordered">
                            <thead class="text-center">
                              <td><?php echo e(__('web.no')); ?> </td>
                              <td style="width:12%"><?php echo e(__('web.category')); ?> </td>
                              <td style="width:12%"><?php echo e(__('web.date')); ?> </td>
                              
                              <td><?php echo e(__('web.title')); ?> </td>
                              <td><?php echo e(__('web.download')); ?> </td>
                            </thead>
                            <tbody>
                              <?php if(sizeof($documents) > 0): ?>
                                <?php ($i = 1); ?>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($data->title); ?></td>
                                    <td><?php echo e($row->created_at->format('d-M-Y')); ?></td>
                                    <td><a href="#"><?php echo e($row->title); ?> </a></td>
                                    <td  class="text-center"><a target="_blank" href="<?php echo e(asset($row->pdf)); ?>"><i class="fa fa-download"></i> </a></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                              <span>No Data</span>
                              <?php endif; ?>
                            </tbody>
                        </table>
                    </div> -->
                    <div class="inner-news">
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                      <div class="<?php if($i++ ==1): ?> upper-box19 <?php else: ?> upper-box11 <?php endif; ?>">
                            <h3><i class="<?php if($i==1): ?>fa9 fa-angle-right9 <?php else: ?> fa fa-angle-right <?php endif; ?> " aria-hidden="true"></i><a target="_blank" href="<?php echo e($row->google_link); ?>"><?php echo e($row->title); ?></a></h3>

                            <div class="post-time22">
                              <span class="post-type11"><?php echo e(__('web.type')); ?>: <?php if(!empty($page_name)): ?> <?php echo e($page_name); ?> <?php endif; ?></span><?php echo e(Carbon\Carbon::parse($row->updated_at)->format('Y-M-d')); ?>

                            </div>
                      </div>
                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <?php echo e($documents->links('vendor.pagination.frontend-html')); ?>


                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-md-4 col-sm-8 col-xs-12">
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
                                <li class="list-group-item" <?php if($i++ == 0): ?> style="border-top:none;" <?php endif; ?> ><a href="<?php echo e(route('laws-and-regulations', ['locale'=>$locale, 'category'=>$row->slug])); ?>"> <i class=""></i> <?php echo e($row->title); ?> </a></li>
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