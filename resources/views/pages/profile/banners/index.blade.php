@extends('layouts.app')

@section('title', __('functions.banners'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver' . str_random(10)) }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css?ver' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            @if(Auth::guard('local')->check())
                {!! parseEditLocalProfileMenu('banners') !!}
            @else
                {!! parseEditProfileMenu('banners') !!}
            @endif
        </div>
        <div class="col-sm-10 profile-info">
            <div class="btn-wrapper">
                @if(Auth::guard('local')->check())
                    <a href="{{ url('locals/@' . $user->username . '/banners/create') }}" class="add_new_banner">{{ __('buttons.add_banner') }}</a>
                @else
                    <a href="{{ url('private/' . $user->id . '/banners/create') }}" class="add_new_banner">{{ __('buttons.add_banner') }}</a>
                @endif
            </div>
            <div class="btn-wrapper">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            @if($banners->count() > 0)
            <div class="shop-layout headerDropdown">
                <div class="layout-title">
                    <div class="layout-title toggle_arrow banners_layout_title">
                        <a>{{ __('headings.banners') }} <i class="fa fa-caret-down"></i></a>
                    </div>
                </div>
                <div class="layout-list">
                    <div class="form-group girls_preview">
                       <div style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.photo') }}</th>
                                    <th>{{ __('fields.size') }}</th>
                                    <th>{{ __('fields.page') }}</th>
                                    <th>{{ __('fields.url') }}</th>
                                    <th>{{ __('headings.activation_date') }}</th>
                                    <th>{{ __('headings.expiry_date') }}</th>
                                    {{-- @if ($banner->banner_expiry_date > Carbon::now()) --}}
                                        <th>Manage Item</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody id="prices_body">
                                @foreach($banners as $banner)
                                <tr>
                                    <td>
                                        @if ($banner->banner_photo)
                                        <div class="image-tooltip">
                                            <img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($banner->banner_photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='banner image'/>
                                            <span>
                                                <img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($banner->banner_photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='banner image'/>
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $banner->banner_size_name }}</td>
                                    <td>{{ $banner->page_name }}</td>
                                    <td>{{ $banner->banner_url }}</td>
                                    <td>{{ date('d-m-Y', strtotime($banner->banner_activation_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($banner->banner_expiry_date)) }}</td>
                                    @if ($banner->banner_expiry_date < \Carbon\Carbon::now())
                                        <td>
                                            <a href="{{ url('private/' . $user->id . '/banners/edit/' . $banner->id) }}">Renew</a>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>  
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<script>
    $(".toggle_arrow").on("click", function() {
        var that = $(this);
        that.closest('.shop-layout').find('.layout-list').toggle('fast');
        that.parent().find(".fa-caret-down").toggleClass("rotateCaretBack");
    });
</script>

<script>
    var tooltips = document.querySelectorAll('.image-tooltip span');
    window.onmousemove = function (e) {
        var x = (e.clientX + 20) + 'px',
        y = (e.clientY + 20) + 'px';
        for (var i = 0; i < tooltips.length; i++) {
            tooltips[i].style.top = y;
            tooltips[i].style.left = x;
        }
    };
</script>
@stop
