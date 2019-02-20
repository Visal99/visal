@extends('frontend.layouts.master')

@section('title', $title.' | MPWT')
@section('description', $defaultData['seo']['description'])
@php( $featuredImage = $data->images()->select('img_url')->orderBy('data_order', 'ASC')->first() )
  @if($featuredImage)
    @section('seo-image', asset($featuredImage->img_url))
  @endif
  @section('image', $defaultData['seo']['image'])
@section('active-news', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    

    <style type="text/css">
        .museum-block1{
            margin-bottom:20px;
        }
    </style>
  <div class="container sidebar-page-container">
      <div class="auto-container">
            <div class="breadcrumd"><small> <a href="{{route('home',$locale)}}"> {{ __('web.homepage') }} </a> / <a href="{{ route('news', ['locale'=>$locale, 'category'=>'']) }}"> {{ __('web.news') }} </a> / <a href="{{ route('news', ['locale'=>$locale, 'category'=>$category->slug]) }}"> {{ $category->title }} </a> </small></div>
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-md-8">
                    <div class="page-header">
                        <h1 class="font-i padding-left1">{{ $title }}</h1>
                    </div>
                    <div class="inner-news">
                       <div class="post-time">
                          <span class="date-format">{{ $data->event_date }}</span>
                        </div>
                        <div class="blog-detail">
                           
                            <div class="news-block">
                                <div class="inner-box">
                                    @php( $featuredImage = $data->images()->select('img_url')->orderBy('data_order', 'ASC')->first() )
                                    @if($featuredImage)
                                      <div class="image-box">
                                          <div class="image">
                                              <img src="{{ asset($featuredImage->img_url) }}" alt="">
                                          </div>
                                      </div>
                                    @endif

                                    <div class="content-box">
                                        <div class="upper-box">
                                            
                                        </div>
                                        <div class="lower-box">
                                            <div class="text font-i2">
                                               
                                              @if(!empty($data))<?=$data->content?> @endif

                                            </div>
                                            <div class="social-box">
                                                <div class="social-links-one">
                                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.facebook.com%2Fmpwt.gov.kh%2F&layout=button_count&size=small&mobile_iframe=true&width=89&height=20&appId" width="89" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12 no-padd-t-b">
                  <aside class="sidebar">
                       @include('frontend.news.features')
                  </aside>
               
                </div>
               
            </div>
        </div>
    </div>
  @include('frontend.layouts.automation-system')


@endsection