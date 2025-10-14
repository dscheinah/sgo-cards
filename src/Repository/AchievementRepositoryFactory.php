<?php

namespace App\Repository;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Helper\TreasureHelper;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;
use App\Storage\SnapshotStorage;
use App\Storage\TreasureStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class AchievementRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): AchievementRepository
    {
        return new AchievementRepository(
            $injector->get(PlayerStorage::class),
            $injector->get(PoolStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(TreasureStorage::class),
            $injector->get(CardHelper::class),
            $injector->get(ModifierHelper::class),
            $injector->get(ShrineHelper::class),
            $injector->get(SpecializationHelper::class),
            $injector->get(TreasureHelper::class),
            $options['max'],
        );
    }
}
