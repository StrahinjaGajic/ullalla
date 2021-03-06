@extends('layouts.app')

@section('title', __('headings.gallery'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
  <div class="row">
     <div class="col-sm-2 vertical-menu">
        {!! parseEditLocalProfileMenu('gallery') !!}
    </div>
    <div class="col-sm-10 profile-info">
        {!! Form::model($local, ['url' => 'locals/@' . $local->username . '/gallery/store', 'method' => 'PUT']) !!}
        <h3 style="margin-bottom: 40px;">{{ __('headings.gallery') }}</h3>
        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="row" style="margin-left: 1px;">
            <h1>{{ __('headings.logo') }}</h1>
            <div class="form-group">
                <div class="image-preview-single">
                    <input type="hidden" role="uploadcare-uploaderLogo" name="photo" data-crop="278x165 minimum" data-images-only=""><br><br>
                    @if($local->photo)
                        <img src="{{ $local->photo .'/-/resize/278x165/' }}">
                    @endif
                </div>
            </div>
            <h1>{{ __('headings.photos') }}</h1>
            <div class="form-group">
                <div class="image-preview-multiple">
                    <input type="hidden" role="uploadcare-uploader" name="photos" data-multiple-min="4" data-multiple-max="9" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                    <div class="_list">
                        @for ($i = 0; $i < substr($local->photos, -2, 1); $i++)
                        <div class="_item">
                            <img src="{{ $local->photos . 'nth/' . $i . '/-/resize/185x211/' }}">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            @if ($errors->has('photos'))
            <span class="help-block">{{ $errors->first('photos') }}</span>
            @endif
            <h1>{{ __('headings.videos') }}</h1>
            <div class="form-group upload-video">
                <input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="mp4 ogv mov mkv"/><br><br>
                @if($local->videos)
                <video src="{{ $local->videos }}" id="video" width="320" height="240" style="display: block;" controls=""></video>
                @else
                <video id="video" width="320" height="240" style="display: none;"></video>
                @endif
            </div>
        </div>
        <button type="submit" id="submitButton" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('perPageScripts')
<script>
////////// 2. UPLOAD CARE ////////
// change text of a button to upload logo
$(window).on('load',function(){
    $('input[name="photo"]').closest('.image-preview-single').find('button.uploadcare--widget__button_type_open').text('{{ __('buttons.upload_logo') }}');
});

const widget = uploadcare.Widget('[role=uploadcare-uploader]')
widget.value('{{ $local->photos }}')

const widgetLogo = uploadcare.Widget('[role=uploadcare-uploaderLogo]')
widgetLogo.value('{{ $local->photo }}')

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
                            [$('<img/>', {src: src, style: "width: 250px; height: 200px;"})])
                        );
                });
            });
        }
    });
}

function installWidgetPreviewSingle(widget, img) {
    widget.onChange(function(file) {
        img.css('visibility', 'hidden');
        img.attr('src', '');
        if (file) {
            file.done(function(fileInfo) {
                var previewUrl = fileInfo.cdnUrl + '-/resize/185x211/';
                img.attr('src', previewUrl);
                img.css('visibility', 'visible');
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

// implements functions
$(function() {
    // preview images initialization
    $('.image-preview-multiple').each(function() {
        installWidgetPreviewMultiple(
            uploadcare.MultipleWidget($(this).children('input')),
            $(this).children('._list')
            );
    });

    $('.image-preview-single').each(function() {
        installWidgetPreviewSingle(
            uploadcare.SingleWidget($(this).children('input')),
            $(this).children('img')
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
    widget.validators.push(maxFileSize(400000000));
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

setInterval(function(){
    var text = document.getElementsByClassName('uploadcare--widget__text')[2].innerHTML;
    var button = document.getElementsByClassName('btn')[0];
    if(text.includes('Uploading') && text.includes('Please wait')) {
        button.disabled = true;
    }else{
        button.disabled = false;
    }
    document.getElementsByClassName('uploadcare--widget__button_type_cancel')[2].onclick = function () {
        document.getElementsByClassName('uploadcare--widget__text')[2].innerHTML = "";
    };
},500);
</script>
@stop