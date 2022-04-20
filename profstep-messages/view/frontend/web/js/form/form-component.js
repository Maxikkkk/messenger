define([
    'uiComponent',
    'ko',
    'jquery',
    'Magento_Customer/js/customer-data',
    'loader'
], function (Component, ko, $, customerData) {
    'use strict';

    $('body').loader('show');
    return Component.extend({
        defaults: {
            getNoticeTemplate: function () {
                return this.templateNotice;
            },
            isLoggedIn: ko.computed(function () {
                return customerData.get('customer')().firstname;
            }),
            afterTemplateRender: function () {
                $('body').loader('hide');
                $('body').trigger('contentUpdated');
                $('#messenger-form').submit(function () {
                    if($(this).valid()) {
                        $(this).find('button[type="submit"]').attr('disabled', 'disabled');
                        return true;
                    }

                    return false;
                })
            }
        }
    });
});
