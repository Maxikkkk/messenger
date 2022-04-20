define([
    'jquery',
    'underscore',
    'mage/validation/validation'
], function ($, _) {
    'use strict';

    return function (config, element) {
        $(element).mage('validation', {
            errorPlacement: function (error, element) {
                $(error).addClass('messenger-error');

                $(error).insertAfter(element);
            }
        });
    }
})
