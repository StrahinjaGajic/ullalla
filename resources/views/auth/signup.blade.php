@extends('layouts.app')

@section('title', 'Sign Up')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/sign_in.css') }}">
@stop

@section('content')
<div class="wrapper section-signup">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
               <img src="img/logo.png" width="150" height="150" alt="">
                <h3 class="card-header text-center">Ullalla</h3>
                <div class="card-block">
                    {!! Form::open(['url' => 'signup']) !!}
                    <div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label for="username" class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input id="username" class="form-control {{ $errors->has('username') ? 'form-control-error' : '' }}" type="text" name="username" placeholder="Username" value="{{ old('username') }}" autofocus>
                            @if ($errors->has('username'))
                            <div class="help-block">{{ $errors->first('username') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input id="email" class="form-control {{ $errors->has('email') ? 'form-control-error' : '' }}" type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <div class="help-block">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input id="password" class="form-control{{ $errors->has('password') ? ' form-control-error' : '' }}" type="password" placeholder="Password" name="password">
                            @if ($errors->has('password'))
                            <div class="help-block">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' form-control-error' : '' }}" type="password" placeholder="Confirm Password" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                            <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('user_type') ? ' has-error' : '' }}">
                        <label for="user_type" class="col-3 col-form-label">Type</label>
                        <div class="col-9">
                            <select name="user_type" id="user_type" class="form-control {{ $errors->has('user_type') ? ' form-control-error' : '' }}">
                                @foreach ($userTypes as $userType)
                                <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_type'))
                            <div class="help-block">{{ $errors->first('user_type') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
