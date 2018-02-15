@extends('layouts.app')

@section('title', __('functions.banners'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            @if(Auth::guard('local')->check())
                {!! parseEditLocalProfileMenu('banners') !!}
            @else
                {!! parseEditProfileMenu('banners') !!}
            @endif
        </div>
        <div class="col-sm-10 profile-info">
            {!! Form::open(['url' => 'banners/store', 'class' => 'form-horizontal wizard', 'id' => 'bannerForm']) !!}
            <div class="col-xs-12">
                <div class="form-group {{ $errors->has('banner_url') ? 'has-error' : '' }}">
                    <label class="control control--checkbox"><a>{{ __('fields.prepared_banner') }}</a>
                        <input type="checkbox" name="banner_flyer" class="prepared_flyer" {{ old('banner_flyer') ? 'checked' : '' }} autocomplete="off">
                        <div class="control__indicator"></div>
                    </label>
                </div>
                <div class="help-block banner-error" style="color: red;">
                    @if($errors->has('price_per_day') || $errors->has('price_per_week') || $errors->has('price_per_month'))
                        Please choose at least one banner
                    @elseif($errors->has('stripe_error'))
                        {{ $errors->first() }}
                    @endif
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            @foreach($pages as $page)
                                <th>{{ $page->page_name }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bannerSizes as $size)
                        <tr class="banner-size">
                            <td class="banner-price-td">
                                <span style="display: block;">{{ $size->banner_size_name }}</span>
                                <span class="banner-price">{{ number_format($size->banner_size_price, 2) }}</span>
                                <span>CHF</span>
                            </td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td>Price Per Day</td>
                                    </tr>
                                    <tr>
                                        <td>Price Per Week</td>
                                    </tr>
                                    <tr>
                                        <td>Price Per Month</td>
                                    </tr>
                                </table>
                            </td>
                            @foreach($pages as $page)
                            <td>
                                @php 
                                    $price = $size->pages()->where('banner_size_id', $size->id)->where('page_id', $page->id)->first();
                                @endphp
                                {{ $price ? $price->pivot->banner_price : '' }}
                                @if($price)
                                <div class="form-group" style="position: relative;">
                                    <label class="control control--checkbox">
                                        <div class="price-per-time-holder">
                                            <span>{{ $price ? $price->pivot->price_per_day : '' }}</span>
                                        </div>
                                        <input type="checkbox" name="price_per_day[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" data-toggle="modal" data-target="#price_per_day{{ $size->id }}{{ $page->id }}" autocomplete="off">
                                        <div class="control__indicator"></div>
                                    </label>
                                    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="price_per_day{{ $size->id }}{{ $page->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Please enter for how many days you would like your banner
                                                    <input type="text" name="banner_duration[price_per_day][{{ $page->id }}][{{ $size->id }}]"  autocomplete="off">
                                                    <span class="help-block" style="color: red;"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary apply-duration">Apply</button>
                                                    <button type="button" class="btn btn-secondary discard-duration" data-dismiss="modal">Discard</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control control--checkbox">
                                        <div class="price-per-time-holder">
                                            <span>{{ $price ? $price->pivot->price_per_week : '' }}</span>
                                        </div>
                                        <input type="checkbox" name="price_per_week[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" {{ old('price_per_week') ? 'checked' : '' }} data-toggle="modal" data-target="#price_per_week{{ $size->id }}{{ $page->id }}" autocomplete="off">
                                        <div class="control__indicator"></div>
                                    </label>
                                    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="price_per_week{{ $size->id }}{{ $page->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Please enter for how many weeks you would like your banner
                                                    <input type="text" name="banner_duration[price_per_week][{{ $page->id }}][{{ $size->id }}]" autocomplete="off">
                                                    <span class="help-block" style="color: red;"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary apply-duration">Apply</button>
                                                    <button type="button" class="btn btn-secondary discard-duration" data-dismiss="modal">Discard</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control control--checkbox">
                                        <div class="price-per-time-holder">
                                            <span>{{ $price ? $price->pivot->price_per_month : '' }}</span>
                                        </div>
                                        <input type="checkbox" name="price_per_month[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" {{ old('price_per_month') ? 'checked' : '' }} data-toggle="modal" data-target="#price_per_month{{ $size->id }}{{ $page->id }}" autocomplete="off">
                                        <div class="control__indicator"></div>
                                    </label>
                                    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="price_per_month{{ $size->id }}{{ $page->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Please enter for how many months you would like your banner
                                                    <input type="text" name="banner_duration[price_per_month][{{ $page->id }}][{{ $size->id }}]" autocomplete="off">
                                                    <span class="help-block" style="color: red;"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary apply-duration">Apply</button>
                                                    <button type="button" class="btn btn-secondary discard-duration" data-dismiss="modal">Discard</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            @endforeach
                            <td class="total-per-size">
                                <span>0.00</span>
                                <span>CHF</span>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td>Total</td>
                            <td class="total-banners">
                                <span>0.00</span>
                                <span>CHF</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group {{ $errors->has('banner_url') ? 'has-error' : '' }}">
                    <label class="control-label">{{ __('fields.url') }}*</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ old('banner_url') }}" autocomplete="off"/>
                    <span class="help-block">{{ $errors->has('banner_url') ? $errors->first('banner_url') : '' }}</span>
                </div>
                <div class="flyerless-fields">
                    <div class="form-group {{ $errors->has('banner_description') ? 'has-error' : '' }}">
                        <label class="control-label">{{ __('fields.description') }}*</label>
                        <textarea name="banner_description">{{ old('banner_description') }}</textarea>
                        <span class="help-block">{{ $errors->has('banner_description') ? $errors->first('banner_description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('banner_photo') ? 'has-error' : '' }}">
                    <div class="image-preview-multiple">
                        <input type="hidden" name="banner_photo" data-crop="490x560 minimum" data-images-only="" autocomplete="off">
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
<div id="loading" class="is-hidden">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="loading-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
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
        console.log('asdas');
        var totalEl = form.find('.events_total');
        var flyerlessDiv = form.find('.flyerless-fields');

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
            var url = getUrl('/banners/store');
            var token = $('input[name="_token"]').val();
            var form = $('#bannerForm');
            var data = form.serialize();

            // add loading class
            $('#loading').removeClass('is-hidden');

            // fire ajax post request
            $.post(url, data)
            .done(function (response, textStatus) {
                    // remove errors and hide loading class
                    $('.form-group').removeClass('has-error');
                    $('.banner-error').removeClass('has-error');
                    $('.help-block').text('');
                    $('#loading').addClass('is-hidden');

                    var errors = response.errors;
                    if (errors) {
                        $.each(errors, function (index, value) {
                            var errorField = $('[name="' + index + '"]');
                            errorField.siblings('.help-block').text(value);
                            errorField.closest('.form-group').addClass('has-error');
                            if (index == 'price_per_day' || index == 'price_per_week' || index == 'price_per_month') {
                                $('.banner-error').addClass('has-error');
                                $('.banner-error').text('Please choose at least one banner');
                            }
                        });

                        $('html, body').animate({
                            scrollTop: ($('.has-error').first().offset().top - 30)
                        }, 1500);
                    } else {
                        var redirectUrl = '{{ Auth::guard('local')->check() ? url('locals/@' . $user->username . '/banners') : url('private/' . $user->id . '/banners') }}';
                        window.location.href = redirectUrl;
                    }
                })
            .fail(function(data, textStatus) {
                // remove loading spinner
                $('#loading').addClass('is-hidden');

                // display the error
                var bannerErrorEl = $('.banner-error');
                bannerErrorEl.text(data.responseJSON.status);

                $('html, body').animate({
                    scrollTop: (bannerErrorEl.offset().top - 30)
                }, 1500);
            });
        }
    });
    @if(!$user->stripe_id)
        $('#bannerForm').on('submit', function (e) {
            stripe.open({
                name: 'Ullallà',
                description: '{{ $user->email }}',
            });
            e.preventDefault(); 
        });
    @endif
</script>

<script>
    $(function () {
        $("input.price_per_duration:checkbox").on('change', function(event) {
            var that = $(this);
            var thatVal = that.val();
            var formGroup = that.closest('.form-group');
            var closestTr = that.closest('tr');
            var closestTd = that.closest('td');
            var bannerPrice = parseFloat(closestTr.find('span.banner-price').text());
            var pricePerTimeMultipleDurationEl = closestTd.find('.pmd');
            var pricePerTimeMultipleDuration = pricePerTimeMultipleDurationEl.attr('value');

            var pricePerSizeEl = closestTr.find('.total-per-size span:first-child');
            var totalEl = $('.total-banners').find('span:first-child');

            var newPricePerSize = parseFloat(pricePerSizeEl.text()) - pricePerTimeMultipleDuration - bannerPrice;
            var newTotalPrice = parseFloat(totalEl.text()) - pricePerTimeMultipleDuration - bannerPrice;

            if (!isNaN(newPricePerSize) || !isNaN(newTotalPrice)) {
                if (closestTr.find('input:checkbox:checked').length > 0) {
                    var newPricePerSize = newPricePerSize + bannerPrice;
                    var newTotalPrice = newTotalPrice + bannerPrice;
                    pricePerSizeEl.text(newPricePerSize.toFixed(2));
                    totalEl.text(newTotalPrice.toFixed(2));
                } else {
                    pricePerSizeEl.text('0.00');
                    totalEl.text(newTotalPrice.toFixed(2));
                }
            }

            var modal = that.closest('.form-group').find('.modal');
            if (that.is(":checked")) {
                modal.modal();
            } else {
                modal.modal('hide');
                modal.find('input').val('');
            }

            closestTd.find('input.price_per_duration:checkbox').not(this).prop('checked', false);
            pricePerTimeMultipleDurationEl.remove();
        });
    });

    $('.discard-duration').on('click', function () {
        var that = $(this);
        var formGroup = that.closest('.form-group');
        var spanError = formGroup.find('span.help-block');

        formGroup.find('input:checkbox').prop('checked', false);
        spanError.text('');
    });

    $('.apply-duration').on('click', function () {
        var that = $(this);
        var formGroup = that.closest('.form-group');
        var modal = formGroup.find('.modal');
        var input = modal.find('input[type="text"]');
        var val = input.val();
        var spanError = input.next();

        if (val == '') {
            spanError.text('Please enter value');
            return false;
        } else if (isNaN(val) || val == 0) {
            spanError.text('Value must be a number greater than zero');
            return false;
        }

        // calculate total per size and total
        var closestTd = that.closest('td');
        var closestTr = that.closest('tr');
        var thatTds = closestTr.find('td');
        var totalPerSizeSingle = closestTd.siblings('td.total-per-size');
        var totalPerSizeAll = $('#bannerForm').find('td.total-per-size');
        var bannerPrice = parseFloat(closestTr.find('span.banner-price').text());
        var totalPerSizeSingleText = totalPerSizeSingle.find('span:first-child').text();

        var totalPerSize = parseFloat(totalPerSizeSingleText);
        var total = 0;

        var inputCheckbox = closestTd.find('input:checked');
        var fieldVal = parseFloat(inputCheckbox.siblings('.price-per-time-holder').find('span:first-child').text());
        var fieldValMultipliedByDuration = fieldVal * parseFloat(val);
        $('<input>').attr({
            type: 'hidden',
            class: 'pmd',
            value: fieldValMultipliedByDuration
        }).insertAfter(inputCheckbox);
        if (isNaN(fieldVal)) {
            return true;
        } else {
            totalPerSize += fieldValMultipliedByDuration;
        }

        if (totalPerSizeSingleText == '0.00') {
            totalPerSize = totalPerSize + bannerPrice;
        }

        totalPerSizeSingle.find('span:first-child').text(totalPerSize.toFixed(2));

        $.each(totalPerSizeAll, function (index, field) {
            var elVal = parseFloat($(field).find('span:first-child').text());
            if (isNaN(elVal)) {
                return true;
            } else {
                total += elVal;
            }
        });

        $('td.total-banners').find('span:first-child').text(total.toFixed(2));

        modal.modal('hide');
        spanError.text('');

        that.closest('.form-group').find('input:checkbox').prop('checked', true);
    });

    // set price to zero if user chooses option to upload his own banner
    $('.prepared_flyer').on('click', function () {
        var that = $(this);

        if (that.is(':checked')) {
            var bannerSizesPriceArray = [];

            $.each($('tr.banner-size'), function (index, value) {
                var that = $(this);
                bannerPriceTd = that.find('.banner-price-td');
                bannerPrice = bannerPriceTd.find('span.banner-price');
                bannerPriceVal = parseFloat(bannerPrice.text());
                totalPerSize = that.find('td.total-per-size span:first-child');
                totalPerSizeVal = parseFloat(totalPerSize.text());
                totalBanners = $('td.total-banners span:first-child');
                totalBannersVal = parseFloat(totalBanners.text());

                bannerSizesPriceArray.push(bannerPriceVal);

                if (totalPerSizeVal > 0 && totalPerSizeVal >= bannerPriceVal) {
                    var totalPerSizeNewVal = totalPerSizeVal - bannerPriceVal;
                    totalPerSize.text(totalPerSizeNewVal.toFixed(2));
                }

                bannerPrice.text('0.00');
            });

            var total = 0;
            var totalPerSizeAll = $('#bannerForm').find('td.total-per-size');
            $.each(totalPerSizeAll, function (index, field) {
                var elVal = parseFloat($(field).find('span:first-child').text());
                if (isNaN(elVal)) {
                    return true;
                } else {
                    total += elVal;
                }
            });

            totalBanners.text(total.toFixed(2));

            // set the session for the banner size prices
            localStorage.setItem('bannerSizesPrices', JSON.stringify(bannerSizesPriceArray));
        } else {
            // get the session for the banner size prices
            var bannerSizesPriceArray = JSON.parse(localStorage.getItem('bannerSizesPrices'));

            $.each($('tr.banner-size'), function (index, value) {
                var that = $(this);
                bannerPriceTd = that.find('.banner-price-td');
                bannerPrice = bannerPriceTd.find('span.banner-price');
                    bannerPriceVal = bannerSizesPriceArray[index]; // difference
                    totalPerSize = that.find('td.total-per-size span:first-child');
                    totalPerSizeVal = parseFloat(totalPerSize.text());
                    totalBanners = $('td.total-banners span:first-child');
                    totalBannersVal = parseFloat(totalBanners.text());

                    if (totalPerSizeVal > 0 && totalPerSizeVal >= bannerPriceVal) {
                    var totalPerSizeNewVal = totalPerSizeVal + bannerPriceVal; // diferrence in minuts
                    totalPerSize.text(totalPerSizeNewVal.toFixed(2));
                }

                bannerPrice.text(bannerPriceVal.toFixed(2)); //difference in value
            });

            var total = 0;
            var totalPerSizeAll = $('#bannerForm').find('td.total-per-size');
            $.each(totalPerSizeAll, function (index, field) {
                var elVal = parseFloat($(field).find('span:first-child').text());
                if (isNaN(elVal)) {
                    return true;
                } else {
                    total += elVal;
                }
            });

            totalBanners.text(total.toFixed(2));

            // set the session for the banner size prices to an empty array once everything is done
            localStorage.setItem('bannerSizesPrices', JSON.stringify([]));
        }
    });
</script>
@stop