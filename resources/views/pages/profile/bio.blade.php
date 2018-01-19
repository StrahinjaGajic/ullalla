@extends('layouts.app')

@section('title', __('headings.bio'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditProfileMenu('bio') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<h3>{{ __('headings.personal_info') }}</h3>
			@if(Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>
			@endif
			{!! Form::model($user, ['url' => '@' . $user->username . '/bio/store', 'method' => 'put']) !!}
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="col-3 input-effect {{ $errors->has('nickname') ? 'has-error' : ''  }}">
								<input class="effect-16" type="text" placeholder="" name="nickname" value="{{ $user->nickname }}">
								<label>{{ __('fields.nickname') }}</label>
								<span class="focus-border"></span>
								@if ($errors->has('nickname'))
								<span class="help-block">{{ $errors->first('nickname') }}</span>
								@endif
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect {{ $errors->has('first_name') ? 'has-error' : ''  }}">
								<input class="effect-16" type="text" name="first_name" placeholder="" value="{{ $user->first_name }}">
								<label>{{ __('fields.first_name') }}</label>
								<span class="focus-border"></span>
								@if ($errors->has('first_name'))
								<span class="help-block">{{ $errors->first('first_name') }}</span>
								@endif
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect {{ $errors->has('first_name') ? 'has-error' : ''  }}">
								<input class="effect-16" type="text" name="last_name" placeholder="" value="{{ $user->last_name }}">
								<label>{{ __('fields.last_name') }}</label>
								<span class="focus-border"></span>
								@if ($errors->has('last_name'))
								<span class="help-block">{{ $errors->first('last_name') }}</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="region">
								<select id="Nationality" name="nationality" class="input-select">
									<option value="">{{ __('fields.nationality') }}</option>
									@foreach ($countries as $country)
									<option value="{{ $country->id }}" {{ getSelectedOption($user->country_id, $country->id) }}>{{ $country->citizenship }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect {{ $errors->has('age') ? 'has-error' : ''  }}">
								<select name="age" class="input-select">
									<option value="">{{ __('fields.age') }}</option>
									@for($age = 18; $age <= 60; $age++)
									<option value="{{ $age }}" {{ getSelectedOption($user->age, $age) }}>{{ $age }}</option>
									@endfor
								</select>
								@if ($errors->has('age'))
								<span class="help-block">{{ $errors->first('age') }}</span>
								@endif
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect" id="wh">
								<input class="effect-16" type="text" placeholder="" name="height" value="{{ $user->height }}">
								<label>{{ __('fields.height') }} (cm)</label>
								<span class="focus-border"></span>
							</div>
							<div class="col-3 input-effect" id="wh">
								<input class="effect-16" type="text" placeholder="" name="weight" value="{{ $user->weight }}">
								<label>{{ __('fields.weight') }} (kg)</label>
								<span class="focus-border"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="info">
								<select id="sex" name="sex" class="input-select">
									<option value="">{{ __('fields.sex') }}</option>
									@foreach (getSexes() as $sex)
									<option value="{{ $sex }}" {{ getSelectedOption($user->sex, $sex) }}>{{ ucfirst($sex) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="sex orientation" name="sex_orientation" class="input-select">
									<option value="">{{ __('fields.sex_orientation') }}</option>
									@foreach (getSexOrientations() as $sexOrientation)
									<option value="{{ $sexOrientation }}" {{ getSelectedOption($user->sex_orientation, $sexOrientation) }}>{{ ucfirst($sexOrientation) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Type" name="type" class="input-select">
									<option value="">{{ __('fields.type') }}</option>
									@foreach (getTypes() as $type)
									<option value="{{ $type }}" {{ getSelectedOption($user->type, $type) }}>{{ ucfirst($type) }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="info">
								<select id="Figure" name="figure" class="input-select">
									<option value="">{{ __('fields.figure') }}</option>
									@foreach (getFigures() as $figure)
									<option value="{{ $figure }}" {{ getSelectedOption($user->figure, $figure) }}>{{ ucfirst($figure) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Breast Size" class="input-select" name="breast_size">
									<option value="">{{ __('fields.breast_size') }}</option>
									@foreach(getBreastSizes() as $breastSize)
									<option value="{{ $breastSize }}" {{ getSelectedOption($user->breast_size, $breastSize) }}>{{ ucfirst($breastSize) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Eye Color" class="input-select" name="eye_color">
									<option value="">{{ __('fields.eye_color') }}</option>
									@foreach(getEyeColors() as $eyeColor)
									<option value="{{ $eyeColor }}" {{ getSelectedOption($user->eye_color, $eyeColor) }}>{{ ucfirst($eyeColor) }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="info">
								<select id="Hair Color" class="input-select" name="hair_color">
									<option value="">{{ __('fields.hair_color') }}</option>
									@foreach(getHairColors() as $hairColor)
									<option value="{{ $hairColor }}" {{ getSelectedOption($user->hair_color, $hairColor) }}>{{ ucfirst($hairColor) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Tattos" class="input-select" name="tattoos">
									<option value="">{{ __('fields.tattoos') }}</option>
									@foreach(array_slice(getAnswers(), 0, 2) as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->tattoos, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Piercings" class="input-select" name="piercings">
									<option value="">{{ __('fields.piercings') }}</option>
									@foreach(array_slice(getAnswers(), 0, 2) as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->piercings, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="info">
								<select id="BodyHair" class="input-select" name="body_hair">
									<option value="">{{ __('fields.body_hair') }}</option>
									@foreach(getShaveOptions() as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->body_hair, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Intimate" class="input-select" name="intimate">
									<option value="">{{ __('fields.intimate') }}</option>
									@foreach(getShaveOptions() as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->intimate, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="info">
								<select id="Smoker" class="input-select" name="smoker">
									<option value="">{{ __('fields.smoker') }}</option>
									@foreach(getAnswers() as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->smoker, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="info">
								<select id="Alcohol" class="input-select" name="alcohol">
									<option value="">{{ __('fields.alcohol') }}</option>
									@foreach(getAnswers() as $answer)
									<option value="{{ $answer }}" {{ getSelectedOption($user->alcohol, $answer) }}>{{ ucfirst($answer) }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="save">
				<button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
</div>
@stop
