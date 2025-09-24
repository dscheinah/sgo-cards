<?php

namespace App\Handler;

use App\Repository\TreasureRepository;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Message\Response\ResponseHelperInterface;

class TreasureHandlerFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class)
    {
        return new $class(
            $injector->get(ResponseHelperInterface::class),
            $injector->get(TreasureRepository::class),
        );
    }
}
