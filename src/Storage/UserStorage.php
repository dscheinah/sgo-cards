<?php

namespace App\Storage;

use Sx\Data\BackendException;
use Sx\Data\Storage;

class UserStorage extends Storage
{
    public function fetchOne(?string $id): ?array
    {
        if (!$id) {
            return null;
        }
        return $this->fetch('SELECT * FROM `users` WHERE `id` = ?', [$id])->current();
    }

    public function fetchLoggedOut(string $name): ?array
    {
        return $this->fetch('SELECT * FROM `users` WHERE `name` = ? AND `logged_in` = FALSE', [$name])->current();
    }

    public function createWithName(string $name): ?array
    {
        $id = hash('md5', $name);
        try {
            $this->insert('INSERT INTO `users` (`id`, `name`) VALUES (?, ?)', [$id, $name]);
        } catch (BackendException) {
            return null;
        }
        return [
            'id' => $id,
            'name' => $name,
        ];
    }

    public function updateToken(string $id, string $token): bool
    {
        try {
            return (bool) $this->execute(
                'UPDATE `users` SET `token` = ? WHERE `id` = ?',
                [$token, $id]
            );
        } catch (BackendException) {
            return false;
        }
    }

    public function validateToken(string $id, string $token): bool
    {
        try {
            return (bool) $this->execute(
                'UPDATE `users` SET `token` = NULL WHERE `token` = ? AND `id` = ?',
                [$token, $id]
            );
        } catch (BackendException) {
            return false;
        }
    }

    public function logout(string $id): void
    {
        $this->execute('UPDATE `users` SET `logged_in` = FALSE WHERE `id` = ?', [$id]);
    }
}
