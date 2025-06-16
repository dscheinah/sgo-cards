<?php

namespace App\Helper\Area;

class CityArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['magic'] *= .85;
        return $stats;
    }
}
