<?php declare(strict_types=1);

namespace Brainspin\CheckoutProcess\Block\Checkout\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class UpdateAddressSortOrder implements LayoutProcessorInterface {
	public function process($jsLayout): array {

		$paymentMethods = &$jsLayout['components']['checkout']['children']
			['steps']['children']
			['billing-step']['children']
			['payment']['children']
			['payments-list']['children'];


		foreach($paymentMethods as &$paymentMethod) {
			
			if(!isset($paymentMethod['children']['form-fields'])) {
				continue;
			}

			$fields = &$paymentMethod['children']['form-fields']['children'];

			if($fields === null) {
				continue;
			}

			$fields['city']['sortOrder'] = '72';
			$fields['region_id']['sortOrder'] = '74';
			$fields['postcode']['sortOrder'] = '76';
		}

		return $jsLayout;
	}
}