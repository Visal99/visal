@extends('frontend.layouts.master')

@section('title', __('web.welcome'))
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])

@section('active-home', 'active')


@section ('appbottomjs')
<style type="text/css">
   /* .page-header h1{
        padding-bottom:20px;
    }*/
</style>
@endsection

@section ('content')
    
    <!--Minister's Message-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12​ padd-t-b">
                    @if($greeting)
                    <div class="">
                        <div class="image-column">
                            <div class="image img_welcome">
                                <div class="sec-title text-center">
                                    <img src="{{ asset($greeting->img) }}" class="full-width" alt="" />

                                    <a href="{{ $greeting->link }}">
                                        <div class="wrap_cl2">
                                            <h2 class="ms_title text-center" style="color:white;">{{ $greeting->title }}</h2>
                                            <div class="ct-ms text-center" style="color:white;">
                                                <p>{!! $greeting->description !!}</p>
                                                @if($greeting->link != "")
                                                <a href="{{ $greeting->link }}">
                                                <span class="ms_read view_more">{{ __('web.continue-reading') }}<i class="fa-ms fa fa-angle-right" aria-hidden="true"></i></span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4 col-sm-12 padd-t-b">
                    <div class="content-column">
                        <div class="page-header citiz">
                            <h1 class="text-center">{{__('web.public-services')}}</h1>
                        </div>
                        <div class="">
                            <div class="row citizen">
                                @if(isset($defaultData['publicServices'])) 
                                @php($publicServices = $defaultData['publicServices'])
                                @php($i = 0)
                                @foreach($publicServices as $row)
                                <div class="museum-block1 col-lg-6 col-md-4 col-sm-4 col-xs-6 @if($i % 2 == 0) padding5-right @else padding5-left  @endif @php($i++) ">
                                    <div class="inner-box1">
                                        <div class="icon-box1">
                                            <a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug]) }}"> <img src="{{ asset ($row->icon)}}" class="img img-responsive margin_au"> </a>
                                            <h3><a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug]) }}" >{{$row->abbre}}</a></h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Minister's Messag -->
      
        <!--Contact Information-->
        <section class="container padd-t-b">
            <div class="wrap_auto_next automations simple-border" style="">
                <div class="row info-boxes clearfix">
                    <!--Info Boxed-->
                    <div class="col-md-12">
                        <div class="info-boxed col-lg-4 col-md-12 col-sm-12 col-xs-12 info01">
                            <div class="inner">
                                <div class="call-pls-title">
                                    <h4>{{__('web.contact-info')}} </h4>
                                </div>
                                <div class="call-pls-body grey1">
                                    <div class="wrap_inner1">
                                        <span data-toggle="modal" data-target="#exampleModalCenter"><a>{{__('web.phone-detail')}}</a></span>
                                        <br />
                                        <span><a href="mailto:info@mpwt.gov.kSubject=Hello%20again" target="_top">{{__('web.email')}}: info@mpwt.gov.kh</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Info Boxed-->
                        <div class="info-boxed col-lg-4 col-md-12 col-sm-12 col-xs-12 info02">
                            <div class="inner">
                                <div class="call-pls-title">
                                    <h4>{{__('web.working-hours')}} </h4>
                                </div>
                                <div class="call-pls-body grey1">
                                    <div class="wrap_inner2">
                                        <span>{{__('web.open-days')}}</span>
                                        <br />
                                        <span>{{__('web.open-hours')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Info Boxed-->
                        <div class="no-b info-boxed col-lg-4 col-md-12 col-sm-12 col-xs-12 info03">
                            <div class="inner">
                                <div class="call-pls-title">
                                    <h4>{{__('web.address')}} </h4>
                                </div>
                                <div class="call-pls-body grey1">
                                    <div class="wrap_inner3">
                                        <span><a href="https://www.google.com/maps/place/Ministry+of+Public+Works+and+Transport/@11.5750805,104.9218696,18.5z/data=!4m5!3m4!1s0x31095144f3bfe905:0xa9a18d986f6c66b0!8m2!3d11.5741077!4d104.9230935">{{__('web.address-detail')}}</a></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <!--News and Doc-->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 padd-t-b">
                    <div class="nnews">
                        <div class="page-header">
                            <a href="{{ route('posts', ['locale'=>$locale]) }}">
                            <h1 class="padding-left1 font-i" >{{__('web.news')}}</h1>
                            </a> 
                        </div>
                        <div class="inner-news">
                            @if(count($press['data']->data) > 0)
                            <div class="">
                                @php ( $data = $press['data']->data )
                                <div class="row inner-box">
                                    <div class="col-lg-6 col-md-12 image-box">
                                        <div class="image item01">
                                          @php ( $link = route('post', ['locale'=>$locale, 'id'=>$data[0]->id]) )
                                          @php ( $img = $data[0]->image )
                                          <a href="{{ $link }}">
                                            <div style="max-height:300px">
                                                <img src="{{ $img }}" class="full-width" alt=""  />
                                            </div>
                                        </a>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-lg-6  content-box">
                                        <div class="upper-box1 ">
                                            <i class="fa9 fa-angle-right9 " aria-hidden="true"></i>
                                            <h3>
                                               <a href="{{ $link }}" > @if($data[0]->source->id != 174) [{{ $data[0]->source->source }}] - @endif{{ $data[0]->title }}</a>  &nbsp;
                                                <div class="post-time22">
                                                    <span class="date-format">{{ $data[0]->news_date }}</span>
                                                </div>
                                                <div class="post-time22">
                                                    <span class="post-type11"> <a href="{{ route('posts', ['locale'=>$locale, 'source'=>$data[0]->source->id, 'title'=>$data[0]->source->source]) }}" >{{ $data[0]->source->source }}</a> </span> 
                                                </div>
                                            </h3>
                                        </div>
                                        <div class="text news-dec">
                                            @php($description =str_limit(strip_tags($data[0]->short_content), 120))
                                            <p>{{ $description }}</p>
                                        </div>
                                        <a href="{{ $link }}"><span style="padding-bottom: 15px;" class="view_more">{{ __('web.continue-reading') }}<i class=" fa fa-angle-right"aria-hidden="true"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            @endif


                            @if(count($press['data']->data) > 0)
                            <div class="">
                                @php ( $data = $press['data']->data )
                                @for($i = 0 ; $i < sizeof($data); $i++)
                                    @if( $data[$i]->pin == 0 )
                                    <div class="row inner-box">
                                        @php ( $link = route('post', ['locale'=>$locale, 'id'=>$data[$i]->id]) )
                                        @php ( $img = $data[$i]->image )
                                        <div class="  col-lg-12  content-box">
                                            <div class="upper-box11 ">
                                                <i class=" fa fa-angle-right " aria-hidden="true"></i>
                                                <h3>
                                                  <a href="{{ $link }}" >@if($data[$i]->source->id != 174) [{{ $data[$i]->source->source }}] - @endif {{ $data[$i]->title }}</a> 
                                                  &nbsp;
                                                  <div class="post-time22"><span class="date-format">{{ $data[$i]->news_date }}</span></div>
                                                   <div class="post-time22">
                                                        <span class="post-type11"> <a href="{{ route('posts', ['locale'=>$locale, 'source'=>$data[$i]->source->id, 'title'=>$data[$i]->source->source]) }}" >{{ $data[$i]->source->source }}</a> </span> 
                                                    </div>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                            @else
                                <p>{{__('web.no-data')}}</p>
                            @endif
                            <div class="bd-b">
                                <a href="{{ route('posts', ['locale'=>$locale]) }}"><span style=""class="view_more">{{ __('web.other-news') }}<i class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="ddocument padd-t-b">
                        <div class="page-header">
                            <a href="{{ route('documents-blank', ['locale'=>$locale]) }}"><h1 class="padding-left1 font-i">{{__('web.official-documents')}}</h1><a>
                        </div>
                        <div class="inner-news">
                            @if(count($documents) > 0)
                                @php($i = 0)
                                @foreach($documents as $row)
                                <div class="row content-box">
                                    <div class="col-lg-12  content-box">
                                        <div class=" upper-box11" @if($i == 0) style="border-top:0px"  @php($i = 2) @endif >
                                            <div class="wrap-ct-doc">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                <h3><a target="_blank" href="{{ $row->google_drive_url }}" > {{ $row->title}} </a>
                                                    <div class="post-time22">
                                                       <span class="date-format">{{ $row->official_published_date }}</span>
                                                        <span class="post-type11"> <a href="{{ route('documents', ['locale'=>$locale, 'category'=>$row->category->slug]) }}" >{{ $row->category->title }} </a> </span> <span class="date-format">{{ $row->event_date }}</span>
                                                    </div>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            <div class="bd-b">
                                <a href="{{ route('documents-blank', ['locale'=>$locale]) }}"><span style="padding-bottom: 5px;"class="view_more">{{ __('web.other-documents') }}<i class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-12 padd-t-b">
                    @if(count($websites) > 0)
                    <div class="oour-web">
                        <div class="page-header text-center">
                            <h1 class="font-i">{{__('web.our-websites')}}</h1>
                        </div>
                        <div class="inner-website">

                            @foreach($websites as $row)
                            <div class="museum-block">
                                <div class="inner-box">
                                    <div class="icon-box">
                                        <a target="_blank" href="{{ $row->website }}">
                                        <img src="{{ asset($row->logo) }}" class="img img-responsive full-width" />
                                        </a>
                                    </div>
                                    <div class="link-box">
                                        <a target="_blank" href="{{ $row->website }}">{{ $row->title }}</a>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                      
                        </div>

                    </div>
                    @endif
                    <div class="ffacebook padd-t-b visible-lg">
                        <div class="page-header text-center">
                            <h1 class="text-center font-i">{{__('web.facebook-page')}}</h1>
                        </div>
                        <div class="inner-website2 museum-block-fb text-center">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmpwt.gov.kh%2F&tabs=timeline&width=320&height=655&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="320" height="655" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
