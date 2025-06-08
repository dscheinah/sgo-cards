<?php

namespace App\Provider;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Storage\LeagueStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class LeagueProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): LeagueProvider
    {
        return new LeagueProvider(
            $injector->get(LeagueStorage::class),
            $injector->get(AreaHelper::class),
            $injector->get(ModifierHelper::class),
        );
    }
}
