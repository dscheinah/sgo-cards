<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class CardFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Card
    {
        return new Card(
            include __DIR__ . '/../../data/cards.php',
            $options['draw'],
            $options['max'],
        );
    }
}
