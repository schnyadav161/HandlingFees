<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Sachin\Handlingfee\Observer\Checkout;

use Magento\Framework\Event\Observer;

class CartProductAddAfter implements \Magento\Framework\Event\ObserverInterface
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
        $item = $observer->getEvent()->getData('quote_item');
        $productHandlingFee = (float)$item->getProduct()->getHandlingfee();
        $item->setHandlingfee($productHandlingFee);
    }
}

