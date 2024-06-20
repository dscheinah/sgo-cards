<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class SnapshotStorage extends Storage
{
    public function fetchPositionsForLeague(int $leagueId): Generator
    {
        $statement = 'SELECT `x`, `y`, COUNT(*) AS `z` FROM `snapshots` WHERE `league_id` = ? GROUP BY `x`, `y`';
        yield from $this->fetch($statement, [$leagueId]);
    }

    public function insertForLeagueFromPlayer(int $leagueId, array $player, array $data): void
    {
        $json = json_encode($data, JSON_THROW_ON_ERROR);
        $statement = 'INSERT INTO `snapshots` (`league_id`, `x`, `y`, `modifier`, `data`) VALUES (?, ?, ?, ?, ?)';
        $this->insert($statement, [$leagueId, $player['x'], $player['y'], $player['modifier'], $json]);
    }

    public function fetchRandomForLeagueAtPosition(int $leagueId, int $x, int $y): ?array
    {
        $statement = 'SELECT * FROM `snapshots` WHERE `league_id` = ? AND `x` = ? AND `y` = ? ORDER BY RAND() LIMIT 1';
        $snapshot = $this->fetch($statement, [$leagueId, $x, $y])->current();
        if ($snapshot) {
            $snapshot['data'] = json_decode($snapshot['data'], true, 512, JSON_THROW_ON_ERROR);
        }
        return $snapshot;
    }
}
