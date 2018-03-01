@extends('layouts.app')

@section('title', __('functions.add_card'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            @if(Auth::guard('local')->check())
                {!! parseEditLocalProfileMenu('add_card') !!}            
            @else
                {!! parseEditProfileMenu('add_card') !!}
            @endif
        </div>
        <div class="col-sm-10 profile-info">
            <div class="col-xs-12">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            {!! Form::open(['url' => 'card/store', 'class' => 'form-horizontal wizard', 'id' => 'cardForm']) !!}
            <div class="col-xs-12">
                @if($user->stripe_last4_digits)
                   <div class="add_card">
                    <p style="color:#424242;">{{ __('functions.card_on_file') }}: **** **** **** {{ $user->stripe_last4_digits }}</p>
                       <button type="submit" class="btn btn-default pull-left">{{ $user->stripe_id ? __('buttons.update_card') : __('buttons.add_card') }}</button>
                    </div>
                @else
                <button type="submit" class="btn btn-default pull-left">{{ __('buttons.add_card') }}</button>
                @endif
                <div class="help-block card-error" style="color: red;"></div>
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
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    let stripe = StripeCheckout.configure({
        key: '{{ getStripePublishableKey() }}',
        image: '{{ asset('img/logo.png') }}',
        locale: 'auto',
        token: function (token) {
            var stripeEmail = $('#stripeEmail');
            var stripeToken = $('#stripeToken');
            stripeEmail.val(token.email);
            stripeToken.val(token.id);
            // submit the form
            var url = getUrl('/card/store');
            var token = $('input[name="_token"]').val();
            var form = $('#cardForm');
            var data = form.serialize();

            // add loading class
            $('#loading').removeClass('is-hidden');

            // fire ajax post request
            $.post(url, data)
            .done(function (response, textStatus) {
                var redirectUrl = '{{ Auth::guard('local')->check() ? url('locals/@' . $user->username . '/add_card') : url('private/' . $user->id . '/add_card') }}';
                window.location.href = redirectUrl;
            })
            .fail(function(data, textStatus) {
                // remove loading spinner
                $('#loading').addClass('is-hidden');
                $('.card-error').text(data.responseJSON.status);
            });
        }
    });
    $('#cardForm').on('submit', function (e) {
        stripe.open({
            name: 'Ullallà',
            description: 'Change a credit card on file',
            panelLabel: 'Save',
            allowRememberMe: false,
            email: '{{ $user->email }}'
        });
        e.preventDefault(); 
    });
</script>

@stop