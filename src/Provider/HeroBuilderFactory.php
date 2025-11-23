<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Storage\HeroStorage;
use App\Storage\PoolStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class HeroBuilderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): HeroBuilder
    {
        return new HeroBuilder(
            $injector->get(HeroStorage::class),
            $injector->get(PoolStorage::class),
            $injector->get(CardHelper::class),
            $injector->get(ModifierHelper::class),
            $injector->get(ShrineHelper::class),
            $injector->get(SpecializationHelper::class),
            $injector->get(BattleProvider::class),
        );
    }
}
