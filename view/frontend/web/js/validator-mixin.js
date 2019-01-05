/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */

define([
  'jquery',
], function($) {
  'use strict';

  return function(validator) {
    validator.addRule(
        'title-pattern',
        function(value, param) {
          return $.mage.stripHtml(value).match(/\b\w+\b/g).length >= param;
        },
        $.mage.__('Please enter at least {0} words.')
    );

    return validator;
  };
});