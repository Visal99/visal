@extends('frontend/layouts.master')

@section('title', 'Minister | Ministry of Public Work And Transpotation')
@section('active-about', 'actives')

@section ('appbottomjs')

@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container padd-t-b">
        <div class="col-md-8 col-sm-12">
          <div class="row">
            <div class="page-header">
                <h1 class="font-i padding-left1">{{ __('general.senior-minister') }}</h1>
            </div>
            <div class="inner-news">
              <div class="auto-container padd-t-b">
                <div class="row clearfix">
                    <div class="image-column col-md-5">
                      <div class="inner">
                          <div class="image wow fadeInRight animated animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
                              <img src="{{  asset($data['biography']->image) }}" alt="" class="img img-responsive">
                          </div>
                        </div>
                    </div>
                    <div class="sectin-cnt col-md-7 font-i2">
                       <?php echo $data['biography']->content ?>
                    </div>
                    <div class="col-md-12 wrap-minis font-i2 default_text">
                      <br>
                      <h4>{{ __('web.education') }}</h4>
                      <?php echo $data['education']->content ?>
                      
                      <h4>{{ __('web.professional-experience') }}</h4>
                      <?php echo $data['experience']->content ?>

                      <h4>{{ __('web.political-responsiblity') }}</h4>
                      <?php echo $data['politic']->content ?>

                      <h4>{{ __('web.other-activities') }}</h4>
                      <?php echo $data['activities']->content ?>
                      
                      <h4>{{ __('web.challenges') }}</h4>
                      <?php echo $data['challenges']->content ?>
                    </div>
                </div>
              </div>
            </div>
          </div>
          


        </div>
        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-4 col-sm-8 col-xs-12">
          <aside class="sidebar">
             @include('frontend.sidebar.lastest-posts')
          </aside>
        </div>
        <!--End Sidebar Side-->
    </div>
    <br /> 
@endsection