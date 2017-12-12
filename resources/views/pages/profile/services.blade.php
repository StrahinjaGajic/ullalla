@extends('layouts.app')

@section('title', 'Services')

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
				{!! parseEditProfileMenu('services') !!}
			</div>
			<div class="col-sm-10 profile-info">
				@if(Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
				{!! Form::model($user, ['url' => '@' . $user->username . '/services/store', 'method' => 'put']) !!}
				<h3>Services Offered For:</h3>
				<div class="row">
					<div class="col-xs-12">
						@foreach($serviceOptions as $serviceOption)
							<label class="control control--checkbox" style="display: inline-block;">
								<a>{{ ucfirst($serviceOption->service_option_name) }}</a>
								<input
										type="checkbox"
										name="service_options[]"
										value="{{ $serviceOption->id }}"
										{{ in_array($serviceOption->id, $user->service_options()->pluck('service_option_id')->toArray()) ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						@endforeach
					</div>
				</div>
				<h3>Service List</h3>
				<div class="row">
					@foreach ($services->chunk(13) as $chunkedServices)
						<div class="col-sm-4">
							<div class="layout-list">
								<ul>
									<li>
										@foreach ($chunkedServices as $service)
											<label class="control control--checkbox"><a>{{ $service->service_name }}</a>
												<input type="checkbox" name="services[]" {{ in_array($service->id, $user->services->pluck('id')->toArray()) ? 'checked' : '' }} value="{{ $service->id }}">
												<div class="control__indicator"></div>
											</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
					@endforeach
				</div>
				<button type="submit" class="btn btn-default">Save Changes</button>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop
