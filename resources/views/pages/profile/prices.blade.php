@extends('layouts.app')

@section('title', __('headings.prices'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
    <div class="row">
        <div class="col-sm-2 vertical-menu">
            {!! parseEditProfileMenu('prices') !!}
        </div>
        <div class="col-sm-10 profile-info">
            <div class="col-sm-12">
                <h2>{{ __('headings.prices') }}</h2>
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
            </div>
            {!! Form::model($user, ['url' => 'ajax/add_new_price']) !!}
            <div class="price_section">
                <div class="col-xs-12">
                    <div>
                        <label class="control control--checkbox" style="margin-left: 0px;"><a>{{ __('fields.on_demand') }}</a>
                            <input type="checkbox" id="on_demand" name="on_demand" autocomplete="off">
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="form-group">
                        <label>{{ __('headings.duration') }}</label>
                        <input type="text" class="form-control" name="service_duration" style="margin-top: 0px;" />
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <div class="form-group">
                        <label>{{ __('fields.unit') }}</label>
                        <select name="service_price_unit" class="form-control">
                            @foreach(getUnits() as $keyUnit => $unit)
                            <option value="{{ $keyUnit }}">{{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <div class="form-group">
                        <label>{{ __('headings.price') }}</label>
                        <input type="text" class="form-control" id="service_price" name="service_price" style="margin-top: 0px;" />
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <div class="form-group">
                        <label>{{ __('fields.currency') }}</label>
                        <select name="service_price_currency" class="form-control" id="service_price_currency">
                            @foreach(getCurrencies() as $currency)
                            <option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <div class="form-group">
                        <label>{{ __('fields.type') }}</label>
                        <select name="price_type" id="price_type" class="form-control">
                            @foreach(getPriceTypes() as $priceType)
                            <option value="{{ $priceType }}">{{ ucfirst($priceType) }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                        <input type="hidden" name="add_price_token" value="{{ csrf_token() }}">
                        <div class="save">
                            <button type="submit" class="add-new-price btn btn-default">{{ __('buttons.add_new_price') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="col-xs-12 price-table-container" style="margin-top: 30px;">
                <table class="{{ $user->prices->count() == 0 ? 'is-hidden' : '' }} table">
                    <thead>
                        <tr>
                            <th>{{ __('fields.type') }}</th>
                            <th>{{ __('headings.duration') }}</th>
                            <th>{{ __('headings.price') }}</th>
                            <th>{{ __('headings.remove') }}</th>
                        </tr>
                    </thead>
                    <tbody id="prices_body">
                        @foreach ($user->prices as $price)
                        <tr>
                            <td>{{ ucfirst($price->price_type) }}</td>
                            <td>{{ $price->service_duration }} {{ ucfirst(trans_choice('fields.' . $price->service_price_unit, $price->service_duration)) }}</td>
                            <td>{{ $price->on_demand == 1 ? 'On Demand' : $price->service_price . ' ' . strtoupper($price->service_price_currency) }}</td>
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
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<script>
    $(function () {
        // add new price
        $('form').on('submit', function (e) {
            e.preventDefault();
            var serviceDuration = $('input[name="service_duration"]').val();
            var servicePrice = $('input[name="service_price"]').val();
            var priceType = $('select[name="price_type"]').val();
            var servicePriceUnit = $('select[name="service_price_unit"]').val();
            var servicePriceCurrency = $('select[name="service_price_currency"]').val();
            var onDemand = $('input[name="on_demand"]').is(':checked');
            var token = $('input[name="add_price_token"]').val();
            
            $.ajax({
                url: location.protocol + '//' + location.host + '/ajax/add_new_price',
                type: 'post',
                data: {
                    service_duration: serviceDuration, 
                    service_price: servicePrice, 
                    price_type: priceType,
                    service_price_unit: servicePriceUnit,
                    service_price_currency: servicePriceCurrency,
                    on_demand: onDemand,
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
                    var priceTdText = data.onDemand !== null ? 'On Demand' : data.servicePrice + ' ' + currency.toUpperCase();
                    var td2 = $('<td></td>', {
                        text: priceTdText
                    });
                    var td3 = $('<td></td>');
                    var glyphiconSpan = $('<span></span>', {
                        class: 'glyphicon glyphicon-trash'
                    });
                    var deleteButton = $('<a></a>', {
                        href: location.protocol + '//' + location.host + '/ajax/delete_price/' + data.newPriceID,
                        class: 'text-danger delete-price'
                    }).on('click', function() {
                        return confirm('{{ __('global.are_you_sure') }}');
                    }).append(glyphiconSpan).appendTo(td3);

                    row.append(td, td1, td2, td3).appendTo(tBody);

                    if (table.hasClass('is-hidden')) {
                        table.removeClass('is-hidden').addClass('is-active-table');
                    }
                } else {
                    // print the errors
                    $.each(errors, function (key, val) {
                        var input = priceSection.find('[name="'+ key +'"]');
                        input.closest('div.form-group').addClass('has-error');
                        input.next().text(val);
                    });
                }
            }
        });
    });

    // delete price
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
                    var tBody = that.closest('tbody');
                    that.closest('tr').remove();
                    if (tBody.children().length == 0) {
                        tBody.parent('table').removeClass('is-active-table').addClass('is-hidden');
                    }
                }
            });
        } else {
            return false;
        }
    });

    // on demand
    $('#on_demand').on('click', function () {
        var that = $(this);
        var price = $('#service_price');
        var currency = $('#service_price_currency');

        price.prop('disabled', function(index, value) { return !value; });
        currency.prop('disabled', function(index, value) { return !value; });
    });
});
</script>
@stop