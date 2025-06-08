<?php

namespace App\Helper\Area;

class SwampArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['speed'] *= .9;
        return $stats;
    }
}
