$(function() {
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
                        numeric: {
                            message: numericError
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
                                return (numOfFiles != null && numOfFiles >= 4);
                            }
                        }
                    }
                }
            }
        })
});