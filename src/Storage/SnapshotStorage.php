<?php

namespace App\Storage;

use App\Model\League;
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

    public function insertForLeagueFromPlayer(League $league, Player $player): void
    {
        $modifiers = array_map(
            static fn (Modifier $modifier) => [
                'data' => $modifier->data,
                'count' => $modifier->count
            ],
            $player->modifiers
        );

        $totalBase = array_sum($player->data);
        $totalCalculation = array_sum($player->calculation($league->modifier));

        $statement = 'INSERT INTO `snapshots` 
            (
                `league_id`, `x`, `y`, `modifier`, `data`, `modifiers`, `user_id`, `try`, 
                `total_base`, `total_calculation`, `total_boost`
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $this->insert(
            $statement,
            [
                $league->id,
                $player->x,
                $player->y,
                $player->modifier->identifier,
                json_encode($player->data, JSON_THROW_ON_ERROR),
                json_encode($modifiers, JSON_THROW_ON_ERROR),
                $player->user_id,
                $player->try,
                (int) $totalBase,
                (int) $totalCalculation,
                $totalBase ? (int) ($totalCalculation / $totalBase * 100) - 100 : 0,
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

    public function fetchMaxTotalBase(string $userId): int
    {
        $statement = 'SELECT MAX(`total_base`) AS `max` FROM `snapshots` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['max'] ?? 0;
    }

    public function fetchMaxTotalCalculation(string $userId): int
    {
        $statement = 'SELECT MAX(`total_calculation`) AS `max` FROM `snapshots` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['max'] ?? 0;
    }

    public function fetchMaxTotalBoost(string $userId): int
    {
        $statement = 'SELECT MAX(`total_boost`) AS `max` FROM `snapshots` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['max'] ?? 0;
    }
}
