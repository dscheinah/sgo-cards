<?php

namespace App\Middleware;

use App\Repository\SpecializationRepository;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Message\Response\ResponseHelperInterface;

class SpecializationMiddlewareFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): SpecializationMiddleware
    {
        return new SpecializationMiddleware(
            $injector->get(ResponseHelperInterface::class),
            $injector->get(SpecializationRepository::class),
        );
    }
}
