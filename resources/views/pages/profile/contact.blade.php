@extends('layouts.app')

@section('title', __('headings.contact'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
@stop

@section('content')
<div class="shop-header-banner">
    <span><img src="img/banner/profil-banner.jpg" alt=""></span>
</div>

<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditProfileMenu('contact') !!}
        </div>
        <div class="col-sm-10 profile-info">
            {!! Form::model($user, ['url' => '@' . $user->username . '/contact/store', 'method' => 'put', 'id' => 'contactForm']) !!}
            <h3>{{ __('headings.contact') }}</h3>
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <label class="control control--checkbox" style="margin-left: 0px;"><a>{{ __('fields.sms_notify') }}</a>
                            <input type="checkbox" name="sms_notifications" {{ $user->sms_notifications ? 'checked' : '' }}>
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="email" value="{{ $user->email }}">
                        <label>{{ __('fields.email') }}*</label>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="website" value="{{ $user->website }}">
                        <label>{{ __('fields.website') }}</label>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="phone" value="{{ $user->phone }}">
                        <label>{{ __('fields.phone') }}</label>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-3 input-effect">
                        <label>{{ __('fields.mobile') }}*</label>
                        <input class="effect-16" type="tel" placeholder="" name="mobile" value="{{ $user->mobile }}" id="mobile">
                        <span class="focus-border"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" style="display: block; text-align: left;">{{ __('headings.available_apps') }}</label>
                        @foreach($contactOptions as $contactOption)
                        <label class="control control--checkbox" style="margin-right: 20px;"><a>{{ ucfirst($contactOption->contact_option_name) }}</a>
                            <input 
                            type="checkbox" 
                            name="contact_options[{{ $contactOption->id }}]" 
                            value="{{ $contactOption->id }}" 
                            id="{{ $contactOption->contact_option_name == 'skype' ? 'skype_contact' : '' }}" 
                            {{ $user->contact_options()->where('contact_option_id', $contactOption->id)->value('contact_option_id') ? 'checked' : '' }}>
                            <div class="control__indicator"></div>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" style="display: block; text-align: left;">{{ __('headings.i_prefer') }}</label>
                        @foreach(getPreferedOptions() as $key => $preferedOption)
                        <div class="col-sm-6" style="padding: 0px; margin: 0px;">
                            <label style="margin-right: 20px;">
                                <input 
                                type="radio" 
                                name="prefered_contact_option" 
                                value="{{ $key }}" 
                                style="display: inline-block;"
                                {{ $user->prefered_contact_option == $key ? 'checked' : '' }}>
                                {{ $preferedOption }}
                            </label>
                        </div>  
                        @endforeach
                        <div class="col-sm-6" style="padding: 0px; margin: 0px;">
                            <label class="control control--checkbox" style="margin-right: 20px; margin-left: 0px;">
                                <input 
                                type="checkbox" 
                                name="no_withheld_numbers" 
                                value="1" 
                                style="display: inline-block;" 
                                {{ $user->no_withheld_numbers ? 'checked' : '' }}>
                                <a>{{ __('fields.no_withheld_numbers') }}</a>
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 skype-name" style="{{ !$user->skype_name ? 'display: none' : '' }}">
                    <div class="form-group">
                        <input type="text" name="skype_name" placeholder="{{ __('functions.skype_name') }}*" class="form-control" value="{{ $user->skype_name }}">
                        @if($errors->has('skype_name'))
                        <div class="has-error">{{ $errors->first('skype_name') }}</div>
                        @endif
                    </div>
                </div>   
            </div>
            <div class="save">
                <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<script>
    var utilAsset = '{{ asset('js/utils.js') }}';
    var invalidUrl = '{{ __('validation.url_invalid') }}';
</script>
<script src="{{ asset('js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/formValidation.min.js') }}"></script>
<script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/phoneValidation.js') }}"></script>
<script>
    $(function () {
        $('input#skype_contact').on('click', function () {
            $('.skype-name').toggle();
        });
    });
</script>
@stop