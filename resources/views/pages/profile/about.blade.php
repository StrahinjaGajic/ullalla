@extends('layouts.app')

@section('title', __('headings.about_me'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
    <div class="shop-header-banner">
        <span><img src="img/banner/profil-banner.jpg" alt=""></span>
    </div>
    <div class="container theme-cactus">
        <div class="row">
            <div class="col-sm-2 vertical-menu">
                {!! parseEditProfileMenu('about_me') !!}
            </div>
            <div class="col-sm-10 profile-info" >
                <h3>{{ __('headings.about_me') }}</h3>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="row">
                    {!! Form::model($user, ['url' => '@' . $user->username . '/about_me/store', 'method' => 'put']) !!}
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="comment" name="about_me">{{ $user->about_me }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop




