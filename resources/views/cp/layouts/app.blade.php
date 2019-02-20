@extends('cp/layouts.master')

@section ('headercss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/bootstrap-sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/main.css') }}">
    <script type="text/javascript" src="{{ asset ('public/user/js/lib/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/summernote/summernote.css') }}"/>
    @yield('appheadercss')
@endsection



@section ('bodyclass')
    class="with-side-menu control-panel control-panel-compact"
@endsection

@section ('header')

<header class="site-header">
    <div class="container-fluid">
        <a target="_blank" href="{{ url('/') }}" class="site-logo">
            <img style="padding: 10px;" class="hidden-md-down" src="{{ asset ('public/user/img/logo.png') }}" alt="">
            <img class="hidden-lg-up" src="{{ asset ('public/user/img/logo.png') }}" alt="">
        </a>
        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset (Auth::user()->picture) }}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="{{ route('cp.user.profile.edit') }}"><span class="fa fa-user"></span> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('cp.auth.logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
                        </div>
                    </div>

                    <button type="button" class="burger-right">
                        <i class="font-icon-menu-addl"></i>
                    </button>
                </div><!--.site-header-shown-->

                <div class="mobile-menu-right-overlay"></div>
                
            </div><!--site-header-content-in-->
        </div><!--.site-header-content-->
    </div><!--.container-fluid-->
</header><!--.site-header-->
@endsection

@section ('menu')
    @php ($menu = "")
    @if(isset($_GET['menu']))
        @php( $menu = $_GET['menu'])
    @endif
    

    <div class="mobile-menu-left-overlay"></div>
    <nav class="side-menu">

        <ul class="side-menu-list"> 
        @if(checkPermision('cp.dashboard') )
        <li class="red @yield('active-main-menu-banner')">
                <a href="{{ route('cp.dashboard.index') }}">
                <span>
                    <i class="fa fa-dashboard"></i>
                    <span class="lbl">Dashbord</span>
                </span>
                </a>
            </li>
        @endif  
           
           <!--  <li class="@yield('active-main-menu-banner') red with-sub">
                <span>
                    <i class=" font-icon fa fa-file-image-o"></i>
                    <span class="lbl">Banner</span>
                </span>
                <ul>
                    
                    <li class=""><a href="{{ route('cp.banner.edit',1) }}"><span class="lbl">Desktop</span></a></li>
                    <li class=""><a href="{{ route('cp.banner.edit',2) }}"><span class="lbl">Mobile</span></a></li>
                </ul>
            </li> -->
            @if (checkPermision('cp.greeting.index'))
            <li class="@yield('active-main-menu-home') red with-sub">
                <span>
                    <i class=" font-icon fa fa-home"></i>
                    <span class="lbl">Homepage</span>
                </span>
                <ul>
                        {{-- @if (checkPermision('cp.greeting.index')) --}}
                    <li class=""><a href="{{ route('cp.greeting.index') }}"><span class="lbl">Greeting</span></a></li>
                <!--    <li class=""><a href="{{ route('cp.popup.index') }}"><span class="lbl">Popup</span></a></li>-->
                        {{-- @endif --}}
                </ul>
            </li>
            @endif
            @if (checkPermision('cp.content.content.edit,mission'))
            <li class="@yield('active-main-menu-about') red with-sub">
                <span>
                    <i class=" font-icon fa fa-user"></i>
                    <span class="lbl"> About Us</span>
                </span>
                <ul>
                    @if (checkPermision('cp.content.content.edit,mission'))
                    <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'mission']) }}?menu=about"><span class="lbl">Mission</span></a></li>
                    @endif

                    @if (checkPermision('cp.content.content.edit,vision'))
                    <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'vision']) }}?menu=about"><span class="lbl"> Vision</span></a></li>
                    @endif

                    @if (checkPermision('cp.content.content.edit,background'))
                    <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'background']) }}?menu=about"><span class="lbl"> Background</span></a></li>
                    @endif

                    @if (checkPermision('cp.organization.edit'))
                    <li class=""><a href="{{ route('cp.organization.edit',1) }}"><span class="lbl">Orgainazation</span></a></li>
                    @endif

                    <!-- <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'minister']) }}?menu=about"><span class="lbl">Minister's Profile</span></a></li> -->
                    @if (checkPermision('cp.content.content.edit,message-from-minister'))
                    <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'message-from-minister']) }}?menu=about"><span class="lbl">Minister's Message</span></a></li>
                    @endif

                    @if (checkPermision('cp.biography.index'))
                    <li class=""><a href="{{ route('cp.biography.index') }}"><span class="lbl">Minister's Biography</span></a></li>
                    @endif

                </ul>
            </li>
            @endif

     
            <!-- <li class="@yield('active-main-menu-press') red with-sub">
                <span>
                    <i class=" font-icon fa fa-book"></i>
                    <span class="lbl"> News</span>
                </span>
                <ul>
                    
                    <li class=""><a href="{{ route('cp.press.index') }}"><span class="lbl">All News</span></a></li>
                    <li class=""><a href="{{ route('cp.press.feature') }}"><span class="lbl">Feature</span></a></li>
                    <li class=""><a href="{{ route('cp.category.index') }}"><span class="lbl">Category</span></a></li>
                </ul>
            </li> -->
            @if (checkPermision('cp.document.index'))
             <li class="@yield('active-main-menu-document') red with-sub">
                <span>
                    <i class=" font-icon fa fa-download"></i>
                    <span class="lbl"> Document</span>
                </span>
                <ul>
                    @if (checkPermision('cp.document.index'))
                    <li class=""><a href="{{ route('cp.document.index') }}"><span class="lbl">Documents</span></a></li>
                    @endif

                    @if (checkPermision('cp.document-category.index'))
                    <li class=""><a href="{{ route('cp.document-category.index') }}"><span class="lbl"> Category</span></a></li>
                    @endif
                </ul>
            </li>
            @endif
          
            @if (checkPermision('cp.automation.index'))
            <li class="red @yield('active-main-menu-automation')">
                <a href="{{ route('cp.automation.index') }}">
                <span>
                    <i class="fa fa-car"></i>
                    <span class="lbl">Public Services</span>
                </span>
                </a>
            </li>
            @endif
            @if (checkPermision('cp.public_work.index'))
            <li class="red @yield('active-main-menu-public-work')">
                <a href="{{ route('cp.public_work.index') }}">
                <span>
                    <i class="fa fa-warning"></i>
                    <span class="lbl">Public Works</span>
                </span>
                </a>
            </li>
            @endif
            @if (checkPermision('cp.contact'))
            <li class="@yield('active-main-menu-contact') red with-sub">
                <span>
                    <i class=" font-icon fa fa-envelope"></i>
                    <span class="lbl"> Contact</span>
                </span>
                <ul>
                    @if (checkPermision('cp.contact.index'))
                    <li class=""><a href="{{ route('cp.contact.index') }}"><span class="lbl">Departments</span></a></li>
                    @endif

                    @if (checkPermision('cp.message.index'))
                    <li class=""><a href="{{ route('cp.message.index') }}"><span class="lbl">Messages</span></a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (checkPermision('cp.website.index'))
            <li class="red @yield('active-main-menu-website')">
                <a href="{{ route('cp.website.index') }}">
                <span>
                    <i class="fa fa-bank"></i>
                    <span class="lbl">Sub Organizations</span>
                </span>
                </a>
            </li>
            @endif
            @if (checkPermision('cp.banner.edit,1'))
            <li class="@yield('active-main-menu-setting') red with-sub">
                <span>
                    <i class=" font-icon fa fa-cog"></i>
                    <span class="lbl"> Setting</span>
                </span>
                <ul>
                    @if (checkPermision('cp.banner.edit,1'))
                    <li class=""><a href="{{ route('cp.banner.edit',1) }}"><span class="lbl">Banner Desktop</span></a></li>
                    @endif

                    @if (checkPermision('cp.banner.edit,2'))
                    <li class=""><a href="{{ route('cp.banner.edit',2) }}"><span class="lbl">Banner Mobile</span></a></li>
                    @endif

                    @if ( checkPermision('cp.content.content.edit,seo-content'))
                    <li class=""><a href="{{ route('cp.content.content.edit', ['slug' => 'seo-content']) }}?menu=setting"><span class="lbl">SEO Content</span></a></li>
                    @endif

                    @if (checkPermision('cp.banner.edit,3'))
                    <li class=""><a href="{{ route('cp.banner.edit',3) }}"><span class="lbl">SEO Image</span></a></li>
                    @endif
                </ul>
            </li>
            @endif
           @if (checkPermision('cp.image.index'))
           <li class="red @yield('active-main-menu-image')">
                <a href="{{ route('cp.image.index') }}">
                <span>
                    <i class="fa fa-desktop"></i>
                    <span class="lbl">Images</span>
                </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->position_id == 1)
            <li class=" @yield('active-main-menu-user') red with-sub">
                <span>
                    <i class=" font-icon fa fa-users"></i>
                    <span class="lbl"> Users</span>
                </span>
                <ul>
                    <li class=""><a href="{{ route('cp.user.user.index') }}"><span class="lbl">User</span></a></li>
                    <li class=""><a href="{{ route('cp.user.permision.index') }}"><span class="lbl">Permision</span></a></li>
                </ul>
            </li>
            @endif
           
        </ul>
    </nav><!--.side-menu-->

@endsection

@section ('content')
    <div class="page-content">
        
        @yield ('page-content')
        
    </div>
@endsection




@section ('bottomjs')
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        @yield ('imageuploadjs')
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/tether/tether.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/lobipanel/lobipanel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/match-height/jquery.matchHeight.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{ asset ('public/user/js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{ asset ('public/user/js/lib/select2/select2.full.min.js')}}"></script>
       <script src="{{ asset ('public/user/js/lib/summernote/summernote.min.js') }}"></script>

       <script>
            $(document).ready(function() {
                $('.summernote').summernote();
            });
        </script>

        <script src="{{ asset ('public/user/js/app.js') }}"></script>
        <script src="{{ asset ('public/user/js/camcyber.js') }}"></script>
        @yield('appbottomjs')

        @if(Session::has('msg'))
        <script type="text/JavaScript">
            toastr.success("{!!Session::get('msg')!!}");
        </script>
        @endif
@endsection