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

    public function fetchCountForUserAndLeague(string $userId, int $leagueId): int
    {
        $statement = 'SELECT COUNT(*) AS `count` FROM `players` WHERE `user_id` = ? AND `league_id` = ?';
        return $this->fetch($statement, [$userId, $leagueId])->current()['count'] ?? 0;
    }

    public function fetchMaxYForUserAndLeague(string $userId, int $leagueId): int
    {
        $statement = 'SELECT MAX(`y`) AS `y` FROM `players` WHERE `user_id` = ? AND `league_id` = ?';
        return $this->fetch($statement, [$userId, $leagueId])->current()['y'] ?? 0;
    }

    public function fetchCountForLeague(int $leagueId): array
    {
        $statement = 'SELECT 
                COUNT(DISTINCT `user_id`) AS `users`, 
                COUNT(*) AS `players`
            FROM `players` WHERE `league_id` = ?';
        return $this->fetch($statement, [$leagueId])->current() ?: [
            'users' => 0,
            'players' => 0,
        ];
    }

    public function insertOne(array $player): int
    {
        $statement = 'INSERT INTO players (`user_id`, `league_id`, `modifier`, `try`) VALUES (?, ?, ?, ?)';
        return $this->insert(
            $statement,
            [$player['user_id'], $player['league_id'], $player['modifier'], $player['try']]
        );
    }

    public function updateX(int $id, int $x): void
    {
        $this->execute('UPDATE `players` SET `x` = ? WHERE `id` = ?', [$x, $id]);
    }

    public function updateY(int $id, int $y): void
    {
        $this->execute('UPDATE `players` SET `y` = ? WHERE `id` = ?', [$y, $id]);
    }

    public function updateSpecialization(int $id, string $specialization): void
    {
        $this->execute('UPDATE `players` SET `specialization` = ? WHERE `id` = ?', [$specialization, $id]);
    }

    public function removeSpecialization(int $id): void
    {
        $this->execute('UPDATE `players` SET `specialization` = NULL WHERE `id` = ?', [$id]);
    }
}
