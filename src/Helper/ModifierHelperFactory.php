<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class ModifierHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): ModifierHelper
    {
        return new ModifierHelper(
            include __DIR__ . '/../../data/modifiers.php',
        );
    }
}
