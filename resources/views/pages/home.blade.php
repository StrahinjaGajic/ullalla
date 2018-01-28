@extends('layouts.app')

@section('content')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('css/components/home.css?ver=' . str_random(10)) }}">
@stop

<section class="slider-area home-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="bend niceties preview-1 ho_4">
                    <div id="ensign-nivoslider" class="slides">
                        <img src="/img/sliders/S-7.jpg" alt="" title="#slider-direction-1"  />
                        <img src="/img/sliders/S-8.jpg" alt="" title="#slider-direction-2"  />
                    </div>
                    <div id="slider-direction-1" class="t-cn slider-direction slider-one">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <div class="fas7-slider-content">
                                        <div class="layer-1-1">
                                            <h5 class="title1">{{ __('headings.this_banner_is') }}</h5>
                                        </div>
                                        <div class="layer-1-2">
                                            <h2 class="title2">
                                                <span class="fashion-1"><span class="fas-for">1170x</span><span class="fas-man">390</span></span>
                                            </h2>
                                        </div>
                                        <div class="layer-1-3">
                                            <p class="title3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br>eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim veniam, quis nostrud.</p>
                                        </div>
                                        <div class="layer-1-4">
                                            <a class="shop-n" href="/">{{ __('global.shop_now') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-2" class="slider-direction slider-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <div class="fas8-slider-content">
                                        <div class="layer-2-1">
                                            <h5 class="title1">{{ __('headings.this_one_is_also') }}</h5>
                                        </div>
                                        <div class="layer-2-2">
                                            <h2 class="title2">
                                                <span class="fashion-1">1170x390</span>
                                            </h2>
                                        </div>
                                        <div class="layer-2-3">
                                            <p class="title3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do<br> eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim veniam, quis nostrud.</p>
                                        </div>
                                        <div class="layer-2-4">
                                            <a class="shop-n" href="/">{{ __('global.go_now') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="banner-area home-4-2">
    <div class="container">
        <div class="row">
            {!! Form::open(['url' => 'search', 'method' => 'get']) !!}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height: 100%; margin-bottom: 30px;">
                <span class="search"><h3 id="search_heading">{{ __('headings.quick_search') }}</h3></span>
                <div class="containere">
                    <div class="checkbox-tile-group">
                        @foreach(getQuickSearchTypes() as $key => $userType)
                        <div class="input-container">
                            <input class="checkbox-button" type="checkbox" name="type" value="{{ $userType }}" />
                            <div class="checkbox-tile">
                                <i class="fa fa-{{ $key }} fa-2x"></i>
                                <label for="female" class="checkbox-tile-label">{{ $userType }}</label>
                            </div>
                        </div>
                        @endforeach
                        <div class="help-block">
                            @if($errors->has('type'))
                            {{ $errors->first('type') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="containere1">
                    <div class="region">
                    </div>
                    
                    <div class="region geolocation">
                        <input name="city" id="city" placeholder="{{ __('fields.city') }}" class="form-control">
                        <a onclick="getLocation();" class="geolocation-button">
                            <button type="button" class="btn go"><div class="span">Go!</div></button> 
                        </a>

                        <div class="help-block">
                            @if($errors->has('city'))
                            {{ $errors->first('city') }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="amount">{{ __('fields.radius') }}:</label>
                            <div class="location-inputs">
                                <input type="hidden" name="radius" value="{{ old('radius') }}">
                            </div>
                            <div id="radius-ranger" style="margin: 10px;"></div>
                            <div class="slider-value-wrapper">
                                <span class="radius">{{ old('radius') ? old('radius') : 0 }}</span>
                                <span>{{ __('global.km') }}</span>
                            </div>
                            <div class="help-block">
                                @if($errors->has('radius'))
                                {{ $errors->first('radius') }}
                                @endif
                            </div>
                        </div>
                                        <div style="width: 101%; text-align: center; margin-top: 14px;"><button type="submit" class="button3 button4">{{ __('buttons.search') }}</button></div>
                    </div>
                </div>
                {{ csrf_field() }}
            </div>
            {!! Form::close() !!}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="single-banner home-3">
                    <a class="right-banner" href="/#"></a>
                </div>
            </div>
        </div>
    </div>
    @if($totm->count() > 0)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-heading pro-title blog-margin">
                        <h3>{{ __('headings.gotm') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="featured-product-carousel single-indicator">
                    @foreach($gotm as $user)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img">
                                    <img class="primary-img" src="{{ $user->photos . 'nth/0/-/resize/263x300/' }}" alt="" />
                                </a>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">{{ $user->nickname }}</a>
                                <div class="pro-price">
                                    <p>{{ __('global.short_info') }}</p>
                                </div>
                                <a href="{{ url('private/' . $user->nickname) }}"><div class="product-cart">
                                    <button class="button">{{ __('buttons.view_profile') }}</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($totm->count() > 0)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-heading pro-title blog-margin">
                        <h3>{{ __('headings.totm') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="featured-product-carousel single-indicator">
                    @foreach($gotm as $user)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img">
                                    <img class="primary-img" src="{{ $user->photos . 'nth/0/-/resize/263x300/' }}" alt="" />
                                </a>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">{{ $user->nickname }}</a>
                                <div class="pro-price">
                                    <p>{{ __('global.short_info') }}</p>
                                </div>
                                <a href="{{ url('private/' . $user->nickname) }}"><div class="product-cart">
                                    <button class="button">{{ __('buttons.view_profile') }}</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <div class="banner-area-2 home-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left_set">
                    <div class="single-banner home-3">
                        <div class="sb-wrapper">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                        </div>
                        <div class="sb-wrapper">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 right_set">
                    <div class="single-banner home-3">
                        <div class="sb-wrapper">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                        </div>
                        <div class="sb-wrapper">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                <a href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
@php 
    $title = 'title_'. config()->get('app.locale');
    $note = 'note_'. config()->get('app.locale');
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

@if(Session::has('account_created'))
    <script>
        swal(
            '{{ __('headings.account_created_title') }}',
            '{{ Session::get('account_created') }}',
            'success'
        );
    </script>
@endif

@if((Session::has('localDefaultPackageExpired') && $localDefaultPackageExpired) && Session::has('lotm_expired_package_info'))
    <script>
        swal.queue([{
            title: '{{ __('headings.package_expiration_title') }}',
            confirmButtonText: '{{ __('buttons.close') }}',
            html: '{!! __('messages.package_about_to_expire', [
            'note' => $localDefaultPackageExpired->$note,
            'url' => url('locals/@' . Auth::guard('local')->user()->username . '/packages')
            ]) !!}',
            type: 'warning',
            showLoaderOnConfirm: true,
            preConfirm: () => {
            return swal({
                title: '{{ __('headings.default_error_title') }}',
                html: '{!! Session::get('lotm_expired_package_info') !!}',
                type: 'warning'
            })
        }
        }]);
    </script>
@elseif(Session::has('lotm_expired_package_info'))
    <script>
        swal(
            '{{ __('headings.default_error_title') }}',
            '{!! Session::get('lotm_expired_package_info') !!}',
            'warning'
        );
    </script>
@elseif((Session::has('localDefaultPackageExpired') && $localDefaultPackageExpired) && (Session::has('lotmPackageExpired') && $lotmPackageExpired))
    <script>
        swal.queue([{
            title: '{{ __('headings.package_expiration_title') }}',
            confirmButtonText: '{{ __('buttons.close') }}',
            html: '{!! __('messages.package_about_to_expire', [
            'note' => $localDefaultPackageExpired->$note,
            'url' => url('locals/@' . Auth::guard('local')->user()->username . '/packages')
            ]) !!}',
            type: 'warning',
            showLoaderOnConfirm: true,
            preConfirm: () => {
            return swal({
                title: '{{ __('headings.package_expiration_title') }}',
                html: '{!! __('messages.package_about_to_expire', [
                        'note' => $lotmPackageExpired->$note,
                        'url' => url('locals/@' . Auth::guard('local')->user()->username . '/packages')
                        ]) !!}',
                type: 'warning'
            })
        }
        }]);
    </script>
@elseif(Session::has('localDefaultPackageExpired') && $localDefaultPackageExpired)
    <script>
    swal({
    title: '{{ __('headings.package_expiration_title') }}',
    confirmButtonText: '{{ __('buttons.close') }}',
    html: '{!! __('messages.package_about_to_expire', [
            'note' => $localDefaultPackageExpired->$note,
            'url' => url('locals/@' . Auth::guard('local')->user()->username . '/packages')
            ]) !!}',
    type: 'warning',
    });
    </script>
@elseif(Session::has('lotmPackageExpired') && $lotmPackageExpired)
    <script>
        swal({
            title: '{{ __('headings.package_expiration_title') }}',
            html: '{!! __('messages.package_about_to_expire', [
                        'note' => $lotmPackageExpired->$note,
                        'url' => url('locals/@' . Auth::guard('local')->user()->username . '/packages')
                        ]) !!}',
            type: 'warning'
        })
    </script>
@endif


@if((Session::has('defaultGirlPackageExpired') && $defaultPackageExpired) && Session::has('gotm_expired_package_info'))
    <script>
    swal.queue([{
        title: '{{ __('headings.package_expiration_title') }}',
        confirmButtonText: '{{ __('buttons.close') }}',
        html: '{!! __('messages.package_about_to_expire', [
            'note' => $defaultPackageExpired->$note,
            'url' => url('@' . Auth::user()->username . '/packages')
            ]) !!}',
            type: 'warning',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return swal({
                    title: '{{ __('headings.default_error_title') }}',
                    html: '{!! Session::get('gotm_expired_package_info') !!}',
                    type: 'error'
                })
            }
        }]);
    </script>
@elseif(Session::has('gotm_expired_package_info'))
    <script>
    swal(
        '{{ __('headings.default_error_title') }}',
        '{!! Session::get('gotm_expired_package_info') !!}',
        'warning'
        );
    </script>
@elseif((Session::has('defaultGirlPackageExpired') && $defaultPackageExpired) && (Session::has('gotmPackageExpired') && $gotmPackageExpired))
    <script>
    swal.queue([{
        title: '{{ __('headings.package_expiration_title') }}',
        confirmButtonText: '{{ __('buttons.close') }}',
        html: '{!! __('messages.package_about_to_expire', [
            'note' => $defaultPackageExpired->$note,
            'url' => url('@' . Auth::user()->username . '/packages')
            ]) !!}',
            type: 'warning',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return swal({
                    title: '{{ __('headings.package_expiration_title') }}',
                    html: '{!! __('messages.package_about_to_expire', [
                        'note' => $gotmPackageExpired->$note,
                        'url' => url('@' . Auth::user()->username . '/packages')
                        ]) !!}',
                        type: 'warning'
                    })
            }
        }]);
    </script>
@elseif(Session::has('defaultGirlPackageExpired') && $defaultPackageExpired)
    <script>
    swal({
        title: '{{ __('headings.package_expiration_title') }}',
        confirmButtonText: '{{ __('buttons.close') }}',
        html: '{!! __('messages.package_about_to_expire', [
            'note' => $defaultPackageExpired->$note,
            'url' => url('@' . Auth::user()->username . '/packages')
            ]) !!}',
            type: 'warning',
        });
    </script>
@elseif(Session::has('gotmPackageExpired') && $gotmPackageExpired)
    <script>
    swal({
        title: '{{ __('headings.package_expiration_title') }}',
        html: '{!! __('messages.package_about_to_expire', [
            'note' => $gotmPackageExpired->$note,
            'url' => url('@' . Auth::user()->username . '/packages')
            ]) !!}',
            type: 'warning'
        });
    </script>
@endif

<script>
    $(function () {
        $("input.checkbox-button:checkbox").on('change', function() {
            $('input.checkbox-button:checkbox').not(this).prop('checked', false);
        });
    });
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&libraries=places&callback=initialize&sensor=true"></script>

<script>
    var initialRadius = '{{ old('radius') ? old('radius') : 0 }}';
    $('#radius-ranger').slider({
        range: 'min',
        min: 0,
        max: 20,
        value: initialRadius,
        slide: function( event, ui ) {
            $('.radius').text(ui.value);
        },
        change: function( event, ui ) {
            $('input[name="radius"]').val(ui.value);
        }
    });
</script>

<!-- geolocation -->
<script>
    var x = document.getElementById("location");
    var inputCity = document.getElementById('city');
    var token = $('input[name="_token"]').val();

    function initialize() {
        var autocomplete = new google.maps.places.Autocomplete(
            (inputCity), {
                types: ['geocode']
            });
        autocomplete.setComponentRestrictions(
            {'country': ['ch']});

        autocomplete.addListener('place_changed', function() {
            $(".go").addClass("square-spin");
            $(".span").addClass("square-spin");
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var address = place.formatted_address;
            $.ajax({
                url: getUrl('/get_guest_data'),
                type: 'post',
                data: {lat: lat, lng: lng, address: address, _token: token},
                success: function (data) {
                    $(".go").removeClass("square-spin");
                    $(".span").removeClass("square-spin");
                },
                error: function () {
                    $(".go").removeClass("square-spin");
                    $(".span").removeClass("square-spin");
                }
            });
        });
    }

    function getLocation() {
        $('.geolocation-image').hide();
        $('.spinner').show();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geocoder = new google.maps.Geocoder;
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var latlng = {
                    lat: lat,
                    lng: lng
                };
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (results[0]) {
                        var address = results[0].formatted_address;
                        inputCity.value = address;
                        $.ajax({
                            url: getUrl('/get_guest_data'),
                            type: 'post',
                            data: {lat: lat, lng: lng, address: address, _token: token},
                            success: function (data) {
                                $(".go").removeClass("square-spin");
                                $(".span").removeClass("square-spin");
                            },
                            error: function () {
                                $(".go").removeClass("square-spin");
                                $(".span").removeClass("square-spin");
                            }
                        });
                    }
                });
            });
        } else {
            x.innerHTML = "{{ __('messages.geolocation_not_supported') }}";
        }
    }
</script>

<!-- radius -->
<script>
    var initialRadius = '{{ old('radius') ? old('radius') : 0 }}';
    $('#radius-ranger').slider({
        range: 'min',
        min: 0,
        max: 20,
        value: initialRadius,
        slide: function( event, ui ) {
            $('.radius').text(ui.value);
        }
    });
</script>
<script>
    $(document).ready(function(){
        $(".go").click(function(){
            $(".go").addClass("square-spin");
            $(".span").addClass("square-spin");
        });
    });
</script>
@stop