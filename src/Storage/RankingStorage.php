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
}
