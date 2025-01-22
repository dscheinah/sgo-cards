<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class BattleFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Battle
    {
        return new Battle(
            $injector->get(Modifier::class),
            $injector->get(Player::class),
            $injector->get(Shrine::class),
            $options['power'],
        );
    }
}
