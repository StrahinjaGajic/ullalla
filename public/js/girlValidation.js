$(function() {
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