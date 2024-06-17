<?php

namespace App\Storage;

use Sx\Data\Storage;

class PlayerStorage extends Storage
{
    public function fetchOneForLeagueAtY(int $leagueId, int $y): ?array
    {
        $statement = 'SELECT * FROM `players` WHERE `league_id` = ? AND `y` >= ? LIMIT 1';
        return $this->fetch($statement, [$leagueId, $y])->current();
    }

    public function fetchLatestForUserAndLeague(string $userId, int $leagueId): ?array
    {
        $statement = 'SELECT * FROM `players` WHERE `user_id` = ? AND `league_id` = ? ORDER BY `id` DESC LIMIT 1';
        return $this->fetch($statement, [$userId, $leagueId])->current();
    }

    public function insertOne(array $player): int
    {
        $statement = 'INSERT INTO players (`user_id`, `league_id`, `modifier`) VALUES (?, ?, ?)';
        return $this->insert($statement, [$player['user_id'], $player['league_id'], $player['modifier']]);
    }

    public function updateX(int $id, int $x): void
    {
        $this->execute('UPDATE `players` SET `x` = ? WHERE `id` = ?', [$x, $id]);
    }

    public function updateY(int $id, int $y): void
    {
        $this->execute('UPDATE `players` SET `y` = ? WHERE `id` = ?', [$y, $id]);
    }
}
