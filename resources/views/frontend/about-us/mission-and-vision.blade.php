@extends('frontend.layouts.master')

@section('title', 'Mission And Vision')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-about-us', 'active')


@section ('appbottomjs')
@endsection

@section ('content')
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('web.homepage') }} / {{ __('web.about-ministry') }} / {{ __('web.mission-and-vision') }}  </small></div>
          </div>
        <div class="col-md-8 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('web.mission-and-vision') }} </h1>
          </div>
        
          <div class="inner-news font-i2 default_text">
            <div class="sectin-cnt">
            
              <div class="default_text font-i2 display-list">
                <h4>{{__('web.background')}}</h4>
                {!! $background !!}
              </div>
              <br />

              <div class="default_text font-i2 display-list">
                <h4>{{__('web.vision')}}</h4>
                {!! $vision !!}
              </div>
              <br />
              <div class="default_text font-i2 display-list">
                <h4>{{__('web.mission')}}</h4>
                {!! $mission !!}
              </div>
            
             
            </div>
          </div>

        </div>
        <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padd-t-b">
          <aside class="sidebar">
            <article class="">
              <div class="page-header">
                  <h1 class="text-center font-i">{{__('web.about-ministry')}}</h1>
              </div>
              <div class="inner-news paddingtop5px">
                 @include('frontend.about-us.menu')
              </div>
            </article>
          </aside>
        </div>
        <!--End Sidebar Side-->
      </div>
    </div>

    @include('frontend.layouts.automation-system')

@endsection