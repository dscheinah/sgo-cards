<?php

namespace App\Repository;

use App\Storage\TreasureStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TreasureRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TreasureRepository
    {
        return new TreasureRepository(
            $injector->get(TreasureStorage::class),
        );
    }
}
