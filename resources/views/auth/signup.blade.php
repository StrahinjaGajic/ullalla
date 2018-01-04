@extends('layouts.app')

@section('title', 'Sign Up')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/sign_in.css') }}">
@stop

@section('content')
<div class="wrapper section-signup">
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <div class="card">
             <div class="card-block">
                {!! Form::open(['url' => 'signup', 'id' => 'sign_in_form']) !!}
                <div class="form-group {{ $errors->has('user_type') ? ' has-error' : '' }}">
                    {{-- <label for="user_type" class="col-3 col-form-label">{{ __('fields.type') }}</label> --}}
                    <div class="col-9">
                        <select name="user_type" id="user_type" class="form-control {{ $errors->has('user_type') ? ' form-control-error' : '' }}">
                            @php ($var = 'user_type_name_'. config()->get('app.locale'))
                            @foreach ($userTypes as $userType)
                            <option value="{{ $userType->id }}">{{ $userType->$var }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_type'))
                        <div class="help-block">{{ $errors->first('user_type') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="username" class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <input class="form-control {{ $errors->has('username') ? 'form-control-error' : '' }}" type="text" name="username" placeholder="{{ __('labels.username') }}" value="{{ old('username') }}" autofocus>
                        @if ($errors->has('username'))
                        <div class="help-block">{{ $errors->first('username') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <input id="email" class="form-control {{ $errors->has('email') ? 'form-control-error' : '' }}" type="text" name="email" placeholder="{{ __('labels.email') }}" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <div class="help-block">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <input id="password" class="form-control{{ $errors->has('password') ? ' form-control-error' : '' }}" type="password" placeholder="{{ __('labels.password') }}" name="password">
                        @if ($errors->has('password'))
                        <div class="help-block">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <input id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' form-control-error' : '' }}" type="password" placeholder="{{ __('labels.confirm_password') }}" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                        <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-default">{{ __('buttons.register') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@stop
