@extends('layouts.app')

@section('title', __('headings.gallery'))

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
            {!! parseEditProfileMenu('gallery') !!}
        </div>
        <div class="col-sm-10 profile-info">
            {!! Form::model($user, ['url' => '@' . $user->username . '/gallery/store', 'method' => 'PUT']) !!}
            <h3>{{ __('headings.gallery') }}</h3>
            <div class="row" style="margin-left:1px;">
                <h4>{{ __('headings.photos') }}</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="form-group">
                    <div class="image-preview-multiple">
                        <input type="hidden" role="uploadcare-uploader" name="photos" data-multiple-min="4" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                        <div class="_list">
                            @for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
                            <div class="_item">
                                <img src="{{ $user->photos . 'nth/' . $i . '/-/resize/185x211/' }}">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <h4>{{ __('headings.videos') }}</h4>
                <div class="form-group upload-video">
                    <input type="hidden" name="video" id="video-uploader" data-file-types="avi mp4 ogv mov wmv mkv"/>
                    @if($user->videos)
                    <video src="{{ $user->videos }}" id="video" width="320" height="240" style="display: block;" controls=""></video>
                    @else
                    <video id="video" width="320" height="240" style="display: none;"></video>
                    @endif
                </div>
            </div>
            <div class="save">
            <button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @stop

    @section('perPageScripts')
    <script>
    const photosWidget = uploadcare.Widget('[role=uploadcare-uploader]');
    photosWidget.value('{{ $user->photos }}');

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

// preview images initialization
$('.image-preview-multiple').each(function() {
    installWidgetPreviewMultiple(
        uploadcare.MultipleWidget($(this).children('input')),
        $(this).children('._list')
        );
});

$('[role=uploadcare-uploader]').each(function() {
    var photosWidget = uploadcare.Widget(this);
    photosWidget.validators.push(minDimensions(490, 560));
});


// videos 
var video = document.getElementById('video');
var source = document.createElement('source');
const videosWidget = uploadcare.Widget('#video-uploader');
videosWidget.value('{{ $user->videos }}');

videosWidget.validators.push(fileTypeLimit($('#video-uploader').data('file-types')));    
videosWidget.validators.push(maxFileSize(20000000));
// preview single video
videosWidget.onUploadComplete(function (fileInfo) {
    source.setAttribute('src', fileInfo.cdnUrl);
    video.appendChild(source);
});
    // remove video element
    $('.upload-video').find('button.uploadcare--widget__button_type_remove').on('click', function () {
        $('.upload-video').find('#video').remove();
    });
</script>
@stop