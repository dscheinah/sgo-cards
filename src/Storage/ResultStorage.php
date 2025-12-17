<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class ResultStorage extends Storage
{
    public function fetchLatest(string $userId): Generator
    {
        $statement = 'SELECT * FROM `results` 
            WHERE `user_id` = ? AND `tournament_id` = (SELECT MAX(`tournament_id`) FROM `results`) 
            ORDER BY `tier`';
        return $this->fetch($statement, [$userId]);
    }

    public function create(int $id, int $tier, string $userId, int $heroId, int $win, int $loose, int $rank): void
    {
        $statement = 'INSERT INTO `results` 
            (`tournament_id`, `tier`, `user_id`, `hero_id`, `win`, `loose`, `rank_before`, `rank_after`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->execute($statement, [$id, $tier, $userId, $heroId, $win, $loose, $rank, $rank]);
    }

    public function fetchAll(int $id, int $tier): Generator
    {
        return $this->fetch('SELECT * FROM `results` WHERE `tournament_id` = ? AND `tier` = ?', [$id, $tier]);
    }

    public function fetchForRank(int $id, int $tier, int $rank): ?array
    {
        $statement = 'SELECT * FROM `results` WHERE `tournament_id` = ? AND `tier` = ? AND `rank_after` = ?';
        return $this->fetch($statement, [$id, $tier, $rank])->current();
    }

    public function updateRanking(int $id, int $tier, string $userId, int $rank): void
    {
        $statement = 'UPDATE `results` SET `rank_after` = ? WHERE `tournament_id` = ? AND `tier` = ? AND `user_id` = ?';
        $this->execute($statement, [$rank, $id, $tier, $userId]);
    }
}
