define([
    'jquery',
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'underscore',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/action/redirect-on-success'
], function(
    $,
    Component,
    ko,
    stepNavigator,
    $t,
    _,
    quote,
    redirectOnSuccessAction,
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Brainspin_CheckoutProcess/doctor',
            isVisible: ko.observable(false),
        },
        quoteIsVirtual: quote.isVirtual(),

        initialize: function() {
            this._super();

            stepNavigator.registerStep(
                'doctor',
                null,
                $t('Doctor'),
                this.isVisible,
                _.bind(this.navigate, this),
                this.sortOrder
            );

            return this;
        },

        navigate: function() {
            this.isVisible(true);
        },

        saveDoctor: function() {
            this.source.set('params.invalid', false);
            this.source.trigger('doctorForm.data.validate');

            // verify that form data is valid
            if (!this.source.get('params.invalid')) {
                // data is retrieved from data provider by value of the customScope property
                var formData = this.source.get('doctorForm');
                // do something with form data
                console.log(formData);

                console.log('save doctor');

                //Redirect on form data save success
                redirectOnSuccessAction.execute();
            }
        }
    });
});