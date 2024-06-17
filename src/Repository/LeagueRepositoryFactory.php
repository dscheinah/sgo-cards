<?php

namespace App\Repository;

use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class LeagueRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): LeagueRepository
    {
        return new LeagueRepository(
            $injector->get(LeagueStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(Modifier::class),
            $injector->get(Player::class),
            $options['max'],
        );
    }
}
