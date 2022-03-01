let config = {
	deps: [
		'Brainspin_CheckoutProcess/js/mask-telephone-inputs'
	],
    config: {
        'mixins': {
            'Magento_Checkout/js/view/payment/default': {
                'Brainspin_CheckoutProcess/js/view/payment/default-mixin': true
            }
        }
    }
}