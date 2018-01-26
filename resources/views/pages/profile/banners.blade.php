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
            {!! parseEditLocalProfileMenu('banners') !!}
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
                        <a>{{ __('headings.news') }} <i class="fa fa-caret-down"></i></a>
                    </div>
                </div>
                <div class="layout-list">
                    <div class="form-group girls_preview">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.photo') }}</th>
                                    <th>{{ __('fields.title') }}</th>
                                    <th>{{ __('headings.activation_date') }}</th>
                                    <th>{{ __('headings.expiry_date') }}</th>
                                </tr>
                            </thead>
                            <tbody id="prices_body">
                                @foreach($user->banners as $news)
                                <tr>
                                    <td>
                                        @if ($news->news_photo)
                                        <div class="image-tooltip">
                                            <img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($news->news_photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='news image'/>
                                            <span>
                                                <img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($news->news_photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='news image'/>
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $news->news_title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($news->news_activation_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($news->news_expiry_date)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="wrapper section-create-profile">
    
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

        $('input[name="events_duration"]').daterangepicker({
            minDate: start,
            maxDate: end,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        $('input[name="events_date"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            minDate: start,
            maxDate: end,
            locale: {
                format: 'DD/MM/YYYY H:mm'
            }
        });

        $('input[name="news_duration"]').daterangepicker({
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
        const eventWidget = uploadcare.Widget('[name=events_photo]')
        const newsWidget = uploadcare.Widget('[name=news_photo]')
        eventWidget.validators.push(minDimensions(490, 560));
        eventWidget.validators.push(maxFileSize(20000000));
        newsWidget.validators.push(minDimensions(490, 560));
        newsWidget.validators.push(maxFileSize(20000000));
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

    $('.prepared_flyer').on('click', function () {
        var modalBody = $(this).closest('.modal-body');
        var flyerlessDiv = modalBody.find('.flyerless-fields');
        var totalEl = modalBody.find('.events_total');

        flyerlessDiv.toggle();

        var diffInDays = parseFloat(modalBody.find('input[name="duration"]').val());

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
        var modalBody = that.closest('.modal-body');
        var totalEl = modalBody.find('.events_total');
        var flyerlessDiv = modalBody.find('.flyerless-fields');

        var exploadedThatVal = thatVal.split(' - ');
        var from = moment(exploadedThatVal[0], 'DD/MM/YYYY');
        var to = moment(exploadedThatVal[1], 'DD/MM/YYYY');
        var diffInDays = to.diff(from, 'days');

        var total = eventPrice + (eventPricePerDay * diffInDays);
        totalEl.val(total.toFixed(2));
        that.next().val(diffInDays);

        if (!modalBody.is(':hidden')) {
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
        } else {
            totalEl.val(parseFloat('{{ getEventPrice(false, true) }}').toFixed(2));
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
            var url = getUrl('/@' + username + '/packages/store');
            var token = $('input[name="_token"]').val();
            var form = $('#profileForm');
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

@stop