<?php

namespace App\Repository;

use App\Helper\Card;
use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\CardStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class RoundRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): RoundRepository
    {
        return new RoundRepository(
            $injector->get(CardStorage::class),
            $injector->get(LeagueStorage::class),
            $injector->get(PlayerStorage::class),
            $injector->get(SnapshotStorage::class),
            $injector->get(Card::class),
            $injector->get(Modifier::class),
            $injector->get(Player::class),
            $options['max'],
        );
    }
}
