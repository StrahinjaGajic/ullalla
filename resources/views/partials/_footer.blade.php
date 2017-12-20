<section class="corporate-service-area home-4">
    <div class="container">
        <div class="service-wrapp home-4">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12"></div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="single-corporate onl-support">
                        <div class="service-name">
                            <a href="{{ url('privacy_policy') }}"><h3>{{ __('buttons.privacy_policy') }}</h3></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="single-corporate onl-support">
                        <div class="service-name">
                            <a href="{{ url('faq') }}"><h3>{{ __('buttons.faq') }}</h3></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="single-corporate refunds">
                        <div class="service-name">
                            <a href="{{ url('contact') }}"><h3>{{ __('buttons.contact_us') }}</h3></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <p style="margin-top: 25px;">© Webtory 2017. All Rights Reserved.</p>
    </div>
</section>
@include('partials._scripts')
@yield('perPageScripts')