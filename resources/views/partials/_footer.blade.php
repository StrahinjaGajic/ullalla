<section class="corporate-service-area home-4">
    <div class="container">
        <div class="service-wrapp home-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-corporate onl-support text-right">
                        <div class="service-name">
                            <a href="{{ url('privacy_policy') }}"><h3>{{ __('buttons.privacy_policy') }}</h3></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-corporate onl-support">
                        <div class="service-name">
                            <a href="/impressum"><h3>{{ __('buttons.impressum') }}</h3></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-corporate refunds text-left">
                        <div class="service-name">
                            <a href="{{ url('contact') }}"><h3>{{ __('buttons.contact_us') }}</h3></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <p style="font-size: 12px;"><a href="{{ url('http://www.mpsoft.ch') }}">© MP Soft</a> 2018. All Rights Reserved.</p>
    </div>
</section>
@include('partials._scripts')
@yield('perPageScripts')