<?php

namespace App\Repository;

use App\Provider\HeroBuilder;
use App\Provider\TournamentProvider;
use App\Storage\HeroStorage;
use App\Storage\RankingStorage;
use App\Storage\ResultStorage;
use App\Storage\UserStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TournamentRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TournamentRepository
    {
        return new TournamentRepository(
            $injector->get(HeroStorage::class),
            $injector->get(RankingStorage::class),
            $injector->get(ResultStorage::class),
            $injector->get(UserStorage::class),
            $injector->get(AchievementRepository::class),
            $injector->get(TournamentProvider::class),
            $injector->get(HeroBuilder::class),
            $options['tiers'],
        );
    }
}
