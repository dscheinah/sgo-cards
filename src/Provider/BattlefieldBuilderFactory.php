<?php

namespace App\Provider;

use App\Helper\CardHelper;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class BattlefieldBuilderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): BattlefieldBuilder
    {
        return new BattlefieldBuilder(
            $injector->get(BattleProvider::class),
            $injector->get(LeagueProvider::class),
            $injector->get(PlayerProvider::class),
            $injector->get(ShrineProvider::class),
            $injector->get(CardHelper::class),
        );
    }
}
