<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class RankingStorage extends Storage
{
    public function fetchTopThreeRankings(int $tier): Generator
    {
        $statement = 'SELECT `rankings`.`rank`, `users`.`name` AS `user_name` FROM `rankings` 
            INNER JOIN `users` ON `rankings`.`user_id` = `users`.`id` 
            WHERE `tier` = ? ORDER BY `rank` LIMIT 3';
        return $this->fetch($statement, [$tier]);
    }

    public function fetchUserRanking(int $tier, string $userId): ?int
    {
        return $this->fetch(
            'SELECT `rank` FROM `rankings` WHERE `tier` = ? AND `user_id` = ?',
            [$tier, $userId]
        )->current()['rank'] ?? null;
    }

    public function fetchRankingsAround(int $tier, int $ranking): Generator
    {
        $statement = 'SELECT `rankings`.`rank`, `users`.`name` AS `user_name` FROM `rankings` 
            INNER JOIN `users` ON `rankings`.`user_id` = `users`.`id` 
            WHERE `tier` = ? AND `rank` >= ? ORDER BY `rank` LIMIT 3';
        return $this->fetch($statement, [$tier, $ranking - 1]);
    }

    public function fetchRankForUser(int $tier, string $userId, int $heroId): int
    {
        $statement = 'SELECT `rank` FROM `rankings` WHERE `tier` = ? AND `user_id` = ? LIMIT 1';
        $ranking = $this->fetch($statement, [$tier, $userId])->current();
        if ($ranking) {
            return $ranking['rank'];
        }
        $statement = 'SELECT MAX(`rank`) AS `rank` FROM `rankings` WHERE `tier` = ?';
        $rank = ($this->fetch($statement, [$tier])->current()['rank'] ?? 0) + 1;
        $statement = 'INSERT INTO `rankings` (`tier`, `rank`, `user_id`, `hero_id`) VALUES (?, ?, ?, ?)';
        $this->execute($statement, [$tier, $rank, $userId, $heroId]);
        return $rank;
    }

    public function change(int $tier, int $rank, string $userId, int $heroId): void
    {
        $statement = 'INSERT INTO `rankings` (`tier`, `rank`, `user_id`, `hero_id`) VALUES (?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE `user_id` = ?, `hero_id` = ?';
        $this->execute($statement, [$tier, $rank, $userId, $heroId, $userId, $heroId]);
    }
}
