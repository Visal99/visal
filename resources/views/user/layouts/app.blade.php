@extends('user/layouts.master')

@section ('headercss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/bootstrap-sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/summernote/summernote.css') }}"/>
     <script type="text/javascript" src="{{ asset ('public/user/js/lib/jquery/jquery.min.js') }}"></script>
     <link rel="stylesheet" href="{{ asset ('public/user/css/lib/datatables-net/datatables.min.css') }}">
    @yield('appheadercss')
@endsection

@section ('headerjs')
    @yield('appheaderjs')
@endsection

@section ('bodyclass')
    class="with-side-menu control-panel control-panel-compact"
@endsection

@section ('header')
<style type="text/css">
    .active{
        /*background-color: #dcd9d9;*/
    }
</style>

<header class="site-header">
    <div class="container-fluid">
        <a target="_blank" href="{{ url('/') }}" class="site-logo">
            <img class="hidden-md-down" src="{{ asset ('public/user/img/logo.png') }}" alt="">
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
                            <img src="{{ asset (Auth::user()->image) }}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="{{ route('user.profile.edit') }}"><span class="fa fa-user"></span> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.auth.logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
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
            <li class="@yield('active-main-menu-home') red with-sub">
                <span>
                    <i class=" font-icon fa fa-home"></i>
                    <span class="lbl"> Home</span>
                </span>
                <ul>
                    <!-- <li class=""><a href="{{ route('user.slide.list') }}"><span class="lbl">Slides</span></a></li> -->
                    <li class=""><a href="{{ route('user.video.edit', 1) }}"><span class="lbl">Video</span></a></li>
                    
                    <li class=""><a href="{{ route('user.content.edit', ['slug' => 'minister-message']) }}?menu=home"><span class="lbl">Mister's Message</span></a></li>
                    <li class=""><a href="{{ route('user.content.edit', ['slug' => 'automation-systems']) }}?menu=home"><span class="lbl">Automation Systems</span></a></li>
                    <li class=""><a href="{{ route('user.content.edit', ['slug' => 'minister-message-homepage']) }}?menu=home"><span class="lbl">Mister's Message Detail</span></a></li>
                </ul>
            </li>

            
            <li class="red">
                <a href="{{ route('user.content.list', ['page' => 'about']) }}?menu=about&page=about">
                <span>
                    <i class="fa fa-user"></i>
                    <span class="lbl">About</span>
                </span>
                </a>
            </li>
           
           <li class="red @yield('active-main-menu-organization')">
                <a href="{{ route('user.organization.edit', 1) }}">
                <span>
                    <i class="fa fa-building-o"></i>
                    <span class="lbl">Organization</span>
                </span>
                </a>
            </li>
            <li class="@yield('active-main-menu-press') red">
                <a href="{{ route('user.presses.list') }}">
                <span>
                    <i class="fa fa-book"></i>
                    <span class="lbl">Press</span>
                </span>
                </a>
            </li>
            <!-- <li class="red opened">
                <a href="{{ route('user.album.list') }}">
                <span>
                    <i class="fa fa-file-image-o"></i>
                    <span class="lbl">Album</span>
                </span>
                </a>
            </li> -->
            <li class="@yield('active-main-menu-document') red">
                <a href="{{ route('user.document.list') }}">
                <span>
                    <i class="fa fa-dashcube"></i>
                    <span class="lbl">Document</span>
                </span>
                </a>
            </li>
             <li class="@yield('active-main-menu-automation-system') red">
                <a href="{{ route('user.automation-system.list') }}">
                <span>
                    <i class="fa fa-car"></i>
                    <span class="lbl">Automation Sytem</span>
                </span>
                </a>
            </li>
            <li class="@yield('active-main-menu-public-word') red">
                <a href="{{ route('user.public-work.list') }}">
                <span>
                    <i class="fa fa-warning"></i>
                    <span class="lbl">Public Work</span>
                </span>
                </a>
            </li>
           <!--  <li class="red">
                <a href="{{ route('user.project.list') }}">
                <span>
                    <i class="fa fa-cubes"></i>
                    <span class="lbl">Project</span>
                </span>
                </a>
            </li> -->
            
            <!-- <li class="red">
                <a href="{{ route('user.partnership.list') }}">
                <span>
                    <i class="fa fa-user-plus"></i>
                    <span class="lbl">Partnership</span>
                </span>
                </a>
            </li> -->
            


             <li class="@yield('active-main-menu-contact') red with-sub">
                <span>
                    <i class=" font-icon fa fa-envelope"></i>
                    <span class="lbl"> Contact</span>
                </span>
                <ul>
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'ministry-headquarters', 'department'=> '']) }}"><span class="lbl">Ministry Headquarters</span></a></li>
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'general-inspectorate ', 'department'=> '']) }}"><span class="lbl">General Inspectorate</span></a></li>
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'financial-minitoring-unit', 'department'=> '']) }}"><span class="lbl">Financial Monitoring Unit</span></a></li>
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'procument-unit', 'department'=> '']) }}"><span class="lbl">Procument Unit</span></a></li>
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'automation-system-support', 'department'=> '']) }}"><span class="lbl">Automation Support</span></a></li>
                    <li class="@yield('active-main-menu-contact-department') with-sub">
                        <span>
                            <span class="lbl">Departments</span>
                        </span>
                        <ul style="">
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'department-of-information-technology-and-public-relation', 'department'=> '']) }}">Information Technology and Public Relation</a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'department-of-internal-audit', 'department'=> '']) }}">Internal Audit</a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'department-of-railway', 'department'=> '']) }}">Railway</a></li>

                        </ul>
                    </li>
                    <li class="@yield('active-main-menu-contact-general-department') with-sub">
                        <span>
                            <span class="lbl">General Departments</span>
                        </span>
                        <ul style="">
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-administration-and-finance', 'department'=> '']) }}"><span class="lbl">Administration and Finance</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-planning-and-policy', 'department'=> '']) }}"><span class="lbl">Planning and Policy</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-techniques', 'department'=> '']) }}"><span class="lbl">Techniques</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-public-works', 'department'=> '']) }}"><span class="lbl">Public Works</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-land-transport', 'department'=> '']) }}"><span class="lbl">Land Transport</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-Waterway-Martime-Transport-Ports ', 'department'=> '']) }}"><span class="lbl">Waterway, Martime, Transport, Ports</span></a></li>
                            <li><a href="{{ route('user.contact.contact', ['contacts' => 'general-department-of-logistics', 'department'=> '']) }}"><span class="lbl">Logistics</span></a></li>
                        </ul>
                    </li>
                    
                    <li class=""><a href="{{ route('user.contact.contact', ['contacts' => 'provincial-departments', 'department'=> '']) }}"><span class="lbl">Provincial Departments</span></a></li>
                </ul>
            </li>
             <li class="@yield('active-main-menu-image') red">
                <a href="{{ route('user.images.list') }}">
                <span>
                    <i class="fa fa-upload"></i>
                    <span class="lbl">Image Upload</span>
                </span>
                </a>
            </li>
           
            <li class="@yield('active-main-menu-user') red">
                <a href="{{ route('user.user.list') }}">
                <span>
                    <i class="fa fa-users"></i>
                    <span class="lbl">User</span>
                </span>
                </a>
            </li>
            
           
        </ul>
    </nav><!--.side-menu-->

@endsection

@section ('content')
    <div class="page-content">
        
        @yield ('page-content')
        
    </div>
@endsection

@section ('modal')
  
@endsection

    @section ('bottomjs')
        
        <script src="{{ asset ('public/user/js/lib/datatables-net/datatables.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        @yield ('imageuploadjs')
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/tether/tether.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/jqueryui/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/lobipanel/lobipanel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/match-height/jquery.matchHeight.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset ('public/user/js/lib/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{ asset ('public/user/js/lib/summernote/summernote.min.js') }}"></script>
         <script src="{{ asset ('public/user/js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{ asset ('public/user/js/lib/select2/select2.full.min.js')}}"></script>

        <script>
            $(document).ready(function() {
                $('.summernote').summernote();
            });
        </script>
            
        @yield('appbottomjs')
        <script src="{{ asset ('public/user/js/app.js') }}"></script>
        <script src="{{ asset ('public/user/js/camcyber.js') }}"></script>

        <script type="text/JavaScript">
            @if(Session::has('msg'))
                toastr.success("{!!Session::get('msg')!!}");
            @endif
        </script>
@endsection