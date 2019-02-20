
                            <nav class="main-menu">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->      
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    </button>
                                </div>
                                
                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li class="small-logo-cnt" ><a href="{{ route('home', ['locale'=>$locale]) }}" style="margin:0px; padding:5px !important; background:none"><img src="{{ asset('public/frontend/images/mpwt/logo-small.png') }}" style="max-width:50px" /></a></li>
                                        <li><a href="{{ route('home', ['locale'=>$locale]) }}">{{ __('general.home') }}</a></li>
                                        <li class="dropdown" onclick="window.location.href='{{ route('press-category', ['locale'=>$locale, 'category'=>'']) }}'"><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'']) }}">{{ __('general.press') }}</a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'announcement']) }}">{{ __('general.announcement') }}</a></li>
                                                <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'public-works']) }}">{{ __('general.public-works') }}</a></li>
                                                <li class="dropdown"><a href="#">{{ __('general.public-services') }}</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'road-transport']) }}">{{ __('general.road-transport') }}</a></li>
                                                        <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'water-way-transport']) }}">{{ __('general.water-way-transport') }}</a></li>
                                                        <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'marine-transport']) }}">{{ __('general.marine-transport') }}</a></li>
                                                        <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'railways-transport']) }}">{{ __('general.railways-transport') }}</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'road-safety']) }}">{{ __('general.road-safety') }}</a></li>
                                                <li><a href="{{ route('press-category', ['locale'=>$locale, 'category'=>'picture-collections']) }}">{{ __('general.picture-collections') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown" ><a href="#">{{ __('general.automation-systems') }}</a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'vehicle-registration']) }}">{{ __('general.vehicle-registration') }}</a></li>
                                                <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'technical-inspection']) }}">{{ __('general.technical-inspection') }}</a></li>
                                                <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'transport-licensing']) }}">{{ __('general.transport-licensing') }}</a></li>
                                                <li><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'driver-license']) }}">{{ __('general.driver-license') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown" ><a href="#">{{ __('general.public-works') }} </a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'expressways']) }}">{{ __('general.expressways') }} </a></li>
                                                <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'sewage-systems']) }}">{{ __('general.sewage-systems') }}</a></li>
                                                <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-infrastructure']) }}">{{ __('general.road-infrastructure') }}</a></li>
                                                <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'public-works-technical']) }}">{{ __('general.public-works-technical') }}</a></li>
                                                <li><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-map']) }}">{{ __('general.road-map') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown" ><a href="#">{{ __('general.laws-and-regulations') }}</a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'road-transport']) }}">{{ __('general.road-transport') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'road-safety']) }}">{{ __('general.road-safety') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'logistics']) }}">{{ __('general.logistics') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'railways']) }}">{{ __('general.railways') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'public-works']) }}">{{ __('general.public-works') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'port-water-way-and-marine-transport']) }}">{{ __('general.port') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'planning-and-policies']) }}">{{ __('general.planning-and-policies') }}</a></li>
                                                <li><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>'other']) }}">{{ __('general.other') }}</a></li>
                                            </ul>
                                        </li>
                                       <li class="dropdown" ><a href="#">{{ __('general.about') }}</a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'background']) }}">{{ __('general.background') }}</a></li>
                                                <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'mission-and-vision']) }}">{{ __('general.mission-and-vision') }}</a></li>
                                                <li><a href="{{ route('about-us', ['locale'=>$locale, 'slug'=>'minister']) }}">{{ __('general.minister') }}</a></li>
                                                <li><a href="#">{{ __('general.leader') }}</a></li>
                                                <li><a href="#">{{ __('general.organization-chart') }}</a></li>
                                                <li><a href="#">{{ __('general.achievement') }} </a></li>
                                            </ul>
                                        </li>
                                        <!--
                                        <li class="dropdown" ><a href="#">{{ __('general.contact-us') }}</a>
                                            <ul class="padding_ul">
                                                <li><a href="{{ route('contact-us', ['locale'=>$locale, 'type'=>'ministry-headquarters']) }}">{{ __('general.ministry-headquarters') }}</a></li>
                                                <li class="dropdown"><a href="#">{{ __('general.provincial-department') }}</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#">Province 1</a></li>
                                                        <li><a href="#">Province 2</a></li>
                                                        <li><a href="#">Province 3</a></li>
                                                        <li><a href="#">Province 4</a></li>
                                                        <li><a href="#">Province 5</a></li>
                                                        <li><a href="#">Province 6</a></li>
                                                        <li><a href="#">Province 7</a></li>
                                                        <li><a href="#">Province 8</a></li>
                                                        <li><a href="#">Province 9</a></li>
                                                        <li><a href="#">Province 10</a></li>
                                                        <li><a href="#">Province 11</a></li>
                                                        <li><a href="#">Province 12</a></li>
                                                        <li><a href="#">Province 13</a></li>
                                                        <li><a href="#">Province 14</a></li>
                                                        <li><a href="#">Province 15</a></li>
                                                        <li><a href="#">Province 16</a></li>
                                                        <li><a href="#">Province 17</a></li>
                                                        <li><a href="#">Province 18</a></li>
                                                        <li><a href="#">Province 19</a></li>
                                                        <li><a href="#">Province 20</a></li>
                                                        <li><a href="#">Province 21</a></li>
                                                        <li><a href="#">Province 22</a></li>
                                                        <li><a href="#">Province 23</a></li>
                                                        <li><a href="#">Province 24</a></li>
                                                        <li><a href="#">Province 25</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Administration and Finance</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Administration</a></li>
                                                        <li><a href="#"> Department of Personnel Affairs</a></li>
                                                        <li><a href="#"> Department of Finance</a></li>
                                                        <li><a href="#"> Department of International Cooperation</a></li>
                                                        <li><a href="#"> Department of Legal Affairs</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Planning and Policy</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Planning</a></li>
                                                        <li><a href="#"> Department of Information System Management</a></li>
                                                        <li><a href="#"> Department of Monitoring and Evaluation</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Techniques</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Road Infrastructure</a></li>
                                                        <li><a href="#"> Department of Public Infrastructure</a></li>
                                                        <li><a href="#"> Department of Techniques for Public Works and Transport</a></li>
                                                        <li><a href="#"> National Institute of Technical Training for Public Works and Transport</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Public Works</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Expressway, Bridge and Investment</a></li>
                                                        <li><a href="#"> Department of Sewage System and Engineering</a></li>
                                                        <li><a href="#"> Department of Equipment and Road Construction</a></li>
                                                        <li><a href="#"> Department of Repair and Maintence</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Land Transport</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Land Transport</a></li>
                                                        <li><a href="#"> Department of Road Safety</a></li>
                                                        <li><a href="#"> Department of Urban Public Transport</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Waterway, Martime, Transport, Ports</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Waterway Transport</a></li>
                                                        <li><a href="#"> Department of Maritime Transport</a></li>
                                                        <li><a href="#"> Department of Port Administration</a></li>
                                                        <li><a href="#"> Department of Waterway Infrstructure and Port Construction</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="#">General Department of Logistics</a>
                                                    <ul class="padding_ul">
                                                        <li><a href="#"> Department of Logistics Informaion</a></li>
                                                        <li><a href="#"> Department of Logistics</a></li>
                                                        <li><a href="#"> Department of Logistics Cooperation</a></li>
                                                        <li><a href="#"> Department of Survey and Reports</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">General Inspectorate</a></li>
                                                <li><a href="#">Department of Information Technology and Public Relation</a></li>
                                                <li><a href="#">Financial Monitoring Unit</a></li>
                                                <li><a href="#">Department of Internal Audit</a></li>
                                                <li><a href="#">Department of Railway</a></li>
                                                <li><a href="#">Procument Unit</a></li>
                                                
                                                <li><a href="{{ route('contact-us', ['locale'=>$locale, 'type'=>'support-line-for-automation-systems']) }}">{{ __('general.support-line-for-automation-systems') }}</a></li>
                                                
                                            </ul>
                                        </li>
                                        -->
                                         <li class="dropdown" ><a href="#">{{ __('general.contact-us') }}</a>
                                            <ul class="padding_ul">
                                                @foreach($defaultData['contact_menu'] as $menu)
                                                    @if( count( $menu['departments'] ) == 1 )
                                                        <li><a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$menu['departments'][0]->slug]) }}">{{ $menu['title'] }}</a></li>
                                                    @elseif( count( $menu['departments'] ) > 1 )
                                                        <li class="dropdown"><a href="#">{{ $menu['title'] }}</a>
                                                            <ul class="padding_ul">
                                                                @foreach( $menu['departments'] as $department)
                                                                <li><a href="{{ route('contact-us', ['locale'=>$locale, 'slug'=>$department->slug]) }}"> {{ $department->title }} </a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                
                                                
                                            </ul>
                                        </li>

                                        <li class="language visible-lg" style="padding:10px;"><span style="float:left;"><a href="{{ route('home', ['locale'=>'en']) }}"><img src="http://localhost/CamCyber/mpwt/web/public/frontend/images/mpwt/flag/en.png" class="img img-responsive margin_au"></a></span> <span style="float:right;color:#fff;">EN</span></li>
                                        <li class="language visible-lg" style="padding:10px;"><span style="float:left;"><a href="{{ route('home', ['locale'=>'kh']) }}"><img src="http://localhost/CamCyber/mpwt/web/public/frontend/images/mpwt/flag/kh.png" class="img img-responsive margin_au"></a></span> <span style="float:right;color:#fff;">ភាសាខ្មែរ</span></li>
                                        <li class="language visible-md visible-sm visible-xs"><span><a href="{{ route('home', ['locale'=>'kh']) }}"><img src="http://localhost/CamCyber/mpwt/web/public/frontend/images/mpwt/flag/kh.png" class="img img-responsive margin_au"></a><a href="{{ route('home', ['locale'=>'en']) }}"><img src="http://localhost/CamCyber/mpwt/web/public/frontend/images/mpwt/flag/en.png" class="img img-responsive margin_au"></a></span></li>
                                    </ul>
                                </div>
                            </nav>