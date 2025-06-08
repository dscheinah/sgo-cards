<?php

namespace App\Storage;

use App\Model\Modifier;
use App\Model\Player;
use Generator;
use Sx\Data\Storage;

class SnapshotStorage extends Storage
{
    public function fetchPositionsForLeague(int $leagueId): Generator
    {
        $statement = 'SELECT `x`, `y`, COUNT(*) AS `z` FROM `snapshots` WHERE `league_id` = ? GROUP BY `x`, `y`';
        yield from $this->fetch($statement, [$leagueId]);
    }

    public function insertForLeagueFromPlayer(int $leagueId, Player $player): void
    {
        $modifiers = array_map(
            static fn (Modifier $modifier) => [
                'data' => $modifier->data,
                'count' => $modifier->count
            ],
            $player->modifiers
        );

        $statement = 'INSERT INTO `snapshots` 
            (`league_id`, `x`, `y`, `modifier`, `data`, `modifiers`, `user_id`, `try`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->insert(
            $statement,
            [
                $leagueId,
                $player->x,
                $player->y,
                $player->modifier->identifier,
                json_encode($player->data, JSON_THROW_ON_ERROR),
                json_encode($modifiers, JSON_THROW_ON_ERROR),
                $player->user_id,
                $player->try,
            ]
        );
    }

    public function fetchRandomForLeagueAtPosition(int $leagueId, int $x, int $y): ?array
    {
        $statement = 'SELECT * FROM `snapshots` WHERE `league_id` = ? AND `x` = ? AND `y` = ? ORDER BY RAND() LIMIT 1';
        $snapshot = $this->fetch($statement, [$leagueId, $x, $y])->current();
        if ($snapshot) {
            $snapshot['data'] = json_decode($snapshot['data'], true, 512, JSON_THROW_ON_ERROR);
            $snapshot['modifiers'] = json_decode($snapshot['modifiers'], true, 512, JSON_THROW_ON_ERROR);
        }
        return $snapshot;
    }
}
