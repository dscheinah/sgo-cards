<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class HeroStorage extends Storage
{
    public function fetchOne(int $id): ?array
    {
        return $this->fetch('SELECT * FROM `heroes` WHERE `id` = ?', [$id])->current();
    }

    public function fetchAmounts(int $id): Generator
    {
        return $this->fetch('SELECT * FROM `hero_cards` WHERE `hero_id` = ?', [$id]);
    }

    public function updateActive(string $userId, int $heroId): void
    {
        $this->execute(
            'UPDATE `heroes` SET `active` = IF(`id` = ?, 1, 0) WHERE `user_id` = ?',
            [$heroId, $userId]
        );
    }

    public function fetchIdsForUser(string $userId): Generator
    {
        return $this->fetch('SELECT `id` FROM `heroes` WHERE `user_id` = ?', [$userId]);
    }
}
