<?php $__env->startSection('title', $title.' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>

<?php if($data->image): ?>
    <?php $__env->startSection('image', asset ($data->image)); ?>
<?php endif; ?>

<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-public-services', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>


<?php if(sizeof($locations) > 0): ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
<script type="text/javascript">

  //=============================================>> Make Multi Map
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 11.574131, lng: 104.922841},
            styles: []
          });
        var data = [];

        <?php ($i = 1); ?>
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
            data.push(['<?php echo e($row->title); ?>', <?php echo e($row->lat); ?>, <?php echo e($row->lng); ?>, <?php echo e($i++); ?>, '<?php echo e($row->address); ?>','<?php echo e($row->url); ?>','<?php echo e($row->phone); ?>' ]);
         
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    $(document).ready(function(){
          setMarkers(data, '<?php echo e(asset('public/frontend/images/icons/marker2.png')); ?>');
    })
    function setMarkers(data, image_url) {

        var marker, i; 
        var image = {
            url: image_url,
            size: new google.maps.Size(27, 35),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(0, 32)
          };

      for (i = 0; i < data.length; i++){  

        var title = data[i][0];
        var lat = data[i][1];
        var long = data[i][2];
        var id =  data[i][3];
        var address =  data[i][4];
        var url =  data[i][5];
        var phone =  data[i][6];
        latlngset = new google.maps.LatLng(lat, long);

        var marker = new google.maps.Marker({  
            map: map, 
            icon:image,
            title: title , 
            position: latlngset  
        });

        map.setCenter(marker.getPosition())
       
        var content = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading">'+title+'</h4>'+
            '<a target="_blank" href="'+url+'"><p><?php echo e(__('general.address')); ?>:'+address+
            '<a href="tel:'+phone+' "> <p> <?php echo e(__('general.phone')); ?>:'+phone
            '</div>'+
            '</div>';
      
        var infowindow = new google.maps.InfoWindow(); 
        google.maps.event.addListener(marker,'click', (function(marker, content, infowindow){ 
                return function() {
                   infowindow.setContent(content);
                   infowindow.open(map, marker);
                };
            })(marker,content,infowindow)); 

      }
    }
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="container">
      <div class="breadcrumd"><small><a href="<?php echo e(route('home',$locale)); ?>"> <?php echo e(__('web.homepage')); ?></a> / <?php echo e(__('web.public-services')); ?> /  <?php echo e($title); ?>  </small></div>
    </section>
    <!--Main Information -->
    <section class="container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="image-column">
                    
                    <div class="page-header">
                        <h1 class="padding-left1 font-i"><?php echo e($title); ?></h1>
                    </div>

                    
                    <div class="col-md-12 inner-news">
                        <div class="col-md-5 no-p-d auto-border-left">
                            <div class="col-md-12 no-p-d">
                                <div class="image">
                                    <img src="<?php echo e(asset ($data->image)); ?>" class="w-full" alt="">
                                </div>
                            </div>
                            <?php if($data->video != ""): ?>
                            <div class="col-md-12 wrap-vdo-instr">
                                <div class="text-center" style="padding-top: 20px;padding-bottom: 0px;">
                                    <div class="text-center vdo-instr">
                                        <h4 class="padding-left1 font-i lauguagbold"><?php echo e(__('web.instruction-video')); ?></h4>
                                    </div>
                                    <div id="fb-root"></div>
                                    <script>
                                        (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
                                        fjs.parentNode.insertBefore(js, fjs);
                                      }(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-video" data-href="<?php echo e($data->video); ?>"> </div>
                                </div>
                                                           
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7">
                            <div class="sectin-cnt display-list">
                              <?php echo $data->content; ?> 
                            </div>
                        </div>
                        <div class="col-md-12 no-p-d display-list">
                           <?php echo $data->more; ?> 
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    
    <?php if($data->phone != "" || $data->email != "" || $data->working_hour != "" || $data->website != ""): ?>
    <!--Suppot -->
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('web.for-information-support')); ?></h1>
                </div>

                <div class="page-autoo">
                    <div class="row sectin-cnt">
                        <div class="list inff font-i2">
                            <div class="col-md-6" style="">
                              <?php if($data->phone != ""): ?> <a  href="#" class="clearfix"><i class="fa fa-phone"></i><?php echo e($data->phone); ?></a> <?php endif; ?>
                              <?php if($data->email != ""): ?> <a href="mailto:<?php echo e($data->email); ?>" class="clearfix"><i class="fa fa-envelope"></i> <?php echo e($data->email); ?></a> <?php endif; ?>
                            </div>
                            <div class="col-md-6" style="">
                                <?php if($data->working_hour != ""): ?> <a href="#" class="clearfix"><i class="fa fa-clock-o"></i><?php echo e($data->working_hour); ?></a> <?php endif; ?>
                                <?php if($data->website != ""): ?> <a href="<?php echo e($data->website); ?>" target="_blank" class="clearfix"><i class="fa fa-globe"></i><?php echo e($data->website); ?></a> <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!--Download App -->
    <?php if($data->playstore != "" || $data->appstore != ""): ?>
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('web.download-app')); ?></h1>
                </div>

                <div class="page-autoo">
                    <div class="row sectin-cnt">
                        <div class="list inff font-i2">
                            <div class="col-xs-12">
                                <div class="wrap-app99">
                                    <?php if($data->appstore != ""): ?><a target="_blank" href="<?php echo e($data->appstore); ?>"><img style="float:left;" src="<?php echo e(asset ('public/frontend/images/icons/appstore.png')); ?>" class="go-link img img-responsive margin_au"></a> <?php endif; ?>
                                    <?php if($data->playstore != ""): ?><a target="_blank" href="<?php echo e($data->playstore); ?>"><img style="float:right;" src="<?php echo e(asset ('public/frontend/images/icons/playsore.png')); ?>" class="go-link img img-responsive margin_au"></a> <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>

     <!-- Document -->
    <?php if(sizeof($documents) > 0): ?>
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="ddocument">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i"><?php echo e(__('web.official-documents')); ?></h1>
                    </div>
                    <div class="inner-news">
                        <div class="row content-box">
                            <?php ($i = 1); ?> 
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class=" <?php if($i==1): ?> col-lg-12 <?php else: ?> col-lg-12 <?php endif; ?> content-box">
                                <div class="<?php if($i++ == 1): ?> upper-box19 <?php else: ?> upper-box11 <?php endif; ?>">
                                    <div class="wrap-ct-doc">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        <h3>
                                            <a href="<?php echo e(asset($row->google_drive_url)); ?>"><?php echo e($row->title); ?></a>
                                            <div class="post-time22">
                                                <a href="<?php echo e(route('documents',['locale'=>$locale, 'category'=>$row->category->slug])); ?>"><span class="post-type11"><?php echo e($row->category->title); ?></span> </a>
                                                <?php if($row->event_date != ""): ?>
                                                <span class="date-format"><?php echo e($row->event_date); ?></span>
                                                <?php endif; ?>
                                            </div>
                                           
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="bd-b">
                            <a href="<?php echo e(route('documents-blank',['locale'=>$locale, 'type'=>'public-services', 'slug'=>$data->slug])); ?>"><span style="padding-bottom: 5px;"class="view_more"><?php echo e(__('web.view-more')); ?><i class=" fa fa-angle-right"aria-hidden="true"></i></span></a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if(sizeof($locations) > 0): ?>
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('web.location-services')); ?></h1>
                </div>
                <!-- Location -->
                <div class="sectin-cnt page-autoo">
                    
                      <div id="map" class="map" style="height:400px;"></div>
                      <hr />
                      <br />
                    
                    <?php if($data->frame != ""): ?>
                      <iframe width=100% height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo e($data->frame); ?>"></iframe>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if(sizeof($faqs) > 0): ?>
    <section class="container padd-t-b" id="my-faq">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('web.frequently-asked-question')); ?></h1>
                </div>
                <div class="page-autoo">
                    <div class="row faq-accordion fi-clear panel-group padd-10" id="faq-accordion">
                       

                        <div class="col-xs-12">
                          <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="panel panel-default">
                                <i class="fa fa-angle-down cl-fa-down"></i>
                                <div class="panel-heading active">
                                    <h4 class="default_text font-i2 panel-title">
                                      <a  class="accordion-toggle collapsed "
                                          data-toggle="collapse" 
                                          data-parent="#accordion" 
                                          href="#<?php echo e($row->id); ?>" 
                                          aria-expanded="false">
                                          <?php echo e($row->question); ?>


                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo e($row->id); ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body"><?php echo e($row->answer); ?></div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                   
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?> 


    <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>