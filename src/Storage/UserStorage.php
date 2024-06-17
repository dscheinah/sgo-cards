<?php

namespace App\Storage;

use Sx\Data\BackendException;
use Sx\Data\Storage;

class UserStorage extends Storage
{
    public function fetchOne(string $id): ?array
    {
        return $this->fetch('SELECT * FROM `users` WHERE `id` = ?', [$id])->current();
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
}
