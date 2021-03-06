$(function() {
    $('#profileForm')
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
    $('#profileForm')
    .formValidation({
        framework: 'bootstrap',
        icon: {
                // valid: 'glyphicon glyphicon-ok',
                // invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: [':disabled', ':hidden'],
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            message: maxStrLength30,
                            max: 30
                        }
                    }
                },
                phone: {
                    validators: {
                        numeric: {
                            message: numericError
                        },
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            message: maxStrLength20,
                            max: 20
                        }
                    }
                },
                mobile: {
                    selector: '.mobile-phone',
                    validators: {
                        callback: {
                            callback: function(value, validator, $field) {
                                // if sms_notifications are checked, mobile is required
                                var sms_notifications_check = $('input[name="sms_notifications"]').prop('checked');
                                if (sms_notifications_check != '' && value == '') {
                                    return {
                                        valid: false,
                                        message: 'This field is required'
                                    }
                                }
                                // check if number is valid
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
                web: {
                    validators: {
                        uri: {
                            message: invalidUrl
                        }
                    }
                },
                street: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            message: maxStrLength30,
                            max: 30
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            message: maxStrLength10,
                            max: 10
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            message: maxStrLength30,
                            max: 30
                        }
                    }
                },
                'ullalla_package[]': {
                    err: '#alertPackageMessage',
                    validators: {
                        notEmpty: {
                            message: defaultPackageRequired
                        }
                    }
                },
                photos: {
                    excluded: false,
                    validators: {
                        callback: {
                            message: maxFiles,
                            callback: function(value, validator, $field) {
                                var numOfFiles = $field.closest('.image-preview-multiple').find('._list ._item').length;
                                return (numOfFiles != null && numOfFiles != 0);
                            }
                        }
                    }
                }
            }
        })
.on('change', '[name="sms_notifications"]', function(e) {
    $('#profileForm').formValidation('revalidateField', 'mobile');
})
.bootstrapWizard({
    tabClass: 'nav nav-pills',
    onTabClick: function(tab, navigation, index) {
        return validateTab(index);
    },
    onNext: function(tab, navigation, index) {
        var numTabs    = $('#profileForm').find('.tab-pane').length,
        isValidTab = validateTab(index - 1);
        if (!isValidTab) {
            return false;
        }

        if (index === numTabs) {
                    // Trigger the last tab
                    $('#profileForm').formValidation('defaultSubmit');
                }

                return true;
            },
            onPrevious: function(tab, navigation, index) {
                return validateTab(index + 1);
            },
            onTabShow: function(tab, navigation, index) {
                // Update the label of Next button when we are at the last tab
                var numTabs = $('#profileForm').find('.tab-pane').length;
                $('#profileForm')
                .find('.next')
                        .removeClass('disabled')    // Enable the Next button
                        .find('button')
                        .html(index === numTabs - 1 ? buttonFinish : buttonNext);
                    }
                });

function validateTab(index) {
        var fv   = $('#profileForm').data('formValidation'), // FormValidation instance
            // The current tab
            $tab = $('#profileForm').find('.tab-pane').eq(index);

        // Validate the container
        fv.validateContainer($tab);

        var isValidStep = fv.isValidContainer($tab);
        if (isValidStep === false || isValidStep === null) {
            // Do not jump to the target tab
            return false;
        }

        return true;
    }
});