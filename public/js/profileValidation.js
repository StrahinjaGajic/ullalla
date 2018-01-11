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
        .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
                var fv = $('#profileForm').data('formValidation'), // FormValidation instance
                // The current step container
                    $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    // Do not jump to the next step
                    return false;
                }

                return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
                var fv         = $('#profileForm').data('formValidation'),
                    $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the last step container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinished: function(e, currentIndex) {
                $('#profileForm').find('.actions li').attr('aria-disabled', true);
                $('#profileForm').formValidation('defaultSubmit');
            }
        })
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
                            max: 200,
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
                                    console.log(isValid);
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
                            message: requiredNumeric
                        }
                    }
                },
                weight: {
                    validators: {
                        notEmpty: {
                            message: requiredField
                        },
                        numeric: {
                            message: requiredNumeric
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
});