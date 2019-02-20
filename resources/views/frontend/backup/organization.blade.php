@extends('frontend/layouts.master')

@section('title', __('general.about-us').' | '.__('general.welcome'))
@section('active-about', 'actives')

@section ('appbottomjs')

@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.about') }} / {{ __('general.organization-chart') }}  </small></div>
          </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('general.organization-chart') }} </h1>
          </div>
          <div class="inner-news font-i2 default_text">
            <!-- <embed src="{{asset('public/frontend/file/organizationchart.pdf')}}" type="application/pdf"   height="700px" width="100%"> -->
            <a href="{{$organization->link}}"><img src=" {{asset($organization->image)}} "></a>
            <p>{{__('general.download-link')}}:<a target="_blank" href="{{$organization->link}}" >{{__('general.click-here')}}</a></p>
        
          </div>
        </div>
        <div class="clearfixed"></div>
        
      </div>
    </div>
    @include('frontend.layouts.citizi-footer')
@endsection