/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */
define([
  'jquery',
], function($) {
  'use strict';

  return function(widget) {
    $.widget('mage.breadcrumbs', widget, {

      _init: function() {
        this._super();
        console.log('I am the breadcrumbs widget mixin');
      },
    });

    return $.mage.breadcrumbs;
  };
});