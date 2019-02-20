<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Stylesheets -->
        
        
        <link href="{{ asset ('public/frontend/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{ asset ('public/frontend/css/style.css')}}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset ('public/frontend/images/mpwt/favicon.ico')}}" type="image/x-icon">
        <!-- Responsive -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link href="{{ asset ('public/frontend/css/responsive.css')}}" rel="stylesheet">
        <link href="{{ asset ('public/frontend/css/camcyber.css')}}" rel="stylesheet">
        @if($locale=="kh")
        <link href="https://fonts.googleapis.com/css?family=Hanuman" rel="stylesheet">
        <link href="{{ asset ('public/frontend/css/kh_laugauges.css')}}" rel="stylesheet">
        @else
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
        <link href="{{ asset ('public/frontend/css/en_laugauges.css')}}" rel="stylesheet">
        @endif
        <title>@yield('title') </title>
        
    </head>
    <body>
        <div class="page-wrapper" style="background:url({{ asset('public/frontend/images/mpwt/visu-left.png') }}) no-repeat left center fixed">
            <!-- Main Header-->
            <header class="main-header">
                <!--Header-Upper-->
                <div class="">
                    <img src="{{ asset ('public/uploads/image/1497028552.jpg')}}" class="hidden-xs img img-responsive" />
                    <img src="{{ asset ('public/uploads/image/1.png')}}" class="visible-xs img-responsive" />
                </div>
                <!--End Header Upper-->
                
                <!--Header Lower-->
                <div class="header-lower visible-xs visible-md visible-sm">
                    <div class="auto-container">
                      <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                             @include('frontend.layouts.menu')
                        </div>
                    </div>
                </div>
                <!--End Header Lower-->
                <!--Header Lower-->
                <div class="header-lower visible-lg">
                    
                  <div class="auto-container">
                      <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                             @include('frontend.layouts.menu')
                        </div>
                    </div>
                </div>
                <!--End Header Lower-->
                
                <!--Sticky Header-->
                <div class="sticky-header">
                  <div class="auto-container clearfix">
                        <div class="right-col">
                          <!-- Main Menu -->
                           @include('frontend.layouts.menu')
                        </div>
                        
                    </div>
                </div>
                <!--End Sticky Header-->
            </header>

            <!--End Main Header -->
            @yield('content')
            
            <!--Sponsors Section-->
            <br />
            <section class="sponsors-section">
                <div class="auto-container">
                  <div class="carousel-outer">
                        <!--Sponsors Slider-->
                        <ul class="sponsors-carousel owl-carousel owl-theme">
                            @php($partnerships = $defaultData['partnerships'])
                            @foreach($partnerships as $row)
                            <li><div class="image-box"><a href="#"><img src="{{ asset ($row->logo)}}" alt=""></a></div></li>
                            @endforeach
                        </ul>
                    </div>
              </div>
            </section>
            <!--End Sponsors Section-->
            
            <!--Featured Image-->
            <img src="{{ asset ('public/frontend/images/mpwt/footer.png')}}" class="img img-responsive" style="margin:0px auto; " />    
            
            <!--Main Footer-->
            <footer class="main-footer">
              <div class="auto-container">
                  <!--Upper Box-->
                    <div class="upper-box">
                      <div class="logo-box">
                          <a href=""><img src="{{ asset ('public/frontend/images/mpwt/footer-logo.png')}}" alt="" style="max-width:100px" /></a>
                        </div>
                        <div><iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fmpwt.gov.kh%2F&width=123&layout=button_count&action=like&size=small&show_faces=true&share=true&height=46&appId" width="123" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>
                        <!--Signup Form-->
                        <div class="signup-form">
                        <div class="col-md-12">
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <div class="title">Newsletter Subscribtion</div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="Your email address..." required>
                                    <button type="submit" class="theme-btn"><span class="flaticon-envelope-2"></span></button>
                                </div>
                            </form>
                        </div>
                        
                           
                        </div>
                        <!--Signup Form-->
                        
                    </div>
                    <!--widgets section-->

                    <div class="widgets-section" style="padding-bottom: 0px;">
                        <div class="row clearfix">
                          <!--Big Column-->
                            <div class="big-column col-md-6 col-sm-12 col-xs-12">
                              <div class="row clearfix">
                                  <!--Footer Column-->
                                    <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                      <div class="footer-widget links-widget">
                                            <h2>{{ __('general.about-us') }}</h2>
                                            <!--Widget Content-->
                                            <div class="widget-content">
                                                <ul class="list">
                                                    <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'organization-chart']) }}">{{ __('general.organization-chart') }}</a></li>
                                                    <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'leader']) }}">{{ __('general.leader') }}</a></li>
                                                    <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'mission-and-vision']) }}">{{ __('general.mission-and-vision') }}</a></li>
                                                    <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'minister']) }}">{{ __('general.minister') }}</a></li>
                                                    <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'achievement']) }}">{{ __('general.achievement') }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--Footer Column-->
                                    <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                      <div class="footer-widget links-widget">
                                          <h2>{{ __('general.automation-systems') }}</h2>
                                            <!--Widget Content-->
                                            <div class="widget-content">
                                              <ul class="list">
                                                    <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'vehicle-registration']) }}">{{ __('general.vehicle-registration') }}</a></li>
                                                    <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'technical-inspection']) }}">{{ __('general.technical-inspection') }}</a></li>
                                                    <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'transport-licensing']) }}">{{ __('general.transport-licensing') }}</a></li>
                                                    <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'driver-license']) }}">{{ __('general.driver-license') }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!--Big Column-->
                            <div class="big-column col-md-6 col-sm-12 col-xs-12">
                              <div class="row clearfix">
                                <!--Footer Column-->
                                <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="footer-widget links-widget">
                                       <h2>{{ __('general.public-works') }} </h2>
                                            <!--Widget Content-->
                                            <div class="widget-content">
                                                <ul class="list">
                                                    <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'expressways']) }}">{{ __('general.expressways') }}</a></li>
                                                    <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'sewage-systems']) }}">{{ __('general.sewage-systems') }}</a></li>
                                                    <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-infrastructure']) }}">{{ __('general.road-infrastructure') }}</a></li>
                                                    <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'public-works-technical']) }}">{{ __('general.public-works-technical') }}</a></li>
                                                    <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-map']) }}">{{ __('general.road-map') }}</a></li>
                                                </ul>
                                            </div>
                                    </div>

                                </div>
                                
                                <!--Footer Column-->
                                <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="footer-widget gallery-widget">
                                        <h2>{{ __('general.keep-in-touch') }}</h2>
                                        <!--Widget Content-->
                                        <div class="widget-content">
                                            <!--Contact Info-->
                                            <ul class="contact-info">
                                                <li><div class="icon"><span class="flaticon-location-pin"></span></div>{{ __('general.corner') }}</li>
                                                <li><div class="icon"><span class="flaticon-technology-1"></span></div> (+855)23 427 845</li>
                                                <li><div class="icon"><span class="flaticon-interface"></span></div>info@mpwt.gov.kh</li>
                                                <li><div class="icon"><span class="fa fa-globe"></span></div>www.mpwt.gov.kh</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer Bottom-->
                <div class="footer-bottom">
                  <div class="auto-container">
                      <div class="row clearfix">
                          <div class="column col-md-6 col-sm-12 col-xs-12">
                              <div class="copyright">{{ __('general.all-right') }}</div>
                            </div>
                            <div class="column col-md-6 col-sm-12 col-xs-12">
                              <div class="social-links">
                                    <a href="#"><span class="fa fa-facebook-f"></span></a>
                                    <a href="#"><span class="fa fa-youtube"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--End Main Footer-->

         </div>
        <!-- end layout-theme-->
        
        
        <script src="{{ asset ('public/frontend/js/jquery.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/jquery.fancybox.pack.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/jquery.fancybox-media.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/owl.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/appear.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/wow.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/mixitup.js')}}"></script>
        <script src="{{ asset ('public/frontend/js/script.js')}}"></script>

     

        @yield('appbottomjs')

    </body>
</html>