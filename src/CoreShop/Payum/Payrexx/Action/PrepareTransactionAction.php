<?php

declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace Wvision\Payum\PayrexxBundle\CoreShop\Payum\Payrexx\Action;

use CoreShop\Component\Core\Model\OrderInterface;
use CoreShop\Component\Core\Model\OrderItemInterface;
use CoreShop\Component\Core\Model\PaymentInterface;
use Payrexx\Models\Request\Gateway;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Wvision\Payum\Payrexx\Request\PrepareTransaction;

class PrepareTransactionAction implements ActionInterface
{
    /**
     * @inheritDoc
     *
     * @param PrepareTransaction $request
     */
    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        $payment = $request->getFirstModel();

        if (!$payment instanceof PaymentInterface) {
            return;
        }

        $order = $payment->getOrder();

        if (!$order instanceof OrderInterface) {
            return;
        }

        $orderLines = [];
        $transactionItemId = 1;
        $request->getTransaction()->setCurrency($order->getCurrency()->getName());
        $request->getTransaction()->setAmount($order->getTotal());

        $invoiceName = '';
        $products = [];

        foreach ($order->getItems() as $item) {
            if (!$item instanceof OrderItemInterface) {
                continue;
            }
            if (empty($invoiceName)) {
                $invoiceName .= $item->getName();
            } else {
                $invoiceName .= ', '.$item->getName();
            }
            $product = [];
            $product['name'] = $item->getName();
            $product['quantity'] = $item->getQuantity();
            $product['amount'] = $item->getTotal();

            $products[] = $product;

            $transactionItemId++;
        }
        $request->getTransaction()->setLineItems($orderLines);
    }

    /**
     * @inheritDoc
     */
    public function supports($request): bool
    {
        return $request instanceof PrepareTransaction
            && $request->getModel() instanceof \ArrayAccess;
    }
}
