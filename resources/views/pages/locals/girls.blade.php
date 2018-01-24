@extends('layouts.app')

@section('title', 'Girls')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditLocalProfileMenu('girls') !!}
        </div>
        <div class="col-sm-10 profile-info">
            <button id="showModal" type="submit" class="btn btn-default">Add Girl</button><br><br>
            @if($local->girls()->count() > 0)
            <h3 style="margin: 0; font-size:34px;">Girls</h3>
            @endif
            {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/girls/store', 'method' => 'put']) !!}
            @foreach($local->girls as $girl)
{{--             <div class="col-3 input-effect {{ $errors->has('nickname') ? 'has-error' : ''  }}">
                <input class="effect-16" type="text" placeholder="" name="nickname_{{ $girl->id }}" value="{{ $girl->nickname }}">
                <label>{{ __('fields.nickname') }}</label>
                <span class="focus-border"></span>
                @if ($errors->has('nickname_'. $girl->id))
                <span class="help-block">{{ $errors->first('nickname_'. $girl->id ) }}</span>
                @endif
            </div> --}}
            <div class="shop-layout headerDropdown">
                <div class="layout-title">
                    <div class="layout-title toggle_arrow">
                        <a>{{ $girl->nickname }} <i class="fa fa-caret-right"></i></a>
                    </div>
                </div>
                <div class="layout-list">
                    <div class="form-group girls_preview">
                        <div class="image-preview-multiple">
                           <label class="heading_photos">{{ __('headings.photos') }}</label>
                           <br>
                           <input type="hidden" role="uploadcare-uploader_{{ $girl->id }}" name="photos_{{ $girl->id }}" data-multiple-min="4" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                           <script>
                            const widget_{{ $girl->id }} = uploadcare.Widget('[role=uploadcare-uploader_{{ $girl->id }}]')
                            widget_{{ $girl->id }}.value('{{ $girl->photos }}')
                        </script>
                        <div class="_list">
                            @for ($i = 0; $i < substr($girl->photos, -2, 1); $i++)
                            <div class="_item">
                                <img src="{{ $girl->photos . 'nth/' . $i . '/-/resize/185x211/' }}">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        @if ($errors->has('photos_'. $girl->id))
        <span class="help-block">{{ $errors->first('photos_'. $girl->id ) }}</span>
        @endif
        @endforeach
        @if($local->girls()->count() > 0)
        <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
</div>
<div class="wrapper section-create-profile">
    <div id="create_profile_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    {!! Form::open(['url' => 'locals/@' . $local->username . '/girls/create', 'class' => 'form-horizontal wizard', 'id' => 'profileForm', 'method' => 'PUT']) !!}
                    <h2>Add Girl</h2>
                    <div class="col-xs-12">
                        <div class="form-group modal_form">
                            <label class="control-label">{{ __('fields.nickname') }}*</label>
                            <input type="text" class="form-control" name="nickname" />
                            @if ($errors->has('nickname'))
                            <span class="help-block">{{ $errors->first('nickname') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="image-preview-multiple">
                                <input type="hidden" role="uploadcare-uploader" name="newPhotos" data-multiple-min="4" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                                <div class="_list"></div>
                                @if ($errors->has('newPhotos'))
                                <span class="help-block">{{ $errors->first('newPhotos') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
                </div>
            </div>
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
<script src="{{ asset('js/formValidation.min.js') }}"></script>
<script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/girlValidation.js') }}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
        ////////// 1. MODAL, DATERANGE PICKER, ////////
        // show modal on page load
        $("#showModal").on('click',function(){
            $('#create_profile_modal').modal('show');
        });
        $(function () {
            $('#profileForm').find('.content').addClass('is-scrollable');
            $('#date_of_birth').val('');
            var start = new Date();
            start.setFullYear(start.getFullYear());
            var end = new Date();
            end.setFullYear(end.getFullYear() + 1);
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
            widget.value('{{ $local->videos }}')
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
    <script type="text/javascript">
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
        $('.control__indicator').on('click', function () {
          window.location.href = $(this).closest('label').find('a').attr('href');
      });
  </script>

  <script>
    $(".toggle_arrow").on("click", function() {
        var that = $(this);
        that.closest('.shop-layout').find('.layout-list').toggle('fast');
        that.parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
</script>
@stop