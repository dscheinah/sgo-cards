<?php

namespace App\Helper\Area;

class RunwayArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['health'] += $player['speed'];
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
