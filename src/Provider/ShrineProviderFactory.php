<?php

namespace App\Provider;

use App\Helper\ShrineHelper;
use App\Storage\ShrineStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class ShrineProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): ShrineProvider
    {
        return new ShrineProvider(
            $injector->get(ShrineStorage::class),
            $injector->get(ShrineHelper::class),
            $options['max'],
        );
    }
}
