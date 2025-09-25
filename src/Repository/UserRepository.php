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
        $name = substr(strip_tags($name), 0, 23);
        $user = $this->userStorage->fetchLoggedOut($name);
        if ($user) {
            $this->userStorage->login($user['id']);
            return $user;
        }
        return $this->userStorage->createWithName($name);
    }

    public function generateToken(string $userId): ?string
    {
        $token = bin2hex(random_bytes(42));
        if (!$this->userStorage->updateToken($userId, $token)) {
            return null;
        }
        return $token;

    }

    public function validateToken(string $userId, string $token): bool
    {
        return $this->userStorage->validateToken($userId, $token);
    }

    public function logout(string $userId): void
    {
        $this->userStorage->logout($userId);
    }
}
