@extends('frontend/layouts.master') 
@section('title', __('general.citizen-service').' | '.__('general.welcome')) 
@section('active-automation', 'actives')
@section ('appbottomjs')


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

<script src="{{ asset ('public/frontend/js/custom-map.js')}}"></script>
<script type="text/javascript" src="{{ asset ('public/user/js/lib/blockUI/jquery.blockUI.js') }}"></script>
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

        @php($i = 1)
        @foreach($maps as $row)
          
            data.push(['{{$row->title}}', {{$row->lat}}, {{$row->lng}}, {{$i++}}, '{{$row->address}}','{{$row->url}}','{{$row->phone}}' ]);
         
       @endforeach

    $(document).ready(function(){
          setMarkers(data, '{{asset('public/frontend/images/icons/marker2.png')}}');
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
            '<a target="_blank" href="'+url+'"><p>{{__('general.address')}}:'+address+
            '<a href="tel:+'+phone+' "> <p> {{__('general.phone')}}:'+phone
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

@endsection @section ('content')

<div class="">
    <!-- Main Information -->
    <section class="container">
       
        <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.public-service') }} @if(!empty($data))/ {{$data->title}} @endif  </small></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="image-column">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i">@if(!empty($data)) {{$data->title}} @endif </h1>
                    </div>

                    <div class="">
                        <div class="col-md-12 inner-news">
                            <div class="col-md-5 no-p-d auto-border-left">
                                <div class="col-md-12 no-p-d">
                                    <div class="image">
                                        <img src="{{ asset ($data->image)}}" class="w-full" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                    @if(sizeof($data->videos()->select($locale.'_title as title','image','video_id')->where('published',1)->orderBy('id','DESC')->get()) > 0)
                                    <div class="text-center" style="padding-top: 15px;padding-bottom: 15px;">
                                        <h4 class="padding-left1 font-i lauguagbold">{{__('general.instruction-video')}}</h4>
                                    </div>
                                    <div class="image ">
                                        <!-- Videos -->
                                        

                                        <div class="filter-list">
                                            <!--Default Portfolio Item-->
                                            <div class="default-portfolio-item mix all art modern ">
                                                @foreach($data->videos()->select($locale.'_title as title','image','video_id')->where('published',1)->orderBy('id','DESC')->get() as $row)
                                                <div class="inner-box">
                                                    <figure class="image-box"><img src="{{ asset ($row->image)}}" alt=""></figure>
                                                    <!--Overlay Box-->
                                                    <div class="overlay-box">
                                                        <div class="overlay-inner">
                                                            <div class="content">
                                                                <a href="{{$row->video_id}}&autoplay=1" class="video lightbox-image image-link" data-fancybox-group="example-gallery" title="Ministry of Public Works and Transport's 2016 Year-end Forum"><span class="fa fa-youtube-play"></span></a>

                                                                <h3><a href="">{{$row->title}}</a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        
                                    </div>
                                    @else @endif
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="sectin-cnt intt default_text">
                                    <div class="text-center" style="padding-bottom: 5px;">
                                        <h4 class="padding-left1 font-i">{{ $data->title }}</h4>
                                    </div>
                                    <p class="cl-justify display-list">
                                        @if(!empty($data)) {!! $data->description !!} @endif
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-12 no-p-d display-list">
                                @if(!empty($data)) {!! $data->more !!} @endif
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
                    <h1 class="padding-left1 font-i">{{__('general.for-information-support')}}</h1>
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
                                @if( $data->id == 3 || $data->id == 5 || $data->id == 6 )

                                @else
                                <li><a href="#my-faq" class="clearfix"><i class="fa fa-question-circle"></i>FAQ</a></li>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @if( $data->id == 3 || $data->id == 5 || $data->id == 6 )
                                
    @else

        @php($faqs = $data->faqs()->where('published',1)->select($locale.'_title as title',$locale.'_description as description','id')->get())
        @if(sizeof($faqs) > 0)
        <section class="container padd-t-b" id="my-faq">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i">{{__('general.frequently-asked-question')}}</h1>
                    </div>
                    <div class="page-autoo">

                        <hr> 
                        <div class="row faq-accordion fi-clear panel-group padd-10" id="faq-accordion">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            @php( $i = 0 )
                            @foreach($faqs as $row)
                              @php($i++)
                              @if( $i%2 == 0)

                                <div class="panel panel-default">
                                    <div class="panel-heading active">
                                        <h4 class="default_text font-i2 panel-title">
                                          <a  class="accordion-toggle collapsed "
                                              data-toggle="collapse" 
                                              data-parent="#accordion" 
                                              href="#{{$row->id}}" 
                                              aria-expanded="false">
                                              {{$row->title}}<i class="fa fa-angle-down cl-fa-down"></i>

                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{$row->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">{{$row->description}}</div>
                                    </div>
                                </div>

                              @endif
                            @endforeach
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              @foreach($faqs as $row)
                              @php($i++)
                              @if( $i%2 == 1)

                                <div class="panel panel-default">
                                    <div class="panel-heading active">
                                        <h4 class="default_text font-i2 panel-title">
                                          <a  class="accordion-toggle collapsed "
                                              data-toggle="collapse" 
                                              data-parent="#accordion" 
                                              href="#{{$row->id}}" 
                                              aria-expanded="false">
                                              {{$row->title}}<i class="fa fa-angle-down cl-fa-down"></i>

                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{$row->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">{{$row->description}}</div>
                                    </div>
                                </div>

                              @endif
                            @endforeach
                            </div>

                        </div>
                       
                    </div>

                </div>
            </div>
        </section>
        @endif 
    @endif
    @if(sizeof($documents) > 0)
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="ddocument">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i">{{__('general.official-document')}}</h1>
                    </div>
                    <div class="inner-news">
                        <div class="content-box">
                            @php($i = 1) @foreach($documents as $row)
                            <div class="@if($i++ == 1) upper-box18 @else upper-box14 @endif">
                                <h3><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{ asset($row->pdf) }}">{{ $row->title }}</a></h3>

                                <div class="post-time22">
                                    <span class="post-type11">{{ __('web.type') }}: {{$row->type}}</span>{{ Carbon\Carbon::parse($row->updated_at)->format('Y-M-d') }}
                                </div>
                            </div>
                            @endforeach
                            <div class="bd-b">
                                <a href="{{route('official-document',$locale)}}"><span style="padding-bottom: 5px;"class="view_more">{{__('general.view-more')}}<i class=" fa fa-angle-right"aria-hidden="true"></i></span></a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="container">
        <div class="linkss">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="">
                        <h1 style="text-align: center;"><span class="app-d font-i">{{__('general.download-app-for')}} iOS / Android</span></h1>
                        <div class="wrap-app99">
                            <a target="_blank" href="@if(!empty($data)) {{ url($data->ios_link) }} @endif"><img style="float:left;" src="{{ asset ('public/frontend/images/mpwt/app/ios.png')}}" class="go-link img img-responsive margin_au"></a>
                            <a target="_blank" href="@if(!empty($data)) {{ url($data->android_link) }} @endif"><img style="float:right;" src="{{ asset ('public/frontend/images/mpwt/app/andriod.png')}}" class="go-link img img-responsive margin_au"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    @if(!empty($data->link))
                    <div class="">
                        <h1 style="text-align: center;"><span class="app-d font-i">@if(!empty($data)) {{$data->title}} @endif ({{__('general.link')}})</span></h1>
                        <div class="wrap-app99">
                            <a target="_blank" href="@if(!empty($data)) {{url($data->link)}} @endif">
                                <div class="cl-go-link">@if(!empty($data)) {{$data->link}} @endif</div>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if(sizeof($maps) > 0)
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i">{{__('general.location-services')}}</h1>
                </div>
                <!-- Location -->
                <div class="sectin-cnt page-autoo">
                    @if(sizeof($maps) > 0)
                      <div id="map" class="map" style="height:400px;"></div>
                      <hr />
                      <br />
                    @endif
                    @if($data->frame != "")
                    
                      <iframe width=100% height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{{ $data->frame }}"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

</div>
@include('frontend.layouts.citizi-footer') @endsection