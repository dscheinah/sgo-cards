<?php

namespace App\Provider;

use App\Helper\TreasureHelper;
use App\Storage\TreasureStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TreasureProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TreasureProvider
    {
        return new TreasureProvider(
            $injector->get(TreasureStorage::class),
            $injector->get(TreasureHelper::class),
        );
    }
}
