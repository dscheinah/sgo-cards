<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Storage\CardStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use App\Storage\UserStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class PlayerProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): PlayerProvider
    {
        return new PlayerProvider(
            $injector->get(CardStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(UserStorage::class),
            $injector->get(CardHelper::class),
            $injector->get(ModifierHelper::class),
            $options['max'],
            $options['health'],
            $options['damage'],
        );
    }
}
