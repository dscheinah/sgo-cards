<?php

namespace App\Helper\Area;

class RunwayArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['health'] += $player['speed'];
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
