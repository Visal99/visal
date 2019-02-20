@extends('frontend.layouts.master')

@section('title', 'Organization Chart')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-about-us', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('web.homepage') }} / {{ __('web.about-ministry') }} / {{ __('web.organization-chart') }}  </small></div>
          </div>
        <div class="col-md-12 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('web.organization-chart') }} </h1>
          </div>
          
          <div class="inner-news paddingtop5px">
           

            <div class="row padding15px">
            <div class="col-md-12 font-i2 display-list">
               <a href="{{$link}}"><img src=" {{asset($image)}} "></a>
                <a target="_blank" href="{{$link}}" >{{__('web.click-here')}}</a>
            </div>
          
          </div>

          </div>
          

        </div>

        </div>
       
      </div>
    </div>

    @include('frontend.layouts.automation-system')

@endsection