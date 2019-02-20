@extends('frontend.layouts.master')

@section('title', $data->title.' | MPWT')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-contact-us', 'active')

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
    init(@if(!empty($data)) <?=$data->lat?> @endif, @if(!empty($data)) <?=$data->lng?> @endif);
    
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
            '<h4 id="firstHeading" style="font-size: 14px;" class="firstHeading">@if(!empty($data)) <?=$data->title?> @endif</h4>'+
            '<a style="font-size: 8px;" target="_blank" href="@if(!empty($data)) <?=$data->url?> @endif"><p style="font-size: 8px;">Address:<a style="font-size: 8px;" target="_blank" href="@if(!empty($data)) <?=$data->google_link?> @endif">  @if(!empty($data)) <?=$data->address?> @endif'+
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
                          error(event, "g-recaptcha-response", '{{ __('web.errorrecaptcha') }}');
                        }
                      }else{
                        error(event, "message", '{{ __('web.errormessage') }}');
                      }
                    }else{
                      error(event, "email", '{{ __('web.incorrectemail') }}');
                    }
                  }else{
                    error(event, "email", '{{ __('web.erroremail') }}.');
                  }
                }else{
                  error(event, "subject", '{{ __('web.errorsubject') }}');
                }
              }else{
                error(event, "phone", '{{ __('web.errorphone') }}');
              }
            }else{
              error(event, "position", '{{ __('web.errorposition') }}');
            }
          }else{
            error(event, "organization", '{{ __('web.errororganization') }}');
          }
        }else{
          error(event, "name", '{{ __('web.errorname') }}');
        }
      })

      @if(Session::has('msg'))
        toastr.success("{{ __('web.contact-successful-sent') }}");
      @endif
      @if (count($errors) > 0)
        toastr.warning("{{ __('web.error-sent') }}");
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
    
  <div class="container">
    <div class="row">
      
      <div class="col-md-12">
        <div class="breadcrumd"><small><a href="{{route('home', $locale)}}"> {{ __('web.homepage') }}</a> / <a href="#"> {{ __('web.contact-us') }} </a> @if($title != "") / <a href="#"> {{ $title }} </a> @endif </small></div>
      </div>

      <div class="col-md-8">
        <div class="page-header">
          <h1 class="padding-left1 font-i">{{ $data->title }}</h1>
        </div>
        <div class="inner-news">
            <div class="sectin-cnt ">
              <div class="container-fluid">
                <div class="row">
                  <div class="content-column col-md-5 col-sm-12 col-xs-12">
                      <ul class="">
                          @if($data->website != "")<li><a href="{{ $data->website }}" class="clearfix"><i class="fa fa-globe"></i>&nbsp;  {{ $data->website }}</a></li>@endif
                          @if($data->phone != "") <li><a href="#" class="clearfix"><i class="fa fa-phone"></i>&nbsp; {{ $data->phone }}</a></li>@endif
                          @if($data->email != "")<li><a href="#" class="clearfix"><i class="fa fa-envelope"></i>&nbsp; {{ $data->email }}</a></li>@endif
                          @if($data->address != "") <li><a href="#" class="clearfix"><i class="fa fa-map-marker"></i>&nbsp; {{ $data->address }}</a></li>@endif
                      </ul>
                  </div>
                  <div class="image-column col-md-7 col-sm-12 col-xs-12">
                    <div id="map" class="map" style="height:200px;"></div>  
                  </div> 
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <br />
                    <h4>{{ __('web.send-message') }}</h4>
                    @if (count($errors) > 0)
                      <div class="form-group row">
                        <label style="color:red;" for="message" class="col-sm-2 col-form-label"> {{__('web.error')}} </label>
                        <div class="col-sm-12">
                          @foreach ($errors->all() as $error)
                          <div class="alert-group">
                            <div style="color:red;" class="alert alert-warning"><i style="color:red;" class="fa fa-exclamation-triangle"></i> {{ $error }}!</div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                    @if(Session::has('msg'))
                      
                      <div class="form-group row">
                          <div class="col-sm-12">
                            <div class="alert-group">
                              <div class="alert alert-success"><i class="fa fa-check"></i> {{ __('web.contact-successful-sent') }}!</div>
                            </div>
                          </div>
                      </div>
                    @endif
                    @if (count($errors) > 0)
                     <div class="form-group row">
                          <div class="col-sm-12">
                            <div class="alert-group">
                              <div class="alert alert-danger"><i  class="fa fa-exclamation-triangle"></i> {{ __('web.error-sent') }}!</div>
                            </div>
                          </div>
                      </div>
                    @endif


                    <div class="contact-form">
                        <form method="POST" id="contact-form" action="{{ route('send-message', ['locale'=>$locale]) }}"  novalidate="novalidate">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row clearfix">
                                <input type="hidden" name="contact_id" value="@if(!empty($data)) <?=$data->id?> @endif">
                                <input type="hidden" name="slug" value="@if(!empty($data)) <?=$data->slug?> @endif">
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <input type="text" name="name" id="name" value="" placeholder="{{ __('web.your-name') }}" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="organization" id="organization" value="" placeholder="{{ __('web.your-organization') }}" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="position" id="position" value="" placeholder="{{ __('web.position') }}" required="">
                                </div>

                                 <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="phone" id="phone" value="" placeholder="{{ __('web.your-phone') }}" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="email" name="email" id="email" value="" placeholder="{{ __('web.your-email') }}" required="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="subject" id="subject" value="" placeholder="{{ __('web.your-subject') }}" required="">
                                </div>

                                <div class="column col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" placeholder="{{ __('web.message') }}"></textarea>
                                    </div>
                                </div>
                                <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                   <div class="g-recaptcha" data-sitekey="6LcCNHYUAAAAAHDfaydBQmQqdLHsNKgNkOPIf-uA"></div>
                                </div>
                                <div class="column col-md-6 col-sm-12 col-xs-12 text-right">
                                    <br />
                                    <div class="form-group">
                                        <button type="submit" class=" btn default-button blue-btn"><i class="fa fa-send"></i> {{ __('web.submit') }}</button>
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
        @if(count($children) > 0)
          <aside class="sidebar">
            <div class="sidebar-widget">
                <article class="">
                  <div class="page-header">
                      <h1 class="text-center font-i">{{ __('web.other-departments') }}</h1>
                  </div>
                 
                  <div class="inner-news paddingtop5px">
                    <ul class="list-group font-i2">
                       @php($i = 0)
                        @foreach($children as $row)
                        <li  class="list-group-item @if( isset($subActive)  && $subActive == $row->slug) sub-menu-active  @endif" @if($i == 0) style="border-top:0px"  @endif @php( $i = 1 )>
                          <a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </article>
            </div>
          </aside>
        @elseif(count($siblings) > 0)

          <aside class="sidebar">
            <div class="sidebar-widget">
                <article class="">
                  <div class="page-header">
                      <h1 class="text-center font-i">{{ $parent->title }}</h1>
                  </div>
                 
                  <div class="inner-news paddingtop5px">
                    <ul class="list-group font-i2">
                       @php($i = 0)
                        @foreach($siblings as $row)
                        <li  class="list-group-item @if( isset($subActive)  && $subActive == $row->slug) sub-menu-active  @endif" @if($i == 0) style="border-top:0px"  @endif @php( $i = 1 )>
                          <a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </article>
            </div>
          </aside>

        @else
           @if(isset($defaultData['contacts']))
            @php($contacts = $defaultData['contacts'])
            @if(count($contacts) > 0)
              <aside class="sidebar">
                <div class="sidebar-widget">
                    <article class="">
                      <div class="page-header">
                          <h1 class="text-center font-i">{{ __('web.list-departments') }}</h1>
                      </div>
                     
                      <div class="inner-news paddingtop5px">
                        <ul class="list-group font-i2">
                           @php($i = 0)
                            @foreach($contacts as $row)
                            <li  class="list-group-item @if( isset($subActive)  && $subActive == $row->slug) sub-menu-active  @endif" @if($i == 0) style="border-top:0px"  @endif @php( $i = 1 )>
                              <a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                      </div>
                    </article>
                </div>
              </aside>
            @endif
          @endif
        @endif

         
      </div>

    </div>
  </div>
  @include('frontend.layouts.automation-system')


@endsection