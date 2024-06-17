<?php

namespace App\Helper;

use App\Storage\CardStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class PlayerFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Player
    {
        return new Player(
            $injector->get(CardStorage::class),
            $injector->get(Card::class),
            $injector->get(Modifier::class),
            $options['health'],
            $options['damage'],
        );
    }
}
