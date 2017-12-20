@extends('layouts.app')

@section('title', 'Contact us')

@section('content')
    <div class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="shop-banner-area">
                        <div class="single-banner">
                            <a href="contact-us.html#">
                                <span>
                                    <img src="img/banner/contact%20baner.jpg" alt="banner">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="page-title">
                                <h1>Contact Us</h1>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            {!! Form::open(['url' => 'contact/send', 'method' => 'POST']) !!}
                                <div class="fieldset contact">
                                    <h2 class="legend">{{ __('headings.contact_info') }}</h2>
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
                                    </div>
                                </div>
                                <div class="actions actn-contact">
                                    <label class="c-contact cc-con">
                                        <em>*</em>
                                        {{ __('labels.required_fields') }}
                                    </label><br>
                                    <div class="product-cart contact">
                                        <button type="submit" class="button">{{ __('buttons.submit') }}</button>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-banner">
                        <a class="last-banner" href="index.html">
                            <span>
                                <img src="img/banner/fullwide-banner-4.jpg" alt="">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop