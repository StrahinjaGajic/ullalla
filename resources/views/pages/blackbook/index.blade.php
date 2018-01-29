@extends('layouts.app')

@section('title', __('headings.blackbook'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/components/blackbook.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-12 profile-info blackbook-profile-info">
            <div class="col-sm-12">
                <h3>{{ __('headings.blackbook') }}</h3>
                <div class="action-header no-print">
                    <button class="btn btn-default" data-toggle="modal" data-target="#blackbook_modal">{{ __('buttons.entry') }}</button>
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            @if($blackbooks->count() > 0)
            <div class="col-xs-12 price-table-container" style="margin-top: 30px;">
               <div style="overflow-x:auto;">
                <table class="table blackbook_table">
                    <thead>
                        <tr>
                            <th>{{ __('fields.date') }}</th>
                            <th>{{ __('fields.photo') }}</th>
                            <th>{{ __('fields.client_name') }}</th>
                            <th>{{ __('fields.client_phone') }}</th>
                            <th>{{ __('fields.city') }}</th>
                            <th>{{ __('fields.description') }}</th>
                        </tr>
                    </thead>
                    <tbody id="prices_body">
                        @foreach ($blackbooks as $blackbook)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($blackbook->date)) }}</td>
                            <td>
                                @if ($blackbook->photo)
                                <div class="image-tooltip">
                                    <img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($blackbook->photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='blackbook image'/>
                                    <span>
                                        <img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($blackbook->photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='blackbook image'/>
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td>{{ $blackbook->name }}</td>
                            <td>{{ $blackbook->phone }}</td>
                            <td>{{ $blackbook->city }}</td>
                            <td>{{ $blackbook->comment }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            @endif
        </div>
        <div id="blackbook_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content blackbook_modal">
                    <div class="modal-header blackbook_modal_header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Make a blackbook entry</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'private/blackbook/store', 'class' => 'form-horizontal']) !!}
                        <div class="col-sm-6">
                            <div class="form-group mar-right {{ $errors->has('date') ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('fields.date') }}</label>
                                <input type="text" class="form-control blackbook_input" name="date" id="datepicker">
                                @if ($errors->has('date'))
                                <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mar-left">
                                <label class="control-label">City</label>
                                <input type="text" class="form-control blackbook_input" name="city">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mar-right {{ $errors->has('client_name') ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('fields.client_name') }}*</label>
                                <input type="text" class="form-control blackbook_input" name="client_name">
                                @if ($errors->has('client_name'))
                                <span class="help-block">{{ $errors->first('client_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mar-left {{ $errors->has('client_phone') ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('fields.client_phone') }}*</label>
                                <input type="text" class="form-control blackbook_input" name="client_phone">
                                @if ($errors->has('client_phone'))
                                <span class="help-block">{{ $errors->first('client_phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('fields.description') }}*</label>
                                <textarea class="blackbook_textarea" name="description""></textarea>
                                @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                            <div class="col-sm-6 col-xs-12 modal_upload_button">
                                <input type="hidden" name="photo" class="pull-left" role="uploadcare-uploader" data-crop="1:1" data-images-only="">
                                @if ($errors->has('photo'))
                                <span class="help-block">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-6 modal_submit_button">
                                <button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer blackbook_modal_footer">
                        <button type="button" class="btn btn-default blackbook_close" data-dismiss="modal">{{ __('buttons.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
@if($errors->any())
<script>
    $('#blackbook_modal').modal('show');
</script>
@endif
<script>
    // get new start and end year
    var start = new Date();
    start.setFullYear(start.getFullYear() - 1);
    var end = new Date();
    end.setFullYear(end.getFullYear() + 1);
    $(function () {
        $( "#datepicker" ).daterangepicker({
            singleDatePicker: true,
            timepicker: false,
            showDropdowns: true,
            minDate: start,
            maxDate: new Date(),
            locale: {
                format: 'DD-MM-YYYY'
            },
        });
    });
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

<script>
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

$(function () {
    var widget = uploadcare.Widget('[role=uploadcare-uploader]');
    widget.validators.push(minDimensions(200, 200)); 
    widget.validators.push(maxFileSize(20000000));
});
</script>
@stop