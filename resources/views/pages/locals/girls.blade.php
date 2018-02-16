@extends('layouts.app')

@section('title', 'Girls')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/create_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
@stop

@section('content')
<div class="container theme-cactus section-create-profile">
    <!-- Modal -->
    <div id="create_profile_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    {!! Form::open(['url' => 'locals/@' . $local->username . '/girls/store', 'class' => 'form-horizontal wizard', 'id' => 'profileForm']) !!}
                    <ul class="nav nav-pills">
                        <li class="active pad-left"><a href="#bio-tab" data-toggle="tab">{{ __('headings.bio') }}</a></li>
                        <li><a href="#gallery-tab" data-toggle="tab">{{ __('headings.gallery') }}</a></li>
                        <li class="pad-right"><a href="#services-tab" data-toggle="tab">{{ __('headings.services') }}</a></li>
                        <li><a href="#languages-tab" data-toggle="tab">{{ __('headings.languages') }}</a></li>
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
                                            <input type="hidden" class="spoken-language-input" name="spoken_language[{{ $language->id }}]">
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
                                            <input type="hidden" class="spoken-language-input" name="spoken_language[{{ $language->id }}]">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="show-more text-center">
                                <a href="#" class="btn btn-default">{{ __('buttons.show_more') }}</a>
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditLocalProfileMenu('girls') !!}
        </div>
        <div class="col-sm-10 profile-info">
            <div class="btn-wrapper">
                <button id="showModal" type="submit" class="btn btn-default">{{ __('buttons.add_girl') }}</button><br><br>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            @if($local->users()->count() > 0)
                <h3 style="margin: 0; font-size:34px;">Girls</h3>
                <div class="col-xs-12 price-table-container" style="margin-top: 30px;">
                    <div style="overflow-x:auto;">
                        <table class="table blackbook_table">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.photo') }}</th>
                                    <th>{{ __('fields.nickname') }}</th>
                                    <th>{{ __('fields.first_name') }}</th>
                                    <th>{{ __('fields.last_name') }}</th>
                                    <th>{{ __('fields.manage_table_item') }}</th>
                                </tr>
                            </thead>
                            <tbody id="prices_body">
                                @foreach ($local->users as $user)
                                <tr>
                                    <td>
                                        @if ($user->photos)
                                        <div class="image-tooltip">
                                            <img class='img-responsive img-align-center index-product-image' src='{{ $local->photos . 'nth/0/-/resize/50/' }}' alt='girl image'/>
                                            <span>
                                                <img class='img-responsive img-align-center' src='{{ $local->photos . 'nth/0/-/resize/150/' }}' alt='girl image'/>
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>
                                        <a href="{{ url('private/' . $user->id . '/bio') }}" class="btn btn-default">Edit</a>
                                        <form action="{{ url('locals/@' . $local->username . '/girls/' . $user->id . '/delete') }}" method="post">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-default" onclick="return confirm('Are you sure?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
    @if($errors->has('nickname') || $errors->has('newPhotos'))
        <script>
            $('#create_profile_modal').modal('show');
        </script>
    @endif
<script src="{{ asset('js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('js/formValidation.min.js') }}"></script>
<script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="{{ asset('js/girlValidation.js?ver=' . str_random(10)) }}"></script>
<script>
    ////////// 2. UPLOAD CARE ////////
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
                console.log();
                if (imageInfo.width < width || imageInfo.height < height) {
                    throw new Error('{{ __('messages.dimensions') }}');
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
        // show modal
        $("#showModal").on('click',function(){
            $('#create_profile_modal').modal('show');
        });

        $(window).on('load',function(){
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

        $('.show-more a').on('click', function(e){
            var that = $(this);
            e.preventDefault();
            that.text(that.text() == '{{ __('buttons.show_more') }}' ? '{{ __('buttons.show_less') }}' : '{{ __('buttons.show_more') }}');
            $('table.language-table').find('.language-list:last-child').toggle();
        });

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
        });
        // remove video element
        $('.upload-video').find('button.uploadcare--widget__button_type_remove').on('click', function () {
            $('.upload-video').find('#video').remove();
        });
    });
</script>

<script type="text/javascript">
    var utilAsset = '{{ asset('js/utils.js') }}';
    var invalidUrl = '{{ __('validation.url_invalid') }}';
    var requiredField = '{{ __('validation.required_field') }}';
    var alphaNumeric = '{{ __('validation.alpha_numerical') }}';
    var olderThan = '{{ __('validation.older_than_18') }}';
    var stringLength = '{{ __('validation.string_length') }}';
    var numericError = '{{ __('validation.numeric_error') }}';
    var invalidUrl = '{{ __('validation.url_invalid') }}';
    var defaultPackageRequired = '{{ __('validation.default_package_required') }}';
    var maxFiles = '{{ __('validation.max_files') }}';
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