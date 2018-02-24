@extends('layouts.app')

@section('title', __('headings.services'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			@if(Auth::guard('local')->check())
                {!! parseEditProfileMenu('services', $user->id) !!}
            @else
                {!! parseEditProfileMenu('services') !!}
            @endif
		</div>
		<div class="col-sm-10 profile-info">
			@if(Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>
			@endif
			{!! Form::model($user, ['url' => 'private/' . $user->id . '/services/store', 'method' => 'put']) !!}
			<h3>{{ __('headings.service_offered_for') }}:</h3>
			<div class="row">
				<div class="col-xs-12 choice">
					@foreach($serviceOptions as $serviceOption)
					<label class="control control--checkbox" style="display: inline-block;">
						@php
						$var = 'service_option_name_'. config()->get('app.locale');
						@endphp
						<a>{{ ucfirst($serviceOption->$var) }}</a>
						<input 
						type="checkbox" 
						name="service_options[]" 
						autocomplete="off" 
						value="{{ $serviceOption->id }}"
						{{ in_array($serviceOption->id, $user->service_options()->pluck('service_option_id')->toArray()) ? 'checked' : '' }}>
						<div class="control__indicator"></div>
					</label>
					@endforeach
				</div>
			</div>
			<h3>{{ __('headings.service_list') }}</h3>
			<div class="row">
				@foreach ($services->chunk(22) as $chunkedServices)
				<div class="col-sm-4">
					<div class="layout-list">
						<ul>
							<li>
								@foreach ($chunkedServices as $service)
								@php 
									$var = 'service_name_'. config()->get('app.locale');
								@endphp
								<label class="control control--checkbox"><a>{{ $service->$var }}</a>
									<input type="checkbox" 
									name="services[]" 
									{{ in_array($service->id, $user->services->pluck('id')->toArray()) ? 'checked' : '' }} 
									value="{{ $service->id }}"
									autocomplete="off">
									<div class="control__indicator"></div>
								</label>
								@endforeach
							</li>
						</ul>
					</div>
				</div>
				@endforeach
			</div>
			<div class="save">
				<button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop