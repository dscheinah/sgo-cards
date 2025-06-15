<?php

namespace App\Helper\Area;

class TournamentArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return [
            'health' => $player['health'] + $player['damage'] + $player['defense'] + $player['magic'] + $player['speed'],
            'damage' => 0,
            'defense' => 0,
            'magic' => 0,
            'magic_offense' => 0,
            'magic_defense' => 0,
            'speed' => 0,
        ];
    }

    public static function battle(array $stats, int $duration): array
    {
        return [
            'health' => $stats['health'] - 1000000,
            'damage' => 0,
            'defense' => 0,
            'magic' => 0,
            'magic_defense' => 0,
            'speed' => 0,
        ];
    }
}
