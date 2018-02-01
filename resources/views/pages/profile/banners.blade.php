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
            @if($user->banners()->count() > 20)
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
                    <label class="control control--checkbox"><a>{{ __('fields.prepared_banner') }}</a>
                        <input type="checkbox" name="banner_flyer" class="prepared_flyer" {{ old('banner_flyer') ? 'checked' : '' }}>
                        <div class="control__indicator"></div>
                    </label>
                </div>

                {{-- <div class="form-group {{ $errors->has('banner_duration') ? 'has-error' : '' }}">
                    <label class="control-label">{{ __('fields.duration') }}*</label>
                    <input type="text" class="form-control events_duration" name="banner_duration" value="{{ old('banner_duration') }}"/>
                    <input type="hidden" name="duration"/>
                    <span class="help-block">{{ $errors->has('banner_duration') ? $errors->first('banner_duration') : '' }}</span>
                </div> --}}

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
                        <tr>
                            <td class="banner-price-td">
                                <span style="display: block;">{{ $size->banner_size_name }}</span>
                                <span class="banner-price">{{ number_format($size->banner_size_price, 2) }}</span>
                                <span>CHF</span>
                            </td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td>W</td>
                                    </tr>
                                    <tr>
                                        <td>M</td>
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
                                        <input type="checkbox" name="price_per_day[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" {{ old('price_per_day') ? 'checked' : '' }} data-toggle="modal" data-target="#price_per_day{{ $size->id }}{{ $page->id }}">
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
                                            <input type="text" name="banner_duration[price_per_day][{{ $page->id }}][{{ $size->id }}]">
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
                                        <input type="checkbox" name="price_per_week[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" {{ old('price_per_week') ? 'checked' : '' }} data-toggle="modal" data-target="#price_per_week{{ $size->id }}{{ $page->id }}">
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
                                            <input type="text" name="banner_duration[price_per_week][{{ $page->id }}][{{ $size->id }}]">
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
                                        <input type="checkbox" name="price_per_month[{{ $page->id }}][{{ $size->id }}]" class="price_per_duration" {{ old('price_per_month') ? 'checked' : '' }} data-toggle="modal" data-target="#price_per_month{{ $size->id }}{{ $page->id }}">
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
                                            <input type="text" name="banner_duration[price_per_month][{{ $page->id }}][{{ $size->id }}]">
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
                    <input type="text" class="form-control" name="banner_url" value="{{ old('banner_url') }}" />
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
        $("input.price_per_duration:checkbox").on('change', function(event) {
            var that = $(this);
            var thatVal = that.val();
            var formGroup = that.closest('.form-group');
            var closestTr = that.closest('tr');
            var closestTd = that.closest('td');
            var bannerPrice = parseFloat(closestTr.find('span.banner-price').text());
            var pricePerTimeMultipleDurationEl = closestTd.find('.pmd');
            var pricePerTimeMultipleDuration = pricePerTimeMultipleDurationEl.attr('value');
            console.log(pricePerTimeMultipleDuration);
            // var pricePerTime = formGroup.find('.price-per-time-holder span:first-child').text();
            // var duration = formGroup.find('.modal').find('input[type="text"]').val();

            // var pricePerTimeMultipleDuration = parseFloat(pricePerTime) * parseFloat(duration);

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
</script>

@stop