<?php

declare(strict_types=1);

namespace Sachin\Handlingfee\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ModelServiceQuoteSubmitBefore implements ObserverInterface
{

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    )
    {
        $quote = $observer->getEvent()->getQuote();
        $order = $observer->getEvent()->getOrder();
        if ($handlingFee = $quote->getData('handlingfee')) {
            $order->setData('handlingfee', $handlingFee);
        }
    }
}
