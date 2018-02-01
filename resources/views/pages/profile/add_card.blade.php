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
            {!! parseEditProfileMenu('add_card') !!}
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

            {!! Form::open(['url' => '@' . $user->username . '/card/store', 'class' => 'form-horizontal wizard', 'id' => 'cardForm']) !!}
            <div class="col-xs-12">
                <button type="submit" class="btn btn-default pull-left">{{ __('buttons.submit') }}</button>
                <input type="hidden" name="stripeToken" id="stripeToken">
                <input type="hidden" name="stripeEmail" id="stripeEmail">
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@stop

@section('perPageScripts')
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
            var url = getUrl('/@' + username + '/add_card/store');
            var token = $('input[name="_token"]').val();
            var form = $('#cardForm');
            var data = form.serialize();
            // fire ajax post request
            $.post(url, data)
            .done(function (response, textStatus) {
                console.log(response.customer);
                // var errors = response.errors;
                // $('.form-group').removeClass('has-error');
                // $('.help-block').text('');
                // if (errors) {
                //     console.log(errors);
                //     $.each(errors, function (index, value) {
                //         var errorField = $('[name="' + index + '"]');
                //         errorField.siblings('.help-block').text(value);
                //         errorField.closest('.form-group').addClass('has-error');
                //         if (index == 'price_per_day' || index == 'price_per_week' || index == 'price_per_month') {
                //             $('.banner-error').text('Please choose at least one banner');
                //         }
                //     });
                // } else {
                //     window.location.href = getUrl('/@' + username  + '/add_card');
                // }
            })
            .fail(function(data, textStatus) {
                $('.banner-error').text(data.responseJSON.status);
            });
        }
    });
    $('#cardForm').on('submit', function (e) {
        stripe.open({
            name: 'Ullallà',
            description: 'Add Card',
            panelLabel: 'Update Card Details',
            allowRememberMe: false,
            email: '{{ $user->email }}'
        });
        e.preventDefault(); 
    });
</script>

@stop