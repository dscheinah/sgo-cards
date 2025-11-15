<?php

namespace App\Repository;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Provider\HeroBuilder;
use App\Storage\HeroStorage;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class HeroRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): HeroRepository
    {
        return new HeroRepository(
            $injector->get(HeroStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(PoolStorage::class),
            $injector->get(HeroBuilder::class),
            $injector->get(ModifierHelper::class),
            $injector->get(ShrineHelper::class),
            $injector->get(SpecializationHelper::class),
            $options['hero_count'],
        );
    }

}
