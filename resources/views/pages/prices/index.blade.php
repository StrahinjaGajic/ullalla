@extends('layouts.app') @section('title', __('buttons.prices')) @section('styles')
<!-- Styles go here -->
<link rel="stylesheet" href="{{ asset('css/components/girls.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/components/prices.css?ver=' . str_random(10)) }}"> @stop @section('content')
<!-- Content goes here -->

<div class="container prices_banners">
    <h3>Packages</h3>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Private Basic <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_1 nt-absolute">
                    <h2>Private Basic Packages</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($privatePackages as $package)
                                <tr>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->package_duration }} {{ trans_choice('fields.days', $package->package_duration) }}</td>
                                    <td>CHF {{ $package->package_price }} .-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/private_profile.png" alt="">
                    <img class="img-responsive" src="../img/prices/private_profile.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Local Basic <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_1 nt-absolute">
                    <h2>Private Basic</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price/Month</th>
                                <th>Price/Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($localPackages as $package)
                                <tr>
                                    <td>{{ $package->name }}</td>
                                    <td>CHF {{ $package->month_price }} .-</td>
                                    <td>CHF {{ $package->year_price }} .-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/local_profile.png" alt="">
                    <img class="img-responsive" src="../img/prices/local_profile.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Private of the Month <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_2">
                    <h2>Private of the Month</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('headings.name') }}</th>
                                <th>{{ __('headings.duration') }}</th>
                                <th>{{ __('headings.price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($privatePackages->take(3) as $package)
                                <tr>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
                                    <td>CHF {{ $package->package_price }} .-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/potm.png" alt="">
                    <img class="img-responsive" src="../img/prices/potm.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Local of the Month <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_1">
                    <h2>Local of the Month</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('headings.name') }}</th>
                                <th>{{ __('headings.duration') }}</th>
                                <th>{{ __('headings.price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($privatePackages->take(3) as $package)
                                <tr>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
                                    <td>CHF {{ $package->package_price }} .-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/lotm.png" alt="">
                    <img class="img-responsive" src="../img/prices/lotm.png" alt="">
                </div>
            </div>
        </div>
    </div>
    
    
   <h3>Banners</h3>

    @foreach($banners as $banner)
    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    @php
                        $bannerSize = App\Models\BannerSize::where('id', $banner->banner_size_id)->first();
                        $pageName = App\Models\Page::where('id', $banner->page_id)->value('page_name');
                    @endphp
                    <a> {{ $bannerSize->banner_size_name }} {{ $pageName }} page <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description {{ strtolower($bannerSize->banner_size_name . '_banner') }}" style="{{ $pageName == 'Contact' ? 'top: 250px; bottom: 250px;' : '' }}">
                    <h2>{{ $bannerSize->banner_size_name }} {{ $pageName }} page</h2>
                    <p>Price: CHF {{ $bannerSize->banner_size_price }} .-</p>
                    <p>Price/Week: CHF {{ $banner->price_per_week }} .-</p>
                    <p>Price/Month: CHF {{ $banner->price_per_month }} .-</p>
                    <p>Format: {{ getBannerDimensions($bannerSize->banner_size_name) }}</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/{{ strtolower($bannerSize->banner_size_name) . '_' . strtolower($pageName) }}.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/{{ strtolower($bannerSize->banner_size_name) . '_' . strtolower($pageName) }}.png" alt="">
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop @section('perPageScripts')
<!-- Scripts go here -->
<script>
    $('.control__indicator').on('click', function() {
        window.location.href = $(this).closest('label').find('a').attr('href');
    });
</script>
<script>

    var fa = $('i.fa');

    if ($(window).width() < 992) {
        fa.removeClass('fa-caret-down').addClass("fa-caret-right");
    }

    $(window).on('resize', function () {
        if ($(this).width() < 992) {
            return fa
                .removeClass('fa-caret-down')
                .removeClass('rotateCaretBack')
                .removeClass('rotateCaret')
                .addClass("fa-caret-right")
                .closest('.shop-layout')
                .find('.layout-list')
                .hide('fast');
        } else {
            return fa
                .removeClass('fa-caret-right')
                .removeClass('rotateCaretBack')
                .removeClass('rotateCaret')
                .addClass("fa-caret-down")
                .closest('.shop-layout')
                .find('.layout-list')
                .show('fast');
        }
    })

    $(".toggle_arrow").on("click", function() {
        var that = $(this);
        that.closest('.shop-layout').find('.layout-list').toggle('fast');
        that.parent().find(".fa-caret-right").toggleClass("rotateCaret");
        that.parent().find(".fa-caret-down").toggleClass("rotateCaretBack");
    });
</script>
@stop