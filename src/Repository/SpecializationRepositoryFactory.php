<?php

namespace App\Repository;

use App\Provider\LeagueProvider;
use App\Provider\PlayerProvider;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class SpecializationRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): SpecializationRepository
    {
        return new SpecializationRepository(
            $injector->get(LeagueProvider::class),
            $injector->get(PlayerProvider::class),
            $injector->get(PlayerStorage::class),
            $injector->get(PoolStorage::class),
        );
    }
}
