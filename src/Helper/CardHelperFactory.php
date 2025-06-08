<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class CardHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): CardHelper
    {
        return new CardHelper(
            $injector->get(ModifierHelper::class),
            include __DIR__ . '/../../data/cards.php',
            $options['draw'],
            $options['max'],
        );
    }
}
