<header>
<header id="toTop">
    <div class="header-area home-1 shop-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo-img home-1">
                        <a href="/"><img src="/img/logo/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="top-menu-area">
                        <div class="mainmenu hidden-sm hidden-xs">
                            <nav>
                                <ul style="text-align: center;">
                                    @php
                                    $user = null;
                                    if (Auth::user()) {
                                        $user = Auth::user();
                                    } elseif (Auth::guard('local')->user()) {
                                        $user = Auth::guard('local')->user();
                                    }
                                    @endphp
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ url('locals') }}">Locals</a></li>
                                    <li><a href="{{ url('girls') }}">Girls</a></li>
                                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                                    @if(!Auth::check() && !Auth::guard('local')->check())
                                    <li><a href="{{ url('signin') }}">Sign In</a></li>
                                    <li><a href="{{ url('signup') }}">Sign Up</a></li>
                                    @else
                                    @if($user && $user->approved == '1')
                                        @if(Auth::guard('local')->user())
                                                <li><a href="{{ url('locals/@' . $user->username . '/contact') }}">Profile</a></li>
                                        @elseif(Auth::user())
                                                <li><a href="{{ url('@' . $user->username . '/bio') }}">Profile</a></li>
                                        @endif
                                    @endif
                                    @if($user && !$user->package1_id)
                                        @if(Auth::guard('local')->user())
                                                <li><a href="{{ url('locals/@' . $user->username . '/create') }}">Create Profile</a></li>
                                        @elseif(Auth::user())
                                                <li><a href="{{ url('@' . $user->username . '/create') }}">Create Profile</a></li>
                                        @endif
                                    @endif
                                    <li><a href="{{ url('signout') }}">Sign Out</a></li>
                                    @endif
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            @php 
                                            $currentLanguage = Session::has('locale') ? asset('flags/4x3/' . Session::get('locale') . '.svg') : asset('flags/4x3/de.svg');
                                            @endphp
                                            <img style="margin-bottom: 3px;" src="{{ $currentLanguage }}" alt="" height="10" width="20">
                                            <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                @foreach(getLanguages() as $key => $language)
                                                <li>
                                                    <a href="{{ url('change_language/' . $key) }}">
                                                        <img style="margin-bottom:1px" src="{{ asset('flags/4x3/' . $key . '.svg') }}" alt="" height="10" width="20">
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
                                        <li><a href="">Home</a></li>
                                        <li><a href="/local/">Lokale</a></li>
                                        <li><a href="/profile/">Private</a></li>
                                        <li><a href="/faq/">FAQ</a></li>
                                        <li><a href="">Login</a></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="flag-icon flag-icon-{{-- {{ tran() }} --}}"></span>
                                                <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="/de"><span class="flag-icon flag-icon-de"></span> De</a></li>
                                                    <li><a href="/en"><span class="flag-icon flag-icon-en"></span> En</a></li>
                                                    <li><a href="/it"><span class="flag-icon flag-icon-it"></span> It</a></li>
                                                    <li><a href="/fr"><span class="flag-icon flag-icon-fr"></span> Fr</a></li>
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