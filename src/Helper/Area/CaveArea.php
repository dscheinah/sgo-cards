<?php

namespace App\Helper\Area;

class CaveArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['magic_defense'] += $player['defense'];
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
