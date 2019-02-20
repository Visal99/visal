@extends('frontend.layouts.master')

@section('title', $title)

@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-post', 'active')
@section ('appbottomjs')

<script type="text/javascript" >
  
</script>

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
                          @if(count($press['data']->data) > 0)
                            @php ( $data = $press['data']->data )
                            @for($i = 0 ; $i < sizeof($data); $i++)
                              @if( $data[$i]->pin == 0 )
                              <div class="blog-post style-two">
                                  <div class="row clearfix">
                                      <div class="image-column col-md-4">
                                          <div class="image">
                                            @php ( $link = route('post', ['locale'=>$locale, 'id'=>$data[$i]->id]) )
                                            @php ( $img = $data[$i]->image )
                                            @if($img == '')
                                              @php ( $img = asset('public/frontend/images/placeholder.jpg') )
                                              @if($data[$i]->video != '')
                                                @php ( $img = asset('public/frontend/images/video-placeholder.jpg') )
                                              @endif
                                            @else
                                             
                                             

                                            @endif
                                            
                                            <a href="{{ $link }}"><img src="{{ $img }}" alt=""></a>
                                          </div>
                                      </div>
                                      <div class="content-column col-md-8">
                                          <div class="inner">
                                             
                                              <div class="upper-box1 ">
                                                  <i class="fa9 fa-angle-right9 " aria-hidden="true"></i>
                                                  <h3>
                                                     <a href="{{ $link }}" >@if($data[$i]->source->id != 174) [{{ $data[$i]->source->source }}] - @endif {{ $data[$i]->title }}</a>  &nbsp;
                                                     
                                                      <div class="post-time22"> 
                                                          <span class="date-format">{{ $data[$i]->news_date }}</span>
                                                          <span class="post-type11"> <a href="{{ route('posts', ['locale'=>$locale, 'source'=>$data[$i]->source->id, 'title'=>$data[$i]->source->source]) }}" >{{ $data[$i]->source->source }}</a> </span> 
                                                      </div>
                                                  </h3>
                                              </div>
                                              <div class="lower-box">
                                                  <div class="text font-i2">
                                                       @php($description =str_limit(strip_tags($data[$i]->short_content), 110))
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
                              @endif
                            @endfor
                          @else
                            <p>{{ __('web.no-data') }}</p>
                          @endif
                        </div>
                    </div>
                    <div class="text-center">
                     
                        <ul class="pagination text-center">
                         
                          <li class="page-item"><a class="page-link" href="{{ $prevousPage }}">ទំព័រក្រោយ</a></li>
                          <li class="page-item"><a class="page-link" href="{{ $nextPage }}">ទំព័របន្ទាប់ </a></li>
                      
                        </ul>
                      
                    </div>
                    
                </div>
              
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12 no-padd-t-b">

                  @if(count($sources['data']) > 0)
                  <aside class="sidebar">
                    @php ( $data = $sources['data'])
                    <div class="sidebar-widget popular-posts">
                        <div class="page-header">
                            <h1 class="text-center font-i">{{__('web.media-partners')}}</h1>
                        </div>
                        <div class="inner-news">
                          <div class="sidebar-widget popular-tags">
                            @for($i = 0 ; $i < sizeof($data); $i++)
                            @if($i<50)
                            <a  @if($data[$i]->id == $source) style="background:#b3000b;color:white" @endif href="{{ route('posts', ['locale'=>$locale, 'source'=>$data[$i]->id, 'title'=>$data[$i]->source]) }}">{{ $data[$i]->source }}</a>
                            @endif
                            @endfor
                          </div>
                        </div>  
                    </div>
                    
                  </aside>
                  <br />
                  @endif

                  @if(count($tags['data']->data) > 0)
                  <aside class="sidebar">
                    @php ( $data = $tags['data']->data )
                    <div class="sidebar-widget popular-posts">
                        <div class="page-header">
                            <h1 class="text-center font-i">{{__('web.keyword')}}</h1>
                        </div>
                        <div class="inner-news">
                          <div class="sidebar-widget popular-tags">
                            @for($i = 0 ; $i < sizeof($data); $i++)
                            <a @if($data[$i]->id == $tag) style="background:#b3000b;color:white" @endif href="{{ route('posts', ['locale'=>$locale, 'tag'=>$data[$i]->id, 'title'=>$data[$i]->tag]) }}">{{ $data[$i]->tag }}</a>
                            @endfor
                          </div>
                        </div>  
                    </div>
                    
                  </aside>
                  @endif
                </div>
               
            </div>
        </div>
    </div>
  @include('frontend.layouts.automation-system')


@endsection