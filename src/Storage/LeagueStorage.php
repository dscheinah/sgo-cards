<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class LeagueStorage extends Storage
{
    public function fetchAllIds(): Generator
    {
        yield from $this->fetch('SELECT `id` FROM `leagues` ORDER BY `id` DESC');
    }

    public function fetchOne(int $id): ?array
    {
        return $this->fetch('SELECT * FROM `leagues` WHERE `id` = ? LIMIT 1', [$id])->current();
    }

    public function fetchLatest(): array
    {
        return $this->fetch('SELECT * FROM `leagues` ORDER BY `id` DESC LIMIT 1')->current();
    }

    public function insertOne(): void
    {
        $this->insert('INSERT INTO `leagues` VALUES ()');
    }

    public function updateModifier(int $id, string $modifier): void
    {
        $this->execute('UPDATE `leagues` SET `modifier` = ? WHERE `id` = ?', [$modifier, $id]);
    }
}
