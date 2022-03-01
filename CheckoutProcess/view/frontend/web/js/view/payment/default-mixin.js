define([
    'ko',
    'jquery',
    'Magento_Checkout/js/model/step-navigator'
], function (
    ko,
    $,
    stepNavigator
) {
    var mixin = {
        redirectAfterPlaceOrder: false,

        afterPlaceOrder: function () {
            console.log('after place order go to next step');
            stepNavigator.next();
            console.log('after step navigator next');
        },
    };

    return function (Component) {
        return Component.extend(mixin);
    };
});