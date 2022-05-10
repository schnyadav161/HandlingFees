<?php

declare(strict_types=1);

namespace Sachin\Handlingfee\Rewrite\Magento\Sales\Block\Adminhtml;

use Magento\Framework\DataObject;

class Totals extends \Magento\Sales\Block\Adminhtml\Order\Totals
{
    /**
     * Initialize order totals array
     *
     * @return $this
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $order = $this->getSource();
        $this->addTotal( new DataObject(
            [
                'code' => 'handlingfee',
                'value' => $order->getData("handlingfee"),
                'base_value' => $order->getData("handlingfee"),
                'label' => __('Handling Fees'),
            ]
        ));
        return $this;
    }

}
