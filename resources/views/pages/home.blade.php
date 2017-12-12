@extends('layouts.app')

@section('content')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
@stop

<section class="slider-area home-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bend niceties preview-1 ho_4">
                    <div id="ensign-nivoslider" class="slides">
                        <img src="/img/sliders/S-7.jpg" alt="" title="#slider-direction-1"  />
                        <img src="/img/sliders/S-8.jpg" alt="" title="#slider-direction-2"  />
                    </div>
                    <div id="slider-direction-1" class="t-cn slider-direction slider-one">
                        <div class="slider-progress"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <div class="fas7-slider-content">
                                        <div class="layer-1-1">
                                            <h5 class="title1">This banner is</h5>
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
                                            <a class="shop-n" href="/">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-2" class="slider-direction slider-two">
                        <div class="slider-progress"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <div class="fas8-slider-content">
                                        <div class="layer-2-1">
                                            <h5 class="title1">This one is also</h5>
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
                                            <a class="shop-n" href="/">go now</a>
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
            {!! Form::open(['url' => 'search']) !!}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height: 100%; margin-bottom: 30px;">
                <span class="search"><h3 style="font-size: 18px; color: #363636; font-weight: 800;">Quick Search</h3></span>
                <div class="containere">
                    <div class="checkbox-tile-group">
{{--                         <div class="input-container">
                            <input class="checkbox-button" type="checkbox" name="checkbox" />
                            <div class="checkbox-tile">
                                <i class="fa fa-mars fa-2x"></i>
                                <label for="male" class="checkbox-tile-label">Male</label>
                            </div>
                        </div> --}}
                        <div class="input-container">
                            <input class="checkbox-button" type="checkbox" name="checkbox" />
                            <div class="checkbox-tile">
                                <i class="fa fa-venus fa-2x"></i>
                                <label for="female" class="checkbox-tile-label">Female</label>
                            </div>
                        </div>
{{--                         <div class="input-container">
                            <input class="checkbox-button" type="checkbox" name="checkbox" />
                            <div class="checkbox-tile">
                                <i class="fa fa-transgender fa-2x"></i>
                                <label for="mix" class="checkbox-tile-label">Mix</label>
                            </div>
                        </div> --}}
                        <div class="input-container">
                            <input class="checkbox-button" type="checkbox" name="checkbox" />
                            <div class="checkbox-tile">
                                <i class="fa fa-home fa-2x"></i>
                                <label for="local" class="checkbox-tile-label">Local</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containere1">
                    <div class="region">
                    </div>
                    <div class="region">
                        <input name="city" placeholder="City" class="form-control"/>
                    </div>
                </div>
                <div style="width: 101%; text-align: center"><button class="button1 button2" onclick="getLocation()">Geolocalization</button></div>
                <div style="width: 101%; text-align: center; margin-top: 14px;"><button type="submit" class="button3 button4">Search</button></div>
            </div>
            {!! Form::close() !!}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="single-banner home-3">
                    <a class="last-banner" href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-heading pro-title blog-margin">
                        <h3>Girls Of The Month</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="featured-product-carousel single-indicator">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img"><img class="primary-img" src="/img/girls/1.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/2.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/3.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/4.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/5.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/6.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/7.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/8.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="banner-area-2 home-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-banner">
                        <a class="last-banner" href="">
                            <span>
                                <img src="/img/banner/fullwide-banner-4.jpg" alt="">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="map"></div>

@stop

@section('perPageScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>

@if(Session::has('not_approved'))
<script>
    swal(
        '{{ __('messages.info_account_not_approved_title') }}',
        '{{ Session::get('not_approved') }}',
        'info'
        );
    </script>
    @endif

    @if(Session::has('account_created'))
    <script>
        swal(
            '{{ __('messages.account_created_title') }}',
            '{{ Session::get('account_created') }}',
            'info'
            );
        </script>
        @endif

        @if((Session::has('defaultGirlPackageExpired') && $defaultPackageExpired) && Session::has('gotm_expired_package_info'))
        <script>
            swal.queue([{
                title: 'Package Expiry',
                confirmButtonText: 'Close',
                html: '{{ $defaultPackageExpired->note }}.' + ' <p>Click <a href="{{ url('@' . Auth::user()->username . '/packages') }}">HERE</a> to upgrade your account</p>',
                type: 'warning',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return swal({
                        title: 'Package Expired',
                        html: '{!! Session::get('gotm_expired_package_info') !!}',
                        type: 'error'
                    })
                }
            }]);
        </script>

        @elseif(Session::has('gotm_expired_package_info'))
        <script>
            swal(
                'Oops...',
                '{!! Session::get('gotm_expired_package_info') !!}',
                'warning'
                );
            </script>

            @elseif((Session::has('defaultGirlPackageExpired') && $defaultPackageExpired) && (Session::has('gotmPackageExpired') && $gotmPackageExpired))
            <script>
                swal.queue([{
                    title: 'Package Expiry',
                    confirmButtonText: 'Close',
                    html: '{{ $defaultPackageExpired->note }}.' + ' <p>Click <a href="{{ url('@' . Auth::user()->username . '/packages') }}">HERE</a> to upgrade your account</p>',
                    type: 'warning',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return swal({
                            title: 'Package Expiry',
                            html: '{{ $gotmPackageExpired->note }}.' + '<p>Click <a href="{{ url('@' . Auth::user()->username . '/packages') }}">HERE</a> to upgrade your account</a>',
                            type: 'warning'
                        })
                    }
                }]);
            </script>

            @elseif(Session::has('defaultGirlPackageExpired') && $defaultPackageExpired)
            <script>
                swal({
                    title: 'Package Expiry',
                    confirmButtonText: 'Close',
                    html: '{{ $defaultPackageExpired->note }}.' + ' <p>Click <a href="{{ url('@' . Auth::user()->username . '/packages') }}">HERE</a> to upgrade your account</p>',
                    type: 'warning',
                });
            </script>

            @elseif(Session::has('gotmPackageExpired') && $gotmPackageExpired)
            <script>
                swal({
                    title: 'Package Expiry',
                    confirmButtonText: 'Close',
                    html: '{{ $gotmPackageExpired->note }}.' + ' <p>Click <a href="{{ url('@' . Auth::user()->username . '/packages') }}">HERE</a> to upgrade your account</p>',
                    type: 'warning',
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

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&callback=initMap"></script>

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

                @stop