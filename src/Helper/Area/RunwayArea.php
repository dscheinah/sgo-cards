<?php

namespace App\Helper\Area;

class RunwayArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        $calculation['health'] += $calculation['speed'] / 2;
        return $calculation;
    }

    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
