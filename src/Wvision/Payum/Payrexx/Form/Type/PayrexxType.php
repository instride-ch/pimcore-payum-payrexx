<?php
declare(strict_types=1);

/**
 * @author Miguel Gomes
 *
 * w-vision.
 *
 * LICENSE
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that is distributed with this source code.
 *
 * @copyright  Copyright (c) 2019 w-vision AG (https://www.w-vision.ch)
 */

namespace Wvision\Payum\PayrexxBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PayrexxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('instance', TextType::class)
            ->add('api_key', PasswordType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, static function (FormEvent $event) {
                $data = $event->getData();
                $data['payum.http_client'] = '@coreshop.payum.http_client';

                $event->setData($data);
            });
    }
}
