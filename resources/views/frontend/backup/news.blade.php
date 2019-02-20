@extends('frontend/layouts.master')

@section('title', __('general.news').' | '.__('general.welcome'))
@section('active-press', 'actives')

@section ('appbottomjs')
@endsection

@section ('content')
    <style type="text/css">
        .museum-block1{
            margin-bottom:20px;
        }
    </style>
	<!-- <div class="page_banner">
		<img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
	</div> -->
	<div class="container sidebar-page-container">
    	<div class="auto-container">
            <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.news') }} </small></div>
        	<div class="row clearfix">
            	
                <!--Content Side-->
                <div class="content-side col-md-8">

                    <div class="page-header">
                        <h1 class="font-i padding-left1">{{ __('general.news') }} <small>   </small></h1>
                    </div>
                    <div class="inner-news">
                    	<div class="blog-list">
                            @php($i = 1)
                            @php($numOfPress = count($presses))
                            @foreach($presses as $row)
                            <!--Blog Post-->
                			<div class="blog-post style-two">
                                <div class="row clearfix">
                                    <!--Image Column-->
                                    <div class="image-column col-md-4">
                                        <div class="image">
                                            <a href="{{ route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug]) }}"><img src="{{ asset ($row->feature_image)}}" alt=""></a>
                                        </div>
                                    </div>
                                    <!--Content Column-->
                                    <div class="content-column col-md-8">
                                        <div class="inner">
                                            <div class="upper-box">
                                                <div style="color:#b3000b;" class="post-time"><span>
                                                    {{ $row->updated_at->format('d') }}</span> - {{ $row->updated_at->format('M-Y') }}</div>
                                                <a href="{{ route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug]) }}" class="font-i2">
                                                    {{$row->title}}
                                                </a>
                                            </div>
                                            <div class="lower-box">
                                                <div class="text font-i2">
                                                    @php($description =str_limit($row->description,150))
                                                    <p>{{$description}}</p>
                                                </div>
                                                <div class="">
                                                  <a href="{{ route('press-view', ['locale'=>$locale, 'category'=>$row->category->slug, 'slug'=>$row->slug]) }}"><span style="color: #003399;" class="view_more">{{__('general.read-more')}}<i style="color: #003399;" class=" fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php ($i++)
                            @if($i <= $numOfPress) 
                                
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        {{ $presses->links('vendor.pagination.frontend-html') }}
                    </div>
                    
                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-4 col-sm-8 col-xs-12">
                	<aside class="sidebar">
                        @include('frontend.sidebar.public-works')
                    </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
    @include('frontend.layouts.citizi-footer')
      
@endsection