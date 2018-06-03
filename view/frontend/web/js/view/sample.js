/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */

define([
  'knockout',
  'jquery',
  'mage/url',
  'Magento_Ui/js/form/form',
  'Magento_Customer/js/model/customer',
  'Magento_Checkout/js/model/quote',
  'Magento_Checkout/js/model/url-builder',
  'Magento_Checkout/js/model/error-processor',
  'Magento_Checkout/js/model/cart/cache',
  'LizardMedia_Sample/js/model/sample',
], function(
    ko,
    $,
    urlFormatter,
    Component,
    customer,
    quote,
    urlBuilder,
    errorProcessor,
    cartCache,
    sampleModel) {
  'use strict';
  return Component.extend({

    initialize: function() {
      this._super();

      sampleModel = this.source.get('sampleCheckoutForm');
      var formDataCached = cartCache.get('sample-checkout-form');
      if (formDataCached) {
        sampleModel = this.source.set('sampleCheckoutForm', formDataCached);
      }

      return this;
    },

    onFormChange: function() {
      this.save();
    },

    save: function() {
      this.source.set('params.invalid', false);
      this.source.trigger('sampleCheckoutForm.data.validate');

      if (!this.source.get('params.invalid')) {
        var formData = this.source.get('sampleCheckoutForm');
        var quoteId = quote.getQuoteId();
        var isCustomer = customer.isLoggedIn();
        var url;

        if (isCustomer) {
          url = urlBuilder.createUrl('/carts/mine/set-sample-form-fields', {});
        } else {
          url = urlBuilder.createUrl(
              '/guest-carts/:cartId/set-sample-form-fields', {cartId: quoteId});
        }

        var payload = {
          cartId: quoteId,
          sample: formData,
        };
        var result = true;
        $.ajax({
          url: urlFormatter.build(url),
          data: JSON.stringify(payload),
          global: false,
          contentType: 'application/json',
          type: 'POST',
          async: true,
        }).done(
            function(response) {
              cartCache.set('sample-checkout-form', formData);
              result = true;
            }
        ).fail(
            function(response) {
              result = false;
              errorProcessor.process(response);
            }
        );

        return result;
      }
    },
  });
});