@extends('layouts.app')

@section('title', __('headings.about_me'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            @if(Auth::guard('local')->check())
                {!! parseEditProfileMenu('about_me', $user->id) !!}
            @else
                {!! parseEditProfileMenu('about_me') !!}
            @endif
        </div>
        <div class="col-sm-10 profile-info" >
            <h3>{{ __('headings.about_me') }}</h3>
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row">
                {!! Form::model($user, ['url' => 'private/' . $user->id . '/about_me/store', 'method' => 'put']) !!}
                <div id="about" class="form-group" style="margin-left:15px;">
                    <textarea class="form-control" rows="5" id="comment" name="about_me">{{ $user->about_me }}</textarea>
                    @if ($errors->has('about_me'))
                        <span class="help-block">{{ $errors->first('about_me') }}</span>
                    @endif
                    <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
