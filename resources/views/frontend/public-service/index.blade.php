@extends('frontend.layouts.master')

@section('title', $title.' | MPWT')
@section('description', $defaultData['seo']['description'])

@if($data->image)
    @section('image', asset ($data->image))
@endif

@section('image', $defaultData['seo']['image'])
@section('active-public-services', 'active')

@section ('appbottomjs')


@if(sizeof($locations) > 0)
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
<script type="text/javascript">

  //=============================================>> Make Multi Map
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 11.574131, lng: 104.922841},
            styles: []
          });
        var data = [];

        @php($i = 1)
        @foreach($locations as $row)
          
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
            '<a href="tel:'+phone+' "> <p> {{__('general.phone')}}:'+phone
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
@endif

@endsection

@section ('content')
    <section class="container">
      <div class="breadcrumd"><small><a href="{{route('home',$locale)}}"> {{ __('web.homepage') }}</a> / {{ __('web.public-services') }} /  {{$title}}  </small></div>
    </section>
    <!--Main Information -->
    <section class="container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="image-column">
                    
                    <div class="page-header">
                        <h1 class="padding-left1 font-i">{{$title}}</h1>
                    </div>

                    
                    <div class="col-md-12 inner-news">
                        <div class="col-md-5 no-p-d auto-border-left">
                            <div class="col-md-12 no-p-d">
                                <div class="image">
                                    <img src="{{ asset ($data->image)}}" class="w-full" alt="">
                                </div>
                            </div>
                            @if($data->video != "")
                            <div class="col-md-12 wrap-vdo-instr">
                                <div class="text-center" style="padding-top: 20px;padding-bottom: 0px;">
                                    <div class="text-center vdo-instr">
                                        <h4 class="padding-left1 font-i lauguagbold">{{__('web.instruction-video')}}</h4>
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
                                    <div class="fb-video" data-href="{{ $data->video }}"> </div>
                                </div>
                                                           
                            </div>
                            @endif
                        </div>

                        <div class="col-md-7">
                            <div class="sectin-cnt display-list">
                              {!! $data->content !!} 
                            </div>
                        </div>
                        <div class="col-md-12 no-p-d display-list">
                           {!! $data->more !!} 
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    
    @if($data->phone != "" || $data->email != "" || $data->working_hour != "" || $data->website != "")
    <!--Suppot -->
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i">{{__('web.for-information-support')}}</h1>
                </div>

                <div class="page-autoo">
                    <div class="row sectin-cnt">
                        <div class="list inff font-i2">
                            <div class="col-md-6" style="">
                              @if($data->phone != "") <a  href="#" class="clearfix"><i class="fa fa-phone"></i>{{ $data->phone }}</a> @endif
                              @if($data->email != "") <a href="mailto:{{ $data->email }}" class="clearfix"><i class="fa fa-envelope"></i> {{ $data->email }}</a> @endif
                            </div>
                            <div class="col-md-6" style="">
                                @if($data->working_hour != "") <a href="#" class="clearfix"><i class="fa fa-clock-o"></i>{{ $data->working_hour }}</a> @endif
                                @if($data->website != "") <a href="{{ $data->website }}" target="_blank" class="clearfix"><i class="fa fa-globe"></i>{{ $data->website }}</a> @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

    <!--Download App -->
    @if($data->playstore != "" || $data->appstore != "")
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i">{{__('web.download-app')}}</h1>
                </div>

                <div class="page-autoo">
                    <div class="row sectin-cnt">
                        <div class="list inff font-i2">
                            <div class="col-xs-12">
                                <div class="wrap-app99">
                                    @if($data->appstore != "")<a target="_blank" href="{{ $data->appstore }}"><img style="float:left;" src="{{ asset ('public/frontend/images/icons/appstore.png')}}" class="go-link img img-responsive margin_au"></a> @endif
                                    @if($data->playstore != "")<a target="_blank" href="{{ $data->playstore }}"><img style="float:right;" src="{{ asset ('public/frontend/images/icons/playsore.png')}}" class="go-link img img-responsive margin_au"></a> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

     <!-- Document -->
    @if(sizeof($documents) > 0)
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="ddocument">
                    <div class="page-header">
                        <h1 class="padding-left1 font-i">{{__('web.official-documents')}}</h1>
                    </div>
                    <div class="inner-news">
                        <div class="row content-box">
                            @php($i = 1) 
                            @foreach($documents as $row)
                            <div class=" @if($i==1) col-lg-12 @else col-lg-12 @endif content-box">
                                <div class="@if($i++ == 1) upper-box19 @else upper-box11 @endif">
                                    <div class="wrap-ct-doc">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        <h3>
                                            <a href="{{ asset($row->google_drive_url) }}">{{ $row->title }}</a>
                                            <div class="post-time22">
                                                <a href="{{route('documents',['locale'=>$locale, 'category'=>$row->category->slug])}}"><span class="post-type11">{{$row->category->title}}</span> </a>
                                                @if($row->event_date != "")
                                                <span class="date-format">{{ $row->event_date }}</span>
                                                @endif
                                            </div>
                                           
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="bd-b">
                            <a href="{{route('documents-blank',['locale'=>$locale, 'type'=>'public-services', 'slug'=>$data->slug])}}"><span style="padding-bottom: 5px;"class="view_more">{{__('web.view-more')}}<i class=" fa fa-angle-right"aria-hidden="true"></i></span></a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(sizeof($locations) > 0)
    <section class="container padd-t-b">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i">{{__('web.location-services')}}</h1>
                </div>
                <!-- Location -->
                <div class="sectin-cnt page-autoo">
                    
                      <div id="map" class="map" style="height:400px;"></div>
                      <hr />
                      <br />
                    
                    @if($data->frame != "")
                      <iframe width=100% height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{{ $data->frame }}"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(sizeof($faqs) > 0)
    <section class="container padd-t-b" id="my-faq">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="padding-left1 font-i">{{__('web.frequently-asked-question')}}</h1>
                </div>
                <div class="page-autoo">
                    <div class="row faq-accordion fi-clear panel-group padd-10" id="faq-accordion">
                       

                        <div class="col-xs-12">
                          @foreach($faqs as $row)
                        
                            <div class="panel panel-default">
                                <i class="fa fa-angle-down cl-fa-down"></i>
                                <div class="panel-heading active">
                                    <h4 class="default_text font-i2 panel-title">
                                      <a  class="accordion-toggle collapsed "
                                          data-toggle="collapse" 
                                          data-parent="#accordion" 
                                          href="#{{$row->id}}" 
                                          aria-expanded="false">
                                          {{$row->question}}

                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$row->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">{{$row->answer}}</div>
                                </div>
                            </div>

                        @endforeach
                        </div>

                    </div>
                   
                </div>

            </div>
        </div>
    </section>
    @endif 


    @include('frontend.layouts.automation-system')

@endsection