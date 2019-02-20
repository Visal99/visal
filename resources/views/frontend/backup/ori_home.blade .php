@extends('frontend/layouts.master')

@section('title', __('general.welcome'))
@section('active-home', 'actives')

@section ('appbottomjs')
@endsection

@section ('content')
  
    <!--Slide-->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
             @foreach($slides as $row)  
              <li data-target="#myCarousel" data-slide-to="{{$row->id}}" class="<?php if($row->id==1){echo"active";}else{echo"";} ?>"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
         
          @foreach($slides as $row)
          <div class="item <?php if($row->id==1){echo"active";} ?>">
            <img src="{{ asset ($row->image)}}" class="full-width" alt="">
          </div>
          
          @endforeach

        </div>
    </div>

    <!--automation systems-->
    
    <div class="container ">
      <div class="sec-title the-padding">
        <h2>{{ __('general.automation-systems') }}</h2>
        <div class="row">
        <div class="text">@if(!empty($automation_systems)) <?=$automation_systems->content?> @endif
        
        <div class="default-portfolio-item mix all art modern wow fadeInLeft animated animated animated" style="display: inline-block; visibility: visible; animation-name: fadeInLeft;">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset($url->image)}}" alt=""></figure>
                        <!--Overlay Box-->
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <a href="http://www.youtube.com/v/{{$url->url}}?autoplay=1" class="video lightbox-image image-link" data-fancybox-group="example-gallery" title="Ministry of Public Works and Transport's 2016 Year-end Forum"><span class="fa fa-youtube-play"></span></a>
                                   
                                    <h3><a href="">{{$url->title}}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        </div>
        <div class="row ">
            
                 
                    <div class="museum-block1 col-md-3 col-xs-12">
                        <div class="inner-box1 wow fadeInLeft animated animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInLeft;">
                            <div class="icon-box1">
                                 <img src="{{ asset ('public/frontend/images/mpwt/automation/Vehicle_Registration.png')}}" class="img img-responsive margin_au">
                            </div>
                            <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'vehicle-registration']) }}">{{ __('general.vehicle-registration') }}</a></h3>
                        </div>
                    </div>
                  
                    <div class="museum-block1 col-md-3 col-xs-12">
                        <div class="inner-box1 wow fadeInLeft animated animated" data-wow-delay="600ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: fadeInLeft;">
                            <div class="icon-box1">
                                <img src="{{ asset ('public/frontend/images/mpwt/automation/Technical_Inspection.png')}}" class="img img-responsive margin_au">
                            </div>
                            <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'technical-inspection']) }}">{{ __('general.technical-inspection') }}</a></h3>
                            
                        </div>
                    </div>
                  
                    <div class="museum-block1 col-md-3 col-xs-12">
                        <div class="inner-box1 wow fadeInLeft animated animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <div class="icon-box1">
                                 <img src="{{ asset ('public/frontend/images/mpwt/automation/Transport_Licensing.png')}}" class="img img-responsive margin_au">
                            </div>
                            <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'transport-licensing']) }}">{{ __('general.transport-licensing') }}</a></h3>
                           
                        </div>
                    </div>
                  
                    <div class="museum-block1 col-md-3 col-xs-12">
                        <div class="inner-box1 wow fadeInLeft animated animated" data-wow-delay="600ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: fadeInLeft;">
                            <div class="icon-box1 automation">
                                 <img src="{{ asset ('public/frontend/images/mpwt/automation/Driver_License.png')}}" class="img img-responsive margin_au">
                            </div>
                            <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'driver-license']) }}">{{ __('general.driver-license') }}</a></h3>
                           
                        </div>
                    </div>
        </div>

      </div>
    </div>
    

     <!--Contact Information-->
    <section class="container ">
      <div class="wrap_auto_next automations" style="">
        <div class="row info-boxes clearfix">
            <!--Info Boxed-->
            <div class="info-boxed wow fadeInLeft animated animated col-md-4 col-sm-4 col-xs-12">
                <div class="inner">
                    <h4>{{ __('web.immediate-need') }} </h4>
                    <h3>(+855) (085,015,067) 92 90 90</h3>
                    <h3>email: info@mpwt.gov.kh</h3>
                </div>
            </div>
            <!--Info Boxed-->
            <div class="info-boxed wow fadeInLeft animated animated col-md-4 col-sm-4 col-xs-12">
                <div class="inner">
                    <h4>{{ __('web.open-monday-suturday') }}</h4>
                    <h3>{{ __('web.morning') }}</h3>
                    <h3>{{ __('web.afternoon') }}</h3>
                </div>
            </div>
             <!--Info Boxed-->
            <div class="info-boxed wow fadeInLeft animated animated col-md-4 col-sm-4 col-xs-12">
                <div class="inner">
                    <h4>{{ __('web.address') }}</h4>
                    <h3>{{ __('web.corner') }}</h3>
                    
                </div>
            </div>
        </div>
      </div>
    </section>

    <!--Minister's Message-->
    <section class="container">
      <div class="the-padding">
          <div class="row">
              <!--Content Column-->
                <div class="content-column pull-right col-md-6 col-sm-12 col-xs-12">
                  <div class="inner">
                      <!--Sec Title-->
                        <div class="sec-title wow fadeInLeft animated animated">
                        
                            <h2>{{ __('web.message-from-the-minister') }}</h2>
                            <div class="text" style="text-align:left;">
                              
                              
                               <?php 
                                $content= $minister_message->content;
                                $result = substr($content, 0,2000);
                                echo $result; 
                              ?>
                            </div>
                        </div>

                        <a href="{{ route('message-minister', ['locale'=>$locale]) }}" class="btn default-button blue-btn">{{ __('web.read-more') }} <span class="glyphicon glyphicon-forward"></span></a>
                    </div>
                   
                </div>

                <!--Image Column-->
              <div class="image-column pull-left col-md-6 col-sm-12 col-xs-12">
                  <div class="image wow slideInLeft img_welcome" data-wow-delay="0ms" data-wow-duration="1500ms">
                      <img src="@if(!empty($minister_message)){{ asset ( $minister_message->image )}}@endif" alt="" />
                    </div>
                </div>
          </div>
      </div>
      <hr />
    </section>

   
    <!--News Section-->

    <section class="container">
      <div class="pad_top_bottom sec-title">
          <h2 >{{ __('web.latest-news') }}</h2>
      </div>
      <div class="three-item-carousel owl-carousel owl-theme">
        <!--News Block-->
        @foreach($presses as $row)
        <div class="news-block wow fadeInLeft animated animated">
              <div class="inner-box">
                  <div class="image-box">
                      <div class="image item01">
                          <img src="{{ asset ($row->image)}}" alt="" />
                      </div>
                  </div>
                  <div class="content-box">
                      <div class="upper-box">
                          <div class="post-time">
                               {{ $row->updated_at->format('M') }}-<span>{{ $row->updated_at->format('d-Y') }}</span>
                          </div>
                          <h3><a href="{{ route('press-view', ['locale'=>$locale, 'category'=>'', 'slug'=>$row->slug]) }}">{{$row->title}}</a></h3>
                          
                      </div>
                      <div class="text">{{$row->description}}</div>
                  
                  </div>
              </div>
        </div>
        @endforeach 
      </div>
      <div class="margin_bottom my_botton text-center"><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'']) }}" class="btn default-button blue-btn">{{ __('web.view-more') }} <span class="glyphicon glyphicon-forward"></span></a></div>
      <hr />
    </section>
    <!--REGULATION AND POLICIES-->
    <section class="container" >  
      <div class=" wow fadeInLeft animated ">
        <div class="sec-title">
             <h2>{{ __('web.regulation-and-policies') }} </h2>
        </div>        
        <div class="margin_top margin_bottom">
          <div id="exTab2"> 
            <ul class="nav nav-tabs">
              <li class="active"><a  href="#1" data-toggle="tab">{{ __('web.prakas') }} </a></li>
              <li><a href="#2" data-toggle="tab">{{ __('web.law') }}</a></li>
              <li><a href="#3" data-toggle="tab">{{ __('web.policy') }} </a></li>
              <li><a href="#4" data-toggle="tab">{{ __('web.agreement') }}</a></li>
              <li><a href="#5" data-toggle="tab">{{ __('web.sub-decree') }} </a></li>
              <li><a href="#6" data-toggle="tab">{{ __('web.decree') }} </a></li>
            </ul>
            <div class="tab-content wrap_tap">
              <div class="tab-pane active" id="1">
                <div class="pad_top_bottom"></div>
                @foreach($prakas as $row)
                <div class="row">
                  <div class="col-sm-3"><a target="_blank" href="{{ asset ($row->pdf)}}" class=""><img src="{{ asset ($row->image)}}" class="img-responsive"></a>
                  </div>
                  <div class="col-sm-7">
                   <h3 class="title"><a target="_blank" href="{{ asset ($row->pdf)}}">{{$row->title}}</a></h3>
                    <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>@if(!empty($row->created_at)) {{$row->created_at->format('M-d-Y')}} @endif</p>
                  </div>
                  <div class="col-sm-2 download">
                       <a target="_blank" href="{{ asset ($row->pdf)}}">  <p class="glyphicon glyphicon-download-alt"></p> </a>
                    
                  </div>
                </div>
                  @endforeach
              </div> 
              <div class="tab-pane" id="1">
                <div class="pad_top_bottom"></div>
                @foreach($agreement as $row)
                <div class="row">
                  <div class="col-sm-3"><a target="_blank" href="{{ asset ($row->pdf)}}" class=""><img src="{{ asset ($row->image)}}" class="img-responsive"></a>
                  </div>
                  <div class="col-sm-7">
                   <h3 class="title"><a target="_blank" href="{{ asset ($row->pdf)}}">{{$row->title}}</a></h3>
                    <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> @if(!empty($row->created_at)) {{$row->created_at->format('M-d-Y')}} @endif</p>
                  </div>
                  <div class="col-sm-2 download">
                    <a target="_blank" href="{{ asset ($row->pdf)}}"><p class="glyphicon glyphicon-download-alt"></p></a>
                  </div>
                </div>
                @endforeach  
              </div> 
              <div class="tab-pane" id="2">
                <div class="pad_top_bottom"></div>
                  @foreach($sub as $row)
                  <div class="row">
                    <div class="col-sm-3"><a target="_blank" href="{{ asset ($row->pdf)}}" class=""><img src="{{ asset ($row->image)}}" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-7">
                     <h3 class="title"><a target="_blank" href="{{ asset ($row->pdf)}}">{{$row->title}}</a></h3>
                      <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> @if(!empty($row->created_at)) {{$row->created_at->format('M-d-Y')}} @endif</p>
                    </div>
                    <div class="col-sm-2 download">
                        <a target="_blank" href="{{ asset ($row->pdf)}}">  <p class="glyphicon glyphicon-download-alt"></p> </a>
                      
                    </div>
                  </div>
                  @endforeach  
              </div>
              <div class="tab-pane" id="4">
                <div class="pad_top_bottom"></div>
                  @foreach($decree as $row)
                  <div class="row">
                    <div class="col-sm-3"><a target="_blank" href="{{ asset ($row->pdf)}}" class=""><img src="{{ asset ($row->image)}}" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-7">
                     <h3 class="title"><a target="_blank" href="{{ asset ($row->pdf)}}">{{$row->title}}</a></h3>
                      <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> @if(!empty($row->created_at)) {{$row->created_at->format('M-d-Y')}} @endif</p>
                    </div>
                    <div class="col-sm-2 download">
                        <a target="_blank" href="{{ asset ($row->pdf)}}">  <p class="glyphicon glyphicon-download-alt"></p> </a>
                    </div>
                  </div>
                  @endforeach 
              </div>
              <div class="tab-pane" id="5">
                <div class="pad_top_bottom"></div>
                @foreach($decree as $row)
                <div class="row">
                  <div class="col-sm-3"><a target="_blank" href="{{ asset ($row->pdf)}}" class=""><img src="{{ asset ($row->image)}}" class="img-responsive"></a>
                  </div>
                  <div class="col-sm-7">
                   <h3 class="title"><a href="#">{{$row->title}}</a></h3>
                    <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> @if(!empty($row->created_at)) {{$row->created_at->format('M-d-Y')}} @endif</p>
                  </div>
                  <div class="col-sm-2 download">
                      <a target="_blank" href="{{ asset ($row->pdf)}}">  <p class="glyphicon glyphicon-download-alt"></p> </a>
                  </div>
                </div>
                @endforeach 
              </div> 
            </div> 
          </div>
        </div>
      </div>
    </section>

    <!--Project-->
    <br />
    <section class="container">
      <!--Sec Title-->
       <div class="auto-container">
            <!--Sec Title-->
            <div class=" sec-title">
                <h2>{{ __('web.our-project') }}</h2>
            </div>
            <br />
            <div class="three-item-carousel owl-carousel owl-theme">
                <!--News Block-->
                @foreach($projects as $row)
                <div class="news-block wow fadeInLeft animated animated">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image item01">
                                <img src="{{ asset ($row->image)}}" alt="" />
                            </div>
                        </div>
                        <div class="content-boxproject">
                            <div class="upper-box">
                                <h3><a href="{{ route('project-view', ['locale'=>$locale, 'slug'=>$row->slug]) }}">{{$row->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
      <div class="margin_bottom my_botton text-center"><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'public-works']) }}" class="btn default-button blue-btn">{{ __('web.view-more') }} <span class="glyphicon glyphicon-forward"></span></a></div>
      <hr />
    </section>
    
    
    <!--Video-->
    <section class=" container">
        <div class="the-padding">
          <!--Sec Title-->
            <div class="sec-title">
                <h2>{{ __('web.recent-videos') }}</h2>
                <br />
            </div>
            <div class="filter-list clearfix">
                @foreach($videos as $row)
                <!--Default Portfolio Item-->
                <div class="default-portfolio-item mix all art modern col-lg-3 col-md-4 col-sm-6 col-xs-12 wow fadeInLeft animated animated">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ asset ($row->image)}}" alt=""></figure>
                        <!--Overlay Box-->
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <a href="{{$row->video_id}}?autoplay=1" class="video lightbox-image image-link" data-fancybox-group="example-gallery" title="Ministry of Public Works and Transport's 2016 Year-end Forum"><span class="fa fa-youtube-play"></span></a>
                                   
                                    <h3><a href="">{{$row->title}}</a></h3>
                                    <div class="category">Phnom Penh</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <hr />
    </section>
    
    <!--Enterprise public-->
    <section class="container" >
        <div class="the-padding">
            <!--Sec Title-->
            <div class="sec-title">
                <h2>{{ __('web.enterprise-public') }} </h2>
            </div>
            <div class="row clearfix">
                <!--Museum Block-->
                <div class="container-30">
                <div class="col-md-12">
                 <!--Museum Block-->
                <div class="museum-block col-md-6 col-xs-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInLeft;">
                        <div class="icon-box">
                             <img src="{{ asset ('public/frontend/images/mpwt/Enterprise_public/mpts4.jpg')}}" class="img img-responsive full-width"/>
                        </div>
                        <h3><a target="_blank" href="http://www.lbtpcambodia.com/">{{ __('web.minister-of-public-works-and-transport') }}</a></h3>
                        <div class="text">{{ __('web.direct') }}</div>
                    </div>
                </div>
                
                <div class="museum-block col-md-6 col-xs-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="600ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: fadeInLeft;">
                        <div class="icon-box">
                            <img src="{{ asset ('public/frontend/images/mpwt/Enterprise_public/ppap1.jpg')}}" class="img img-responsive full-width"/>
                        </div>
                        <h3><a target="_blank" href="http://www.ppap.com.kh/">{{ __('web.phnom-penh-autonomous-port') }}</a></h3>
                        <div class="text">{{ __('web.direct') }}</div>
                    </div>
                </div>
                
                <!--Museum Block-->
                <div class="museum-block col-md-6 col-xs-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <div class="icon-box">
                             <img src="{{ asset ('public/frontend/images/mpwt/Enterprise_public/pas2.jpg')}}" class="img img-responsive full-width"/>
                        </div>
                        <h3><a target="_blank" href="http://www.pas.gov.kh/">{{ __('web.sihanoukville-autonomous-port') }} </a></h3>
                        <div class="text">{{ __('web.direct') }}</div>
                    </div>
                </div>
                
               
                <!--Museum Block-->
                <div class="museum-block col-md-6 col-xs-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="600ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: fadeInLeft;">
                        <div class="icon-box">
                             <img src="{{ asset ('public/frontend/images/mpwt/Enterprise_public/kamsab3.jpg')}}" class="img img-responsive full-width"/>
                        </div>
                        <h3><a target="_blank" href="http://www.kamsab.com.kh/">{{ __('web.kampuchea-shipping-agency-and-brokers') }}</a></h3>
                        <div class="text">{{ __('web.direct') }}</div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
        <hr />
    </section>
    
      
@endsection