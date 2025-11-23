<?php

namespace App\Middleware;

use App\Provider\TournamentProvider;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class TournamentMiddlewareFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): TournamentMiddleware
    {
        return new TournamentMiddleware(
            $injector->get(TournamentProvider::class),
        );
    }
}
