<?php

namespace App\Helper\Area;

class RiverArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['damage'] *= .9;
        return $stats;
    }
}
