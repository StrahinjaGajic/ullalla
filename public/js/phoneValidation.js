$(document).ready(function() {
    $('#contactForm')
        .find('[name="mobile"]')
            .intlTelInput({
                initialCountry: 'auto',
                geoIpLookup: function(callback) {
                    var mobileInput = document.getElementById('mobile'),
                        currentValue = mobileInput.value;
                        mobileInput.value = '';
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                        setTimeout(function() {
                            mobileInput.value = currentValue;
                        }, 10);
                    });
                },
                utilsScript: utilAsset,
                autoPlaceholder: true,
                separateDialCode: true,
                preferredCountries: ['ch']
            });
    $('#contactForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                mobile: {
                    validators: {
                        callback: {
                            callback: function(value, validator, $field) {
                                var isValid = value === '' || $field.intlTelInput('isValidNumber'),
                                    err     = $field.intlTelInput('getValidationError'),
                                    message = null;
                                switch (err) {
                                    case intlTelInputUtils.validationError.INVALID_COUNTRY_CODE:
                                        message = 'The country code is not valid';
                                        break;

                                    case intlTelInputUtils.validationError.TOO_SHORT:
                                        message = 'The phone number is too short';
                                        break;

                                    case intlTelInputUtils.validationError.TOO_LONG:
                                        message = 'The phone number is too long';
                                        break;

                                    case intlTelInputUtils.validationError.NOT_A_NUMBER:
                                        message = 'The value is not a number';
                                        break;

                                    default:
                                        message = 'The phone number is not valid';
                                        break;
                                }

                                return {
                                    valid: isValid,
                                    message: message
                                };
                            }
                        }
                    }
                },
                website: {
                    validators: {
                        uri: {
                            message: invalidUrl
                        }
                    }
                },
            }
        })
});