<?php

namespace App\Repository;

use App\Provider\LeagueProvider;
use App\Provider\PlayerProvider;
use App\Storage\LeagueStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class LeagueRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): LeagueRepository
    {
        return new LeagueRepository(
            $injector->get(LeagueStorage::class),
            $injector->get(LeagueProvider::class),
            $injector->get(PlayerProvider::class),
        );
    }
}
