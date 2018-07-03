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

      // Fixes problem of undefined method when loading samples before
      // component is fully loaded
      var samples = ko.observableArray([]);
      var page = 1;

      return Component.extend({

        initialize: function() {
          this._super();
          this.loadSamples();
        },

        samples: function() {
          return samples;
        },

        loadSamples: function() {
          var url = '/rest/V1/samples/search';
          $('body').loader('show');
          $.ajax({
            url: urlFormatter.build(url),
            global: false,
            contentType: 'application/json',
            type: 'GET',
            data: {
              'searchCriteria[pageSize]': 1,
              'searchCriteria[currentPage]': page,
            },
            async: true,
          }).done(function(response) {
                samples(response.items);
                page = page + 1;
              }
          ).fail(function(response) {
              }
          ).always(function(response) {
                $('body').loader('hide');
              }
          );
        },
      });
    }
);