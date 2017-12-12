@extends('layouts.app') @section('title', 'Sign In') @section('styles')
<link rel="stylesheet" href="{{ asset('css/components/sign_in.css') }}"> @stop @section('content')
<div class="wrapper section-signin">
    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4 center">

                <div class="card">
                    <img src="img/logo.png" width="150" height="150" alt="">
                    <h3 class="card-header text-center">Ullalla</h3>
                    <div class="card-block">
                        {!! Form::open(['url' => 'signin', 'id' => 'sign_in_form']) !!}
                        <div class="form-group row{{ $errors->has('username') ? 'has-danger' : '' }}">
                            <label for="username" class="col-2 col-form-label"></label>
                            <div class="col-6">
                                <input id="username" class="form-control {{ $errors->has('username') ? 'form-control-danger' : '' }}" type="text" placeholder="Username" name="username" value="{{ old('username') }}" autofocus> @if ($errors->has('username'))
                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label for="password" class="col-2 col-form-label"></label>
                            <div class="col-6">
                                <input id="password" class="form-control {{ $errors->has('password') ? 'form-control-danger' : '' }}" type="password" placeholder="Password" name="password"> @if ($errors->has('password'))
                                <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="pull-left" style="margin-left: -15px;">
                            <a style="color:white" href="{{ url('password/reset') }}">Forgot Password?</a>
                        </div>
                        @if (Session::has('error'))
                        <div class="help-block">
                            {{ Session::get('error') }}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 col-md-offset-1">
                                <button type="submit" class="btn btn-default">Login</button>
                                <button type="submit" class="btn btn-default">Register</button>
                            </div>
                            <div class="col-md-6 col-md-offset-3">

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