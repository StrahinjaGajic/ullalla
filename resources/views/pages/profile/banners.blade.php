@extends('layouts.app')

@section('title', __('functions.news_and_events'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditProfileMenu('banners') !!}
        </div>
        <div class="col-sm-10 profile-info">
            <div class="col-xs-12">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            @if($user->banners()->count() > 0)
            <div class="shop-layout headerDropdown">
                <div class="layout-title">
                    <div class="layout-title toggle_arrow">
                        <a>{{ __('headings.banners') }} <i class="fa fa-caret-down"></i></a>
                    </div>
                </div>
                <div class="layout-list">
                    <div class="form-group girls_preview">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.photo') }}</th>
                                    <th>{{ __('fields.url') }}</th>
                                    <th>{{ __('headings.activation_date') }}</th>
                                    <th>{{ __('headings.expiry_date') }}</th>
                                </tr>
                            </thead>
                            <tbody id="prices_body">
                                @foreach($user->banners as $banner)
                                <tr>
                                    <td>
                                        @if ($banner->banner_photo)
                                        <div class="image-tooltip">
                                            <img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($news->banner_photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='news image'/>
                                            <span>
                                                <img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($news->banner_photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='news image'/>
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $news->banner_url }}</td>
                                    <td>{{ date('d-m-Y', strtotime($banner->banner_activation_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($banner->banner_expiry_date)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
            @endif

            {!! Form::open(['url' => '@' . $user->username . '/banners/store', 'class' => 'form-horizontal wizard', 'id' => 'bannerForm']) !!}
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="control control--checkbox"><a>{{ __('fields.prepared_flyer') }}</a>
                        <input type="checkbox" name="news_flyer" class="prepared_flyer" {{ old('news_flyer') ? 'checked' : '' }}>
                        <div class="control__indicator"></div>
                    </label>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($pages as $page)
                            <th>{{ $page->page_name }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bannerSizes as $size)
                        <tr>
                            <td>{{ $size->banner_size_name }}</td>
                            @foreach($pages as $page)
                            <td>
                                @php 
                                $price = $size->pages()->where('banner_size_id', $size->id)->where('page_id', $page->id)->first();
                                @endphp
                                <span>{{ $price ? $price->pivot->price_with_banner : '' }}</span>
                                <span>{{ $price ? $price->pivot->price_without_banner : '' }}</span>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="form-group {{ $errors->has('banner_url') ? 'has-error' : '' }}">
                    <label class="control-label">{{ __('fields.url') }}*</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ old('banner_url') }}" />
                    <span class="help-block">{{ $errors->has('banner_url') ? $errors->first('banner_url') : '' }}</span>
                </div>
                <div class="form-group {{ $errors->has('banner_duration') ? 'has-error' : '' }}">
                    <label class="control-label">{{ __('fields.duration') }}*</label>
                    <input type="text" class="form-control events_duration" name="banner_duration" value="{{ old('banner_duration') }}"/>
                    <input type="hidden" name="duration"/>
                    <span class="help-block">{{ $errors->has('banner_duration') ? $errors->first('banner_duration') : '' }}</span>
                </div>
                <div class="flyerless-fields">
                    <div class="form-group {{ $errors->has('banner_description') ? 'has-error' : '' }}">
                        <label class="control-label">{{ __('fields.description') }}*</label>
                        <textarea name="banner_description">{{ old('banner_description') }}</textarea>
                        <span class="help-block">{{ $errors->has('banner_description') ? $errors->first('banner_description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ __('fields.price_per_day') }}</label>
                    <input type="text" disabled="" class="form-control events_price" value="{{ number_format(getEventPrice(true), 2) }}">
                    <span class="currency-holder">CHF</span>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ __('fields.total') }}</label>
                    <input type="text" disabled="" class="form-control events_total" value="{{ number_format(getEventPrice(), 2) }}">
                    <span class="currency-holder">CHF</span>
                </div>
                <div class="form-group {{ $errors->has('banner_photo') ? 'has-error' : '' }}">
                    <div class="image-preview-multiple">
                        <input type="hidden" name="banner_photo" data-crop="490x560 minimum" data-images-only="">
                        <span class="help-block">{{ $errors->has('banner_photo') ? $errors->first('banner_photo') : '' }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
                <input type="hidden" name="stripeToken" id="stripeToken">
                <input type="hidden" name="stripeEmail" id="stripeEmail">
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

<script>
    ////////// 1. MODAL, DATERANGE PICKER, ////////
    $(function () {
        var start = moment(new Date()).format('DD/MM/YYYY H:mm');
        var end = moment(start, 'DD/MM/YYYY H:mm').add('1', 'years').format('DD/MM/YYYY H:mm');

        $('input[name="banner_duration"]').daterangepicker({
            minDate: start,
            maxDate: end,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    });

    ////////// 2. UPLOAD CARE ////////
    function minDimensions(width, height) {
        return function(fileInfo) {
            var imageInfo = fileInfo.originalImageInfo;
            if (imageInfo !== null) {
                if (imageInfo.width < width || imageInfo.height < height) {
                    throw new Error('{{ __('messages.dimensions') }}');
                }
            }
        };
    }

    function maxFileSize(size) {
        return function (fileInfo) {
            if (fileInfo.size !== null && fileInfo.size > size) {
                throw new Error('{{ __('messages.file_maximum_size') }}');
            }
        }
    }

    $(function() {
        const bannerWidget = uploadcare.Widget('[name=banner_photo]')
        bannerWidget.validators.push(minDimensions(490, 560));
        bannerWidget.validators.push(maxFileSize(20000000));
    });

</script>

<script>
    $(".toggle_arrow").on("click", function() {
        var that = $(this);
        that.closest('.shop-layout').find('.layout-list').toggle('fast');
        that.parent().find(".fa-caret-down").toggleClass("rotateCaretBack");
    });
</script>

<script>
    var tooltips = document.querySelectorAll('.image-tooltip span');
    window.onmousemove = function (e) {
        var x = (e.clientX + 20) + 'px',
        y = (e.clientY + 20) + 'px';
        for (var i = 0; i < tooltips.length; i++) {
            tooltips[i].style.top = y;
            tooltips[i].style.left = x;
        }
    };
</script>

<script>
    var eventPricePerDay = parseFloat('{{ getEventPrice(true) }}');
    var eventPrice = parseFloat('{{ getEventPrice() }}');
    var form = $('#bannerForm');

    $('.prepared_flyer').on('click', function () {
        var flyerlessDiv = form.find('.flyerless-fields');
        var totalEl = form.find('.events_total');

        flyerlessDiv.toggle();

        var diffInDays = parseFloat(form.find('input[name="duration"]').val());

        if (flyerlessDiv.is(':hidden')) {
            var flyerlessEventPrice = parseFloat('{{ getEventPrice(false, false) }}');

            if (diffInDays > 0) {
                var totalWithFlyer = flyerlessEventPrice + (eventPricePerDay * diffInDays);
                totalEl.val(totalWithFlyer.toFixed(2));
            } else {
                totalEl.val(flyerlessEventPrice.toFixed(2));
            }

        } else {
            var eventPrice = parseFloat('{{ getEventPrice(false, true) }}');

            if (diffInDays > 0) {
                var totalWithoutFlyer = eventPrice + (eventPricePerDay * diffInDays);
                totalEl.val(totalWithoutFlyer.toFixed(2));
            } else {
                totalEl.val(eventPrice.toFixed(2));
            }
        }
    });

    $('.events_duration').on('change', function () {
        var that = $(this);
        var thatVal = that.val();
        var totalEl = form.find('.events_total');
        var flyerlessDiv = form.find('.flyerless-fields');

        var exploadedThatVal = thatVal.split(' - ');
        var from = moment(exploadedThatVal[0], 'DD/MM/YYYY');
        var to = moment(exploadedThatVal[1], 'DD/MM/YYYY');
        var diffInDays = to.diff(from, 'days');

        var total = eventPrice + (eventPricePerDay * diffInDays);
        totalEl.val(total.toFixed(2));
        that.next().val(diffInDays);

        if (flyerlessDiv.is(':hidden')) {
            var flyerlessEventPrice = parseFloat('{{ getEventPrice(false, false) }}');
            if (diffInDays > 0) {
                var totalWithFlyer = flyerlessEventPrice + (eventPricePerDay * diffInDays);
                totalEl.val(totalWithFlyer.toFixed(2));
            } else {
                totalEl.val(flyerlessEventPrice.toFixed(2));
            }
        } else {
            var eventPrice = parseFloat('{{ getEventPrice(false, true) }}');
            if (diffInDays > 0) {
                var totalWithoutFlyer = eventPrice + (eventPricePerDay * diffInDays);
                totalEl.val(totalWithoutFlyer.toFixed(2));
            } else {
                totalEl.val(eventPrice.toFixed(2));
            }
        }
    });
</script>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    let stripe = StripeCheckout.configure({
        key: '{{ config('services.stripe.key') }}',
        image: '{{ asset('img/logo.png') }}',
        locale: 'auto',
        token: function (token) {
            var stripeEmail = $('#stripeEmail');
            var stripeToken = $('#stripeToken');
            stripeEmail.val(token.email);
            stripeToken.val(token.id);
            // submit the form
            var username = '{{ $user->username }}';
            var url = getUrl('/@' + username + '/banners/store');
            var token = $('input[name="_token"]').val();
            var form = $('#bannerForm');
            var data = form.serialize();
            // fire ajax post request
            $.post(url, data)
            .done(function (response, textStatus) {
                var errors = response.errors;
                if (errors) {
                    //proveriti da li je greska u navodnicima !!!
                    console.log(errors);
                } else {
                    window.location.href = getUrl('/@' + username  + '/banners');
                }
            })
            .fail(function(data, textStatus) {
                $('.default-packages-section').find('.help-block').text(data.responseJSON.status);
            });
        }
    });
    $('#bannersForm').on('submit', function (e) {
        stripe.open({
            name: 'Ullallà',
            description: '{{ $user->email }}',
        });
        e.preventDefault(); 
    });
</script>

<script>
    $(function () {
        $("input.pages_checkbox:checkbox").on('change', function() {
            var that = $(this);
            $('input.pages_checkbox:checkbox').not(this).prop('checked', false);
        });
    });
</script>

@stop