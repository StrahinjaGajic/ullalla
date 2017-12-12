@extends('layouts.app')

@section('title', 'Girls')

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
                {!! parseEditLocalProfileMenu('girls') !!}
            </div>
            <div class="col-sm-10 profile-info">
                <button id="showModal" type="submit" class="btn btn-default">Add Girl</button><br><br>
                <h3>Girls</h3>
                {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/girls/store', 'method' => 'put']) !!}
                @foreach($local->girls as $girl)
                    <div class="col-3 input-effect {{ $errors->has('nickname') ? 'has-error' : ''  }}">
                        <input class="effect-16" type="text" placeholder="" name="nickname_{{ $girl->id }}" value="{{ $girl->nickname }}">
                        <label>Nickname</label>
                        <span class="focus-border"></span>
                        @if ($errors->has('nickname'))
                            <span class="help-block">{{ $errors->first('nickname') }}</span>
                        @endif
                    </div>
                    <label>Photos</label>
                    <div class="form-group">
                        <div class="image-preview-multiple">
                            <input type="hidden" role="uploadcare-uploader_{{ $girl->id }}" name="photos_{{ $girl->id }}" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                            <script>
                                const widget_{{ $girl->id }} = uploadcare.Widget('[role=uploadcare-uploader_{{ $girl->id }}]')
                                widget_{{ $girl->id }}.value('{{ $girl->photos }}')
                            </script>
                            <div class="_list">
                                @for ($i = 0; $i < substr($girl->photos, -2, 1); $i++)
                                    <div class="_item">
                                        <img src="{{ $girl->photos . 'nth/' . $i . '/-/resize/250x200/' }}">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-default">Save Changes</button>
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
                        <section data-step="0">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Nickname*</label>
                                    <input type="text" class="form-control" name="nickname" />
                                </div>
                                <div class="form-group">
                                    <div class="image-preview-multiple">
                                        <input type="hidden" role="uploadcare-uploader" name="newPhotos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                                        <div class="_list"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('perPageScripts')

    <script src="{{ asset('js/formValidation.min.js') }}"></script>
    <script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/profileValidation.js') }}"></script>
    <script src="{{ asset('js/billing.js') }}"></script>
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
// make modal content scrolablle
            $('#profileForm').find('.content').addClass('is-scrollable');
// initially set default value to empty
            $('#date_of_birth').val('');
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


        ////////// 2. UPLOAD CARE ////////

        // preview uploaded images function
        function installWidgetPreviewMultiple(widget, list) {
            widget.onChange(function(fileGroup) {
                list.empty();
                if (fileGroup) {
                    $.when.apply(null, fileGroup.files()).done(function() {
                        $.each(arguments, function(i, fileInfo) {
                            var src = fileInfo.cdnUrl;
                            console.log(src);

                            list.append(
                                    $('<div/>', {'class': '_item'}).append(
                                            [$('<img/>', {src: src, style: "width: 250px; height: 200px;"})])
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
                        throw new Error('dimensions');
                    }
                }
            };
        }

        // file maximum size
        function maxFileSize(size) {
            return function (fileInfo) {
                if (fileInfo.size !== null && fileInfo.size > size) {
                    throw new Error("fileMaximumSize");
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
                    throw new Error("fileType");
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
@stop