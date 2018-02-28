@extends('layouts.app') @section('title', __('buttons.prices')) @section('styles')
<!-- Styles go here -->
<link rel="stylesheet" href="{{ asset('css/components/girls.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/components/prices.css?ver=' . str_random(10)) }}"> @stop @section('content')
<!-- Content goes here -->

<div class="container prices_banners">
     <h3>Packages</h3>
      <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>First Package <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_1">
                    <h2>Lokale des monats</h2>
                    <p>Platzierung: Regionalseite</p>
                    <p>Preis/Tag: Fr. 70.-</p>
                    <p>Format: 950x120 | nicht animiert | JPEG</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/LOKALE%20DES%20MONATS.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/LOKALE%20DES%20MONATS.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Second Package <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description pck_2">
                    <h2>Private des monats</h2>
                    <p>Platzierung: Regionalseite</p>
                    <p>Preis/Tag: Fr. 70.-</p>
                    <p>Format: 950x120 | nicht animiert | JPEG</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/PRIVATE%20DES%20MONATS.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/PRIVATE%20DES%20MONATS.png" alt="">
                </div>
            </div>
        </div>
    </div>
    
    
   <h3>Banners</h3>
    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>First Banner <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description ban_1">
                    <h2>First Banner</h2>
                    <p>Platzierung: Regionalseite</p>
                    <p>Preis/Tag: Fr. 70.-</p>
                    <p>Format: 950x120 | nicht animiert | JPEG</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/HOME.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/HOME.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Second Banner <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description ban_2">
                    <h2>Second Banner</h2>
                    <p>Platzierung: Regionalseite</p>
                    <p>Preis/Tag: Fr. 70.-</p>
                    <p>Format: 950x120 | nicht animiert | JPEG</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/PRIVATE.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/PRIVATE.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="row prices_banners_block">
        <div class="shop-layout canton-layout headerDropdown">
            <div class="layout-title prices_title">
                <div class="layout-title toggle_arrow">
                    <a>Third Banner <i class="fa fa-caret-down"></i></a>
                </div>
            </div>
            <div class="layout-list ban_block">
                <div class="col-lg-6 description ban_3">
                    <h2>Third Banner</h2>
                    <p>Platzierung: Regionalseite</p>
                    <p>Preis/Tag: Fr. 70.-</p>
                    <p>Format: 950x120 | nicht animiert | JPEG</p>
                </div>
                <div class="col-lg-6 image">
                    <img class="img-responsive mobile" src="../img/prices/LOKAL.png" alt="">
                    <img class="img-responsive" src="../img/prices_mobile/LOKAL.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@stop @section('perPageScripts')
<!-- Scripts go here -->
<script>
    $('.control__indicator').on('click', function() {
        window.location.href = $(this).closest('label').find('a').attr('href');
    });
</script>
<script>

    var fa = $('i.fa');

    if ($(window).width() < 992) {
        fa.removeClass('fa-caret-down').addClass("fa-caret-right");
    }

    $(window).on('resize', function () {
        if ($(this).width() < 992) {
            return fa
                .removeClass('fa-caret-down')
                .removeClass('rotateCaretBack')
                .removeClass('rotateCaret')
                .addClass("fa-caret-right")
                .closest('.shop-layout')
                .find('.layout-list')
                .hide('fast');
        } else {
            return fa
                .removeClass('fa-caret-right')
                .removeClass('rotateCaretBack')
                .removeClass('rotateCaret')
                .addClass("fa-caret-down")
                .closest('.shop-layout')
                .find('.layout-list')
                .show('fast');
        }
    })

    $(".toggle_arrow").on("click", function() {
        var that = $(this);
        that.closest('.shop-layout').find('.layout-list').toggle('fast');
        that.parent().find(".fa-caret-right").toggleClass("rotateCaret");
        that.parent().find(".fa-caret-down").toggleClass("rotateCaretBack");
    });
</script>
@stop