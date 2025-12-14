<?php

namespace App\Helper\Area;

class DungeonArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        return $calculation;
    }

    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        $player['health'] -= max(0, $player['damage'] - $enemy['defense'] - $player['defense']) / 2;
        $player['health'] -= max(0, $player['magic_offense'] - $enemy['magic_defense'] - $player['magic_defense']);
        return $player;
    }
}
