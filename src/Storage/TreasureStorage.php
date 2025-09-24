<?php

namespace App\Storage;

use App\Model\Treasure;
use Generator;
use Sx\Data\Storage;

class TreasureStorage extends Storage
{
    public function fetchAllForUserAndLeague(string $userId, int $leagueId): Generator
    {
        return $this->fetch(
            'SELECT * FROM `treasures` WHERE `user_id` = ? AND `league_id`= ?',
            [$userId, $leagueId]
        );
    }

    public function insertOne(string $userId, int $leagueId, Treasure $treasure): void
    {
        $statement = 'INSERT INTO `treasures` 
            (`user_id`, `league_id`, `treasure`, `experience`, `trigger`, `charges`, `active`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)';
        $this->insert(
            $statement,
            [
                $userId,
                $leagueId,
                $treasure->treasure,
                $treasure->experience,
                $treasure->trigger,
                $treasure->charges,
                $treasure->active,
            ]
        );
    }

    public function update(Treasure $treasure): void
    {
        $statement = 'UPDATE `treasures`  
            SET `experience` = ?, `trigger` = ?, `charges` = ?, `active` = ? 
            WHERE `id` = ?';
        $this->execute(
            $statement,
            [
                $treasure->experience,
                $treasure->trigger,
                $treasure->charges,
                $treasure->active,
                $treasure->id
            ]
        );
    }

    public function activate(string $userId, int $leagueId, array $ids): void
    {
        $this->execute(
            'UPDATE `treasures` SET `active` = FALSE WHERE `user_id` = ? AND `league_id`= ?',
            [$userId, $leagueId]
        );
        foreach ($ids as $id) {
            $this->execute(
                'UPDATE `treasures` SET `active` = TRUE WHERE `user_id` = ? AND `league_id`= ? AND `id` = ?',
                [$userId, $leagueId, $id]
            );
        }
    }
}
