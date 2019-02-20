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
              <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.about') }} @if(!empty($category))/ {{ __('general.'.$category) }}@endif  </small></div>
          </div>
        <div class="col-md-8 col-sm-12 ">
          <div class="page-header">
            <h1 class="padding-left1 font-i">@if(!empty($category)) {{ __('general.'.$category) }}@endif </h1>
          </div>
          <div class="inner-news font-i2 default_text">

            
            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-exclamation font-i2"></i> {{__('general.background')}}</h4>
              <div class="default_text font-i2">
              <p>@if(!empty($background)) {!! $background->content !!}@endif</p>
              </div>
              <hr />
            </div>

            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-star-o "></i> {{__('general.mission')}}</h4>
              <div class="default_text">
              <p>@if(!empty($mission)) {!! $mission->content !!}@endif</p>
              </div>
              <hr />
            </div>
            
            <div class="sectin-cnt">
              <h4 class="font-i2"> <i class="fa fa-eye "></i> {{__('general.vision')}}</h4>
              <div class="default_text">
              <p>@if(!empty($vision)) {!! $vision->content !!}@endif</p>
              </div>
              <hr />
            </div>
          </div>
        </div>
        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12">
          <aside class="sidebar">
            @include('frontend.sidebar.public-works')
          </aside>
        </div>
        <!--End Sidebar Side-->
      </div>
    </div>
    @include('frontend.layouts.citizi-footer')
@endsection