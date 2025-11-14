<?php

namespace App\Provider;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Storage\TournamentStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TournamentProviderFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TournamentProvider
    {
        return new TournamentProvider(
            $injector->get(TournamentStorage::class),
            $injector->get(ModifierHelper::class),
            $injector->get(AreaHelper::class),
        );
    }
}
