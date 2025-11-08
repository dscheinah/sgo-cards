<?php

namespace App\Repository;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Storage\RankingStorage;
use App\Storage\TournamentStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class CastleRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): CastleRepository
    {
        return new CastleRepository(
            $injector->get(RankingStorage::class),
            $injector->get(TournamentStorage::class),
            $injector->get(ModifierHelper::class),
            $injector->get(AreaHelper::class),
            $options['tiers'],
        );
    }
}
