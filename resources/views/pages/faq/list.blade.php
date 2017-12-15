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

                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="faq-header">Frequently Asked Questions</div>
                            @foreach($faqs as $faq)
                                <div class="faq-c">
                                    <div class="faq-q"><span class="faq-t">+</span>{{ $faq->question }}</div>
                                    <div class="faq-a">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
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