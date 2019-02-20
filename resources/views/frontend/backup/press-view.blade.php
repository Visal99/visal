@extends('frontend/layouts.master')

@section('title', __('general.press').' | '.__('general.welcome'))
@section('active-press', 'actives')

@section ('appbottomjs')
@endsection

@section ('content')
    <style type="text/css">
        .museum-block1{
            margin-bottom:20px;
        }
    </style>
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Content Side-->
                <div class="col-md-12">
                    <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.news') }} @if(!empty($category))/ {{ __('general.'.$category) }}@endif  </small></div>
                </div>
                <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="page-header">
                        <h1 class="font-i padding-left1">{{ $data->title }} <small>   </small></h1>
                    </div>
                    <div class="inner-news">
                        <!-- <div class="title_press">
                            <h2 class="font-i"></h2>
                        </div>
                        <hr> -->
                        <div class="post-time">
                            {{ $data->updated_at->format('d') }} <span>- {{ $data->updated_at->format('M-Y') }}</span>
                            
                        </div>
                        <div class="blog-detail">
                            <!--News Block-->
                            <div class="news-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="image">
                                            <img src="{{ asset ($data->image)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <div class="upper-box">
                                            
                                        </div>
                                        <div class="lower-box">
                                            <div class="text font-i2">
                                               
                                            <p>@if(!empty($data))<?=$data->content?> @endif</p>
                                            </div>
                                            <div class="social-box">
                                                <div class="social-links-one">
                                                    <a href="#" class="fa fa-facebook"></a>
                                                    <a href="#" class="fa fa-google-plus"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <aside class="sidebar">
                        @include('frontend.sidebar.lastest-posts')
                    </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
      
@endsection