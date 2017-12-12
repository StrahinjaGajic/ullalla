@extends('layouts.app')

@section('title', 'Contact')

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
                {!! parseEditLocalProfileMenu('contact') !!}
            </div>
            <div class="col-sm-10 profile-info">
                <h3>Personal info</h3>
                {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/contact/store', 'method' => 'put']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('username') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" placeholder="" name="username" value="{{ $local->username }}">
                                    <label>Username</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('username'))
                                        <span class="help-block">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('email') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="email" name="email" placeholder="" value="{{ $local->email }}">
                                    <label>Email</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('password') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="password" placeholder="" name="password">
                                    <label>Password</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('re-password') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="password" placeholder="" name="re-password">
                                    <label>Re Password</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('re-password'))
                                        <span class="help-block">{{ $errors->first('re-password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('name') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" placeholder="" name="name" value="{{ $local->name }}">
                                    <label>Name</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('street') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" name="street" placeholder="" value="{{ $local->street }}">
                                    <label>Street</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('street'))
                                        <span class="help-block">{{ $errors->first('street') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('phone') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" placeholder="" name="phone" value="{{ $local->phone }}">
                                    <label>Phone</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('city') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" name="city" placeholder="" value="{{ $local->city }}">
                                    <label>City</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('city'))
                                        <span class="help-block">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('web') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" placeholder="" name="web" value="{{ $local->web }}">
                                    <label>Web</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('web'))
                                        <span class="help-block">{{ $errors->first('web') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-3 input-effect {{ $errors->has('zip') ? 'has-error' : ''  }}">
                                    <input class="effect-16" type="text" name="zip" placeholder="" value="{{ $local->zip }}">
                                    <label>Zip</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('zip'))
                                        <span class="help-block">{{ $errors->first('zip') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Save Changes</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@stop
