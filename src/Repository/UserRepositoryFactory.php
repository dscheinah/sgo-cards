<?php

namespace App\Repository;

use App\Storage\UserStorage;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class UserRepositoryFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): UserRepository
    {
        return new UserRepository(
            $injector->get(UserStorage::class),
        );
    }
}
