@extends('layouts.app')

@section('title', 'About Me')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditLocalProfileMenu('about_me') !!}
        </div>
        <div class="col-sm-10 profile-info" >
            <h3>{{ __('headings.about_us') }}</h3>
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row" style="margin-left: 1px;">
                {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/about_me/store', 'method' => 'put']) !!}
                <div class="form-group">
                    <label for="comment">{{ __('labels.text_area') }}</label>
                    <textarea class="form-control" rows="5" id="comment" name="about_me">{{ $local->about_me }}</textarea>
                    @if ($errors->has('about_me'))
                        <span class="help-block">{{ $errors->first('about_me') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop




