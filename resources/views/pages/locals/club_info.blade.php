@extends('layouts.app')

@section('title', 'Club Info')

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
                {!! parseEditLocalProfileMenu('club_info') !!}
            </div>
            <div class="col-sm-10 profile-info">
                <h3>Club Info</h3>
                {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/club_info/store', 'method' => 'put']) !!}
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Entrance</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="entrance-na" onclick="uncheckEntranceFree()" name="entrance" value="1" {{ ($local->clubEntrance->value == 1) ? 'checked' : '' }}>
                        <label class="control-label">N / A</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="entrance-free" onclick="uncheckEntrance()" name="entrance-free" value="1" {{ ($local->clubEntrance->free == 1) ? 'checked' : '' }}>
                        <label class="control-label">Free</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="entrance-cost" onclick="uncheckEntrance()" name="entrance-free" value="2" {{ ($local->clubEntrance->free == 2) ? 'checked' : '' }}>
                        <label class="control-label">With cost</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Wellness</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="wellness" value="1" onclick="hideWellness()" {{ ($local->clubWellness->value == 1) ? 'checked' : '' }}>
                        <label class="control-label">N / A</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="wellness-yes" name="wellness" value="2" onclick="showWellness()"{{ ($local->clubWellness->value == 2) ? 'checked' : '' }}>
                        <label class="control-label">Yes</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="wellness" value="3" onclick="hideWellness()"{{ ($local->clubWellness->value == 3) ? 'checked' : '' }}>
                        <label class="control-label">No</label>
                    </div>
                </div>
                <div class="row hidden" id="wellness-show">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="wellness-free" value="1" {{ ($local->clubWellness->free == 1) ? 'checked' : '' }}>
                        <label class="control-label">Free</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="wellness-free" value="2" {{ ($local->clubWellness->free == 2) ? 'checked' : '' }}>
                        <label class="control-label">With cost</label>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Food and drinks</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="food" value="1" onclick="hideFood()" {{ ($local->clubFood->value == 1) ? 'checked' : '' }}>
                        <label class="control-label">N / A</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="food-yes" name="food" value="2" onclick="showFood()" {{ ($local->clubFood->value == 2) ? 'checked' : '' }}>
                        <label class="control-label">Yes</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="food" value="3" onclick="hideFood()" {{ ($local->clubFood->value == 3) ? 'checked' : '' }}>
                        <label class="control-label">No</label>
                    </div>
                </div>
                <div class="row hidden" id="food-show">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="food-free" value="1" {{ ($local->clubFood->free == 1) ? 'checked' : '' }}>
                        <label class="control-label">Free</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="food-free" value="2" {{ ($local->clubFood->free == 2) ? 'checked' : '' }}>
                        <label class="control-label">With cost</label>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Outdoor area</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="outdoor" value="1" {{ ($local->clubOutdoor->value == 1) ? 'checked' : '' }}>
                        <label class="control-label">N / A</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="outdoor" value="2" {{ ($local->clubOutdoor->value == 2) ? 'checked' : '' }}>
                        <label class="control-label">Yes</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="outdoor" value="3" {{ ($local->clubOutdoor->value == 3) ? 'checked' : '' }}>
                        <label class="control-label">No</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Save Changes</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
@section('perPageScripts')
    <script>

        function showWellness(){
            document.getElementById('wellness-show').classList.remove("hidden");
        }

        function hideWellness(){
            document.getElementById('wellness-show').className += ' hidden';
        }

        function showFood(){
            document.getElementById('food-show').classList.remove("hidden");
        }

        function hideFood(){
            document.getElementById('food-show').className += ' hidden';
        }

    </script>
    <script>
        function uncheckEntrance(){
            document.getElementById('entrance-na').checked = false;
        }

        function uncheckEntranceFree(){
            document.getElementById('entrance-free').checked = false;
            document.getElementById('entrance-cost').checked = false;
        }
    </script>
    <script>
        window.onload = function (){
            if(document.getElementById('entrance-na').checked == true){
                uncheckEntranceFree();
            }
            if(document.getElementById('entrance-free').checked == true){
                uncheckEntrance();
            }
            if(document.getElementById('entrance-cost').checked == true){
                uncheckEntrance();
            }
            if(document.getElementById('wellness-yes').checked == true){
                showWellness();
            }
            if(document.getElementById('food-yes').checked == true){
                showFood();
            }
        };
    </script>
@stop