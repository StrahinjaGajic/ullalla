@extends('layouts.app')

@section('title', __('buttons.create_profile'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/create_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
@stop

@section('content')
<div class="wrapper section-create-profile">
	<div id="create_profile_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					{!! Form::open(['url' => '@' . $user->username . '/store', 'class' => 'form-horizontal wizard', 'id' => 'profileForm', 'method' => 'PUT']) !!}
					<ul class="nav nav-pills">
						<li class="active pad-left"><a href="#bio-tab" data-toggle="tab">{{ __('headings.bio') }}</a></li>
						<li><a href="#gallery-tab" data-toggle="tab">{{ __('headings.gallery') }}</a></li>
						<li class="pad-right"><a href="#contact-tab" data-toggle="tab">{{ __('headings.contact') }}</a></li>
						<li class="pad-left"><a href="#workplace-tab" data-toggle="tab">{{ __('headings.workplace') }}</a></li>
						<li><a href="#working-hours-tab" data-toggle="tab">{{ __('headings.working_hours') }}</a></li>
						<li class="pad-right"><a href="#services-tab" data-toggle="tab">{{ __('headings.services') }}</a></li>
						<li class="pad-left"><a href="#prices-tab" data-toggle="tab">{{ __('headings.prices') }}</a></li>
						<li><a href="#languages-tab" data-toggle="tab">{{ __('headings.languages') }}</a></li>
						<li class="pad-right"><a href="#packages-tab" data-toggle="tab">{{ __('headings.packages') }}</a></li>
					</ul>
					<div class="tab-content">
						<section class="tab-pane active" id="bio-tab">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.first_name') }} *</label>
									<input type="text" class="form-control" name="first_name" />
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.last_name') }} *</label>
									<input type="text" class="form-control" name="last_name" />
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.nickname') }} *</label>
									<input type="text" class="form-control" name="nickname" />
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.nationality') }}</label>
									<select name="nationality_id" class="form-control">
										<option value=""></option>
										@foreach ($countries as $country)
										<option value="{{ $country->id }}">{{ $country->citizenship }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.sex') }} *</label>
									<select onclick="changeSex()" id="sex" name="sex" class="form-control">
										<option value="female">{{ __('fields.female') }}</option>
										<option value="transsexual">{{ __('fields.transsexual') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.sex_orientation') }}</label>
									<select name="sex_orientation" class="form-control">
										<option value="heterosexual">{{ __('fields.heterosexual') }}</option>
										<option value="bisexual">{{ __('fields.bisexual') }}</option>
										<option value="homosexual">{{ __('fields.homosexual') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.height') }} *</label>
									<input type="text" class="form-control" name="height" />
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.weight') }} *</label>
									<input type="text" class="form-control" name="weight" />
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.type') }}</label>
									<select name="ancestry" class="form-control">
										<option value=""></option>
										@foreach(getTypes() as $type)
										<option value="{{ $type }}">{{ ucfirst($type) }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.figure') }}</label>
									<select name="figure" class="form-control">
										<option value=""></option>
										<option value="normal">{{ __('fields.normal') }}</option>
										<option value="slim">{{ __('fields.slim') }}</option>
										<option value="athletic">{{ __('fields.athletic') }}</option>
										<option value="chubby">{{ __('fields.chubby') }}</option>
										<option value="other">{{ __('fields.other') }}</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.age') }} *</label>
									<select name="age" id="age" class="form-control">
										@for ($age=18; $age <= 60 ; $age++) 
										<option value="{{ $age }}">{{ $age }}</option>
										@endfor
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.breast_size') }}</label>
									<select name="breast_size" class="form-control">
										<option value=""></option>
										<option value="a">{{ __('fields.a') }}</option>
										<option value="b">{{ __('fields.b') }}</option>
										<option value="c">{{ __('fields.c') }}</option>
										<option value="d">{{ __('fields.d') }}</option>
										<option value="E">{{ __('fields.e') }}</option>
										<option value="F">{{ __('fields.f') }}</option>
										<option value="G">{{ __('fields.g') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.eye_color') }}</label>
									<select name="eye_color" class="form-control">
										<option value=""></option>
										<option value="black">{{ __('fields.black') }}</option>
										<option value="Brown">{{ __('fields.brown') }}</option>
										<option value="green">{{ __('fields.green') }}</option>
										<option value="blue">{{ __('fields.blue') }}</option>
										<option value="gray">{{ __('fields.gray') }}</option>
										<option value="other">{{ __('fields.other') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.hair_color') }}</label>
									<select name="hair_color" class="form-control">
										<option value=""></option>
										<option value="black">{{ __('fields.black') }}</option>
										<option value="brunette">{{ __('fields.brunette') }}</option>
										<option value="blond">{{ __('fields.blond') }}</option>
										<option value="red">{{ __('fields.red') }}</option>
										<option value="other">{{ __('fields.other') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.tattoos') }}</label>
									<select name="tattoos" class="form-control">
										<option value=""></option>
										<option value="yes">{{ __('labels.yes') }}</option>
										<option value="no">{{ __('labels.no') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.piercings') }}</label>
									<select name="piercings" class="form-control">
										<option value=""></option>
										<option value="yes">{{ __('labels.yes') }}</option>
										<option value="no">{{ __('labels.no') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.body_hair') }}</label>
									<select name="body_hair" class="form-control">
										<option value=""></option>
										<option value="shaved">{{ __('fields.shaved') }}</option>
										<option value="hairy">{{ __('fields.hairy') }}</option>
										<option value="partial">{{ __('fields.partial') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.intimate') }}</label>
									<select name="intimate" class="form-control">
										<option value="shaved">{{ __('fields.shaved') }}</option>
										<option value="hairy">{{ __('fields.hairy') }}</option>
										<option value="partial">{{ __('fields.partial') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.smoker') }}</label>
									<select name="smoker" class="form-control">
										<option value="yes">{{ __('labels.yes') }}</option>
										<option value="no">{{ __('labels.no') }}</option>
										<option value="occasionally">{{ __('fields.occasionally') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">{{ __('fields.alcohol') }}</label>
									<select name="alcohol" class="form-control">
										<option value="yes">{{ __('labels.yes') }}</option>
										<option value="no">{{ __('labels.no') }}</option>
										<option value="occasionally">{{ __('fields.occasionally') }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('headings.about_me') }} *</label>
									<textarea name="about_me" class="form-control"></textarea>
								</div>
							</div>
						</section>

						<section class="tab-pane" id="gallery-tab">
							<div class="form-group">
								<div class="image-preview-multiple" style="margin-left:10px;">
									<input type="hidden" role="uploadcare-uploader" name="photos" data-multiple-min="4" data-multiple-max="9" data-crop="490x560 minimum" data-images-only="" data-multiple="">
									<div class="_list"></div>
								</div>
							</div>
							<div class="form-group upload-video">
								<input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="avi mp4 ogv mov wmv mkv"/>
							</div>
						</section>

						<section class="tab-pane" id="contact-tab">
							<div class="col-xs-12 sie">
								<div class="form-group">
									<label class="control control--checkbox" style="margin-left: 0px;"><a>{{ __('fields.sms_notify') }}</a>
										<input type="checkbox" name="sms_notifications">
										<div class="control__indicator service_list"></div>
									</label>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.email') }}</label>
									<input type="text" class="form-control" name="email" value="{{ $user->email }}" />
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.website_url') }}</label>
									<input type="text" class="form-control" name="website"/>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.telephone') }}</label>
									<input type="text" class="form-control" name="phone"/>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.mobile_phone') }} *</label>
									<input type="tel" class="form-control" name="mobile" id="mobile" />
								</div>
							</div>
							<div id="options" class="col-xs-12">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 stretch" style="padding-left:0;">
									<div class="form-group">
										<label class="control-label" style="display: block; text-align: left;">{{ __('headings.available_apps') }}</label>
										@foreach($contactOptions as $contactOption)
										<label class="control control--checkbox apps"><a>{!! $contactOption->icon !!} {{ ucfirst($contactOption->contact_option_name) }}</a>
											<input type="checkbox" name="contact_options[]" value="{{ $contactOption->id }}" id="{{ $contactOption->contact_option_name == 'skype' ? 'skype_contact' : '' }}">
											<div class="control__indicator service_list"></div>
										</label>
										@endforeach
									</div>
									<div class="col skype-name" style="display: none;">
										<div class="form-group">
											<input type="text" name="skype_name" placeholder="Skype Name" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prefer stretch">
									<div class="form-group">
										<label class="control-label" style="display: block; text-align: left;">{{ __('headings.i_prefer') }}</label>
										@foreach(getPreferedOptions() as $key => $preferedOption)
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0px; margin: 0px;">
											<label style="margin-right: 20px;">
												<input type="radio" name="prefered_contact_option" value="{{ $key }}" style="display: inline-block;">
												{{ $preferedOption }}
											</label>
										</div>	
										@endforeach
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0px; margin: 0px;">
											<label class="control control--checkbox" style="margin-right: 20px; margin-left:0px;">
												<input type="checkbox" name="no_withheld_numbers" value="1" style="display: inline-block;"><a>{{ __('fields.no_withheld_numbers') }}</a>
												<div class="control__indicator service_list"></div>
											</label>
										</div>
									</div>
								</div>
							</div>
						</section>

						<section class="tab-pane" id="workplace-tab">
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.canton') }}</label>
									<select name="canton" class="form-control">
										<option value=""></option>
										@foreach($cantons as $canton)
										<option value="{{ $canton->id }}">{{ $canton->canton_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.city') }}</label>
									<input type="text" class="form-control" name="city"/>
								</div>
							</div>
							<div class="col-lg-2 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.zip_code') }}</label>
									<input type="text" class="form-control" name="zip_code"/>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.address') }}</label>
									<input type="text" class="form-control" name="address"/>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">{{ __('fields.club_name') }}</label>
									<input type="text" class="form-control" name="club_name"/>
								</div>
							</div>
							
							<div class="col-xs-12" style="margin-top: 15px;">
							<h3 style="padding-left: 15px;">{{ __('headings.available_for') }}:</h3>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control control--checkbox apps">
										<input type="checkbox" name="incall" value="1" id="incall_availability"><a>{{ __('fields.incall') }}</a>
										<div class="control__indicator"></div>
									</label>
									<div class="incall-options" style="display: none;">
										@foreach(getIncallOptions() as $key => $incallOption)
										<label style="margin-left: 30px; display: block;">
											<input type="radio" name="incall_option" value="{{ $key }}" id="{{ $key == 'define_yourself' ? 'incall_define_yourself' : '' }}" style="display: inline-block;">
											{{ $incallOption }}
										</label>
										@endforeach
										<input type="text" name="incall_define_yourself" style="display: none; margin-left: 45px;">
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control control--checkbox apps">
										<input type="checkbox" name="outcall" value="1" id="outcall_availability"><a>{{ __('fields.outcall') }}</a>
										<div class="control__indicator"></div>
									</label>
									<div class="outcall-options" style="display: none;">
										@foreach(getOutcallOptions() as $key => $outcallOption)
										<label style="margin-left: 30px; display: block;">
											<input type="radio" name="outcall_option" value="{{ $key }}" id="{{ $key == 'define_yourself' ? 'outcall_define_yourself' : '' }}" style="display: inline-block;">
											{{ $outcallOption }}
										</label>
										@endforeach
										<input type="text" name="outcall_define_yourself" style="display: none; margin-left: 45px;">
									</div>
								</div>
							</div>
                            </div>
						</section>

						<section class="tab-pane" id="working-hours-tab">
							<div class="col-xs-12">
								<div class="form-group">
									<div id="available_24_7" class="pull-left">
										<label class="control control--checkbox"><a>{{ __('fields.available_24_7') }}</a>
											<input type="checkbox" name="available_24_7">
											<div class="control__indicator available"></div>
										</label>
										<label class="control control--checkbox working-times-disabled"><a>{{ __('fields.show_as_night_escort') }}</a>
											<input type="checkbox" name="available_24_7_night_escort" value="1" disabled="">
											<div class="control__indicator available"></div>
										</label>
									</div>
									<div class="pull-right">
										<button class="btn btn-default" id="apply_to_all">{{ __('labels.apply_to_all') }}</button>
									</div>
									<div class="table-responsive"> <!-- style="overflow-x: auto;" -->
										<table class="table working-times-table">
											<thead>
												<tr>
													<th>
														<label class="control control--checkbox"><a>{{ __('fields.mark_all') }}</a>
															<input type="checkbox" id="select_all_days">
															<div class="control__indicator"></div>
														</label>
													</th>
													<th>{{ __('headings.from') }}</th>
													<th>{{ __('headings.to') }}</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php $counter = 1; ?>
												@foreach(getDaysOfTheWeek() as $dayOfTheWeek)
												<tr class="working-times-disabled">
													<td>
														<label class="control control--checkbox"><a>{{ $dayOfTheWeek }}</a>
															<input type="checkbox" name="days[{{ $counter }}]" value="{{ $dayOfTheWeek }}">
															<div class="control__indicator days"></div>
														</label>
													</td>
													<td>
														<select name="time_from[{{ $counter }}]" class="form-control hrs" disabled="">
															@foreach(getHoursList() as $hour)
															<option value="{{ $hour }}">{{ $hour }}</option>
															@endforeach
														</select>
														<span>{{ __('global.hrs') }}</span>
														<select name="time_from_m[{{ $counter }}]" class="form-control hrs" disabled="">
															@foreach(getMinutesList() as $minute)
															<option value="{{ $minute }}">{{ $minute }}</option>
															@endforeach
														</select>
														<span>{{ __('global.min') }}</span>
													</td>
													<td>
														<select name="time_to[{{ $counter }}]" class="form-control hrs" disabled="">
															@foreach(getHoursList() as $hour)
															<option value="{{ $hour }}">{{ $hour }}</option>
															@endforeach
														</select>
														<span>{{ __('global.hrs') }}</span>
														<select name="time_to_m[{{ $counter }}]" class="form-control hrs" disabled="">
															@foreach(getMinutesList() as $minute)
															<option value="{{ $minute }}">{{ $minute }}</option>
															@endforeach
														</select>
														<span>{{ __('global.min') }}</span>
													</td>
													<td>
														<label class="control control--checkbox"><a>{{ __('fields.night_escort') }}</a>
															<input type="checkbox" name="night_escorts[{{ $counter }}]" value="{{ $counter }}" disabled="">
															<div class="control__indicator days"></div>
														</label>
													</td>
												</tr>
												<?php $counter++; ?>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</section>

						<section class="tab-pane services-section" id="services-tab">
							<h3>{{ __('headings.service_offered_for') }}:</h3>
							<div class="col-lg-12 col-sm-12 col-xs-12 services_5" style="margin-bottom:20px;">
								@foreach($serviceOptions as $serviceOption)
								<label class="control control--checkbox services_control"><a>{{ ucfirst($serviceOption->service_option_name) }}</a>
									<input type="checkbox" name="service_options[]" value="{{ $serviceOption->id }}">
									<div class="control__indicator service_list"></div>
								</label>
								@endforeach
							</div>
							<div class="service-list">
								<h3>{{ __('headings.service_list') }}</h3>
								@foreach ($services->chunk(33) as $chunkedServices)
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 wid" style="margin-bottom: 0px;">
									@foreach($chunkedServices as $service)
									<div class="form-group">
										@php 
										$var = 'service_name_' . config()->get('app.locale');
										@endphp
										<label class="control control--checkbox services_label" style="display: block;"><a>{{ $service->$var }}</a>
											<input type="checkbox" class="form-control" name="services[]" value="{{ $service->id }}" />
											<div class="control__indicator service_list"></div>
										</label>
									</div>
									@endforeach
								</div>
								@endforeach
							</div>
						</section>

						<section class="tab-pane" id="prices-tab">
							<div class="price_section">
								<div class="col-lg-3 col-xs-12">
									<div class="form-group">
										<label class="control-label">{{ __('headings.duration') }}</label>
										<input type="text" class="form-control" name="service_duration"/>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-lg-2 col-xs-12">
									<div class="form-group">
										<label class="control-label">{{ __('fields.unit') }}</label>
										<select name="service_price_unit" class="form-control">
											@foreach(getUnits() as $unit)
											<option value="{{ $unit }}">{{ ucfirst($unit) }}</option>
											@endforeach
										</select>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-lg-3 col-xs-12">
									<div class="form-group">
										<label class="control-label">{{ __('headings.price') }}</label>
										<input type="text" class="form-control" name="service_price"/>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-lg-2 col-xs-12">
									<div class="form-group">
										<label class="control-label">{{ __('fields.currency') }}</label>
										<select name="service_price_currency" class="form-control">
											@foreach(getCurrencies() as $currency)
											<option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
											@endforeach
										</select>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-lg-2 col-xs-12">
									<div class="form-group">
										<label class="control-label">{{ __('fields.type') }}</label>
										<select name="price_type" id="price_type" class="form-control">
											@foreach(getPriceTypes() as $priceType)
											<option value="{{ $priceType }}">{{ ucfirst($priceType) }}</option>
											@endforeach
										</select>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-xs-12">
									<input type="hidden" name="add_price_token" value="{{ csrf_token() }}">
									<button type="submit" class="add-new-price">{{ __('buttons.add_new_price') }}</button>
								</div>
							</div>
							<div class="col-xs-12 price-table-container">
								<table class="{{ $prices->count() == 0 ? 'is-hidden' : '' }}">
									<thead>
										<tr>
											<th>{{ __('fields.type') }}</th>
											<th>{{ __('headings.duration') }}</th>
											<th>{{ __('headings.price') }}</th>
											<th>{{ __('headings.remove') }}</th>
										</tr>
									</thead>
									<tbody id="prices_body">
										@foreach ($prices as $price)
										<tr>
											<td>{{ $price->price_type }}</td>
											<td>{{ $price->service_duration }} {{ trans_choice('fields.' . $price->service_price_unit, $price->service_duration) }}</td>
											<td>{{ $price->service_price }} {{ $price->service_price_currency }}</td>
											<td>
												<a href="{{ url('ajax/delete_price/' . $price->id) }}" class="text-danger delete-price">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</section>

						<section class="tab-pane" id="languages-tab">
							<table class="table language-table">
								<thead>
									<tr>
										<th>{{ __('headings.language') }}</th>
										<th>{{ __('headings.level') }}</th>
									</tr>
								</thead>
								@php ($var = 'spoken_language_name_'. config()->get('app.locale'))
								<tbody class="language-list">
									@foreach($spokenLanguages->take(7) as $language)
									<tr>
										<td>
											<img style="margin-bottom:1px;" src="{{ asset('flags/4x3/' . $language->spoken_language_code . '.svg') }}" alt="" height="20" width="30">
											{{ $language->$var }}
										</td>
										<td>
											<div class="slider"></div>
											<input type="hidden" class="spoken-language-input" name="spoken_language[{{ $language->spoken_language_code }}]" value="">
										</td>
									</tr>
									@endforeach
								</tbody>
								<tbody class="language-list" style="display: none;">
									@foreach($spokenLanguages->splice(7) as $language)
									<tr>
										<td>
											<img style="margin-bottom:1px;" src="{{ asset('flags/4x3/' . $language->spoken_language_code . '.svg') }}" alt="" height="20" width="30">
											{{ $language->$var }}
										</td>
										<td>
											<div class="slider"></div>
											<input type="hidden" name="spoken_language[{{ $language->spoken_language_code }}]" value="0">
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="show-more text-center">
								<a href="#" class="btn btn-default">{{ __('buttons.show_more') }}</a>
							</div>
						</section>

						<section class="tab-pane" id="packages-tab">
							<div class="col-xs-12 default-packages-section" id="default-packages-section">
								<h3>{{ __('headings.default_packages') }}</h3>
								<div class="has-error">
									<div id="alertPackageMessage" class="help-block"></div>
								</div>
								<div style="overflow-x: auto;">
									<table class="table packages-table">
										<thead>
											<tr>
												<th>{{ __('headings.name') }}</th>
												<th>{{ __('headings.duration') }}</th>
												<th>{{ __('headings.price') }}</th>
												<th>{{ __('headings.activation_date') }}</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php $counter = 1; ?>
											@foreach ($packages as $package)
											<tr>
												<td>{{ $package->package_name }}</td>
												<td>{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
												<td>{{ $package->package_price }} CHF</td>
												<td>
													<input type="text" name="default_package_activation_date[{{ $package->id }}]" class="package_activation" id="package_activation{{ $counter }}">
												</td>
												<td>
													<label class="control control--checkbox">
														<input type="radio" name="ullalla_package[]" value="{{ $package->id }}" />
														<div class="control__indicator"></div>
													</label>
												</td>
											</tr>
											<?php $counter++; ?>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-xs-12">
								<h3 id="gotm-totm">{{ __('headings.gotm') }}</h3>
								<div style="overflow-x: auto;">
									<table class="table packages-table package-girl-month">
										<thead>
											<tr>
												<th>{{ __('headings.name') }}</th>
												<th>{{ __('headings.duration') }}</th>
												<th>{{ __('headings.price') }}</th>
												<th>{{ __('headings.activation_date') }}</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($packages->take(3) as $package)
											<tr>
												<td>{{ $package->package_name }}</td>
												<td>{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
												<td>{{ $package->package_price }} CHF</td>
												<td>
													<input type="text" name="month_girl_package_activation_date[{{ $package->id }}]" class="package_month_girl_activation" id="package_month_activation{{ $counter }}">
												</td>
												<td>
													<label class="control control--checkbox">
														<input type="checkbox" class="gotm_checkbox" name="ullalla_package_month_girl[]" value="{{ $package->id }}"/>
														<div class="control__indicator"></div>
													</label>
												</td>
											</tr>
											<?php $counter++; ?>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</section>
						<!-- Previous/Next buttons -->
						<ul class="pager wizard">
							<div class="col-xs-12">
								<div class="col-xs-6" style="padding:0;">
									<li class="previous"><button class="btn-default" type="button" href="javascript: void(0);">Previous</button></li>
								</div>
								<div class="col-xs-6" style="padding:0;">
									<li class="next"><button class="btn-default" type="button" href="javascript: void(0);">Next</button></li>
								</div>
							</div>
						</ul>
					</div>
					<input type="hidden" name="stripeToken" id="stripeToken">
					<input type="hidden" name="stripeEmail" id="stripeEmail">
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<!-- Form Validation -->
<script>
	var utilAsset = '{{ asset('js/utils.js') }}';
	var invalidUrl = '{{ __('validation.url_invalid') }}';
</script>
<script src="{{ asset('js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/formValidation.min.js') }}"></script>
<script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="{{ asset('js/profileValidation.js?ver=' . str_random('10')) }}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
////////// 1. MODAL, DATERANGE PICKER, ////////
// show modal on page load
$(window).on('load',function(){
	$('#create_profile_modal').modal('show');
	$('.slider').slider({
		range: "min",
		value: 0,
		step: 1,
		min: 0,
		max: 5,
		slide: function( event, ui ) {
			$(this).next('input.spoken-language-input').val(ui.value);
		}
	});
});


$(function () {
	$('.show-more a').on('click', function(e){
		var that = $(this);
		e.preventDefault();
		that.text(that.text() == '{{ __('buttons.show_more') }}' ? '{{ __('buttons.show_less') }}' : '{{ __('buttons.show_more') }}');
		$('table.language-table').find('.language-list:last-child').toggle();
	});
});

$(function () {
// disabled modal closing on outside click and escape
$('#create_profile_modal').modal({
	backdrop: 'static',
	keyboard: false
});
// make modal content scrolablle
$('#profileForm').find('.content').addClass('is-scrollable');
// get new start and end year
var start = new Date();
start.setFullYear(start.getFullYear());
var end = new Date();
end.setFullYear(end.getFullYear() + 1);
// implement datarange picker on package activation input
$('.package_month_girl_activation').each(function () {
	$(this).daterangepicker({
		singleDatePicker: true,
		timepicker: false,
		showDropdowns: true,
		minDate: start,
		maxDate: end,
		locale: {
			format: 'DD-MM-YYYY'
		},
	});;
});
// implement datarange picker on package activation input
$('.package_activation').each(function () {
	$(this).daterangepicker({
		singleDatePicker: true,
		timepicker: false,
		showDropdowns: true,
		minDate: start,
		maxDate: end,
		locale: {
			format: 'DD-MM-YYYY'
		},
	});
});
});
var choosenSex = "female";
function changeSex(){
	var gotm = '{{ __('headings.gotm') }}';
	var totm = '{{ __('headings.totm') }}';
	var select = document.getElementById("sex");
	var choosenSex = select.options[select.selectedIndex].value;
	var h3 = document.getElementById("gotm-totm");
	if(choosenSex == 'transsexual'){
		h3.innerHTML = totm;
	}else{
		h3.innerHTML = gotm;
	}
}

////////// 2. UPLOAD CARE ////////
// const widget = uploadcare.Widget('[role=uploadcare-uploader-videos]');
// preview uploaded images function
function installWidgetPreviewMultiple(widget, list) {
	widget.onChange(function(fileGroup) {
		list.empty();
		if (fileGroup) {
			$.when.apply(null, fileGroup.files()).done(function() {
				$.each(arguments, function(i, fileInfo) {
					var src = fileInfo.cdnUrl;
					list.append(
						$('<div/>', {'class': '_item'}).append(
							[$('<img/>', {src: src})])
						);
				});
			});
		}
	});
}

setInterval(function(){
	$('#profileForm').formValidation('revalidateField', 'photos');
},500);
function minDimensions(width, height) {
	return function(fileInfo) {
		var imageInfo = fileInfo.originalImageInfo;
		if (imageInfo !== null) {
			if (imageInfo.width < width || imageInfo.height < height) {
				throw new Error('{{ __('messages.min_dimensions') }}');
			}
		}
	};
}

// file maximum size
function maxFileSize(size) {
	return function (fileInfo) {
		if (fileInfo.size !== null && fileInfo.size > size) {
			throw new Error('{{ __('messages.file_maximum_size') }}');
		}
	}
}
// file type limit
function fileTypeLimit(types) {
	types = types.split(' ');
	return function(fileInfo) {
		if (fileInfo.name === null) {
			return;
		}
		var extension = fileInfo.name.split('.').pop();
		if (types.indexOf(extension) == -1) {
			throw new Error('{{ __('messages.file_type') }}');
		}
	};
}

$(function() {
	// preview images initialization
	$('.image-preview-multiple').each(function() {
		installWidgetPreviewMultiple(
			uploadcare.MultipleWidget($(this).children('input')),
			$(this).children('._list')
			);
	});

	$('[role=uploadcare-uploader]').each(function() {
		var widget = uploadcare.Widget(this);
		widget.validators.push(minDimensions(490, 560));
	});

	var video = document.getElementById('video');
	var source = document.createElement('source');
	var widget = uploadcare.Widget('[role=uploadcare-uploader-video]');
	widget.validators.push(fileTypeLimit($('[role=uploadcare-uploader-video]').data('file-types')));	
	widget.validators.push(maxFileSize(20000000));
	// preview single video
	widget.onUploadComplete(function (fileInfo) {
		source.setAttribute('src', fileInfo.cdnUrl);
		video.appendChild(source);
		// video.play();
	});
	// remove video element
	$('.upload-video').find('button.uploadcare--widget__button_type_remove').on('click', function () {
		$('.upload-video').find('#video').remove();
	});
});
</script>
<script>
/////////// 3. MY JQUERY ////////////
$(function () {
	// add new price
	$('button.add-new-price').on('click', function (e) {
		e.preventDefault();
		$(this).attr('disabled', true);
		var serviceDuration = $('input[name="service_duration"]').val();
		var servicePrice = $('input[name="service_price"]').val();
		var priceType = $('select[name="price_type"]').val();
		var servicePriceUnit = $('select[name="service_price_unit"]').val();
		var servicePriceCurrency = $('select[name="service_price_currency"]').val();
		var token = $(this).siblings('input').val();
		$.ajax({
			url: location.protocol + '//' + location.host + '/ajax/add_new_price',
			type: 'post',
			data: {
				service_duration: serviceDuration, 
				service_price: servicePrice, 
				price_type: priceType,
				service_price_unit: servicePriceUnit,
				service_price_currency: servicePriceCurrency,
				_token: token
			},
			success: function (data) {
				var priceSection = $('.price_section');
				var errors = data.errors;
				if ($.isEmptyObject(errors)) {
	            // remove error messages if there are any and remove the has-error class
	            var input = priceSection.find('input:visible');
	            input.next().text('');
	            input.val('');
	            input.closest('.form-group').removeClass('has-error');
	            // find table and table body
	            var table = $('.price-table-container').find('table');
	            var tBody = table.find('tbody#prices_body');
	            // add row
	            var row = $('<tr></tr>');
	            // add tds to newly created row
	            var priceType = data.priceType;
	            var td = $('<td></td>', {
	            	text: capitalizeFirstLetter(priceType)
	            });
	            var td1 = $('<td></td>', {
	            	text: data.serviceDuration + ' ' + data.servicePriceUnit
	            });
	            var currency = data.servicePriceCurrency;
	            var td2 = $('<td></td>', {
	            	text: data.servicePrice + ' ' + currency.toUpperCase()
	            });
	            var td3 = $('<td></td>');
	            var glyphiconSpan = $('<span></span>', {
	            	class: 'glyphicon glyphicon-trash'
	            });
	            var deleteButton = $('<a></a>', {
	            	href: location.protocol + '//' + location.host + '/ajax/delete_price/' + data.newPriceID,
	            	class: 'text-danger delete-price'
	            }).append(glyphiconSpan).appendTo(td3);

	            row.append(td, td1, td2, td3).appendTo(tBody);

	            if (table.hasClass('is-hidden')) {
	            	table.removeClass('is-hidden').addClass('is-active-table');
	            }
	            $(this).attr('disabled', false);	            
	        } else {
	            // print the errors
	            $.each(errors, function (key, val) {
	            	var input = priceSection.find('[name="'+ key +'"]');
	            	input.closest('div.form-group').addClass('has-error');
	            	input.next().text(val);
	            });
	            $(this).attr('disabled', false);
	        }
	    }
	});
	});
});
// delete price
$(function () {
	$(".price-table-container").on("click", "a.delete-price", function(e) {
		e.preventDefault();
		var that = $(this);
		var url = that.attr('href');
		var priceID = url.split('/').pop();
		if (confirm('{{ __('global.are_you_sure') }}')) {
			$.ajax({
				url: url,
				type: 'get',
				data: {price_id: priceID},
				success: function (data) {
					if (data.success === true) {
						var tBody = that.closest('tbody');
						that.closest('tr').remove();
						if (tBody.children().length == 0) {
							tBody.parent('table').removeClass('is-active-table').addClass('is-hidden');
						}
					}
				}
			});
		} else {
			return false;
		}
	});
});
</script>

<script>
	// my checkbox act like a radio button
	$(function () {
		$("input.gotm_checkbox:checkbox").on('change', function() {
			$('input.gotm_checkbox:checkbox').not(this).prop('checked', false);
		});
	});
</script>

<!-- Contact script -->
<script>
	$(function () {
		$('input#skype_contact').on('click', function () {
			$('.skype-name').toggle();
		});
	});
</script>

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
			incallDefineYourself.val('');
		});

		$('input#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.show();
		});
		$('.outcall-options label input').not('#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.hide();
			outcallDefineYourself.val('');
		});
	});
</script>

<script>
	$(function () {
		var selectAllDays = $('#select_all_days');
		var workingTimesRows = $('table.working-times-table').find('tr');
		var workingTimesBodyRows = $('table.working-times-table tbody').find('tr');

		$('.working-times-table tr td:first-child input').on('click', function () {
			var that = $(this);
			var closestTr = that.closest('tr');
			if (closestTr.hasClass('working-times-disabled')) {
				closestTr.removeClass('working-times-disabled');
				closestTr.find('select, input').attr('disabled', false);
			} else {
				closestTr.addClass('working-times-disabled');
				closestTr.find('select, td:last-child input').attr('disabled', true);
				closestTr.find('input').prop('checked', false);
			}
		});

		$('#available_24_7 label:first-child input').on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				that.closest('label')
				.next('label')
				.removeClass('working-times-disabled')
				.find('input')
				.attr('disabled', false);
				$('table.working-times-table').addClass('working-times-disabled').find('select, input').attr('disabled', true);
			} else {
				that.closest('label')
				.next('label')
				.addClass('working-times-disabled')
				.find('input')
				.attr('disabled', true)
				.prop('checked', false);

				selectAllDays.attr('disabled', false);
				$('table.working-times-table').removeClass('working-times-disabled');		
				$('table.working-times-table').find('input').attr('disabled', false);
				workingTimesBodyRows.each(function () {
					if (!$(this).hasClass('working-times-disabled')) {
						$(this).find('select').attr('disabled', false);
					}
				});
			}
		});

		selectAllDays.on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				$('#available_24_7').addClass('working-times-disabled').find('input').attr('disabled', true);
				that.closest('table').removeClass('working-times-disabled').find('tr').removeClass('working-times-disabled');
				that.closest('table').find('select, input').attr('disabled', false).prop('checked', true);
			} else {
				$('#available_24_7').removeClass('working-times-disabled').find('label:first-child input').attr('disabled', false);
				that.attr('disabled', false).closest('tr').removeClass('working-times-disabled');
				workingTimesBodyRows.addClass('working-times-disabled').find('select').attr('disabled', true).prop('checked', false);
				workingTimesBodyRows.find('input').attr('disabled', false).prop('checked', false);
			}
		});
	});
</script>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
	let stripe = StripeCheckout.configure({
		key: '{{ config('services.stripe.key') }}',
		image: '{{ asset('img/logo.png') }}',
		locale: 'auto',
		token: function (token) {
			var stripeEmail = $('#stripeEmail');
			var stripeToken = $('#stripeToken');
			stripeEmail.val(token.email);
			stripeToken.val(token.id);
			// submit the form
			var username = '{{ $user->username }}';
			var url = getUrl('/@' + username + '/store');
			var token = $('input[name="_token"]').val();
			var form = $('#profileForm');
			var data = form.serialize();
			// fire ajax post request
			$.post(url, data)
			.done(function (data) {
				window.location.href = getUrl();
			})
			.fail(function(data, textStatus) {
				$('.default-packages-section').find('.help-block').text(data.responseJSON.status);
			});
		}
	});
	$('#profileForm').on('submit', function (e) {
		stripe.open({
			name: 'Ullallà',
			description: '{{ $user->email }}',
		});
		e.preventDefault();	
	});
</script>

<script>
	$('#apply_to_all').on('click', function (e) {
		e.preventDefault();
		var workingTimesTable = $('.working-times-table');
		var firstRow = workingTimesTable.find('tbody tr:first-child');
		var rows = workingTimesTable.find('tbody tr');
		var firstRowFromHrs = firstRow.find('select[name="time_from[1]"]').val();
		var firstRowFromMin = firstRow.find('select[name="time_from_m[1]"]').val();
		var firstRowToHrs = firstRow.find('select[name="time_to[1]"]').val();
		var firstRowToMin = firstRow.find('select[name="time_to_m[1]"]').val();
		
		$.each(rows, function (index, field) {
			var reindex = index + 1;

			$(field).find('select[name="time_from[' + reindex + ']"]').val(firstRowFromHrs);
			$(field).find('select[name="time_from_m[' + reindex + ']"]').val(firstRowFromMin);

			$(field).find('select[name="time_to[' + reindex + ']"]').val(firstRowToHrs);
			$(field).find('select[name="time_to_m[' + reindex + ']"]').val(firstRowToMin);
		});
	});
</script>

<!-- Validation variables -->
<script type="text/javascript">
	var requiredField = '{{ __('validation.required_field') }}';
	var alphaNumeric = '{{ __('validation.alpha_numerical') }}';
	var olderThan = '{{ __('validation.older_than_18') }}';
	var stringLength = '{{ __('validation.string_length') }}';
	var numericError = '{{ __('validation.numeric_error') }}';
	var defaultPackageRequired = '{{ __('validation.default_package_required') }}';
	var maxFiles = '{{ __('validation.max_files') }}';
</script>
@stop

