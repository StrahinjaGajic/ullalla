@extends('layouts.app')

@section('title', 'Create Local')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/components/create_profile.css') }}">
@stop

@section('content')
    <div class="wrapper section-create-profile">
        <div id="create_profile_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        {!! Form::open(['url' => 'locals/@' . $local->username . '/store', 'class' => 'form-horizontal wizard', 'id' => 'profileForm', 'method' => 'PUT']) !!}
                        <h2>Contact</h2>
                        <section data-step="0">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="control-label">Name*</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Web</label>
                                    <input type="text" class="form-control" name="web" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="control-label">Street</label>
                                    <input type="text" class="form-control" name="street" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">ZIP</label>
                                    <input type="text" class="form-control" name="zip" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control" name="city" />
                                </div>
                            </div>
                        </section>
                        <h2>Gallery</h2>
                        <section data-step="1">
                            <div class="form-group">
                                <div class="image-preview">
                                    <input type="hidden" role="uploadcare-uploader" name="logo" data-crop="490x560 minimum" data-images-only="">
                                    <div class="_list"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="image-preview-multiple">
                                    <input type="hidden" role="uploadcare-uploader" name="photos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                                    <div class="_list"></div>
                                </div>
                            </div>
                            <div class="form-group upload-video">
                                <input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="avi mp4 ogv mov wmv mkv"/>
                                <video id="video" width="320" height="240" loop style="display: block;"></video>
                            </div>
                        </section>
                        <h2>Working Hours</h2>
                        <section data-step="2">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div id="available_24_7">
                                        <label class="control control--checkbox"><a>Available 24/7</a>
                                            <input type="checkbox" name="available_24_7">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                    <table class="table working-times-table">
                                        <thead>
                                        <tr>
                                            <th>
                                                <label class="control control--checkbox"><a>Mark All</a>
                                                    <input type="checkbox" id="select_all_days">
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </th>
                                            <th>From</th>
                                            <th>To</th>
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
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </td>
                                                <td>
                                                    <select name="time_from[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getHoursList() as $hour)
                                                            <option value="{{ $hour }}">{{ $hour }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>hrs</span>
                                                    <select name="time_from_m[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getMinutesList() as $minute)
                                                            <option value="{{ $minute }}">{{ $minute }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>min</span>
                                                </td>
                                                <td>
                                                    <select name="time_to[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getHoursList() as $hour)
                                                            <option value="{{ $hour }}">{{ $hour }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>hrs</span>
                                                    <select name="time_to_m[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getMinutesList() as $minute)
                                                            <option value="{{ $minute }}">{{ $minute }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>min</span>
                                                </td>
                                            </tr>
                                            <?php $counter++; ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <h2>About us</h2>
                        <section data-step="3">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">About us</label><br>
                                    <textarea name="about_me" style="width:100%;height:250px;"></textarea>
                                    <label class="control-label">Local type</label><br>
                                    <select name="local_type_id">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </section>
                        <h2>Club Info</h2>
                        <section data-step="4">
                            <div class="col-xs-12">
                                <div class="form-group club-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Entrance</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-na" onclick="uncheckEntranceFree()" name="entrance" value="1" checked>
                                            <label class="control-label">N / A</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-free" onclick="uncheckEntrance()" name="entrance-free" value="1">
                                            <label class="control-label">Free</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-cost" onclick="uncheckEntrance()" name="entrance-free" value="2">
                                            <label class="control-label">With cost</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Wellness</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="1" onclick="hideWellness()" checked>
                                            <label class="control-label">N / A</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="2" onclick="showWellness()">
                                            <label class="control-label">Yes</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="3" onclick="hideWellness()">
                                            <label class="control-label">No</label>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="wellness-show">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness-free" value="1">
                                            <label class="control-label">Free</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness-free" value="2">
                                            <label class="control-label">With cost</label>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Food and drinks</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="1" onclick="hideFood()" checked>
                                            <label class="control-label">N / A</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="2" onclick="showFood()">
                                            <label class="control-label">Yes</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="3" onclick="hideFood()">
                                            <label class="control-label">No</label>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="food-show">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food-free" value="1">
                                            <label class="control-label">Free</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food-free" value="2">
                                            <label class="control-label">With cost</label>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Outdoor area</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="1" checked>
                                            <label class="control-label">N / A</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="2">
                                            <label class="control-label">Yes</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="3">
                                            <label class="control-label">No</label>
                                        </div>
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
            <!-- Form Validation -->
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
        $(window).on('load',function(){
            $('#create_profile_modal').modal('show');
        });
        $(function () {
// disabled modal closing on outside click and escape
            $('#create_profile_modal').modal({
                backdrop: 'static',
                keyboard: false
            });
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
                $('#profileForm').formValidation('revalidateField', 'photos');
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

            // 	<input type="hidden" role="uploadcare-uploader" name="video" data-multiple="true"/>
            // <div id="preview"></div>
            // preview multiple videos
            // var preview = document.getElementById('preview');
            // var widget = uploadcare.MultipleWidget('[role=uploadcare-uploader]');
            // widget.onDialogOpen(function (dialog) {
            // 	dialog.fileColl.onAnyDone(function (file) {
            // 		file.done(function (fileInfo) {
            // 			var video = document.createElement('video');
            // 			video.width = 320;
            // 			video.height = 240;
            // 			video.loop = true;
            // 			var source = document.createElement('source');
            // 			source.setAttribute('src', fileInfo.cdnUrl);
            // 			video.appendChild(source);
            // 			preview.appendChild(video);
            //     			// video.play();
            //     		})
            // 	})
            // })
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
    <script>
        /////////// 5. SHOW FREE / WITH COST   ////////////

        function showWellness(){
            document.getElementById('wellness-show').classList.remove("hidden");
        }

        function hideWellness(){
            document.getElementById('wellness-show').className += ' hidden';
        }

        function showFood(){
            document.getElementById('food-show').classList.remove("hidden");
        }

        function hideFood(){
            document.getElementById('food-show').className += ' hidden';
        }

    </script>
    <script>
        function uncheckEntrance(){
            document.getElementById('entrance-na').checked = false;
        }

        function uncheckEntranceFree(){
            document.getElementById('entrance-free').checked = false;
            document.getElementById('entrance-cost').checked = false;
        }
    </script>
@stop

