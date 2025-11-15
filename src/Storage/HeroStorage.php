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

    public function create(string $userId): ?int
    {
        return $this->insert('INSERT INTO `heroes` (`user_id`, `name`) VALUES (?, ?)', [$userId, '']);
    }

    public function updateData(int $id, array $data): void
    {
        $statement = 'UPDATE `heroes` 
            SET `name` = ?, `modifier` = ?, `shrine` = ?, `specialization` = ? 
            WHERE `id` = ?';
        $this->execute(
            $statement,
            [
                $data['name'],
                $data['modifier'] ?? null,
                $data['shrine'] ?? null,
                $data['specialization'] ?? null,
                $id,
            ]
        );
    }

    public function updateAmounts(int $id, array $amounts): void
    {
        $this->execute('DELETE FROM `hero_cards` WHERE `hero_id` = ?', [$id]);
        foreach ($amounts as $identifier => $amount) {
            $this->execute(
                'INSERT INTO `hero_cards` (`hero_id`, `identifier`, `amount`) VALUES (?, ?, ?)',
                [$id, $identifier, $amount]
            );
        }
    }
}
