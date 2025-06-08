<?php

namespace App\Provider;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\ShrineStorage;
use App\Storage\SnapshotStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class LeagueProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): LeagueProvider
    {
        return new LeagueProvider(
            $injector->get(LeagueStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(ShrineStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(ModifierHelper::class),
            $injector->get(ShrineHelper::class),
        );
    }
}
