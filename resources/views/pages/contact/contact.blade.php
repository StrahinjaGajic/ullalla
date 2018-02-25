@extends('layouts.app') @section('title', 'Contact us') @section('content')
<div class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 col-lg-offset-3">
                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-title">
                            <h3 style="color:#f26522">Contact Us</h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        {!! Form::open(['url' => 'contact/send', 'method' => 'POST']) !!}
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 npl">
                            <label class="l-contact">
                                            {{ __('labels.name') }}
                                            <em>*</em>
                                        </label>
                            <input name="name" class="form-control" type="text" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contactemail npr">
                            <label class="l-contact">
                                            {{ __('labels.email') }}
                                            <em>*</em>
                                        </label>
                            <input name="email" class="form-control" type="email" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 npl">
                            <label class="l-contact">
                                            {{ __('labels.subject') }}
                                            <em>*</em>
                                        </label>
                            <input name="subject" class="form-control" type="text" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 np">
                            <label class="l-contact">
                                            {{ __('labels.comment') }}
                                            <em>*</em>
                                        </label>
                            <textarea name="message" class="form-control" required></textarea>


                            <div class="actions actn-contact">
                                <label class="c-contact cc-con">
                                        <em>*</em>
                                        {{ __('labels.required_fields') }}
                                    </label><br>
                                <div class="product-cart contact">
                                    <button type="submit" class="button">{{ __('buttons.submit') }}</button>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-area-2 home-4">
    <div class="container">
        <div class="row">
            @if($smallBanners->count() > 0)
                @foreach($smallBanners->chunk(2) as $banners)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="single-banner home-3">
                            @foreach($banners as $banner)
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 small_banner">
                                    <a href="/#"><span><img src="{{ $banner->banner_photo }}" alt="" /></span></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@stop