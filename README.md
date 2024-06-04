![Payum Payrexx Bundle](docs/images/github_banner.png)

This bundle activates the [Payrexx](https://www.payrexx.com) PaymentGateway in CoreShop.
It requires the [instride/payum-payrexx](https://github.com/instride-ch/payum-payrexx)
package, which will be installed automatically.

## Installation

#### 1. Composer
```bash
$ composer require instride/pimcore-payum-payrexx
```

#### 2. Register the bundle
```php
// config/bundles.php

<?php

return [
    // ...
    Instride\Bundle\PimcorePayumPayrexxBundle\PimcorePayumPayrexxBundle::class => ['all' => true],
];
```

#### 3. Configuration
Go to `CoreShop` → `PaymentProviders` and add a new Provider. Select `payrexx` from `type`
and fill out the required fields at the bottom.
