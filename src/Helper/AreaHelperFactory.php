<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class AreaHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): AreaHelper
    {
        return new AreaHelper(
            include __DIR__ . '/../../data/areas.php',
            $options['max'],
        );
    }
}
