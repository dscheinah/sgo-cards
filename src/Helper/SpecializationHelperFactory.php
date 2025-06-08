<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class SpecializationHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): SpecializationHelper
    {
        return new SpecializationHelper(
            $injector->get(ModifierHelper::class),
            include __DIR__ . '/../../data/specializations.php',
        );
    }
}
