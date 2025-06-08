<?php

namespace App\Provider;

use App\Helper\ShrineHelper;
use App\Storage\PlayerStorage;
use App\Storage\ShrineStorage;
use App\Storage\SnapshotStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class StatisticProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): StatisticProvider
    {
        return new StatisticProvider(
            $injector->get(PlayerStorage::class),
            $injector->get(ShrineStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(ShrineHelper::class),
        );
    }
}
