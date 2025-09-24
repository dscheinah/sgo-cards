<?php

namespace App\Helper;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TreasureHelperFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TreasureHelper
    {
        return new TreasureHelper(
            include __DIR__ . '/../../data/treasures.php',
        );
    }
}
