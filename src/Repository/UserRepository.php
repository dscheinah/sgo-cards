<?php

namespace App\Repository;

use App\Storage\UserStorage;

class UserRepository
{
    public function __construct(
        private readonly UserStorage $userStorage,
    ) {
    }

    public function load(string $userId): ?array
    {
        return $this->userStorage->fetchOne($userId);
    }

    public function create(string $name): ?array
    {
        return $this->userStorage->createWithName($name);
    }
}
