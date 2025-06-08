<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class ShrineHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): ShrineHelper
    {
        return new ShrineHelper(
            include __DIR__ . '/../../data/shrines.php',
            $options['max'],
        );
    }
}
