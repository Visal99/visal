@extends('frontend.layouts.master')

@section('title', $title.' | MPWT')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-documents', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="breadcrumd"><small><a href="{{route('home', $locale)}}"> {{ __('web.homepage') }}</a> / <a href="{{ route('documents-blank', ['locale'=>$locale]) }}"> {{ __('web.official-documents') }} </a> @if($title != "") / <a href="#"> {{ $title }} </a> @endif </small></div>
        </div>

        <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i">@if($title != "") {{ $title }} @endif</h1>
          </div>
          
          <div class="inner-news">
            <div class="row content-box">
                @if(count($data) > 0)
                 @php($i = 0)
                  @foreach($data as $row)
                
                  <div class="  col-lg-12  content-box">
                      <div class=" upper-box11 " @if($i == 0) style="border-top:0px"  @php($i = 2) @endif >
                          <div class="wrap-ct-doc">
                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                              <h3>
                                <a target="_blank" href="{{ $row->google_drive_url }}" >{{ $row->title }}</a>
                                  <div class="post-time22">
                                   
                                    <span class="date-format">{{ $row->official_published_date }}</span>
                                     <span class="post-type11">
                                      <a href="{{ route('documents', ['locale'=>$locale, 'category'=>$row->category->slug]) }}" >{{ $row->category->title }} </a>  
                                    </span> 

                                  </div>
                              </h3>
                          </div>
                      </div>
                  </div>

                  @endforeach

                @else
                <div class=" col-xs-12">
                  <p>{{ __('web.no-data') }}</p>
                </div>
                  
                @endif
              </div>
          </div>

          <div class="text-center">
            {{ $data->links('vendor.pagination.frontend-html') }}
          </div>

        </div>

        <div class="clearfixed"></div>
        <!--Sidebar Side-->
        <div class="sidebar-side col-md-4 no-padd-t-b">
          
          @if(isset($defaultData['documentCategories']))
            @php($documentCategories = $defaultData['documentCategories'])
            @if(count($documentCategories) > 0)
              <aside class="sidebar">
                <div class="sidebar-widget">
                    <article class="">
                      <div class="page-header">
                          <h1 class="text-center font-i">{{ __('web.official-documents') }}</h1>
                      </div>
                     
                      <div class="inner-news paddingtop5px">
                        <ul class="list-group font-i2">
                            @for($i = 0; $i < count($documentCategories); $i++)
                            <li  class="list-group-item @if( isset($subActive)  && $subActive == $documentCategories[$i]['parent']->slug) sub-menu-active  @endif" @if($i ==0) style="border-top:0px" @endif >
                              <a href="{{ route('documents', ['locale'=>$locale, 'category'=>$documentCategories[$i]['parent']->slug])}}">{{ $documentCategories[$i]['parent']->title }}</a>
                            </li>
                            @endfor
                        </ul>
                      </div>
                    </article>
                </div>
              </aside>

            @endif
          @endif

        </div>
        <div class="clearfixed"></div>
        @if(isset($projects))
          @if(sizeof($projects) > 0)
          <div class="col-md-12 padd-t-b">
              @php($projects = $data->projects()->select($locale.'_title as title','image','slug')->get())
              @if(sizeof($projects)>0)
              <div class="sectin-cnt">
                <div class="page-header">
                  <h1 class="padding-left1 font-i"> {{ __('web.project') }}</h1>
                </div>
                <div class="inner-news paddingbottom5px">
                  <div class="three-item-carousel owl-carousel owl-theme">
                    @foreach( $projects as $row)
                      <div class="news-block wow fadeInLeft animated animated">
                          <div class="inner-box">
                              <div class="image-box">
                                  <div class="image item01">
                                      <a href="{{ route('project-view', ['locale'=>$locale, 'slug'=>$row->slug]) }}"><img src="{{ asset ($row->image)}}" alt="" /></a>
                                  </div>
                              </div>
                              <div class="content-boxproject">
                                  <div class="upper-box">
                                     <a href="{{ route('project-view', ['locale'=>$locale, 'slug'=>$row->slug]) }}">{{$row->title}}</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach 
                  </div>   
                </div>
              </div>
              @endif
          </div>
          @endif
        @endif
      </div>
    </div>

@include('frontend.layouts.automation-system')


@endsection