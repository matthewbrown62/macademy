<?php

namespace Brainspin\CheckoutProcess\Observer;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Quote\Model\QuoteRepository;

/**
 * Class UpdateCart
 * @package Brainspin\CustomPricing\Observer
 */
class Updatecart implements ObserverInterface {
    /**
     * @var CheckoutSession
     */
    protected $_checkoutSession;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * @var QuoteRepository
     */
    protected $_quoteRepository;

    /**
     * Updatecart constructor.
     * @param CheckoutSession $checkoutSession
     */
    public function __construct (
        CheckoutSession $checkoutSession, 
        RequestInterface $request,
        QuoteRepository $quoteRepo
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_request = $request;
        $this->_quoteRepository = $quoteRepo;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $shippingMethod = $this->_request->getParam('shipping_method');

        if(!$shippingMethod) {
            return;
        }

        // $quote = $this->_quoteRepository->get($this->_checkoutSession->getQuote()->getId());

        // if(!$quote->getIsActive()) {
        //     return;
        // }


        $data = $observer->getEvent()->getData('info');
        $cart = $observer->getEvent()->getData('cart');
        $quote = $this->_checkoutSession->getQuote();


        foreach ($data as $itemId => $itemInfo) {
            $item = $quote->getItemById($itemId);

            if (!$item) {
                continue;
            }

            // $item->addCustomOption('shipping_option', array(
            //     'label'  => 'Shipping Method',
            //     'value' =>  $shippingMethod[$itemId]
            // ));

            $item->setShippingMethod($shippingMethod);
            $item->save();
        }
    }
}