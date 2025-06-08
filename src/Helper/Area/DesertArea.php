<?php

namespace App\Helper\Area;

class DesertArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['health'] -= (int) (1.5 ** $duration);
        return $stats;
    }
}
