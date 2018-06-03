/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */
define([
      'jquery',
      'uiComponent',
      'ko',
      'mage/url',
      'mage/translate',
    ], function(
    $,
    Component,
    ko,
    urlFormatter,
    $t) {
      'use strict';

      var sample = ko.observable();

      return Component.extend({
        defaults: {
          template: 'LizardMedia_Sample/sampleForOrder'
        },

        initialize: function() {
          this._super();
          this.loadSample();
        },

        getSample: function() {
          return sample;
        },

        loadSample: function() {
          var url = '/rest/V1/samples/getByOrderId/' + window.orderId;
          $.ajax({
            url: urlFormatter.build(url),
            global: false,
            contentType: 'application/json',
            type: 'GET',
            async: true,
          }).done(function(response) {
                sample(response);
              }
          ).fail(function(response) {
              }
          );
        },
      });
    }
);
