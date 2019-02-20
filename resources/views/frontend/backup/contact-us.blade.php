@extends('frontend/layouts.master')

@section('title', __('general.contact-us').' | '.__('general.welcome'))
@section('active-contact', 'actives')

@section ('appbottomjs')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- <script src="{{ asset ('public/frontend/js/custom-map.js')}}"></script> -->

<script type="text/javascript">
  $(function() {
    
    $(".bars li .bar").each( function( key, bar ) {
      var percentage = $(this).data('percentage');
      
      $(this).animate({
        'height' : percentage + '%'
      }, 1000);
    });

    //Load the map
    init(@if(!empty($data)) <?=$data->lat?> @endif, @if(!empty($data)) <?=$data->lon?> @endif);
    
  });
 function init(lat, long) {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 15,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(lat, long), // New York

            scrollwheel: false,

            // How you would like to style the map.
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"1.00"}]},{"featureType":"administrative.locality","elementType":"labels","stylers":[{"color":"#dd0022"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"color":"#003399"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"visibility":"simplified"},{"lightness":"65"},{"saturation":"-100"},{"hue":"#ff0000"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"80"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#888"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#eeeeee"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#ba5858"},{"saturation":"-100"}]},{"featureType":"transit.station","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#ba5858"},{"visibility":"simplified"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"hue":"#ff0036"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#888"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#003399"}]}]
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
            '<h4 id="firstHeading" style="font-size: 14px;" class="firstHeading">@if(!empty($data)) <?=$data->title?> @endif</h4>'+
            '<a target="_blank" href="@if(!empty($data)) <?=$data->url?> @endif"><p style="font-size: 8px;">Address: @if(!empty($data)) <?=$data->address?> @endif'+
            '<br><a href="tel:+@if(!empty($data)) <?=$data->phone?> @endif" style="font-size: 8px;">Phone: @if(!empty($data)) <?=$data->phone?> @endif'+
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
        g =$('#g-recaptcha-response').val();
        
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
                    error(event, "g-recaptcha-response", '{{ __('general.errorrecaptcha') }}');
                  }
         
                }else{
                  error(event, "message", '{{ __('general.errormessage') }}');
                }
              }else{
                error(event, "email", '{{ __('general.incorrectemail') }}');
              }
            }else{
              error(event, "email", '{{ __('general.erroremail') }}.');
            }
          }else{
            error(event, "subject", '{{ __('general.errorsubject') }}');
          }
          }else{
          error(event, "phone", '{{ __('general.errorphone') }}');
        }
          }else{
          error(event, "position", '{{ __('general.errorposition') }}');
        }
          }else{
          error(event, "organization", '{{ __('general.errororganization') }}');
        }
        }else{
          error(event, "name", '{{ __('general.errorname') }}');
        }
      })

      @if(Session::has('msg'))
        toastr.success("{{ __('general.contact-successful-sent') }}");
      @endif
      @if (count($errors) > 0)
        toastr.warning("{{ __('general.sorry') }}");
      @endif

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
@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.contact-us') }} @if(!empty($data))/ <?=$data->title?> @endif  </small></div>
            </div>
            <div class="col-md-8">
              <div class="page-header">
                  <h1 class="font-i padding-left1">@if(!empty($data)) <?=$data->title?> @endif</h1>
              </div>
              @if($slug == 'ministry-headquarters' || $slug == 'phnom-penh')
              <div class="inner-news">
                  <div class="sectin-cnt">
                      <div class="content-column col-md-5 col-sm-12 col-xs-12">
                          <ul class="list font-i2">
                              <li><a href="<?=$data->website?>" class="clearfix"><i class="fa fa-globe"></i>&nbsp; @if(!empty($data)) <?=$data->website?> @endif</a></li>
                              <li><a href="#" class="clearfix"><i class="fa fa-phone"></i>&nbsp; @if(!empty($data)) <?=$data->phone?> @endif</a></li>
                              <li><a href="#" class="clearfix"><i class="fa fa-envelope"></i>&nbsp; @if(!empty($data)) <?=$data->email?> @endif</a></li>
                              <li><a href="#" class="clearfix"><i class="fa fa-map-marker"></i>&nbsp; @if(!empty($data)) <?=$data->address?> @endif</a></li>
                          </ul>
                      </div>

                      <div class="image-column col-md-7 col-sm-12 col-xs-12">
                       <div id="map" class="map" style="height:200px;"></div>  
                      </div>
                      <div id="map" class="map" style="height:200px;"></div>  
                  </div>
                  <br>
                    <div class="sectin-cnt">
                      <h4>{{ __('general.send-message') }}</h4>
                      @if (count($errors) > 0)
                          <div class="form-group row">
                            <label for="message" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                              @foreach ($errors->all() as $error)
                              <div class="alert-group">
                                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> {{ $error }}!</div>
                              </div>
                              @endforeach
                            </div>
                          </div>
                        @endif
                          <div class="contact-form">
                              <form method="POST" id="contact-form" action="{{ route('submit-contact', ['locale'=>$locale]) }}"  novalidate="novalidate">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <div class="row clearfix">
                                      <input type="hidden" name="contact_department_id" value="@if(!empty($data)) <?=$data->id?> @endif">
                                      <input type="hidden" name="slug" value="@if(!empty($data)) <?=$data->slug?> @endif">
                                      <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" name="name" id="name" value="" placeholder="{{ __('general.your-name') }}" required="">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="organization" id="organization" value="" placeholder="{{ __('general.your-organization') }}" required="">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="position" id="position" value="" placeholder="{{ __('general.position') }}" required="">
                                      </div>

                                       <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="phone" id="phone" value="" placeholder="{{ __('general.your-phone') }}" required="">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                          <input type="email" name="email" id="email" value="" placeholder="{{ __('general.your-email') }}" required="">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="subject" id="subject" value="" placeholder="{{ __('general.your-subject') }}" required="">
                                      </div>
                                     
                                      
                                      <div class="column col-md-12 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <textarea name="message" id="message" placeholder="{{ __('general.message') }} . . ."></textarea>
                                          </div>
                                      </div>
                                      <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                         <div class="g-recaptcha" data-sitekey="6LfBSx8UAAAAAA29jztOsyr3Rb8CcILAkB5yZ4Zk"></div>
                                      </div>
                                      <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                          <br />
                                          <div class="form-group">
                                              <button type="submit" class=" btn default-button blue-btn"><i class="fa fa-send"></i> {{ __('general.send-message') }}</button>
                                          </div>
                                      </div>
                                      
                                  </div>
                                  
                              </form>
                          </div>
                    </div>
              </div>
              @else
              <div class="inner-news">
              <p>Under Construction</p>
            </div>
              @endif
            </div>
            <div class="sidebar-side col-md-4">
             <aside class="sidebar default-sidebar">
                <!-- Popular Posts -->
                  <div class="sidebar-widget popular-posts">
                      <article class="">
                       
                            <div class="sidebar-widget categories" style="">
                                <div class="page-header" >
                                    <h1 class="font-i text-center" style="font-size: 18px;">{{__('general.contact-list')}}</h1>
                                </div>
                                @foreach($defaultData['contact_menu'] as $menu)    
                                @if(count( $menu['departments'] ) > 1)
                                <div clas="inner-news" style="border:1px solid #ebebeb;border-top:0px solid #ebebeb;">
                                  <ul class="list-group">
                                    <li class="list-group-item">
                                      {{ $menu['title'] }}
                                    </li>
                                    @foreach( $menu['departments'] as $department)
                                     <a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$department->slug]) }}"> <li class="list-group-item default_text" style="padding-left:30px;"><i class="fa fa-angle-double-right"></i> {{ $department->title }}</li></a>
                                    @endforeach
                                  </ul>
                                </div>
                                @endif
                              @endforeach
                            </div>
                          
                      </article>
                  </div>
             </aside>
          </div>
          </div>
    </div>
    <br /> 
@endsection