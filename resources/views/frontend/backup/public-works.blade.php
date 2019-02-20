@extends('frontend/layouts.master')

@section('title', __('general.public-works').' | '.__('general.welcome'))
@section('active-public-work', 'actives')

@section ('appbottomjs')

@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.public-works') }} @if(!empty($data))/ {{ $data->title }}@endif  </small></div>
        </div>
        <div class="col-md-8">
          <div class="page-header">
            <h1 class="padding-left1 font-i">@if(!empty($data)) {{ $data->title }}@endif</h1>
          </div>
            <!-- Introduction -->
            <div class="inner-news paddingtop5px">
              <div class="sectin-cnt font-i2 font-text-ct default_text">
                <p class="" style="font-size: 14px;">@if(!empty($data)) <?=$data->content?> @endif</p>
              </div>
            </div>
            @if(sizeof($documents)>0)
            <!-- Regulations -->
            <div class="row sectin-cnt">
              <h4 class=""> <i class="fa fa-list-alt"></i> {{ __('web.regulations') }}</h3>
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
         
        </div>
        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-md-4">
           <aside class="sidebar">
              <div class="sidebar-widget">
                  @include('frontend.sidebar.public-works') 
              </div>
           </aside>
        </div>
        <div class="clearfixed"></div>
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
                                    <img src="{{ asset ($row->image)}}" alt="" />
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
      </div>
    </div>
  @include('frontend.layouts.citizi-footer')
@endsection