@extends('layouts.app')
@section('title', 'Private')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/girls.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="wrapper section-single-girl">
    <div class="single-product-menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="shop-menu">
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('buttons.home') }}</a></li>
                            <li class="separator"><i class="fa fa-angle-right"></i></li>
                            <li>{{ __('buttons.profile') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-essential">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="zoomWrapper">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a>
                                <img id="is_image_large" class="expand" src="{{ $local->photos . 'nth/0/-/resize/490x560/' }}" alt="">
                            </a>
                            <div id="myModal" class="modal">
								<span class="close">&times;</span>
								<div class="modal-dialog modal-md club_modal_dialog">
                                    <div class="modal-content club_modal_content">
									    <img id="img01" src="{{ $local->photos . 'nth/0/-/resize/490x560/' }}">
                                        <div class="prev-next">
                                            <a type="button" onclick="prev()" id="prev" class="glyphicon glyphicon-chevron-left"></a>
                                            <a type="button" onclick="next()" id="next" class="glyphicon glyphicon-chevron-right" style="float:right;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="bxslider" id="gallery_01">
                                @for ($i = 0; $i < substr($local->photos, -2, 1); $i++)
                                    @if($i == 0)
                                        @php($src =  $local->photos . 'nth/' . $i . '/-/resize/127x145/')
                                    @else
                                        <li>
                                            <a href="#" class="active" data-update="">
                                                <img src="{{ $local->photos . 'nth/' . $i . '/-/resize/127x145/' }}" alt="zo-th-1" />
                                            </a>
                                        </li>
                                    @endif
                                    @if($i == (substr($local->photos, -2, 1) - 1))
                                        <li>
                                            <a href="#" class="active" data-update="">
                                                <img src="{{ $src }}" alt="zo-th-1" />
                                            </a>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="product-details shop-review single-pro-zoom">
                        <div class="product-name">
                            <h3><a>{{ $local->name }}</a></h3>
                        </div>
                        <div class="product-name">
                            <img src="{{ $local->photo .'/-/resize/278x165/' }}">
                        </div><br>
                        <table class="info-table">{{ parseSingleUserData(getContactFields(), $local) }}
                            <tr>
                                <td>{{ __('headings.local_type') }}:</td>
                                @php ($var = 'name_'. config()->get('app.locale'))
                                <td>{{ $local->local_type->$var }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-description">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-description-tab custom-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            @if ($local->about_me)
                            <li class="active"><a href="#girl-description" data-toggle="tab">{{ __('headings.about_us') }}</a></li>
                            @endif
                            @if($local->working_time)
                            <li><a href="#girl-workinghours" data-toggle="tab">{{ __('buttons.work_time') }}</a></li>
                            @endif
                            <li><a href="#girl-clubinfo" data-toggle="tab">{{ __('buttons.club_info') }}</a></li>
                            @if(count($local->users) > 0)
                            <li><a href="#girl-girls" data-toggle="tab">{{ __('buttons.girls') }}</a></li>
                            @endif
                            @if($local->videos)
                            <li><a href="#girl-video" data-toggle="tab">{{ __('buttons.video') }}</a></li>
                            @endif
                            @if($local->city)
                                <li><a href="#girl-map" data-toggle="tab">{{ __('headings.map') }}</a></li>
                            @endif
                            @if(isset($chart_year) || isset($chart_month))
                            <li><a href="#statistics" data-toggle="tab">{{ __('functions.statistics') }}</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            @if ($local->about_me)
                            <div class="tab-pane active" id="girl-description">
                                <p>{!! nl2br($local->about_me) !!}</p>
                            </div>
                            @endif
                            @if($local->working_time)
                            <div class="tab-pane" id="girl-workinghours">
                                @if($local->working_time == 'Available 24/7')
                                    {{ $local->working_time }}
                                @else
                                <table class="table working-times-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('buttons.day') }}</th>
                                            <th>{{ __('buttons.from') }}</th>
                                            <th>{{ __('buttons.to') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $workingTimes = json_decode($local->working_time); ?>
                                        @foreach($workingTimes as $workingTime)
                                        <tr>
                                            <td>{{ __('functions.'.explode('|', $workingTime)[0]) }}</td>
                                            <td>{{ explode(' - ', explode('|', $workingTime)[1])[0] }}</td>
                                            <td>{{ explode(' - ', explode('|', $workingTime)[1])[1] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            @endif
                            <div class="tab-pane" id="girl-clubinfo">
                                <table class="table working-times-table">
                                    <tr>
                                        <td>{{ __('tables.entrance') }}</td>
                                        <td>{{ $entrance }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('tables.wellness') }}</td>
                                        <td>{{ $wellness }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('tables.food_and_drinks') }}</td>
                                        <td>{{ $food }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('tables.outdoor_area') }}</td>
                                        <td>{{ $outdoor }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="girl-girls">
                                @foreach($local->users as $user)
                                <h3>{{ $user->nickname }}</h3>
                                @for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
                                <img src="{{ $user->photos . 'nth/' . $i . '/-/resize/127x145/' }}" alt="zo-th-1" />
                                @endfor
                                <br><br>
                                @endforeach
                            </div>
                            <div class="tab-pane" id="girl-video">
                                <video poster="/path/to/poster.jpg" width="500px" controls style="background-color: black;">
                                    <source src="{{ $local->videos }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="tab-pane" id="girl-map">
                                <div id="map" style="width: 100%; height: 450px;"></div>
                            </div>
                            @if(isset($chart_year) || isset($chart_month))
                                <div class="tab-pane" id="statistics">
                                    @if(isset($chart_year))
                                        <a onclick="changeToYear()" href="javascript:void(0)">{{  __('functions.yearly') }}</a>
                                    @endif
                                    @if(isset($chart_month))
                                        <a onclick="changeToMonth()" href="javascript:void(0)">{{  __('functions.monthly') }}</a>
                                    @endif
                                    @if(isset($chart_year))
                                        <div class="app" id="year" style="display: none;">
                                            <center>
                                                {!! $chart_year->html() !!}
                                            </center>
                                        </div>
                                    @endif
                                    @if(isset($chart_month))
                                        <div class="app" id="month">
                                            <center>
                                                {!! $chart_month->html() !!}
                                            </center>
                                        </div>
                                    @endif
                                    {!! Charts::scripts() !!}
                                    @if(isset($chart_year))
                                        {!! $chart_year->script() !!}
                                    @endif
                                    @if(isset($chart_month))
                                        {!! $chart_month->script() !!}
                                    @endif
                                </div>
                            @endif
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
                                    <img src="{{ asset('img/banner/fullwide-banner-4.jpg') }}" alt="">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($local->city)
        @php($userAddress = $local->city)
        @if($local->street)
            @php($userAddress = $local->street. ', '. $local->city)
        @endif
    @endif

    @stop
    @section('perPageScripts')
    <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('expand')[0];

var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
    $('body').css('overflow','hidden');
    $('body').css('position','fixed');
    $('body').css('overflow','auto');

}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>
        <script src="https://cdn.plyr.io/2.0.18/plyr.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4"></script>
        <!-- Call Plyr -->
        <script>
            plyr.setup({
                speeds: [0.5, 1.0, 1.5, 2.0, 2.5],
            });
        </script>
        @if(isset($userAddress))
            <script>

                $('a[href="#girl-map"]').on('click', function () {
                    setTimeout(initMap, 10);
                });

                function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 16,
                        center: {lat: -34.397, lng: 150.644}
                    });
                    var geocoder = new google.maps.Geocoder();
                    geocodeAddress(geocoder, map);
                }

                function geocodeAddress(geocoder, resultsMap) {
                    var address = '{{ $userAddress }}';
                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status === 'OK') {
                            resultsMap.setCenter(results[0].geometry.location);
                            console.log(results);
                            var marker = new google.maps.Marker({
                                map: resultsMap,
                                position: results[0].geometry.location
                            });
                        } else {
                            alert('{{ __('messages.geolocation_not_successful') }} ' + status);
                        }
                    });
                }
            </script>
        @endif

<script>
    $('.nav-tabs').find('li:first-child').addClass('active');
    $('.tab-content > .tab-pane:first-child').show(); 
    $('#gallery_01 img').click(function(e) {
        e.preventDefault();
        $('#is_image_large').attr('src',$(this).attr('src').replace('127x145','490x560'));
    });
</script>


<script>
    
    var modalImg = document.getElementById("img01");
        
        var all = modalImg.getAttribute("src").substr(-25 , 1) -1;
        
        
        function prev () {
            var now = modalImg.getAttribute("src").substr(-19 , 1);
            
            if (now == 0) {
                
                var prev = all;
            }
            
            else {
                var prev = now - 1;
            }
            
            var src = modalImg.getAttribute("src").replace("nth/"+now+"/-/resize/490x560/", "");
             
            
            var src = src + "nth/"+prev+"/-/resize/490x560/";
            
            modalImg.setAttribute("src", src); 

        }
        
        function next () {
            
            
            var now = modalImg.getAttribute("src").substr(-19 , 1);
            
            now = parseInt(now);

            
            if (now == all) {
                
                var next = 0;
            }
            
            else {
                var next = now + 1;
            }
            
            var src = modalImg.getAttribute("src").replace("nth/"+now+"/-/resize/490x560/", "");
             
            
            var src = src + "nth/"+next+"/-/resize/490x560/";
            
            modalImg.setAttribute("src", src);   


        }
        
    
</script>



<script>
    $('.modal').click(function(e) {
    if($(e.target).is('.modal'))  $(this).fadeOut(175);
});
</script>


<script>
    $(window).on("load", function () {
        $(".highcharts-axis-title").remove();
    });

    function changeToYear(){
        document.getElementById('year').style.display = "block";
        document.getElementById('month').style.display = "none";
    }

    function changeToMonth(){
        document.getElementById('year').style.display = "none";
        document.getElementById('month').style.display = "block";
    }
</script>
@stop