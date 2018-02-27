<head>
    <link rel="stylesheet" href="{{ asset('css/components/home_nav.css') }}">
</head>

<header id="toTop">
    <div class="header-area home-4">
        <div class="container">
            <div class="fixed logo-img home-1">
                <img id="home_logo" src="{{ asset('img/logo/logo.png') }}" alt="">
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="top-menu-area hidden-sm hidden-xs">
                        <div class="mainmenu home-4">
                            <nav>
                                <ul>
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
                                    @if($user && $user->has_profile == 1)
                                    @if(Auth::guard('local')->user())
                                    <li><a href="{{ url('locals/@' . $user->username . '/contact') }}">{{ __('buttons.settings') }}</a></li>
                                    <li><a href="{{ url('locals/' . $user->username) }}">{{ __('buttons.preview_profile') }}</a></li>
                                    @elseif(Auth::user())
                                    <li><a href="{{ url('private/' . $user->id . '/bio') }}">{{ __('buttons.settings') }}</a></li>
                                    <li><a href="{{ url('private/' . $user->id) }}">{{ __('buttons.preview_profile') }}</a></li>
                                    <li><a href="{{ url('prices') }}">{{ __('buttons.prices') }}</a></li>
                                    {{-- <li><a href="{{ url('private/blackbook') }}">{{ __('headings.blackbook') }}</a></li> --}}
                                    @endif
                                    @endif
                                    @if($user && $user->has_profile == 0)
                                    @if(Auth::guard('local')->user())
                                    <li><a href="{{ url('locals/@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                    @elseif(Auth::user())
                                    <li><a href="{{ url('private/' . $user->id .'/create') }}">{{ __('buttons.create_profile') }}</a></li>
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
                                                        <span>{{ $language }}</span>
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
            <div class="mobile-menu-area home-4 visible-sm visible-xs">
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
                                        @if($user && $user->has_profile == 1)
                                        @if(Auth::guard('local')->user())
                                        <li><a href="{{ url('locals/@' . $user->username . '/contact') }}">{{ __('buttons.settings') }}</a></li>
                                        <li><a href="{{ url('locals/' . $user->username) }}">{{ __('buttons.preview_profile') }}</a></li>
                                        @elseif(Auth::user())
                                        <li><a href="{{ url('private/' . $user->id . '/bio') }}">{{ __('buttons.settings') }}</a></li>
                                        <li><a href="{{ url('private/' . $user->id) }}">{{ __('buttons.preview_profile') }}</a></li>
                                        <li><a href="{{ url('prices') }}">{{ __('buttons.prices') }}</a></li>
                                        {{--<li><a href="{{ url('private/blackbook') }}">{{ __('headings.blackbook') }}</a></li>--}}
                                        @endif
                                        @endif
                                        @if($user && $user->has_profile == 0)
                                        @if(Auth::guard('local')->user())
                                        <li><a href="{{ url('locals/@' . $user->username . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
                                        @elseif(Auth::user())
                                        <li><a href="{{ url('private/' . $user->id . '/create') }}">{{ __('buttons.create_profile') }}</a></li>
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
                                                            <span>{{ $language }}</span>
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