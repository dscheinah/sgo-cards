<?php

namespace App\Helper\Area;

class DungeonArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['health'] -= max(0, $stats['damage'] - $stats['defense'])
            + max(0, $stats['magic'] - $stats['magic_defense']);
        return $stats;
    }
}
