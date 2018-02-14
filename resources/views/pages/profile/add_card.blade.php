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
            {!! Form::open(['url' => '@' . $user->username . '/card/store', 'class' => 'form-horizontal wizard', 'id' => 'cardForm']) !!}
            <div class="col-xs-12">
                <button type="submit" class="btn btn-default pull-left">Add Card</button>
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