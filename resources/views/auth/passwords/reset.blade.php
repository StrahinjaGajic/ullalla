@extends('layouts.app')

@section('title', '| Reset Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'password/reset']) !!}

                        {{ Form::hidden('token', $token) }}

                        <div class="form-group {{ $errors->has('email') }}">
                            {{ Form::email('email', $email, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            @if ($errors->has('email'))
                                <strong><span class="help-block">
                                    {{ $errors->first('email') }}
                                </span></strong>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'New Password']) }}
                        @if ($errors->has('password'))
                            <strong><span class="help-block">
                                {{ $errors->first('password') }}
                            </span></strong>
                        @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                            @if ($errors->has('password_confirmation'))
                                <strong><span class="help-block">
                                    {{ $errors->first('password_confirmation') }}
                                </span></strong>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop