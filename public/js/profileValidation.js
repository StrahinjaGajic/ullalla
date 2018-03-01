$(document).ready(function() {
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
                first_name: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: alphaNumeric
                        }
                    }
                },
                nickname: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                    }
                },
                sex: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        }
                    }
                },
                age: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        between: {
                            min: 18,
                            max: 60,
                            message: olderThan
                        }
                    }
                },
                about_me: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        stringLength: {
                            max: 2000,
                            message: stringLength
                        }
                    }
                },
                phone: {
                    validators: {
                        numeric: {
                            message: numericError
                        }
                    }
                },
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
                        },
                        notEmpty: {
                            message: requiredField
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        }
                    }
                },
                skype_name: {
                    validators: {
                        notEmpty: {
                            message: requiredField
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
                height: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        numeric: {
                            message: numericError
                        }
                    }
                },
                weight: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        numeric: {
                            message: numericError
                        }
                    }
                },
                sex_orientation: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: requiredField
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
