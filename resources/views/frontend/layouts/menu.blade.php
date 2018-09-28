<div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10">
   <nav class="js-mega-menu navbar navbar-expand-lg g-px-0">
      <div class="container g-px-15">
         <!-- Logo -->
         <a class="navbar-brand g-hidden-lg-up" href="bm-classic-home-page-1.html">
            <img src="img/logo.png" alt="Logo">
         </a>
         <!-- End Logo -->

         <!-- Responsive Toggle Button -->
         <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 ml-auto" type="button"
                 aria-label="Toggle navigation"
                 aria-expanded="false"
                 aria-controls="navBar"
                 data-toggle="collapse"
                 data-target="#navBar">
                    <span class="hamburger hamburger--slider g-pa-0">
                      <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                      </span>
                    </span>
         </button>
         <!-- End Responsive Toggle Button -->

         <!-- Navigation -->
         <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
            <ul class="navbar-nav g-font-weight-600">
               <!-- Home - Submenu -->
               <li class="nav-item  g-mr-10--lg g-mr-20--xl">
                  <a id="nav-link--home" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="#!"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="nav-submenu--home">
                     Home
                  </a>
               </li>
               <!-- End Home - Submenu -->

               <!-- Pages - Submenu -->
               <li class="nav-item hs-has-sub-menu g-mx-10--lg g-mx-20--xl">
                  <a id="nav-link--pages" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="#!"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="nav-submenu--pages">
                     APPS
                  </a>

                  <!-- Submenu -->
                  <ul id="nav-submenu--pages" class="hs-sub-menu list-unstyled u-shadow-v11 g-min-width-220 g-brd-top g-brd-primary g-brd-top-2 g-mt-17"
                      aria-labelledby="nav-link--pages">
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">Mission and Vision</a>
                     </li>


                  </ul>
                  <!-- End Submenu -->
               </li>
               <!-- End Pages - Submenu -->

               <!-- TUTORIAL - Submenu -->
               <li class="nav-item  g-mr-10--lg g-mr-20--xl">
                  <a id="nav-link--home" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="#!">
                     TUTORIAL
                  </a>
               </li>


                  @if (Route::has('login'))

                        @auth
                        <a id="nav-link--home" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="{{ url('/home') }}">Home</a>
                        @else
                           <li class="nav-item  g-mr-10--lg g-mr-20--xl">
                           <a id="nav-link--home" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="{{ route('login') }}">
                              <div class="title m-b-md">
                                 Login
                              </div>
                           </a>
                           </li>
                           <li class="nav-item  g-mr-10--lg g-mr-20--xl">
                           <a  id="nav-link--home" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="{{ route('register') }}">Register</a>
                           </li>
                           @endauth

                  @endif




               {{--<div class="flex-center position-ref full-height">--}}
                  {{--@if (Route::has('login'))--}}
                     {{--<div class="top-right links">--}}
                        {{--@auth--}}
                        {{--<a href="{{ url('/home') }}">Home</a>--}}
                        {{--@else--}}
                           {{--<a href="{{ route('login') }}">--}}
                              {{--<div class="title m-b-md">--}}
                                 {{--Login--}}
                              {{--</div>--}}
                              {{--</a>--}}
                           {{--<a href="{{ route('register') }}">Register</a>--}}
                           {{--@endauth--}}
                     {{--</div>--}}
                  {{--@endif--}}

                  {{--<div class="content">--}}
                     {{--<div class="title m-b-md">--}}
                        {{--Laravel--}}
                     {{--</div>--}}

                     {{--<div class="links">--}}
                        {{--<a href="https://laravel.com/docs">Documentation</a>--}}
                        {{--<a href="https://laracasts.com">Laracasts</a>--}}
                        {{--<a href="https://laravel-news.com">News</a>--}}
                        {{--<a href="https://forge.laravel.com">Forge</a>--}}
                        {{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
                     {{--</div>--}}
                  {{--</div>--}}
               {{--</div>--}}
               <!-- End TUTORIAL - Submenu -->

               <!-- Jailbreak - Submenu -->
               <li class="nav-item hs-has-sub-menu g-mx-10--lg g-mx-20--xl">
                  <a id="nav-link--pages" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="#!"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="nav-submenu--pages">
                     JAILBREAK
                  </a>

                  <!-- Submenu -->
                  <ul id="nav-submenu--pages" class="hs-sub-menu list-unstyled u-shadow-v11 g-min-width-220 g-brd-top g-brd-primary g-brd-top-2 g-mt-17"
                      aria-labelledby="nav-link--pages">
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">JAILBREAK NEWS</a>
                     </li>
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">JAILBREAK APPS & TWEAKS</a>
                     </li>


                  </ul>
                  <!-- End Submenu -->
               </li>
               <!-- End Jailbreak - Submenu -->

               <!-- More - Submenu -->
               <li class="nav-item hs-has-sub-menu g-mx-10--lg g-mx-20--xl">
                  <a id="nav-link--pages" class="nav-link text-uppercase g-color-primary--hover g-px-0" href="#!"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="nav-submenu--pages">
                     Download
                  </a>

                  <!-- Submenu -->
                  <ul id="nav-submenu--pages" class="hs-sub-menu list-unstyled u-shadow-v11 g-min-width-220 g-brd-top g-brd-primary g-brd-top-2 g-mt-17"
                      aria-labelledby="nav-link--pages">
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">iOS Firmware</a>
                     </li>
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">Android Firmware</a>
                     </li>
                     <li class="dropdown-item g-bg-secondary--hover">
                        <a class="nav-link g-color-secondary-dark-v1" href="bm-classic-single-1.html">Window</a>
                     </li>


                  </ul>
                  <!-- End Submenu -->
               </li>
               <!-- End More - Submenu -->


         </div>
         <!-- End Navigation -->
      </div>
   </nav>
</div>