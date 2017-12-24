@extends('layouts.app')

@section('title', '| Forgot Password')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/reset.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('buttons.rrl') }}</div>
                <div class="panel-body">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    {!! Form::open(['url' => 'password/email']) !!}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('labels.email')]) }}
                            @if ($errors->has('email'))
                                <strong><span class="help-block">
                                    {{ $errors->first('email') }}
                                </span></strong>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('buttons.rrl'), ['class' => 'btn btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop