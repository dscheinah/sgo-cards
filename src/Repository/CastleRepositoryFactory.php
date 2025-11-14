<?php

namespace App\Repository;

use App\Storage\RankingStorage;
use App\Storage\ResultStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class CastleRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): CastleRepository
    {
        return new CastleRepository(
            $injector->get(RankingStorage::class),
            $injector->get(ResultStorage::class),
            $options['tiers'],
        );
    }
}
