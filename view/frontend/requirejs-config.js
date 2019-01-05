/**
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 */

var config = {
  map: {
    '*': {
      'sampleWidget': 'LizardMedia_Sample/js/sampleWidget',
    },
  },
  config: {
    mixins: {
      'Magento_Theme/js/view/breadcrumbs': {
        'LizardMedia_Sample/js/view/breadcrumbs': true,
      },
      'Magento_Ui/js/lib/validation/validator': {
        'LizardMedia_Sample/js/validator-mixin': true,
      },
      'Magento_Checkout/js/action/select-shipping-method' : {
        'LizardMedia_Sample/js/action/select-shipping-method-wrapper': true
      },
    },
  },
  deps: [
    'LizardMedia_Sample/js/everyPageRun',
  ],
};
