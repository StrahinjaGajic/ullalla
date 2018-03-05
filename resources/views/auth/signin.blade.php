@extends('layouts.app') 

@section('title', 'Sign In') 

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/components/sign_in.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="<wrapper></wrapper> section-signin">
    <div class="container">
        <div class="row sign_in_form">
            <div class="col-md-4 col-md-offset-4 center">
                <div class="card">
                    <div class="card-block">
                        {!! Form::open(['url' => 'signin', 'id' => 'sign_in_form']) !!}
                        <div class="form-group {{ $errors->has('username') ? 'has-danger' : '' }}">
                            <label for="username" class="col-2 col-form-label"></label>
                            <div class="col-6">
                                <input id="username" class="form-control {{ $errors->has('username') ? 'form-control-danger' : '' }}" type="text" placeholder="{{ __('labels.username') }}" name="username" value="{{ old('username') }}" autofocus> @if ($errors->has('username'))
                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label for="password" class="col-2 col-form-label"></label>
                            <div class="col-6">
                                <input id="password" class="form-control {{ $errors->has('password') ? 'form-control-danger' : '' }}" type="password" placeholder="{{ __('labels.password') }}" name="password"> @if ($errors->has('password'))
                                <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        @if (Session::has('error'))
                        <div class="help-block">
                            {{ Session::get('error') }}
                        </div>
                        @endif
                        <div class="form-group forgot_password">
                            <a style="color:#363636" href="{{ url('password/reset') }}">{{ __('global.forgot_password') }}?</a>
                        </div>
                        <div style="clear: both;">
                            <div class="text-center">
                            <button type="submit" class="btn btn-default">{{ __('buttons.login') }}</button>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop