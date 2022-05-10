<?php
namespace Sachin\Handlingfee\Model\Total;

use Magento\Framework\Phrase;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;

class HandlingFee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * Collect grand total address amount
     *
     * @param Quote $quote
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator)
    {
        $this->quoteValidator = $quoteValidator;
    }

    public function collect(
        Quote                       $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total                       $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);

        $getTotalHandlingFee = 0;
        $items = $quote->getAllVisibleItems();

        foreach ($items as $key => $item) {
            $handlingFeesByQty = ((float) $item->getHandlingfee() * (int) $item->getQty());
            $getTotalHandlingFee = ((float)$getTotalHandlingFee + (float)$handlingFeesByQty);
        }

        $total->setTotalAmount('handlingfee', $getTotalHandlingFee);
        $total->setBaseTotalAmount('handlingfee', $getTotalHandlingFee);
        $quote->setHandlingfee($getTotalHandlingFee);

        return $this;
    }

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    /**
     * Assign subtotal amount and label to address object
     *
     * @param Quote $quote
     * @param Total $total
     * @return array
     */
    public function fetch(Quote $quote, Total $total): array
    {
        $handlingfee = $quote->getHandlingfee();
        return [
            'code' => 'handlingfee',
            'title' => 'Handling Fee',
            'value' => $handlingfee
        ];
    }

    /**
     * Get Subtotal label
     *
     * @return Phrase
     */
    public function getLabel(): Phrase
    {
        return __('Handler Fee');
    }
}

?>
