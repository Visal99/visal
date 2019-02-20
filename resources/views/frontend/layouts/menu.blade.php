 <div class="navbar-collapse collapse clearfix">
    <ul class="navigation clearfix">
        <li class="@yield('active-home')"><a href="{{ route('home', $locale)}}">{{__('web.homepage')}}</a></li>
        <li class="dropdown @yield('active-about-us')"><a href="#">{{__('web.about-ministry')}}</a>
            <ul class="padding_ul">
                <li @if( isset($subActive) && $subActive == 'mission-and-vision') class="sub-menu-active" @endif ><a href="{{ route('mission-and-vision', $locale)}}">{{__('web.mission-and-vision')}}</a></li>
                <li @if( isset($subActive) && $subActive == 'the-senior-minister') class="sub-menu-active" @endif ><a href="{{ route('the-senior-minister', $locale)}}">{{__('web.the-senior-minister')}}</a></li>
                <li @if( isset($subActive) && $subActive == 'message-from-minister') class="sub-menu-active" @endif ><a href="{{ route('message-from-minister', $locale)}}">{{__('web.message-from-minister')}}</a></li>
                <li @if( isset($subActive) && $subActive == 'organization-chart') class="sub-menu-active" @endif ><a href="{{ route('organization-chart', $locale)}}">{{__('web.organization-chart')}}</a></li>
            </ul>
        </li>

        @if(isset($defaultData['publicServices']))
            @php($publicServices = $defaultData['publicServices'])
            @if(count($publicServices) > 0)
                <li class="dropdown @yield('active-public-services')"><a href="#">{{__('web.public-services')}}</a>
                    <ul class="padding_ul">
                        @foreach($publicServices as $row)
                        <li @if( isset($subActive) && $subActive == $row->slug) class="sub-menu-active" @endif ><a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif

        @if(isset($defaultData['publicWorks']))
            @php($publicWorks = $defaultData['publicWorks'])
            @if(count($publicWorks) > 0)
                <li class="dropdown @yield('active-public-works')"><a href="#">{{__('web.public-works')}}</a>
                    <ul class="padding_ul">
                        @foreach($publicWorks as $row)
                        <li @if( isset($subActive) && $subActive == $row->slug) class="sub-menu-active" @endif ><a href="{{ route('public-works', ['locale'=>$locale, 'slug'=>$row->slug])}}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif

         @if(isset($defaultData['documentCategories']))
            @php($documentCategories = $defaultData['documentCategories'])
            @if(count($documentCategories) > 0)
                <li class="dropdown @yield('active-documents')"><a href="#">{{__('web.official-documents')}}</a>
                    <ul class="padding_ul">
                        
                        @for( $i =0; $i < sizeOf($documentCategories); $i++)
                            @if(isset($documentCategories[$i]['children']))
                                <li class="dropdown">
                                    <a href="{{ route('documents', ['locale'=>$locale, 'category'=>'' ])}}">{{ $documentCategories[$i]['parent']->title }}</a>
                                    <ul class="padding_ul">
                                        @foreach( $documentCategories[$i]['children'] as $row)
                                        <li><a href="{{ route('documents', ['locale'=>$locale, 'category'=>$row->slug ])}}"> {{ $row->title }} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li @if( isset($subActive) && $subActive == $documentCategories[$i]['parent']->slug) class="sub-menu-active" @endif ><a href="{{ route('documents', ['locale'=>$locale, 'category'=>$documentCategories[$i]['parent']->slug])}}">{{ $documentCategories[$i]['parent']->title }}</a></li>
                            @endif

                        
                        @endfor
                    </ul>
                </li>
            @endif
        @endif


        @if(isset($defaultData['contacts']))
            @php($contacts = $defaultData['contacts'])
            @if(count($contacts) > 0)
                <li class="dropdown @yield('active-contact-us')"><a href="#">{{__('web.contact-us')}}</a>
                    <ul class="padding_ul">
                        @foreach($contacts as $row)
                           <li @if( isset($subActive) && $subActive == $row->slug ) class="sub-menu-active" @endif ><a href="{{ route('contact-us', ['locale'=>$locale, 'category'=>$row->slug])}}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif

       <!--  
       @if(isset($defaultData['newsCategories']))
            @php($newsCategories = $defaultData['newsCategories'])
            @if(count($newsCategories) > 0)
                <li class="dropdown @yield('active-news')"><a href="#">{{__('web.news')}}</a>
                    <ul class="padding_ul">
                        @for( $i =0; $i < sizeOf($newsCategories); $i++)
                            @if(isset($newsCategories[$i]['children']))
                                <li class="dropdown">
                                    <a href="#">{{ $newsCategories[$i]['parent']->title }}</a>
                                    <ul class="padding_ul">
                                        @foreach( $newsCategories[$i]['children'] as $row)
                                        <li @if( isset($subActive) && $subActive == $row->slug ) class="sub-menu-active" @endif ><a href="{{ route('news', ['locale'=>$locale, 'category'=>$row->slug ])}}"> {{ $row->title }} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li @if( isset($subActive) && $subActive == $newsCategories[$i]['parent']->slug ) class="sub-menu-active" @endif ><a href="{{ route('news', ['locale'=>$locale, 'category'=>$newsCategories[$i]['parent']->slug])}}">{{ $newsCategories[$i]['parent']->title }}</a></li>
                            @endif
                        @endfor
                    </ul>
                </li>
            @endif
        @endif
        -->

        <li class="@yield('active-post')"><a href="{{ route('posts', $locale)}}">{{__('web.news')}}</a></li>

        <li class="language visible-lg" style="padding-left:5px;">
            <span style="float:left;padding-top:2px;">
                <a href="{{route($defaultData['routeName'], $defaultData['enRouteParamenters'])}}">
                    <img src="{{ asset('public/frontend/images/en.png') }}" class="img img-responsive margin_au">
                </a>
            </span>
            <span style="float:right;color:#fff;margin-left:3px;">
                <a href="{{route($defaultData['routeName'], $defaultData['enRouteParamenters'])}}">EN</a>
            </span>
        </li>
        <li class="language visible-lg" style="">
            <span style="float:left;padding-top:2px;">
                <a href="{{route($defaultData['routeName'], $defaultData['khRouteParamenters'])}}">
                    <img src="{{ asset('public/frontend/images/kh.png') }}" class="img img-responsive margin_au">
                </a>
            </span> 
            <span style="float:right;color:#fff;margin-left:3px;">
                <a href="{{route($defaultData['routeName'], $defaultData['khRouteParamenters'])}}" class="kh_font">ខ្មែរ</a>
            </span>
        </li>

        <li class="language visible-md visible-sm visible-xs">
            <span>
                <a href="{{route($defaultData['routeName'], $defaultData['khRouteParamenters'])}}" style="padding: 7px;">
                    <img src="{{ asset('public/frontend/images/kh.png') }}" class="font_margin margin_au">
                </a>
                <a href="{{route($defaultData['routeName'], $defaultData['enRouteParamenters'])}}" style="padding: 5px;">
                    <img src="{{ asset('public/frontend/images/en.png') }}" class="font_margin margin_au">
                </a>
            </span>
        </li>
    </ul>
</div>