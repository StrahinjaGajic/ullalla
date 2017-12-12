@extends('layouts.app')

@section('title', 'Workplace')

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
			{!! parseEditProfileMenu('workplace') !!}
		</div>
		<div class="col-sm-10 profile-info">
			{!! Form::model($user, ['url' => '@' . $user->username . '/workplace/store', 'method' => 'put']) !!}
			<h3>Workplace</h3>
			<div class="row">
				<div class="col-sm-4">
					<div class="region">
						<select class="input-select" id="Canton" name="canton">
							<option value="">Canton</option>
							@foreach($cantons as $canton)
							<option value="{{ $canton->id }}" {{ getSelectedOption($user->canton_id, $canton->id) }}>{{ $canton->canton_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="city" value="{{ $user->city }}">
						<label>City</label>
						<span class="focus-border"></span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="zip_code" value="{{ $user->zip_code }}">
						<label>Zip Code</label>
						<span class="focus-border"></span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="address" value="{{ $user->address }}">
						<label>Address</label>
						<span class="focus-border"></span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="club_name" value="{{ $user->club_name }}">
						<label>Club Name</label>
						<span class="focus-border"></span>
					</div>
				</div>
			</div>
			<h3>Available For:</h3>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control control--checkbox">
							<input 
							type="checkbox" 
							name="incall" 
							value="1" 
							id="incall_availability" 
							{{ $user->incall_type ? 'checked' : '' }}>
							<a>Incall</a>
							<div class="control__indicator"></div>
						</label>
						<div class="incall-options" style="{{ !$user->incall_type ? 'display: none;' : '' }}">
							@foreach(getIncallOptions() as $key => $incallOption)
							<label style="margin-left: 30px; display: block;">
								<input 
								type="radio" 
								name="incall_option" 
								value="{{ $key }}" 
								id="{{ $key == 'define_yourself' ? 'incall_define_yourself' : '' }}" 
								style="display: inline-block;"
								{{ ($user->incall_type == $incallOption) || (explode('|', $user->incall_type)[0] == 'define_yourself') ? 'checked' : '' }}>
								{{ $incallOption }}
							</label>
							@endforeach
							<input 
							type="text" 
							name="incall_define_yourself" 
							value="{{ !empty(explode('|', $user->incall_type)[1]) ? explode('|', $user->incall_type)[1] : '' }}"
							style="{{ empty(explode('|', $user->incall_type)[1]) ? 'display: none;' : '' }}">
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control control--checkbox">
							<input 
							type="checkbox" 
							name="outcall" 
							value="1" 
							id="outcall_availability"
							{{ $user->outcall_type ? 'checked' : '' }}>
							<a>Outcall</a>
							<div class="control__indicator"></div>
						</label>
						<div class="outcall-options" style="{{ !$user->outcall_type ? 'display: none;' : '' }}">
							@foreach(getOutcallOptions() as $key => $outcallOption)
							<label style="margin-left: 30px; display: block;"">
								<input 
								type="radio" 
								name="outcall_option" 
								value="{{ $key }}" 
								id="{{ $key == 'define_yourself' ? 'outcall_define_yourself' : '' }}" 
								style="display: inline-block;"
								{{ ($user->outcall_type == $outcallOption) || (explode('|', $user->outcall_type)[0] == 'define_yourself') ? 'checked' : '' }}>
								{{ $outcallOption }}
							</label>
							@endforeach
							<input type="text" name="outcall_define_yourself"
							value="{{ !empty(explode('|', $user->outcall_type)[1]) ? explode('|', $user->outcall_type)[1] : '' }}"
							style="{{ empty(explode('|', $user->outcall_type)[1]) ? 'display: none;' : '' }}">
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-default">Save Changes</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<!-- Workplace script -->
<script>
	$(function () {
		var incallDefineYourself = $('input[name="incall_define_yourself"]');
		var outcallDefineYourself = $('input[name="outcall_define_yourself"]');

		$('input#incall_availability').on('click', function () {
			$('.incall-options').toggle();
			incallDefineYourself.val('');
			$('input[name="incall_option"]').prop('checked', false);
		});
		$('input#outcall_availability').on('click', function () {
			$('.outcall-options').toggle();
			outcallDefineYourself.val('');
			$('input[name="outcall_option"]').prop('checked', false);
		});

		$('input#incall_define_yourself').on('click', function () {
			incallDefineYourself.show();
		});
		$('.incall-options label input').not('#incall_define_yourself').on('click', function () {
			incallDefineYourself.hide();
			incallDefineYourself != '' ? incallDefineYourself.val() : incallDefineYourself.val('');
		});

		$('input#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.show();
		});
		$('.outcall-options label input').not('#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.hide();
			outcallDefineYourself != '' ? outcallDefineYourself.val() : outcallDefineYourself.val('');
		});
	});
</script>
@stop