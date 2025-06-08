<?php

namespace App\Provider;

use App\Helper\ModifierHelper;
use App\Storage\CardStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class BattleProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): BattleProvider
    {
        return new BattleProvider(
            $injector->get(CardStorage::class),
            $injector->get(LeagueStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(ModifierHelper::class),
            $options['max'],
        );
    }
}
