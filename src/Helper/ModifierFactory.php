<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class ModifierFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Modifier
    {
        return new Modifier(
            include __DIR__ . '/../../data/modifiers.php',
        );
    }
}
