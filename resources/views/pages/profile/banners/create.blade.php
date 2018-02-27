@extends('layouts.app')

@section('title', __('functions.banners'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/components/girls.css?ver=' . str_random(10)) }}">
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
                <div class="form-group {{ $errors->has('banner_url') ? 'has-error' : '' }}" style="margin: 0;">
                    <label class="control control--checkbox" style="margin-left: 0;"><a>{{ __('fields.prepared_banner') }}</a>
                        <input type="checkbox" name="banner_flyer" class="prepared_flyer" {{ old('banner_flyer') ? 'checked' : '' }} autocomplete="off">
                        <div class="control__indicator"></div>
                    </label>
                </div>
                <div class="help-block banner-error" style="color: red;">
                    @if($errors->has('price_per_week') || $errors->has('price_per_month'))
                        Please choose at least one banner
                    @elseif($errors->has('stripe_error'))
                        {{ $errors->first() }}
                    @endif
                </div>
                <div style="overflow-x: auto;">
                    <table class="table table-bordered create_banner_table">
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
                                <td class="price_per">
                                    <table class="table inner_table">
                                        <tr>
                                            <td>Price Per Week</td>
                                        </tr>
                                        <tr>
                                            <td>Price Per Month</td>
                                        </tr>
                                    </table>
                                </td>
                                @foreach($pages as $page)
                                <td class="form_group_td">
                                    @php 
                                        $price = $size->pages()->where('banner_size_id', $size->id)->where('page_id', $page->id)->first();
                                    @endphp
                                    {{ $price ? $price->pivot->banner_price : '' }}
                                    @foreach($perTimeColumns as $perTimeColumn)
                                        @if($price)
                                            @php
                                                $pptId = $perTimeColumn . $size->id . $page->id;
                                            @endphp
                                            <div class="form-group banner_inner_form_group" style="position: relative;">
                                                <label class="control control--checkbox">
                                                    <div class="price-per-time-holder">
                                                        <span>{{ $price ? $price->pivot->$perTimeColumn : '' }}</span>
                                                    </div>
                                                    <input type="checkbox" name="{{ $perTimeColumn }}[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" data-toggle="modal" data-target="#{{ $pptId }}" autocomplete="off">
                                                    <div class="control__indicator"></div>
                                                </label>
                                                <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="{{ $pptId }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <ul class="nav nav-pills">
                                                                    <li class="step active">
                                                                        <a href="#duration-tab-{{ $pptId }}">{{ __('fields.duration') }}</a>
                                                                    </li>
                                                                    <li class="step flyerless-fields">
                                                                        <a href="#description-tab-{{ $pptId }}">{{ __('fields.description') }}</a>
                                                                    </li>
                                                                    <li class="step">
                                                                        <a href="#website-tab-{{ $pptId }}">{{ __('fields.website') }}</a>
                                                                    </li>
                                                                    <li class="step">
                                                                        <a class="step" href="#photo-tab-{{ $pptId }}">{{ __('fields.photo') }}</a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content">
                                                                    <section class="tab-pane active" id="duration-tab-{{ $pptId }}">
                                                                        <div class="form-group banner_days">
                                                                            <label>{{ __('fields.label_' . $perTimeColumn) }}</label>
                                                                            <input class="form-control banner_duration" type="text" name="banner_duration[{{ $perTimeColumn }}][{{ $page->id }}][{{ $size->id }}]"  autocomplete="off" style="color: #fff; background-color: #222;" oninput="removeError(this)">
                                                                            <span class="help-block" style="color: red;"></span>
                                                                        </div>
                                                                    </section>

                                                                    <section class="tab-pane" id="description-tab-{{ $pptId }}">
                                                                        <div class="form-group flyerless-fields banner_days">
                                                                            <label class="control-label">{{ __('fields.description') }} *</label>
                                                                            <textarea name="description[{{ $perTimeColumn }}][{{ $page->id }}][{{ $size->id }}]" class="form-control banner_description" oninput="removeError(this)"></textarea>
                                                                            <span class="help-block" style="color: red;"></span>
                                                                        </div>
                                                                    </section>

                                                                    <section class="tab-pane" id="website-tab-{{ $pptId }}">
                                                                        <div class="form-group banner_days">
                                                                            <label class="control-label">{{ __('fields.website') }} *</label>
                                                                            <input class="form-control banner_website" type="text" name="website[{{ $perTimeColumn }}][{{ $page->id }}][{{ $size->id }}]"  autocomplete="off" style="color: #fff; background-color: #222;" oninput="removeError(this)">
                                                                            <span class="help-block" style="color: red;"></span>
                                                                        </div>
                                                                    </section>
                                                                    <section class="tab-pane" id="photo-tab-{{ $pptId }}">
                                                                        <div class="form-group banner_days">
                                                                            <input type="hidden" class="banner_photo" name="banner_photo[{{ $perTimeColumn }}][{{ $page->id }}][{{ $size->id }}]" data-crop="490x560 minimum" data-images-only="" autocomplete="off">
                                                                            <span class="help-block" style="color: red;"></span>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default discard-duration pull-left" data-dismiss="modal" style="margin-top:0;">Discard</button>
                                                                <button type="button" class="btn btn-default pull-right next-btn" onclick="nextPrev(1, this)" style="margin-top:0;">Next</button>
                                                                <button type="button" class="btn btn-default pull-right prev-btn" onclick="nextPrev(-1, this)" style="margin-top:0;">Previous</button>
                                                                {{-- <button type="button" class="btn btn-default apply-duration" style="margin-top:0;">Finish</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
                </div>
                {{-- <div class="form-group {{ $errors->has('banner_url') ? 'has-error' : '' }}" style="margin: 0;">
                    <label class="control-label">{{ __('fields.url') }}*</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ old('banner_url') }}" autocomplete="off"/>
                    <span class="help-block">{{ $errors->has('banner_url') ? $errors->first('banner_url') : '' }}</span>
                </div>
                <div class="flyerless-fields">
                    <div class="form-group {{ $errors->has('banner_description') ? 'has-error' : '' }}" style="margin: 0;">
                        <label class="control-label">{{ __('fields.description') }}*</label>
                        <textarea class="form-control" name="banner_description" style="margin-top:10px;">{{ old('banner_description') }}</textarea>
                        <span class="help-block">{{ $errors->has('banner_description') ? $errors->first('banner_description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('banner_photo') ? 'has-error' : '' }}" style="margin: 0;">
                    <div class="image-preview-multiple">
                        <input type="hidden" name="banner_photo" data-crop="490x560 minimum" data-images-only="" autocomplete="off">
                        <span class="help-block">{{ $errors->has('banner_photo') ? $errors->first('banner_photo') : '' }}</span>
                    </div>
                </div> --}}
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
        const bannerWidget = uploadcare.Widget('[class=banner_photo]');
        bannerWidget.validators.push(minDimensions(490, 560));
        bannerWidget.validators.push(maxFileSize(20000000));
    });

    function removeUploadCareError(widget, that) {
            widget.onChange(function(file) {
                if (file) {
                    file.done(function(fileInfo) {
                        removeError(that);
                    });
                }
            });
        }
        $('.banner_photo').each(function() {
            removeUploadCareError(uploadcare.SingleWidget($(this)), $(this));
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

        var diffInDays = parseFloat(form.find('input[class="banner_duration"]').val());

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
                            if (index == 'price_per_week' || index == 'price_per_month') {
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
    @if(!$user->stripe_last4_digits)
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
            showTab(0, that);
            resetCurrentTab();

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
        resetCurrentTab();
    });

    // $('.apply-duration').on('click', function () {

    // });

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

function resetCurrentTab() {
    currentTab = 0;
}

var currentTab = 0;

function showTab(num, el = null) {
    // display the specified tab
    var formGroup = $(el).closest('.form-group');
    var tab = formGroup.find('.tab-pane');
    var nextBtn = formGroup.find('button.next-btn');
    var prevBtn = formGroup.find('button.prev-btn');

    $(tab[num]).addClass('active');
    // fix the Previous/Next buttons:
    if (num > 0) {
        console.log();
        prevBtn.css('display', 'block');
    } else {
        prevBtn.css('display', 'none');
    }
    if (num == (tab.length - 1)) {
        nextBtn.text('Finish');
    } else {
        nextBtn.text('Next');    
    }
    // display the correct step
    fixStepIndicator(num, el);
}

function nextPrev(num, el = null) {
    // This function will figure out which tab to display
    var tab = $(el).closest('.form-group').find('.tab-pane');
    // Exit the function if any field in the current tab is invalid:
    if (num == 1 && !validateForm(el)) return false;
    // hide the current tabf
    $(tab[currentTab]).removeClass('active');
    // increase or decrease the current tab by 1:
    currentTab = currentTab + num;

    // end of the wizard
    if (currentTab >= tab.length) {
        console.log('done');

        return false;
    }

    // Otherwise, display the correct tab:
    showTab(currentTab, el);
}

function validateForm(el) {
    // validate
    var tab = $(el).closest('.form-group').find('.tab-pane');
    var y, i, valid = true;
    input = $(tab[currentTab]).find('[name]');

    // validate inputs
    for (i = 0; i < input.length; i++) {
        var input = $(input[i]);
        var val = input.val();

        // If a field is empty...
        if (val == "") {
            input.siblings('.help-block').text('This field is required');
            valid = false;
        } else if(input.hasClass('banner_duration') && (isNaN(val) || val == 0)) {
            input.siblings('.help-block').text('Value must be a number greater than zero');
            valid = false;
        } else if(input.hasClass('banner_website') && !validateUrl(val)) {
            input.siblings('.help-block').text('Please enter a valid website');
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }

    return valid; // valid
}

function fixStepIndicator(num, el = null) {
    // remove the active class of all steps
    var i, steps = $(el).closest('.form-group').find('.step');
    for (i = 0; i < steps.length; i++) {
        var step = steps[i];
        step.className = step.className.replace(" active", "");

    }
    // add the active class to the current step
    $(steps[num]).addClass('active');
}

function removeError(that) {
    $(that).siblings('.help-block').text('');
}

</script>
@stop