<header>
    <header id="toTop">
        <div class="header-area home-1 shop-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="logo-img home-1">
                            <a href="/"><img src="{{ asset('img/logo/logo.png') }}" alt="" width="103px;" height="50px;"></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <div class="top-menu-area">
                            <div class="mainmenu hidden-sm hidden-xs">
                                <nav>
                                    <ul style="text-align: right;">
                                        @php
                                        $user = null;
                                        if (Auth::user()) {
                                            $user = Auth::user();
                                        } elseif (Auth::guard('local')->user()) {
                                            $user = Auth::guard('local')->user();
                                        }
                                        @endphp
                                        <li><a href="/">{{ __('buttons.home') }}</a></li>
                                        <li><a href="{{ url('locals') }}">{{ __('buttons.locals') }}</a></li>
                                        <li><a href="{{ url('private') }}">{{ __('buttons.private') }}</a></li>
                                        @if(!Auth::check() && !Auth::guard('local')->check())
                                            <li><a href="{{ url('signin') }}">{{ __('buttons.login') }}</a></li>
                                            <li><a href="{{ url('signup') }}">{{ __('buttons.register') }}</a></li>
                                        @else
                                            @if($user && $user->approved == '1')
                                                @if(Auth::guard('local')->user())
                                                    <li><a href="{{ url('locals/@' . $user->username . '/contact') }}">{{ __('buttons.profile') }}</a></li>
                                                @elseif(Auth::user())
                                                    <li><a href="{{ url('@' . $user->username . '/bio') }}">{{ __('buttons.profile') }}</a></li>
                                                @endif
                                            @endif
                                            @if($user && !$user->package1_id)
                                                @if(Auth::guard('local')->user())
                                                    <li><a href="{{ url('locals/@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                                @elseif(Auth::user())
                                                    <li><a href="{{ url('@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                                @endif
                                            @endif
                                            <li><a href="{{ url('signout') }}">{{ __('buttons.logout') }}</a></li>
                                        @endif
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                @php 
                                                $currentLanguage = Session::has('locale') ? asset('flags/4x3/' . Session::get('locale') . '.svg') : asset('flags/4x3/de.svg');
                                                @endphp
                                                <img style="margin-bottom: 1px;" src="{{ $currentLanguage }}" alt="" height="10" width="20">
                                                <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    @foreach(getLanguages() as $key => $language)
                                                    <li>
                                                        <a href="{{ url('change_language/' . $key) }}">
                                                            <img style="margin-bottom: 1px;" src="{{ asset('flags/4x3/' . $key . '.svg') }}" alt="" height="10" width="20">
                                                            <span>{{ __('global.' . strtolower($language)) }}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area visible-sm visible-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 visible-sm visible-xs">
                                <div class="mobile-menu">
                                    <nav id="dropdown">
                                        <ul>
                                         <li><a href="/">{{ __('buttons.home') }}</a></li>
                                         <li><a href="{{ url('locals') }}">{{ __('buttons.locals') }}</a></li>
                                         <li><a href="{{ url('private') }}">{{ __('buttons.private') }}</a></li>
                                         @if(!Auth::check() && !Auth::guard('local')->check())
                                         <li><a href="{{ url('signin') }}">{{ __('buttons.login') }}</a></li>
                                         <li><a href="{{ url('signup') }}">{{ __('buttons.register') }}</a></li>
                                         @else
                                         @if($user && $user->approved == '1')
                                         @if(Auth::guard('local')->user())
                                         <li><a href="{{ url('locals/@' . $user->username . '/contact') }}">{{ __('buttons.profile') }}</a></li>
                                         @elseif(Auth::user())
                                         <li><a href="{{ url('@' . $user->username . '/bio') }}">{{ __('buttons.profile') }}</a></li>
                                         @endif
                                         @endif
                                         @if($user && !$user->package1_id)
                                         @if(Auth::guard('local')->user())
                                         <li><a href="{{ url('locals/@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                         @elseif(Auth::user())
                                         <li><a href="{{ url('@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                         @endif
                                         @endif
                                         <li><a href="{{ url('signout') }}">{{ __('buttons.logout') }}</a></li>
                                         @endif
                                         <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                <img src="{{ $currentLanguage }}" alt="" height="10" width="20">
                                                <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    @foreach(getLanguages() as $key => $language)
                                                    <li>
                                                        <a href="{{ url('change_language/' . $key) }}">
                                                            <img src="{{ asset('flags/4x3/' . $key . '.svg') }}" alt="" height="10" width="20">
                                                            <span>{{ __('global.' . strtolower($language)) }}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>