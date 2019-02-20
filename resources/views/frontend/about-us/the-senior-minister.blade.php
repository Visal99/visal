@extends('frontend.layouts.master')

@section('title', 'The Sinior Minister')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-about-us', 'active')


@section ('appbottomjs')
@endsection

@section ('content')
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('web.homepage') }} / {{ __('web.about-ministry') }} / {{ __('web.the-senior-minister') }}  </small></div>
          </div>
        <div class="col-md-8 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('web.the-senior-minister') }} </h1>
          </div>
          <div class="inner-news font-i2 default_text">
            <div class="sectin-cnt">
              @foreach($data as $row)
              <div class="default_text font-i2 display-list">
                @if($row->title != "_")
                  <h4>{{ $row->title }}</h4>
                @endif
                
                {!! $row->content !!}
              </div>
              <br />
              @endforeach
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