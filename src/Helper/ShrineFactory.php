<?php

namespace App\Helper;

use App\Storage\ShrineStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class ShrineFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Shrine
    {
        return new Shrine(
            $injector->get(ShrineStorage::class),
            include __DIR__ . '/../../data/shrines.php',
            $options['max'],
        );
    }
}
