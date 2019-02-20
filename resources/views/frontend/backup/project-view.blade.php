@extends('frontend/layouts.master')

@section('title', 'Project | Ministry of Public Work And Transpotation')
@section('active-home', 'actives')

@section ('appbottomjs')
@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container">
        <div class="page-header">
            <h1>{{ __('web.public-works-projects') }}</h1>
        </div>
        <div class="col-md-9 col-md-9 col-sm-12">
          <div class="row">
            <div class="auto-container">
              <div class="row">
                  <div class=" col-md-6 col-sm-12 col-xs-12">
                      <img class="img img-responsive" src="{{ asset ('public/frontend/images/mpwt/driving-licence.jpg')}}" alt="">
                  </div>
                  <div class=" col-md-6 col-sm-12 col-xs-12 sectin-cnt">
                      <h4 class=""></i> @if(!empty($data)) {{$data->title}} @endif</h4>
                      <div class="">
                        <p>@if(!empty($data)) {{$data->background}} @endif</p>
                      </div>
                  </div>
                  
              </div>

            </div>
            <hr />
          </div>

          <div class="row sectin-cnt">
            <h4 > <i class="fa fa-exclamation"></i>{{ __('web.detail-information') }} </h4>
            <table class="table table-bordered">
                  <tr>
                    <td>{{ __('web.project-process') }}</td><td>Upgrade</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.construction-type') }} </td><td>@if(!empty($data)) {{$data->construction_type}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.category') }} </td><td>@if(!empty($data)) {{$data->category}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.province') }} </td><td>@if(!empty($data)) {{$data->province}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.location') }} </td><td>@if(!empty($data)) {{$data->location}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.consultant') }} </td><td>@if(!empty($data)) {{$data->consultant}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.authority-in-charge') }} </td><td>@if(!empty($data)) {{$data->authority}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.constructor') }} </td><td>@if(!empty($data)) {{$data->constructor}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.period') }} </td><td>@if(!empty($data)) {{$data->period}} @endif</td>
                  </tr>
                  <tr>
                    <td>{{ __('web.note') }}</td><td>@if(!empty($data)) {{$data->note}} @endif</td>
                  </tr>
            </table>
            <hr />
          </div>

          <div class="row sectin-cnt">
            <h4 class=""> <i class="fa fa-list-alt"></i>{{ __('web.related-projects') }}</h4>
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
                               <a href="{{ route('project-view', ['locale'=>$locale, 'slug'=>$row->slug]) }}">{{$row->title}}</a>
                            </div>
                        
                        </div>
                        
                    </div>
                </div>
               @endforeach
                
               
                 
            </div>
            <hr />
          </div>
        </div>
        <div class="clearfixed"></div>
        
        <!--Sidebar Side-->
        <div class="sidebar-side col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <aside class="sidebar">
            @include('frontend.sidebar.public-works')
            @include('frontend.sidebar.automation-systems')
          </aside>
        </div>
    </div>
    <br /> 
@endsection