<?php

namespace App\Middleware;

use App\Repository\UserRepository;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Message\Response\ResponseHelperInterface;

class UserMiddlewareFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class)
    {
        return new $class(
            $injector->get(ResponseHelperInterface::class),
            $injector->get(UserRepository::class),
        );
    }
}
