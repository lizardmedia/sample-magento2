/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */

define([
  'jquery',
  'underscore',
  'mage/template',
], function(
    $, _, mageTemplate) {
  'use strict';

  $.widget('mage.sampleWidget', {
    options: {
      template: 'Button number <%- data.value %> was clicked',
    },

    /** @inheritdoc */
    _create: function() {
      $(this.options.targets).on('click', this.showAlert.bind(this));
    },

    showAlert: function(event) {

      var value = $(event.target).val(),
          source = this.options.template,
          template = mageTemplate(source),
          content = template({
            data: {
              value: value
            }
          });

      alert(content);
    },

  });

  return $.mage.sampleWidget;
});