<?php $__env->startSection('title', $data->title.' | MPWT'); ?>
<?php $__env->startSection('description', $defaultData['seo']['description']); ?>
<?php $__env->startSection('image', $defaultData['seo']['image']); ?>
<?php $__env->startSection('active-contact-us', 'active'); ?>

<?php $__env->startSection('appbottomjs'); ?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- <script src="<?php echo e(asset ('public/frontend/js/custom-map.js')); ?>"></script> -->

<script type="text/javascript">
  $(function() {
    
    $(".bars li .bar").each( function( key, bar ) {
      var percentage = $(this).data('percentage');
      
      $(this).animate({
        'height' : percentage + '%'
      }, 1000);
    });

    //Load the map
    init(<?php if(!empty($data)): ?> <?=$data->lat?> <?php endif; ?>, <?php if(!empty($data)): ?> <?=$data->lng?> <?php endif; ?>);
    
  });
 function init(lat, long) {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(lat, long),
            scrollwheel: false,
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        map.setOptions({ minZoom: 5, maxZoom: 15 });


        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" style="font-size: 14px;" class="firstHeading"><?php if(!empty($data)): ?> <?=$data->title?> <?php endif; ?></h4>'+
            '<a style="font-size: 8px;" target="_blank" href="<?php if(!empty($data)): ?> <?=$data->url?> <?php endif; ?>"><p style="font-size: 8px;">Address:<a style="font-size: 8px;" target="_blank" href="<?php if(!empty($data)): ?> <?=$data->google_link?> <?php endif; ?>">  <?php if(!empty($data)): ?> <?=$data->address?> <?php endif; ?>'+
            '<br><a href="tel:+<?php if(!empty($data)): ?> <?=$data->phone?> <?php endif; ?>" style="font-size: 8px;">Phone: <?php if(!empty($data)): ?> <?=$data->phone?> <?php endif; ?>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            map: map,
            title: 'MPWT'
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
          });
    }
</script>

 <script>
    $(document).ready(function() {
      $("#contact-form").submit(function(event){
        name = $("#name").val();
        organization = $("#organization").val();
        position = $("#position").val();
        phone = $("#phone").val();
        subject = $("#subject").val();
        email = $("#email").val();

        message = $("#message").val();
        g=$('#g-recaptcha-response').val();
        
        if(name != ""){
          if(organization != ""){
            if(position != ""){
              if(phone != ""){
                if(subject != ""){
                  if(email != ""){
                    if(isEmail(email)){
                      if(message != ""){
                        if(g != ""){
                          //alert('Go!');
                        }else{
                          error(event, "g-recaptcha-response", '<?php echo e(__('web.errorrecaptcha')); ?>');
                        }
                      }else{
                        error(event, "message", '<?php echo e(__('web.errormessage')); ?>');
                      }
                    }else{
                      error(event, "email", '<?php echo e(__('web.incorrectemail')); ?>');
                    }
                  }else{
                    error(event, "email", '<?php echo e(__('web.erroremail')); ?>.');
                  }
                }else{
                  error(event, "subject", '<?php echo e(__('web.errorsubject')); ?>');
                }
              }else{
                error(event, "phone", '<?php echo e(__('web.errorphone')); ?>');
              }
            }else{
              error(event, "position", '<?php echo e(__('web.errorposition')); ?>');
            }
          }else{
            error(event, "organization", '<?php echo e(__('web.errororganization')); ?>');
          }
        }else{
          error(event, "name", '<?php echo e(__('web.errorname')); ?>');
        }
      })

      <?php if(Session::has('msg')): ?>
        toastr.success("<?php echo e(__('web.contact-successful-sent')); ?>");
      <?php endif; ?>
      <?php if(count($errors) > 0): ?>
        toastr.warning("<?php echo e(__('web.error-sent')); ?>");
      <?php endif; ?>

    });
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    function error(event, obj, msg){
      event.preventDefault();
      toastr.error(msg);
      $("#"+obj).focus();
    }
   
  </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
  <div class="container">
    <div class="row">
      
      <div class="col-md-12">
        <div class="breadcrumd"><small><a href="<?php echo e(route('home', $locale)); ?>"> <?php echo e(__('web.homepage')); ?></a> / <a href="#"> <?php echo e(__('web.contact-us')); ?> </a> <?php if($title != ""): ?> / <a href="#"> <?php echo e($title); ?> </a> <?php endif; ?> </small></div>
      </div>

      <div class="col-md-8">
        <div class="page-header">
          <h1 class="padding-left1 font-i"><?php echo e($data->title); ?></h1>
        </div>
        <div class="inner-news">
            <div class="sectin-cnt ">
              <div class="container-fluid">
                <div class="row">
                  <div class="content-column col-md-5 col-sm-12 col-xs-12">
                      <ul class="">
                          <?php if($data->website != ""): ?><li><a href="<?php echo e($data->website); ?>" class="clearfix"><i class="fa fa-globe"></i>&nbsp;  <?php echo e($data->website); ?></a></li><?php endif; ?>
                          <?php if($data->phone != ""): ?> <li><a href="#" class="clearfix"><i class="fa fa-phone"></i>&nbsp; <?php echo e($data->phone); ?></a></li><?php endif; ?>
                          <?php if($data->email != ""): ?><li><a href="#" class="clearfix"><i class="fa fa-envelope"></i>&nbsp; <?php echo e($data->email); ?></a></li><?php endif; ?>
                          <?php if($data->address != ""): ?> <li><a href="#" class="clearfix"><i class="fa fa-map-marker"></i>&nbsp; <?php echo e($data->address); ?></a></li><?php endif; ?>
                      </ul>
                  </div>
                  <div class="image-column col-md-7 col-sm-12 col-xs-12">
                    <div id="map" class="map" style="height:200px;"></div>  
                  </div> 
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <br />
                    <h4><?php echo e(__('web.send-message')); ?></h4>
                    <?php if(count($errors) > 0): ?>
                      <div class="form-group row">
                        <label style="color:red;" for="message" class="col-sm-2 col-form-label"> <?php echo e(__('web.error')); ?> </label>
                        <div class="col-sm-12">
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="alert-group">
                            <div style="color:red;" class="alert alert-warning"><i style="color:red;" class="fa fa-exclamation-triangle"></i> <?php echo e($error); ?>!</div>
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if(Session::has('msg')): ?>
                      
                      <div class="form-group row">
                          <div class="col-sm-12">
                            <div class="alert-group">
                              <div class="alert alert-success"><i class="fa fa-check"></i> <?php echo e(__('web.contact-successful-sent')); ?>!</div>
                            </div>
                          </div>
                      </div>
                    <?php endif; ?>
                    <?php if(count($errors) > 0): ?>
                     <div class="form-group row">
                          <div class="col-sm-12">
                            <div class="alert-group">
                              <div class="alert alert-danger"><i  class="fa fa-exclamation-triangle"></i> <?php echo e(__('web.error-sent')); ?>!</div>
                            </div>
                          </div>
                      </div>
                    <?php endif; ?>


                    <div class="contact-form">
                        <form method="POST" id="contact-form" action="<?php echo e(route('send-message', ['locale'=>$locale])); ?>"  novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>


                            <div class="row clearfix">
                                <input type="hidden" name="contact_id" value="<?php if(!empty($data)): ?> <?=$data->id?> <?php endif; ?>">
                                <input type="hidden" name="slug" value="<?php if(!empty($data)): ?> <?=$data->slug?> <?php endif; ?>">
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <input type="text" name="name" id="name" value="" placeholder="<?php echo e(__('web.your-name')); ?>" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="organization" id="organization" value="" placeholder="<?php echo e(__('web.your-organization')); ?>" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="position" id="position" value="" placeholder="<?php echo e(__('web.position')); ?>" required="">
                                </div>

                                 <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="phone" id="phone" value="" placeholder="<?php echo e(__('web.your-phone')); ?>" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="email" name="email" id="email" value="" placeholder="<?php echo e(__('web.your-email')); ?>" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="subject" id="subject" value="" placeholder="<?php echo e(__('web.your-subject')); ?>" required="">
                                </div>

                                <div class="column col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" placeholder="<?php echo e(__('web.message')); ?>"></textarea>
                                    </div>
                                </div>
                                <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                   <div class="g-recaptcha" data-sitekey="6LcCNHYUAAAAAHDfaydBQmQqdLHsNKgNkOPIf-uA"></div>
                                </div>
                                <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                    <br />
                                    <div class="form-group">
                                        <button type="submit" class=" btn default-button blue-btn"><i class="fa fa-send"></i> <?php echo e(__('web.submit')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="clearfixed"></div>
      
      <!--Sidebar Side-->
      <div class="sidebar-side col-md-4 no-padd-t-b">
        <?php if(count($children) > 0): ?>
          <aside class="sidebar">
            <div class="sidebar-widget">
                <article class="">
                  <div class="page-header">
                      <h1 class="text-center font-i"><?php echo e(__('web.other-departments')); ?></h1>
                  </div>
                 
                  <div class="inner-news paddingtop5px">
                    <ul class="list-group font-i2">
                       <?php ($i = 0); ?>
                        <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li  class="list-group-item <?php if( isset($subActive)  && $subActive == $row->slug): ?> sub-menu-active  <?php endif; ?>" <?php if($i == 0): ?> style="border-top:0px"  <?php endif; ?> <?php ( $i = 1 ); ?>>
                          <a href="<?php echo e(route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                </article>
            </div>
          </aside>
        <?php elseif(count($siblings) > 0): ?>

          <aside class="sidebar">
            <div class="sidebar-widget">
                <article class="">
                  <div class="page-header">
                      <h1 class="text-center font-i"><?php echo e($parent->title); ?></h1>
                  </div>
                 
                  <div class="inner-news paddingtop5px">
                    <ul class="list-group font-i2">
                       <?php ($i = 0); ?>
                        <?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li  class="list-group-item <?php if( isset($subActive)  && $subActive == $row->slug): ?> sub-menu-active  <?php endif; ?>" <?php if($i == 0): ?> style="border-top:0px"  <?php endif; ?> <?php ( $i = 1 ); ?>>
                          <a href="<?php echo e(route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                </article>
            </div>
          </aside>

        <?php else: ?>
           <?php if(isset($defaultData['contacts'])): ?>
            <?php ($contacts = $defaultData['contacts']); ?>
            <?php if(count($contacts) > 0): ?>
              <aside class="sidebar">
                <div class="sidebar-widget">
                    <article class="">
                      <div class="page-header">
                          <h1 class="text-center font-i"><?php echo e(__('web.list-departments')); ?></h1>
                      </div>
                     
                      <div class="inner-news paddingtop5px">
                        <ul class="list-group font-i2">
                           <?php ($i = 0); ?>
                            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li  class="list-group-item <?php if( isset($subActive)  && $subActive == $row->slug): ?> sub-menu-active  <?php endif; ?>" <?php if($i == 0): ?> style="border-top:0px"  <?php endif; ?> <?php ( $i = 1 ); ?>>
                              <a href="<?php echo e(route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])); ?>"><?php echo e($row->title); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                    </article>
                </div>
              </aside>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>

         
      </div>

    </div>
  </div>
  <?php echo $__env->make('frontend.layouts.automation-system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>