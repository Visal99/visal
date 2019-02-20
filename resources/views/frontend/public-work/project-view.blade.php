@extends('frontend.layouts.master')

@section('title',  __('web.projects'). ' | MPWT')
@section('description', $defaultData['seo']['description'])

@if($data) @section('image', asset($data->image_url))  @endif

@section('image', $defaultData['seo']['image'])
@section('active-public-works', 'active')

@section ('appbottomjs')
<link href="{{ asset ('public/frontend/css/owl.css')}}" rel="stylesheet">
<script src="{{ asset ('public/frontend/js/owl.js')}}"></script>
<script type="text/javascript">
  if ($('.three-item-carousel').length) {
    $('.three-item-carousel').owlCarousel({
      loop:true,
      margin:30,
      nav:false,
      smartSpeed: 700,
      autoplay: 4000,
      navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
      responsive:{
        0:{
          items:1
        },
        480:{
          items:1
        },
        600:{
          items:1
        },
        800:{
          items:2
        },
        1024:{
          items:4
        }
      }
    });       
  }
</script>
@endsection

@section ('content')
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumd"><small><a href="{{route('home', $locale)}}"> {{ __('web.homepage') }}</a> / <a href=""> {{ __('web.public-works') }} </a> / <a href="#"> </a> {{ __('web.projects') }} </small></div>
      </div>
      <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('web.projects') }}</h1>
          </div>
          
          <div class="inner-news paddingtop5px">
            <div class="sectin-cnt font-i2 font-text-ct default_text">
              <div class="row">
                  <div class=" col-md-6 col-sm-12 col-xs-12">
                      <img class="img img-responsive" src="@if($data) {{asset($data->image_url)}} @endif" alt="">
                  </div>
                  <div class=" col-md-6 col-sm-12 col-xs-12 sectin-cnt">
                      <h4 class=""> @if($data) {{$data->title}} @endif </h4>
                      <div class="">
                        @if($data) {!!$data->content!!} @endif
                      </div>
                  </div>
              </div>
              <div class="sectin-cnt title_pro">
                <h4>{{ __('web.detail-imformation')}}</h4>
                <table class="table table-bordered">
                      <tbody>
                      <!-- <tr>
                        <td>Project Process</td><td>Upgrade</td>
                      </tr>
                      <tr>
                        <td>Construction Type </td><td> Contuction </td>
                      </tr>
                      <tr>
                        <td>Category </td><td> Contuction </td>
                      </tr> -->
                      <tr>
                        <td>{{ __('web.province')}} </td><td> @if($data) {{$data->province}} @endif </td>
                      </tr>
                      <tr>
                        <td>{{ __('web.pk-location')}} </td><td> @if($data) {{$data->location}} @endif </td>
                      </tr>
                      <tr>
                        <td>{{ __('web.consultant')}} </td><td> @if($data) {{$data->consultant}} @endif </td>
                      </tr>
                      <tr>
                        <td>{{ __('web.authority-in-charge')}} </td><td> @if($data) {{$data->authority}} @endif </td>
                      </tr>
                      <tr>
                        <td>{{ __('web.constructor')}}</td><td> @if($data) {{$data->constructor}} @endif </td>
                      </tr>
                      <tr>
                        <td>{{ __('web.period')}}</td><td> @if($data) {{$data->period}} @endif </td>
                      </tr>
                      <!-- <tr>
                        <td>Note</td><td>  </td>
                      </tr> -->
                </tbody></table>
              </div>
            </div>
          </div>

          @if(isset($documents))
            @if(sizeof($documents)>0)
            <div class="row sectin-cnt">
              <h4 class=""> <i class="fa fa-list-alt"></i>{{ __('web.regulations') }}</h4>
              <table class="table table-bordered">
                <thead class="text-center">
                  <td>{{ __('web.no') }} </td>
                  <td>{{ __('web.date') }} </td>
                  <td>{{ __('web.type') }} </td>
                  <td>{{ __('web.title') }} </td>
                </thead>
                <tbody>
                  @php($i = 0)
                  @foreach($documents as $row)
                  @php( $i++ )
                  <tr>
                    <td>{{ $i }} </td>
                    <td><div class="post-info">{{ Carbon\Carbon::parse($row->updated_at)->format('Y-M-d') }}</div></td>
                    <td>{{ $row->type }}</td>
                    <td><a href="{{ asset($row->pdf) }}" target="_blank" >{{ $row->title }}</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <hr />
            </div>
            @endif
          @endif
      </div>
      <div class="clearfixed"></div>
      <!--Sidebar Side-->
      <div class="sidebar-side col-md-4 no-padd-t-b">
        
        @if(isset($defaultData['publicWorks']))
          @php($publicWorks = $defaultData['publicWorks'])
          @if(count($publicWorks) > 0)
            <aside class="sidebar">
              <div class="sidebar-widget">
                  <article class="">
                    <div class="page-header">
                        <h1 class="text-center font-i">{{ __('web.public-works') }} </h1>
                    </div>
                   
                    <div class="inner-news paddingtop5px">
                      <ul class="list-group font-i2">
                          @php($i = 0)
                          @foreach($publicWorks as $row)
                            @php($i++)
                            <li class="list-group-item @if( isset($subActive)  && $subActive == $row->slug) sub-menu-active  @endif"  @if($i == 1) style="border-top:0px" @endif><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>$row->slug]) }}"> <i class=""></i> {{ $row->title }}</a></li>
                          @endforeach
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
           
            <div class="sectin-cnt">
              <div class="page-header">
                <h1 class="padding-left1 font-i"> {{ __('web.projects') }}</h1>
              </div>
              <div class="inner-news paddingbottom5px">
                <div class="three-item-carousel owl-carousel owl-theme">
                  @foreach( $projects as $row)
                    <div class="news-block wow fadeInLeft animated animated">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image item01">
                                    <a href=""><img src="{{ asset ($row->image_url)}}" alt="" /></a>
                                </div>
                            </div>
                            <div class="content-boxproject">
                                <div class="upper-box">
                                   <a href="">{{$row->title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach 
                </div>   
              </div>
            </div>
        </div>
        @endif
      @endif
    </div>

  </div>
  @include('frontend.layouts.automation-system')


@endsection