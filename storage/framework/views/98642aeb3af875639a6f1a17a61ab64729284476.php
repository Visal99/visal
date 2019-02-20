 
<?php $__env->startSection('title', __('general.citizen-service').' | '.__('general.welcome')); ?> 
<?php $__env->startSection('active-automation', 'actives'); ?>
<?php $__env->startSection('appbottomjs'); ?>


<style type="text/css">
    .pop>tbody>tr>td,
    .pop>thead>tr>th {
        padding: 4px !important;
        height: 0px;
        font-size: 13px;
    }
    
    .pop>tbody>tr>td>i {
        cursor: pointer;
    }
    
    #map {
        width: 100%;
        height: 700px;
    }
    
    .list-group-item:first-child {
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    
    .list-group-item:last-child {
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    
    .list-group-item-success {
        color: #ffffff;
        background-color: #3fc8f4;
    }
    
    .list-group-item-success a {
        color: white;
    }
    .display-list ul,ol{
        padding-left: 25px;
    }
    .display-list> ul> li{
        list-style: aqua !important;
    }
    .display-list ul li{
        list-style-type: square;
    }
</style>

<script src="<?php echo e(asset ('public/frontend/js/custom-map.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset ('public/user/js/lib/blockUI/jquery.blockUI.js')); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw">
</script>

<script type="text/javascript">
  $(function() {
    
    $(".bars li .bar").each( function( key, bar ) {
      var percentage = $(this).data('percentage');
      
      $(this).animate({
        'height' : percentage + '%'
      }, 1000);
    });

  });
  //=============================================>> Make Multi Map
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 11.574131, lng: 104.922841},
            styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"1.00"}]},{"featureType":"administrative.locality","elementType":"labels","stylers":[{"color":"#dd0022"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"color":"#003399"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"visibility":"simplified"},{"lightness":"65"},{"saturation":"-100"},{"hue":"#ff0000"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"80"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#888"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#eeeeee"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#ba5858"},{"saturation":"-100"}]},{"featureType":"transit.station","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#ba5858"},{"visibility":"simplified"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"hue":"#ff0036"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#888"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#003399"}]}]
        
          });
        var data = [];

        <?php ($i = 1); ?>
        <?php $__currentLoopData = $maps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
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
            '<a href="tel:+'+phone+' "> <p> <?php echo e(__('general.phone')); ?>:'+phone
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

<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>

<div class="">
    <!-- Main Information -->
    <section class="container">
       
        <div class="breadcrumd"><small><?php echo e(__('general.home')); ?> / <?php echo e(__('general.public-service')); ?> <?php if(!empty($data)): ?>/ <?php echo e($data->title); ?> <?php endif; ?>  </small></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="image-column">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i"><?php if(!empty($data)): ?> <?php echo e($data->title); ?> <?php endif; ?> </h1>
                    </div>

                    <div class="">
                        <div class="col-md-12 inner-news">
                            <div class="col-md-5 no-p-d auto-border-left">
                                <div class="col-md-12 no-p-d">
                                    <div class="image">
                                        <img src="<?php echo e(asset ($data->image)); ?>" class="w-full" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                    <?php if(sizeof($data->videos()->select($locale.'_title as title','image','video_id')->where('published',1)->orderBy('id','DESC')->get()) > 0): ?>
                                    <div class="text-center" style="padding-top: 15px;padding-bottom: 15px;">
                                        <h4 class="padding-left1 font-i lauguagbold"><?php echo e(__('general.instruction-video')); ?></h4>
                                    </div>
                                    <div class="image ">
                                        <!-- Videos -->
                                        

                                        <div class="filter-list">
                                            <!--Default Portfolio Item-->
                                            <div class="default-portfolio-item mix all art modern ">
                                                <?php $__currentLoopData = $data->videos()->select($locale.'_title as title','image','video_id')->where('published',1)->orderBy('id','DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="inner-box">
                                                    <figure class="image-box"><img src="<?php echo e(asset ($row->image)); ?>" alt=""></figure>
                                                    <!--Overlay Box-->
                                                    <div class="overlay-box">
                                                        <div class="overlay-inner">
                                                            <div class="content">
                                                                <a href="<?php echo e($row->video_id); ?>&autoplay=1" class="video lightbox-image image-link" data-fancybox-group="example-gallery" title="Ministry of Public Works and Transport's 2016 Year-end Forum"><span class="fa fa-youtube-play"></span></a>

                                                                <h3><a href=""><?php echo e($row->title); ?></a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <?php else: ?> <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="sectin-cnt intt default_text">
                                    <div class="text-center" style="padding-bottom: 5px;">
                                        <h4 class="padding-left1 font-i"><?php echo e($data->title); ?></h4>
                                    </div>
                                    <p class="cl-justify display-list">
                                        <?php if(!empty($data)): ?> <?php echo $data->description; ?> <?php endif; ?>
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-12 no-p-d display-list">
                                <?php if(!empty($data)): ?> <?php echo $data->more; ?> <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
           
    </section>

    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('general.for-information-support')); ?></h1>
                </div>

                <div class="page-autoo">
                    <div class="row sectin-cnt">
                        <div class="list inff font-i2">
                            <div class="col-md-6" style="">
                                <li><a href="#" class="clearfix"><i class="fa fa-phone"></i> (+855) (085,015,067) 92 90 90</a></li>
                                <li><a href="#" class="clearfix"><i class="fa fa-envelope"></i>info@mpwt.gov.kh</a></li>
                            </div>
                            <div class="col-md-6" style="">
                                <li><a href="#" class="clearfix"><i class="fa fa-clock-o"></i>Morning 8:00 am -12:00 pm-Afternoon 2:00 pm -5:00 pm</a></li>
                                <?php if( $data->id == 3 || $data->id == 5 || $data->id == 6 ): ?>

                                <?php else: ?>
                                <li><a href="#my-faq" class="clearfix"><i class="fa fa-question-circle"></i>FAQ</a></li>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php if( $data->id == 3 || $data->id == 5 || $data->id == 6 ): ?>
                                
    <?php else: ?>

        <?php ($faqs = $data->faqs()->where('published',1)->select($locale.'_title as title',$locale.'_description as description','id')->get()); ?>
        <?php if(sizeof($faqs) > 0): ?>
        <section class="container padd-t-b" id="my-faq">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i"><?php echo e(__('general.frequently-asked-question')); ?></h1>
                    </div>
                    <div class="page-autoo">

                        <hr> 
                        <div class="row faq-accordion fi-clear panel-group padd-10" id="faq-accordion">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php ( $i = 0 ); ?>
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php ($i++); ?>
                              <?php if( $i%2 == 0): ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading active">
                                        <h4 class="default_text font-i2 panel-title">
                                          <a  class="accordion-toggle collapsed "
                                              data-toggle="collapse" 
                                              data-parent="#accordion" 
                                              href="#<?php echo e($row->id); ?>" 
                                              aria-expanded="false">
                                              <?php echo e($row->title); ?><i class="fa fa-angle-down cl-fa-down"></i>

                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo e($row->id); ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body"><?php echo e($row->description); ?></div>
                                    </div>
                                </div>

                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php ($i++); ?>
                              <?php if( $i%2 == 1): ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading active">
                                        <h4 class="default_text font-i2 panel-title">
                                          <a  class="accordion-toggle collapsed "
                                              data-toggle="collapse" 
                                              data-parent="#accordion" 
                                              href="#<?php echo e($row->id); ?>" 
                                              aria-expanded="false">
                                              <?php echo e($row->title); ?><i class="fa fa-angle-down cl-fa-down"></i>

                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo e($row->id); ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body"><?php echo e($row->description); ?></div>
                                    </div>
                                </div>

                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                       
                    </div>

                </div>
            </div>
        </section>
        <?php endif; ?> 
    <?php endif; ?>
    <?php if(sizeof($documents) > 0): ?>
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="ddocument">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i"><?php echo e(__('general.official-document')); ?></h1>
                    </div>
                    <div class="inner-news">
                        <div class="content-box">
                            <?php ($i = 1); ?> <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php if($i++ == 1): ?> upper-box18 <?php else: ?> upper-box14 <?php endif; ?>">
                                <h3><i class="fa fa-angle-right" aria-hidden="true"></i><a href="<?php echo e(asset($row->pdf)); ?>"><?php echo e($row->title); ?></a></h3>

                                <div class="post-time22">
                                    <span class="post-type11"><?php echo e(__('web.type')); ?>: <?php echo e($row->type); ?></span><?php echo e(Carbon\Carbon::parse($row->updated_at)->format('Y-M-d')); ?>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="bd-b">
                                <a href="<?php echo e(route('official-document',$locale)); ?>"><span style="padding-bottom: 5px;"class="view_more"><?php echo e(__('general.view-more')); ?><i class=" fa fa-angle-right"aria-hidden="true"></i></span></a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="container">
        <div class="linkss">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="">
                        <h1 style="text-align: center;"><span class="app-d font-i"><?php echo e(__('general.download-app-for')); ?> iOS / Android</span></h1>
                        <div class="wrap-app99">
                            <a target="_blank" href="<?php if(!empty($data)): ?> <?php echo e(url($data->ios_link)); ?> <?php endif; ?>"><img style="float:left;" src="<?php echo e(asset ('public/frontend/images/mpwt/app/ios.png')); ?>" class="go-link img img-responsive margin_au"></a>
                            <a target="_blank" href="<?php if(!empty($data)): ?> <?php echo e(url($data->android_link)); ?> <?php endif; ?>"><img style="float:right;" src="<?php echo e(asset ('public/frontend/images/mpwt/app/andriod.png')); ?>" class="go-link img img-responsive margin_au"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <?php if(!empty($data->link)): ?>
                    <div class="">
                        <h1 style="text-align: center;"><span class="app-d font-i"><?php if(!empty($data)): ?> <?php echo e($data->title); ?> <?php endif; ?></span></h1>
                        <div class="wrap-app99">
                            <a target="_blank" href="<?php if(!empty($data)): ?> <?php echo e(url($data->link)); ?> <?php endif; ?>">
                                <div class="cl-go-link"><?php if(!empty($data)): ?> <?php echo e($data->link); ?> <?php endif; ?></div>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php if(sizeof($maps) > 0): ?>
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i"><?php echo e(__('general.location-services')); ?></h1>
                </div>
                <!-- Location -->
                <div class="sectin-cnt page-autoo">
                    <?php if(sizeof($maps) > 0): ?>
                      <div id="map" class="map" style="height:400px;"></div>
                      <hr />
                      <br />
                    <?php endif; ?>
                    <?php if($data->frame != ""): ?>
                    
                      <iframe width=100% height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo e($data->frame); ?>"></iframe>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</div>
<?php echo $__env->make('frontend.layouts.citizi-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>