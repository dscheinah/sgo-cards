<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class CardStorage extends Storage
{
    public function fetchStatsForPlayer(int $playerId): array
    {
        $statement = 'SELECT
                SUM(`health`) AS `health`,
                SUM(`damage`) AS `damage`,
                SUM(`defense`) AS `defense`,
                SUM(`magic`) AS `magic`,
                SUM(`speed`) AS `speed`
            FROM `player_cards` WHERE `player_id` = ? GROUP BY `player_id`';
        return $this->fetch($statement, [$playerId])->current() ?: [
            'health' => 0,
            'damage' => 0,
            'defense' => 0,
            'magic' => 0,
            'speed' => 0,
        ];
    }

    public function fetchModifiersForPlayer(int $playerId): Generator
    {
        $statement = 'SELECT `modifier` FROM `player_cards` WHERE `player_id` = ? AND `modifier` IS NOT NULL';
        yield from $this->fetch($statement, [$playerId]);
    }

    public function insertForPlayer(int $playerId, array $card): void
    {
        $statement = 'INSERT INTO `player_cards` 
            (`player_id`, `health`, `damage`, `defense`, `magic`, `speed`, `modifier`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ';
        $this->insert(
            $statement, [
                $playerId,
                $card['data']['health'] ?? 0,
                $card['data']['damage'] ?? 0,
                $card['data']['defense'] ?? 0,
                $card['data']['magic'] ?? 0,
                $card['data']['speed'] ?? 0,
                $card['modifier'] ?? null
            ]
        );
    }
}
