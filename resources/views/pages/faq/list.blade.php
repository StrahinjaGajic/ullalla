@extends('layouts.app')

@section('title', __('global.f_a_q'))

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
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                    <div class="row">

                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="faq-header">{{ __('global.f_a_q') }}</div>
                            @foreach($faqs as $faq)
                                <div class="faq-c">
                                    @php ($var = 'question_'. config()->get('app.locale'))
                                    <div class="faq-q"><span class="faq-t">+</span>{{ $faq->$var }}</div>
                                    <div class="faq-a">
                                        @php ($var = 'answer_'. config()->get('app.locale'))
                                        <p>{{ $faq->$var }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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