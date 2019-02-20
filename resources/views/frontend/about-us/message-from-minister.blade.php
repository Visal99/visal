@extends('frontend.layouts.master')

@section('title', 'Message From Minister')
@section('description', $defaultData['seo']['description'])
@section('image', $defaultData['seo']['image'])
@section('active-about-us', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
     <div class="container" >
      <div class="row">
          <div class="col-md-12">
              <div class="breadcrumd"><small>{{ __('web.homepage') }} / {{ __('web.about-ministry') }} / {{ __('web.message-from-minister') }}  </small></div>
          </div>
        <div class="col-md-12 col-sm-12">
          <div class="page-header">
            <h1 class="padding-left1 font-i">{{ __('web.message-from-minister') }} </h1>
          </div>
          
          <div class="inner-news paddingtop5px">
            <div class="top-mss font-i2">
              <div class="date-left">
                <span clas="mss-date float-left post-time3" style="color:#003399;"> <span class="date-format" style="color:#003399;"> {{ Date('d-m-Y') }} </span> </span>
              </div>
              <div style="width: 178px;" class="date-right2">
                <a href="mailto:info@mpwt.gov.kh"><span clas="mss-date float-left"><i class="fa fa-envelope"></i> {{ __('web.email') }}</span></a>
                <a href="#" ><span clas="mss-date float-right" style="float:right;"><i class="fa fa-print"></i> {{ __('web.print') }}</span></a>
                <br />
              </div>
            </div>
            <br>
            <hr>

            <div class="row padding15px">
            <div class="col-md-12 font-i2 display-list">
              {!! $content !!}
            </div>
            <div class="col-md-12 paddingtop20px font-i2 ">

            </div>
            <div class="col-md-12 padd-t-b wrap_share">
              <div class="col-md-12 no-paddding share2">
                <div class="col-md-4 no-paddding font-i2">
                  <span>{{__('web.love-to-share-on')}}</span>
                </div>
                <div class="col-md-4 no-paddding font-i2">
                  <iframe src="https://www.facebook.com/plugins/like.php?href={{ route('message-from-minister', $locale)}}&width=125&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId" width="125" height="25" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
                <div class="col-md-4 font-i2 paddingtop6px">
                  <div class="g-plus" data-action="share" data-height="24"></div>
                </div>
              </div>
            </div>
          </div>

          </div>
          

        </div>

        </div>
       
      </div>
    </div>

    @include('frontend.layouts.automation-system')

@endsection
