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

    public function fetchIdentifiedCountForUser(string $userId): int
    {
        $statement = 'SELECT COUNT(DISTINCT `treasure`) AS `count` FROM `treasures` WHERE `user_id` = ? AND (`trigger` < 1 OR `experience` > 0)';
        return $this->fetch($statement, [$userId])->current()['count'] ?? 0;
    }

    public function fetchExperienceMaxForUserExclude(string $userId, string $treasure): int
    {
        $statement = 'SELECT MAX(`experience`) AS `max` FROM `treasures` WHERE `user_id` = ? AND `treasure` <> ?';
        return $this->fetch($statement, [$userId, $treasure])->current()['max'] ?? 0;
    }

    public function fetchExperienceMaxForUserInclude(string $userId, string $treasure): int
    {
        $statement = 'SELECT MAX(`experience`) AS `max` FROM `treasures` WHERE `user_id` = ? AND `treasure` = ?';
        return $this->fetch($statement, [$userId, $treasure])->current()['max'] ?? 0;
    }

    public function fetchExperienceSumForUser(string $userId, string $treasure): int
    {
        $statement = 'SELECT SUM(`experience`) AS `sum` FROM `treasures` WHERE `user_id` = ? AND `treasure` = ?';
        return $this->fetch($statement, [$userId, $treasure])->current()['sum'] ?? 0;
    }
}
