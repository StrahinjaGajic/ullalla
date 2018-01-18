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
                        }
                    }
                },
                zip: {
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
                        .find('a')
                        .html(index === numTabs - 1 ? 'Finish' : 'Next');
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