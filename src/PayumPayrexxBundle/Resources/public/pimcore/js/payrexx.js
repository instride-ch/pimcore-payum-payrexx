pimcore.registerNS('coreshop.provider.gateways.payrexx');
coreshop.provider.gateways.payrexx = Class.create(coreshop.provider.gateways.abstract, {
  getLayout: function (config) {
    return [
      {
        xtype: 'textfield',
        fieldLabel: t('payrexx.config.api_key'),
        name: 'gatewayConfig.config.api_key',
        length: 255,
        value: config.api_key ? config.api_key : '',
      },
      {
        xtype: 'textfield',
        fieldLabel: t('payrexx.config.instance'),
        name: 'gatewayConfig.config.instance',
        length: 255,
        value: config.instance ? config.instance : '',
      },
    ];
  },
});
