<?php

namespace App\Repository;

use App\Provider\BattlefieldBuilder;
use App\Storage\PlayerStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class RoundRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): RoundRepository
    {
        return new RoundRepository(
            $injector->get(BattlefieldBuilder::class),
            $injector->get(PlayerStorage::class),
        );
    }
}
