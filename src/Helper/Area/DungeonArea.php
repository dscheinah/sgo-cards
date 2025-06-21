<?php

namespace App\Helper\Area;

class DungeonArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        $player['health'] -= max(0, $player['damage'] - $player['defense']);
        $player['health'] -= max(0, $player['magic_offense'] - $player['magic_defense']);
        return $player;
    }
}
