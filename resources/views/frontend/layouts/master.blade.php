<!DOCTYPE html>
<html lang = "{{ $locale }}">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/favicon.ico') }}" type="image/x-icon">
    <title> @yield('title') </title>
    <meta name="description" content="@yield('description') " />
    <meta name="keywords" content="MPWT - Ministry of Public Works and Transport" />
    
    <!-- facebook meta--> 
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content=" @yield('title')" />
    <meta property="og:description" content="@yield('description')" />


    
    <link href="{{ asset('public/frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/camcyber.css') }}" rel="stylesheet">
    @if ($locale == 'en')
    <link href="{{ asset('public/frontend/css/en_styles.css') }}" rel="stylesheet">
    @endif

</head>

<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="page-wrapper">
        <!-- Main Header-->
        <header class="main-header">
            <!--Header-Upper-->
            <div class="">
                 @if(isset($defaultData['desktopBanner']))<a href="{{ route('home', $locale)}}"> <img src="{{ asset($defaultData['desktopBanner']) }}" class="hidden-xs img img-responsive full-width" /> </a>@endif
                 @if(isset($defaultData['mobileBanner']))<a href="{{ route('home', $locale)}}"><img src="{{ asset($defaultData['mobileBanner']) }}" class="visible-xs img-responsive" /></a>@endif
            </div>
            <!--End Header Upper-->

            <!--Header Lower-->
            <div class="header-lower visible-xs visible-md visible-sm">
                <div class="auto-container">
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                           
                           @include('frontend.layouts.menu')
                        </nav>

                    </div>
                </div>
            </div>
            <!--End Header Lower-->
            <!--Header Lower-->
            <div class="header-lower visible-lg">

                <div class="auto-container">
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                           
                           @include('frontend.layouts.menu')
                        </nav>

                    </div>
                </div>
            </div>
            <!--End Header Lower-->

            <!--Sticky Header-->
            <div class="sticky-header">
                <div class="auto-container clearfix">
                    <div class="right-col">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                           
                           @include('frontend.layouts.menu')
                        </nav>

                    </div>

                </div>
            </div>

        </header>
        <!--End Main Header -->

        @yield('content')

        <!--Main Footer-->
        <footer class="main-footer">
            <div class="auto-container">
                <!--Upper Box-->
                <div class="upper-box">

                    <div class="logo-box">
                    </div>

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
                                        <h2>{{__('web.about-ministry')}}</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li ><a href="{{ route('mission-and-vision', $locale)}}">{{__('web.mission-and-vision')}}</a></li>
                                                <li><a href="{{ route('the-senior-minister', $locale)}}">{{__('web.the-senior-minister')}}</a></li>
                                                <li><a href="{{ route('message-from-minister', $locale)}}">{{__('web.message-from-minister')}}</a></li>
                                                <li><a href="{{ route('organization-chart', $locale)}}">{{__('web.organization-chart')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--Footer Column-->
                                <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="footer-widget links-widget">
                                        <h2>{{__('web.public-services')}}</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                               
                                                 @if(isset($defaultData['publicServices']))
                                                    @php($publicServices = $defaultData['publicServices'])
                                                    @if(count($publicServices) > 0)
                                                      
                                                        @foreach($publicServices as $row)
                                                        <li @if( isset($subActive) && $subActive == $row->slug) class="sub-menu-active" @endif ><a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a></li>
                                                        @endforeach
                                                           
                                                    @endif
                                                @endif

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
                                        <h2>{{__('web.public-works')}}</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                               

                                                @if(isset($defaultData['publicWorks']))
                                                    @php($publicWorks = $defaultData['publicWorks'])
                                                    @if(count($publicWorks) > 0)

                                                        @foreach($publicWorks as $row)
                                                        <li @if( isset($subActive) && $subActive == $row->slug) class="sub-menu-active" @endif ><a href="{{ route('public-works', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a></li>
                                                        @endforeach
                                                           
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <!--Footer Column-->
                                <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="footer-widget gallery-widget">
                                        <h2>{{__('web.contact-us')}}</h2>
                                        <div class="widget-content">
                                            <ul class="contact-info">
                                                <li><div class="icon"><span class="fa fa-map"></span></div><a href="https://www.google.com/maps/place/Ministry+of+Public+Works+and+Transport/@11.5750805,104.9218696,18.5z/data=!4m5!3m4!1s0x31095144f3bfe905:0xa9a18d986f6c66b0!8m2!3d11.5741077!4d104.9230935" class="white1 color-white">{{__('web.address-detail')}}</a></li>
                                                <li><div class="icon"><span class="fa fa-globe"></span></div><a href="tel:+85523 427 845" class="white1 color-white">{{__('web.phone-detail')}}</a></li>
                                                <li><div class="icon"><span class="fa fa-phone"></span></div><a href="mailto:info@mpwt.gov.kh" target="_top" class="white1 color-white">info@mpwt.gov.kh</a></li>
                                                <li><div class="icon"><span class="fa fa-globe"></span></div><a href="http://www.mpwt.gov.kh" target="_top" class="white1 color-white">www.mpwt.gov.kh</a></li>
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
                             <div class="copyright">©  <span id="footer-year" year="{{ date('Y') }}" style="color:white"> {{ date("Y") }} </span> {{__('web.copy-right')}}</div>
                        </div>
                        <div class="column col-md-6 col-sm-12 col-xs-12">
                            <div class="social-links">
                                <a target="_blank" href="https://www.facebook.com/mpwt.gov.kh/?ref=br_rs"><span class="fa fa-facebook-f"></span></a>
                                <a target="_blank" href="https://www.youtube.com/channel/UCUyeCL-KlapkqpDIQbRUaYQ"><span class="fa fa-youtube"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Main Footer-->

        <!-- Modal Pop-Up-Phone Number-->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pls Select Number to Call</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="tel:085 92 90 90">(+855) (085) 92 90 90</a>
                        <br>
                        <a href="tel:015 92 90 90">(+855) (015) 92 90 90</a>
                        <br>
                        <a href="tel:067 92 90 90">(+855) (067) 92 90 90</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
  
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/appear.js') }}"></script>
    <script src="{{ asset('public/frontend/js/mixitup.js') }}"></script>
    <script src="{{ asset('public/frontend/js/script.js') }}"></script>

    @yield('appbottomjs')

</body>

</html>
