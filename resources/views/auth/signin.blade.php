@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="wrapper section-signin">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <h3 class="card-header text-center">Sign In</h3>
                    <div class="card-block">
                        {!! Form::open(['url' => 'signin', 'id' => 'sign_in_form']) !!}
                        <div class="form-group row {{ $errors->has('username') ? 'has-danger' : '' }}">
                            <label for="username" class="col-2 col-form-label">Username</label>
                            <div class="col-6">
                                <input id="username" class="form-control {{ $errors->has('username') ? 'form-control-danger' : '' }}" type="text" name="username" value="{{ old('username') }}" autofocus>
                                @if ($errors->has('username'))
                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-6">
                                <input id="password" class="form-control {{ $errors->has('password') ? 'form-control-danger' : '' }}" type="password" name="password">
                                @if ($errors->has('password'))
                                <div class="form-control-feedback">{{ $errorss->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="pull-left" style="margin-left: -15px;">
                            <a href="{{ url('password/reset') }}">Forgot Password?</a>
                        </div>
                        @if (Session::has('error'))
                            <div class="help-block">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="pull-right" style="margin-right: -15px;">
                            <button type="submit" class="btn btn-outline-success btn-md">Sign In</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop