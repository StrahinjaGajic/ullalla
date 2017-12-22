@extends('layouts.app')

@section('title', 'Girls')

@section('styles')
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="wrapper section-girls">
    <div class="single-product-menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="shop-menu">
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('buttons.home') }}</a></li>
                            <li class="separator"><i class="fa fa-angle-right"></i></li>
                            <li>{{ __('buttons.search_results') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="left-sidebar-title">
                        <h2>{{ __('headings.search_filters') }}</h2>
                    </div>
                    <div class="left-sidebar">
                        <div class="shop-layout headerDropdown">
                            <div class="layout-title toggle_arrow">
                                <a>{{ __('fields.location') }} <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list"{{--  style="{{ !request('radius') ? 'display: none;' : '' }}" --}}>
                                <ul>
                                    <li class="geolocation">
                                        <input name="city" id="city" placeholder="{{ __('fields.city') }}" class="form-control" value="{{ Session::has('address') ? Session::get('address') : '' }}" />
                                        <a onclick="getLocation();" class="geolocation-button">
                                            <img src="{{ asset('svg/location.svg') }}" alt="" class="geolocation-image">
                                            <div class="spinner" style="display: none;">
                                                <div class="double-bounce1"></div>
                                                <div class="double-bounce2"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <label for="amount">{{ __('fields.radius') }}:</label>
                                        <div class="location-inputs">
                                            <input type="hidden" name="radius" value="{{ old('radius') }}">
                                        </div>
                                        <div id="radius-ranger" style="margin: 10px;"></div>
                                        <div class="slider-value-wrapper">
                                            <span class="radius">{{ old('radius') ? old('radius') : 0 }}</span>
                                            <span>{{ __('global.km') }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout">
                            <div class="layout-title">
                                <a>{{ __('headings.local_types') }}</a>
                            </div>
                            <div class="layout-list">
                                <ul>
                                    <li>
                                        <?php $num = 1; ?>
                                        @foreach($types as $type)
                                        <label class="control control--checkbox">
                                            <a href="{{ urldecode(route('locals', getUrlWithFilters(request('types'), request()->query() , $num, 'types', $type), false)) }}">{{ $type->name }}
                                                <span>({{ \App\Models\Local::approved()->where('local_type_id', $type->id)->count() }})</span>
                                            </a>
                                            <input id="check_type_{{ $type->id }}" type="checkbox" name="types[]" value="{{ $type->id }}" {{ request('types') && in_array($type->id, request('types')) ? 'checked' : '' }}/>
                                            <div class="control__indicator"></div>
                                        </label>
                                        <?php $num++; ?>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="shop-product-view">
                        <div class="product-tab-area">
                            <div class="tab-bar">
                                <div class="tab-bar-inner">
                                    <ul role="tablist" class="nav nav-tabs">
                                        <li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">{{ __('buttons.grid') }}</span></a></li>
                                        <li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">{{ __('buttons.list') }}</span></a></li>
                                    </ul>
                                </div>
                                <div class="toolbar">
                                    <div class="sorter">
                                        <div class="sort-by">
                                            <label class="sort-none">{{ __('global.sort_by') }}</label>
                                            <select name="order_by" onchange="location=this.value;">
                                                @foreach(getLoclasOrderBy() as $key => $order)
                                                <option value="{{ urldecode(route('locals', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pager-list">
                                        <div class="limiter">
                                            <label>{{ __('global.show') }}</label>
                                            <select name="show" onchange="location=this.value">
                                                @foreach(getShowNumbers() as $number)
                                                <option value="{{ urldecode(route('locals', array_merge(request()->query(), ['show' => $number]), false)) }}" {{ request('show') == $number ? 'selected' : '' }}>{{ $number }}</option>
                                                @endforeach
                                            </select>
                                            {{ __('global.per_page') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                @if ($locals->count())
                                <div id="shop-product" class="tab-pane active">
                                    <div class="row">
                                        @foreach($locals as $local)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a class="a-img"><img class="primary-img" src="{{ $local->photos. '/nth/0/' }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-content">
                                                    <a class="shop-name">{{ $local->username }}</a>
                                                    <a href="{{ url('locals/' . $local->username) }}">
                                                        <div class="product-cart">
                                                            <button class="button">{{ __('buttons.view_profile') }}</button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="shop-list" class="tab-pane">
                                    @foreach($locals as $local)
                                    <div class="single-shop single-product">
                                        <div class="row">
                                            <div class="single-shop">
                                                <div class="single-product">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <div class="product-img">
                                                            <a class="a-img" href="shop.html#"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="product-content-shop">
                                                            <h2><a class="shop-name">{{ $local->username }}</a></h2>
                                                            <div class="pro-deal-text-shop">
                                                                <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Viva... </p>
                                                            </div>
                                                            <a href="{{ url('locals/' . $local->username) }}">
                                                                <div class="product-cart">
                                                                    <button class="button">{{ __('buttons.view_profile') }}</button>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <h1>{{ __('headings.no_users_found') }}</h1>
                                @endif
                            </div>
                            <div class="tab-bar tab-bar-bottom">
                                <div class="tab-bar-inner">
                                    <ul role="tablist" class="nav nav-tabs">
                                        <li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">{{ __('buttons.grid') }}</span></a></li>
                                        <li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">{{ __('buttons.list') }}</span></a></li>
                                    </ul>
                                </div>
                                <div class="toolbar">
                                    <div class="sorter">
                                        <div class="sort-by">
                                            <label class="sort-none">{{ __('global.sort_by') }}</label>
                                            <select name="order_by" onchange="location=this.value;">
                                                @foreach(getLoclasOrderBy() as $key => $order)
                                                <option value="{{ urldecode(route('locals', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pages">
                                        {{ $locals->appends(request()->input())->links('vendor.pagination.custom-girls') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area-2 home-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-banner">
                        <a class="last-banner" href="index.html">
                         <span>
                            <img src="img/banner/fullwide-banner-4.jpg" alt="">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
@section('perPageScripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&libraries=places&callback=initialize"></script>
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

            var input = $('input[name="radius"]');
            var $radius = input.val(ui.value);

            var $url = getUrl('/get_local_radius');

            var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query()) ? json_encode(request()->query()) : "{}" }}';

            var requestQueryClearedJSON = requestQueryString
            .replace(/&quot;/gi,"\"")
            .replace(/\[/gi,"")
            .replace(/\]/gi,"");

            var requestQueryObj = JSON.parse(requestQueryClearedJSON);

            delete requestQueryObj.radius;

            var requestData = Object.assign({
                radius: $radius.val()
            }, requestQueryObj);

            console.log(requestData);

            $.ajax({
                data: requestData,
                url: $url,
                dataType: 'json',
                method: 'get',
                success: function (data) {
                    window.location.href = data.url;
                },
                error: function (data) {
                }
            });
        }
    });
</script>

<!-- geolocation -->
<script>
    var x = document.getElementById("location");
    var inputCity = document.getElementById('city');
    var token = '{{ csrf_token() }}';

    function initialize() {
        var autocomplete = new google.maps.places.Autocomplete(
            (inputCity), {
                types: ['geocode']
            });
        autocomplete.setComponentRestrictions({'country': ['ch']});

        autocomplete.addListener('place_changed', function() { 
            $('.geolocation-image').hide();
            $('.spinner').show();
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var address = place.formatted_address;
            console.log(place);
            $.ajax({
                url: getUrl('/get_guest_data'),
                type: 'post',
                data: {lat: lat, lng: lng, address: address, _token: token},
                success: function (data) {
                    window.location.reload();
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
                        console.log(results);
                        var address = results[0].formatted_address;
                        inputCity.value = address;
                        $.ajax({
                            url: getUrl('/get_guest_data'),
                            type: 'post',
                            data: {lat: lat, lng: lng, address: address, _token: token},
                            success: function (data) {
                                window.location.reload();
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
<script>
    $('.control__indicator').on('click', function () {
        window.location.href = $(this).closest('label').find('a').attr('href');
    });
</script>
@stop