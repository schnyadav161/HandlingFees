define(
   [
       'jquery',
       'Magento_Checkout/js/view/summary/abstract-total',
       'Magento_Checkout/js/model/quote',
       'Magento_Checkout/js/model/totals',
       'Magento_Catalog/js/price-utils'
   ],
   function ($,Component,quote,totals,priceUtils) {
       "use strict";
       return Component.extend({
           defaults: {
               template: 'Sachin_Handlingfee/checkout/summary/handling-fee'
           },
           totals: quote.getTotals(),
           isDisplayedHandlingFeesTotal : function () {
               return true;
           },
           getHandlingFeesTotal : function () {
               var price = totals.getSegment('handlingfee').value;
               return this.getFormattedPrice(price);
               //return 100;
           }
       });
   }
);
