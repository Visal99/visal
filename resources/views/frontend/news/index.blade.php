@extends('frontend.layouts.master')

@section('title', $title.' | MPWT')
@section('description', $defaultData['seo']['description'])
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
            <div class="breadcrumd"><small> <a href="{{route('home',$locale)}}"> {{ __('web.homepage') }} </a>/ <a href="{{ route('news', ['locale'=>$locale, 'category'=>'']) }}"> {{ __('web.news') }} </a> </small></div>
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-md-8">
                    <div class="page-header">
                        <h1 class="font-i padding-left1">{{ $title }}</h1>
                    </div>
                    <div class="inner-news">
                      <div class="blog-list">
                          @if(count($data) > 0)
                            @foreach($data as $row)
                            <div class="blog-post style-two">
                                <div class="row clearfix">
                                    <div class="image-column col-md-4">
                                        <div class="image">
                                          @php ($link = route('news-detail', ['locale'=>$locale, 'id'=>$row->id]) )
                                          @php( $img = asset('public/frontend/images/1Mthanks.jpg'))
                                          @php( $featuredImage = $row->images()->select('img_url')->where('is_featured', 1)->first() )
                                          @if($featuredImage)
                                            @php( $img = asset($featuredImage->img_url) )
                                          @else
                                            @php( $lastImage = $row->images()->select('img_url')->orderBy('data_order', 'ASC')->first() )
                                            @if($lastImage)
                                              @php( $img = asset($lastImage->img_url) )
                                            @endif
                                          @endif
                                           
                                          <a href="{{ $link }}"><img src="{{ $img }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="content-column col-md-8">
                                        <div class="inner">
                                            
                                            <div class="upper-box1 ">
                                                <i class="fa9 fa-angle-right9 " aria-hidden="true"></i>
                                                <h3>
                                                   <a href="{{ $link }}" >{{ $row->title }}</a>  &nbsp;
                                                    <div class="post-time22">
                                                        <span class="post-type11"> <a href="{{ route('news', ['locale'=>$locale, 'category'=>$row->category->slug]) }}" >{{ $row->category->title }} </a> </span>  
                                                      <span class="date-format">  {{ $row->event_date }} </span>
                                                    </div>
                                                </h3>
                                            </div>
                                            <div class="lower-box">
                                                <div class="text font-i2">
                                                    @php($description =str_limit(strip_tags($row->content), 110))
                                                    <p>{{ $description }}</p>
                                                </div>
                                                <div class="">
                                                  <a href="{{ $link }}"><span style="" class="view_more view-more">{{ __('web.continue-reading') }}<i  class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          @else
                            <p>{{ __('web.no-data') }}</p>
                          @endif
                        </div>
                    </div>
                    <div class="text-center">
                        {{ $data->links('vendor.pagination.frontend-html') }}
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