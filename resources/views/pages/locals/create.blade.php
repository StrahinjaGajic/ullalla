@extends('layouts.app')

@section('title', 'Create Local')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/create_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
@stop

@section('content')
<div class="wrapper section-create-profile">
    <div id="create_profile_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    {!! Form::open(['url' => 'locals/@' . $local->username . '/store', 'class' => 'form-horizontal wizard', 'id' => 'profileForm', 'method' => 'PUT']) !!}
                    <ul class="nav nav-pills">
                        <li class="active pad-left"><a href="#contact-tab" data-toggle="tab">{{ __('headings.contact') }}</a></li>
                        <li><a href="#about-us-tab" data-toggle="tab">{{ __('headings.about_us') }}</a></li>
                        <li class="pad-right"><a href="#gallery-tab" data-toggle="tab">{{ __('headings.gallery') }}</a></li>
                        <li class="pad-left"><a href="#working-hours-tab" data-toggle="tab">{{ __('headings.working_hours') }}</a></li>
                        <li><a href="#club-info-tab" data-toggle="tab">{{ __('headings.club_info') }}</a></li>
                        <li class="pad-right"><a href="#packages-tab" data-toggle="tab">{{ __('headings.packages') }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <section class="tab-pane active" id="contact-tab">
                            <div class="col-xs-12 via">
                                <div class="form-group">
                                    <label class="control control--checkbox" style="margin-left: 0px;"><a>{{ __('fields.sms_notify') }}</a>
                                        <input type="checkbox" name="sms_notifications">
                                        <div class="control__indicator service_list"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.name') }}*</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.phone') }}*</label>
                                    <input type="text" class="form-control" name="phone" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('fields.mobile') }}</label>
                                    <input type="text" class="form-control mobile-phone" name="mobile" id="mobile"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.web') }}</label>
                                    <input type="text" class="form-control" name="web" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.street') }}*</label>
                                    <input type="text" class="form-control" name="street" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.zip') }}*</label>
                                    <input type="text" class="form-control" name="zip" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.city') }}*</label>
                                    <input type="text" class="form-control" name="city" />
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane" id="about-us-tab">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('labels.about_us') }}</label><br>
                                    <textarea class="about_tab" name="about_me" style="width: 100%; height: 250px;"></textarea>
                                    <label class="control-label">{{ __('labels.local_type') }}</label><br>
                                    <select class="about_select" name="local_type_id">
                                        @php ($var = 'name_'. config()->get('app.locale'))
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->$var }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane" id="gallery-tab">
                            <div class="form-group">
                                <div class="image-preview">
                                    <input type="hidden" role="uploadcare-uploader" name="logo" data-crop="490x560 minimum" data-images-only="">
                                    <div class="_list"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="image-preview-multiple" style="margin-left:10px;">
                                    <input type="hidden" role="uploadcare-uploader" data-multiple-min="4" name="photos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                                <div class="image-preview-multiple">
                                    <input type="hidden" role="uploadcare-uploader" data-multiple-min="4" data-multiple-max="9" name="photos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                                    <div class="_list"></div>
                                </div>
                            </div>
                            <div class="form-group upload-video">
                                <input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="avi mp4 ogv mov wmv mkv"/>
                                <video id="video" width="320" height="240" loop style="display: block;"></video>
                            </div>
                        </section>

                        <section class="tab-pane" id="working-hours-tab">
                            <div class="col-xs-12">
                                    <div id="available_24_7" class="pull-left">
                                        <label class="control control--checkbox"><a>{{ __('labels.available_24_7') }}</a>
                                            <input type="checkbox" name="available_24_7">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-default" id="apply_to_all">{{ __('labels.apply_to_all') }}</button>
                                    </div>
                                    <div style="overflow-x: auto;">
                                    <table class="table working-times-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="control control--checkbox"><a>{{ __('labels.mark_all') }}</a>
                                                        <input type="checkbox" id="select_all_days">
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </th>
                                                <th>{{ __('buttons.from') }}</th>
                                                <th>{{ __('buttons.to') }}</th>
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
                                                    <span>{{ __('global.hrs') }}</span>
                                                    <select name="time_from_m[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getMinutesList() as $minute)
                                                        <option value="{{ $minute }}">{{ $minute }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>{{ __('global.min') }}</span>
                                                </td>
                                                <td>
                                                    <select name="time_to[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getHoursList() as $hour)
                                                        <option value="{{ $hour }}">{{ $hour }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>{{ __('global.hrs') }}</span>
                                                    <select name="time_to_m[{{ $counter }}]" class="form-control" disabled="">
                                                        @foreach(getMinutesList() as $minute)
                                                        <option value="{{ $minute }}">{{ $minute }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span>{{ __('global.min') }}</span>
                                                </td>
                                            </tr>
                                            <?php $counter++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            
                        </section>

                        <section class="tab-pane" id="club-info-tab">
                            <div class="col-xs-12">
                                <div class="form-group club-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">{{ __('labels.entrance') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-na" onclick="uncheckEntranceFree()" name="entrance" value="1" checked>
                                            <label class="control-label">{{ __('labels.n_a') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-free" onclick="uncheckEntrance()" name="entrance-free" value="1">
                                            <label class="control-label">{{ __('labels.free') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="entrance-cost" onclick="uncheckEntrance()" name="entrance-free" value="2">
                                            <label class="control-label">{{ __('labels.with_cost') }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">{{ __('labels.wellness') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="1" onclick="hideWellness()" checked>
                                            <label class="control-label">{{ __('labels.n_a') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="2" onclick="showWellness()">
                                            <label class="control-label">{{ __('labels.yes') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness" value="3" onclick="hideWellness()">
                                            <label class="control-label">{{ __('labels.no') }}</label>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="wellness-show">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness-free" value="1">
                                            <label class="control-label">{{ __('labels.free') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="wellness-free" value="2">
                                            <label class="control-label">{{ __('labels.with_cost') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">{{ __('labels.food_and_drinks') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="1" onclick="hideFood()" checked>
                                            <label class="control-label">{{ __('labels.n_a') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="2" onclick="showFood()">
                                            <label class="control-label">{{ __('labels.yes') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food" value="3" onclick="hideFood()">
                                            <label class="control-label">{{ __('labels.no') }}</label>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="food-show">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food-free" value="1">
                                            <label class="control-label">{{ __('labels.free') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="food-free" value="2">
                                            <label class="control-label">{{ __('labels.with_cost') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">{{ __('labels.outdoor_area') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="1" checked>
                                            <label class="control-label">{{ __('labels.n_a') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="2">
                                            <label class="control-label">{{ __('labels.yes') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="outdoor" value="3">
                                            <label class="control-label">{{ __('labels.no') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane" id="packages-tab">
                            <div class="col-xs-12">
                                <div class="form-group club-info">
                                    <div class="row">
                                        <div class="col-xs-12 default-packages-section" id="default-packages-section">
                                            <h3>{{ __('headings.default_packages') }}</h3>
                                            <div class="has-error">
                                                <div id="alertPackageMessage" class="help-block"></div>
                                            </div>
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
                                                        @if($package->id == 6)
                                                        <td colspan="4"><p>More Girls?</p></td>
                                                        @else
                                                        <td>{{ $package->name. ' ' }}{{ ($package->id != 1) ? __('functions.girls') : '' }}</td>
                                                        <td>
                                                            <select name="package_duration[{{ $package->id }}]" id="selectDur_{{ $package->id }}" onchange="changePrice('{{ $package->id }}', '{{ $package->month_price }}', '{{ $package->year_price }}')">
                                                                <option value="month">{{ __('tables.month') }}</option>
                                                                <option value="year">{{ __('tables.year') }}</option>
                                                            </select>
                                                        </td>
                                                        <td id="price_{{ $package->id }}">{{ $package->month_price }}</td>
                                                        <td>
                                                            <input type="text" name="default_package_activation_date[{{ $package->id }}]" class="package_activation" id="package_activation{{ $counter }}">
                                                        </td>
                                                        @endif
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
<script src="{{ asset('js/localValidation.js?ver=' . str_random(10)) }}"></script>s
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>

    function changePrice(id, month, year){
        var price = $('#selectDur_' + id + ' :selected').val();
        if(price == 'month'){
            price = month;
        }else if(price == 'year'){
            price = year;
        }
        $('#price_' + id).text(price);
    }

        ////////// 1. MODAL, DATERANGE PICKER, ////////
        // show modal on page load
        $(window).on('load',function(){
            $('#create_profile_modal').modal('show');
        });
        $(function () {

            $('#create_profile_modal').modal({
                backdrop: 'static',
                keyboard: false
            });

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
                    console.log();
                    if (imageInfo.width < width || imageInfo.height < height) {
                        throw new Error('minDimensions');
                    }
                }
            };
        }

        // file maximum size
        function maxFileSize(size) {
            return function (fileInfo) {
                if (fileInfo.size !== null && fileInfo.size > size) {
                    throw new Error('fileMaximumSize');
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
                    throw new Error('fileType');
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
                var username = '{{ $local->username }}';
                var url = getUrl('/locals/@' + username + '/store');
                console.log(url);
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
            var packageId = document.querySelector('input[name="ullalla_package[]"]:checked').value;
            if(packageId != 6) {
                stripe.open({
                    name: 'Ullallà',
                    description: '{{ $local->email }}',
                });
                e.preventDefault();
            } else {
                var username = '{{ $local->username }}';
                var url = getUrl('/locals/@' + username + '/store');
                var token = $('input[name="_token"]').val();
                var form = $('#profileForm');
                var data = form.serialize();
                // fire ajax post request
                $.post(url, data)
                .done(function (data) {
                    window.location.href = getUrl("/signin");
                })
                .fail(function(data, textStatus) {
                    $('.default-packages-section').find('.help-block').text(data.responseJSON.status);
                });
            }
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

    <script type="text/javascript">
        var requiredField = '{{ __('validation.required_field') }}';
        var alphaNumeric = '{{ __('validation.alpha_numerical') }}';
        var olderThan = '{{ __('validation.older_than_18') }}';
        var stringLength = '{{ __('validation.string_length') }}';
        var numericError = '{{ __('validation.numeric_error') }}';
        var invalidUrl = '{{ __('validation.url_invalid') }}';
        var defaultPackageRequired = '{{ __('validation.default_package_required') }}';
        var maxFiles = '{{ __('validation.max_files') }}';
        var maxStrLength10 = '{{ __('validation.max_str_length', ['max' => 10]) }}';
        var maxStrLength20 = '{{ __('validation.max_str_length', ['max' => 20]) }}';
        var maxStrLength30 = '{{ __('validation.max_str_length', ['max' => 30]) }}';
    </script>

    @stop

